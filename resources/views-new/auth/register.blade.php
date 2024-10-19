@extends('layouts.talent')

@section('title', 'Future Starr | Register')

@section('content')
<!--<div class="container-fluid" style="height:258px;margin-top: 39px;/*background-image:url('assets/images/header-bg.png');background-size:contain;*/">
</div>-->

<section  class="wow fadeIn cover-background background-position-center top-space star-search-cat" style="padding-bottom:0px !important;padding-top: 39px !important;">
		<img alt="Header Bg" src="{{ asset('assets/images/header-bg.png') }}" width="100%">
            <div class="opacity-medium"></div>
</section>
{{-- <script type="text/javascript" src="https://code.jquery.com/jquery-1.12.1.min.js"></script> --}}
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.js"></script> -->
<script src="{{asset('assets/js/jquery.magnific-popup.js')}}"></script>
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.css" />
 --><link rel="stylesheet" href="{{asset('assets/css/magnific-popup.css')}}">
<style>
     nav.navbar.navbar-inverse.fixed-top {
    background-color: rgb(21, 24, 41);
}
.tabs{
	float:right;
}
.register{
    background: -webkit-linear-gradient(bottom, #FF503F, #010134);
    margin-top: 3%;
    padding: 3%;
}
.btn-danger {
    color: #fff;
    background-color: #010134!important;
    border-color: #010134!important;
}
.register-left{
    text-align: center;
    color: #fff;
    margin-top: -2%;
}
.register-left input{
    border: none;
    border-radius: 1.5rem;
    padding: 2%;
    width: 60%;
    background: #f8f9fa;
    font-weight: bold;
    color: #383d41;
    margin-top: 30%;
    margin-bottom: 3%;
    cursor: pointer;
}
.register-right{
    background: #f8f9fa;
    border-top-left-radius: 10% 50%;
    border-bottom-left-radius: 10% 50%;
	padding-bottom: 170px;
}
.register-left img{
    margin-top: 15%;
    margin-bottom: 5%;
    -webkit-animation: mover 2s infinite  alternate;
    animation: mover 1s infinite  alternate;
}
@-webkit-keyframes mover {
    0% { transform: translateY(0); }
    100% { transform: translateY(-20px); }
}
@keyframes mover {
    0% { transform: translateY(0); }
    100% { transform: translateY(-20px); }
}
.register-left p{
    font-weight: lighter;
    padding: 12%;
    margin-top: -9%;
}
.register .register-form{
    padding: 10%;
    margin-top: 10%;
}
.panel-part p{
	color:black !important;
}
.btnRegister{
    float: right;
    margin-top: 10%;
    border: none;
    border-radius: 1.5rem;
    padding: 2%;
    background: #0062cc;
    color: #fff;
    font-weight: 600;
    width: 50%;
    cursor: pointer;
}
.register .nav-tabs{
    margin-top: 3%;
    border: none;
    background:#010134;
    border-radius: 1.5rem;
    width: 70%;
    float: right;
}
.nav-tabs>li.active {
    border-bottom: none !important; 
}
.register .nav-tabs .nav-link{
    padding: 2%;
    height: 34px;
    font-weight: 600;
    color: #fff;
    border-top-right-radius: 1.5rem;
    border-bottom-right-radius: 1.5rem;
}
.register .nav-tabs .nav-link:hover{
    border: none;
}
.register .nav-tabs .nav-link.active{
    color: #010134;
    border: 2px solid #010134;
    border-top-left-radius: 1.5rem;
    border-bottom-left-radius: 1.5rem;
}
.register-heading{
    text-align: center;
    margin-top: 8%;
    margin-bottom: -15%;
    color: #495057;
}
@media screen and (min-width: 767px) and (max-width: 1000px) {
	.register-left{
		float:left !important;
	}
    
}
input.form-control.is-invalid{
	margin-bottom:0px;
}





</style>

<div class="container register-container register">
    <div class="col-md-3 register-left">
                        <img class="img-responsive sm-logo" src="assets/images/futurelogo.png" width="100%" alt="Future star"/>
                        <h3 style="color:white;">Welcome</h3>
                        <p style="color:white !important;">You are about to gain access to some of the best undiscovered Talent in the world</p>
                        <input type="button" value="Login" href="javascript:void(0)" data-toggle="modal" data-target="#login"/><br/>
                    </div>
        <div class="col-sm-12 col-md-9 col-xs-12 register-right">
            <div class="col-sm-offset-4 col-sm-5 tabs ">
                <ul class="nav nav-tabs nav-justified" id="myTabs">
                    <li class="nav-item">
                        <a class="@if(Session::has('buyer') || Session::has('seller') =='') {{'active'}}  @endif nav-link" href="#aaa" data-toggle="tab">
                            Buyer
						</a>
                    </li>
                    <li class="nav-item">
                        <a class="@if(Session::has('seller')) {{'active'}} @endif nav-link" href="#bbb" data-toggle="tab">
                           Seller
						</a>
                    </li>
                </ul>
            </div>
            <div class="tab-content" id="tabs">
                <div class="tab-pane @if(Session::has('buyer') || Session::has('seller') =='') {{'active'}}  @endif" id="aaa" >
                    <div class="col-sm-8 col-xs-12 panel-part" style=";text-align:center">
					 <span style="color:#black;font-weight:bold;">Register as Buyer </span>
                        <h3 class="register-panel" style="color:black;"> </h3>
                        {!! Form::open(['route' => 'register']) !!}
                        @csrf
						
                        <input type="hidden" name="role_id" value="3">
                            <div class="row">
                                <div class="col-sm-6 col-xs-12">
                                    <div class="form-group">
                                    {!! Form::text('firstname', old('firstname') , ['class' => 'form-control' . ($errors->has('firstname') && Session::has('buyer') ? ' is-invalid' : ''),'placeholder'=>'First Name' ]) !!}
                                    @if ($errors->has('firstname') &&  Session::has('buyer'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('firstname') }}</strong>
                                        </span>
                                    @endif
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    <div class="form-group">
                                    {!! Form::text('lastname', old('lastname') , ['class' => 'form-control' . ($errors->has('lastname') && Session::has('buyer') ? ' is-invalid' : ''),'placeholder'=>'Last Name' ]) !!}
                                    @if ($errors->has('lastname') &&  Session::has('buyer'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('lastname') }}</strong>
                                        </span>
                                    @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 col-xs-12">
                                    <div class="form-group">
                                    {!! Form::text('username', old('username') , ['class' => 'form-control' . ($errors->has('username') && Session::has('buyer') ? ' is-invalid' : ''),'placeholder'=>'User Name' ]) !!}
                                    @if ($errors->has('username') &&  Session::has('buyer'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('username') }}</strong>
                                        </span>
                                    @endif
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    <div class="form-group">
                                    {!! Form::email('email', old('email') , ['class' => 'form-control' . ($errors->has('email') && Session::has('buyer') ? ' is-invalid' : ''),'placeholder'=>'Email' ]) !!}
                                    @if ($errors->has('email') &&  Session::has('buyer'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 col-xs-12">
                                    <div class="form-group" data-tip="Please make password case sentive for security purpose.">
                                    {!! Form::password('password', ['placeholder'=>'Password','class' => 'form-control' . ($errors->has('password') && Session::has('buyer')? ' is-invalid' : ''), ]) !!}
                                    @if ($errors->has('password') &&  Session::has('buyer'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    <div class="form-group">
                                    {!! Form::password('password_confirmation' , ['placeholder'=>'Re-Type Password', 'class' => 'form-control' . ($errors->has('password_confirmation') && Session::has('buyer')? ' is-invalid' : ''),]) !!}
                                    @if ($errors->has('password_confirmation') &&  Session::has('buyer'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                        </span>
                                    @endif
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    <div class="g-recaptcha" data-sitekey="6Lf4BwUTAAAAAFJibAut9uEkKIMp5jnc5K8838YV"></div>
                                    @error('g-recaptcha-response')
                                      <span class="invalid-feedback" role="alert">
                                        <strong>Please check on the reCAPTCHA box.</strong>
                                      </span>
                                    @enderror
                                 </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-10 col-xs-10 col-lg-10 col-md-10" style="margin:0 auto;">
                                        <button class="btn btn-danger btn-lg" type="submit" style="background-color:#c9302c;margin-bottom:21px;">Register</button>
                                   
                                </div>
                            </div>
                            {!! Form::close()!!}
                    </div>


                    <div class="col-sm-4 col-xs-12  panel-part">
                        <h1 class="text-left  panel-second-half-heading register-panel" style="color:black;">What buyers can do?</h1>
                        <p>
                            <i class="fa fa-user" aria-hidden="true"></i> Buyer can have their own account.</p>
                        <p>
                            <i class="fa fa-comments" aria-hidden="true"></i> Buyer can send and receive messages from seller.</p>
                        <p>
                            <i class="fa fa-money" aria-hidden="true"></i> Buyer can make purchases.</p>
                        <p>
                            <i class="fa fa-cloud-download" aria-hidden="true"></i> Buyer can download products.</p>
                    </div>
                </div>
                <!-- first tab closed -->

                <!-- second tab -->
                <div class="tab-pane  @if(Session::has('seller')) {{'active'}} @endif" id="bbb" >
				
                    <div class="col-sm-8 col-xs-12 panel-part buyer-register" style="">
					
                        <div class="row">
                            <div class="col-sm-12 col-lg-12 col-md-12">
                                <div class="form-group re-stripe">
                                    <span style="color:#black;font-weight:bold;">Create your Talent account with </span>
                                    <a class="popup-youtube"  href="video/Register_sign_video.mp4" target="_blank" style="color:#008cdd;font-weight: bold;">FutureStarr</a>
									<script>
$(function() {
    $('.popup-youtube').magnificPopup({
        disableOn: 700,
        type: 'iframe',
        mainClass: 'mfp-fade',
        removalDelay: 160,
        preloader: false,
        fixedContentPos: false
    });
});
</script>
                                </div>
                            </div>
                        </div>
						<!-- <div class="row">
                                <div class="col-sm-12 col-lg-12 col-md-12">
                                    <div class="form-group re-stripe" >
                                        <span style="color:black;font-weight: bold;">Already have stripe? Activate with FutureStarr</span>
                                        <a href="https://www.futurestarr.com/futuredev/connect" target="_blank" style="color:#ff503f;font-weight: bold;">Here</a>
                                    </div>
                                    <div style="font-weight: bold;" class="form-group re-stripe">
                                        <span class="text-success"><i class="fa fa-check-circle"></i>your stripe account connected</span>
                                    </div>
                                </div>
                            </div> -->
                        {!! Form::open(['route' => 'register']) !!}
                           <input type="hidden" name="role_id" value="4">
                                                       <div class="row">
                                <div class="col-sm-6 col-xs-12">
                                    <div class="form-group">
                                    {!! Form::text('firstname', old('firstname') , ['class' => 'form-control' . ($errors->has('firstname') && Session::has('seller') ? ' is-invalid' : ''),'placeholder'=>'First Name' ]) !!}
                                    @if ($errors->has('firstname') &&  Session::has('seller'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('firstname') }}</strong>
                                        </span>
                                    @endif
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    <div class="form-group">
                                    {!! Form::text('lastname', old('lastname') , ['class' => 'form-control' . ($errors->has('lastname') && Session::has('seller') ? ' is-invalid' : ''),'placeholder'=>'Last Name' ]) !!}
                                    @if ($errors->has('lastname') &&  Session::has('seller'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('lastname') }}</strong>
                                        </span>
                                    @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 col-xs-12">
                                    <div class="form-group">
                                    {!! Form::text('username', old('username') , ['class' => 'form-control' . ($errors->has('username') && Session::has('seller') ? ' is-invalid' : ''),'placeholder'=>'User Name' ]) !!}
                                    @if ($errors->has('username') &&  Session::has('seller'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('username') }}</strong>
                                        </span>
                                    @endif
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    <div class="form-group">
                                    {!! Form::email('email', old('email') , ['class' => 'form-control' . ($errors->has('email') && Session::has('seller') ? ' is-invalid' : ''),'placeholder'=>'Email' ]) !!}
                                     @if ($errors->has('email') &&  Session::has('seller'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 col-xs-12">
                                    <div class="form-group" data-tip="Please make password case sentive for security purpose.">
                                    {!! Form::password('password' , ['placeholder'=>'Password', 'class' => 'form-control' . ($errors->has('password') && Session::has('seller') ? ' is-invalid' : ''),'placeholder'=>'Password' ]) !!}
                                    @if ($errors->has('password') &&  Session::has('seller'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    <div class="form-group">
                                    {!! Form::password('password_confirmation' , ['placeholder'=>'Re-Type Password', 'class' => 'form-control' . ($errors->has('password_confirmation') && Session::has('seller') ? ' is-invalid' : ''),'placeholder'=>'Re-Type Password' ]) !!}
                                    </div>
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                        </span>
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    <div class="g-recaptcha" data-sitekey="6Lf4BwUTAAAAAFJibAut9uEkKIMp5jnc5K8838YV"></div>
                                    @error('g-recaptcha-response')
                                      <span class="invalid-feedback" role="alert">
                                        <strong>Please check on the reCAPTCHA box.</strong>
                                      </span>
                                    @enderror
                                 </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-lg-12 col-md-12">
                                        <button class="btn btn-danger btn-lg" type="submit" name="button" style="word-break: break-word;white-space: normal;line-height: 15px;font-size: 9.6px;">Create your FutureStarr Talent account</button>
                                  
                                </div>
                            </div>
                            
                            {!! Form::close()!!}
                    </div>
                    <div class="col-sm-4 col-xs-12  panel-part" style="">
					
					<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#help" style="color:#008cdd;font-weight: bold;color: white;
						font-weight: bold;
						background: #28A745;
						padding: 5px;
						border-radius: 5px;
						font-size: 20px;">Help?</button>
					
						 <div class="modal fade" id="help" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
       <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Seller register process. See below:</h4>
        </div>
        <div class="modal-body">
		<h4 style="font-size: 18px;
    font-weight: 400;
    background: #0D0434;
    padding: 8px;
    color: white;
    font-weight: bold;
    width:auto;
    border-radius: 5px;display:inline-block;"> A. New Stripe Users </h4>
          <p>	<b>Step 1</b>.  New Stripe User? 1st- Create an account with Stripe.<br/>
				<b>Step 2</b>.  Create new user account with FutureStarr. Sign In.<br/>
				<b>Step 3</b>. Click Dashboard-Upload Product-Create A Product-Connect Stripe account.<br/>
				<b>Step 4</b>. You are ready to earn! Start uploading your products for approval.</p>
				
				<a style="color:#008cdd;font-weight: bold;" class="popup-youtube_help"  href="video/Register_sign_video.mp4">See Video To get Help</a>
				
				<script>
$(function() {
    $('.popup-youtube_help').magnificPopup({
        disableOn: 700,
        type: 'iframe',
        mainClass: 'mfp-fade',
        removalDelay: 160,
        preloader: false,
        fixedContentPos: false
    });
});
</script>
				<br/><br/>
				<h4 style="font-size: 18px;
    font-weight: 400;
    background: #5f1119;
    padding: 8px;
    color: white;
    font-weight: bold;
    width:auto;
    border-radius: 5px;display:inline-block;"> B. Current Stripe Users </h4>
	
	 <p>	<b>Step 1</b>. Create new user account with FutureStarr. Sign In.<br/>
				<b>Step 2</b>.  Click Dashboard-Upload Product-Create A Product-Connect Stripe account.<br/>
				<b>Step 3</b>. You are ready to earn! Start uploading your products for approval.<br/>
				
        </div>
      
      </div>
      
    </div>
  </div>
	
	
						
                        <h1 class="text-left panel-second-half-heading register-panel" style="color:black;">What Seller can do?</h1>
                        <p>
                            <i class="fa fa-archive" aria-hidden="true"></i> Seller can create online store.</p>
                        <p>
                            <i class="fa fa-cloud-upload" aria-hidden="true"></i> Upload video or Audio sample.</p>
                        <p>
                            <i class="fa fa-comments" aria-hidden="true"></i> Send and receive messages from Buyers.</p>
                        <p>
                            <i class="fa fa-video-camera" aria-hidden="true"></i> Sell their products in digital format- pdf, jpeg, videos etc.
                        </p>
                        <p>
                            <i class="fa fa-credit-card-alt" aria-hidden="true"></i> Sell for free and receive up to 70% commission from each sell.</p>
                    </div>
                </div>
                <!-- second tab closed -->
            </div>
        </div>
    <div class="col-sm-2"></div>
</div>

<!-- Send Message Modal Start-->
<div class="modal fade" id="quick-reminder" role="dialog">
    <div class="modal-dialog">
        <form>
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Future Starr</h4>
                </div>
                <div class="modal-body">
                   <p style="padding-top: 30px !important;"> 
                    "Quick Reminder: FutureStarr is currently accepting Partners/Sellers based out the U.S. only. International users can sign up as a "Buyer" until further notice."
                   </p>
                </div>
                <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Send Message Modal End-->


@include('frontend.talent.login')
<a class="scroll-top-arrow" href="javascript:void(0);" style="display: inline;"><i  class="ti-arrow-up"></i></a>
 
@endsection 

