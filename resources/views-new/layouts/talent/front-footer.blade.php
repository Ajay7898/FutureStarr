<!--chat-module-->
@if(!empty(Auth::check()) && Auth::user()->role_id != '1')

<div style="display:block;" style="" class="round hollow text-center" id="open-chat-window">
   <a  href="javascript:void(0);"> 
         <!-- <i class="fa fa-commenting-o" aria-hidden="true"></i> -->
      <img alt="profileImage" src="{{ !empty(Auth::user()->profile_pic) && file_exists(Auth::user()->profile_pic) ? asset(Auth::user()->profile_pic): url('assets/images/star-logo.png') }}">
      <span><i  class="fa fa-star text-success" aria-hidden="true"></i></span>
   </a>
</div>

<style type="text/css">
#open-chat-window img{
	width: 70px;
    height: 70px;
    border-radius: 100%;
    object-fit: cover;
	border: 1.5px solid #f5f6fa;
}
#open-chat-window i.fa.fa-star{
	top: 2.2em !important;
    left: 2.2em !important;
}
  #chat.chat-open-class {
    top: auto;
    bottom: calc(-100% + 200px);
}



  
</style>

@include('chat-module')

@include('chat-box')

@endif
<!-- chat box code-->

<!--footer-->
<footer style="background-color:#151829;">
  <div class=" container footer-s">
    <div class="row footer">

      <div class="col-sm-3">
        <h4 class="footer-s">Quick Links</h4>
        <p><a href="/">Home</a></p>
        <p><a href="{{ route('about-us') }}">About Us</a></p>
        <p><a href="{{ route('search.index') }}">Starr Search</a></p>
        <p><a href="{{ route('talent.index') }}">Talent Mall</a></p>
        <p><a href="{{ route('blog.index') }}">Blog</a></p>
        <p><a href="{{ route('contact-us.index') }}" style="color:#777;font-size:13px;">Contact Us</a></p>
      </div>

      <div class="col-sm-3">
        <h4 class="footer-s">Terms & Privacy</h4>
        <p><a href="{{ route('privacy-policy') }}">Privacy Policy</a></p>
        <p><a href="{{ route('term-conditions') }}">Terms and Conditions</a></p>
        <p><a href="{{ route('refund-policy') }}">Refund Policy</a></p>
      </div>

      <div class="footer-s col-sm-3">
        <h4>Contact us</h4>
          @php $site_config = site_config() @endphp
          <p>{!!  $site_config->address !!}</p>
      </div>

      <div class="col-sm-3">
        <h4 class="footer-s">Connect with Us</h4>
        <div class="footer-box">
          <ul class="social-icon">
            <li>
              <a data-toggle="tooltip" title="Facebook" href="{{ $site_config->facebook }}" target="_blank"><i
                  class="fa fa-facebook"></i></a>
            </li>
            <li>
              <a data-toggle="tooltip" title="Twitter" href="{{ $site_config->twitter }}" target="_blank"><i
                  class="fa fa-twitter"></i></a>
              </li>
            <li>
              <a data-toggle="tooltip" title="LinkedIn" href="{{ $site_config->linkedin }}" target="_blank"><i
                  class="fa fa-linkedin"></i></a>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <br>
    <div class="row">
      <div class="col-sm-12 footer-m">
        <p style="">© {{date('Y')}}, FutureStarr, All Rights Reserved</p>
      </div>
    </div>
  </div>
</footer>

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css"> -->

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
{{-- <link rel="stylesheet" type="text/css" href="{{asset('assets/css/toaster.css')}}"> --}}
<script src="{{asset('assets/lightbox.js')}}"></script>

<!-- <script src="https://js.pusher.com/4.1/pusher.min.js"></script> -->
<script src="{{ asset('assets/js/pusher.min.js') }}"></script>
<script src="{{ asset('assets/js/chat.js') }}"></script>

<script type="text/javascript">

  $(document).ready(function() {
    $("#lightSlider").lightSlider(); 
    $('[data-toggle="tooltip"]').tooltip()
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
	
  function inProgress(index) {
     if(index == 0) {
          var message = 'Video function not updated yet.';
     } else  {
          var message = 'Audio Call function not updated yet.';
     }
     toastr.info(message);
     return true;
  }
 </script>


<script>
    
    jQuery('a[data-toggle="tab"]').on('click', function (e) {
           event.preventDefault();
           jQuery.noConflict();
           var target = jQuery(e.target).attr("href") // activated tab
           if(target == '#bbb') {
               jQuery('#quick-reminder').modal('show');

           }
    });

   // document.onkeydown = function(event){
   //    if(window.event.keyCode =='13'){
   //        LoginUser();
   //        event.preventDefault(event);
   //    }
   // }


  function LoginUser(event) {
            event.preventDefault();
            var email    = jQuery("input[name=email]").val();
            var password = jQuery("input[name=password]").val();
            var remember = jQuery("input[name=remember]").val();
            var data = {
               "_token": "{{ csrf_token() }}",
                email:email,
                password:password,
                remember: remember
            };
            var url= '{!! route('login.user') !!}';
            jQuery.ajax({
                type: "post",
                url: url,
                data: data,
                beforeSend: function(){
                // Show image container
                jQuery("#loader").show();
                jQuery("#login-button").hide();
               },
                success: function (data) {
                    console.log('response data', data);
                    if(data.status =='success') {
                  
                        eraseCookie('user_id'); 
                        eraseCookie('username'); 
                        eraseCookie('image'); 
                        eraseCookie('profile_link'); 
                        eraseCookie('onoff'); 
                        eraseCookie('email'); 
                        toastr.success(data.message);
                        window.location.href= data.url;
          
                        } else if(data.status =='error') {
                           //toastr.error(data.message);
                           jQuery("#login-button").show();
                           jQuery("#cred_error").html(data.message);
                           return false;
                    }

                },
                 complete:function(data){
                     // Hide image container
                     jQuery("#loader").hide();
                 },
                error: function (data){
                if(data) {
                    jQuery("#email").html(data.responseJSON.validation_errors.email);
                    jQuery("#password").html(data.responseJSON.validation_errors.password);
                }
                    //toastr.warning('Fail to run Login..');
                }
            });
            return false;
        }
  function setCookie(key, value, expiry) {
      var expires = new Date();
      expires.setTime(expires.getTime() + (expiry * 24 * 60 * 60 * 1000));
      document.cookie = key + '=' + value + ';expires=' + expires.toUTCString();
  }

  function getCookie(key) {
      var keyValue = document.cookie.match('(^|;) ?' + key + '=([^;]*)(;|jQuery)');
      return keyValue ? keyValue[2] : null;
  }

  function eraseCookie(key) {
      var keyValue = getCookie(key);
      setCookie(key, keyValue, '-1');
  }
/*Buyer Section Function */

function addBuyerMessage(talentId){

         var url = '{!! route('buyer.addBuyerMessage') !!}';
         var message_title = jQuery("#message_title"+talentId).val();
         var message = jQuery("textarea#message"+talentId).val();
         jQuery.ajax({
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
                   jQuery('[id^="myModal-message"]').modal('hide');
                    toastr.success(response.success);
                       setTimeout(function(){ window.location.reload() }, 1000);
                 }
                 if(response.error) {
                    toastr.error(response.error);
                 }
            },
            error: function(data){
              if(data) {
                jQuery("#title_error"+talentId).html(data.responseJSON.validation_errors.message_title);
                jQuery("#message_error"+talentId).html(data.responseJSON.validation_errors.message);
              }
            }
        });
}
function deleteBuyerProduct(buyerId,talentId){
         jQuery('[id^="myModal-del"]').modal('hide');
         var url = '{!! route('buyer.deleteBuyerProduct') !!}';
         jQuery.ajax({
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
         var rating = jQuery('input[name="rating"]:checked').val();
         var message = jQuery("textarea#comment"+talentId).val();

         jQuery.ajax({
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
                   jQuery('[id^="myModal-tro"]').modal('hide');
                    toastr.success(response.success);
                       setTimeout(function(){ window.location.reload() }, 1000);
                 }
                 if(response.error) {
                    toastr.error(response.error);
                 }
            },
            error: function(data){
              if(data) {
                jQuery("#rating"+talentId).html(data.responseJSON.validation_errors.award_to_talent);
                jQuery("#messagerating"+talentId).text(data.responseJSON.validation_errors.comment);
              }
            }
        });
}
function addCommentToTalent(talentId){

         var url = '{!! route('buyer.addCommentToTalent') !!}';
         var message = jQuery("textarea#leaveComment"+talentId).val();
         jQuery.ajax({
            type: "post",
            url: url,
            data: {
                  "_token": "{{ csrf_token() }}",
                  "talent_id":talentId,
                  "comment":message
            },
            success: function(response){
                 if(response.success) {
                   jQuery('[id^="myModal-coment"]').modal('hide');
                    toastr.success(response.success);
                       setTimeout(function(){ window.location.reload() }, 1000);
                 }
                 if(response.error) {
                    toastr.error(response.error);
                 }
            },
            error: function(data){
              if(data) {
                jQuery("#commentError"+talentId).html(data.responseJSON.validation_errors.comment);

              }
            }
        });
}
function downloadProduct(talentId) {
         var url = '{!! route('buyer.downloadBuyerProduct') !!}';
         jQuery.ajax({
            type: "post",
            url: url,
            data: {
                  "_token": "{{ csrf_token() }}",
                  "talent_id":talentId,
            },
            success: function(response){
                if(response.zip) {
                      jQuery('[id^="myModal"]').modal('hide');
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
         var socialMedia = jQuery('input[name="media"]:checked').val();
         var title = jQuery("#s-title"+talentId).val();
         var message = jQuery("textarea#commentToShare"+talentId).val();
         var url = '{!! route('seller.edit-promote-product') !!}';

        jQuery.ajax({
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
                   jQuery('[id^="myModal-editPromoteProduct"]').modal('hide');
                    toastr.success(response.success);
                       setTimeout(function(){ window.location.reload() }, 1000);
                 }
                 if(response.error) {
                    toastr.error(response.error);
                 }
            },
            error: function(data){
              if(data) {
                  jQuery("#titleError"+talentId).text(data.responseJSON.validation_errors.title);
                  jQuery("#messageError"+talentId).text(data.responseJSON.validation_errors.message);
                  jQuery("#socialNameError"+talentId).text(data.responseJSON.validation_errors.social_name);
              }
            }
        });
}

/*************** SELLER  *********************/


 function postSellerContact(seller) {
        var url = '{!! route('seller.post-seller-contact') !!}';
        var name = jQuery("#name").val();
        var email = jQuery("input[type='email']#seller_email").val();
        var message = jQuery("textarea#seller_message").val();
         jQuery.ajax({
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
                   jQuery('[id^="myModal-product"]').modal('hide');
                    toastr.success(response.success);
                       setTimeout(function(){ window.location.reload() }, 1000);
                 }
                 if(response.error) {
                    toastr.error(response.error);
                 }
            },
            error: function(data){
              if(data) {
                  jQuery("#nameError").text(data.responseJSON.validation_errors.name);
                  jQuery("#emailError").text(data.responseJSON.validation_errors.email);
                  jQuery("#messageError").text(data.responseJSON.validation_errors.message);
              }
            }
        });
 }

 function postCustomPlan(seller) {

        var url = '{!! route('seller.custom-plan') !!}';
        var message = jQuery("textarea#custom_plan").val();
         jQuery.ajax({
            type: "post",
            url: url,
            data: {
                  "_token": "{{ csrf_token() }}",
                  "custom_plan":message
            },
            success: function(response){
                 if(response.success) {
                  jQuery("textarea#custom_plan").val('');
                    toastr.success(response.success);
                       setTimeout(function(){ window.location.reload() }, 1000);
                 }
                 if(response.error) {
                    toastr.error(response.error);
                 }
            },
            error: function(data){
              if(data) {
                  jQuery("textarea#custom_plan").css("border-color", "red");
                  toastr.error(data.responseJSON.validation_errors.custom_plan);
              }
            }
        });
 }


function deleteSellerProduct(talentId){
         jQuery('[id^="myModal-del"]').modal('hide');
         var url = '{!! route('seller.delete-my-product') !!}';
         jQuery.ajax({
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
         jQuery('[id^="myModal-del"]').modal('hide');
         var url = '{!! route('seller.delete-promote-product') !!}';
         jQuery.ajax({
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
        jQuery('[id^="giveAward"]').modal('hide');
         var url = '{!! route('talent.give-award') !!}';
         jQuery.ajax({
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

        jQuery('[id^="giveAward"]').modal('hide');
         var url = '{!! route('talent.add-rider') !!}';
         jQuery.ajax({
            type: "POST",
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
         var message_title = jQuery("#title").val();
         var message = jQuery("textarea#message").val();
         jQuery.ajax({
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
                   jQuery('[id^="sendMessage"]').modal('hide');
                    toastr.success(response.success);
                       setTimeout(function(){ window.location.reload() }, 1000);
                 }
                 if(response.error) {
                    toastr.error(response.error);
                 }
            },
            error: function(data){
              if(data) {
                jQuery("#title_error").html(data.responseJSON.validation_errors.message_title);
                jQuery("#message_error").html(data.responseJSON.validation_errors.message);
              }
            }
        });
  }

  function addToCart(talentId) {
      var url = '{!! route('talent.add-talent-to-cart') !!}';
         jQuery.ajax({
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
      jQuery('#login').modal('hide');
      jQuery('#forgotPasswordModal').modal('show');
}
function openLoginModal(){
      jQuery('#register_my_model').modal('hide');
      jQuery('#login').modal('show');
}
function forgotPassword() {
         var url = '{!! route('forgot-password') !!}';
         var email = jQuery("#forget_email").val();
         alert(email);
         jQuery.ajax({
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
    jQuery('#showImage').show();
    var reader = new FileReader();

    reader.onload = function(e) {
      jQuery('#showImage').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
  }
}

jQuery("#uploadBtn").change(function() {
  readURL(this);
});

jQuery(function(){
  jQuery('#showImage').hide();
});



 /* jQuery('.modal').on('hidden.bs.modal', function(){
    jQuery('.invalid-feedback').text('');
    jQuery(this).find('form')[0].reset();
});*/


</script>
<script type="text/javascript">
  jQuery(document).on('click', '#select_all', function() {
    jQuery(".emp_checkbox").prop("checked", this.checked);

    jQuery("#select_count").html(jQuery("input.emp_checkbox:checked").length+" Selected");
  });
  jQuery(document).on('click', '.emp_checkbox', function() {
    if (jQuery('.emp_checkbox:checked').length == jQuery('.emp_checkbox').length) {
      jQuery('#select_all').prop('checked', true);

    } else {
      jQuery('#select_all').prop('checked', false);

    }
    jQuery("#select_count").html(jQuery("input.emp_checkbox:checked").length+" Selected");
  });
</script>

<script>
  jQuery('#delete_records').on('click', function(e) {
    var employee = [];
    jQuery(".emp_checkbox:checked").each(function() {
       employee.push(jQuery(this).data('emp-id'));
    });
    if(employee.length <=0) {
          toastr.warning('Please select products to delete.'); }
      else {
        if(confirm("Are you sure you want to delete "+(employee.length>1?"these":"this")+" products?") ){

               var selected_values = employee.join(",");
               jQuery.ajax({
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
                jQuery('#select_all').prop('checked', false);
                jQuery('.emp_checkbox').prop('checked', false);
         }
        }
  });
</script>

<!-- undelete the products-->

<script>
  jQuery('#delete_records_undo').on('click', function(e) {
    var employee = [];
    jQuery(".emp_checkbox:checked").each(function() {
       employee.push(jQuery(this).data('emp-id'));
    });
    if(employee.length <=0) {
          toastr.warning('Please select products to undo.');
      }
      else {
        if(confirm("Are you sure you want to undo "+(employee.length>1?"these":"this")+" products?") ){

               var selected_values = employee.join(",");
               jQuery.ajax({
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
                jQuery('#select_all').prop('checked', false);
                jQuery('.emp_checkbox').prop('checked', false);
         }
        }
  });
</script>


<!-- Delete products permanently -->

<script>
  jQuery('#delete_records_permanently').on('click', function(e) {
    var employee = [];
    jQuery(".emp_checkbox:checked").each(function() {
       employee.push(jQuery(this).data('emp-id'));
    });
    if(employee.length <=0) {
      toastr.warning('Please select products to delete permanently.'); }
      else {

        if(confirm("Are you sure you want to delete permanently "+(employee.length>1?"these":"this")+" products?") ){

               var selected_values = employee.join(",");
               jQuery.ajax({
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
                jQuery('#select_all').prop('checked', false);
                jQuery('.emp_checkbox').prop('checked', false);
         }
        }
  });
</script>
<script>
  jQuery(window).on('load', function() {
     jQuery(".search-results").css({"display":"none",});

  });
</script>
<script>
jQuery(document).ready(function(){
  jQuery("#search").keyup(function(){
    jQuery(".search-results").css({"display":"block","opacity":"1"});
    var search = jQuery(this).val();
    if(search !='' || search !=null || search != undefined ) {
          jQuery.ajax({
          type: "POST",
          url: '{!! route('search') !!}',
          data: {search: search, _token: '{{ csrf_token()}}'},
          success: function(data){
             if(data) {
                   jQuery(".search-results").show();
                   jQuery(".search-results").html(data.searhlist);
                } else {
                     jQuery(".search-results").css({"display":"none","opacity":"0"});
                     jQuery(".search-results").html('');
               }
             }
          });
      }
  });
});

</script>
<script type="text/javascript">
  jQuery(document).ready(function(){
      jQuery('#profile_pic').change(function() {
        readURL(this);
       var fileName = jQuery('#profile_pic')[0].files[0].name;
       var file = jQuery('#profile_pic')[0].files[0];
       var fileType = file["type"];
       var validImageTypes = ["image/gif", "image/jpeg", "image/png"];
       if (jQuery.inArray(fileType, validImageTypes) > 0) {
           jQuery("#noFile2").text(fileName);
       } else {
           toastr.error('File size should be less than or equal to 2MB.');
           jQuery("#profile_pic").val('');
           jQuery("#noFile2").text('');

       }
   });
  });
  function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      jQuery('#profile-image').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
  }
}
jQuery("#profile-imageModal").on("hidden.bs.modal", function(){
    jQuery('#profile-image').attr('src','');
    jQuery("#noFile2").val('');
    toastr.info('No changes done to profile picture.');
    window.location.reload();
});
</script>
<script>
  jQuery(document).ready(function(){

 jQuery('#upload_form').on('submit', function(event){
  event.preventDefault();
  jQuery.ajax({
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
jQuery(document).keypress("u",function(e) {
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
  jQuery(document).ready(function(){
         var url = '{!! route('buyer.checkUserlogin') !!}';
         jQuery.ajax({
            type: "GET",
            url: url,
            data: {
                  "_token": "{{ csrf_token() }}",
            },
            success: function(response){
                if(response.checkUserlogin != null) {
                     jQuery("#account_change_modal").modal('show');
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
      jQuery("#account_change_modal").modal('hide');
      jQuery("#account_change_modal1").modal('show');
}

function openPrevousTab() {
      jQuery("#account_change_modal1").modal('hide');
      jQuery("#account_change_modal").modal('show');
}

jQuery(".change_account").click(function(){
    var accountid = jQuery(this).data('id');
    if(accountid){
         jQuery("#account_change_modal2").modal('show');
         var url = '{!! route('buyer.update-user-account') !!}';
         jQuery.ajax({
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
    jQuery("#register_my_model").modal('hide');
    jQuery("#login").modal('show');
 }

 jQuery(document).ready(function() {
  jQuery('[id^="un-follow-"]').click(function() {
          var url = jQuery(this).data('url');
          var post_data =   {
                  "_token": "{{ csrf_token() }}",
          };
          const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        })
        swalWithBootstrapButtons.fire({
            title: 'Are you sure?',
            text: "You want to unfollow this user",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, Unfollow!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                jQuery.ajax({
                    type: 'POST',
                    url: url,
                    data: post_data,
                    success: function(response) {

                      if (response.success) {
                          Swal.fire({
                                  icon: 'success',
                                  title: 'Unfollow!',
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
       

        
      });
}); 
</script>
<script>
  var preload = document.createElement("div");
  preload.className = "preloader";
  preload.innerHTML =
    '<p class="hello"><img src="{{ asset('assets/images/gif-img/img-5.gif')}}" alt="Preloader Image" class="img-fluid"></p><div id="preloader"><div id="loader"></div></div>';
  document.body.appendChild(preload);
  window.addEventListener("load", function() {
    //  Uncomment to fade preloader after document load
    preload.className += " fade";
    setTimeout(function() {
      preload.style.display = "none";
    }, 1500);
  });
</script>
<script type="text/javascript">
  jQuery(function ($) {

   /*==========================================================
          main slider
  ======================================================================*/
   if (jQuery('.main-slider').length > 0) {
      var bannerSlider = jQuery(".main-slider");
      bannerSlider.owlCarousel({
         items: 1,
         mouseDrag: true,
         loop: true,
         touchDrag: true,
         autoplay:true,
         dots: true,
         autoplayTimeout: 2500,
         animateOut: 'fadeOut',
         autoplayHoverPause: true,
         smartSpeed: 250,

      });
   }


});
</script>
<script src="{{asset('assets/js/owl.carousel.min.js')}}"></script>
