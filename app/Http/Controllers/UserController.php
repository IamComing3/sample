<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Mail;

class UserController extends Controller
{
    public function __construct()
    {
      /**
      * except fucntion means unfiltered
      */
      $this->middleware('auth', [
        'except' => ['index', 'create', 'store', 'show', 'confirmEmail']
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

        $this->sendEmailConfirmationTo($user);

        session()->flash('success', '验证邮件已发送到你的注册邮箱上，请注意查收~');
        return redirect()->route('home');
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

    protected function sendEmailConfirmationTo($user)
    {
      $view = 'emails.confirm';
      $data = compact('user');
      $from = 'wise@wise.com';
      $name = 'Wise';
      $to = $user->email;
      $subject = '感谢注册 Sample，请确认你的注册邮箱！';

      Mail::send($view, $data, function($message) use ($from, $name, $to, $subject) {
        $message->from($from, $name)->to($to)->subject($subject);
      });
    }

    public function confirmEmail($token)
    {
      $user = User::where('activation_token', $token)->firstOrFail();

      $user->activated = true;
      $user->activation_token = null;
      $user->save();

      Auth::login($user);
      session()->flash('success', '你的账号已成功激活~');
      return redirect()->route('users.show', [$user]);
    }
}
