<!---Seller Profile---->
@extends('layouts.seller') @section('content')

<!-- banner start -->
<section class="wow fadeIn cover-background buyer-banner-sec socail-buzz background-position-top top-space" style="background-image:url({{ asset('assets/images/buyer/blue-bg.png')}});">
 <div class="bg-border">
 <div class="container">
  <div class="row">
   <div class="col-md-12 col-sm-12 col-xs-12 display-table page-title-large">
    <div style="padding-top:45px; padding-bottom:45px;" class="display-table-cell vertical-align-middle banner-heading text-center">
     <!--start page title -->
      <h2 class="text-white"> <i class="fa fa-camera" aria-hidden="true"></i><br/></h2> 
        <span class="display-block text-white alt-font">
              Upload your image</span>
              <!-- end sub title -->
          </div>
      </div>
  </div>
</div>
</div>
</section>
<style>
.bg-border{
	border: 2px solid dimgrey;
    border-style: dashed;
    width: 96%;
    margin-top: 45px;
    border-radius: 10px;
}
.seller-profile h2 {
    text-align: center;
	padding: 15px!important;
    margin: 0!important;
    text-transform: uppercase!important;
	
}
.seller-profile h3 {
	color:black !important;
}
.up-img{
	text-align:center;	
    padding: 15px;
}
i.fa.fa-camera {
    font-size: 35px;
    padding-top: 25px;
	color:#DBCFE3 !important;
}
.buyer-banner-sec .banner-heading span{	
	font-style:normal !important;
	font-weight:300 !important;
	color:#DBCFE3 !important;
}
.seller_data_right h3{
	text-align:left;	
}
.seller_data_left h3{
	text-align: left;
    margin-left: 110px;
}
.seller_data_right i.fa.fa-address-book-o{
	font-size:30px;
}
.seller_data_left i.fa.fa-address-book-o{
	font-size:30px;
}
.seller_data_left{
	text-align:left;
}
.seller_data_left img{
	border-radius: 50%;
    object-fit: cover;
    object-position: center;
    max-width: 200px!important;
    height: 200px;
    margin: 5px 0px 0px 60px;
}
.seller_data_left h4{
	text-align:left;
	padding: 5px 0px 0px 0px !important;
    margin: 0px !important;
	
}
.seller_data_right h4{
	text-align:right;
	padding: 5px 0px 0px 0px !important;
    margin: 0px !important;
}

.seller_data_right h5 {
	text-align: center;
    padding: 92px 0px 0px 0px !important;
    margin: 0px !important;
    position: relative;
	color:#DBCFE3;
	font-weight:normal !important;	
	border: 2px solid dimgrey;
	border-radius:10px;
    border-style: dashed;
    width: 95%;
    margin-top: 19px !important;
    margin-left: 15px !important;   
    padding-bottom: 100px !important;
}
.seller_data_right .round-rect{
	position: absolute;
    width: 95%;
    height: 290px;
}
li.seller_data_left_li {
    width: 20%;
    display: inline-block;
	text-align:center;
}
ul.seller_data_left_ul {
    width: 100%;
	margin-left: 35px !important;
}
ul.second_seller_data_left_ul {
    width: 100%;
	margin-left: 35px !important;
}
li.second_seller_data_left_li {
    width: 20%;
    display: inline-block;
	text-align:center;
}
.seller_data_right i.fa.fa-video-camera {
    color: #DBCFE3;
    font-size: 35px;
}
.bio_info{
	padding-top:50px;
	margin-bottom:50px;
}
.msgme{
	color: white !important;
    font-size: 17px !important; 
    text-transform: capitalize !important;
    padding: 10px 30px 10px 30px !important;
    border-radius: 5px !important;
}
.rd{
	border: 1px solid #ff503f !important;
    background: white !important;
    color: #ff503f !important;
    font-size: 17px !important;
    text-transform: capitalize !important;
    padding: 10px 30px 10px 30px !important;
    border-radius: 5px !important;
    margin-left: 25px;
}
.rd fa.fa-motorcycle{
	color:green !important;
}
.join_date{
	margin-left: 90px;
}
.bio_info h3{
	padding-bottom:20px;
}
.bio_info p{
	padding-bottom:50px;
	text-align:left;
}
.seller-profile{
	padding: 25px 0!important;
}
.seller-profile p{
	color: #333!important;
    font-weight: 400!important;
    font-size: 14px!important;
}

</style>
<section class="seller-profile">
   <div class="container">
   <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
         <div class="">
           
            <div class="col-md-12 seller_data">
             
               <div class="col-md-12 col-sm-12 col-xs-12">
                  
				<div class="col-md-6 col-sm-6 col-xs-12 seller_data_left pt-4 pb-4">	
					                   
						 <img src="../assets/images/buyer/Layer 13.png" width="250px" alt="profileImage">
						 <h3 class="pt-3">Sathavara</h3>
						 <p class="join_date">1/1/2020 (Joined)</p> 

						<ul class="seller_data_left_ul">
						  <li class="seller_data_left_li"><i class="fa fa-bar-chart" aria-hidden="true" style="color: red;font-size: 20px;"></i><br/><p>Sales (0)</p></li>
						  <li style="display:none;" class="seller_data_left_li"><i class="fa fa-envelope" aria-hidden="true" style="color: red;font-size: 20px;"></i><br/><p>Message (0)</p></li>
						  <li class="seller_data_left_li"><i style="color: #f1f10a;font-size: 20px;" class="fa fa-trophy" aria-hidden="true"></i><br/><p>Awards (0)</p></li>
					</ul>
					
					<ul class="second_seller_data_left_ul">					
						  <li class="second_seller_data_left_li"><i class="fa fa-motorcycle" aria-hidden="true" style="color: green;font-size: 20px;"></i><br/><p>Riders (0)</p></li>
						  
						  <li class="second_seller_data_left_li"><i style="color: blue;font-size: 20px;" class="fa fa-motorcycle" aria-hidden="true"></i><br/><p>Following (0)</p></li>
					</ul>
					  
					  
                  </div>
                  <div class="col-md-6 col-sm-6 col-xs-12 seller_data_right pt-4">
				  <h3>Video Bio</h3>
				   <img src="../assets/images/buyer/Rounded Rectangle 2.png" class="round-rect" alt="profileImage">
                     
                     <h5><i class="fa fa-video-camera" aria-hidden="true"></i><br/><br/>Upload Video Only</h5>
                   
                    
                  </div>
                 
               </div>
			   <div class="col-md-12 col-sm-12 col-xs-12 bio_info">
                  <div class="text-center">
                     <h3>Bio Info</h3>
					 <p> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. </p>
                  </div>
				  
				   
				  <div class="demo">
				  <h3>Live Products For Sale</h3>
                  <ul id="lightSlider3">
                     <li>
                        <div class="col-md-12 col-sm-12 blog-rela" style="padding:0px;">
                           <div class="cards">
                              <img src="../assets/images/buyer/buyer-profile-banner.jpg" />
                           </div>
                        </div>
                     </li>
                     <li>
                        <div class="col-md-12 col-sm-12 blog-rela" style="padding:0px;">
                           <div class="cards">
                              <img src="../assets/images/buyer/buyer-profile-banner.jpg" />
                           </div>
                        </div>
                     </li>
                     <li>
                        <div class="col-md-12 col-sm-12 blog-rela" style="padding:0px;">
                           <div class="cards">
                              <img src="../assets/images/buyer/buyer-profile-banner.jpg" />
                           </div>
                        </div>
                     </li>
                     <li>
                        <div class="col-md-12 col-sm-12 blog-rela" style="padding:0px;">
                           <div class="cards">
                              <img src="../assets/images/buyer/buyer-profile-banner.jpg" />
                           </div>
                        </div>
                     </li>
                  </ul>
               </div>
				 
			   <div class="p-1">
                  <div class="text-center">
                     <button type="button" class="btn btn-primary msgme"> Message me</button>
                 
                     <a type="button" class="btn btn-primary rd"> <i class="fa fa-motorcycle" aria-hidden="true" style="color: green;"></i>  Riders</a>
                 
               </div>
                 
               </div>
               
               
            </div>
         </div>
      </div>
   </div>
</section>


<style>
		.demo {
			width:100%;
		}
		.demo {
			width: 100%;
            height: auto;
            object-fit: cover;
		}
		
		#lightSlider3 + .lSAction > a {   
			background-image: url(assets/images/a.png);
			top: 30%;
			opacity:1;

		}
		.lSSlideOuter .lSPager.lSpg > li.active a{
			background:#FE0034;
		}
		.lSSlideOuter .lSPager.lSpg > li a{
			background:#cc8c99;
		}
		.lSSlideOuter .lSPager.lSpg > li{
			margin-right:0px;
		}
		ul.lSPager.lSpg > li{
			margin-top: 15px;
			text-align:center;
			cursor: pointer;
			display: inline-block;
			padding: 0 5px;
			float: none;
		}
		ul.lSPager.lSpg{
			margin-top: 5px;
			display: block;
			float: left;
			width: 100%;
			text-align: center;
		}
		#lightSlider3{
			height: auto !important;
		}

		ul {
			list-style: none outside none;
			padding-left: 0;
			margin-bottom:0;
		}
		#lightSlider3 li {
			width: 23.2%;
			display: inline-block;
			margin-left: 10px;
		}
		li {
			display: block;
			margin-right: 6px;
			cursor:pointer;
		}
		.he-ic img{
			margin-right: 50px;
		}
		#lightSlider3 img {
			display: block;
			height: auto;
			max-width: 100%;
		}

		.subscribe {
			background:#FE0034;
			color: white !important;
		}

		.dt-au-le{
			margin-left:-25px;
		}
		.dt-au-le-name{
			margin-left:-65px;
		}
		.dt-au-lestar{
			margin-left:-20px;
		}
		.buyer-form h4 {
			padding: 0px !important;		
		}
		@media only screen and (min-width: 320px) and (max-width: 767px) {
	
	.seller_data_left{
		text-align:center;
	}
	
	.seller_data_left img{
		margin:0px;
	}
	
	.seller_data_left h3 {
		text-align: center;  
		margin-left: 0px;
	}
	.join_date {
		margin-left: 0px;
		text-align:center;
	}
	li.seller_data_left_li {
		width: 100%;    
	}
	ul.seller_data_left_ul {
		width: 100%;
		margin-left: 5px !important;
	}
	ul.second_seller_data_left_ul {
		width: 100%;
		margin-left: 5px !important;
	}
	li.second_seller_data_left_li {
		width: 100%;    
	}	
	button.btn.btn-primary.msgme{
		width: 100%;
		margin-bottom: 20px;
	}
	a.btn.btn-primary.rd {   
		width: 100%;
		margin: 0px;
	}
	#lightSlider3 img {
		display: block;
		height: auto;		
		width: 100% !important;
	}
	#lightSlider3 li {
			width: 100%;
			display: inline-block;
			margin-left: 5px;
		}
} 

@media only screen and (min-width:  768px) and (max-width: 1200px) {
	
	.seller_data_left{
		text-align:center;
	}
	
	.seller_data_left img{
		margin:0px;
	}
	
	.seller_data_left h3 {
		text-align: center;  
		margin-left: 0px;
	}
	.join_date {
		margin-left: 0px;
		text-align:center;
	}
	li.seller_data_left_li {
		width: 100%;    
	}
	ul.second_seller_data_left_ul {
		width: 100%;
		margin-left: -35px !important;
	}
	li.second_seller_data_left_li {
		width: 100%;    
	}
	
	#lightSlider3 img {
		display: block;
		height: auto;
		max-width: 100%;
		width: 100%;
	}
	
	#lightSlider3 li {
			width: 100%;
			display: inline-block;
			margin-left: 5px;
		}
	
	}
	</style>

	<script>
		$('#lightSlider3').lightSlider({
			item: 4,
			loop:true,
			slideMargin: 15,
			useCSS:true,
			pager: true,
			responsive : [
			{
				breakpoint:400,
				settings: {
					item:1,
					slideMove:1
				}
			}
			],

		});
	</script>
