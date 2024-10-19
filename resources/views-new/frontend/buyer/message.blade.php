@extends('layouts.talent')

@section('title', 'Future Starr | Buyer Message Dashboard')

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
      <div class="col-md-3 col-sm-12 col-xs-12 get-all-users-first">
      	<div id="lmi" style="display: none;">0</div>
       @include('frontend.sidebar.message-sidebar')

		<div class="col-sm-12 message-sidebar ms-data">
			<div class="row padding-8 ms-datai">
				<ul class="nav nav-tabs">
					<li >
						<a href="#tab1" data-toggle="tab" id="option1-a" title="Message List" class="active"><div><i class="fa fa-envelope"></i></div></a>
					</li>
					<li>
						<a href="#tab2" data-toggle="tab" id="option2-a" title="Contact List"><div><i class="fa fa-address-book"></i></div></a>
					</li>
					<li>
						<a href="javascript:void(0)" id="select-delete" title="Delete Message"><div><i class="fa fa-trash"></i></div></a>
					</li>
					<li>
						<a href="#tab4" data-toggle="tab" id="option4-a" title="Setting"><div><i class="fa fa-cog"></i></div></a>
					</li>
				</ul>
				<!--<div class="col-sm-3 col-md-3 col-xs-3 option">
					<div class="option-box active" id="option1">
						<a href="#tab1" data-toggle="tab" id="option1-a" title="Message List"><div><i class="fa fa-envelope"></i></div></a>
					</div>
				</div>
				<div class="col-sm-3 col-xs-3 option">
					<div class="option-box" id="option2">
						<a href="#tab2" data-toggle="tab" id="option2-a" title="Contact List"><div><i class="fa fa-address-book"></i></div></a>
					</div>
				</div>
				<div class="col-sm-3 col-xs-3 option">
					<div class="option-box" data-target="#option3" id="option3">
						<a data-target="#tab3" data-toggle="tab" id="option3-a" title="Delete Message"><div><i class="fa fa-trash"></i></div></a>
					</div>
				</div>
				<div class="col-sm-3 col-xs-3 option">
					<div class="option-box" data-target="#option4" id="option4">
						<a data-target="#tab4" data-toggle="tab" id="option4-a" title="Setting"><div><i class="fa fa-cog"></i></div></a>
					</div>
				</div>-->
			</div>
			<div class="tab-content">
			<div class="tab-pane active" id="tab1">
				<div class="m-t-10">
					<input class="message-search" placeholder="search" type="text">
				</div>
				<div class="m-t-10 filter tab-panel" style="text-align: left;">
					<p>
						<a href="javascript:void(0);" class="active" id="allmsg">All</a> | 
						<a href="javascript:void(0);" id="readmsg">Read</a> | 
						<a href="javascript:void(0);" id="unrmsg">Unread</a>
					</p>
					<span class="message-all-check">
						<p class="text">All</p> 	
						<input name="ALL" type="checkbox">
					</span>
					
				</div>
				<div class="m-t-10">
					<div class="row sidebar-message">
						<!--<div class="col-sm-3 col-md-3 col-xs-3">
							<a target="_blank" href="#"><img class="sidebar-pic" src="/assets/images/profile.png"></a>
						</div>
						<div class="col-sm-9 col-md-9 col-xs-9" style="cursor: pointer;">
							<div class="row" style="text-align: left;text-transform: capitalize;">
								<span>Tiya Pol<br>09-11-19 | 3:49:AM</span>
							</div>
							<div class="row faded-text" style="text-align: left; color: #999;"> Hi </div>
						</div>-->
					</div>
				</div>
			</div>
			<div class="tab-pane" id="tab2">
				<div class="m-t-10">
					<input class="message-search" placeholder="search" type="text">
				</div>
				<div></div>
				<!--<p class="m-t-10" style="color:#ff503f; text-align: left;"><b>Favorites</b></p>
				<p class="m-t-10" style="color:#ff503f; text-align: left;"><b>All</b></p>-->
			</div>
			<div class="tab-pane" id="tab3">
				<!--<div class="row m-t-10">
					<div class="col-sm-2 col-md-2 col-xs-3 no-padding-right">
						<img class="sidebar-pic" src="/assets/images/profile.png">
					</div>
					<div class="col-sm-10 col-md-10 col-xs-9">
						<div class="row no-margin">
							<div class="col-sm-9 col-md-9 col-xs-9 text-left no-padding">
								<span><b>Tiya Pol </b></span>
								<p class="faded-text"></p>
							</div>
							<div class="col-sm-3 col-md-3 col-xs-3 text-right">
								<a><span class="trash" id="6"><i class="fa fa-trash"></i></span></a>
							</div>
						</div>
					</div>
				</div>-->
			</div>
			<div class="tab-pane" id="tab4">
				<form id="automatic-form" method="POST">
				@csrf
				<label class="switch">
					@if(!empty($profileData['auto_reply'] && $profileData['auto_reply']))
						<input id="togBtn" type="checkbox" checked>
					@else
						<input id="togBtn" type="checkbox">
					@endif
					<div class="slider round">
						<span class="on">ON</span><span class="off">OFF</span>
					</div>
				</label>
				<p>Send automatic replies to Incoming messages</p>
				<textarea class="automatictextarea" name="message" rows="3" style="margin: 0;">{{ $profileData['automatic_message'] }}</textarea>
				<br>
				<button type="submit" class="btn btn-danger">Save</button>
				</form>
			</div>
			</div>
		</div>
      </div>
      <div class="col-md-6 col-sm-12 col-xs-12 get-all-users-second">
        <div class="buyer-form">
          <h4>Messages -</h4>
          <form id="send-message-form" method="POST" action="#" enctype="multipart/form-data">
            @csrf
			<input type="hidden" name="received_by" />
          <div class="row">
            <div class="col-md-12">
              <div class="form-sec direct-chat-success">
                
				<div class="direct-chat-messages">     
					<!--<div class="direct-chat-msg">
					  <div class="direct-chat-info clearfix">
						<span class="direct-chat-name pull-left">Alexander Pierce</span>
						<span class="direct-chat-timestamp pull-right">23 Jan 2:00 pm</span>
					  </div>				
					  <img class="direct-chat-img" src="https://via.placeholder.com/40.png" alt="Message User Image">
					  <div class="direct-chat-text">
						Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s
					  </div>					  
					</div>                             
					<div class="direct-chat-msg right">
					  <div class="direct-chat-info clearfix">
						<span class="direct-chat-name pull-right">Sarah Bullock</span>
						<span class="direct-chat-timestamp pull-left">23 Jan 2:05 pm</span>
					  </div>                
					  <img class="direct-chat-img" src="https://via.placeholder.com/40.png" alt="Message User Image">
					  <div class="direct-chat-text">
						You better believe it!
					  </div>					  
					</div>
					<div class="direct-chat-msg">
					  <div class="direct-chat-info clearfix">
						<span class="direct-chat-name pull-left">Alexander Pierce</span>
						<span class="direct-chat-timestamp pull-right">23 Jan 2:00 pm</span>
					  </div>				
					  <img class="direct-chat-img" src="https://via.placeholder.com/40.png" alt="Message User Image">
					  <div class="direct-chat-text">
						Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s
					  </div>					  
					</div>                             
					<div class="direct-chat-msg right">
					  <div class="direct-chat-info clearfix">
						<span class="direct-chat-name pull-right">Sarah Bullock</span>
						<span class="direct-chat-timestamp pull-left">23 Jan 2:05 pm</span>
					  </div>                
					  <img class="direct-chat-img" src="https://via.placeholder.com/40.png" alt="Message User Image">
					  <div class="direct-chat-text">
						You better believe it!
					  </div>					  
					</div>-->
              </div>               
              </div>
            </div>
          </div>
          <div class="sec-btn" style="text-align: left;">
			<div class="form-group no-margin">
				<textarea placeholder="Type Message Here" class="no-margin"></textarea>
			</div>
			<div class="row">
				<div class="col-md-12">
					<input type="file" name="message_file" id="message_file" />
					<button type="submit" class="btn btn-danger send-message pull-right">Send</button>
				</div>
			</div>
          </div>
		  </form>
        </div>
      </div>
      <div class="col-md-3 col-sm-12 col-xs-12 get-all-users-third">
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

@include('message-chat-script')