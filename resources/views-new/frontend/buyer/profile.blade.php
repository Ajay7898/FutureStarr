@extends('layouts.talent') 

@section('title', 'Future Starr | Buyer Account Setting')

@section('content')
<!-- banner start -->
<section class="wow fadeIn cover-background buyer-banner-sec socail-buzz background-position-top top-space" style="background-image:url({{ asset('assets/images/buyer/buyer-banner.png')}});">
 <div class="bg-extra-dark-gray"></div>
 <div class="container">
  <div class="row">
   <div class="col-md-12 col-sm-12 col-xs-12 display-table page-title-large">
    <div class="display-table-cell vertical-align-middle banner-heading text-center padding-30px-tb">
     <!--start page title -->
      <h2 class="text-white">Buyer</h2> 
        <span class="display-block text-white opacity6 alt-font">
              Profile</span>
              <!-- end sub title -->
          </div>
      </div>
  </div>
</div>
</section>

<!--SideBar-Start---->
  <section class="buyer-con-section">
  <div class="container">
    <div class="row">
        
        @include('frontend.sidebar.buyer')

      <div class="col-md-6 col-sm-12 col-xs-12">
        <div class="buyer-form">
          <h4>Edit Account</h4>
          <form method="POST" action="{{route('buyer.update')}}" enctype="multipart/form-data">
            @csrf
          <div class="row">
            <div class="col-md-12">
              <div class="form-sec">
                <div class="row">
                  <div class="col-md-12 col-sm-12 col-xs-12 form-list">
                    <h3>Profile Name</h3>
                    <div class="form-group">
                      <input type="text" class="form-control" placeholder="Profile Name" name="username" value="{{old('profile_name', !empty($profileData['username'])?$profileData['username']:'')}}" required="">
                      @if ($errors->has('username'))
                         <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('username') }}</strong>
                          </span>
                      @endif
                    </div>
                  </div>
                  <div class="col-md-12 col-sm-12 col-xs-12 form-list">
                    <h3>Profile Image</h3>
                    <div class="form-group">
                      <input id="uploadBtn" type="file"  name="profile_pic" >
                        <img id="showImage" style="height:300px;width:556px;" src="#" alt="your image" />

                      <input type="hidden" name="old_image" value="{{ !empty($profileData['profile_pic'])?$profileData['profile_pic']:''}}" required="">
                       <strong>{{ $errors->first('Profile_pic') }}</strong>
                    </div>
                  </div>

         
                  <div class="col-md-12 col-sm-12 col-xs-12 form-list">
                    <h3>Buyer- Bio information</h3><small class="text-danger">(Maximum 160 characters allowed.)</small>
                    <div class="form-group">
                      <textarea name="buyer_bio_information" id="description" placeholder="Product information" required >{{!empty($profileData['description'])?$profileData['description']:''}}</textarea>

                      <span id="charter-left" class="text-danger" style="display: none;">
                          You have&nbsp;<span id="my-textarea-length-left"></span>&nbsp; characters left.
                      </span>

                      @if ($errors->has('buyer_bio_information'))
                         <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('buyer_bio_information') }}</strong>
                          </span>
                      @endif
                    </div>
                  </div>
                 
                </div>
                <div class="row">
                  <div class="col-md-12 col-sm-12 col-xs-12 form-list">
                    <h3>Contact Information</h3>
                    <div class="form-group">
                      <label>First name</label>
                      <input type="text" class="form-control" placeholder="First Name" name="first_name" value="{{old('first_name', !empty($profileData['first_name'])?$profileData['first_name']:'')}}" required="">
                      @if ($errors->has('first_name'))
                         <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('first_name') }}</strong>
                          </span>
                      @endif
                    </div>
                  </div>
                   <div class="col-md-12 col-sm-12 col-xs-12 form-list">
                    <div class="form-group">
                      <label>Last name</label>
                      <input type="text" class="form-control" placeholder="Last name" name="last_name" value="{{old('last_name', !empty($profileData['last_name'])?$profileData['last_name']:'')}}" required="">
                      @if ($errors->has('last_name'))
                         <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('last_name') }}</strong>
                          </span>
                      @endif
                    </div>
                  </div>
                  <div class="col-md-6 col-sm-6 col-xs-12 form-list">
                    <div class="form-group">
                      <label>Email</label>
                      <input type="email" class="form-control" placeholder="email" name="email" value="{{old('email', !empty($profileData['email'])?$profileData['email']:'')}}" >
                      @if ($errors->has('email'))
                         <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('email') }}</strong>
                          </span>
                      @endif
                    </div>
                  </div>
                  <div class="col-md-6 col-sm-6 col-xs-12 form-list">
                    <div class="form-group">
                      <label>Phone</label>
                      <input type="text" class="form-control" placeholder="Phone" name="phone" value="{{old('phone', !empty($profileData['phone'])?$profileData['phone']:'')}}">
                      @if ($errors->has('phone'))
                         <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('phone') }}</strong>
                          </span>
                      @endif
                    </div>
                  </div>
                  <!-- <div class="col-md-6 col-sm-6 col-xs-12 form-list">
                    <div class="form-group">
                      <label>Country</label>
                      <input type="text" class="form-control" placeholder="Country" name="country" value="{{old('country', !empty($profileData['country'])?$profileData['country']:'')}}">
                      @if ($errors->has('country'))
                         <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('Country') }}</strong>
                          </span>
                      @endif
                    </div>
                  </div> -->
                  <div class="col-md-6 col-sm-6 col-xs-12 form-list">
                    <div class="form-group">
                      <label>City</label>
                      <input type="text" class="form-control" placeholder="City" name="city" value="{{old('city', !empty($profileData['city'])?$profileData['city']:'')}}">
                      @if ($errors->has('city'))
                         <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('city') }}</strong>
                          </span>
                      @endif
                    </div>
                  </div>
                  <div class="col-md-6 col-sm-6 col-xs-12 form-list">
                    <div class="form-group">
                      <label>State</label>
                      <input type="text" class="form-control" placeholder="State" name="state" value="{{old('state', !empty($profileData['state'])?$profileData['state']:'')}}">
                      @if ($errors->has('state'))
                         <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('state') }}</strong>
                          </span>
                      @endif
                    </div>
                  </div>
                  <div class="col-md-6 col-sm-6 col-xs-12 form-list">
                    <div class="form-group">
                      <label>Zip Code</label>
                      <input type="text" class="form-control" placeholder="Zip Code"  name="zip_code" value="{{old('zip_code', !empty($profileData['zip_code'])?$profileData['zip_code']:'')}}">
                      @if ($errors->has('zip_code'))
                         <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('zip_code') }}</strong>
                          </span>
                      @endif
                    </div>
                  </div>
                  <div class="col-md-12 col-sm-12 col-xs-12 form-list">
                    <div class="form-group">
                      <label>Address</label>
                      <textarea name="address" id="address" placeholder="Address" required="" value="{{old('address', !empty($profileData['address'])?$profileData['address']:'')}}">{{ !empty($profileData['address'])?$profileData['address']:'' }}</textarea>
                      @if ($errors->has('address'))
                         <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('address') }}</strong>
                          </span>
                      @endif
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="sec-btn">
            <button type="submit">Save</button>
            <a href="{{ route('buyer.dashboard')}}">Cancel</a>
          </div>
        </div>
      </div>
    <div class="col-md-3 col-sm-12 col-xs-12">
        <div class="message-sec side-sec">
          <h4>Inbox <span class="msg-count-out">(<span class="msg-count">0</span>)</span></h4>
          <div class="row">
            <div class="col-md-12">
				<div class="inbox_chat">
					<!--<a href="#">
					  <div class="chat_list">
						<div class="chat_people">
						<div class="chat_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>
						<div class="chat_ib">
						  <h5>Edward Standley,.. <span class="chat_date">11/15/17</span></h5>
						  <p>Test, which is a new approach to have all solutions 
						  astrology under one roof.</p>
						</div>
						</div>
					  </div>
					</a>-->
				</div>
            </div>
          </div>
        </div>
      </div>
    </div>
</section>
@endsection
  
@section('javascript')
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js" integrity="sha256-4iQZ6BVL4qNKlQ27TExEhBN1HFPvAvAMbFavKKosSWQ=" crossorigin="anonymous"></script>
<script type="text/javascript">
function get_inbox_users() {
  jQuery.ajax({
     type: "GET",
     url: '{!! url("buyer-seller/inbox-message/buy") !!}',
     success: function(response) {
        // console.log('response', response);
        jQuery(".msg-count").html(response['count']);

        var html = response['messages']
        if(html == '') { html = "<p class='no-msg'>0 Messages</p>";}
      

        jQuery(".inbox_chat").html(html);
     },
     error: function(data){
       toastr.error('Bad Request.');
     }
  });
}


function get_all_users() {
	$.ajax({
	   type: "GET",
	   url: '{!! url("/api/message/getinboxuser/".Auth::user()->id) !!}',
	   success: function(response) {
			var obj = response;
			var html = right_html = '';
			var i = 0;
			$.each(obj, function(key, value) {
				if(!value.first_name) {return;}
				if(value.profile_pic) {
					profile_pic = value.profile_pic;
				} else {
					profile_pic = 'assets/images/profile.png';
				}
				
				default_img = '/assets/images/profile.png';
				date = new Date(value.date);
				
				message = value.message;
				if(message) {
					message = message.substring(0, 20);
				}
				
				right_html += '<a href="{{ url('buyer/message/') }}?a=inbox&chat_id='+value.chat_id+'&name='+value.first_name+' '+value.last_name+'&received_by='+value.received_by+'">';
				right_html += '<div class="chat_list"><div class="chat_people">';
				right_html += '<div class="chat_img"><img src="/'+profile_pic+'" alt="'+value.first_name+' '+value.last_name+'" onerror="this.src=\''+default_img+'\'"></div>';
				right_html += '<div class="chat_ib">';
				right_html += '<h5>'+value.first_name+' '+value.last_name+' <span class="chat_date">'+moment(date).format('DD-MM-YY')+'</span></h5><p>'+message+'</p>';
				right_html += '</div>';
				right_html += '</div></div>';
				right_html += '</a>';
				
				i++;
			});
			
			if(right_html == '') { right_html = "<p class='no-msg'>0 Messages</p>";}
			
			$(".inbox_chat").html(right_html);
	   },
	   error: function(data){
		   toastr.error('Bad Request.');
	   }
	});
}

$(function() {
  get_all_users();
  get_inbox_users();
});
</script>
<script type="text/javascript">

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

</script>
@stop