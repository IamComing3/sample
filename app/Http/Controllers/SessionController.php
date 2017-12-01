<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function __construct()
    {
      $this->middleware('guest', [
        'only' => ['create', 'store']
      ]);
    }

    public function create()
    {
      return view('sessions.create');
    }

    public function store(Request $request)
    {
      $credentials = $this->validate($request, [
        'email' => 'required|email|max:30',
        'password' => 'required'
      ]);

      if (Auth::attempt($credentials, $request->has('remember'))) {

        if (Auth::user()->activated) {
          session()->flash('success', '欢迎回来~');
          return redirect()->intended(route('users.show', [Auth::user()]));
        } else {
          Auth::logout();
          session()->flash('warning', '你的账号未激活，请检查注册邮箱中的注册邮件进行激活！');
          return redirect()->route('home');
        }


      } else {
        session()->flash('danger', '很抱歉，你的邮箱和密码不匹配');
        return redirect()->back();
      }
    }

    public function destroy()
    {
      Auth::logout();
      session()->flash('success', '你已成功退出~');
      return redirect()->route('login');
    }
}
