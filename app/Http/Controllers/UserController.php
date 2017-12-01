<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function create()
    {
      return view('users.create');
    }

    public function show(User $user)
    {
      // return view('users.show', [$user]);

      /*
      * Transforming the user object $user into an associative array through the compact method
      */
      return view('users.show', compact('user'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:15',
            'email' => 'required|email|unique:users|max:30',
            'password' => 'required|confirmed|max:15|min:6'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        Auth::login($user);
        session()->flash('success', '欢迎， 你将在这里开始一段新的旅程~');
        return redirect()->route('users.show', [$user]);
    }
}
