@extends('layouts.admin')

@section('title', 'Customer Profile')

@section('content')
<div class="bg-white rounded-2xl shadow-md p-6">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <div class="flex items-center space-x-4">
            <!-- Avatar -->
            <div class="w-16 h-16 rounded-full bg-blue-100 flex items-center justify-center text-2xl font-bold text-blue-600">
                MS
            </div>
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Maria Santos</h2>
                <p class="text-sm text-gray-500">Account #: CUST-001</p>
                <p class="text-xs text-green-600 font-medium">● Active</p>
            </div>
        </div>
        <a href="/customers/list" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg shadow text-sm">
            ← Back to List
        </a>
    </div>

    <!-- Quick Stats -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
        <div class="p-4 bg-blue-50 rounded-xl text-center shadow-sm">
            <p class="text-sm text-gray-600">Total Paid</p>
            <p class="text-lg font-bold text-blue-700">₱12,500</p>
        </div>
        <div class="p-4 bg-red-50 rounded-xl text-center shadow-sm">
            <p class="text-sm text-gray-600">Outstanding Balance</p>
            <p class="text-lg font-bold text-red-600">₱500</p>
        </div>
        <div class="p-4 bg-green-50 rounded-xl text-center shadow-sm">
            <p class="text-sm text-gray-600">Active Subscriptions</p>
            <p class="text-lg font-bold text-green-600">1</p>
        </div>
        <div class="p-4 bg-yellow-50 rounded-xl text-center shadow-sm">
            <p class="text-sm text-gray-600">Service Requests</p>
            <p class="text-lg font-bold text-yellow-600">5</p>
        </div>
    </div>

    <!-- Tabs -->
    <div x-data="{ tab: 'overview' }" class="mt-4">
        <!-- Tab Buttons -->
        <div class="border-b mb-4 flex space-x-6 text-sm font-medium">
            <button @click="tab = 'overview'" 
                :class="tab === 'overview' ? 'border-b-2 border-blue-600 text-blue-600 font-semibold' : 'text-gray-600 hover:text-blue-500'" 
                class="pb-2 transition">Overview</button>
            <button @click="tab = 'subscriptions'" 
                :class="tab === 'subscriptions' ? 'border-b-2 border-blue-600 text-blue-600 font-semibold' : 'text-gray-600 hover:text-blue-500'" 
                class="pb-2 transition">Subscriptions</button>
            <button @click="tab = 'billing'" 
                :class="tab === 'billing' ? 'border-b-2 border-blue-600 text-blue-600 font-semibold' : 'text-gray-600 hover:text-blue-500'" 
                class="pb-2 transition">Billing</button>
            <button @click="tab = 'requests'" 
                :class="tab === 'requests' ? 'border-b-2 border-blue-600 text-blue-600 font-semibold' : 'text-gray-600 hover:text-blue-500'" 
                class="pb-2 transition">Service Requests</button>
        </div>

        <!-- Overview -->
        <div x-show="tab === 'overview'" x-transition class="space-y-2 text-gray-700">
            <p><strong>Address:</strong> Barangay 2, Panabo City</p>
            <p><strong>Contact:</strong> 0912-345-6789</p>
            <p><strong>Joined:</strong> Jan 2024</p>
        </div>

        <!-- Subscriptions -->
        <div x-show="tab === 'subscriptions'" x-transition class="overflow-x-auto">
            <table class="w-full text-sm border-collapse shadow-sm rounded-xl">
                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="p-2 border">Plan</th>
                        <th class="p-2 border">Start</th>
                        <th class="p-2 border">End</th>
                        <th class="p-2 border">Monthly Fee</th>
                        <th class="p-2 border">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="hover:bg-gray-50">
                        <td class="p-2 border">Cable + Internet</td>
                        <td class="p-2 border">2024-01-01</td>
                        <td class="p-2 border">2025-01-01</td>
                        <td class="p-2 border">₱500</td>
                        <td class="p-2 border">
                            <span class="bg-green-100 text-green-700 px-2 py-1 rounded-full text-xs">Active</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Billing -->
        <div x-show="tab === 'billing'" x-transition class="overflow-x-auto">
            <table class="w-full text-sm border-collapse shadow-sm rounded-xl">
                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="p-2 border">Bill ID</th>
                        <th class="p-2 border">Amount</th>
                        <th class="p-2 border">Due Date</th>
                        <th class="p-2 border">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="hover:bg-gray-50">
                        <td class="p-2 border">BILL-001</td>
                        <td class="p-2 border">₱500</td>
                        <td class="p-2 border">2025-08-01</td>
                        <td class="p-2 border">
                            <span class="bg-red-100 text-red-700 px-2 py-1 rounded-full text-xs">Unpaid</span>
                        </td>
                    </tr>
                    <tr class="hover:bg-gray-50">
                        <td class="p-2 border">BILL-002</td>
                        <td class="p-2 border">₱1,000</td>
                        <td class="p-2 border">2025-07-01</td>
                        <td class="p-2 border">
                            <span class="bg-green-100 text-green-700 px-2 py-1 rounded-full text-xs">Paid</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Service Requests -->
        <div x-show="tab === 'requests'" x-transition class="overflow-x-auto">
            <table class="w-full text-sm border-collapse shadow-sm rounded-xl">
                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="p-2 border">Request ID</th>
                        <th class="p-2 border">Type</th>
                        <th class="p-2 border">Date</th>
                        <th class="p-2 border">Technician</th>
                        <th class="p-2 border">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="hover:bg-gray-50">
                        <td class="p-2 border">REQ-101</td>
                        <td class="p-2 border">Repair</td>
                        <td class="p-2 border">2025-08-15</td>
                        <td class="p-2 border">Juan Dela Cruz</td>
                        <td class="p-2 border">
                            <span class="bg-green-100 text-green-700 px-2 py-1 rounded-full text-xs">Completed</span>
                        </td>
                    </tr>
                    <tr class="hover:bg-gray-50">
                        <td class="p-2 border">REQ-102</td>
                        <td class="p-2 border">Installation</td>
                        <td class="p-2 border">2025-08-18</td>
                        <td class="p-2 border">Pedro Reyes</td>
                        <td class="p-2 border">
                            <span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded-full text-xs">Pending</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Alpine.js -->
<script src="//unpkg.com/alpinejs" defer></script>
@endsection
