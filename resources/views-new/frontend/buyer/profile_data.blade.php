
@extends('layouts.talent') 

@section('title', 'Future Starr | Buyer Manage Public Profile')

@section('content')
<!-- banner start -->
<section class="wow fadeIn cover-background socail-buzz background-position-top top-space buyer-banner-sec dash" style="background-image:url({{ asset('assets/images/buyer/buyer-banner.jpg')}});">
   <div class="bg-extra-dark-gray"></div>
   <div class="container">
      <div class="row">
         <div class="col-md-12 col-sm-12 col-xs-12 display-table page-title-large">
            <div class="display-table-cell vertical-align-middle text-center padding-30px-tb">
            </div>
         </div>
      </div>
   </div>
</section>
<!--SideBar-Start---->
<section class="buyer-con-section">
   <div class="container">
   <div class="row">

   </div>

   <div class="row">

      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
         <div class="buyer-form buyer-product-trophy">
            <h4>Manage Public Profile</h4>
			<hr>
			<div class="row">
			  <form id="public-profile-form" action="{{ route('buyer.public.profile.store') }}" method="POST" enctype="multipart/form-data" style="padding:15px;">
               @csrf
                  
                  <div class="form-group col-md-12">
                    <label>Cover Picture:&nbsp;<small class="text-danger">jpg, png, jpeg format allowed.</small></label>
                    <input type="file" name="banner_image" class="form-control" id="banner-image">

                    <img id="preview-banner" src="{{ !empty($data['banner_image']) ? asset($data['banner_image']) : asset('userImage/banner/placeholder.gif') }}" alt="author preview image"  style="display: block;"/>

                     <div class="col-md-10 show-cropper" style="display:none;border-right:1px solid #ddd;">
                            <div id="image-preview"></div>
                            <button type="button" class="btn btn-success crop_image">Crop Image</button>
                    </div>

                    <img id="encode_image_img" src="">
                    <input type="hidden" name="encode_image" id="encode_image" val="">
                    <input type="hidden" name="db-banner-image" value="{{ !empty($data['banner_image']) ? $data['banner_image'] : '' }}">

                  </div>

                 <div class="form-group col-md-12">
                    <label>Video Bio:&nbsp;<small class="text-danger">Allowed fomats: Mp4, Wav and video duration of max 1min 30 sec.</small></label>
                    <input type="file" name="video_bio" class="form-control" id="video-bio">

                    <video width="400" height="300" controls autoplay>
          					  <source src="{{ asset($data['bio_video']) }}" id="video_here">
          					    Your browser does not support HTML5 video.
          					</video>

                       <input type="hidden" name="db-video-name" value="{{ !empty($data['bio_video']) ? $data['bio_video'] : '' }}">

                  </div>
				  
				          <div class="form-group col-md-12">
                    <label>Bio information:</small></label>
                    <textarea id="bio_info" name="bio_info" rows="4" cols="50">{{ old('bio_info', $data['description']) }}</textarea>
                  </div>

                   <div class="form-group col-md-12">
                      <button type="submit" class="btn btn-primary hide-off" id="upload-profile" style="background-color: #FF503F; color: #fff; font-weight: bold;">Upload</button>
                   </div>

                    <div class="form-group col-md-12" id="loader-profile" style="display: none;">
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
</section>

@endsection
@section('javascript')

<script src="{{ asset('assets/admin/js/croppie.js')}}"></script>

<script type="text/javascript">
    
    $(function(){
	    $('#public-profile-form').submit(function() {
	        //$(".hide-off").prop('disabled', true);
	        //$(".hide-off").text('uploading...');
           $("#loader-profile").css('display', 'block');
           $("#upload-profile").hide();
	      return true;
	    });
    });

$(document).on("change", "#video-bio", function(evt) {
         
        var file = this.files[0];
        var fileType = this.files[0].type;
        var fileSize = this.files[0].size;
        if(fileType == "video/mp4" || fileType == "video/wav") {

          var checkFileSize = fileSize / 1024; 

          if(checkFileSize < 10000 ) {
                    
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
                            $("#video-bio").val('');
                            return false;
                       } else {
                            var $source = $('#video_here');
                            $source[0].src = url;
                            $source.parent()[0].load();
                            $("#video_here").css("display","block");
                       }
                      (URL || webkitURL).revokeObjectURL(url);               

                    });
                    video.src = url;                                          
                  };
                  rd.readAsArrayBuffer(file);
          } else {
                 toastr.info('FutureStarr accept maximum file size of 10MB.');
                 $("#video-bio").val('');
          } 
        } else {
            toastr.error('Invalid file format.');
            $("#video-bio").val('');
        }
    });

$(document).ready(function(){

  $image_crop = $('#image-preview').croppie({
    enableExif:false,
    customClass: '',
    viewport:{
      width:600,
      height:200,
      type:'square'
    },
    boundary:{
      width:900,
      height:200
    }
  });

  $('#banner-image').change(function(){

    $("#preview-banner").css({'display':'none'});
    $(".show-cropper").css({'display':'block'});
    $("#upload-profile").prop('disabled', true);
    $("#upload-profile").attr('title', 'Crop the image first or refresh the page');

    var file_type = this.files[0].type;
    if(file_type =='image/png' || file_type =='image/jpeg' || file_type =='image/jpg' || file_type =='image/gif' ) {
       
      toastr.info('Please crop the image before submit by clicking crop button.');
      var reader = new FileReader();
      reader.onload = function(event){
        $image_crop.croppie('bind', {
          url:event.target.result
        }).then(function(){
          //console.log('jQuery bind complete');
        });
      }
      reader.readAsDataURL(this.files[0]);

      $("#blah").css({'display':'none'});
    }  else {
      toastr.error('Only jpg, jpeg, png format allowed.');
      $("#banner-image").val('');
      $(".show-cropper").css({'display':'none'});
      $("#preview-banner").css({'display':'block'});
    }
  });

  $('.crop_image').click(function(event){
    $image_crop.croppie('result', {
      type:'canvas',
      size:{
        width:1200,
        height:280
    }
    }).then(function(response){
      if(response) {
         toastr.success('Image cropped successfully!');
         $("#upload-profile").prop('disabled', false);
         $("#upload-profile").attr('title', '');
         $("#encode_image").val(response);
         $("#encode_image_img").attr('src', response);
          return true;
      } else {
         toastr.success('Technical error.');
      }
       
    });
  });
  
});
</script>
@stop

