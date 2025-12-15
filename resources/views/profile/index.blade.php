@extends('layouts.main')

@section('title', 'My Profile')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-6xl mx-auto">

        <div class="bg-white rounded-xl shadow-md overflow-hidden">

            <!-- HEADER -->
            <div class="bg-gray-900 px-6 py-4">
                <h1 class="text-2xl font-bold text-white flex items-center gap-3">
                    <i class="fas fa-user-circle"></i>
                    My Profile
                </h1>
            </div>

            <!-- BODY -->
            <div class="p-6">

                {{-- SUCCESS --}}
                @if(session('success'))
                    <div class="mb-5 bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                {{-- ERROR --}}
                @if($errors->any())
                    <div class="mb-5 bg-red-100 border border-red-300 text-red-800 px-4 py-3 rounded">
                        <ul class="list-disc ml-5">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

                    <!-- AVATAR -->
                    <div class="text-center">
                        @if($user->avatar)
                            <img src="{{ asset('storage/avatars/' . $user->avatar) }}"
                                 class="w-40 h-40 rounded-full mx-auto object-cover border">
                        @else
                            <div class="w-40 h-40 rounded-full mx-auto bg-gray-700 flex items-center justify-center">
                                <span class="text-white text-5xl font-bold">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </span>
                            </div>
                        @endif

                        <h2 class="mt-4 text-xl font-semibold text-gray-800">
                            {{ $user->name }}
                        </h2>
                        <p class="text-gray-600">{{ $user->email }}</p>
                    </div>

                    <!-- FORM -->
                    <div class="md:col-span-2">
                        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                                {{-- NAME --}}
                                <div>
                                    <label class="block text-gray-700 font-medium mb-1">Full Name</label>
                                    <input type="text" name="name"
                                           value="{{ old('name', $user->name) }}"
                                           class="w-full border border-gray-300 rounded-lg px-4 py-2 text-gray-800 focus:ring-2 focus:ring-gray-800 focus:outline-none">
                                </div>

                                {{-- EMAIL --}}
                                <div>
                                    <label class="block text-gray-700 font-medium mb-1">Email</label>
                                    <input type="email" name="email"
                                           value="{{ old('email', $user->email) }}"
                                           class="w-full border border-gray-300 rounded-lg px-4 py-2 text-gray-800 focus:ring-2 focus:ring-gray-800 focus:outline-none">
                                </div>

                                {{-- PHONE --}}
                                <div>
                                    <label class="block text-gray-700 font-medium mb-1">Phone</label>
                                    <input type="text" name="phone"
                                           value="{{ old('phone', $user->phone) }}"
                                           class="w-full border border-gray-300 rounded-lg px-4 py-2 text-gray-800">
                                </div>

                                {{-- GENDER --}}
                                <div>
                                    <label class="block text-gray-700 font-medium mb-1">Gender</label>
                                    <select name="gender"
                                            class="w-full border border-gray-300 rounded-lg px-4 py-2 text-gray-800">
                                        <option value="">-- Select --</option>
                                        <option value="male" {{ $user->gender == 'male' ? 'selected' : '' }}>Male</option>
                                        <option value="female" {{ $user->gender == 'female' ? 'selected' : '' }}>Female</option>
                                        <option value="other" {{ $user->gender == 'other' ? 'selected' : '' }}>Other</option>
                                    </select>
                                </div>

                                {{-- ADDRESS --}}
                                <div class="md:col-span-2">
                                    <label class="block text-gray-700 font-medium mb-1">Address</label>
                                    <textarea name="address"
                                              class="w-full border border-gray-300 rounded-lg px-4 py-2 text-gray-800"
                                              rows="3">{{ old('address', $user->address) }}</textarea>
                                </div>

                                {{-- CITY --}}
                                <div>
                                    <label class="block text-gray-700 font-medium mb-1">City</label>
                                    <input type="text" name="city"
                                           value="{{ old('city', $user->city) }}"
                                           class="w-full border border-gray-300 rounded-lg px-4 py-2 text-gray-800">
                                </div>

                                {{-- POSTAL --}}
                                <div>
                                    <label class="block text-gray-700 font-medium mb-1">Postal Code</label>
                                    <input type="text" name="postal_code"
                                           value="{{ old('postal_code', $user->postal_code) }}"
                                           class="w-full border border-gray-300 rounded-lg px-4 py-2 text-gray-800">
                                </div>

                                {{-- COUNTRY --}}
                                <div>
                                    <label class="block text-gray-700 font-medium mb-1">Country</label>
                                    <input type="text" name="country"
                                           value="{{ old('country', $user->country) }}"
                                           class="w-full border border-gray-300 rounded-lg px-4 py-2 text-gray-800">
                                </div>

                                {{-- AVATAR --}}
                                <div>
                                    <label class="block text-gray-700 font-medium mb-1">Profile Photo</label>
                                    <input type="file" name="avatar"
                                           class="w-full border border-gray-300 rounded-lg px-3 py-2 bg-white text-gray-800">
                                </div>
                            </div>

                            <!-- PASSWORD -->
                            <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-4">
                                <input type="password" name="current_password"
                                       placeholder="Current Password"
                                       class="border border-gray-300 rounded-lg px-4 py-2 text-gray-800">

                                <input type="password" name="new_password"
                                       placeholder="New Password"
                                       class="border border-gray-300 rounded-lg px-4 py-2 text-gray-800">

                                <input type="password" name="new_password_confirmation"
                                       placeholder="Confirm Password"
                                       class="border border-gray-300 rounded-lg px-4 py-2 text-gray-800">
                            </div>

                            <!-- BUTTON -->
                            <div class="mt-6 flex justify-end gap-3">
                                <a href="{{ route('home') }}"
                                   class="px-5 py-2 border rounded-lg text-gray-700 hover:bg-gray-100">
                                    Back
                                </a>

                                <button type="submit"
                                        class="px-6 py-2 bg-gray-900 text-white rounded-lg hover:bg-gray-800">
                                    Update Profile
                                </button>
                            </div>

                        </form>
                    </div>

                </div>

            </div>
        </div>

    </div>
</div>
@endsection
