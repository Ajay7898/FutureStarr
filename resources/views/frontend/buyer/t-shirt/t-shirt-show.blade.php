@extends('layouts.talent')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600;700&family=Play:wght@700&family=Russo+One&display=swap" rel="stylesheet">

<section class="wow fadeIn cover-background background-position-top top-space t-shirts-head" style="background-image: url({{ asset('/assets/images/tshirt/fututure_tsirt.jpg') }}); visibility: visible; animation-name: fadeIn;">
  <div class="opacity-medium bg-extra-dark-gray"></div>
  <div class="container">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12 display-table page-title-large">
        <div class="display-table-cell vertical-align-middle text-center padding-30px-tb">
          <!-- start page title -->
          <h1 class="alt-font text-white font-weight-700 mb-2">FUTURE STARR</h1>
          <!-- end page title -->
          <!-- start sub title -->
          <span class="display-block text-white alt-font">
          T-SHIRTS AVAILABLE</span>
          <!-- end sub title -->
        </div>
      </div>
    </div>
  </div>
</section>
<section class="t-shirts">
	<div class="container">
    <div class="row inner-t-s">
      <div class="col-md-7 col-sm-12">
        <div class="row">
        	<div class="col-md-6 col-sm-12">
        		<img class="p-img" src="{{ asset('/assets/images/tshirt/tshirt-front-left.png') }}">
        	</div>
        	<div class="col-md-6 col-sm-12">
        		<img class="p-img" src="{{ asset('/assets/images/tshirt/tshirt-back-right.png') }}">
        	</div>
        </div>
      </div>
      <div class="col-md-5 col-sm-12 col-xs-4 shirt-col-outer">
        <h2 class="head">{{ $product->name }}</h2>
        <p class="desc-h"><span class="font-weight-700">Details :</span> {{ $product->product_info }}</p>
        <p class="desc-h"><span class="font-weight-700">Product :</span> {{ $product->description }}</p>
        <p class="desc-h"><span class="font-weight-700">Price :</span><span class="t-shirt-price">{{ '$'.$product->price }}</span></p>
        <div class="swatch">
        	<div class="sel">
        		<p class="swa-head"><span class="font-weight-700">Select</span></p>
        		<ul class="swa-body swa-select">
                    @foreach($variant['gender'] as $gender)
            			<li>
            				<span data-gender="{{ $gender }}">{{ ucfirst($gender) }}</span>
            			</li>
                    @endforeach
        		</ul>
        	</div>
        	<div class="sel">
        		<p class="swa-head"><span class="font-weight-700">Choose Type</span></p>
        		<ul class="swa-body swa-neck">
                    @foreach($variant['type'] as $type)
                        @if($type == 'round_neck')
                            <li>
                                <span data-neck="{{ $type }}">
                                    <img src="{{ asset('/assets/images/tshirt/t-round-neck.png') }}">
                                </span>
                            </li>
                        @elseif($type == 'v_neck')
                            <li>
                                <span data-neck="{{ $type }}">
                                    <img src="{{ asset('/assets/images/tshirt/t-v-neck.png') }}">
                                </span>
                            </li>
                        @endif
                    @endforeach        			
        		</ul>
        	</div>
        	<div class="sel">
        		<p class="swa-head"><span class="font-weight-700">Color</span></p>
        		<ul class="swa-body swa-color">
                    @foreach($variant['color'] as $color)
                        <li>
                            <span class="black" style="background: {{ $color }} !important"  data-color="{{ $color }}"></span>
                        </li>   
                    @endforeach
        		</ul>
        	</div>
        	<div class="sel">
        		<p class="swa-head"><span class="font-weight-700">Select Size</span></p>
        		<ul class="swa-body swa-size">
                    @foreach($variant['size'] as $size)
            			<li>
            				<span data-size="{{ $size }}">{{ strtoupper($size) }}</span>
            			</li>   
                    @endforeach     			
        		</ul>
        	</div>
        </div>
        <div>
        	<button class="order-shirt" data-slug="{{ $product->id }}">Order Shirt</button>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection