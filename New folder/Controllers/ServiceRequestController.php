<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class ServiceRequestController extends Controller
{
    protected $technicians;

    public function __construct()
    {
        $this->technicians = collect([
            (object)['id' => 1, 'name' => 'John Doe', 'active_jobs' => 2],
            (object)['id' => 2, 'name' => 'Jane Smith', 'active_jobs' => 1],
            (object)['id' => 3, 'name' => 'Mark Reyes', 'active_jobs' => 0],
        ]);
    }

    public function index(Request $request)
    {
        $data = collect([
            [
                'id' => 1001,
                'customer_name' => 'Maria Santos',
                'service_type' => 'Installation',
                'status' => 'pending',
                'technician_id' => null,
                'created_at' => now()
            ],
            [
                'id' => 1002,
                'customer_name' => 'Juan Dela Cruz',
                'service_type' => 'Repair',
                'status' => 'assigned',
                'technician_id' => 1,
                'created_at' => now()->subDay()
            ],
            [
                'id' => 1003,
                'customer_name' => 'Alvin Olvido',
                'service_type' => 'Upgrade',
                'status' => 'in-progress',
                'technician_id' => 2,
                'created_at' => now()->subDays(2)
            ],
            [
                'id' => 1004,
                'customer_name' => 'Carla Reyes',
                'service_type' => 'Maintenance',
                'status' => 'completed',
                'technician_id' => 3,
                'created_at' => now()->subDays(3)
            ],
        ]);

        if ($request->filled('search')) {
            $q = strtolower($request->search);
            $data = $data->filter(fn($row) =>
                str_contains(strtolower($row['customer_name']), $q) ||
                str_contains(strtolower("REQ-{$row['id']}"), $q)
            );
        }

        if ($request->filled('status')) {
            $status = strtolower($request->status);
            $data = $data->filter(fn($row) => $row['status'] === $status);
        }

        $page    = max(1, (int) $request->get('page', 1));
        $perPage = 10;
        $items   = $data->forPage($page, $perPage)->values();
        $paginator = new LengthAwarePaginator($items, $data->count(), $perPage, $page, [
            'path'  => $request->url(),
            'query' => $request->query(),
        ]);

        $serviceRequests = $paginator->through(function ($row) {
            return (object) array_merge($row, [
                'technician' => $this->technicians->firstWhere('id', $row['technician_id']),
                'created_at' => $row['created_at'],
            ]);
        });

        return view('service_requests.index', [
            'serviceRequests' => $serviceRequests,
            'technicians' => $this->technicians,
        ]);
    }

   public function show($id)
{
    // Use the same dataset as index()
    $data = collect([
        [
            'id' => 1001,
            'customer_name' => 'Maria Santos',
            'service_type' => 'Installation',
            'status' => 'pending',
            'technician_id' => null,
            'created_at' => now()->subDays(3),
            'assigned_at' => null,
            'started_at' => null,
            'completed_at' => null,
            'phone' => '+63 912 345 6789',
            'address' => '123 Main St, Manila',
            'notes' => 'Requested urgent installation',
            'attachments' => [],
        ],
        [
            'id' => 1002,
            'customer_name' => 'Juan Dela Cruz',
            'service_type' => 'Repair',
            'status' => 'assigned',
            'technician_id' => 1,
            'created_at' => now()->subDays(4),
            'assigned_at' => now()->subDays(3),
            'started_at' => null,
            'completed_at' => null,
            'phone' => '+63 917 654 3210',
            'address' => '456 Rizal Ave, Manila',
            'notes' => 'Cable issue reported',
            'attachments' => [],
        ],
        [
            'id' => 1003,
            'customer_name' => 'Alvin Olvido',
            'service_type' => 'Upgrade',
            'status' => 'in-progress',
            'technician_id' => 2,
            'created_at' => now()->subDays(5),
            'assigned_at' => now()->subDays(4),
            'started_at' => now()->subDay(),
            'completed_at' => null,
            'phone' => '+63 918 222 1111',
            'address' => '789 Lopez St, Makati',
            'notes' => 'Upgrade requested',
            'attachments' => [],
        ],
        [
            'id' => 1004,
            'customer_name' => 'Carla Reyes',
            'service_type' => 'Maintenance',
            'status' => 'completed',
            'technician_id' => 3,
            'created_at' => now()->subDays(7),
            'assigned_at' => now()->subDays(6),
            'started_at' => now()->subDays(5),
            'completed_at' => now()->subDays(4),
            'phone' => '+63 916 888 9999',
            'address' => '101 Ayala Ave, Makati',
            'notes' => 'Routine maintenance',
            'attachments' => [],
        ],
    ]);

    $row = $data->firstWhere('id', (int) $id);

    if (!$row) {
        return redirect()->route('service_requests.index')
            ->with('error', 'Request not found.');
    }

    // Cast to object and attach technician info
    $request = (object) array_merge($row, [
        'technician' => $this->technicians->firstWhere('id', $row['technician_id']),
    ]);

    return view('service_requests.show', compact('request'));
}

    /**
     * Update status (Admin button or Technician API)
     */
  public function updateStatus(Request $req, $id)
{
    $status = $req->input('status');

    // Allowed statuses
    $validStatuses = ['assigned', 'in-progress', 'completed'];
    if (!in_array($status, $validStatuses)) {
        return redirect()->back()->with('error', 'Invalid status update.');
    }

    // If marking completed, require report or photo
    if ($status === 'completed') {
        if (!$req->has('report') && !$req->hasFile('photos')) {
            return redirect()->back()->with('error', 'Please provide a report or upload at least one photo.');
        }

        // Demo: Handle uploaded photos (simulate saving)
        $uploadedPhotos = [];
        if ($req->hasFile('photos')) {
            foreach ($req->file('photos') as $photo) {
                $uploadedPhotos[] = $photo->getClientOriginalName();
            }
        }

        // Demo log
        $message = "Demo: Request #REQ-{$id} marked as completed";
        if ($req->has('report')) $message .= " with report";
        if (!empty($uploadedPhotos)) $message .= " & photos: " . implode(', ', $uploadedPhotos);

        return redirect()->route('service_requests.show', $id)
            ->with('success', $message);
    }

    // Handle other statuses (assigned -> in-progress)
    return redirect()->route('service_requests.show', $id)
        ->with('success', "Demo: Request #REQ-{$id} updated to '{$status}'.");
}

}
