@extends('layouts.talent') @section('content')
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
            
              <div class="row">
                  <div class="col-md-6">
                       <h4>Edit Product</h4>
                  </div>
                  <div class="col-md-6">
                    <a href="{{route('seller.my-product')}}" class="pull-right back-btn" style="background: #b43e38 !important;color: #fff !important;" title="Go Back"><i class="ti-arrow-left" aria-hidden="true"></i></a>
                  </div>
               </div>
            <form id="edit-product-form" method="POST" action="{{route('seller.update-product')}}" enctype="multipart/form-data">
               @csrf
               <input type="hidden" name="talent_id" value="{{$talent['id']}}">
               <div class="row">
                  <div class="col-md-12">
                     <div class="form-sec">
                        <div class="row">
                           <div class="col-md-12 col-sm-12 col-xs-12 form-list">
                              <label>Select catogory of product</label>
                              <div class="form-group">
                                 <select name="category" class="form-control b-select">
                                    <option value="">Select catogory of product</option>
                                    @if(!empty($talentCategories)) 
                                    @foreach($talentCategories as $category)
                                    <option value="{{$category->id}}" <?php if($category->id ==$talent['talent_category_id']) {echo 'selected';}?>>{{$category->name}}</option>
                                    @endforeach
                                    @endif
                                 </select>
                                 {!! $errors->first('category', '<span class="alert alert-danger" role="alert">:message</span>') !!}
                              </div>
                           </div>

                           <div class="col-md-12 col-sm-12 col-xs-12 form-list">
                              <label>Title</label>
                              <div class="form-group">
                                 <input name="title" type="text" class="form-control" placeholder="Title" value="{{$talent['title']}}">
                              </div>
                              {!! $errors->first('title', '<span class="alert alert-danger" role="alert">:message</span>') !!}
                           </div>

                           <div class="col-md-12 col-sm-12 col-xs-12 form-list">
                              <label>Product Logo/Commercial Section -<span class="text-danger"> Upload Audio, Jpeg,Png Image or Video&nbsp;(1-2 min limit)</span></label>
                              <div class="form-group">
                                 <input id="commercial" type="file"  name="commercial">
                              </div>
                              <label>
                                <span id="prevFile" class="text-danger">
                                    {{$talent['getCommercila']['image_name']}}</span>
                              </label>
                              <input type="hidden" name="old_commercial" value="{{$talent['getCommercila']['image_name']}}">
                           </div>

                           <div class="col-md-12 col-sm-12 col-xs-12 form-list">
                               <label>Sample Product section - <span class="text-danger">Upload Audio, Jpeg/png images or Video&nbsp;(Note: Image should be water marked)</span></label>
                              <div class="form-group">
                                 <input id="video" type="file"  name="video">
                              </div>
                              <label>
                                  <span id="prevFile1" class="text-danger">  
                                   {{$talent['getSampleMedia']['video_name']}}
                                  </span>
                                </label>
                              <input type="hidden" name="old_video" value="{{$talent['getSampleMedia']['video_name']}}">
                           </div>

                           <div class="col-md-12 col-sm-12 col-xs-12 form-list">
                              <label> Bio information of product</label>
                              <div class="form-group">
                                 <textarea name="product_info" id="message" placeholder="Product information" required="">{{$talent['product_info']}}</textarea>
                              </div>
                              {!! $errors->first('product_info', '<span class="alert alert-danger" role="alert">:message</span>') !!}
                           </div>

                           <div class="col-md-12 col-sm-12 col-xs-12 form-list">
                              <label> Bio information of seller </label>
                              <div class="form-group">
                                 <textarea name="description" id="description" placeholder="Product information" required="">{{$talent['description']}}</textarea>
                              </div>
                              {!! $errors->first('description', '<span class="alert alert-danger" role="alert">:message</span>') !!}
                           </div>

                           <div class="col-md-12 col-sm-12 col-xs-12 form-list">
                              <label>Price</label>
                              <div class="form-group">
                                 <input type="text" class="form-control" placeholder="Price" value="{{$talent['price']}}" name="price">
                              </div>
                              {!! $errors->first('price', '<span class="alert alert-danger" role="alert">:message</span>') !!}
                              <span class="alert alert-danger" role="alert" id="digit-only"></span>
                           </div>

                           <div class="col-md-12 col-sm-12 col-xs-12 form-list">
                              <label>Upload Product  <span class="text-danger">(Mp3, jpeg, video, Audio)</span></label>
                              <div class="form-group">
                                 <input id="pdf" type="file" name="pdf">
                              </div>
                               <label>
                                      <span id="prevFile" class="text-danger">{{$talent['getProductMedia']['pdf_name']}}</span>
                               </label> 
                              <input type="hidden" name="old_pdf" value="{{$talent['getProductMedia']['pdf_name']}}">
                           </div>

                        </div>
                     </div>
                  </div>
               </div>
                <button type="submit" class="btn btn-primary hide-off" id="upload-product-edit" style="background-color: #FF503F; color: #fff; font-weight: bold;">Save</button>
                        
                <div class="form-group col-md-12" id="loader-product-edit" style="display: none;">
                    <button class="btn btn-primary" type="button" disabled>
                     <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        Please wait! we are processing your request.
                   </button>
                </div>

            </form>
         </div>
      </div>
   </div>
</section>
@include('frontend.talent.login')
<a class="scroll-top-arrow" href="javascript:void(0);"><i  class="ti-arrow-up"></i></a>
@endsection
@section('javascript')
<script type="text/javascript">   

$(function(){
      $('#edit-product-form').submit(function() {
          $("#loader-product-edit").css('display', 'block');
          $("#upload-product-edit").hide();
          return true;
      });
       $('.price').keypress(function(event) {
         if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
           event.preventDefault();
           $("#digit-only").text('Only digit and floart value are allowed.')
         }
       });
});

$(document).ready(function(){

      $("#commercial").change(function() {

          $("#selected-commercial-file").text('');
          var file = $('#commercial')[0].files[0];
          var fileType = $('#commercial')[0].files[0].type;
          var fileSize = $('#commercial')[0].files[0].size;

          var validImageTypes = ["image/gif", "image/jpeg", "image/png", "video/mp4","video/.wav", "audio/mp3"];
          if ($.inArray(fileType, validImageTypes) > 0) { 
              
            var checkFileSize = fileSize / 1024;
            if(checkFileSize > 10000) {
                
                toastr.error('Future Starr accept maximum file sieze 10 MB.');
                $("#commercial").val('');
                return false;
            }
            if(fileType == "video/mp4" || fileType ==  "video/wav"){

                  var videoDuration = '';
                  var file = file,                
                  mime = file.type,                                       
                  rd = new FileReader();                               
                  rd.onload = function(e) {                                   
                    var blob = new Blob([e.target.result], {type: mime}),     
                        url = (URL || webkitURL).createObjectURL(blob),       
                        video = document.createElement("video");              
                    video.preload = "metadata";                               
                    video.addEventListener("loadedmetadata", function() {    
                       videoDuration =  video.duration;
                       if(videoDuration > 90 ){
                            toastr.error('Video can be max of 1min 30sec duration.');
                            $("#commercial").val('');
                            return false;
                       }
                      (URL || webkitURL).revokeObjectURL(url);               
                    });
                    video.src = url;                                          
                  };
                  rd.readAsArrayBuffer(file);
              }
                  $("#selected-commercial-file").text(file.name);
          } else {
              toastr.error('Invalid file format. Please choose file of allowed format.');
              $("#commercial").val('');
              return false;
          }
      });

      $("#video").change(function() {
          $("#selected-video-file").text('');
          var file = $('#video')[0].files[0];
          var fileType = $('#video')[0].files[0].type;
          var fileSize = $('#video')[0].files[0].size;

          var validImageTypes = ["image/gif", "image/jpeg", "image/png", "video/mp4","video/.wav", "audio/mp3"];
          if ($.inArray(fileType, validImageTypes) > 0) { 
              
            var checkFileSize = fileSize / 1024;
            if(checkFileSize > 10000) {
                
                toastr.error('Future Starr accept maximum file sieze 10 MB.');
                $("#video").val('');
                return false;
            }
            if(fileType == "video/mp4" || fileType ==  "video/wav"){

                  var videoDuration = '';
                  var file = file,                
                  mime = file.type,                                       
                  rd = new FileReader();                               
                  rd.onload = function(e) {                                   
                    var blob = new Blob([e.target.result], {type: mime}),     
                        url = (URL || webkitURL).createObjectURL(blob),       
                        video = document.createElement("video");              
                    video.preload = "metadata";                               
                    video.addEventListener("loadedmetadata", function() {    
                       videoDuration =  video.duration;
                       if(videoDuration > 90 ){
                            toastr.error('Video can be max of 1min 30sec duration.');
                            $("#video").val('');
                            return false;
                       }
                      (URL || webkitURL).revokeObjectURL(url);               
                    });
                    video.src = url;                                          
                  };
                  rd.readAsArrayBuffer(file);
                }
                $("#selected-video-file").text(file.name);
          } else {
              toastr.error('Invalid file format. Please choose file of allowed format.');
              $("#video").val('');
              return false;
          }
      });

      $("#pdf").change(function() {
          $("#selected-pdf-file").text('');
          var file = $('#pdf')[0].files[0];
          var fileType = $('#pdf')[0].files[0].type;
          var fileSize = $('#pdf')[0].files[0].size;

          var validImageTypes = ["image/gif", "image/jpeg", "image/png", "video/mp4","video/.wav", "audio/mp3"];
          if ($.inArray(fileType, validImageTypes) > 0) { 
              
            var checkFileSize = fileSize / 1024;
            if(checkFileSize > 10000) {
                
                toastr.error('Future Starr accept maximum file sieze 10 MB.');
                $("#pdf").val('');
                return false;
            }
            if(fileType == "video/mp4" || fileType ==  "video/wav"){

                  var videoDuration = '';
                  var file = file,                
                  mime = file.type,                                       
                  rd = new FileReader();                               
                  rd.onload = function(e) {                                   
                    var blob = new Blob([e.target.result], {type: mime}),     
                        url = (URL || webkitURL).createObjectURL(blob),       
                        video = document.createElement("video");              
                    video.preload = "metadata";                               
                    video.addEventListener("loadedmetadata", function() {    
                       videoDuration =  video.duration;
                       if(videoDuration > 90 ){
                            toastr.error('Video can be max of 1min 30sec duration.');
                            $("#pdf").val('');
                            return false;
                       }
                      (URL || webkitURL).revokeObjectURL(url);               
                    });
                    video.src = url;                                          
                  };
                  rd.readAsArrayBuffer(file);
              }
                  $("#selected-pdf-file").text(file.name);
          } else {
              toastr.error('Invalid file format. Please choose file of allowed format.');
              $("#pdf").val('');
              return false;
          }
      });

  }); 
</script>
@stop