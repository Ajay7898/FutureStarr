@extends('layouts.seller') @section('content')
<!-- banner start -->
<section class="wow fadeIn cover-background buyer-banner-sec socail-buzz background-position-top top-space" style="background-image:url({{ asset('assets/images/buyer/buyer-banner.png')}});">
 <div class="bg-extra-dark-gray"></div>
 <div class="container">
  <div class="row">
   <div class="col-md-12 col-sm-12 col-xs-12 display-table page-title-large">
    <div class="display-table-cell vertical-align-middle banner-heading text-center padding-30px-tb">
     <!--start page title -->
      <h2 class="text-white">Seller</h2> 
        <span class="display-block text-white opacity6 alt-font">
              Profile</span>
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
      @include('frontend.sidebar.seller')
      <div class="col-md-7 col-sm-7 col-xs-12">
        <div class="buyer-form">
          <h4>Edit Account</h4>
      
          <form method="POST" action="{{route('seller.update')}}" enctype="multipart/form-data">
            @csrf
          <div class="row">
            <div class="col-md-12">
              <div class="form-sec">
                <div class="row">
                  <div class="col-md-12 col-sm-12 col-xs-12 form-list">
                    <h3>Profile Name</h3>
                    <div class="form-group">
                      <input type="text" class="form-control" placeholder="Profile Name" name="username" value="{{old('profile_name', !empty($profileData['username'])?$profileData['username']:'')}}">
                      @if ($errors->has('username'))
                         <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('username') }}</strong>
                          </span>
                      @endif
                    </div>
                  </div>
                  <div class="col-md-12 col-sm-12 col-xs-12 form-list">
                    <h3>Profile Image</h3>
                    <div class="form-group">
                      <input id="uploadBtn" type="file"  name="profile_pic" >
                        <img id="showImage" style="height:300px;width:556px;" src="#" alt="your image" />

                      <input type="hidden" name="old_image" value="{{ !empty($profileData['profile_pic'])?$profileData['profile_pic']:''}}">
                    </div>
                  </div>
                 
                  <div class="col-md-12 col-sm-12 col-xs-12 form-list">
                    <h3>Seller- Bio information</h3><small class="text-danger">(Maximum 160 characters allowed.)</small>
                    <div class="form-group">
                      <textarea name="seller_bio_information" id="description" placeholder="Product information" required="">{{!empty($profileData['description'])?$profileData['description']:''}}</textarea>
                      <span id="charter-left" class="text-danger" style="display: none;">
                          You have&nbsp;<span id="my-textarea-length-left"></span>&nbsp; characters left.
                      </span>
                      @if ($errors->has('seller_bio_information'))
                         <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('seller_bio_information') }}</strong>
                          </span>
                      @endif
                    </div>
                  </div>
                 
                </div>
                <div class="row">
                  <div class="col-md-12 col-sm-12 col-xs-12 form-list">
                    <h3>Contact Information</h3>
                    <div class="form-group">
                      <label>First name</label>
                      <input type="text" class="form-control" placeholder="First Name" name="first_name" value="{{old('first_name', !empty($profileData['first_name'])?$profileData['first_name']:'')}}">
                      @if ($errors->has('first_name'))
                         <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('first_name') }}</strong>
                          </span>
                      @endif
                    </div>
                  </div>
                   <div class="col-md-12 col-sm-12 col-xs-12 form-list">
                    <div class="form-group">
                      <label>Last name</label>
                      <input type="text" class="form-control" placeholder="Lastname" name="last_name" value="{{old('last_name', !empty($profileData['last_name'])?$profileData['last_name']:'')}}">
                      @if ($errors->has('last_name'))
                         <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('last_name') }}</strong>
                          </span>
                      @endif
                    </div>
                  </div>
                  <div class="col-md-6 col-sm-6 col-xs-12 form-list">
                    <div class="form-group">
                      <label>Email</label>
                      <input type="email" class="form-control" placeholder="email" name="email" value="{{old('email', !empty($profileData['email'])?$profileData['email']:'')}}">
                      @if ($errors->has('email'))
                         <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('email') }}</strong>
                          </span>
                      @endif
                    </div>
                  </div>
                  <div class="col-md-6 col-sm-6 col-xs-12 form-list">
                    <div class="form-group">
                      <label>Phone</label>
                      <input type="text" class="form-control" placeholder="Phone" name="phone" value="{{old('phone', !empty($profileData['phone'])?$profileData['phone']:'')}}">
                      @if ($errors->has('phone'))
                         <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('phone') }}</strong>
                          </span>
                      @endif
                    </div>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12 form-list">
                    <div class="form-group">
                      <label>City</label>
                      <input type="text" class="form-control" placeholder="City" name="city" value="{{old('city', !empty($profileData['city'])?$profileData['city']:'')}}">
                      @if ($errors->has('city'))
                         <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('city') }}</strong>
                          </span>
                      @endif
                    </div>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12 form-list">
                    <div class="form-group">
                      <label>State</label>
                      <input type="text" class="form-control" placeholder="State" name="state" value="{{old('state', !empty($profileData['state'])?$profileData['state']:'')}}">
                      @if ($errors->has('state'))
                         <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('state') }}</strong>
                          </span>
                      @endif
                    </div>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12 form-list">
                    <div class="form-group">
                      <label>Zip Code</label>
                      <input type="text" class="form-control" placeholder="Zip Code"  name="zip_code" value="{{old('zip_code', !empty($profileData['zip_code'])?$profileData['zip_code']:'')}}">
                      @if ($errors->has('zip_code'))
                         <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('zip_code') }}</strong>
                          </span>
                      @endif
                    </div>
                  </div>
                  <div class="col-md-12 col-sm-12 col-xs-12 form-list">
                    <div class="form-group">
                      <label>Address</label>
                      <textarea name="address" id="address" placeholder="Address" required="">{{ !empty($profileData['address'])?$profileData['address']:'' }}</textarea>
                      @if ($errors->has('address'))
                         <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('address') }}</strong>
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
            <a href="{{ route('seller.index')}}">Cancel</a>
          </div>
        </div>
      </div>
     
    </div>
</section>

@endsection
@include('frontend.talent.login')
<a class="scroll-top-arrow" href="javascript:void(0);"><i  class="ti-arrow-up"></i></a>
  
@section('javascript')

<script type="text/javascript">

   $('#description').keyup(function(event){

        $("#charter-left").show();
        var $field = $('#description');
        var $left = $('#my-textarea-length-left');
        var len = $field.val().length;
        if (len >= 160) {
            $field.val( $field.val().substring(0, 159) );
            $left.text(0);
            if (event.which != 8) {
                return false;
            }
        }
        $left.text(160 - len);
    });

</script>

@stop