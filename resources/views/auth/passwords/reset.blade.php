@extends('layouts.default')
@section('title', '更新密码')

@section('content')
  <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
          <div class="panel-heading">更新密码</div>

          <div class="panel-body">
              @if (session('status'))
                  <div class="alert alert-success">
                      {{ session('status') }}
                  </div>
              @endif

              <form method="POST" action="{{ route('password.request') }}">
                  {{ csrf_field() }}

                  <input type="hidden" name="token" value="{{ $token }}">

                  <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                      <label for="email">邮箱地址：</label>
                      <input type="email" name="email" value="{{ $email or old('email') }}" required autofocus  class="form-control">
                      @if ($errors->has('email'))
                          <span class="help-block">
                              <strong>{{ $errors->first('email') }}</strong>
                          </span>
                      @endif
                  </div>

                  <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                      <label for="password">密码：</label>
                      <input type="password" name="password" required  class="form-control">
                      @if ($errors->has('password'))
                          <span class="help-block">
                              <strong>{{ $errors->first('password') }}</strong>
                          </span>
                      @endif
                  </div>

                  <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                      <label for="password-confirm">确认密码：</label>
                      <input type="password" name="password_confirmation" required  class="form-control">
                      @if ($errors->has('password_confirmation'))
                          <span class="help-block">
                              <strong>{{ $errors->first('password_confirmation') }}</strong>
                          </span>
                      @endif
                  </div>


                  <button type="submit" class="btn btn-primary">修改密码</button>

              </form>
          </div>
      </div>
  </div>
@endsection
