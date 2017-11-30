<?php

namespace App\Http\Controllers;

use App\Models\User;
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
}
