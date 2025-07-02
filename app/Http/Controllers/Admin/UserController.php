<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    public function index()
    {
        $users = User::where('is_admin', false)->withCount('orders')->latest()->get();
        return view('admin.users.index', compact('users'));
    }

    public function create()
{
    return view('admin.users.create');
}

public function store(Request $request)
{$request->validate([
    'name' => 'required|string',
    'email' => 'required|email|unique:users',
    'password' => 'required|string|confirmed|min:6',
    'room_number' => 'required|string|max:10',
]);

User::create([
    'name' => $request->name,
    'email' => $request->email,
    'password' => Hash::make($request->password),
    'room_number' => $request->room_number,
]);
   return redirect()->route('users.index')->with('success', 'User added successfully.');
}

public function edit($id)
{
    $user = User::findOrFail($id);
    return view('admin.users.edit', compact('user'));
}

public function update(Request $request, $id)
{
    $user = User::findOrFail($id);

    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'password' => 'nullable|min:6|confirmed',
        'room_number' => 'required|string|max:10',
        'is_admin' => 'boolean',
    ]);

    if ($validated['password']) {
        $validated['password'] = bcrypt($validated['password']);
    } else {
        unset($validated['password']);
    }

    $user->update($validated);

    return redirect()->route('users.index')->with('success', 'User updated successfully.');
}


    // اختياري: حذف مستخدم
    public function destroy($id)
    {
       $user = User::findOrFail($id);

    // تأكد إنك مش بتحذف أدمن بالغلط
    if ($user->is_admin) {
        return redirect()->route('users.index')->with('error', 'You cannot delete an admin.');
    }

    $user->delete();

    return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
