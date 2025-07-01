<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;


class UserController extends Controller
{
    public function index()
    {
        $users = User::where('is_admin', false)->withCount('orders')->latest()->get();
        return view('admin.users.index', compact('users'));
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
