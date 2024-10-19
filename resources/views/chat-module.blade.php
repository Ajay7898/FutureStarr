@if(!empty(Auth::check()))
<div id="chat">
   <div class="container-fluid h-100">
      <div class="row justify-content-center h-100">
         <div id="chat-overlay" class="row"></div>
         <div class="col-md-8 col-xl-6 chat">
            <div class="card">
               <div class="card-header">
                  <div class="img_cont" >
                     <img src="{{ !empty(Auth::user()->profile_pic) && file_exists(Auth::user()->profile_pic) ? asset(Auth::user()->profile_pic) :  url('assets/images/star-logo.png') }}" class="rounded-circle user_img" style="height: 50px; width: 50px;"> 
                     <span><i style="top: 2pc; left: 2pc;"class="fa fa-star text-success" aria-hidden="true"></i></span>
                  </div>
                 
                  <div class="message_data" id="open-chat-window" style="cursor: pointer;">
                     Messaging
                     <span class="user-name">{{ Auth::user()->username }}</span>
                  </div>
                <!--   <div class="message_data_option" >
                     <i class="fa fa-ellipsis-v" aria-hidden="true"></i>              
                  </div> -->
               </div>
            
               <div class="card-body contacts_body">
                  <div class="spinnerloader" id="loader" style="display: block;padding: 9pc 0pc 0pc 8pc;">
                     <div class="spinner-border" role="status" >
                        <span class="sr-only">Loading...</span>
                     </div>
                  </div>
               </div>
               <div class="card-footer"></div>
            </div>
         </div>
      </div>
   </div>
</div>
@endif
