@extends('admin.common')

@section('title', 'Create Product')

@section('content')
	<style type="text/css">
		.dropzone {
		    background: white;
		    border-radius: 5px;
		    border: 2px dashed rgb(0, 135, 247);
		    border-image: none;
		   /* max-width: 500px;*/
        max-width: 580px;
		    margin-left: auto;
		    margin-right: auto;
        min-height: 350px;
		    height: auto;
		}
    .dropzone .dz-preview {
        max-width:170px!important;
        width: auto!important;
      
      }
    .dz-filename span{
      width:150px!important;
      word-break: break-all!important;
    }
	</style>
	<section class="content-wrapper">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<div id="dropzone" style="margin-top: 40px;">
					    <form class="dropzone needsclick" id="demo-upload" method="post" action="{{ route('admin.product.mediastore') }}" enctype="multipart/form-data">
					    	@csrf
					    	<input type="hidden" name="product_id" value="1">
					      	<div style="cursor: pointer;" class="dz-message needsclick">    
					        	<h1 style="font-size: 24px;z-index: 1;position: absolute;padding-left: 105px;padding-top:150px;">Drop files here or click to upload.</h1>
					      	</div>
					    </form>
					</div>
				</div>	
			</div>
		</div>
	</section>
@endsection

@section('script')

	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.6/min/dropzone.min.js"></script>
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.6/basic.min.css">
	<script type="text/javascript">
        {{-- Remove Heading Image Drop --}}
    jQuery(document).ready(function(){
          jQuery('.content-wrapper .needsclick').click(function(){
             jQuery('.content-wrapper .needsclick h1').hide();
        });
    });

var dropzone = new Dropzone('#demo-upload', {
  previewTemplate: document.querySelector('#preview-template').innerHTML,
  parallelUploads: 2,
  thumbnailHeight: 120,
  thumbnailWidth: 120,
  maxFilesize: 3,
  filesizeBase: 1000,
  thumbnail: function(file, dataUrl) {
    if (file.previewElement) {
      file.previewElement.classList.remove("dz-file-preview");
      var images = file.previewElement.querySelectorAll("[data-dz-thumbnail]");
      for (var i = 0; i < images.length; i++) {
        var thumbnailElement = images[i];
        thumbnailElement.alt = file.name;
        thumbnailElement.src = dataUrl;
      }
      setTimeout(function() { file.previewElement.classList.add("dz-image-preview"); }, 1);
    }
  }

});
 

// Now fake the file upload, since GitHub does not handle file uploads
// and returns a 404

var minSteps = 6,
    maxSteps = 60,
    timeBetweenSteps = 100,
    bytesPerStep = 100000;

dropzone.uploadFiles = function(files) {
  var self = this;

  for (var i = 0; i < files.length; i++) {

    var file = files[i];
    totalSteps = Math.round(Math.min(maxSteps, Math.max(minSteps, file.size / bytesPerStep)));

    for (var step = 0; step < totalSteps; step++) {
      var duration = timeBetweenSteps * (step + 1);
      setTimeout(function(file, totalSteps, step) {
        return function() {
          file.upload = {
            progress: 100 * (step + 1) / totalSteps,
            total: file.size,
            bytesSent: (step + 1) * file.size / totalSteps
          };

          self.emit('uploadprogress', file, file.upload.progress, file.upload.bytesSent);
          if (file.upload.progress == 100) {
            file.status = Dropzone.SUCCESS;
            self.emit("success", file, 'success', null);
            self.emit("complete", file);
            self.processQueue();
            //document.getElementsByClassName("dz-success-mark").style.opacity = "1";
          }
        };
      }(file, totalSteps, step), duration);
    }
  }
}

	</script>

@endsection
