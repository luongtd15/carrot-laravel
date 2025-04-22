<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $users = User::all()->sortByDesc('id');
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $users = User::all()->sortByDesc('id');
        return view('admin.users.add', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'phone' => 'required|string|max:11|unique:users,phone',
            'password' => 'required|string|min:8',
            'role' => 'required|in:user,admin',
        ]);

        $validated['password'] = bcrypt($validated['password']);

        $user = User::create($validated);
        return redirect()->route('admin.users.edit', $user->id)
            ->with('success', 'Create user successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $user = User::with('addresses')->findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $authUser = Auth::user();

        // Nếu là admin chỉnh sửa chính mình
        if ($authUser->id === $user->id && $request->has('role')) {
            // Nếu role bị thay đổi
            if ($request->input('role') !== $user->role) {
                return back()
                    ->withInput()
                    ->withErrors(['role' => 'You cannot change your own role']);
            }
        }

        // Nếu chỉnh sửa người khác
        if ($authUser->id !== $user->id) {
            $validated = $request->validate([
                'role' => 'required|in:user,admin',
            ]);

            $user->update([
                'role' => $validated['role'],
            ]);

            return redirect()->route('admin.users.edit', ['user' => $user])
                ->with('success', 'Update user role successfully');
        } else {
            $rules = [
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255|unique:users,email,' . $user->id,
                'password' => 'nullable|string|min:8',
                'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ];

            $validated = $request->validate($rules);
            // Password
            if (empty($validated['password'])) {
                unset($validated['password']);
            } else {
                $validated['password'] = bcrypt($validated['password']);
            }

            // Không cập nhật role trong mọi trường hợp khi tự sửa mình
            unset($validated['role']);

            $user->update($validated);

            return redirect()->route('admin.users.edit', ['user' => $user])
                ->with('success', 'Update user successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
