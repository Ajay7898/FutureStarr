@extends('layouts.talent') 
@section('title', 'Future Starr | Buyer Dashboard')

@section('content')

<style>
.account-info-section{
	    padding: 30px 0!important;
    background: #fff;
}
.heading-card-dd{
	    font-weight: 700!important;
    background: #ebebeb;
    padding: 10px;
}
.master-card-dd {
    display: flex;
    justify-content: space-between;
}
.master-card-dd div i {
	    color: #333333;
    font-size: 24px;
}
.cart-sec-new p:after {
	border: 2px solid grey;
	padding: 1px 7px 0 7px;
	font-family: 'FontAwesome';  
	content: "\f068";
	float: right; 
}
.cart-sec-new p.collapsed:after {
	border: 2px solid grey;
	padding: 1px 7px 0 7px;
	content: "\f067";
}
.cart-sec-new {
	position:relative;
    border: 1px solid #ccc;
	margin-bottom: 10px;
    padding: 10px 10px 3px 10px;
}
.cart-sec-new a:after {
    content: '';
    width: 100%;
    height: 1px;
    background: #ccc;
    display: block;
    position: absolute;
    left: 0;
    max-width: 100%;
    top: 47px;
}

.foot-buttons {
    float: right;
}
button.save-btn {
    border: 1px solid #c9302c;
    padding: 6px 30px;
    background: #fff;
    font-weight: 600;
}
button.conti-btn {
    border: 1px solid #c9302c;
    padding: 6px 30px;
    background: #c9302c;
	color:#fff;
    font-weight: 600;
}
.wd-50-dd {
    margin: 0;
}
.card-num {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 10px;
}
@media (min-width: 768px) {
.max-width-50{
	max-width:50%
}
}
.wd-50-dd select {
	    border: 1px solid #ccc;
    border-radius: 4px;
	padding: 6px 12px;
	    height: 34px;
    box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
}

</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!-- banner start -->
<section class="wow fadeIn cover-background account-info-section-banner" style="background-image:url({{ asset('assets/images/account-info.png')}});">
</section>
<!--SideBar-Start---->
<section class="account-info-section">
   <div class="container">
   <div class="row">
<div class="col-md-12 col-sm-12 col-xs-12 ">
         <h1>Billing & Payment</h1>
         
         <div class="cart-sec">
            <p>Due Balance <b>$0.00</b></p>
			<p class="heading-card-dd">Billing methods</p>
			
			<p>Primary</p>
			<div class="master-card-dd">
			 <div style="display: -webkit-inline-box;"><img src="http://127.0.0.1:8000/assets/images/cart/2.png" alt="Credit Card"><p style="margin-left:10px">Master card ending in 0645</p></div>
			 <div><a href=""><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></div>
			</div>
			
			<p>Additional</p>
			<div class="master-card-dd">
			 <div style="display: -webkit-inline-box;"><img src="http://127.0.0.1:8000/assets/images/cart/1.png" alt="Credit Card"><p style="margin-left:10px">Visa ending in 9862</p></div>
			 <div><a href=""><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></div>
			</div>	
			</div>	


			<div class="cart-sec" style="    padding: 20px 20px 10px 20px;">
			<p class="heading-card-dd">Add a billing method</p>
			<div class="cart-sec-new">
				<p data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample"><a class="btn-billing-method"><input type="radio" name="payment_method" style="width: auto;"> Bank account</a>
				</p>
				<div class="collapse" id="collapseExample">
				  <div class="card-body">
							<div class="form-row row">
							   <div class="col-xs-12 col-md-6 form-group wd-50-dd">
								  <label class="control-label">Account Holder</label> 
								  <input autocomplete="off" class="form-control card-cvc" placeholder="" size="4" type="text">
							   </div>
							   <div class="col-xs-12 col-md-6 form-group wd-50-dd">
								  <label class="control-label">Account Type</label>
								  <select>
								      <option value="Type1">Type 1</option>
									  <option value="Type2">Type 2</option>
									  <option value="Type3">Type 3</option>
									  <option value="Type4">Type 4</option>
								  </select>
							   </div>
							   <div class="col-xs-12 col-md-6 form-group wd-50-dd">
								  <label class="control-label">Routing Number</label> <input class="form-control card-expiry-year" placeholder="" size="4" type="text">
							   </div>                           
							   <div class="col-xs-12 col-md-6 form-group wd-50-dd">
								  <label class="control-label">Account Number</label> <input class="form-control card-expiry-year" placeholder="" size="4" type="text">
							   </div>							   
							   
							   <div class="col-xs-12 col-md-6 form-group wd-50-dd">
								  <label class="control-label">Note: Your payment information is stored securely</label> 
								  <img src="http://127.0.0.1:8000/assets/images/card-format.png" alt="Credit Card">
							   </div>
							</div>
				  </div>
				</div>
			</div>
			
			<div class="cart-sec-new">
				<p data-toggle="collapse" href="#collapseExample1" role="button" aria-expanded="false" aria-controls="collapseExample"><a class="btn-billing-method"><input type="radio" name="payment_method" style="width: auto;"> Payment Card</a>
				</p>
				<div class="collapse" id="collapseExample1">
				  <div class="card-body max-width-50">
							<div class="form-row row">
							   <div class="col-xs-12 col-md-12 form-group wd-50-dd">
								  <div class="card-num">
								  <div><label class="control-label required">Card Number</label></div>
									<div><img src="http://127.0.0.1:8000/assets/images/discover.png" alt="Credit Card">								  
									<img src="http://127.0.0.1:8000/assets/images/amex.png" alt="Credit Card">								  
									<img src="http://127.0.0.1:8000/assets/images/mastercard.png" alt="Credit Card">								  
									<img src="http://127.0.0.1:8000/assets/images/visa.png" alt="Credit Card"></div>	
									</div>									
								  <input autocomplete="off" class="form-control card-cvc" placeholder="" size="4" type="text">
							   </div>							   
							   
							   <div class="col-xs-12 col-md-6 form-group wd-50-dd">
								  <label class="control-label required">First Name</label> 
								  <input autocomplete="off" class="form-control card-cvc" placeholder="First Name" size="4" type="text">
							   </div>
					
							   <div class="col-xs-12 col-md-6 form-group wd-50-dd">
								  <label class="control-label required">Last Name</label>
								  <input class="form-control card-expiry-month" placeholder="Last Name" size="2" type="text">
							   </div>
							   
							   <div class="col-xs-12 col-md-6 form-group wd-50-dd">
								  <label class="control-label required">Expiration (MM/YY)</label> <input class="form-control card-expiry-year" placeholder="MM/YY" size="4" type="text">
							   </div>  
														   
							   <div class="col-xs-12 col-md-6 form-group wd-50-dd">
								  <label class="control-label required">Card Security Code</label> <input class="form-control card-expiry-year" placeholder="1453" size="4" type="text">
							   </div>							   
							</div>
				  </div>
				</div>
			</div>			

         </div>
		 <div class="foot-buttons">
			<button class="save-btn">Save</button>
			<button class="conti-btn">Continue</button>
		 </div>
        </div>
   </div>
</section>

@endsection


