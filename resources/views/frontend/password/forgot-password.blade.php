@extends('layouts.talent') 
@section('content')

<div class="container-fluid" style="background-image:url({{ asset('assets/images/header-bg.jpg')}});background-size:cover;">
  <div class="row">
    <div class="col-sm-2"></div>
    <div class="col-sm-8">
      <h3 class="text-center " style="color:#fff;margin-top: 111px;line-height:44px;">Reset your FutureStarr password</h3>
    </div>
    <div class="col-sm-2"></div>
  </div>
  <br><br>
</div>
<div class="container">
  <div class="col-sm-3"></div>
  <div class="col-sm-6">
    <div class="well panel panel-danger" style="margin:20px;">
      <h1>Reset Password</h1>
      <div class="panel-body">

        <form method="POST" action="{{route('password.update11')}}">
          @csrf;
          <div class="form-group">
            <label for="email">Password</label>
            <input type="password" class="form-control" name="password" required placeholder="Password">
            @if ($errors->has('password'))
            <span class="invalid-feedback" role="alert">
              <strong>{{ $errors->first('password') }}</strong>
            </span>
            @endif
          </div>
          <div class="form-group">
            <label for="pwd">Confirm Password:</label>
            <input type="password" class="form-control" name="password_confirmation" required placeholder="Confirm Password">
          </div>
          <input type="hidden" name="token" value="{{ Request::segment(2) }}">
          <button type="submit" class="btn btn-danger main-button">Submit</button>
        </form>
      </div>
    </div>
  </div>
  <div class="col-sm-3"></div>
</div>
@endsection
