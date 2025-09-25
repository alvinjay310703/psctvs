@extends('layouts.admin')

@section('title', isset($customer) ? 'Edit Customer' : 'Add Customer')

@section('content')
@if ($errors->any())
    <div class="mb-4 p-3 rounded-lg bg-red-100 text-red-800 text-sm">
        <ul class="list-disc list-inside">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if(session('success'))
    <div class="mb-4 p-3 rounded-lg bg-green-100 text-green-800 text-sm">
        {{ session('success') }}
    </div>
@endif

<div class="bg-white p-6 rounded-2xl shadow-lg max-w-4xl mx-auto">
    <!-- Header -->
    <div class="mb-6 border-b pb-3">
        <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" 
                 class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                      d="M12 4v4m0 0v4m0-4h4m-4 0H8m-6 8a9 9 0 1118 0H2z" />
            </svg>
            {{ isset($customer) ? 'Edit Customer' : 'Add New Customer' }}
        </h2>
        <p class="text-sm text-gray-500">
            {{ isset($customer) ? 'Update the customer’s details below.' : 'Fill in the customer’s full details below.' }}
        </p>
    </div>

    <!-- Form -->
    <form action="{{ isset($customer) ? route('customers.update',$customer->id) : route('customers.store') }}" 
          method="POST" class="space-y-6">
        @csrf
        @if(isset($customer)) @method('PUT') @endif

        <!-- Personal Information -->
        <div>
            <h3 class="text-lg font-semibold text-gray-700 mb-2">👤 Personal Information</h3>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Full Name</label>
                    <input type="text" name="name" placeholder="Juan Dela Cruz"
                        value="{{ old('name', $customer->name ?? '') }}"
                        class="mt-1 w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-300">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Gender</label>
                    <select name="gender"
                        class="mt-1 w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-300">
                        <option value="">Select Gender</option>
                        <option value="male" {{ old('gender',$customer->gender ?? '') == 'male' ? 'selected' : '' }}>Male</option>
                        <option value="female" {{ old('gender',$customer->gender ?? '') == 'female' ? 'selected' : '' }}>Female</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Date of Birth</label>
                    <input type="date" name="dob"
                        value="{{ old('dob', $customer->dob ?? '') }}"
                        class="mt-1 w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-300">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Account #</label>
                    <input type="text" name="account_number" placeholder="CUST-001"
                        value="{{ old('account_number', $customer->account_number ?? '') }}"
                        class="mt-1 w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-300">
                </div>
            </div>
        </div>

        <!-- Contact Information -->
        <div>
            <h3 class="text-lg font-semibold text-gray-700 mb-2">📞 Contact Information</h3>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Phone Number</label>
                    <input type="text" name="contact" placeholder="0912-345-6789"
                        value="{{ old('contact', $customer->contact ?? '') }}"
                        class="mt-1 w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-300">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" placeholder="customer@email.com"
                        value="{{ old('email', $customer->email ?? '') }}"
                        class="mt-1 w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-300">
                </div>
            </div>
        </div>

        <!-- Address -->
        <div>
            <h3 class="text-lg font-semibold text-gray-700 mb-2">🏠 Address</h3>
            <div class="grid grid-cols-2 gap-4">
                <div class="col-span-2">
                    <label class="block text-sm font-medium text-gray-700">Street Address</label>
                    <textarea name="address" rows="2" placeholder="Street, Barangay, Subdivision"
                        class="mt-1 w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-300">{{ old('address', $customer->address ?? '') }}</textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">City</label>
                    <input type="text" name="city" placeholder="Quezon City"
                        value="{{ old('city', $customer->city ?? '') }}"
                        class="mt-1 w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-300">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Province</label>
                    <input type="text" name="province" placeholder="Metro Manila"
                        value="{{ old('province', $customer->province ?? '') }}"
                        class="mt-1 w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-300">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Zip Code</label>
                    <input type="text" name="zip" placeholder="1100"
                        value="{{ old('zip', $customer->zip ?? '') }}"
                        class="mt-1 w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-300">
                </div>
            </div>
        </div>

        <!-- Account Status -->
        <div>
            <h3 class="text-lg font-semibold text-gray-700 mb-2">⚙️ Account Status</h3>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Status</label>
                    <select name="status" class="mt-1 w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-300">
                        <option value="active" {{ old('status',$customer->status ?? '') == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ old('status',$customer->status ?? '') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        <option value="suspended" {{ old('status',$customer->status ?? '') == 'suspended' ? 'selected' : '' }}>Suspended</option>
                        <option value="pending" {{ old('status',$customer->status ?? '') == 'pending' ? 'selected' : '' }}>Pending</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Service Plan</label>
                    <select name="plan" class="mt-1 w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-300">
                        <option value="">Select Plan</option>
                        <option value="basic" {{ old('plan',$customer->plan ?? '') == 'basic' ? 'selected' : '' }}>Basic</option>
                        <option value="standard" {{ old('plan',$customer->plan ?? '') == 'standard' ? 'selected' : '' }}>Standard</option>
                        <option value="premium" {{ old('plan',$customer->plan ?? '') == 'premium' ? 'selected' : '' }}>Premium</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Buttons -->
        <div class="flex justify-between pt-4 border-t">
            <a href="{{ route('customers.list') }}" class="text-gray-600 hover:underline flex items-center gap-1">
                ← Back
            </a>
            <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg shadow flex items-center gap-2">
                💾 {{ isset($customer) ? 'Update Customer' : 'Save Customer' }}
            </button>
        </div>
    </form>
</div>
@endsection
