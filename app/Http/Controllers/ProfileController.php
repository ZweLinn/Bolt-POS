<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use RealRashid\SweetAlert\Facades\Alert;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();
        Alert::success('Profile Updated', 'Your profile has been updated successfully!');
        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

   public function updateProfilePicture(Request $request): RedirectResponse
{
    $request->validate([
        'profile_picture' => ['required', 'image', 'max:2048'],
    ]);

    $user = $request->user();

    if ($request->hasFile('profile_picture')) {
        $file = $request->file('profile_picture');

        // ✅ Sanitize filename: remove spaces & special characters
        $extension = $file->getClientOriginalExtension();
        $filename = time() . '_' . $user->id . '.' . $extension;

        // ✅ Delete old profile picture if exists
        if ($user->profile && Storage::exists('public/profile_pictures/' . basename($user->profile))) {
            Storage::delete('public/profile_pictures/' . basename($user->profile));
        }

        $file->storeAs('profile_pictures', $filename, 'public');

        // ✅ Store only the relative path, not the full URL
        $user->profile = 'profile_pictures/' . $filename;
        $user->save();
    }

    Alert::success('Profile Picture Updated', 'Your profile picture has been updated successfully!');
    return Redirect::route('profile.edit')->with('status', 'profile-picture-updated');
}

    /**
     * Create Admin Account 
     */
    public function createAdminAccountPage(){
        return view('admin.adminAccount.create');
    }

    public function createAdminAccount(Request $request){
        $request->validate([
            'name' => 'required|string|min:3|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:8',
            'password_confirmation' => 'required|same:password',
        ]);

        
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => bcrypt($request->password),
            'role' => 'admin',
        ]);
        Alert::success('Admin Account Created', 'New admin account has been created successfully!');
        return back();
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
