<style>
  .modal-body.lmsbo{
   padding: 0px;
 }
 .modal-dialog.login-model-sec{
   width: 80%;
   margin-top: 130px;
 }
 .modal-dialog.login-model-sec .modal-body .login-back h3 {
  color: #ff503f!important;
  font-weight: 800;
  font-size: 24px;
  text-align: left!important;
  margin: 20px 0 10px!important;
}
.login-back .input-group-addon:first-child {
  border-radius: 5px;
  border: 1px solid #ff503f;
  background: #ff503f;
}
.login-back i.fa.fa-user.fa, i.fa.fa-lock.fa-lg {
  color: #fff;
  font-size: 18px;
}
.login-back i.fa.fa-user.fa, i.fa.fa-lock.fa-lg {
  color: #fff;
  font-size: 18px;
}
.login-back .checkbox {
  color: #fff;
}
.checkbox input[type=checkbox], .checkbox-inline input[type=checkbox], .radio input[type=radio], .radio-inline input[type=radio] {    
  margin-left: -145px;
}
.fgpass {
  color: #ff503f;
  margin-left: 12px;
  font-size: 12px;
  font-weight: 400;
}
.login-back p.text-center {
  color: white !important;
  font-weight: 400;
}
.login-foooter-box span a i {
  display: inline-block;
  border-radius: 60px;
  box-shadow: 0 0 2px #888;
  background: white;
  padding: 12px;
  width: 40px;
  color: #ff503f;
  font-size: 17px;
}
.login-right-sec p {
  color: #fff;
  font-weight: 400;
}
.login-back-img1 {   
  height: 415px;
  background-size: cover;
  background-position: center;
}
.ms-datai ul li a.active {
  border-bottom: 2px solid #ff503f;
  background: #fff;
}
.ms-datai ul li a.active i {
  color: #ff503f;
}
</style>
<style>
  @media (max-width: 950px) {

   .navbar>.container, .navbar>.container-fluid {
    justify-content: flex-start!important;
  }
  .navbar-header {
    float: left!important;
  }
  .navbar-left,.navbar-right {
    float: none !important;
  }
  .sm-logo {
    margin: 1px!important;
  }
  .navbar-toggle {
    display: block!important;
  }
  button.navbar-toggle {
   float: left!important;
 }
 .navbar-collapse {
  border-top: 1px solid transparent;
  box-shadow: inset 0 1px 0 rgba(255,255,255,0.1);
}
.navbar-fixed-top {
  top: 0;
  border-width: 0 0 1px;
}
.navbar-collapse.collapse {
  display: none;
}
.navbar-nav {
  float: none!important;
  margin-top: 30px;
}
.navbar-nav>li {
  float: none!important;
}
.navbar-nav>li>a {
  padding-top: 10px;
  padding-bottom: 10px;
}
.collapse.in{
  display:block !important;
}
}
</style>

@include('home-page-css')
@php $site_config = site_config() @endphp
<nav class="navbar navbar-inverse fixed-top">
 @if (Auth::guest())
 <div class="container top-bg">
  <div class="container">
   <div class="row">
    <div class="col-sm-12">
     <ul class="social-media">
      <li>
       <a href="{{ $site_config->facebook }}" target="_blank" data-toggle="tooltip" title="Facebook">
         <i class="fab fa-facebook-f"></i>
       </a>
     </li>
     <li>
       <a href="{{ $site_config->twitter }}" target="_blank" data-toggle="tooltip" title="Twitter">
         <i class="fab fa-twitter"></i>
       </a>
     </li>
     <li>
       <a href="{{ $site_config->youtube }}" target="_blank" data-toggle="tooltip" title="Youtube">
         <i class="fab fa-youtube"></i></a>
       </li>
       <li>
         <a href="javascript:void(0)" data-toggle="modal" data-target="#login">Login</a>
       </li>
       <li style="color:#ffffff;">/</li>
       <li>
         <a href="{{ route('register') }}">Register</a>
       </li>
     </ul>
   </div>
 </div>
</div>
</div>
@endif
<!--if remove the above container than add (.top-cls:50px;) using jquery or to add this class and remove above top-bg class for seller module-->
<div class="container-fluid h-font nmbar">
  <div class="navbar-header">
   <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
     <span class="icon-bar"></span>
     <span class="icon-bar"></span>
     <span class="icon-bar"></span>
   </button>
   @if(Auth::check()==true)
   @php $className ='navbar-brand header-login-sec'; @endphp
   @else
   @php $className = 'navbar-brand'; @endphp
   @endif
   <a class="{{$className}}" href="/" title="Future Starr">
     <img class="img-responsive sm-logo" alt="futurestarr logo" src="{{ asset('assets/images/futurelogo.png')}}" />
   </a>
 </div>
 <div class="collapse navbar-collapse" id="myNavbar">
   <ul class="nav navbar-nav navbar-right">
    <li class="{{ Route::currentRouteName() == 'home' ? 'active' : '' }}">
     <a href="{{URL::to('/')}}" title="Entertainment Career, community">
      <div class="header-icon">
       <img class="fa-icon-font" alt="futurestarr home" src="{{ asset('assets/images/home/home.png')}}">
     </div>
     HOME
   </a>
 </li>
            <!-- <li data-toggle="collapse" data-target="#myNavbar">
               <a style="margin-top: 11px">
                   <div class="header-icon dashbord-icon"><i class="fa fa-dashboard fa-icon-font"></i></div>
                   STARR SEARCH</a>
                <a style="margin-top: 11px">
                   <div class="header-icon dashbord-icon"><i class="fa fa-dashboard fa-icon-font"></i></div>
                   DASHBOARD</a>

                 </li> -->
                 @if (!Auth::guest())
                 @if(auth::user()->role_id =='3')
                 @php $route = route('buyer.dashboard') @endphp
                 @endif
                 @if(auth::user()->role_id =='4')
                 @php $route = route('seller.index') @endphp
                 @endif
                 @if(auth::user()->role_id =='1')
                 @php $route = route('admin.dashboard') @endphp
                 @endif
                 <li class="{{ Route::currentRouteName() == $route  ? 'active' : '' }}">
                   <a href="{{$route}}">
                    <div class="header-icon"><img class="fa-icon-font" alt="futurestarr dashboard" src="{{ asset('assets/images/home/dashboard.png')}}">
                    </div>
                    DASHBOARD
                  </a>
                </li>
                @endif
                <li class="{{ Route::currentRouteName() == 'search.index'  ? 'active' : '' }}">
                 <a href="{{ route('search.index')}}" title="Future Starr, Tattoo Artists">
                  <div class="header-icon"><img class="fa-icon-font" src="{{ asset('assets/images/home/starr_s.png') }}" alt="star icon"></div>
                  STARR SEARCH
                </a>
              </li>
              <li class="{{ Route::currentRouteName() == 'talent.index'  ? 'active' : '' }}">
               <a href="{{ route('talent.index')}}" title="Sign up, Future Starr, model photos, music songs, educational courses, fitness tips">
                <div class="header-icon"><img class="fa-icon-font" src="{{ asset('assets/images/home/tallent_m.png') }}" alt="tallent"></div>
                TALENT MALL
              </a>
            </li>
            <li class="{{ Route::currentRouteName() == 'social-buzz.index'  ? 'active' : '' }}">
             <a href="{{ route('social-buzz.index')}}" >
              <div class="header-icon">
                <img class="fa-icon-font" alt="social icon" src="{{ asset('assets/images/home/social_b.png') }}" alt="social icon">
              </div>
              SOCIAL BUZZ
            </a>
          </li>
          <li class="{{ Route::currentRouteName() == 'blog.index'  ? 'active' : '' }} || {{ Route::currentRouteName() == 'blog.detailed'  ? 'active' : '' }}">
           <a href="{{ route('blog.index')}}" >
            <div class="header-icon"><img class="fa-icon-font" src="{{ asset('assets/images/home/blog.png') }}" alt="blog"></div>
            BLOG
          </a>
        </li>
        <li class="{{ Route::currentRouteName() == 'contact-us.index'  ? 'active' : '' }}">
         <a href="{{ route('contact-us.index')}}" >
          <div class="header-icon"><img class="fa-icon-font" src="{{ asset('assets/images/home/contact.png') }}" alt="blog"></div>
          CONTACT US
        </a>
      </li>

      <li style="background: #FF503F;
      margin-top: 8px;
      padding: 0px;
      border-radius: 2px;display:none;" class="{{ Route::currentRouteName() == 'contact-us.index'  ? 'active' : '' }}">
      <a style="padding: 5px 10px 5px 10px;display:none;"  href="{{ route('contact-us.index')}}" >
        <div class="header-icon"></div>
        <i class="fa fa-shopping-cart" aria-hidden="true"></i> &nbsp 00
      </a>
    </li>
            <!--   <li style="display: flex;padding-top: 6px">
               <span>
                   <input class="superSearch search-filter" type="text" placeholder="Start typing to search.." id="#navbar-search" />
               </span>
               <a class="search-filter" style="padding-top: 10px; font-size: 16px;"  data-toggle="tooltip" title="Search">
                   <span class="glyphicon glyphicon-search search-icon"></span>
               </a>
             </li> -->
             @if(Auth::check()==true && Auth::user()->role_id =='3')
             <li>
               <span>
                 <a data-toggle="tooltip" title="Shopping Cart"  class="btn btn-danger btn-sm b-btn cart-btn" href="{{ route('cart.index')}}">
                   <span class="cart-count">{{ cartCount(Auth::user()->id) }}</span>
                   <span class="glyphicon glyphicon-shopping-cart"></span>
                 </a>
               </span>
             </li>
             @endif
             @if (!Auth::guest() && Auth()->user()->role_id !='1')
             <li>
               <a class="dropdown-margin" role="button" data-toggle="dropdown">

                <div class="header-icon he-ic">
                 @if(!empty(Auth::user()->profile_pic) && file_exists(Auth::user()->profile_pic))
                 <img class="fa-icon-font" src="{{asset(Auth::user()->profile_pic)}}" alt="star icon" style="border-radius: 50%; height: 23px; padding: 0px 0px 0px 0;object-fit: cover;">
                 @else
                 <img class="fa-icon-font" src="{{asset('assets/images/home/starr_s.png')}}" alt="star icon">
                 @endif
               </div>
               my Account
               <span class="caret"></span>
               <ul class="dropdown-menu seller-menu">

                 @if(Auth::user()->role_id == '4')
                 @php $manage_profile_link =  route('seller.public.profile') @endphp
                 @else
                 @php $manage_profile_link =  route('buyer.public.profile') @endphp
                 @endif

                 <li data-toggle="collapse" data-target="#myNavbar">
                  <a role="button" href="{{ $manage_profile_link }}">Manage Public Profile</a>
                </li>

                <li data-toggle="collapse" data-target="#myNavbar">
                 <a role="button" href="{{route('user.delete-account')}}">Delete Account</a>
               </li>
               @if(Auth::user()->role_id =='3')
               <li data-toggle="collapse" data-target="#myNavbar">
                 <a role="button" href="{{ route('buyer.edit')}}">Account Info</a>
               </li>
               <li data-toggle="collapse" data-target="#myNavbar">
                 <a role="button" href="{{ route('buyer.billing.account')}}">Billing Account</a>
               </li>
               <li data-toggle="collapse" data-target="#myNavbar">
                 <a role="button" href="{{route('buyer.changePassword')}}">Security</a>
               </li>

               @else
               <li data-toggle="collapse" data-target="#myNavbar">
                 <a role="button" href="{{ route('seller.edit')}}">Account Info</a>
               </li> 

               <li data-toggle="collapse" data-target="#myNavbar">
                 <a role="button" href="{{route('seller.changePassword')}}">Security</a>
               </li>
               @endif

               @if(!Auth::guest())
               <li>
                 <a  href="{{ route('logout') }}"  onclick="event.preventDefault();  document.getElementById('logout-form').submit();"> {{ __('Logout') }} </a>
                 <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
                </form>
              </li>
              @endif

            </ul>
          </li>
          @endif
        </ul>
      </div>
    </div>
  </nav>
  <!-- <button id="showLoginBox"></button> -->
  <!-- login User Modal Start-->

  <div class="modal fade report-user" id="login" role="dialog" data-keyboard="false" data-backdrop="static">
   <div class="modal-dialog login-model-sec">
    <form class="login-mobile" method="post" onsubmit="LoginUser(event)">
     <!-- Modal content-->
     <div class="modal-content">
      <div class="modal-header clo">
       <button type="button" class="close" data-dismiss="modal">X</button>
       <h4 class="modal-title" >Login</h4>
     </div>
     <div class="modal-body lmsbo">
       <div class="">
        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 login-back">
         <h3 class="register-panel text-center mb-2" style="color:#fff;"> Login </h3>
         <span id="cred_error"></span>
         <form id="login-form">
          <input type="hidden" name="role_id" value="3">
          <div class="input-group" style="margin-bottom:8px;">
            <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
            {!! Form::text('email', old('email') , ['class' => 'form-control' . ($errors->has('email') ? ' is-invalid' : ''),'placeholder'=>'User name OR Email' ]) !!}
            <span class="invalid-feedback" id="email" role="alert"></span>
          </div>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
            <input type="password" class="form-control" name="password" required placeholder="Password">
            <span class="invalid-feedback" id="password" role="alert"></span>
          </div>
          <div class="row">
            <div class="col-sm-7 col-md-7 col-xs-7 no-padding-right">
              <div class="fom-inline">
                <div class="checkbox">
                  <label style="font-size:12px;">
                    {!! Form::checkbox('remember', old('remember') , ['class' => 'form-check-input' ]) !!} Remember Password</label>
                  </div>
                </div>
              </div>
              <div class="col-sm-5 col-md-5 col-xs-5 no-padding">
                <div class="fom-inline">
                  <div class="checkbox">
                    <a class="fgpass" href="javascript:void(0)" onclick="openForgetPasswordModal();">
                      {{ __('Forgot Password?') }}
                    </a>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div  class="col-sm-12">
                <button class="btn btn-danger btn-sm login-button" type="submit" id="login-button">LOG IN</button>
              </div>
              <div class="col-sm-12" id='loader' style='display: none;'>
                <button  class="btn btn-primary" type="button" disabled >
                  <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                  Just a sec
                </button>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12">
                <br>
                <p class="text-center" style="color:#151829;">Sign In with</p>
                <div class="text-center login-foooter-box">
                  <span style="cursor: pointer;">
                    <a data-toggle="tooltip" title="Facebook" href="{{ route('facebook') }}">
                      <i class="fa fa-facebook"></i>
                    </a>
                  </span>
                  <span  style="cursor: pointer;">
                    <a data-toggle="tooltip" title="Twitter" href="{{ route('twitter') }}">
                      <i class="fa fa-twitter"></i>
                    </a>
                  </span>
                  <span style="cursor: pointer;">
                    <a data-toggle="tooltip" title="LinkedIn" href="{{ route('linkedin') }}">
                      <i class="fa fa-linkedin"></i>
                    </a>
                  </span>
                </div>
              </div>
            </div>
            {!! Form::close()!!}
          </div>
          <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 text-center login-back-img1">
            <button _ngcontent-c5="" class="close desk-cls" data-dismiss="modal" type="button">X</button>
      <!--<div class="login-right-sec">
      <p>Welcome to</p>
      <h3>FutureStarr</h3>
      <p>The Official Talent Marketplace</p>
    </div>-->
  </div>
</div>
</div>
</div>
</form>
</div>
</div>


<div id="forgotPasswordModal" class="modal fade" role="dialog" data-keyboard="false" data-backdrop="static">
 <div class="modal-dialog modal-forgot">
  <!-- Modal content-->
  <div class="modal-content">
   <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">X</button>
    <h4 class="modal-title fgpass-tit">Forgot password</h4>
  </div>
  <div class="modal-body">
    <div class="well">
     <form>
      <div class="form-group">
       <label class="control-label col-sm-2 offset-2">Email:</label>
       <div class="col-sm-7">
        <input type="email" class="form-control" id="forget_email" name="email" placeholder="enter email address">
      </div>
    </div>
    <div class="text-center">
     <button type="button" class="btn btn-danger" onclick="forgotPassword();">Submit</button>
   </div>
 </form>
 <br>
</div>
</div>
</div>
</div>
</div>
@if(!empty(Auth::check()))
<div id="profile-imageModal" class="modal fade" role="dialog" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Change Profile Picture</h4>
      </div>
      <div class="modal-body">

       @if(Auth::user()->profile_pic !='' && file_exists(Auth::user()->profile_pic))
       @php $profileImage = Auth::user()->profile_pic @endphp
       @else
       @php $profileImage = 'assets/images/seller/b-acount.png' @endphp
       @endif

       <img id="profile-image" src="{{asset($profileImage)}}">
       <span id="image-error" class="text-danger"></span>
       <form method="post" id="upload_form" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
         <label>Upload Profile Picture <i class="text-p"><span class="text-danger">(jpeg,jpg,png)</span></i></label>
         <div class="file-upload">
          <div class="file-select">
           <div class="file-select-button" id="fileName2">Browse</div>
           <div class="file-select-name" id="noFile2">No file selected</div>
           {!! Form::file('profile_pic', ['id' => 'profile_pic']) !!}
         </div>
       </div>
       {!! $errors->first('profile_pic', '<span class="alert alert-danger" role="alert">:message</span>') !!}
     </div>
     <input type="submit" name="submit" value="save" class="pi-btn">
   </form>
 </div>
</div>
</div>
</div>
@endif
@php $routeSegment= Request::segment(1); @endphp

@if(!empty(Auth::check()) && $routeSegment =='buyer')
<div class="modal fade trophy-mod myModal-share" id="account_change_modal" role="dialog" data-keyboard="false" data-backdrop="static">
 <div class="modal-dialog">
  <div class="modal-content buyer-form">
   <div class="modal-header">

    <h4 class="modal-title">FutureStarr - Account Confirmation</h4>
  </div>
  <div class="modal-body">
    All the information related to buyer and seller account.
  </div>
  <div class="modal-footer sec-btn">
   <a href="javascript:void(0)" onclick="openNextTab()">Next</a>
 </div>
</div>

</div>
</div>

<div class="modal fade trophy-mod myModal-share" id="account_change_modal1" role="dialog" data-keyboard="false" data-backdrop="static">
 <div class="modal-dialog">
  <div class="modal-content buyer-form">
   <div class="modal-header">
    <h4 class="modal-title">FutureStarr - Account Confirmation</h4>
  </div>
  <div class="modal-body">
    Would you like to continue with buyer account or seller?
    Please check an account to continue the service with FutureStarr.
    <div class="share-link-modal">
     <ul>
      <li>
       <a data-id="3" data-name="buyer" class="change_account"><i class="fa fa-user" aria-hidden="true"></i> Buyer</a>
     </li>
     <li>
       <a data-id="4" data-name="seller" class="change_account"><i class="fa fa-address-book" aria-hidden="true"></i> Seller</a>
     </li>
   </ul>
 </div>
</div>
<div class="modal-footer sec-btn">
 <a href="javascript:void(0)" onclick="openPrevousTab()">Prevous</a>
 <a href="{{route('home')}}">Explore Futurestarr</a>
</div>
</div>

</div>
</div>
@endif
<div class="modal fade trophy-mod myModal-share" id="information_modal" role="dialog" data-keyboard="false" data-backdrop="static">
 <div class="modal-dialog">
   <div class="modal-content buyer-form">
     <div class="modal-header">

      <h4 class="modal-title">Create Page Information</h4>
    </div>
    <div class="modal-body">
      <p><strong style="font-size:20px !important;"> To use this feature please register as Seller.</strong></p>
      <p>Already have seller account.Login using seller details.</p>
    </div>
    <div class="modal-footer sec-btn">
      <a href="#" data-dismiss="modal">Cancel</a>
    </div>
  </div>

</div>
</div>

<div class="container">
 <!-- Modal -->
 <div id="register_my_model" class="modal  modal-m pop" role="dialog">
  <div class="modal-dialog">
   <!-- Modal content-->
   <div class="modal-content">
    <div class="modal-header mob-cls">
     <button type="button" class="close" data-dismiss="modal">&times;</button>
   </div>
   <div class="modal-body">
     <div class="row">
      <div class="col-sm-5 text-center login-back">
       <h4 class="mo-sign-awe">
        Awe, looks like you have not
      </h4><br/>
      <h4 class="mo-sign-fr">signed up for Future Starr.</h4>
      <p class="mo-now"><b>No worries, click the Register</b></p>
      <p class="mo-now-fr"><b>button and sign up now for FREE!</b></p>

      <a href="{{route('register')}}" class="btn btn-danger reg-mod" (click)="model_toggle()">Register</a>
      <div class="text-center aha">
        <span> Already have account? <a href="javascript:void(0)" class="cursor-pointer lohere" onclick="openLoginModal();" >login here</a>
        </span>
      </div>
    </div>
    <div class="col-sm-7 text-center login-back-img">
     <button type="button" class="close desk-cls" data-dismiss="modal">&times;</button>
     <br><br><br><br><br><br>
     <p class="closer-dataa"></p>
     <h3 class="closer-datab"></h3>
     <p class="closer-datac"></p>
     <br><br>  <br><br><br><br><br>
   </div>
 </div>
</div>
</div>
</div>
</div>
</div>


<div class="modal fade" id="seller-dashboard-award-modal" role="dialog" data-keyboard="false" data-backdrop="static">
 <div class="modal-dialog">
  @php $userId = !empty(Auth::user()->id)?Auth::user()->id:''; @endphp
  <div class="modal-content buyer-form">
   <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h5 class="pull-right">
      <i class="fa fa-trophy bftro"></i>
      <span>({{getSellerTalentAward($userId) }})</span>&nbsp;Awards
    </h5>

    <h4 class="modal-title">Awards</h4>
  </div>
  <div class="modal-body bfmb">
   @php $awards = getSellerTalentAwardPopUpModal($userId) @endphp
   @if(!empty($awards))
   @foreach($awards as $value)
   <div class="pop-content">
    @if(!empty($value->getUsers['profile_pic']) && file_exists($value->getUsers['profile_pic']))
    <img  class="circular img-40" src="{{ asset($value->getUsers['profile_pic'])}}" alt="profile_pic">
    @else
    <img  class="circular img-40" src="{{asset('assets/images/profile.png')}}" alt="profile-image">
    @endif

    <div class="content-sec-pop">
     <h6> {{$value->getUsers['first_name']}}&nbsp;{{$value->getUsers['last_name']}}</h6>
   </div>
 </div>

 @endforeach
 @else

 <h5>No awards yet!</h5>

 @endif
</div>

</div>

</div>
</div>
