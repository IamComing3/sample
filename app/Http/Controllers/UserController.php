<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
      /**
      * except fucntion means unfiltered
      */
      $this->middleware('auth', [
        'except' => ['index', 'create', 'store', 'show']
      ]);

      $this->middleware('guest', [
        'only' => ['create', 'store']
      ]);
    }

    public function index()
    {
      $users =  User::paginate(10);
      return view('users.index', compact('users'));
    }

    public function create()
    {
      return view('users.create');
    }

    public function show(User $user)
    {
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

    public function edit(User $user)
    {
      $this->authorize('update', $user);
      return view('users.edit', compact('user'));
    }

    public function update(User $user, Request $request)
    {
      $this->authorize('update', $user);

      $this->validate($request, [
        'name' => 'required|max:15',
        'password' => 'nullable|confirmed|max:15|min:6'
      ]);

      $data = [];
      $data['name'] = $request->name;
      if ($request->password){
        $data['password'] = bcrypt($request->password);
      }

      $user->update($data);

      session()->flash('success', '资料已更新~');
      return redirect()->route('users.show', [$user]);
    }

    public function destroy(User $user)
    {
      $this->authorize('destroy', $user);
      $user->delete();
      session()->flash('success', '用户 '. $user->name .' 已删除!');
      return redirect()->back();
    }
}
