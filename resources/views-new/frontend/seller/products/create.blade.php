@extends('layouts.seller') @section('content')
<div id="seller-header">
   <div id="sub-header" class="container-fluid" style="background-color:rgb(21, 24, 41);min-height: 75px;">
      <div class="row">
         <div class="col-sm-12 top-cls top-cls-l"></div>
      </div>
   </div>
</div>

<!--SideBar-Start---->
    <section class="buyer-con-section">
    <div class="container">
        <div class="row">

            @include('frontend.sidebar.seller')

            <div class="col-md-8 col-sm-8 col-xs-12">
                <div class="buyer-form">
                    <h4>Edit Product</h4>
                    <form method="POST" action="{{route('seller.update-product')}}"> 
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-sec">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12 form-list">
                                        <h3>Select catogory of product</h3>
                                        <div class="form-group">
                                            <select class="form-control b-select">
                                            <option value="">Select catogory of product</option>
                                            @if(!empty($talentCategories)) 
                                              @foreach($talentCategories as $category)
                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                                
                                               @endforeach
                                            @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12 form-list">
                                        <h3>Title</h3>
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Title">
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12 form-list">
                                        <h3>Upload Image or Video commercial of product</h3>
                                        <div class="form-group">
                                            <input id="uploadBtn" type="file" required="">
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12 form-list">
                                        <h3>Upload Music / Video sample of product</h3>
                                        <div class="form-group">
                                            <input id="uploadBtn" type="file" required="">
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12 form-list">
                                        <h3> Bio information of product</h3>
                                        <div class="form-group">
                                            <textarea name="message" id="message" placeholder="Product information" required=""></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12 form-list">
                                        <h3> Bio information of seller </h3>
                                        <div class="form-group">
                                            <textarea name="message" id="message" placeholder="Product information" required=""></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12 form-list create-new">
                                        <div class="form-group">
                                            <label>Upload Image or Video commercial of product</label>
                                            <div class="input-group">
                                                <span class="input-group-btn">
                                                    <span class="btn btn-default btn-file">
                                                        $
                                                    </span>
                                                </span>
                                                <input type="text" class="form-control" placeholder="" readonly>
                                            </div>
                                            <img id='img-upload'/>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12 form-list">
                                        <h3>Upload Product  (Mp3, jpeg, video, pdf)</h3>
                                        <div class="form-group">
                                            <input id="uploadBtn" type="file" required="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="sec-btn">
                        <a href="#">Save</a>
                        <a href="#">Cancel</a>
                    </div>
                </form>
                </div>
            </div>
        </div>
</section>
@include('frontend.talent.login')
<a class="scroll-top-arrow" href="javascript:void(0);"><i  class="ti-arrow-up"></i></a>

@endsection

