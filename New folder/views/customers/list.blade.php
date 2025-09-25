@extends('layouts.admin')

@section('title', 'Customer List')

@section('content')

@if(session('success'))
    <div class="mb-4 p-3 rounded-lg bg-green-100 text-green-800 text-sm">
        {{ session('success') }}
    </div>
@endif

@if($errors->any())
    <div class="mb-4 p-3 rounded-lg bg-red-100 text-red-800 text-sm">
        <ul class="list-disc list-inside">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="bg-white p-6 rounded-2xl shadow-md">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <h2 class="flex items-center gap-2 text-xl font-bold text-gray-800">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                      d="M17 20h5v-2a4 4 0 00-4-4h-1m-6 6H6a4 4 0 01-4-4v-1m12 5a4 4 0 00-4-4H6m6-6a4 4 0 100-8 4 4 0 000 8zm6 0a4 4 0 100-8 4 4 0 000 8z" />
            </svg>
            Customer Management
        </h2>

        <a href="{{ route('customers.create') }}" 
           class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg text-sm flex items-center gap-2 shadow-sm">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Add Customer
        </a>
    </div>

    <!-- Search & Filter -->
    <form method="GET" action="{{ route('customers.list') }}" class="flex flex-wrap items-center gap-3 mb-5">
        <input 
            type="text" 
            name="q"
            value="{{ request('q') }}"
            placeholder="🔍 Search by name or account #"
            class="border rounded-lg px-3 py-2 w-64 focus:ring-2 focus:ring-blue-300 text-sm"
        >
        <select name="status" class="border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-300">
            <option value="">Status: All</option>
            <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
            <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
            <option value="suspended" {{ request('status') == 'suspended' ? 'selected' : '' }}>Suspended</option>
            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
        </select>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-700 shadow-sm">
            Apply
        </button>
        <a href="{{ route('customers.list') }}" class="px-4 py-2 rounded-lg text-sm border hover:bg-gray-50 transition">
            Reset
        </a>
    </form>

    <!-- Table -->
    <div class="overflow-x-auto rounded-lg border border-gray-200 shadow-sm">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 text-gray-600 uppercase text-xs tracking-wide">
                <tr>
                    <th class="p-3 text-left">Account #</th>
                    <th class="p-3 text-left">Name</th>
                    <th class="p-3 text-left">Contact</th>
                    <th class="p-3 text-left">Status</th>
                    <th class="p-3 text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($customers as $customer)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="p-3 font-medium text-gray-800">{{ $customer->account_number }}</td>
                        <td class="p-3">{{ $customer->name }}</td>
                        <td class="p-3 text-gray-600">{{ $customer->contact }}</td>
                        <td class="p-3">
                            <span class="px-2 py-1 rounded-full text-xs font-semibold
                                {{ $customer->status == 'active' ? 'bg-green-100 text-green-700' :
                                   ($customer->status == 'inactive' ? 'bg-gray-100 text-gray-700' :
                                   ($customer->status == 'suspended' ? 'bg-red-100 text-red-700' : 'bg-yellow-100 text-yellow-700')) }}">
                                {{ ucfirst($customer->status) }}
                            </span>
                        </td>
                        <td class="p-3">
                            <div class="flex justify-center space-x-4">
                                <a href="{{ route('customers.show',$customer->id) }}" class="flex items-center text-blue-600 hover:text-blue-800 transition text-sm">
                                    View
                                </a>
                                <a href="{{ route('customers.edit',$customer->id) }}" class="flex items-center text-yellow-600 hover:text-yellow-700 transition text-sm">
                                    Edit
                                </a>
                                <form method="POST" action="{{ route('customers.destroy',$customer->id) }}" onsubmit="return confirm('Are you sure you want to delete this customer?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-700 transition text-sm">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="p-3 text-center text-gray-500">No customers found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $customers->links() }}
    </div>
</div>
@endsection
