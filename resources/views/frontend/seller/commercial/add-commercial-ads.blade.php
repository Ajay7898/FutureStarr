@extends('layouts.talent')

@section('content')
<div id="seller-header">
   <div id="sub-header" class="container-fluid" style="background-color:rgb(21, 24, 41);min-height: 75px;">
      <div class="row">
         <div class="col-sm-12 top-cls top-cls-l"></div>
      </div>
   </div>
</div>
<section class="buyer-con-section">
   <div class="container">
      <div class="row">
        @include('frontend.sidebar.seller')
         <div class="col-md-8 col-sm-8 col-xs-12 seller-add-product">
               <div class="row">
                  <div class="col-md-6">
                      <h4 style="margin-left: 20px;">Add Commercial Ad Page</h4>
                  </div>
                  <div class="col-md-6">
                    <a href="{{route('seller.commercial-ads-dashboard')}}" class="pull-right back-btn" style="background: #b43e38 !important;color: #fff !important;" title="Go Back"><i class="ti-arrow-left" aria-hidden="true"></i></a>
                  </div>
                </div>
  
               <div class="well panel panel-danger panel-m">
                  <div class="panel-body">
                     <form method="POST" action="{{route('seller.storeCommercialAd')}}" enctype="multipart/form-data" id="add-ad-form">
                        @csrf 

                         <div class="form-group">
                           {!! Form::label('title','Title') !!}
                           {!! Form::text('title', old('title') , ['class' => 'form-control' . ($errors->has('title') ? ' is-invalid' : ''),'placeholder'=>'Title', 'required' => 'required']) !!}
                           {!! $errors->first('title', '<span class="alert alert-danger" role="alert">:message</span>') !!}
                        </div>

                        <div class="form-group">
                           {!! Form::label('Product','Select product from below to attach with this ad') !!}
                           <select name="product" class="form-control b-select" id="select-prdouct"required>
                              <option value="">Select product from the list</option>
                              @if(!empty($getSellerTalents)) 
                              @foreach($getSellerTalents as $talent)
                              <option value="{{$talent->id}}">{{$talent->title}}</option>
                              @endforeach
                              @endif
                           </select>
                            {!! $errors->first('product', '<span class="alert alert-danger" role="alert">:message</span>') !!}
                        </div>

                        <div class="form-group">
                           {!! Form::label('product_url','Product Url') !!}
                           {!! Form::text('product_url', old('product_url') , ['class' => 'form-control' . ($errors->has('product_url') ? ' is-invalid' : ''),'placeholder'=>'Product Url' ,'required' => 'required' , 'readonly'=> 'readonly', 'id' => 'product-url'] ) !!}
                           {!! $errors->first('product_url', '<span class="alert alert-danger" role="alert">:message</span>') !!}
                        </div>

                        <div class="form-group p-b-upload">
                           {!! Form::label('commercial_ad','Upload Your Ad (video, jpeg image, or MP3 sample)') !!}
                           <small class="text-danger">(max filesize 10MB)</small>
                           <div class="file-upload">
                              <div class="file-select">
                                 <div class="file-select-button" id="fileName1">Browse</div>
                                 <div  class="file-select-name" id="selected-file-name">No file selected </div>
                                 {!! Form::file('banner', ['id' => 'banner', 'required' => 'required']) !!}
                                 {!! $errors->first('banner', '<span class="alert alert-danger" role="alert">:message</span>') !!}
                              </div>
                           </div>
                        </div>
                       
                        <button type="submit" class="btn btn-primary hide-off" id="upload-ad" style="background-color: #FF503F; color: #fff; font-weight: bold;">Upload</button>
                        
                         <div class="form-group col-md-12" id="loader-ad" style="display: none;">
                              <button class="btn btn-primary" type="button" disabled>
                               <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                  Please wait! we are processing your request.
                             </button>
                          </div>
                     </form>
                  </div>
               </div>
         </div>
      </div>
   </div>
</section>
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">File upload Message</h4>
      </div>
      <div class="modal-body">
        <p>Only video(.mp4, .wav, .mkv) and images(.jpg, .jpeg, .png, .gif) of these file type are allowed.</p>
      </div>
    </div>
  </div>
</div>
@include('frontend.talent.login')
<a class="scroll-top-arrow" href="javascript:void(0);"><i  class="ti-arrow-up"></i></a>
@endsection

