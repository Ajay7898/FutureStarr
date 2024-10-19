	{{-- Start Shipping Address Modal Pop Up --}}
<div class="modal" id="shippingAddressModal">
	<div class="modal-dialog">
			<div class="modal-content">
			<div class="modal-header">
  				<h4 class="modal-title">Shipping Address</h4>
  				<button type="button" class="close" data-dismiss="modal">x</button>
			</div>
			<div class="modal-body">
   				<div class="sbm_addresstext">
			      	<form action="" method="POST" style="padding: 30px 0;" id="saveShippingAddress">
			      	 	@csrf
			      	 	<div class="form-group">
			      	 		<div class="row">
			      	 			<div class="col-md-7">
			      	 				<input type="text" name="name" class="form-control" placeholder="Full Name" value="{{ $cart->shipping_address->name ?? '' }}">
			      	 			</div>
			      	 			<div class="col-md-5">
			      	 				<input type="text" name="phone" class="form-control" placeholder="Phone Number" value="{{ $cart->shipping_address->phone ?? '' }}">
			      	 			</div>
			      	 		</div>				      	 		
			      	 	</div>
			      	 	<div class="form-group">
			      	 		<input type="text" name="address" class="form-control" placeholder="Address" value="{{ $cart->shipping_address->address ?? '' }}">
			      	 	</div>
			      	 	<div class="form-group">
			      	 		<input type="text" name="street" class="form-control" placeholder="Street" value="{{ $cart->shipping_address->street ?? '' }}">
			      	 	</div>
			      	 	<div class="form-group">
			      	 		<div class="row">
			      	 			<div class="col-md-6">
			      	 				<input type="text" name="city" class="form-control" placeholder="City" value="{{ $cart->shipping_address->city ?? '' }}">
			      	 			</div>
			      	 			<div class="col-md-6">
			      	 				<input type="text" name="state" class="form-control" placeholder="State" value="{{ $cart->shipping_address->state ?? '' }}">
			      	 			</div>
			      	 		</div>
			      	 	</div>
			      	 	<div class="form-group">
			      	 		<div class="row">
			      	 			<div class="col-md-6">
			      	 				<input type="text" name="country" class="form-control" placeholder="Country" value="{{ $cart->shipping_address->country ?? '' }}">
			      	 			</div>
			      	 			<div class="col-md-6">
			      	 				<input type="text" name="zipcode" class="form-control" placeholder="Zipcode" value="{{ $cart->shipping_address->zipcode ?? '' }}">
			      	 			</div>
			      	 		</div>
			      	 	</div>
			      	 	<button type="submit" class="btn btn-primary">Save</button>
			      	</form>
   				</div>
			</div>       
		</div>
	</div>
</div>  

{{-- Start Billing Address Modal Pop Up --}}
<div class="modal" id="billingAddressModal">
	<div class="modal-dialog">
  		<div class="modal-content">
    		<div class="modal-header">
      			<h4 class="modal-title">Billing Address</h4>
      			<button type="button" class="close" data-dismiss="modal">x</button>
    		</div>
    		<div class="modal-body">
       			<div class="sbm_addresstext">
      	 			<form action="" method="POST" style="padding: 30px 0;" id="saveBillingAddress">
			      	 	@csrf
			      	 	<div class="form-group">
			      	 		<div class="row">
			      	 			<div class="col-md-7">
			      	 				<input type="text" name="name" class="form-control" placeholder="Full Name" value="{{ $cart->billing_address->name ?? '' }}">
			      	 			</div>
			      	 			<div class="col-md-5">
			      	 				<input type="text" name="phone" class="form-control" placeholder="Phone Number" value="{{ $cart->billing_address->phone ?? '' }}">
			      	 			</div>
			      	 		</div>				      	 		
			      	 	</div>
			      	 	<div class="form-group">
			      	 		<input type="text" name="address" class="form-control" placeholder="Address" value="{{ $cart->billing_address->address ?? '' }}">
			      	 	</div>
			      	 	<div class="form-group">
			      	 		<input type="text" name="street" class="form-control" placeholder="Street" value="{{ $cart->billing_address->street ?? '' }}">
			      	 	</div>
			      	 	<div class="form-group">
			      	 		<div class="row">
			      	 			<div class="col-md-6">
			      	 				<input type="text" name="city" class="form-control" placeholder="City" value="{{ $cart->billing_address->city ?? '' }}">
			      	 			</div>
			      	 			<div class="col-md-6">
			      	 				<input type="text" name="state" class="form-control" placeholder="State" value="{{ $cart->billing_address->state ?? '' }}">
			      	 			</div>
			      	 		</div>
			      	 	</div>
			      	 	<div class="form-group">
			      	 		<div class="row">
			      	 			<div class="col-md-6">
			      	 				<input type="text" name="country" class="form-control" placeholder="Country" value="{{ $cart->billing_address->country ?? '' }}">
			      	 			</div>
			      	 			<div class="col-md-6">
			      	 				<input type="text" name="zipcode" class="form-control" placeholder="Zipcode" value="{{ $cart->billing_address->zipcode ?? '' }}">
			      	 			</div>
			      	 		</div>
			      	 	</div>
			      	 	<button type="submit" class="btn btn-primary">Save</button>
			      	</form>
       			</div>
    		</div>       
  		</div>
	</div>
</div>