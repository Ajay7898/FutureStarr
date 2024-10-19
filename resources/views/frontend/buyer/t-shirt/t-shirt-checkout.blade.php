@extends('layouts.talent')

@section('content')

<style type="text/css">
	 .ts-checkout .checkout-heading{
		color: #1a68ab;
		font-size: 40px;
	    line-height: 40px;
	    margin: 0 0 25px;
	    padding: 0;
	    letter-spacing: 2;
	    font-weight:normal;
	   	font-family: Impact, fantasy!important;
	   
	}
	.ts-checkout .checkout-border{
		margin: 0 auto;
		width: 60px;
		border-bottom: 3px solid #1a68ab;
		margin-top:10px;
	}
	.ts-checkout{
		margin:0;
		padding: 30px 0!important;
		background-color: #f3f3f3;
	}
/*	.ts-checkout .shipment .shipmentdiv{
		width: 100%;
		border:1px solid #ddd;
		margin-bottom: 10px;
		padding: 5px;
		border-radius: 4px;
	}*/

	.ts-checkout .checkout-subheading{
		color: #000000;
		font-size: 20px;
	    line-height: 40px;
	    margin: 0 0 25px;
	    padding: 0;
	    font-weight: 600;
	    letter-spacing: 0;
	    font-family: Open Sans,sans-serif;
	}
/*	.ts-checkout .shipmentdiv p{
		font-size: 12px!important;
		font-weight: 600!important;
		color: gray!important;
		line-height: 1!important;
	}*/
	 .ts-checkout .cart_summarytext p{
		font-size: 14px!important;
		font-weight: 600!important;
		color: gray!important;
		
	}
	.ts-checkout .cart_summary p{
		font-size: 14px!important;
		font-weight: 500!important;
		color: gray!important;
	}
	.ts-checkout .sb_addresstext p{
		font-size: 14px!important;
		font-weight: 600!important;
		color: gray!important;
		line-height: 1!important;
	}
	.ts-checkout .payment_btn{
		background-color: #c9302c;
	    width: 100%; 
	    font-size: 12px; 
	    color: white;
	}

	.ts-checkout .cart_summarytext .summarytext_shift{
		margin-left: 95px;
	}
	.ts-checkout .cart_summarytext .summarytext_change{
		color:#5bc0de;
		font-size: 14px; 
		margin-right: 10px;
	}
	.ts-checkout .checkout_footer{
		height: 70px;
		width: 100%;
		background-color: #f5f4f4;
	}
	.ts-checkout .sbm_addresstext p{
		font-size: 16px!important;
		font-weight: 600!important;
		color: gray!important;
		line-height: 1!important;
	}

	.ts-checkout i.edit-address {
	    font-size: 16px;
	    margin-left: 5px;
	    color: #474747;
	    cursor: pointer;
	    padding: 5px;
	}
	.ts-checkout i.edit-address:hover{
		color:#c9302c;
	}
	.ts-checkout .shipping-info input.form-check-input{
    	width: 14px;
    	height: 14px;
	}
	.ts-checkout .shipping-info label{
	    padding-left: 30px;
	    font-size: 14px;
    	font-weight: 500;
    	line-height: 18px;
    	cursor: pointer;
	}
	.ts-checkout .shipping-info label span{
		display: block;
	}
	.ts-checkout .shipping-info .form-check{
		margin: 15px 0;
	    border: 1px solid #bbbbbb;
	    padding: 8px;
	    border-radius: 8px;
	}

	.ts-checkout .cart{
	    background: #fff;
	    box-shadow: 0px 2px 6px 2px #ddd;
    	padding: 15px 15px 30px 15px;
	}
	.ts-checkout .cart .subheading{
        font-size: 20px;
        margin-bottom: 30px !important;
    	/*border-bottom: 1px solid #999;*/
    	padding-bottom: 5px;
	}
    
	.ts-checkout .cart .item-detail{
		margin-top: 15px;
	}
	.ts-checkout .cart .item-detail h4{
		font-size: 18px;
	}
	.ts-checkout .cart .item-detail span{
		font-size: 15px;
	}
    
    .ts-checkout .check-side{
    	background-color: #ffffff;
    	box-shadow: 0px 2px 6px 2px #ddd;
    	padding: 15px 20px 20px 20px;
    }

    .ts-checkout .row.item-row:not(:last-child) {
	    margin-bottom: 30px;
	    border-bottom: 1px solid #dddddd;
	    padding-bottom: 30px;
	}
	.ts-checkout .row.item-row .pro-rm{
	    display: block;
	    padding: 0px 7px;
	    line-height: 20px;
	    border-radius: 4px;
	}
	.ts-checkout .add-addr{
	    text-transform: capitalize;
	    margin-top: 10px;
	    display: block;
	    color: #ff214f;
	}

	#shippingAddressModal .close, #billingAddressModal .close{
	    position: absolute;
    	top: 0;
	}
	#shippingAddressModal .btn-primary, #billingAddressModal .btn-primary{
		display: block;
	    margin-left: auto;
	    padding: 3px 10px !important;
	    font-size: 13px;
	    font-weight: 500;
	}
	/* Media Query */

	@media screen and (max-width: 769px) {
	  .ts-checkout .cart_summarytext .summarytext_shift {
	       margin-left: 0px!important; 
	  }
	 .ts-checkout .cart_summarytext .summarytext_change {
	 		margin-right: 0px;
	 }
	 .ts-checkout .cart_summary .product_total{
	 	margin-top: 34px;
	 }
	}
	@media screen and (max-width: 400px){
		.ts-checkout .cart_summarytext, .cart_summary{
			width: 50%;
		}
		.ts-checkout .cart_summary .product_total {
            margin-top: 0px; 
		}
	}
	

</style>


{{-- <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600;700&family=Play:wght@700&family=Russo+One&display=swap" rel="stylesheet"> --}}

<section class="wow fadeIn cover-background background-position-top top-space t-shirts-head" style="background-image: url({{ asset('/assets/images/tshirt/fututure_tsirt.jpg') }}); visibility: visible; animation-name: fadeIn;">
  	<div class="opacity-medium bg-extra-dark-gray"></div>
  	<div class="container">
    	<div class="row">
	      	<div class="col-md-12 col-sm-12 col-xs-12 display-table page-title-large">
	        	<div class="display-table-cell vertical-align-middle text-center padding-30px-tb">
	          <!-- start page title -->
	          		<h1 class="alt-font text-white font-weight-700 mb-2">CHECKOUT</h1>
	          <!-- end page title -->
	          <!-- start sub title -->
	          {{-- <span class="display-block text-white alt-font"> --}}
	          {{-- T-SHIRTS AVAILABLE</span> --}}
	          <!-- end sub title -->
	        	</div>
	      	</div>
	    </div>
  	</div>
</section>

<section class="ts-checkout">
	<div class="container">
    	<div class="row">
    		<div class="col-md-8">    		
		      	<div class="row" style="margin-bottom: 30px;">
		      		<div class="col-md-6 col-sm-6 sb_addresstext">
				      	<h2 class="checkout-subheading">Shipping Address 
				      		@if($cart->shipping_address != null)
				      		<i class="fa fa-pencil edit-address" aria-hidden="true" data-toggle="modal" data-target="#shippingAddressModal"></i>
				      		@endif
				      	</h2>
				      	@if($cart->shipping_address == null)
				      		<a href="javascript:void(0)" data-toggle="modal" data-target="#shippingAddressModal" class="add-addr">Add shipping address</a>
				      	@else
				      		<div class="chshaddr">
				      			<p>{{ $cart->shipping_address->name }}</p>
						      	<p>{{ $cart->shipping_address->address .', ' .$cart->shipping_address->street }}</p>
						      	<p>{{ $cart->shipping_address->city .', '. $cart->shipping_address->state}}</p>
						      	<p>{{ $cart->shipping_address->country.' ('.$cart->shipping_address->zipcode.')' }}</p>
						      	<p>{{ 'phone - '.$cart->shipping_address->phone }}</p>
				      		</div>	
				      	@endif
				      	      	 
			      	</div>
			      	<div class="col-md-6 col-sm-6 sb_addresstext">
				      	<h2 class="checkout-subheading">Billing Address 
				      		@if($cart->billing_address != null)
				      		<i class="fa fa-pencil edit-address" aria-hidden="true" data-toggle="modal" data-target="#billingAddressModal"></i>
				      		@endif
			      		</h2>
				      	@if($cart->billing_address == null)
				      		<a href="javascript:void(0)" data-toggle="modal" data-target="#billingAddressModal" class="add-addr">Add billing address</a>
				      	@else
				      		<div class="chbladdr">
				      			<p>{{ $cart->billing_address->name }}</p>
						      	<p>{{ $cart->billing_address->address .', ' .$cart->billing_address->street }}</p>
						      	<p>{{ $cart->billing_address->city .', '. $cart->billing_address->state}}</p>
						      	<p>{{ $cart->billing_address->country.' ('.$cart->billing_address->zipcode.')' }}</p>
						      	<p>{{ 'phone - '.$cart->billing_address->phone }}</p>
				      		</div>	
				      	@endif
			      	</div>
		      	</div>	      	
		    	<div class="cart">
		    		<h2 class="subheading">Cart Item</h2>
		    		@foreach($variants as $variant)
    				<div class="row item-row">
    					<div class="col-md-2 col-sm-6">
			        		<img class="p-img" src="{{ asset('/assets/images/tshirt/tshirt-front-left.png') }}">
			        	</div>
			        	<div class="col-md-2 col-sm-6">
			        		<img class="p-img" src="{{ asset('/assets/images/tshirt/tshirt-back-right.png') }}">                   
			        	</div>
			        	<div class="col-md-8 col-sm-12">			        		
			        		<div class="row">
			        			<div class="col-md-7 item-detail">
			        				<h4>{{ $variant->product->name }}</h4>
			        				<span>Size - {{ strtoupper($variant->size) }}</span>
			        				<span>Color - <span style="width: 12px; border:1px solid #bbbbbb; display: inline-block; height: 12px; background-color: {{ $variant->color }}"></span></span>
			        				<button type="button" data-sku="{{ $variant->sku }}" class="btn btn-danger btn-sm pro-rm">Remove</button>
			        			</div>
			        			<div class="col-md-2 col-xs-4 item-detail">
			        				<span>1</span>
			        			</div>
			        			<div class="col-md-3 col-xs-4 item-detail">
			        				<span>$ {{ $variant->product->price }}</span>
			        			</div>
			        		</div>
			        	</div>
    				</div>
    				@endforeach
		    	</div>
		    </div>
		    <div class="col-md-4">
		    	<div class="check-side">
			    	<div class="shipping-info">
			    		@foreach($shipping as $ship)
			    			@if($ship->id == $cart->shipping_id)
		    		    		<div class="form-check" style="background-color: rgb(245, 244, 244); border: 1px solid rgb(201, 48, 44); font-weight: 600;">
		    		    			<input type="radio" name="shipping" data-sid="{{$ship->id}}" id="shipping{{$ship->id}}" class="form-check-input ch-ship" checked>
		    		    			<label class="form-check-label" for="shipping{{$ship->id}}">
			    		    			<span>{{ $ship->name }} - ${{ $ship->price }}</span>
			    		    			<span>{{ $ship->details }}</span>
			    		    		</label>
		    		    		</div>
	    		    		@else
	    		    			<div class="form-check">
		    		    			<input type="radio" name="shipping" id="shipping{{$ship->id}}" class="form-check-input ch-ship" data-sid="{{$ship->id}}">
		    		    			<label class="form-check-label" for="shipping{{$ship->id}}">
			    		    			<span>{{ $ship->name }} - ${{ $ship->price }}</span>
			    		    			<span>{{ $ship->details }}</span>
			    		    		</label>
		    		    		</div>
	    		    		@endif	    		    		
	    		    	@endforeach
			    	</div>
			    	<div class="checkout-sec">
			    		<h2 class="checkout-subheading">Cart Summary</h2>	      	 
			      	 	<div class="row">
			      	 		<div class="col-md-6 col-sm-6 col-xs-6 cart_summarytext">
				      	 		<p class="summarytext_shift">Subtotal</p>
						      	<p class="summarytext_shift">Shipping</p>
						      	<p class="summarytext_shift">Est.Tax</p>
						      	<p class="summarytext_shift">Total</p>
				      	 	</div>
				      	 	<div class="col-md-2 col-sm-4 col-xs-4 cart_summary">
				      	 		<p>${{ $cart->subtotal }}</p>
				      	 		<p>${{ $cart->shipping }}</p>
				      	 		<p>${{ $cart->tax }}</p>
				      	 		<p class="product_total">${{ $cart->total }}</p>
				      	 	</div>		      	 		
				      	</div>
				      	<button class="btn payment_btn">Go To Payment&nbsp;<span style="font-size: 24px;"><i class="fa fa-angle-right"></i></span></button>	
			    	</div>
			    </div>
		    </div>		
	    </div>
  	</div>

  	@include('frontend.buyer.t-shirt.address')

</section>
@endsection