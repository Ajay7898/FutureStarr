@extends('admin.common')

@section('title', 'Change Password')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header ch">
      <div class="container-fluid">
        <div class="row mb-2">
         
         
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">	
           
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
		 <p class="dash-t">Change Password</p>
         <div class="row pl-4 pb-4 pr-4">		
    
          <div class="col-lg-12 col-12 pr-4">

          	<form action="{{ route('admin.update-password') }}" method="POST">
          		@csrf

          		<div class="form-group col-md-6">
          			<label>Current Password:</label>
          			<input type="password" name="old_password" id="old_password"  class="form-control @error('old_password') is-invalid @enderror">
          			 @if ($errors->has('old_password'))
                         <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('old_password') }}</strong>
                          </span>
                     @endif
          		</div>

          		<div class="form-group col-md-6">
          			<label>New Password:</label>
          			<input type="password" name="password" id="password"  class="form-control @error('password') is-invalid @enderror">
          			 @if ($errors->has('password'))
                         <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('password') }}</strong>
                          </span>
                     @endif
          		</div>

          		<div class="form-group col-md-6">
          			<label>Confirm New Password:</label>
          			<input type="password" name="password_confirmation" id="password_confirmation"  class="form-control @error('password_confirmation') is-invalid @enderror">
          			 @if ($errors->has('password_confirmation'))
                         <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('password_confirmation') }}</strong>
                          </span>
                     @endif
          		</div>

          		<button type="submit" class="btn btn-primary">Change Password</button>
          		
          	</form>
         
          </div>
         
        </div>
        <!-- /.row -->
        <!-- Main row -->
		
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  @endsection