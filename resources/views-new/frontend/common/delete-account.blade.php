@extends('layouts.talent') @section('content')
<!-- banner start -->
<section class="wow fadeIn cover-background buyer-banner-sec socail-buzz background-position-top top-space" style="background-image:url({{ asset('assets/images/buyer/buyer-banner.png')}});">
 <div class="bg-extra-dark-gray"></div>
 <div class="container">
  <div class="row">
   <div class="col-md-12 col-sm-12 col-xs-12 display-table page-title-large">
    <div class="display-table-cell vertical-align-middle banner-heading text-center padding-30px-tb">
     <!--start page title -->
      <h2 class="text-white">Delete Account</h2> 
        <span class="display-block text-white opacity6 alt-font">
              </span>
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
      <div class="col-md-3 col-sm-4 col-xs-12">
        <div class="buyer-acont">
          
        </div>
      </div>
      <div class="col-md-7 col-sm-7 col-xs-12">
        <div class="buyer-form">
          <h4>Delete Account</h4>
          <form method="POST" action="{{route('delete-account')}}">
            @csrf
          <div class="row">
            <div class="col-md-12">
              <div class="form-sec">
                <div class="row">

                  <div class="col-md-12 col-sm-12 col-xs-12 form-list">
                    <h3>Please let us know the reason to delete the account:</h3>
                    <div class="form-group">
                      <textarea class="form-control" name="delete_account" rows="5" cols="5"></textarea required>
                      @if ($errors->has('delete_account'))
                         <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('delete_account') }}</strong>
                          </span>
                      @endif
                    </div>
                  </div> 

                </div>
              </div>
            </div>
          </div>
          <div class="sec-btn">
            <button type="submit">Delete Account</button>
          </div>
        </div>
      </div>
    </div>
</section>
@endsection
  
  
  <!--SideBar-End---->