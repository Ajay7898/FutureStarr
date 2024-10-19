@extends('layouts.seller') @section('content')
<div id="seller-header">
   <div id="sub-header" class="container-fluid">
      <div class="row">
         <div class="col-sm-12 top-cls top-cls-l"></div>
      </div>
   </div>
</div>
<style>
	.custom-css {
		background-color: #ff503f !important;
		color: #fff !important;
		border: 0px !important; 
	}
</style>
<!--SideBar-Start---->
<section class="buyer-con-section">
   <div class="container">
   <div class="row">
      @include('frontend.sidebar.seller')
      <div class="col-md-8 col-sm-8 col-xs-12">
         <div class="buyer-form commercial-sec">
               <div class="row">
                  <div class="col-md-6">
                      <h4>Commercial Ad Dashboard</h4>
                  </div>
                  <div class="col-md-6">
                    <a href="{{route('seller.index')}}" class="pull-right back-btn seller-graph-back-btn" title="Go Back"><i class="ti-arrow-left" aria-hidden="true"></i></a>
                  </div>
               </div>
            <div class="row">
               <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="dash-box-sec commercila">
                     <div class="img-box">
                        <h4>Commercial Ad Stats</h4>
                        <img src="{{asset('assets/images/seller/com-graph.png')}}" alt="com-graph">
                        <img class="img-last" src="{{asset('assets/images/seller/com-graph-2.png')}}" alt="com-graph">
                     </div>
                  </div>
                  <div class="dash-box-sec commercila">
                     <div class="img-box">
                        <h4>Active Plan</h4>
                        <div class="table-data">
                           <div class="table-responsive">
                              @if($activePlan)
                              <table class="table table-striped">
                                 <thead>
                                    <tr>
                                       <th class="font-weight-bold">Plan</th>
                                       <th class="font-weight-bold">Start Date</th>
                                       <th class="font-weight-bold">End Date</th>
                                       <th class="font-weight-bold">Last Upgraded</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <tr bg-secondary text-white>
                                       <td class="text-info ">{{planName($activePlan['plan_id'])}}</td>
                                       <td class="text-success">{{ \Carbon\Carbon::parse($activePlan['start_date'])->format('j F, Y')  }}</td>
                                       <td class="text-danger">{{ \Carbon\Carbon::parse($activePlan['end_date'])->format('j F, Y')  }}</td>
                                       <td class="text-warning">{{ \Carbon\Carbon::parse($activePlan['updated_at'])->format('j F, Y')  }}</td>
                                    </tr>
                                 </tbody>
                              </table>
                              @else
                              <h4 class="text-danger text-center">
                                 You do not have an active plan at the moment. 
                              </h4>
                              <h4 class="text-danger text-center">Click the&nbsp;
                                 <button onclick="location.href = '{!! route('seller.commercialAds') !!}';" class="btn btn-warning">Buy More Ads
                                 </button>&nbsp;and purchase the ad plan to renew your services. </h4>
                              @endif
                           </div>
                        </div>
                     </div>
                  </div>
                  @if($activePlan)
                  <div class="dash-box-sec commercila">
                     <div class="img-box">
                        <div class="table-data">
                           <div class="table-responsive">
                              <h4>Total Performance's</h4>
                              <div class="table-data">
                                 <div class="table-responsive">
                                    <table class="table table-striped">
                                       <thead>
                                          <tr>
                                             <th class="font-weight-bold">Total Perfomance</th>
                                             <th class="font-weight-bold">Buy More Ads</th>
                                          </tr>
                                       </thead>
                                       <tbody>
                                       	<tr>
                                       		<td>{{$activePlan->total_ads}}</td>
                                       		<td ><a href="{{ route('seller.commercialAds') }}">Buy More Ads</a></td>
                                       	</tr>
                                       </tbody>
                                    </table>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                   @endif
                  <div class="dash-box-sec commercila">
                     <div class="buyer-acont seller-sec table-btn-sec-new">
                           <a class="pull-right custom-css" href="{{ route('seller.addCommercilaAds') }}">CREATE ADS</a>
                     </div>
                     <div class="img-box">

                        <h4>Total Ad Commercials Purchased</h4>
                        <div class="table-data">
                           <div class="table-responsive">
                              @if(!empty($sellerAds))
                              <table class="table table-striped">
                                 <thead>
                                    <tr>
                                       <th class="font-weight-bold">Ad Name</th>
                                       <th class="font-weight-bold">Date Start</th>
                                       <th class="font-weight-bold">Performance</th>
                                       <th class="font-weight-bold">Status</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    @php $planViews = ''; @endphp
                                    @foreach($sellerAds as $ads)
                                    @php
                                    if($ads->getPlanDetail['id']=='1') {
                                    $planViews = '10';
                                    }
                                    if($ads->getPlanDetail['id']=='1') {
                                    $planViews = '25';
                                    }
                                    if($ads->getPlanDetail['id']=='1') {
                                    $planViews = '100';
                                    }
                                    $today = date("Y-m-d H:i:s");
                                    if (strtotime($today) <= strtotime($ads->getSellerPlan['end_date']) && count($ads->adViews) < $planViews) {
                                    $status = "active";
                                    }
                                    if (count($ads->adViews) >= $planViews) {
                                    $status = "view_completed";
                                    }
                                    if (strtotime($today) > strtotime($ads->getSellerPlan['end_date'])) {
                                    $status = "expired";
                                    }
                                    @endphp 
                                    <tr>
                                       <td>{{$ads->description}}</td>
                                       @if($status =='expired')
                                       <td class="text-danger">Expired</td>
                                       @else
                                       <td>{{ \Carbon\Carbon::parse($ads->getSellerPlan['start_date'])->format('j F, Y')  }}</td>
                                       @endif
                                       <td>{{count($ads->adViews)}}</td>
                                       @if($status =='expired')
                                       <td class="text-danger">Expired</td>
                                       @else
                                       <td class="text-success">Active</td>
                                       @endif
                                    </tr>
                                    @endforeach
                                 </tbody>
                              </table>
                              @else
                              <h5>No ads found</h5>
                              @endif
                           </div>
                        </div>
                     </div>
                  </div>
                  
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<!-- all models -->
@include('frontend.talent.login')
<a class="scroll-top-arrow" href="javascript:void(0);"><i  class="ti-arrow-up"></i></a>
@endsection