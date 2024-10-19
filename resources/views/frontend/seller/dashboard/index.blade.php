@extends('layouts.talent') @section('content')
<style>
.buyer-acont img {
    border-radius: 50%;
    object-fit: cover;
    object-position: top center;
    width: 150px!important;
    height: 150px;
}
</style>
<div id="seller-header">
   <div id="sub-header" class="container-fluid">
      <div class="row">
         <div class="col-sm-12 top-cls top-cls-l"></div>
      </div>
   </div>
</div>
<!--<hr style="margin-top:0px;">-->
<section class="buyer-con-section">
   <div class="container">
      <div class="row">
        
          @include('frontend.sidebar.seller')
          
         <div class="col-md-8 col-sm-8 col-xs-12 seller-graph-sec">
            <h1>Dashboard</h1>
            <div class="row">
               <div class="col-sm-4">
                  <a href="{{route('seller.seller-sale')}}">
                     <!--<a href="">-->
                     <div class="listing-box">
                        <div class="img-box">
                           <img alt="sales" class="hover-images" src="{{ asset('assets/images/seller/sales.jpg')}}">
                        </div>
                        <div class="listingttl">
                           <h2 class="text-center">Sales</h2>
                        </div>
                     </div>
                  </a>
               </div>
               <!-- col-sm-4 colsed-->
               <div class="col-sm-4">
                  <a href="{{route('seller.add-product')}}">
                     <div class="listing-box">
                        <div class="img-box">
                           <img alt="upload picture" class="hover-images" src="{{ asset('assets/images/seller/upload.jpg')}}">
                        </div>
                        <div class="listingttl listing-box-product">
                           <h2 class="text-center">Upload Product</h2>
                        </div>
                     </div>
                  </a>
               </div>
               <!-- col-sm-4 colsed-->
               <div class="col-sm-4">
                  <a href="{{ route('seller.commercialAds')}}">
                     <div class="listing-box listing-box-1">
                        <div class="img-box">
                           <img alt="commercial Ads" class="hover-images" src="{{ asset('assets/images/seller/comercial-add.jpg') }}">
                        </div>
                        <div class="listingttl listingttl-1">
                           <h2 class="text-center">Purchase Commercial ads</h2>
                        </div>
                     </div>
                  </a>
               </div>
               <!-- col-sm-4 colsed-->
               <div class="col-sm-4">
                  <a href="{{route('seller.chatMessagees')}}">
                     <div class="listing-box">
                        <div class="img-box">
                           <img alt="message" class="hover-images" src="{{ asset('assets/images/seller/message.jpg')}}">
                        </div>
                        <div class="listingttl">
                           <h2 class="text-center">Messages</h2>
                        </div>
                     </div>
                  </a>
               </div>
               <!-- col-sm-4 colsed-->
               <div class="col-sm-4">
                  <a href="{{ route('seller.my-product')}}">
                     <div class="listing-box">
                        <div class="img-box">
                           <img alt="myproduct" class="hover-images" src="{{ asset('assets/images/seller/myproduct.jpg')}}">
                        </div>
                        <div class="listingttl">
                           <h2 class="text-center">My Products</h2>
                        </div>
                     </div>
                  </a>
               </div>
               <!-- col-sm-4 colsed-->
               <div class="col-sm-4">
                  <a href="{{ route('seller.promote-product')}}">
                     <div class="listing-box">
                        <div class="img-box">
                           <img alt="promote-product" class="hover-images" src="{{ asset('assets/images/seller/promoteproduct.jpg') }}">
                        </div>
                        <div class="listingttl">
                           <h2 class="text-center">Promote Products</h2>
                        </div>
                     </div>
                  </a>
               </div>
               <!-- col-sm-4 colsed-->
               <div class="col-sm-4">
                  <a href="{{ route('seller.commercial-ads-dashboard')}}">
                     <div class="listing-box">
                        <div class="img-box">
                           <img alt="commercial-dashboard" class="hover-images" src="{{ asset('assets/images/seller/commercial-dashboard.png') }}">
                        </div>
                        <div class="listingttl">
                           <h2 class="text-center">Commercial ads Dashboard</h2>
                        </div>
                     </div>
                  </a>
               </div>
               <!-- col-sm-4 colsed-->
               <div class="col-sm-4">
                  <a href="{{route('seller.my-deleted-product')}}">
                     <div class="listing-box">
                        <div class="img-box">
                           <img alt="commercial-dashboard" class="hover-images" src="{{ asset('assets/images/seller/commercial-dashboard.png') }}">
                        </div>
                        <div class="listingttl">
                           <h2 class="text-center">Deleted Products</h2>
                        </div>
                     </div>
                  </a>
               </div>
               <!-- col-sm-4 colsed-->
            </div>
         </div>
      </div>
   </div>
</section>
<!-- <div class="">
   <button class="go-back-btn" (click)="goBack()" id="backBtn" title="Go to back">
   <i class="fa fa-chevron-left"></i>
   </button>
   <button (click)="topFunction()" id="backBtn" title="Go to top">
   <i class="fa fa-chevron-up"></i></button>
</div -->
@include('frontend.talent.login')

<a class="scroll-top-arrow" href="javascript:void(0);"><i  class="ti-arrow-up"></i></a>
@endsection