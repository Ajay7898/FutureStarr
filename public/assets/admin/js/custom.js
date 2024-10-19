
$(function() {

	 $('[id^="approve-blog-comment-"]').click(function() {
         var comment_id = $(this).data('commentid');
         var url = $(this).data('url');
         
         var post_data = {'id' : comment_id, '_token': $('meta[name="csrf-token"]').attr('content')};

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
            confirmButtonText: 'Yes, Approve it!',
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
                                  title: 'Approved!',
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
})