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
        $user->delete();
        return redirect()->route('admin.users')->with('success', 'User soft deleted successfully');
    }

    public function restore($id)
    {
        $user = User::withTrashed()->findOrFail($id);
        $user->restore();
        return redirect()->route('admin.users')->with('success', 'User restored successfully');
    }
}
