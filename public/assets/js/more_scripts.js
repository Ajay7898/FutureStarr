
  var token = jQuery('meta[name="csrf-token"]').attr('content');
  var site_url = jQuery('meta[name="site-url"]').attr('content');


  $(document).ready(function() {
    $("#lightSlider").lightSlider(); 
    $('[data-toggle="tooltip"]').tooltip()
  });
    lightbox.option({
      'resizeDuration': 200,
      'wrapAround': true,
      'fitImagesInViewport':true,
      'minHeight': 700, 
      'minWidth': 700
    })
  
  function inProgress(index) {
     if(index == 0) {
          var message = 'Video function not updated yet.';
     } else  {
          var message = 'Audio Call function not updated yet.';
     }
     toastr.info(message);
     return true;
  }


    
    jQuery('a[data-toggle="tab"]').on('click', function (e) {
       event.preventDefault();
       // jQuery.noConflict();
       var target = jQuery(e.target).attr("href") // activated tab
       if(target == '#bbb') {
           jQuery('#quick-reminder').modal('show');
       }
    });


  function LoginUser(event) {
 
      event.preventDefault();
      var email    = jQuery("input[name=email]").val();
      var password = jQuery("input[name=password]").val();
      var remember = jQuery("input[name=remember]").val();
      var data = {
         _token: token,
          email:email,
          password:password,
          remember: remember
      };
      var url= site_url + '/login/user';
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

   var url = site_url + '/buyer/add-buyer-message';
   var message_title = jQuery("#message_title"+talentId).val();
   var message = jQuery("textarea#message"+talentId).val();
   jQuery.ajax({
      type: "post",
      url: url,
      data: {
            "_token": token,
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
         var url = site_url + '/buyer/delete-buyer-product';
         jQuery.ajax({
            type: "post",
            url: url,
            data: {
                  "_token": token,
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

         var url = site_url + '/buyer/add-buyer-rating';
         var rating = jQuery('input[name="rating"]:checked').val();
         var message = jQuery("textarea#comment"+talentId).val();

         jQuery.ajax({
            type: "post",
            url: url, 
            data: {
                  "_token": token,
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

         var url = site_url + '/buyer/add-comment-to-talent';
         var message = jQuery("textarea#leaveComment"+talentId).val();
         jQuery.ajax({
            type: "post",
            url: url,
            data: {
                  "_token": token,
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
         var url = site_url + '/buyer/download-buyer-product';
         jQuery.ajax({
            type: "post",
            url: url,
            data: {
                  "_token": token,
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
         var url = site_url + '/seller/edit-promote-product';

        jQuery.ajax({
            type: "post",
            url: url,
            data: {
                  "_token": token,
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
        var url = site_url + '/seller/post-seller-contact';
        var name = jQuery("#name").val();
        var email = jQuery("input[type='email']#seller_email").val();
        var message = jQuery("textarea#seller_message").val();
         jQuery.ajax({
            type: "post",
            url: url,
            data: {
                  "_token": token,
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

        var url = site_url + '/seller/custom-plan';
        var message = jQuery("textarea#custom_plan").val();
         jQuery.ajax({
            type: "post",
            url: url,
            data: {
                  "_token": token,
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
         var url = site_url + '/seller/delete-my-product';
         jQuery.ajax({
            type: "post",
            url: url,
            data: {
                  "_token": token,
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
         var url = site_url + '/seller/delete-promote-product';
         jQuery.ajax({
            type: "post",
            url: url,
            data: {
                  "_token": token,
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
             var url = site_url + '/seller/my-product/days/'+selected.value;
         } else {
             var url = site_url + '/seller/my-product';
         }
         window.location.href=url;
}
function filterDeletedProducts(selected)
{
         if(selected.value !='') {
             var url = site_url + '/seller/my-deleted-product/days/'+selected.value;
         } else {
             var url = site_url + '/seller/my-deleted-product';
         }
         window.location.href=url;
}
function filterPromotedProduct(selected)
{
         if(selected.value !='') {
             var url = site_url + '/seller/promote-product/days/'+selected.value;
         } else {
             var url = site_url + '/seller/promote-product';
         }
         window.location.href=url;
}

/****************** END ***********************/


/****************** TALENT FUNCTIONS **********************/

function awardTalent(talentId) {
        jQuery('[id^="giveAward"]').modal('hide');
         var url = site_url + '/talent-mall/give-award';
         jQuery.ajax({
            type: "post",
            url: url,
            data: {
                  "_token": token,
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
     var url = site_url + '/talent-mall/add-rider';
     jQuery.ajax({
        type: "POST",
        url: url,
        data: {
              "_token": token,
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

         var url = site_url + '/talent-mall/add-buyer-contact-message';
         var message_title = jQuery("#title").val();
         var message = jQuery("textarea#message").val();
         jQuery.ajax({
            type: "post",
            url: url,
            data: {
                  "_token": token,
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
      var url = site_url + '/talent-mall/add-talent-to-cart';
         jQuery.ajax({
            type: "post",
            url: url,
            data: {
                  "_token": token,
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
         var url = site_url + 'forgot-password';
         var email = jQuery("#forget_email").val();
         alert(email);
         jQuery.ajax({
            type: "post",
            url: url,
            data: {
                  "_token": token,
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

function readURL1(input) {
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
  readURL1(this);
});

jQuery(function(){
  jQuery('#showImage').hide();
});



 /* jQuery('.modal').on('hidden.bs.modal', function(){
    jQuery('.invalid-feedback').text('');
    jQuery(this).find('form')[0].reset();
});*/


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
                url: site_url + "/seller/bulk-delete-my-product",
                cache:false,
                data: {talent_id: selected_values, _token: token},
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
                url: site_url + "/seller/bulk-deleted-my-product-undo",
                cache:false,
                data: {talent_id: selected_values, _token: token},
                success: function(response) {

                 if(response.success) {
                    toastr.success(response.success);
                       setTimeout(function(){ window.location.href='seller/my-product' }, 1000);
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
                url: site_url + "/seller/bulk-deleted-my-product-permanently",
                cache:false,
                data: {talent_id: selected_values, _token: token},
                success: function(response) {

                 if(response.success) {
                    toastr.success(response.success);
                       setTimeout(function(){ window.location.href='seller/my-product' }, 1000);
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
  jQuery(window).on('load', function() {
     jQuery(".search-results").css({"display":"none",});

  });
jQuery(document).ready(function(){
  jQuery("#search").keyup(function(){
    jQuery(".search-results").css({"display":"block","opacity":"1"});
    var search = jQuery(this).val();
    if(search !='' || search !=null || search != undefined ) {
          jQuery.ajax({
          type: "POST",
          url: site_url + '/search',
          data: {search: search, _token: token},
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

  jQuery(document).ready(function(){

 jQuery('#upload_form').on('submit', function(event){
  event.preventDefault();
  jQuery.ajax({
   url: site_url + "/image-upload",
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
         var url = site_url + '/buyer/update-user-account';
         jQuery.ajax({
            type: "POST",
            url: url,
            data: {
                  "_token": token,
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
                  "_token": token,
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


document.onreadystatechange = function () {
      var state = document.readyState
      if (state == 'complete') {
        setTimeout(function(){
          document.getElementById('interactive');
          document.getElementById('load').style.visibility="hidden";
        },1000);
      }
    }
    jQuery(document).ready(function(){
      jQuery('.scroll-top-arrow').fadeOut();
    });
    jQuery(window).scroll(function(){
      if (jQuery(this).scrollTop() > 100) {
        jQuery('.scroll-top-arrow').fadeIn();
      } else {
        jQuery('.scroll-top-arrow').fadeOut();
      }
    });
    jQuery(".scroll-top-arrow").click(function() {
      jQuery("html, body").animate({ scrollTop: 0,behavior: 'smooth' }, "slow");
      return false;
    });
    jQuery('#navbar-search').on('click', function(e) {
      e.preventDefault();
      jQuery(this).addClass('hide');
      jQuery('#navbar-searchbar').removeClass('hide');
    });


(function(w,d){
  w.HelpCrunch=function(){w.HelpCrunch.q.push(arguments)};w.HelpCrunch.q=[];
  function r(){var s=document.createElement('script');s.async=1;s.type='text/javascript';s.src='https://widget.helpcrunch.com/';(d.body||d.head).appendChild(s);}
  if(w.attachEvent){w.attachEvent('onload',r)}else{w.addEventListener('load',r,false)}
})(window, document)
HelpCrunch('init', 'futurestarr', {
  applicationId: 1,
applicationSecret: 'Ns0ynOloC5Af/kb8xI3/UkQQ3XHJACiejXZ8LorjMvcLvuPvyxErFgv2kTtzR3KunGaM+IB6exYVq3CK4r/K2w=='
});
HelpCrunch('showChatWidget');


  new WOW().init();



  jQuery(document).on('click', '.deleteusermodel', function(){

          jQuery('#deleteusermodel .modal-title').text(jQuery('.chat_box.chat-opened .main_chat .chat-user').text())
          jQuery('#deleteusermodel .modal-body .bydc').attr('data-userid', jQuery(this).data('userid'))
          jQuery('#action_menu-'+jQuery(this).data('userid')).css("display", "none")
           // pull-right chat_data_commu 
      });

        jQuery(document).on('click', '#deleteusermodel .bydc', function(){
            token = $("meta[name='csrf-token']").attr("content");
            var isThis =  this;
            jQuery( "#contacts .active a" ).each(function() {
                if (jQuery(this).data('id') == jQuery('#deleteusermodel .bydc').attr('data-userid')) {
                    jQuery(this).parents('.active').remove();
                    jQuery('#chat_box_'+jQuery('#deleteusermodel .bydc').attr('data-userid')).remove();
                    
                }
            });
            jQuery.ajax({
                type: "POST",
                url: site_url + '/send/del',
                data: {
                    _token: token,
                    id : jQuery(this).data('userid'),
                },
                // dataType: 'json',
                success: function(resp) {
                    if (resp.state == 1) {
                        jQuery('.chat_box.chat-opened .panel-body.chat-area').html('');
                    }                   

                },
                error: function(data){
                   toastr.error('Bad Request.');
                }
            });
        })



var lmi = 0;

var imvar = 0;
if (onlyMessageChatPage === 1) {
  get_unread_users();

  get_inbox_users();

  setTimeout(function(){ 
    get_all_users();
  }, 1000)


  setTimeout(function(){ 
    auto_reply()
  }, 20000)
}



function auto_reply() {
  jQuery.ajax({
     type: "GET",
     url: site_url + '/buyer-seller/auto-reply',
     success: function(response) {

     },
     error: function(data){
       toastr.error('Bad Request.');
     }
  });
}

jQuery(document).on('click', '.get-all-users .get-all-users-mob2', function(){
  name = jQuery(this).find('.ttlusr').text()
  sid = jQuery(this).parents('.get-all-users').find('.message-check input').data('sid') 
  get_unread_users()
  getMessage(name, sid)
  get_inbox_users()
});

function get_inbox_users() {
  jQuery.ajax({
     type: "GET",
     url: site_url + '/buyer-seller/inbox-message/same',
     success: function(response) {
    //      setCookie('user_id', 20 , '1');
      // var cookie_user_id = getCookie('user_id');
      // console.log(cookie_user_id)
      if (response.state == false) {
        jQuery(".inbox_chat").html("<p class='no-msg'>0 Messages</p>");
        jQuery(".msg-count").html(0);
          }else{
            jQuery(".msg-count").html(response['count']);
        var html = response['messages']
            jQuery(".inbox_chat").html(html);
          }     

     },
     error: function(data){
       toastr.error('Bad Request.');
     }
  });
}

function get_all_contact_delete() {
  jQuery.ajax({
     type: "GET",
     url: site_url + '/buyer-seller/getalluser',
     success: function(response) {
      var obj = response;
      var html = '';
      jQuery.each(obj, function(key, value) {
        if(!value.first_name) {return;}
        if(value.profile_pic) {
          profile_pic = value.profile_pic;
        } else {
          profile_pic = 'assets/images/profile.png';
        }
        
        html += '<div class="row m-t-10">';
        html += '<div class="col-sm-2 col-md-2 col-xs-3 no-padding-right get-all-users-de1"><img class="sidebar-pic" src="/'+profile_pic+'"></div>';
        html += '<div class="col-sm-10 col-md-10 col-xs-9 get-all-users-de2"><div class="row no-margin">';
        
        message = value.message;
        if(message) {
          message = message.substring(0, 20);
        }
        
        html += '<div class="col-sm-9 col-md-9 col-xs-9 text-left no-padding get-all-users-de22"><span><b style="font-size: 13px;">'+value.first_name+' '+value.last_name+' </b></span><p class="faded-text">'+message+'</p></div>';
        html += '<div class="col-sm-3 col-md-3 col-xs-3 text-right get-all-users-de222"></div>';
        html += '</div></div>';
        html += '</div>';
      });
      jQuery("#tab3").html(html);
     },
     error: function(data){
       toastr.error('Bad Request.');
     }
  });
}

function get_read_users() {
  jQuery.ajax({
     type: "GET",
     url: site_url + '/buyer-seller/getallreaduser',
     success: function(response) {
        jQuery('#tab1 .filter a').removeClass('active');
      jQuery('#readmsg').addClass('active');

      jQuery("#tab1 .sidebar-message").html(response);
     },
     error: function(data){
       toastr.error('Bad Request.');
     }
  });
}

function get_unread_users() {
  jQuery.ajax({
     type: "GET",
     url: site_url + '/buyer-seller/getallunreaduser',
     success: function(response) {

        if (response.state == false) {
            // console.log('blank')
          jQuery('#unrmsg').css({
              "background": "",
              "padding": "",
              "border-radius": ""
            })

          jQuery("#tab1 .sidebar-message").html("<p class='no-msg'>0 Messages</p>");
        } 
        else{
            jQuery('#unrmsg').css({
              "background": "rgba(255, 0, 0, .09)",
              "padding": "1px 5px",
              "border-radius": "7px"
            })
          jQuery("#tab1 .sidebar-message").html(response);
        } 

      
     },
     error: function(data){
       toastr.error('Bad Request.');
     }
  });
}

jQuery(function() {

  var emt = jQuery('#send-message-form textarea').emojioneArea({
    pickerPosition: "left",
  });
  jQuery('.message-sidebar .nav-tabs a').on('click', function() {
    id = jQuery(this).attr('id');
    if(id == 'option1-a') get_all_users();
    if(id == 'option2-a') get_all_contact();
    if(id == 'option3-a') get_all_contact_delete();
    //jQuery('.option-box').removeClass('active');
    //jQuery(this).addClass('active');
  });
  
  jQuery('#tab1 .filter a').on('click', function() {
    id = jQuery(this).attr('id');
    jQuery('#tab1 .filter a').removeClass('active');
    jQuery(this).addClass('active');
    if(id == 'allmsg') get_all_users();
    if(id == 'readmsg') get_read_users();
    if(id == 'unrmsg') get_unread_users();
  });
  

  
  function get_all_contact() {
    var url = site_url + '/api/message/get_all_contact/1")';
    jQuery.ajax({
       type: "GET",
       url: url,
       success: function(response){
        var obj = response
        var html = '';
        jQuery.each(obj, function(key, value) {
          //console.log(value);
          html += '<div class="row margin-bottom-5 margin-top-5">';
          html += '<div class="col-sm-2 col-md-2 col-xs-3 get-all-users-anc1"><a href="#"><img class="sidebar-pic circular" src="/assets/images/profile.png"></a></div>';
          html += '<div class="col-sm-10 col-md-10 col-xs-9 get-all-users-anc2"><div style="text-align: left; font-size: 14px;"><span class="cursor-pointer" onClick="return sendMessage('+value.id+', \''+value.first_name+' '+value.last_name+'\');"><b>' +value.first_name + ' ' + value.last_name +' </b></span></div></div>';
          html += '</div>';
        });
        jQuery("#tab2 div").next("div").html(html);
       },
       error: function(data){
         toastr.error('Bad Request.');
       }
    });
  }

    jQuery(document).on('keydown', '#send-message-form', function (e) {
        if(e.which == 13) {
      jQuery('#send-message-form').submit();
        }
    });

  jQuery('#send-message-form').submit(function(e) {
    e.preventDefault();
    
    message = emt[0].emojioneArea.getText();
    if (message.trim() == '') {
      message = jQuery('#send-message-form .emojionearea-editor').text();
    }
    if(message.trim() == '' && jQuery("#message_file")[0].files.length == 0) {
      return;
    }
    jQuery('#send-message-form textarea').val('');
    emt[0].emojioneArea.setText('');
    jQuery('#load').css('visibility', 'visible');
    var formData = new FormData(this);
    formData.append('message', message);
    formData.append('currentUser', '');
    btn = jQuery('#send-message-form button');
    jQuery.ajax({
      url: site_url + '/buyer-seller/chat-message',
      type: 'POST',
      data: formData,
      dataType: 'json',
      cache: false,
      contentType: false,
      processData: false,
      beforeSend: function() {
        btn.button('loading');
      },
      success: function(resp) {
        // console.log(resp)
        jQuery('#lmi').text(resp['lmi'])
        jQuery('#send-message-form textarea').val('');
        emt[0].emojioneArea.setText('');
        jQuery('#load').css('visibility', 'hidden');

        jQuery(".direct-chat-messages").append(resp['html']);
        jQuery(".direct-chat-messages").scrollTop(jQuery(".direct-chat-messages")[0].scrollHeight);
      },
      error: function(data){
        jQuery('#send-message-form textarea').val('');
        emt[0].emojioneArea.setText('');
        toastr.error('Bad Request.');
        }
    });
  });
  
  jQuery('#automatic-form').submit(function(e) {
    e.preventDefault();
    var formData = new FormData(this);
    if(jQuery('#togBtn').is(':checked')) {
      formData.append('auto_reply', 1);
    } else {
      formData.append('auto_reply', 0);
    }
    formData.append('user_id', '');
    jQuery.ajax({
      url: site_url + '/api/autoreply-setting',
      type: 'POST',
      data: formData,
      dataType: 'json',
      cache: false,
      contentType: false,
      processData: false,
      success: function(json) {
        if(json.success) {
          toastr.success('Setting Saved.');
        }
      },
      error: function(data){
        toastr.error('Bad Request.');
       }
    });
  });
  
  jQuery('#tab1 .message-search').on('keyup', function(){
    var filter = jQuery(this).val().toLowerCase();
    var nodes = jQuery('#tab1 .get-all-users');
    for (i = 0; i < nodes.length; i++) {
      if (nodes[i].innerText.toLowerCase().includes(filter)) {
        nodes[i].style.display = "block";
      } else {
        nodes[i].style.display = "none";
      }
    }
  })
  jQuery('#tab2 .message-search').on('keyup', function(){
    var filter = jQuery(this).val().toLowerCase();
    var nodes = jQuery('#tab2 .row');
    for (i = 0; i < nodes.length; i++) {
      if (nodes[i].innerText.toLowerCase().includes(filter)) {
        nodes[i].style.display = "block";
      } else {
        nodes[i].style.display = "none";
      }
    }
  })
});


function get_all_users() {
  console.log('sfjsdhfjdshfjdshf')
  console.log(site_url);
  jQuery.ajax({
     type: "GET",
     url: site_url + '/buyer-seller/getalluser',
     success: function(response) {   
      jQuery("#tab1 .sidebar-message").html(response);
     },
     error: function(data){
       toastr.error('Bad Request.');
     }
  });
}

function sendMessage(user_id, name) {
  //jQuery('#load').css('visibility', 'visible');
  jQuery('#send-message-form input[name="received_by"]').val(user_id);
  jQuery(".direct-chat-messages").html('');
  jQuery('.buyer-form > h4').html('Message - ' + name);
  if(user_id) {
    getMessage(name, user_id)
  } else {
    jQuery('html, body').animate({
      scrollTop: jQuery(".buyer-form").offset().top - 80
    }, 100);
  }
}

jQuery(document).on('click', '.inbox_chat a', function(){
  
  var num = jQuery(this).parents('.message-sec.side-sec').find('.msg-count').text();
  var msg_count = jQuery(this).find('.unread-msg').text();
  num = parseInt(num)
  msg_count = parseInt(msg_count)
  num = num - msg_count;
  if (num >= 0) {
    jQuery(this).parents('.message-sec.side-sec').find('.msg-count').text(num)
    jQuery('.msg-count-out .msg-count').text(num);
    getMessage(jQuery(this).data('username'), jQuery(this).data('sent-id'));
    get_unread_users();
    jQuery(this).remove();
  } 
});

function getMessage(name, user_id) {
  jQuery('#load').css('visibility', 'visible');
  var url = site_url + '/buyer-seller/chat-message/' + user_id;
  // console.log(url)
  jQuery.ajax({
     type: "GET",
     url: url,
     success: function(response){
        if (response != '') {
          jQuery("#lmi").html(response['lmi'])
          lmi = jQuery('#lmi').text();
          get_read_users()
        jQuery(".direct-chat-messages").html(response['html']);
        jQuery('.buyer-form > h4').html('Message - ' + name);
        jQuery('html, body').animate({
          scrollTop: jQuery(".buyer-form").offset().top - 80
        }, 100);
        jQuery('#load').css('visibility', 'hidden');
        jQuery('#send-message-form input[name="received_by"]').val(response['receiver_id']);
        jQuery(".direct-chat-messages").scrollTop(jQuery(".direct-chat-messages")[0].scrollHeight);
      }
     },
     error: function(data){
       toastr.error('Bad Request.');
       jQuery('#load').css('visibility', 'hidden');
       //jQuery('#send-message-form input[name="received_by"]').val(user_id);
     }
  });
}

setInterval(function(){
  lmi = jQuery('#lmi').text();
  rec = jQuery('#send-message-form input[name="received_by"]').val();
  if (lmi != 0) {
      jQuery.ajax({
          type:'GET',
          url: site_url + '/buyer-seller/refresh-message/'+lmi+'/'+rec,
          success:function(data){
            if (data['lmi'] > lmi) {
              lmi = jQuery('#lmi').text(data['lmi']);
          jQuery(".direct-chat-messages").append(data['html']);
          jQuery(".direct-chat-messages").scrollTop(jQuery(".direct-chat-messages")[0].scrollHeight);
            }                         
          }
      });
  }
}, 1500);

function deletemessage(user_id, id) {
  var box = confirm("Are you sure delete this message");
  if (box === true) {
    jQuery('#load').css('visibility', 'visible');
    jQuery.ajax({
       type: "GET",
       url: site_url + '/buyer-seller/delete-message/'+id,
       success: function(response) {
         get_all_contact_delete();
         get_all_users();
         jQuery('#load').css('visibility', 'hidden');
       },
       error: function(data){
         toastr.error('Bad Request.');
       }
    });
  }
}

jQuery(document).on('click', '.message-all-check input', function(){
  if (jQuery(this).prop('checked') == true) {
      $( ".get-all-users .message-check input" ).each(function() {
        $(this).prop("checked", true)
    });
  }else{
    $( ".get-all-users .message-check input" ).each(function() {
        $(this).prop("checked", false)
    });
  }

  
})

jQuery(document).on('click', '#select-delete', function(){
  var box = confirm("Are you sure delete this message");
  var sid = Array();
  jQuery( ".get-all-users .message-check input" ).each(function() {
     if (jQuery(this).prop("checked") == true) {

        if (jQuery.inArray(jQuery(this).data('sid'), sid) === -1) {
          sid.push(jQuery(this).data('sid'));
        }
        
     }
  });
  if (box === true) {
    jQuery('#load').css('visibility', 'visible');
      token = $("meta[name='csrf-token']").attr("content")
    jQuery.ajax({
        type: "POST",
        url: site_url + '/buyer-seller/check-delete-message',
      data: {
        _token: token,
        sid : sid,
      },
      // dataType: 'json',
        success: function() {
         get_all_users();
         jQuery('#load').css('visibility', 'hidden');
        },
        error: function(data){
         toastr.error('Bad Request.');
        }
    });
  }
});
function deleteMessageSelected(user_id, id) {
  var box = confirm("Are you sure delete this message");
  if (box === true) {
    jQuery('#load').css('visibility', 'visible');
    jQuery.ajax({
       type: "GET",
       url: site_url + '/buyer-seller/delete-message/'+id,
       success: function(response) {
          // console.log(response);
         // get_all_contact_delete();
         get_all_users();
         jQuery('#load').css('visibility', 'hidden');
       },
       error: function(data){
         toastr.error('Bad Request.');
       }
    });
  }
}

  function desopen(id){ 
 
 document.getElementById(id).classList.toggle('star-search-textdd');
 
 
 var x = document.getElementById("read_button");
  if (x.innerHTML === "Read More") {
    x.innerHTML = "Read Less";
  } else {
    x.innerHTML = "Read More";
  }
 
 
}

   $('#description').keyup(function(event){

        $("#charter-left").show();
        var $field = $('#description');
        var $left = $('#my-textarea-length-left');
        var len = $field.val().length;
        if (len >= 160) {
            $field.val( $field.val().substring(0, 159) );
            $left.text(0);
            if (event.which != 8) {
                return false;
            }
        }
        $left.text(160 - len);
    });

   // $('#lightSlider1').lightSlider();


   $(function(){
      $('#add-ad-form').submit(function() {

          $("#loader-ad").css('display', 'block');
          $("#upload-ad").hide();
          return true;

      });
    });

  $(document).ready(function(){
      
      jQuery(document).on('change', '#select-prdouct', function(){
          var optionValue = $(this).val();
            if(optionValue) {
              var post_data = { 
                 "_token": token,
                 id: optionValue
              };
              $.ajax({
                 url : site_url + '/talent-mall/product-url',
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


  jQuery(document).on('change', '.file-upload .file-select input', function(){
          jQuery(this).parents('.file-select').find('.file-select-name').text('');
          // var isThis = this;
          var file = $(this)[0].files[0];
          var fileType = $(this)[0].files[0].type;
          var fileSize = $(this)[0].files[0].size;

          console.log(fileType);
          var validImageTypes = ["image/gif", "image/jpeg", "image/png", "video/mp4","video/.wav", "audio/mp3", "audio/mpeg"];
          if ($.inArray(fileType, validImageTypes) > 0) { 
              // console.loh('in arry')
            var checkFileSize = fileSize / 1024;
            if(checkFileSize > 10000) {
                
                toastr.error('Future Starr accept maximum file sieze 10 MB.');
                $(this).val('');
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
                       if(videoDuration > 60 ){
                            toastr.error('Video can be min of 1 min duration.');
                            $(this).val('');
                            return false;
                       }
                      (URL || webkitURL).revokeObjectURL(url);               
                    });
                    video.src = url;                                          
                  };
                  rd.readAsArrayBuffer(file);
              }
            showUploadVideo(this)
            jQuery(this).parents('.file-select').find('.file-select-name').text(file.name);
          } else {
              toastr.error('Invalid file format. Please choose file wiht allowed format.');
              $("#banner").val('');
              return false;
          }
  });


  function showUploadVideo(input) {
     if (input.files && input.files[0]) {

       var reader = new FileReader();
      
       reader.onload = function(e) {
          //console.log(e.target.result);
          var hasString = e.target.result
          if (hasString.indexOf('data:image/jpeg') > -1 || hasString.indexOf('data:image/png') > -1 || hasString.indexOf('data:image/jpg') > -1){
              $('#sound').hide();
              $('#video_here1').hide();
              $('#show_image').show();
              $('#show_image').attr('src', e.target.result);
              $('#upload_label').removeClass("label-upload");
         } else if(hasString.indexOf('data:audio/mp3') > -1 || hasString.indexOf('data:audio/mpeg') > -1){
              $('#show_image').hide();
              $('#video_here1').hide();
              var sound = document.getElementById('sound');
              sound.src = URL.createObjectURL(input.files[0]);
              sound.onend = function(e) {
                URL.revokeObjectURL(input.src);
              }
              $('#sound').show();
              $('#upload_label').removeClass("label-upload");
         } else if(hasString.indexOf('data:video/mp4') > -1){
              $('#sound').hide();
              $('#show_image').hide();
              var $source = $('#video_here');
              $source[0].src = URL.createObjectURL(input.files[0]);
              $source.parent()[0].load();
              $('#video_here1').show();
              $('#upload_label').removeClass("label-upload");
         }  else {
             
         }
         $('.remove-preview').show();
       }
       reader.readAsDataURL(input.files[0]);
     }
     $(document).on("click",".remove-preview",function() {
         $('#show_image').hide();
         $('#sound').hide();
         $('#video_here1').hide();
         $('#upload_label').addClass("label-upload");
         $(this).hide();
     });
   }
   
  jQuery(document).ready(function(){
    jQuery(document).on('click', 'section.t-shirts .inner-t-s .swatch ul.swa-body li span', function(){
      jQuery(this).parents('section.t-shirts .inner-t-s .swatch ul.swa-body li').siblings('li').find('span').removeClass('active');
      jQuery(this).addClass('active');
    })

    jQuery(document).on('click', 'section.t-shirts .inner-t-s button.order-shirt', function(){
      swatch = Array();
      jQuery('section.t-shirts .inner-t-s .swatch ul.swa-body li span.active').each(function( index ) {
        if (jQuery(this).data('gender') != undefined) {
          swatch['gender'] = jQuery(this).data('gender')
        }

        if (jQuery(this).data('neck') != undefined) {
          swatch['neck'] = jQuery(this).data('neck')
        }

        if (jQuery(this).data('color') != undefined) {
          swatch['color'] = jQuery(this).data('color')
        }

        if (jQuery(this).data('size') != undefined) {
          swatch['size'] = jQuery(this).data('size')
        }
        
      });
      

      jQuery.ajax({
        url : site_url + '/buyer/t-shirt',
        type: 'post',
        data : {
          _token: token,
          gender: swatch['gender'],
          neck: swatch['neck'],
          color: swatch['color'],
          size: swatch['size'],
          slug: jQuery(this).data('slug'),
        },
        success: function(response) {
          toastr.success('product add in cart');
        },error: function(resp){
          // console.log(resp)
          toastr.error('product not add in cart');
        }
      });
    })

    jQuery(".shipping-info .form-check input").click(function(){
		jQuery('.shipping-info .form-check').css({"background-color":"","border":"", "font-weight": ""})
	   	jQuery(this).parents('.shipping-info .form-check').css({"background-color":"#f5f4f4","border":"1px solid #c9302c", "font-weight":"600"})
	});

    jQuery(document).on('click', '.shipping-info .form-check .ch-ship', function(){
    	jQuery.ajax({
	        url : site_url + '/buyer/change-shipping',
	        type: 'post',
	        data : {
	          _token: token,
	          sid: jQuery(this).data('sid'),
	        },
	        success: function(response) {
            toastr.success('Shipping Update');
	          jQuery('.ts-checkout .check-side').replaceWith(response);
	        }
	      });
    });

    jQuery(document).on('click', '.ts-checkout .cart .item-row .btn.pro-rm', function(){
    	var isThis = this;
    	jQuery.ajax({
	        url : site_url + '/buyer/remove-cart-product',
	        type: 'post',
	        data : {
	          _token: token,
	          sku: jQuery(this).data('sku'),
	        },
	        success: function(response) {
	          jQuery(isThis).parents('.ts-checkout .cart .item-row').remove();
	          jQuery('.ts-checkout .check-side').replaceWith(response);
            toastr.success('product removed from cart');
	        }
	      });
    });

    jQuery(document).on('submit', '#saveShippingAddress', function(event){
      event.preventDefault();
      var isThis = this;
      jQuery.ajax({
          url : site_url + '/buyer/save-shipping-address',
          type: 'post',
          data : jQuery(this).serialize(),
          success: function(response) {
            jQuery('#shippingAddressModal').modal('hide');
            jQuery('.ts-checkout .chshaddr').replaceWith(response);
            toastr.success('shipping address updated successfully');
          }
        });
    });

    jQuery(document).on('submit', '#saveBillingAddress', function(event){
      event.preventDefault();
      var isThis = this;
      jQuery.ajax({
          url : site_url + '/buyer/save-billing-address',
          type: 'post',
          data : jQuery(this).serialize(),
          success: function(response) {
            jQuery('#billingAddressModal').modal('hide');
            jQuery('.ts-checkout .chbladdr').replaceWith(response);
            toastr.success('billing address updated successfully');
          }
        });
    });
    
  })