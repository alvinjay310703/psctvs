<div id="assignBox" 
     class="hidden fixed top-24 left-1/2 transform -translate-x-1/2 bg-white rounded-xl shadow-xl w-[30rem] z-30 transition-all scale-95 opacity-0 border">

    <!-- Header -->
    <div class="bg-gradient-to-r from-purple-600 to-blue-600 px-5 py-3 rounded-t-xl flex justify-between items-center">
        <h3 class="text-white font-semibold">Assign Technician</h3>
        <button type="button" onclick="closeAssignBox()" class="text-purple-100 hover:text-white">✕</button>
    </div>

    <!-- Body -->
    <div class="p-6 space-y-4">
        <!-- Request Info -->
        <div class="bg-gray-50 border rounded-lg p-4 text-sm text-gray-700 space-y-1">
            <p><b>Request ID:</b> <span id="assignId"></span></p>
            <p><b>Customer:</b> <span id="assignCustomer"></span></p>
            <p><b>Service:</b> <span id="assignService"></span></p>
            <p><b>Status:</b> <span id="assignStatus" class="font-medium"></span></p>

            <!-- 🔗 Full Page Assign Link -->
            <a id="fullAssignLink" href="#" 
               class="text-xs text-blue-600 hover:underline mt-2 inline-block">
                Go to full assignment page →
            </a>
        </div>

        <!-- Form -->
        <form method="POST" action="" id="assignForm" class="space-y-4">
            @csrf
            <input type="hidden" id="redirectUrl" value="">

            <div>
                <label class="text-sm text-gray-600">Technician</label>
                <select name="technician_id" class="w-full border rounded px-3 py-2 focus:ring-2 focus:ring-purple-500 focus:outline-none">
                    @foreach($technicians as $tech)
                        <option value="{{ $tech->id }}">{{ $tech->name }} (Active Jobs: {{ $tech->active_jobs }})</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="text-sm text-gray-600">Notes (optional)</label>
                <textarea name="notes" rows="2" placeholder="Add assignment notes..." 
                          class="w-full border rounded px-3 py-2 text-sm focus:ring-2 focus:ring-purple-500"></textarea>
            </div>

            <!-- Confirmation Step -->
            <div id="assignConfirm" class="hidden bg-yellow-50 border border-yellow-200 rounded p-3 text-sm text-yellow-700">
                ⚠ Are you sure you want to assign this technician?  
                <div class="flex justify-end gap-2 mt-2">
                    <button type="button" onclick="cancelConfirm()" 
                            class="px-3 py-1 bg-gray-100 rounded hover:bg-gray-200 text-xs">Cancel</button>
                    <button type="button" onclick="finishAssign()" 
                            class="px-3 py-1 bg-green-600 text-white rounded hover:bg-green-700 text-xs">Yes, Confirm</button>
                </div>
            </div>

            <!-- Success Message -->
            <div id="assignSuccess" class="hidden bg-green-50 border border-green-200 rounded p-3 text-sm text-green-700">
                ✅ Technician successfully assigned!  
            </div>

            <!-- Footer -->
            <div id="assignActions" class="flex justify-end gap-2">
                <button type="button" onclick="closeAssignBox()" 
                        class="px-4 py-2 bg-gray-100 rounded hover:bg-gray-200">Cancel</button>
                <button type="button" onclick="showConfirm()" 
                        class="px-4 py-2 bg-purple-600 text-white rounded hover:bg-purple-700">Assign</button>
            </div>
        </form>
    </div>
</div>

<script>
    let currentRequestId = null;

    function openAssignBox(id, customer, service, status) {
        currentRequestId = id;
        document.getElementById('assignForm').action = `/service_requests/${id}/assign`;
        document.getElementById('redirectUrl').value = `/service_requests/${id}`;
        document.getElementById('assignId').innerText = "REQ-" + id;
        document.getElementById('assignCustomer').innerText = customer;
        document.getElementById('assignService').innerText = service;
        document.getElementById('assignStatus').innerText = status.charAt(0).toUpperCase() + status.slice(1);

        // 🔗 Set the full page assign link
        document.getElementById('fullAssignLink').href = `/service_requests/${id}/assign`;

        const box = document.getElementById('assignBox');
        box.classList.remove('hidden');
        setTimeout(() => {
            box.classList.remove('scale-95','opacity-0');
            box.classList.add('scale-100','opacity-100');
        }, 50);
    }

    function closeAssignBox() {
        const box = document.getElementById('assignBox');
        box.classList.add('scale-95','opacity-0');
        setTimeout(() => box.classList.add('hidden'), 200);
        cancelConfirm();
        hideSuccess();
    }

    function showConfirm() {
        document.getElementById('assignActions').classList.add('hidden');
        document.getElementById('assignConfirm').classList.remove('hidden');
    }

    function cancelConfirm() {
        document.getElementById('assignConfirm').classList.add('hidden');
        document.getElementById('assignActions').classList.remove('hidden');
    }

    function finishAssign() {
        document.getElementById('assignConfirm').classList.add('hidden');
        document.getElementById('assignSuccess').classList.remove('hidden');

        setTimeout(() => {
            closeAssignBox();
            window.location.reload();
        }, 1500);
    }

    function hideSuccess() {
        document.getElementById('assignSuccess').classList.add('hidden');
    }
</script>
