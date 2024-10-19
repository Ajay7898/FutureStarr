@php  $riders = riders(!empty(Auth::check()) ? Auth::user()->id : '')  @endphp
<div class="modal fade riders-list" id="exampleModalLong" tabindex="-1" role="dialog" >
   <div class="modal-dialog" role="document">
      <div class="modal-content" style="height:500px !important;">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            X
            </button>
            <h4 class="modal-title">Riders ({{ count($riders) }})</h4>
         </div>
         <div class="modal-body">
		 
			<div class="container">		 
				<div class="row">
					@if(count($riders) > 0)
			           @foreach($riders as $value)

	                    @if($value->role == 'seller')

	                          @php $profile_link = route('seller-public-profile', $value->public_profile ) @endphp

	                       @elseif($value->role == 'buyer')

	                          @php $profile_link = route('buyer-public-profile', $value->public_profile ) @endphp

	                       @else 
	                          @php $profile_link = 'javascript:void(0)' @endphp
	                    @endif

						<div class="rider-main-block pop-bg">
							<div class="avatar-seller-rider">
							  <a href="{{ $profile_link }}" target="_blank"> 
								   <img class="rounded-circle" width="50px" src="{{ !empty($value->profile_pic) && file_exists($value->profile_pic) ? asset($value->profile_pic) : url('assets/images/star-logo.png') }}"
										   data-holder-rendered="true">
								</a> 
							</div>
							<div class="name-seller-rider">
							  <a class="popup-name" href="#">
										 <p>{{ $value->first_name ?: ''}}&nbsp;{{ $value->last_name ?: ''}}</p>
										</a>
							</div>
							<div class="seller-buyer seller">
							  <a type="button" class="btn btn-info" href="javascript:void(0)">{{ $value->role }}</a>
							</div>
							<div class="following-btn">
							  <a style="background:green;" type="button" class="btn btn-info" href="javascript:void(0)">Following</a>
							</div>
						</div>
						
			   @endforeach
			   @else 
			        <h4 style="padding-left: 14.5pc; padding-top: 10pc; font-size: 40px;" class="text-center text-danger">No Riders yet!</h4>
               @endif
     
		  </div>
		</div>
		 
         </div>
         <div class="modal-footer">
            <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button> -->
         </div>
      </div>
   </div>
</div>
<style>
.modal-body{overflow:auto;}
   .rider-main-block {
    width: 100%;
    max-width: 100%;
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: space-between;margin-bottom:5px
}

.rider-main-block>div {
    margin: 0px 0 0 10px;
}
.rider-main-block>div:first-child{margin-left:0}

.following-btn {
    width: 150px;
}

.seller-buyer {
    width: 114px;
}

.avatar-seller-rider {
    width: 10%;
}

.name-seller-rider {
    width: calc(100% - 30%);
}

@media screen and (max-width:960px){
	.rider-main-block{flex-wrap:wrap}
	.following-btn,.seller-buyer{width:50%;margin:5px 0 5px 0!important}
	.following-btn{text-align: right;}
	.name-seller-rider{width: calc(100% - 17%);}
}
@media screen and (max-width:450px){
	.following-btn {text-align: left;}
	.following-btn, .seller-buyer {width: 100%;}
	.avatar-seller-rider{width: 100px}
	.name-seller-rider{width:100%}
}
	.pop-bg{
		background:#2C3150;
		border-radius: 5px;
		border: 1px solid #2C3150;
		padding:10px;
	}
	.pop-bg-red{
		background:#1F7280;
		border-radius: 5px;
		border: 1px solid #1F7280;
		padding:10px;
	}
	.riders-list a.btn.btn-info {
		background: #21a6bb;
		padding: 10px 35px 10px 35px !important;
	}
	.pop-bg-red a.btn.btn-info {
		background: #2C3150 !important;
		padding: 10px 35px 10px 35px !important;
	}
	.riders-list p{
		margin-top: 10px;
		text-transform: uppercase;
	}
	@media only screen and (min-width: 320px) and (max-width: 767px) {
		.riders-list a.btn.btn-info {
			background: #21a6bb;
			padding: 10px 35px 10px 35px !important;			
		}
		
	.pop-bg-red a.btn.btn-info {
			background: #2C3150 !important;
			padding: 10px 35px 10px 35px !important;			
		}
	.buyer{
			text-align:left;
			padding-bottom:0px;
		}
	.seller{
			text-align:left;
		}
	}

   .fa.fa-motorcycle{
	   font-weight: bold;
	   font-size: 16px;
	   color: green !important;
   }
   .riders-list a.btn.btn-info {
		background: #21a6bb;   
   }
   .riders-list p{
	   color:white !important;
	   font-weight:bold !important;
   }
   .riders-list .list-group-item{
	   background: #2c3150;
	   color: white !important;
	   font-weight: bold;
	   margin: 5px !important;
   }
   .avatar-seller-rider img.rounded-circle {
    height: 50px;
    object-fit: cover;
}
</style>

@php  $following = following(!empty(Auth::check()) ? Auth::user()->id : '')  @endphp

<div class="modal fade riders-list" id="user-rider" tabindex="-1" role="dialog" >
   <div class="modal-dialog" role="document">
      <div class="modal-content" style="height:500px !important;">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            X
            </button>
            <h4 class="modal-title">Following ({{ count($following) }})</h4>
         </div>
         <div class="modal-body">
		 
		  <div class="container">		 
		  <div class="row">
		   @if(count($following) > 0 )
                @foreach($following as $value)

                    @if($value->role == 'seller')
                          @php $profile_link = route('seller-public-profile', $value->public_profile ) @endphp

                       @elseif($value->role == 'buyer')

                          @php $profile_link = route('buyer-public-profile', $value->public_profile ) @endphp
                          
                       @else 
                          @php $profile_link = 'javascript:void(0)' @endphp
                    @endif
					<div class="rider-main-block pop-bg">
						<div class="avatar-seller-rider">
						    <a href="{{ $profile_link }}" target="_blank"> 
								<img class="rounded-circle" width="50px" src="{{ !empty($value->profile_pic) && file_exists($value->profile_pic) ? asset($value->profile_pic) : url('assets/images/star-logo.png') }}" data-holder-rendered="true">
							</a> 
						</div>
						<div class="name-seller-rider">
						  <a class="popup-name" href="#">
									 <p>{{ $value->first_name ?: ''}}&nbsp;{{ $value->last_name ?: ''}}</p>
									</a>
						</div>
						<div class="seller-buyer buyer">
						  <a type="button" class="btn btn-info" href="#">{{ $value->role }}</a>
						</div>
						<div class="following-btn">
						  <a style="background:green;" type="button" class="btn btn-info" href="javascript:void(0)" id="un-follow-{{ Crypt::encryptString($value->user_id)}}" data-toggle="tooltip" data-placement="top" title="unfollow" data-url="{{ route('unfollow.user', [Crypt::encryptString($value->user_id), Crypt::encryptString(Auth::user()->id ) ] ) }}">Following</a>
						</div>
					</div>
			    @endforeach
			    @else
			    <h4 style="padding-left: 6pc; padding-top: 10pc; font-size: 40px;" class="text-danger text-center">You are not following anyone yet!</h4>
            @endif
     
		  </div>
		</div>
         </div>
         <div class="modal-footer">
            <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
               <button type="button" class="btn btn-primary">Save changes</button> -->
         </div>
      </div>
   </div>
</div>

