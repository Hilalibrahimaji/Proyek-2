@extends('layouts.main')

@section('title', 'My Profile')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-6xl mx-auto animate-fade-in">
        <div class="card bg-white">
            <!-- Card Header -->
            <div class="card-header text-white py-4 px-6">
                <h1 class="text-2xl font-bold flex items-center">
                    <i class="fas fa-user-circle mr-3"></i>
                    My Profile
                </h1>
            </div>
            
            <!-- Card Body -->
            <div class="p-6">
                @if(session('success'))
                    <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg">
                        <div class="flex items-center">
                            <i class="fas fa-check-circle text-green-500 mr-2"></i>
                            <span class="text-green-700">{{ session('success') }}</span>
                        </div>
                    </div>
                @endif
                
                @if($errors->any())
                    <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
                        <div class="flex items-center mb-2">
                            <i class="fas fa-exclamation-circle text-red-500 mr-2"></i>
                            <span class="font-medium text-red-700">Please fix the following errors:</span>
                        </div>
                        <ul class="list-disc list-inside text-red-600 ml-6">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Profile Picture Section -->
                    <div class="lg:col-span-1">
                        <div class="text-center mb-6">
                            <div class="inline-block relative">
                                @if($user->photo)
                                    <img src="{{ asset('storage/photos/' . $user->photo) }}" 
                                         class="profile-picture w-48 h-48 rounded-full object-cover">
                                @else
                                    <div class="profile-picture w-48 h-48 rounded-full bg-gradient-to-r from-blue-500 to-purple-600 flex items-center justify-center">
                                        <span class="text-white text-5xl font-bold">{{ substr($user->name, 0, 1) }}</span>
                                    </div>
                                @endif
                            </div>
                            
                            <h2 class="text-xl font-bold mt-4">{{ $user->name }}</h2>
                            <p class="text-gray-600 mt-1">{{ $user->email }}</p>
                            
                            @if($user->phone)
                                <p class="text-gray-600 mt-2">
                                    <i class="fas fa-phone mr-2"></i>{{ $user->phone }}
                                </p>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Form Section -->
                    <div class="lg:col-span-2">
                        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            
                            <div class="form-section mb-6">
                                <h3 class="text-lg font-semibold mb-4 text-gray-800 border-b pb-2">
                                    <i class="fas fa-user-edit mr-2"></i>Personal Information
                                </h3>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <!-- Name Field -->
                                    <div class="form-floating">
                                        <input type="text" 
                                               id="name" 
                                               name="name" 
                                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition form-input-custom"
                                               placeholder=" "
                                               value="{{ old('name', $user->name) }}"
                                               required>
                                        <label for="name">
                                            <i class="fas fa-user"></i>Full Name
                                        </label>
                                    </div>
                                    
                                    <!-- Email Field -->
                                    <div class="form-floating">
                                        <input type="email" 
                                               id="email" 
                                               name="email" 
                                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition form-input-custom"
                                               placeholder=" "
                                               value="{{ old('email', $user->email) }}"
                                               required>
                                        <label for="email">
                                            <i class="fas fa-envelope"></i>Email Address
                                        </label>
                                    </div>
                                    
                                    <!-- Phone Field -->
                                    <div class="form-floating">
                                        <input type="tel" 
                                               id="phone" 
                                               name="phone" 
                                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition form-input-custom"
                                               placeholder=" "
                                               value="{{ old('phone', $user->phone) }}">
                                        <label for="phone">
                                            <i class="fas fa-phone"></i>Phone Number
                                        </label>
                                    </div>
                                    
                                    <!-- Gender Field -->
                                    <div class="form-floating">
                                        <select id="gender" 
                                                name="gender" 
                                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition form-input-custom appearance-none bg-white">
                                            <option value="">Select Gender</option>
                                            <option value="male" {{ old('gender', $user->gender) == 'male' ? 'selected' : '' }}>Male</option>
                                            <option value="female" {{ old('gender', $user->gender) == 'female' ? 'selected' : '' }}>Female</option>
                                            <option value="other" {{ old('gender', $user->gender) == 'other' ? 'selected' : '' }}>Other</option>
                                        </select>
                                        <label for="gender">
                                            <i class="fas fa-venus-mars"></i>Gender
                                        </label>
                                    </div>
                                    
                                    <!-- Address Field (Full Width) -->
                                    <div class="md:col-span-2 form-floating">
                                        <textarea id="address" 
                                                  name="address" 
                                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition form-input-custom min-h-[80px]"
                                                  placeholder=" ">{{ old('address', $user->address) }}</textarea>
                                        <label for="address">
                                            <i class="fas fa-home"></i>Address
                                        </label>
                                    </div>
                                    
                                    <!-- City Field -->
                                    <div class="form-floating">
                                        <input type="text" 
                                               id="city" 
                                               name="city" 
                                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition form-input-custom"
                                               placeholder=" "
                                               value="{{ old('city', $user->city) }}">
                                        <label for="city">
                                            <i class="fas fa-city"></i>City
                                        </label>
                                    </div>
                                    
                                    <!-- Postal Code Field -->
                                    <div class="form-floating">
                                        <input type="text" 
                                               id="postal_code" 
                                               name="postal_code" 
                                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition form-input-custom"
                                               placeholder=" "
                                               value="{{ old('postal_code', $user->postal_code) }}">
                                        <label for="postal_code">
                                            <i class="fas fa-mail-bulk"></i>Postal Code
                                        </label>
                                    </div>
                                    
                                    <!-- Country Field -->
                                    <div class="form-floating">
                                        <input type="text" 
                                               id="country" 
                                               name="country" 
                                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition form-input-custom"
                                               placeholder=" "
                                               value="{{ old('country', $user->country) }}">
                                        <label for="country">
                                            <i class="fas fa-flag"></i>Country
                                        </label>
                                    </div>
                                    
                                    <!-- Birth Date Field -->
                                    <div class="form-floating">
                                        <input type="date" 
                                               id="birth_date" 
                                               name="birth_date" 
                                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition form-input-custom"
                                               placeholder=" "
                                               value="{{ old('birth_date', $user->birth_date) }}">
                                        <label for="birth_date">
                                            <i class="fas fa-birthday-cake"></i>Birth Date
                                        </label>
                                    </div>
                                    
                                    <!-- Photo Field -->
                                    <div class="form-floating">
                                        <input type="file" 
                                               id="photo" 
                                               name="photo" 
                                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition form-input-custom pt-4"
                                               placeholder=" "
                                               accept="image/*">
                                        <label for="photo">
                                            <i class="fas fa-camera"></i>Profile Photo
                                        </label>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Password Section -->
                            <div class="form-section mb-6">
                                <h3 class="text-lg font-semibold mb-4 text-gray-800 border-b pb-2">
                                    <i class="fas fa-lock mr-2"></i>Change Password (Optional)
                                </h3>
                                
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                    <div class="form-floating">
                                        <input type="password" 
                                               id="current_password" 
                                               name="current_password" 
                                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition form-input-custom"
                                               placeholder=" ">
                                        <label for="current_password">Current Password</label>
                                    </div>
                                    
                                    <div class="form-floating">
                                        <input type="password" 
                                               id="new_password" 
                                               name="new_password" 
                                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition form-input-custom"
                                               placeholder=" ">
                                        <label for="new_password">New Password</label>
                                    </div>
                                    
                                    <div class="form-floating">
                                        <input type="password" 
                                               id="new_password_confirmation" 
                                               name="new_password_confirmation" 
                                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition form-input-custom"
                                               placeholder=" ">
                                        <label for="new_password_confirmation">Confirm Password</label>
                                    </div>
                                </div>
                                
                                <div class="mt-4 p-3 bg-blue-50 rounded-lg">
                                    <p class="text-sm text-blue-700 flex items-center">
                                        <i class="fas fa-info-circle mr-2"></i>
                                        Leave password fields blank if you don't want to change your password.
                                    </p>
                                </div>
                            </div>
                            
                            <!-- Submit Button -->
                            <div class="flex flex-col sm:flex-row gap-4 justify-end items-center">
                                <a href="{{ url('/') }}" 
                                   class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition flex items-center justify-center">
                                    <i class="fas fa-arrow-left mr-2"></i>Back to Home
                                </a>
                                
                                <button type="submit" 
                                        class="px-8 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-medium rounded-lg hover:from-blue-700 hover:to-blue-800 transition shadow-md hover:shadow-lg flex items-center justify-center">
                                    <i class="fas fa-save mr-2"></i>Update Profile
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                
                <!-- Footer Info -->
                <div class="mt-8 pt-6 border-t border-gray-200">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-center text-gray-600 text-sm">
                        <div>
                            <i class="fas fa-user-check mr-2"></i>
                            <span>Member since {{ $user->created_at->format('M d, Y') }}</span>
                        </div>
                        <div>
                            <i class="fas fa-clock mr-2"></i>
                            <span>Last updated {{ $user->updated_at->diffForHumans() }}</span>
                        </div>
                        <div>
                            <i class="fas fa-id-card mr-2"></i>
                            <span>User ID: {{ $user->id }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection