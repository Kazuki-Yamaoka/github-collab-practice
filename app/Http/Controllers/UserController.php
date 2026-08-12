<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::pagenate(20);
        return view('users.index', ['users' => $users]);
    }

    public function store(Request $request)
    {
        $validated = $request->$validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique',
            'password' => 'required|string|min:8',
        ]);

        $user = new User;
        $user->name = $validated[name];
        $user->email = $validated[email];
        $user->password = $validated(hash::make[password]);
        $user->save();

        return redirect('/users');
    }
}
