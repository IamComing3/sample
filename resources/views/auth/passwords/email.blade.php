@extends('layouts.default')
@section('title', '重置密码')

@section('content')
  <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
          <div class="panel-heading">重置密码</div>
          <div class="panel-body">
              @if (session('status'))
                  <div class="alert alert-success">
                      {{ session('status') }}
                  </div>
              @endif

              <form method="POST" action="{{ route('password.email') }}">
                  {{ csrf_field() }}

                  <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                      <label for="email" >邮箱地址：</label>
                      <input type="email" name="email" value="{{ old('email') }}" required  class="form-control">
                      @if ($errors->has('email'))
                          <span class="help-block">
                              <strong>{{ $errors->first('email') }}</strong>
                          </span>
                      @endif
                  </div>

                  <button type="submit" class="btn btn-primary">发送密码重置邮件</button>

              </form>
          </div>
      </div>
  </div>
@endsection
