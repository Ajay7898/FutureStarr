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