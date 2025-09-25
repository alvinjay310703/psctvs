@extends('layouts.admin')

@section('title', 'Edit Customer')

@section('content')
<div class="bg-white p-6 rounded-2xl shadow-lg max-w-4xl mx-auto">
    <!-- Header -->
    <div class="mb-6 border-b pb-3">
        <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
            <!-- Heroicon: Pencil -->
            <svg xmlns="http://www.w3.org/2000/svg" 
                 class="h-6 w-6 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                      d="M11 4h2m-1 0v16m-7-8h14" />
            </svg>
            Edit Customer – {{ $customer->name }}
        </h2>
        <p class="text-sm text-gray-500">Update customer’s information below.</p>
    </div>

    <!-- Form -->
    <form action="{{ route('customers.update', $customer->id) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- Personal Information -->
        <div>
            <h3 class="text-lg font-semibold text-gray-700 mb-2">👤 Personal Information</h3>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Full Name</label>
                    <input type="text" name="name" value="{{ old('name', $customer->name) }}"
                        class="mt-1 w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-300">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Gender</label>
                    <select name="gender"
                        class="mt-1 w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-300">
                        <option value="">Select Gender</option>
                        <option value="male" {{ $customer->gender=='male'?'selected':'' }}>Male</option>
                        <option value="female" {{ $customer->gender=='female'?'selected':'' }}>Female</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Date of Birth</label>
                    <input type="date" name="dob" value="{{ old('dob', $customer->dob) }}"
                        class="mt-1 w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-300">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Account #</label>
                    <input type="text" name="account_number" value="{{ old('account_number', $customer->account_number) }}" readonly
                        class="mt-1 w-full border rounded-lg px-4 py-2 bg-gray-100 text-gray-600 cursor-not-allowed">
                </div>
            </div>
        </div>

        <!-- Contact Information -->
        <div>
            <h3 class="text-lg font-semibold text-gray-700 mb-2">📞 Contact Information</h3>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Phone Number</label>
                    <input type="text" name="phone" value="{{ old('phone', $customer->phone) }}"
                        class="mt-1 w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-300">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" value="{{ old('email', $customer->email) }}"
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
                    <textarea name="address" rows="2"
                        class="mt-1 w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-300">{{ old('address', $customer->address) }}</textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">City</label>
                    <input type="text" name="city" value="{{ old('city', $customer->city) }}"
                        class="mt-1 w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-300">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Province</label>
                    <input type="text" name="province" value="{{ old('province', $customer->province) }}"
                        class="mt-1 w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-300">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Zip Code</label>
                    <input type="text" name="zip" value="{{ old('zip', $customer->zip) }}"
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
                        <option value="active" {{ $customer->status=='active'?'selected':'' }}>Active</option>
                        <option value="inactive" {{ $customer->status=='inactive'?'selected':'' }}>Inactive</option>
                        <option value="suspended" {{ $customer->status=='suspended'?'selected':'' }}>Suspended</option>
                        <option value="pending" {{ $customer->status=='pending'?'selected':'' }}>Pending</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Service Plan</label>
                    <select name="plan" class="mt-1 w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-300">
                        <option value="">Select Plan</option>
                        <option value="basic" {{ $customer->plan=='basic'?'selected':'' }}>Basic</option>
                        <option value="standard" {{ $customer->plan=='standard'?'selected':'' }}>Standard</option>
                        <option value="premium" {{ $customer->plan=='premium'?'selected':'' }}>Premium</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Password Reset -->
        <div>
            <h3 class="text-lg font-semibold text-gray-700 mb-2">🔑 Reset Password (optional)</h3>
            <input type="password" name="password" placeholder="Leave blank to keep current password"
                class="mt-1 w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-300">
        </div>

        <!-- Buttons -->
        <div class="flex justify-between pt-4 border-t">
            <a href="{{ route('customers.list') }}" class="text-gray-600 hover:underline flex items-center gap-1">
                ← Back
            </a>
            <button type="submit"
                class="bg-yellow-600 hover:bg-yellow-700 text-white px-6 py-2 rounded-lg shadow flex items-center gap-2">
                ✏️ Update Customer
            </button>
        </div>
    </form>
</div>
@endsection
