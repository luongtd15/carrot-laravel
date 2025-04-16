<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

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
        $user = $request->user();

        // Gán các giá trị validated khác (trừ ảnh)
        $user->fill($request->except('avatar'));

        // Nếu email thay đổi, reset xác minh
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        // // Xử lý ảnh nếu có upload
        // if ($request->hasFile('avatar')) {
        //     // Xoá ảnh cũ nếu có
        //     if ($user->avatar && Storage::exists($user->avatar)) {
        //         Storage::delete($user->avatar);
        //     }

        //     // Lưu ảnh mới
        //     $avatarPath = $request->file('avatar')->store('profile_avatars', 'public');
        //     $user->avatar = $avatarPath;
        // }

        $user->save();

        if ($user->role === 'admin') {
            return Redirect::route('admin.profile.edit')->with('status', 'profile-updated');
        } else {
            return Redirect::route('user.profile.edit', ['id' => $user->id])->with('status', 'profile-updated');
        }
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
