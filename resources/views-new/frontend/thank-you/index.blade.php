@extends('layouts.talent') @section('content')
<!-- banner start -->

<style>
.navbar{
	background:#151829 !important;
}
.about-us-container {
    background-color: #fff !important;
    padding-top: 40px !important;
    padding-bottom: 0px !important;
    margin-top: 115px !important;
    margin-bottom: 35px !important;
    width: 50% !important;
    box-shadow: -1px 3px 24px -9px #333 !important;
}
.star-search-banner {
    width: 95% !important;
}
.thx h2{
	text-align:center;
	margin-top: 50px;
	font-family: 'Overpass', sans-serif;
    font-weight: bold;
	
}
.about-body{
	text-align:center;
	font-size: 18.5px !important;
	font-family: 'Overpass', sans-serif;
}
.lg{
	margin-top: 50px;
}

@media only screen and (min-width: 320px) and  (max-width: 567px) {
	.about-us-container {
    width: 80% !important;
}
.star-search-banner {
    width: 100%;
    /* min-height: 170px; */
}
}


</style>

  <div class="container about-us-container">
  <div class="row">
    <div style="z-index:1;" class="col-sm-12">
      <img class="star-search-banner" src="{{asset('assets/images/thankyoubg.png')}}"  alt="futurestarr artists"/>
    </div>
    <div style="padding:0px;background: linear-gradient(0deg, #d84435, #ffffff);
    margin-top: -29px;
    z-index: 0;" class="col-sm-12">
      <div class="col-sm-12 thx">
        <h2>Thank You For your purchase</h2>
        <p class="about-body">
         Log in to your account and download your item immediately.
        </p>
        <p class="about-body lg">
		 <img  src="{{asset('assets/images/flo.png')}}" width="350px"  alt="futurestarr artists"/>
        </p>
       
      </div>

    </div>
  </div>
</div>
<div class="container">
   <!-- Modal -->
   <div id="register_my_model" class="modal  modal-m" role="dialog">
      <div class="modal-dialog">
         <!-- Modal content-->
         <div class="modal-content">
            <div class="modal-header mob-cls" style="padding:5px;">
               <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" style=" position: relative; padding-top: 0px; padding-left: 15px; padding-right: 15px;padding-bottom: 0px;">
               <div class="row">
                  <div class="col-sm-5 text-center login-back" style="background-color:#fff;">
                     <h4 style="color:#ff503f;font-weight: 600;margin: 54px 0 0 0;">
                        Awe, looks like you have not 
                     </h4>
                     <h4 style="color:#ff503f;font-weight: 600;text-align: center;">signed up for Future Starr.</h4>
                     <p style="margin: 34px 0 0 0; text-align: center;"><b>No worries, click the Register</b></p>
                     <p style="text-align: center;"><b>button and sign up now for FREE!</b></p>
                     <a routerLink="/register" class="btn btn-danger" style="margin-bottom: 30px;" (click)="model_toggle()">Register</a>
                  </div>
                  <div class="col-sm-7 text-center login-back-img" style="height: 340px;background-image:url({{ asset('assets/images/new_pop_up.jpg')}});background-size:cover;background-position:left;">
                     <button type="button" class="close desk-cls" data-dismiss="modal">&times;</button>
                     <br><br><br><br><br><br>
                     <p style="color:#fff;"></p>
                     <h3 style="color:#fff;"></h3>
                     <p style="color:#fff;"></p>
                     <br><br>  <br><br><br><br><br>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<div class="container">
   <!-- Modal -->
   <div id="register_my_model1" class="modal  modal-m" role="dialog">
      <div class="modal-dialog">
         <!-- Modal content-->
         <div class="modal-content">
            <div class="modal-header mob-cls" style="padding:5px;">
               <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" style=" position: relative; padding-top: 0px; padding-left: 15px; padding-right: 15px;padding-bottom: 0px;">
               <div class="row">
                  <div class="col-sm-5 text-center login-back" style="background-color:#fff;">
                     <h4 style="color:#ff503f;font-weight: 600;margin: 54px 0 0 0;">
                        Awe, looks like you have not 
                     </h4>
                     <h4 style="color:#ff503f;font-weight: 600;text-align: center;">signed up for Future Starr.</h4>
                     <p style="margin: 34px 0 0 0; text-align: center;"><b>No worries, click the Register</b></p>
                     <p style="text-align: center;"><b>button and sign up now for FREE!</b></p>
                     <a routerLink="/register" class="btn btn-danger" style="margin-bottom: 30px;" (click)="model_toggle()">Register</a>
                  </div>
                  <div class="col-sm-7 text-center login-back-img" style="height: auto;background-image:url({{ asset('assets/images/new_pop_up.jpg')}});background-size:cover;background-position:left;">
                     <button type="button" class="close desk-cls" data-dismiss="modal">&times;</button>
                     <br><br><br><br><br><br>
                     <p style="color:#fff;"></p>
                     <h3 style="color:#fff;"></h3>
                     <p style="color:#fff;"></p>
                     <br><br>  <br><br><br><br><br>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection