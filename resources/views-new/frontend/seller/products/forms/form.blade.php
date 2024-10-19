@extends('layouts.seller') @section('content')
<div id="seller-header">
   <div id="sub-header" class="container-fluid">
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
            <div class="">
                <div class="row">
                  <div class="col-md-6">
                       <h1 class="seller-add-product-h1">Add Product</h1>
                  </div>
                  <div class="col-md-6">
                    <a href="{{route('seller.my-product')}}" class="pull-right back-btn ap-back-btn" title="Go Back"><i class="ti-arrow-left" aria-hidden="true"></i></a>
                  </div>
               </div>
               <div class="well panel panel-danger panel-m">
                  <div class="panel-body">
                     <form id="add-product-form" method="POST" action="{{route('seller.store-product')}}" enctype="multipart/form-data">
                        @csrf                    
                        <div class="form-group">
                           {!! Form::label('category','Category') !!}
                           <select name="category" class="form-control b-select">
                              <option value="">Select category of product</option>
                              @if(!empty($catagories)) 
                              @foreach($catagories as $category)
                              <option value="{{$category->id}}">{{$category->name}}</option>
                              @endforeach
                              @endif
                           </select>
                        </div>
                        <div class="form-group">
                           {!! Form::label('title','Title') !!}
                           {!! Form::text('title', old('title') , ['class' => 'form-control' . ($errors->has('title') ? ' is-invalid' : ''),'placeholder'=>'Title' ]) !!}
                           {!! $errors->first('title', '<span class="alert alert-danger" role="alert">:message</span>') !!}
                        </div>
                        <div class="form-group p-b-upload">
                          
                           <label>Product Logo/Commercial Section - <span class="text-danger">Upload Audio, Jpeg,Png Image or Video&nbsp;(1-2 min limit)</span></label>
                           <div class="file-upload">
                              <div class="file-select">
                                 <div class="file-select-button" id="fileName">Browse</div>
                                 <div  class="file-select-name" id="selected-commercial-file">No file selected</div>
                                 {!! Form::file('commercial',['id' => 'commercial']) !!}
                                 <!-- file list -->
                              </div>
                           </div>
                           {!! $errors->first('image', '<span class="alert alert-danger" role="alert">:message</span>') !!}
                        </div>
                        <div class="form-group p-b-upload">
                        
                           <label>Sample Product section - <span class="text-danger"> Upload Audio, Jpeg/png images or Video&nbsp;(Note: Image should be water marked)</span></label>
                           <div class="file-upload">
                              <div class="file-select">
                                 <div class="file-select-button" id="fileName1">Browse</div>
                                 <div class="file-select-name" id="selected-video-file">No file selected </div>
                                 {!! Form::file('video', ['id' => 'video']) !!}
                              </div>
                           </div>
                        </div>
                        <div class="form-group">
                           {!! Form::label('product_info','Bio Information of Product') !!}
                           {!! Form::textarea('product_info', old('product_info') , ['class' => 'form-control' . ($errors->has('product_info') ? ' is-invalid' : ''),'placeholder'=>'Bio Information of Product','rows'=>'4' ]) !!}
                           {!! $errors->first('product_info', '<span class="alert alert-danger" role="alert">:message</span>') !!}
                        </div>
                        <div class="form-group">
                           {!! Form::label('description','Bio Information of Seller') !!}
                           {!! Form::textarea('description', old('description') , ['class' => 'form-control' . ($errors->has('description') ? ' is-invalid' : ''),'placeholder'=>'Bio Information of Seller','rows'=>'4' ]) !!}
                           {!! $errors->first('description', '<span class="alert alert-danger" role="alert">:message</span>') !!}
                        </div>
                        <!--<br>-->
                        {!! Form::label('description','Price of Product') !!}
                        <div class="input-group">
                           <span class="input-group-addon"><i class="fas fa-usd" aria-hidden="true"></i></span>
                           {!! Form::text('price', old('price') , ['class' => 'form-control price' . ($errors->has('price') ? ' is-invalid' : ''),'placeholder'=>'Price' ,]) !!}
                        </div>
                        {!! $errors->first('price', '<span class="alert alert-danger" role="alert">:message</span>') !!}
                        <span class="alert alert-danger" role="alert" id="digit-only"></span>
                        <br>
                        <div class="form-group">
                           <label>Upload Product <span class="text-danger">(Mp3,jpeg,video,pdf)</span></label>
                           <div class="file-upload">
                              <div class="file-select">
                                 <div class="file-select-button" id="fileName2">Browse</div>
                                 <div class="file-select-name" id="selected-pdf-file">No file selected</div>
                                 {!! Form::file('pdf', ['id' => 'pdf']) !!}
                              </div>
                           </div>
                            {!! $errors->first('pdf', '<span class="alert alert-danger" role="alert">:message</span>') !!}
                        </div>
                        <div class="upload-products social-media-icons">
                           <div class="row">
                              <div class="col-sm-12">
                                 {!! Form::label('facebookLink','Social media links') !!}
                                 <div class="form-group">
                                    <div class="col-sm-1 icon">
                                       <i class="fab fa-facebook-f facebook-icon-large" aria-hidden="true"></i>
                                    </div>
                                    <div class="input-group col-sm-11">
                                       {!! Form::text('facebookLink', old('facebookLink') , ['class' => 'form-control' . ($errors->has('facebookLink') ? ' is-invalid' : ''),'placeholder'=>'facebook link' ]) !!}
                                       {!! $errors->first('facebookLink', '<span class="alert alert-danger" role="alert">:message</span>') !!}
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-sm-12">
                                 <div class="form-group">
                                    <div class="col-sm-1 icon">
                                       <i class="fab fa-instagram facebook-icon-large" aria-hidden="true"></i>
                                    </div>
                                    <div class="input-group col-sm-11">
                                       {!! Form::text('instagramLink', old('instagramLink') , ['class' => 'form-control' . ($errors->has('instagramLink') ? ' is-invalid' : ''),'placeholder'=>'instagram link' ]) !!}
                                       {!! $errors->first('instagramLink', '<span class="alert alert-danger" role="alert">:message</span>') !!}
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-sm-12">
                                 <div class="form-group">
                                    <div class="col-sm-1 icon">
                                       <i class="fab fa-twitter facebook-icon-large" aria-hidden="true"></i>
                                    </div>
                                    <div class="input-group col-sm-11">
                                       {!! Form::text('twitterLink', old('twitterLink') , ['class' => 'form-control' . ($errors->has('twitterLink') ? ' is-invalid' : ''),'placeholder'=>'twitter link' ]) !!}
                                       {!! $errors->first('twitterLink', '<span class="alert alert-danger" role="alert">:message</span>') !!}
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                      
                        <!-- <input class="submit-add-product" type="submit" name="submit" value="save"> -->

                          <button type="submit" class="btn btn-primary hide-off" id="upload-product" style="background-color: #FF503F; color: #fff; font-weight: bold;">Save</button>
                        
                         <div class="form-group col-md-12" id="loader-product" style="display: none;">
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
   </div>
</section>
@include('frontend.talent.login')
<a class="scroll-top-arrow" href="javascript:void(0);"><i  class="ti-arrow-up"></i></a>
@endsection
@section('javascript')
<script type="text/javascript">  

   $(function(){
      $('#add-product-form').submit(function() {
          $("#loader-product").css('display', 'block');
          $("#upload-product").hide();
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
              toastr.error('Invalid file format. Please choose file wiht allowed format.');
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
              toastr.error('Invalid file format. Please choose file wiht allowed format.');
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
              toastr.error('Invalid file format. Please choose file wiht allowed format.');
              $("#pdf").val('');
              return false;
          }
      });

  }); 
</script>
@stop

