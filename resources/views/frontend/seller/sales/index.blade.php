@extends('layouts.talent') @section('content')

<div id="seller-header">
    <div id="sub-header" class="container-fluid">
        <div class="row">
            <div class="col-sm-12 top-cls top-cls-l"></div>
        </div>
    </div>
</div>
<style type="text/css">
    
</style>
<section class="buyer-con-section">
    <div class="container">
        <div class="row">
            @include('frontend.sidebar.seller')
            <div class="col-md-8 col-sm-8 col-xs-12 seller-graph-sec">
                <div class="row">
                  <div class="col-md-6">
                      <h1 class="text-left">Sales</h1>
                  </div>
                  <div class="col-md-6">
                    <a href="{{route('seller.index')}}" class="pull-right back-btn seller-graph-back-btn" title="Go Back"><i class="ti-arrow-left" aria-hidden="true"></i></a>
                  </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <div class="seller-dpt">
                            <h4>Daily Sales&nbsp;<span>{{ count($saleInformation['dailySales'])}}</span></h4>
                            <div class="img-graph">
                                <img alt="daily sales" src="{{asset('assets/images/seller/circle-graph.png')}}">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="seller-dpt">
                            <h4>Today’s Revenue&nbsp;<span>${{ $saleInformation['dailyRevenue']}}</span></h4>
                            <div class="img-graph">
                                <img alt="sucess graph" src="{{asset('assets/images/seller/succes-graph.png')}}">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="seller-dpt">
                            <h4>Download&nbsp;<span>{{ count($saleInformation['downloads'])}}</span></h4>
                            <div class="img-graph">
                                <img alt="cloud-graph" src="{{asset('assets/images/seller/cloud-graph.png')}}">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="seller-dpt">
                            <h4>Total Revenue&nbsp;<span>${{ $saleInformation['totalRevenue'] }}</span></h4>
                            <div class="img-graph">
                                <img alt="cuurrency-graph" src="{{asset('assets/images/seller/cuurrency-graph.png')}}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@include('frontend.talent.login')
<a class="scroll-top-arrow" href="javascript:void(0);"><i  class="ti-arrow-up"></i></a>
@endsection