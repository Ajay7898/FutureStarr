@extends('layouts.talent') @section('content')
<div>
    <img class="star-search-banner" src="{{ asset('assets/images/buyer/buyer-banner.jpg') }}" alt="buyer-banner" />
</div>
<div class="container buyer-products-container">
    <div class="col-sm-3  col-md-2">
        <div class="sidebar">
           @include('frontend.sidebar.buyer')
        </div>   
    </div>
        @include('frontend.profile.forms.change-password')
    
</div>
@endsection