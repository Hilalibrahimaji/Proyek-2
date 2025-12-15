<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Exception;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('profile.index', compact('user')); // Perhatikan: profil bukan profile
    }

 public function update(Request $request)
{
    $user = Auth::user();

    // Validasi data
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'phone' => 'nullable|string|max:20',
        'address' => 'nullable|string|max:255',
        'city' => 'nullable|string|max:255',
        'postal_code' => 'nullable|string|max:10',
        'country' => 'nullable|string|max:255',
        'birth_date' => 'nullable|date',
        'gender' => 'nullable|in:male,female,other',
        'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'current_password' => 'nullable|required_with:new_password',
        'new_password' => 'nullable|min:8|confirmed',
    ]);

    try {
        // Update data user
        $updateData = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? $user->phone,
            'address' => $validated['address'] ?? $user->address,
            'city' => $validated['city'] ?? $user->city,
            'postal_code' => $validated['postal_code'] ?? $user->postal_code,
            'country' => $validated['country'] ?? $user->country,
            'birth_date' => $validated['birth_date'] ?? $user->birth_date,
            'gender' => $validated['gender'] ?? $user->gender,
        ];

        // Photo upload
        if ($request->hasFile('photo')) {
            // Delete old photo
            if ($user->photo) {
                Storage::delete('public/photos/' . $user->photo);
            }

            $photoName = time() . '_' . $user->id . '.' . $request->photo->getClientOriginalExtension();
            $request->photo->storeAs('public/photos', $photoName);
            $updateData['photo'] = $photoName;
        }

        // Password update
        if ($request->filled('current_password')) {
            if (Hash::check($request->current_password, $user->password)) {
                $updateData['password'] = Hash::make($request->new_password);
            } else {
                return redirect()->back()->withErrors(['current_password' => 'Current password is incorrect.']);
            }
        }

        // Update data menggunakan update() method
        $user->update($updateData);

    } catch (Exception $e) {
        return redirect()->back()->withErrors(['error' => 'Failed to update profile: ' . $e->getMessage()]);
    }

    return redirect()->route('profile')->with('success', 'Profile updated successfully!');
}
}
