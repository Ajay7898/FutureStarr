@extends('layouts.seller')

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
@section('javascript')
<script type="text/javascript"> 
  $(function(){
      $('#add-ad-form').submit(function() {

          $("#loader-ad").css('display', 'block');
          $("#upload-ad").hide();
          return true;

      });
    });

  $(document).ready(function(){
      
      $("#select-prdouct").change(function(){
          var optionValue = $(this).val();
            if(optionValue) {
              var post_data = { 
                 "_token": "{{ csrf_token() }}",
                 id: optionValue
              };
              $.ajax({
                 url : '{!!  route('talent.product-url') !!}',
                 type: 'GET',
                 data : post_data,
                 success: function(response) {
                    $("#product-url").val(response.url);
                    return true;
                 }
              }); 

            }
      });

      $("#banner").change(function() {
          $("#selected-file-name").text('');
          var file = $('#banner')[0].files[0];
          var fileType = $('#banner')[0].files[0].type;
          var fileSize = $('#banner')[0].files[0].size;

          var validImageTypes = ["image/gif", "image/jpeg", "image/png", "video/mp4","video/.wav", "audio/mp3"];
          if ($.inArray(fileType, validImageTypes) > 0) { 
              
            var checkFileSize = fileSize / 1024;
            if(checkFileSize > 10000) {
                
                toastr.error('Future Starr accept maximum file sieze 10 MB.');
                $("#banner").val('');
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
                            $("#banner").val('');
                            return false;
                       }
                      (URL || webkitURL).revokeObjectURL(url);               
                    });
                    video.src = url;                                          
                  };
                  rd.readAsArrayBuffer(file);
              }
                  $("#selected-file-name").text(file.name);
          } else {
              toastr.error('Invalid file format. Please choose file wiht allowed format.');
              $("#banner").val('');
              return false;
          }
      });
  }); 
 </script>
@stop

