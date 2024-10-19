<script type="text/javascript">
  $(document).ready(function() {
    $("#lightSlider").lightSlider(); 
  });
</script>

<script>
    lightbox.option({
      'resizeDuration': 200,
      'wrapAround': true,
      'fitImagesInViewport':true,
      'minHeight': 700, 
      'minWidth': 700
    })
</script>
<script>
   <?php if(Session::has('success')) { ?>
     toastr.success("<?php echo Session::get('success') ?>","");
   <?php } else if(Session::has('error')) { ?>
     toastr.error("<?php echo Session::get('error') ?>");
   <?php } else if(Session::has('warning')) { ?>
     toastr.warning("<?php echo Session::get('warning') ?>");
   <?php } else if(Session::has('info')) { ?>
     toastr.info("<?php echo Session::get('info') ?>");
   <?php }?>
 </script>
 <script type="text/javascript">
   $('ul.nav-tabs li a').click(function (e) {
   $('ul.nav-tabs li.active').removeClass('active')
   $(this).parent('li').addClass('active')
})
 </script>

<script>

  // document.onkeydown = function(event){
  //   if(window.event.keyCode =='13'){
  //       LoginUser();
  //       event.preventDefault();
  //   }
  // }

   $(document).ready(function() {
       
       $("#").click(function() {
           var id = $(this).val();
           var url = '{!! route('blog.index') !!}';
           var new_url = url+'/'+id;
           window.location.href = new_url;
       });
   });
  
  function LoginUser(event) {
    event.preventDefault();
            var email    = $("input[name=email]").val();
            var password = $("input[name=password]").val();
            var data = {
               "_token": "{{ csrf_token() }}",
                email:email,
                password:password
            };
            var url= '{!! route('login.user') !!}';
            $.ajax({
                type: "post",
                url: url,
                data: data,
                beforeSend: function(){
                // Show image container
                $("#loader").show();
                $("#login-button").hide();
               },
                success: function (data) {
                    if(data.status =='success') {
                      $('#login').modal('hide');
                        toastr.success(data.message);
                        if(data.role_id == '3') {
                          window.location.href='{!! route('buyer.dashboard') !!}' } else if(data.role_id=='4'){
                          window.location.href='{!! route('seller.index') !!}'
                          }
                        } else if(data.status =='error') {
                           //toastr.error(data.message);
                           $("#login-button").show();
                           $("#cred_error").html(data.message);
                           return false;
                    }

                },
                 complete:function(data){
                     // Hide image container
                     $("#loader").hide();
                 },
                error: function (data){
                if(data) {
                    $("#email").html(data.responseJSON.validation_errors.email);
                    $("#password").html(data.responseJSON.validation_errors.password);
                }
                    //toastr.warning('Fail to run Login..');
                }
            });
            return false;
        }

/*Buyer Section Function */

function addBuyerMessage(talentId){

         var url = '{!! route('buyer.addBuyerMessage') !!}';
         var message_title = $("#message_title"+talentId).val();
         var message = $("textarea#message"+talentId).val();
         $.ajax({
            type: "post",
            url: url,
            data: {
                  "_token": "{{ csrf_token() }}",
                  "talent_id":talentId,
                  "message_title":message_title,
                  "message":message
            },
            success: function(response){
                 if(response.success) {
                   $('[id^="myModal-message"]').modal('hide');
                    toastr.success(response.success);
                       setTimeout(function(){ window.location.reload() }, 1000);
                 }
                 if(response.error) {
                    toastr.error(response.error);
                 }
            },
            error: function(data){
              if(data) {
                $("#title_error"+talentId).html(data.responseJSON.validation_errors.message_title);
                $("#message_error"+talentId).html(data.responseJSON.validation_errors.message);
              }
            }
        });
}
function deleteBuyerProduct(buyerId,talentId){
         $('[id^="myModal-del"]').modal('hide');
         var url = '{!! route('buyer.deleteBuyerProduct') !!}';
         $.ajax({
            type: "post",
            url: url,
            data: {
                  "_token": "{{ csrf_token() }}",
                  "id":buyerId,
                  "talent_id":talentId
            },
            success: function(response){
                 if(response.success) {
                    toastr.success(response.success);
                       setTimeout(function(){ window.location.reload() }, 1000);
                 }
                 if(response.error) {
                    toastr.error(response.error);
                  }
                  if(response.warning) {
                    toastr.warning(response.warning);
                  }
            },
            error: function(data){
              if(data){
                toastr.error('Bad Request.');
              }
            }
        });

}

function addRating(talentId){

         var url = '{!! route('buyer.addBuyerRating') !!}';
         var rating = $('input[name="rating"]:checked').val();
         var message = $("textarea#comment"+talentId).val();

         $.ajax({
            type: "post",
            url: url,
            data: {
                  "_token": "{{ csrf_token() }}",
                  "talent_id":talentId,
                  "award_to_talent":rating,
                  "comment":message
            },
            success: function(response){
                 if(response.success) {
                   $('[id^="myModal-tro"]').modal('hide');
                    toastr.success(response.success);
                       setTimeout(function(){ window.location.reload() }, 1000);
                 }
                 if(response.error) {
                    toastr.error(response.error);
                 }
            },
            error: function(data){
              if(data) {
                $("#rating"+talentId).html(data.responseJSON.validation_errors.award_to_talent);
                $("#messagerating"+talentId).text(data.responseJSON.validation_errors.comment);
              }
            }
        });
}
function addCommentToTalent(talentId){

         var url = '{!! route('buyer.addCommentToTalent') !!}';
         var message = $("textarea#leaveComment"+talentId).val();
         $.ajax({
            type: "post",
            url: url,
            data: {
                  "_token": "{{ csrf_token() }}",
                  "talent_id":talentId,
                  "comment":message
            },
            success: function(response){
                 if(response.success) {
                   $('[id^="myModal-coment"]').modal('hide');
                    toastr.success(response.success);
                       setTimeout(function(){ window.location.reload() }, 1000);
                 }
                 if(response.error) {
                    toastr.error(response.error);
                 }
            },
            error: function(data){
              if(data) {
                $("#commentError"+talentId).html(data.responseJSON.validation_errors.comment);

              }
            }
        });
}
function downloadProduct(talentId) {
         var url = '{!! route('buyer.downloadBuyerProduct') !!}';
         $.ajax({
            type: "post",
            url: url,
            data: {
                  "_token": "{{ csrf_token() }}",
                  "talent_id":talentId,
            },
            success: function(response){
                if(response.zip) {
                      $('[id^="myModal"]').modal('hide');
                      var newWindow = window.open("","_blank");
                      newWindow.location.href = response.zip.download_url;

                  }
            },
            error: function(data){
                 if(data){
                    toastr.error('Bad Request');
                 }
            }
        });
}


function editPromoteProduct(talentId){
         var socialMedia = $('input[name="media"]:checked').val();
         var title = $("#s-title"+talentId).val();
         var message = $("textarea#commentToShare"+talentId).val();
         var url = '{!! route('seller.edit-promote-product') !!}';

        $.ajax({
            type: "post",
            url: url,
            data: {
                  "_token": "{{ csrf_token() }}",
                  "promote_id":talentId,
                  "title": title,
                  "message": message,
                  "social_name": socialMedia
            },
            success: function(response){
                  if(response.success) {
                   $('[id^="myModal-editPromoteProduct"]').modal('hide');
                    toastr.success(response.success);
                       setTimeout(function(){ window.location.reload() }, 1000);
                 }
                 if(response.error) {
                    toastr.error(response.error);
                 }
            },
            error: function(data){
              if(data) {
                  $("#titleError"+talentId).text(data.responseJSON.validation_errors.title);
                  $("#messageError"+talentId).text(data.responseJSON.validation_errors.message);
                  $("#socialNameError"+talentId).text(data.responseJSON.validation_errors.social_name);
              }
            }
        });
}

/*************** SELLER  *********************/


 function postSellerContact(seller) {
        var url = '{!! route('seller.post-seller-contact') !!}';
        var name = $("#name").val();
        var email = $("input[type='email']#seller_email").val();
        var message = $("textarea#seller_message").val();
         $.ajax({
            type: "post",
            url: url,
            data: {
                  "_token": "{{ csrf_token() }}",
                  "name":name,
                  "email":email,
                  "message":message
            },
            success: function(response){
                 if(response.success) {
                   $('[id^="myModal-product"]').modal('hide');
                    toastr.success(response.success);
                       setTimeout(function(){ window.location.reload() }, 1000);
                 }
                 if(response.error) {
                    toastr.error(response.error);
                 }
            },
            error: function(data){
              if(data) {
                  $("#nameError").text(data.responseJSON.validation_errors.name);
                  $("#emailError").text(data.responseJSON.validation_errors.email);
                  $("#messageError").text(data.responseJSON.validation_errors.message);
              }
            }
        });
 }

 function postCustomPlan(seller) {

        var url = '{!! route('seller.custom-plan') !!}';
        var message = $("textarea#custom_plan").val();
         $.ajax({
            type: "post",
            url: url,
            data: {
                  "_token": "{{ csrf_token() }}",
                  "custom_plan":message
            },
            success: function(response){
                 if(response.success) {
                  $("textarea#custom_plan").val('');
                    toastr.success(response.success);
                       setTimeout(function(){ window.location.reload() }, 1000);
                 }
                 if(response.error) {
                    toastr.error(response.error);
                 }
            },
            error: function(data){
              if(data) {
                  $("textarea#custom_plan").css("border-color", "red");
                  toastr.error(data.responseJSON.validation_errors.custom_plan);
              }
            }
        });
 }


function deleteSellerProduct(talentId){
         $('[id^="myModal-del"]').modal('hide');
         var url = '{!! route('seller.delete-my-product') !!}';
         $.ajax({
            type: "post",
            url: url,
            data: {
                  "_token": "{{ csrf_token() }}",
                  "talent_id":talentId
            },
            success: function(response){
                 if(response.success) {
                    toastr.success(response.success);
                       setTimeout(function(){ window.location.reload() }, 1000);
                 }
                 if(response.error) {
                    toastr.error(response.error);
                  }
                  if(response.warning) {
                    toastr.warning(response.warning);
                  }
            },
            error: function(data){
              if(data){
                toastr.error('Bad Request.');
              }
            }
        });
}
function deleteSellerPromoteProduct(talentId){
         $('[id^="myModal-del"]').modal('hide');
         var url = '{!! route('seller.delete-promote-product') !!}';
         $.ajax({
            type: "post",
            url: url,
            data: {
                  "_token": "{{ csrf_token() }}",
                  "promote_id":talentId
            },
            success: function(response){
                 if(response.success) {
                    toastr.success(response.success);
                       setTimeout(function(){ window.location.reload() }, 1000);
                 }
                 if(response.error) {
                    toastr.error(response.error);
                  }
                  if(response.warning) {
                    toastr.warning(response.warning);
                  }
            },
            error: function(data){
              if(data){
                toastr.error('Bad Request.');
              }
            }
        });
}
function filter(selected)
{
         if(selected.value !='') {
             var url = '{!! route('seller.my-product') !!}/days/'+selected.value;
         } else {
             var url = '{!! route('seller.my-product') !!}';
         }
         window.location.href=url;
}
function filterDeletedProducts(selected)
{
         if(selected.value !='') {
             var url = '{!! route('seller.my-deleted-product') !!}/days/'+selected.value;
         } else {
             var url = '{!! route('seller.my-deleted-product') !!}';
         }
         window.location.href=url;
}
function filterPromotedProduct(selected)
{
         if(selected.value !='') {
             var url = '{!! route('seller.promote-product') !!}/days/'+selected.value;
         } else {
             var url = '{!! route('seller.promote-product') !!}';
         }
         window.location.href=url;
}

/****************** END ***********************/

/****************** TALENT FUNCTIONS **********************/

function awardTalent(talentId) {
        $('[id^="giveAward"]').modal('hide');
         var url = '{!! route('talent.give-award') !!}';
         $.ajax({
            type: "post",
            url: url,
            data: {
                  "_token": "{{ csrf_token() }}",
                  "talent_id":talentId
            },
            success: function(response){
                 if(response.success) {
                    toastr.success(response.success);
                       setTimeout(function(){ window.location.reload() }, 1000);
                 }
                 if(response.error) {
                   toastr.error(response.error);
                 }
                 if(response.info) {
                   toastr.info(response.info);
                 }
            },
            error: function(data){
              if(data){
                toastr.error('Bad Request.');
              }
            }
        });
}

function addRiderToTalent(talentId) {
        $('[id^="giveAward"]').modal('hide');
         var url = '{!! route('talent.add-rider') !!}';
         $.ajax({
            type: "post",
            url: url,
            data: {
                  "_token": "{{ csrf_token() }}",
                  "talent_id":talentId
            },
            success: function(response){
                 if(response.success) {
                    toastr.success(response.success);
                       setTimeout(function(){ window.location.reload() }, 1000);
                 }
                 if(response.error) {
                   toastr.error(response.error);
                 }
                 if(response.info) {
                   toastr.info(response.info);
                 }
            },
            error: function(data){
              if(data){
                toastr.error('Bad Request.');
              }
            }
        });
}

function addBuyerContactMessage(talentId){

         var url = '{!! route('talent.add-buyer-contact-message') !!}';
         var message_title = $("#title").val();
         var message = $("textarea#message").val();
         $.ajax({
            type: "post",
            url: url,
            data: {
                  "_token": "{{ csrf_token() }}",
                  "talent_id":talentId,
                  "message_title":message_title,
                  "message":message
            },
            success: function(response){
                 if(response.success) {
                   $('[id^="sendMessage"]').modal('hide');
                    toastr.success(response.success);
                       setTimeout(function(){ window.location.reload() }, 1000);
                 }
                 if(response.error) {
                    toastr.error(response.error);
                 }
            },
            error: function(data){
              if(data) {
                $("#title_error").html(data.responseJSON.validation_errors.message_title);
                $("#message_error").html(data.responseJSON.validation_errors.message);
              }
            }
        });
  }

  function addToCart(talentId) {
      var url = '{!! route('talent.add-talent-to-cart') !!}';
         $.ajax({
            type: "post",
            url: url,
            data: {
                  "_token": "{{ csrf_token() }}",
                  "talent_id":talentId,
            },
            success: function(response){
                 if(response.success) {
                    toastr.success(response.success);
                       setTimeout(function(){ window.location.reload() }, 500);
                 }
                 if(response.error) {
                    toastr.error(response.error);
                 }
                 if(response.info) {
                    toastr.info(response.info);
                 }
            },
            error: function(data){
              if(data){
                 toastr.error('Bad Request.');
               }
            }
        });
  }

/******************* END ************************************/

function openForgetPasswordModal(){
      $('#login').modal('hide');
      $('#forgotPasswordModal').modal('show');
}
function openLoginModal(){
      $('#register_my_model').modal('hide');
      $('#login').modal('show');
}
function forgotPassword() {
         var url = '{!! route('forgot-password') !!}';
         var email = $("#forget_email").val();
         alert(email);
         $.ajax({
            type: "post",
            url: url,
            data: {
                  "_token": "{{ csrf_token() }}",
                  "email":email,
            },
            success: function(response){
                 if(response.validation_error) {
                    toastr.warning(response.validation_error);
                 }
                 if(response.success) {
                    toastr.success(response.success);
                       setTimeout(function(){ window.location.reload() }, 1000);
                 }
                 if(response.error) {
                  toastr.error(response.error);
                 }
                 if(response.warning) {
                    toastr.warning(response.warning);
                  }
            },
            error: function(data){
              if(data){
                toastr.error('Bad Request.');
              }
            }
        });

}

function readURL(input) {
  if (input.files && input.files[0]) {
    $('#showImage').show();
    var reader = new FileReader();

    reader.onload = function(e) {
      $('#showImage').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
  }
}

$("#uploadBtn").change(function() {
  readURL(this);
});

$(function(){
  $('#showImage').hide();
});



 /* $('.modal').on('hidden.bs.modal', function(){
    $('.invalid-feedback').text('');
    $(this).find('form')[0].reset();
});*/


</script>
<script type="text/javascript">
  $(document).on('click', '#select_all', function() {
    $(".emp_checkbox").prop("checked", this.checked);

    $("#select_count").html($("input.emp_checkbox:checked").length+" Selected");
  });
  $(document).on('click', '.emp_checkbox', function() {
    if ($('.emp_checkbox:checked').length == $('.emp_checkbox').length) {
      $('#select_all').prop('checked', true);

    } else {
      $('#select_all').prop('checked', false);

    }
    $("#select_count").html($("input.emp_checkbox:checked").length+" Selected");
  });
</script>

<script>
  $('#delete_records').on('click', function(e) {
    var employee = [];
    $(".emp_checkbox:checked").each(function() {
       employee.push($(this).data('emp-id'));
    });
    if(employee.length <=0) {
          toastr.warning('Please select products to delete.'); }
      else {
        if(confirm("Are you sure you want to delete "+(employee.length>1?"these":"this")+" products?") ){

               var selected_values = employee.join(",");
               $.ajax({
                type: "POST",
                url: "<?= route('seller.bulk-delete-my-product'); ?>",
                cache:false,
                data: {talent_id: selected_values, _token: '{{ csrf_token()}}'},
                success: function(response) {

                 if(response.success) {
                    toastr.success(response.success);
                       setTimeout(function(){ window.location.reload() }, 1000);
                 }
                 if(response.error) {
                  toastr.error(response.error);
                 }
                 if(response.warning) {
                    toastr.warning(response.warning);
                  }
            },
            error: function(data){
              if(data) {
                toastr.error('Bad Request.');
              }
            }
               });
        } else  {
                toastr.info('All information related to these products are safe.');
                $('#select_all').prop('checked', false);
                $('.emp_checkbox').prop('checked', false);
         }
        }
  });
</script>

<!-- undelete the products-->

<script>
  $('#delete_records_undo').on('click', function(e) {
    var employee = [];
    $(".emp_checkbox:checked").each(function() {
       employee.push($(this).data('emp-id'));
    });
    if(employee.length <=0) {
          toastr.warning('Please select products to undo.');
      }
      else {
        if(confirm("Are you sure you want to undo "+(employee.length>1?"these":"this")+" products?") ){

               var selected_values = employee.join(",");
               $.ajax({
                type: "POST",
                url: "<?= route('seller.bulk-deleted-my-product-undo'); ?>",
                cache:false,
                data: {talent_id: selected_values, _token: '{{ csrf_token()}}'},
                success: function(response) {

                 if(response.success) {
                    toastr.success(response.success);
                       setTimeout(function(){ window.location.href='{!! route('seller.my-product') !!}' }, 1000);
                 }
                 if(response.error) {
                  toastr.error(response.error);
                 }
                 if(response.warning) {
                    toastr.warning(response.warning);
                  }
            },
            error: function(data){
              if(data){
                toastr.error('Bad Request.');
              }
            }
               });
        } else  {
                toastr.info('All information related to these products are safe.');
                $('#select_all').prop('checked', false);
                $('.emp_checkbox').prop('checked', false);
         }
        }
  });
</script>


<!-- Delete products permanently -->

<script>
  $('#delete_records_permanently').on('click', function(e) {
    var employee = [];
    $(".emp_checkbox:checked").each(function() {
       employee.push($(this).data('emp-id'));
    });
    if(employee.length <=0) {
      toastr.warning('Please select products to delete permanently.'); }
      else {

        if(confirm("Are you sure you want to delete permanently "+(employee.length>1?"these":"this")+" products?") ){

               var selected_values = employee.join(",");
               $.ajax({
                type: "POST",
                url: "<?= route('seller.bulk-deleted-my-product-permanently'); ?>",
                cache:false,
                data: {talent_id: selected_values, _token: '{{ csrf_token()}}'},
                success: function(response) {

                 if(response.success) {
                    toastr.success(response.success);
                       setTimeout(function(){ window.location.href='{!! route('seller.my-product') !!}' }, 1000);
                 }
                 if(response.error) {
                  toastr.error(response.error);
                 }
                 if(response.warning) {
                    toastr.warning(response.warning);
                  }
            },
            error: function(data){
              if(data){
                toastr.error('Bad Request.');
              }
            }
               });
        } else  {
                toastr.info('All information related to these products are safe.');
                $('#select_all').prop('checked', false);
                $('.emp_checkbox').prop('checked', false);
         }
        }
  });
</script>
<script>
  $(window).on('load', function() {
     $(".search-results").css({"display":"none",});

  });
</script>
<script>
$(document).ready(function(){
  $("#search").keyup(function(){
    $(".search-results").css({"display":"block","opacity":"1"});
    var search = $(this).val();
    if(search !='' || search !=null || search != undefined ) {
          $.ajax({
          type: "POST",
          url: '{!! route('search') !!}',
          data: {search: search, _token: '{{ csrf_token()}}'},
          success: function(data){
              if(data) {
                   $(".search-results").show();
                   $(".search-results").html('<li  class="search-results-heading">Talents <span  class="search-result-counts"> ('+data.talentCount+') </span>'+
                                                  '</li>'+data.talents+
                      '<li  class="search-results-heading Categories">Categories <span  class="search-result-counts"> ('+data.categoriescount+') </span> </li>'+
                         data.categories
                    );
                } else {
                     $(".search-results").css({"display":"none","opacity":"0"});
                     $(".search-results").html('');
                }
             }
          });
      }
  });
});

</script>
<script type="text/javascript">
  $(document).ready(function(){
      $('#profile_pic').change(function() {
        readURL(this);
       var fileName = $('#profile_pic')[0].files[0].name;
       var file = $('#profile_pic')[0].files[0];
       var fileType = file["type"];
       var validImageTypes = ["image/gif", "image/jpeg", "image/png"];
       if ($.inArray(fileType, validImageTypes) > 0) {
           $("#noFile2").text(fileName);
       } else {
           toastr.error('File size should be less than or equal to 2MB.');
           $("#profile_pic").val('');
           $("#noFile2").text('');

       }
   });
  });
  function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      $('#profile-image').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
  }
}
$("#profile-imageModal").on("hidden.bs.modal", function(){
    $('#profile-image').attr('src','');
    $("#noFile2").val('');
    toastr.info('No changes done to profile picture.');
    window.location.reload();
});
</script>
<script>
  $(document).ready(function(){

 $('#upload_form').on('submit', function(event){
  event.preventDefault();
  $.ajax({
   url:"{{ route('image-upload') }}",
   method:"POST",
   data:new FormData(this),
   dataType:'JSON',
   contentType: false,
   cache: false,
   processData: false,
   success:function(response) {
    if(response.success) {
        toastr.success(response.success);
           setTimeout(function(){ window.location.reload(); }, 1000);
     }
     if(response.error) {
      toastr.error(response.error);
     }
     if(response.warning) {
        toastr.warning(response.warning);
      }
   }
  })
 });

});
</script>
<!-- <script>
document.onkeydown = function(e) {
        if (e.ctrlKey &&
            (e.keyCode === 67 ||
             e.keyCode === 86 ||
             e.keyCode === 85 ||
             e.keyCode === 117)) {
            return false;
        } else {
            return true;
        }
};
$(document).keypress("u",function(e) {
  if(e.ctrlKey)
  {
return false;
}
else
{
return true;
}
});
</script> -->
@if(Auth::user() && Auth::user()->role_id =='3')
<script>
  $(document).ready(function(){
         var url = '{!! route('buyer.checkUserlogin') !!}';
         $.ajax({
            type: "GET",
            url: url,
            data: {
                  "_token": "{{ csrf_token() }}",
            },
            success: function(response){
                if(response.checkUserlogin != null) {
                     $("#account_change_modal").modal('show');
                }
            },
            error: function(data){
              if(data) {
                toastr.error('Bad Request.');
              }
            }
        });
});
</script>
@endif
<script type="text/javascript">
function openNextTab() {
      $("#account_change_modal").modal('hide');
      $("#account_change_modal1").modal('show');
}

function openPrevousTab() {
      $("#account_change_modal1").modal('hide');
      $("#account_change_modal").modal('show');
}

$(".change_account").click(function(){
    var accountid = $(this).data('id');
    if(accountid){

         $("#account_change_modal2").modal('show');
         var url = '{!! route('buyer.update-user-account') !!}';
         $.ajax({
            type: "POST",
            url: url,
            data: {
                  "_token": "{{ csrf_token() }}",
                  "role" :accountid
            },
            success: function(response){
                 if(response.success) {
                    toastr.success(response.success);
                       setTimeout(function(){ window.location.reload() }, 1000);
                 }
                 if(response.error) {
                  toastr.error(response.error);
                 }
                 if(response.warning) {
                    toastr.warning(response.warning);
                  }
            },
            error: function(data){
              if(data) {
                toastr.error('Bad Request.');
              }
            }
      });
    }

});
 function closeRegister() {
    $("#register_my_model").modal('hide');
    $("#login").modal('show');
 }
</script>
