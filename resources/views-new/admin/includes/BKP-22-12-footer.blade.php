  <footer class="main-footer">
    <strong style="font-size: 13px;
    color: #0a0c17;
    font-family: "Overpass";
    font-weight: "400;" > © {{ date('Y') }}, FutureStarr, All Rights Reserved </strong>
    <div class="float-right d-none d-sm-inline-block">
      <b></b>
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ asset('assets/admin/plugins/jquery/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('assets/admin/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script src="{{ asset('assets/admin/js/custom.js')}}"></script>
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ asset('assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- ChartJS -->
<script src="{{ asset('assets/admin/plugins/chart.js/Chart.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{ asset('assets/admin/plugins/sparklines/sparkline.js')}}"></script>
<!-- JQVMap -->
<script src="{{ asset('assets/admin/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('assets/admin/plugins/jquery-knob/jquery.knob.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{ asset('assets/admin/plugins/moment/moment.min.js')}}"></script>
<script src="{{ asset('assets/admin/plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('assets/admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- Summernote -->
<script src="{{ asset('assets/admin/plugins/summernote/summernote-bs4.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('assets/admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('assets/admin/dist/js/adminlte.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('assets/admin/dist/js/pages/dashboard.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('assets/admin/dist/js/demo.js')}}"></script>

<!-- jsGrid -->
<script src="{{ asset('assets/admin/plugins/jsgrid/demos/db.js')}}"></script>
<script src="{{ asset('assets/admin/plugins/jsgrid/jsgrid.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('assets/admin/dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('assets/admin/dist/js/demo.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
<script src="{{ asset('assets/admin/js/croppie.js')}}"></script>
<script src="https://cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>

<script>
    document.onreadystatechange = function () {
        var state = document.readyState
        if (state == 'complete') {
            setTimeout(function(){
                document.getElementById('interactive');
                document.getElementById('load').style.visibility="hidden";
            },1000);
        }
    }
</script>
<script type="text/javascript">
 <?php if(Session::has('success')) { ?>
   toastr.success("<?php echo Session::get('success') ?>","");
 <?php } else if(Session::has('error')) { ?>
   toastr.error("<?php echo Session::get('error') ?>");
 <?php } else if(Session::has('warning')) { ?>
   toastr.warning("<?php echo Session::get('warning') ?>");
 <?php } else if(Session::has('info')) { ?>
   toastr.info("<?php echo Session::get('info') ?>");
 <?php }?>

 $(document).ready(function() {
     $('[id^="checkbox-listing-"]').change(function() {
          $('[id^="checkbox-listing-"]').not(this).prop('checked', false);
     });

     //CKEDITOR.replace('content');
 });

</script>


<script type="text/javascript">

function commonDeleteAjax(url = false, post_data = false) {

    const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        })
        swalWithBootstrapButtons.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: post_data,
                    success: function(response) {

                      if (response.success) {
                          Swal.fire({
                                  icon: 'success',
                                  title: 'Deleted!',
                                  text: response.success, 
                              }).then((result) => {
                                if(result.value) {
                                  window.location.reload();
                                }                                  
                              });
                           } else {
                              Swal.fire({
                                  icon: 'error',
                                  title: response.error,
                                  text: 'Not able to proecess your request',  
                              }).then((result) => {
                                if(result.value) {
                                  window.location.reload();
                                }                                  
                           });
                        }
                    },
                });
            } else if (
                /* Read more about handling dismissals below */

                result.dismiss === Swal.DismissReason.cancel
            ) {
               
                swalWithBootstrapButtons.fire(
                    'Cancelled',
                    'Your imaginary file is safe :)',
                    'error'
                )

            }
        })
}

$(document).ready(function() {
  $('[id^="delete-"]').click(function() {
          var url = $('[id^="delete-"]').data('url');
          var post_data =   {
                  "_token": "{{ csrf_token() }}",
              };
          commonDeleteAjax(url, post_data);
        
      });
});


$(function(){
    $('#blog-form').submit(function() {
        $('#loader').show(); 
        $(".hide-off").hide();
      return true;
    });
});

/*** Bulk Delete start ***/

$(document).on('click', '#select_all', function() {
    $(".emp_checkbox").prop("checked", this.checked);
    $("#select_count").html($("input.emp_checkbox:checked").length + " Selected");
});
$(document).on('click', '.emp_checkbox', function() {
    if ($('.emp_checkbox:checked').length == $('.emp_checkbox').length) {
        $('#select_all').prop('checked', true);
    } else {
        //$(this).prop('checked', true);
        $("#select_all").prop('checked', false);
    }
});
$('#delete_records').on('click', function(e) { 

    var url  = $('#bulk_del_url').val();
    var employee = [];
    $(".emp_checkbox:checked").each(function() {
        employee.push($(this).data('emp-id'));
    });
    if (employee.length <= 0) {
        
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Please select an item to delete!',
        });
    } else {
          var post_data =   {
                    "_token": "{{ csrf_token() }}",
                    ids: employee,
          };
          commonDeleteAjax(url, post_data);
    }
});

/*** Bulk Delete end ***/

$(document).ready(function() {

   /*** FILTER START ***/

    $("#filter-records").change( function() {
       var option_value = $(this).val();
       var route = $(this).data('url');
       var arr = option_value.split('-');
       var url = route + '?filter='+ arr[0] + '&month=' + arr[1];
       window.location.href = url;
    });

    $("#filter-blog").change( function() {
       var option_value  = $(this).val();
       var route = $(this).attr('data-url');
       var arr = option_value.split('-');
      //  var url = route + '?filter='+ arr[0] + '&month=' + arr[1];
       var url = route + '?filter='+ arr[0];
       window.location.href = url;

    });

    /*** FILTER END ***/

  /**** Functionality in progress message start ****/

    $("#in-progress").click(function() {
        Swal.fire({
            icon: 'error',
            title: 'Coming Soon',
            text: 'Functionality is under construction.'
        });
    });

  /**** Functionality in progress message end ****/

});

$(function () {
      $('.textarea').summernote({
          imageAttributes: {
          icon: '<i class="note-icon-pencil"/>',
          figureClass: 'figureClass',
          figcaptionClass: 'captionClass',
          captionText: 'Caption Goes Here.',
          manageAspectRatio: true // true = Lock the Image Width/Height, Default to true
        },
        //lang: 'en-US',
        popover: {
            image: [
                ['image', ['resizeFull', 'resizeHalf', 'resizeQuarter', 'resizeNone']],,
                ['float', ['floatLeft', 'floatRight', 'floatNone']],
                ['remove', ['removeMedia']],
                ['custom', ['imageAttributes']],
            ],
        },
     });
     @if(isset($blog['content']))
         var content = {!! json_encode($blog['content']) !!};
         $('.textarea').summernote('code', content);
    @endif          
});


function readURL(input, preview ='') {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e) {
      $(preview).css("display","block");
      $(preview).attr('src', e.target.result);
    }
    
    reader.readAsDataURL(input.files[0]); // convert to base64 string
  }
}

$("#author-image").change(function() {
   var preview = "#blah"; 
   var file_type = this.files[0].type;
    if(file_type =='image/png' || file_type =='image/jpeg' || file_type =='image/jpg' || file_type =='image/gif' ) {
       readURL(this, preview);
     } else {
      toastr.error('Only jpg, jpeg, png format allowed.');
      $("#author-image").val('');
    }
 });

$("#fileid").change(function() {
  var preview = "#feature-image-preview"; 
  var file_type = this.files[0].type;
  console.log(file_type);
  if(file_type =='image/png' || file_type =='image/jpeg' || file_type =='image/jpg' || file_type =='image/gif' ) {
     readURL(this, preview);
    } else {
     toastr.error('Only jpg, jpeg, png format allowed.');
      $("#fileid").val('');
   }
});

 
 $(document).ready(function() {
    $("#search-tag").bind("keyup change", function(e) {
          var tag = $(this).val();

          $.ajax({
             type: 'POST',
             url : '{!! route('admin.search-tag') !!}',
             data: { 
              "_token": "{{ csrf_token() }}",
               search : tag 
             },
             success:function(data) {
              console.log('check data', data);
                if(data) {
                   //$("#search-results").show();
                   $("#search-results").html(data.tags)
                
                } else {
                    $("#search-results").html('');
                }
             }, 
             error:function(data) {
               console.log('error', data);
             }
          });
    });
   });

    var tags = [];  
    var selected_tag_name = [];
    function addTag(obj) {
     
      if(jQuery.inArray(obj, tags) === -1) {
         tags.push(obj);
         $("#b-tags").val(tags);

         var tag_name = $("#add-tag-"+obj).data('id');
         selected_tag_name.push('<div id="tag-'+obj+'" style="position: relative;" class="img-wrap"><span class="close" onclick="removeTag('+obj+')" style="position: absolute; top: 2px;right: 2px;z-index: 100;" >&times;</span>'+tag_name+
          '</div>');
          $("#selected-tags").html(selected_tag_name);

      }  
    }

    function removeTag(obj) {
      
         var ary = tags;
         var array =   removeA(ary, obj);
         $("#b-tags").val(tags); 

         var arr1 = selected_tag_name;
         var value = $("#tag-"+obj).text();
         var tag_name = value.split('×'); 

         var obj2 = '<div id="tag-'+obj+'" style="position: relative;" class="img-wrap"><span class="close" onclick="removeTag('+obj+')" style="position: absolute; top: 2px;right: 2px;z-index: 100;" >&times;</span>'+tag_name[1]+
          '</div>';
          var array =   removeA(arr1, obj2);
         $("#selected-tags").html(selected_tag_name);
    
    }

    function removeA(arr) {
      var what, a = arguments, L = a.length, ax;
      while (L > 1 && arr.length) {
          what = a[--L];
          while ((ax= arr.indexOf(what)) !== -1) {
              arr.splice(ax, 1);
          }
      }
      return arr;
    }   
   





document.getElementById('buttonid').addEventListener('click', openDialog);

function openDialog() {
     document.getElementById('fileid').click();
}

/*document.getElementById('buttonid1').addEventListener('click', openDialog1);

function openDialog1() {
     document.getElementById('fileid1').click();
}*/
  
</script>


<script>  
  
$(document).ready(function(){
  //alert('ddasd');
  
  $image_crop = $('#image-preview').croppie({
    enableExif:true,
    viewport:{
      width:200,
      height:200,
      type:'circle'
    },
    boundary:{
      width:300,
      height:300
    }
  });

  $('#upload_image').change(function(){
    
    $(".show-cropper").css({'display':'block'});
    var file_type = this.files[0].type;
    if(file_type =='image/png' || file_type =='image/jpeg' || file_type =='image/jpg' || file_type =='image/gif' ) {
       
      toastr.info('Please crop the image before submit by clicking crop button.');
      var reader = new FileReader();

      reader.onload = function(event){
        $image_crop.croppie('bind', {
          url:event.target.result
        }).then(function(){
          console.log('jQuery bind complete');
        });
      }
      reader.readAsDataURL(this.files[0]);

      $("#blah").css({'display':'none'});
    }  else {
      toastr.error('Only jpg, jpeg, png format allowed.');
      $("#author-image").val('');
    }
  });

  $('.crop_image').click(function(event){
    $image_crop.croppie('result', {
      type:'canvas',
      size:'viewport'
    }).then(function(response){
      if(response) {
         toastr.success('Image cropped successfully!');
         $("#encode_image").val(response);
          return true;
      } else {
         toastr.success('Technical error.');
      }
       
    });
  });
  
});  
</script>
</body>
</html>