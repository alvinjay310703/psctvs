@extends('layouts.admin')

@section('title', 'Payments')

@section('content')
<div class="p-6 bg-white rounded-2xl shadow">

    <!-- Header -->
    <h1 class="text-2xl font-bold mb-6">Payments</h1>

    <!-- Transactions Table -->
    <div class="overflow-x-auto">
        <table class="w-full text-sm border-collapse">
            <thead>
                <tr class="bg-gray-100 text-left text-gray-700">
                    <th class="p-3">Txn ID</th>
                    <th class="p-3">Customer</th>
                    <th class="p-3">Amount</th>
                    <th class="p-3">Date</th>
                    <th class="p-3">Method</th>
                    <th class="p-3">Status</th>
                    <th class="p-3 text-right">Receipt</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-b hover:bg-gray-50">
                    <td class="p-3">TXN-001</td>
                    <td class="p-3">Maria Santos</td>
                    <td class="p-3">₱500</td>
                    <td class="p-3">2025-09-21</td>
                    <td class="p-3">GCash</td>
                    <td class="p-3">
                        <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-xs">Successful</span>
                    </td>
                    <td class="p-3 text-right">
                        <a href="#" class="text-blue-600 hover:underline">Download</a>
                    </td>
                </tr>
                <tr class="border-b hover:bg-gray-50">
                    <td class="p-3">TXN-002</td>
                    <td class="p-3">Juan Dela Cruz</td>
                    <td class="p-3">₱700</td>
                    <td class="p-3">2025-09-20</td>
                    <td class="p-3">PayMaya</td>
                    <td class="p-3">
                        <span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded text-xs">Pending</span>
                    </td>
                    <td class="p-3 text-right">
                        <a href="#" class="text-gray-600 hover:underline">Generate</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
