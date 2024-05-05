<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller{

    public function index()
    {
        $users = User::withTrashed()->where('role', 'user')->get();
        return view('admin.users', compact('users'));
    }



    public function softDelete(User $user)
    {
        $user->delete(); // Soft delete the user
        return redirect()->route('admin.users')->with('success', 'User soft deleted successfully');
    }

    public function restore($id)
    {
        $user = User::withTrashed()->findOrFail($id);
        $user->restore(); // Restore the soft deleted user
        return redirect()->route('admin.users')->with('success', 'User restored successfully');
    }
}
