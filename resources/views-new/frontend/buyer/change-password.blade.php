@extends('layouts.talent') 

@section('title', 'Future Starr | Buyer Change Password')

@section('content')
<!-- banner start -->
<section class="wow fadeIn cover-background buyer-banner-sec socail-buzz background-position-top top-space" style="background-image:url({{ asset('assets/images/buyer/buyer-banner.png')}});">
 <div class="bg-extra-dark-gray"></div>
 <div class="container">
  <div class="row">
   <div class="col-md-12 col-sm-12 col-xs-12 display-table page-title-large">
    <div class="display-table-cell vertical-align-middle banner-heading text-center padding-30px-tb">
     <!--start page title -->
      <h2 class="text-white">Buyer</h2> 
        <span class="display-block text-white opacity6 alt-font">
              Change Password</span>
              <!-- end sub title -->
          </div>
      </div>
  </div>
</div>
</section>

<!--SideBar-Start---->
  <section class="buyer-con-section">
  <div class="container">
    <div class="row">
      
      @include('frontend.sidebar.buyer');

      <div class="col-md-7 col-sm-7 col-xs-12">
        <div class="buyer-form">
          <h4>Change Password</h4>
          <form method="POST" action="{{route('buyer.setPassword')}}">
            @csrf;
          <div class="row">
            <div class="col-md-12">
              <div class="form-sec">
                <div class="row">
                  <div class="col-md-12 col-sm-12 col-xs-12 form-list">
                    <h3>Current Password:</h3>
                    <div class="form-group">
                      <input type="password" class="form-control" name="current_password" value="">
                      @if ($errors->has('current_password'))
                         <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('current_password') }}</strong>
                          </span>
                      @endif
                    </div>
                  </div>

                   <div class="col-md-12 col-sm-12 col-xs-12 form-list">
                    <h3>Password:</h3>
                    <div class="form-group">
                      <input type="password" class="form-control" placeholder="" name="new_password" value="">
                      @if ($errors->has('new_password'))
                         <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('new_password') }}</strong>
                          </span>
                      @endif
                    </div>
                  </div>

                   <div class="col-md-12 col-sm-12 col-xs-12 form-list">
                    <h3>Password Confirm:</h3>
                    <div class="form-group">
                      <input type="password" class="form-control" placeholder="" name="password_confirmation" value="">
                      @if ($errors->has('password_confirmation'))
                         <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('password_confirmation') }}</strong>
                          </span>
                      @endif
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="sec-btn">
            <button type="submit">Save</button>
            <a href="{{ route('buyer.dashboard')}}">Cancel</a>
          </div>
        </div>
      </div>
    </div>
</section>
@endsection
  
  
  <!--SideBar-End---->