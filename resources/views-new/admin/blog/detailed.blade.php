

@extends('layouts.talent') @section('content')


<!-- banner start -->
<section class="wow fadeIn cover-background background-position-top top-space" style="background-image:url({{ asset('assets/images/blog-list-banner.jpeg')}});">
	<div class="opacity-medium bg-extra-dark-gray"></div>
	<div class="container">
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12 display-table page-title-large">
				<div class="display-table-cell vertical-align-middle text-center padding-30px-tb">
					<!-- start page title -->
					<h1 class="alt-font text-white font-weight-600 mb-2">FutureStarr</h1>
					<!-- end page title -->
					<!-- start sub title -->
					<span class="display-block text-white opacity6 alt-font">
						{{ $blogData->title }}
					</span>
					<!-- end sub title -->
				</div>
			</div>
		</div>
	</div>
</section>
<!-- End banner  -->
<!-- start post content section -->
<style type="text/css">
	.activeCat a {
		color:#ff503f !important;
	}
</style>
<section>
	<div class="container">
		<div class="row">
			<main class="col-md-8 col-lg-9 mb-5 detail-blog-secss">
				<div class="text-extra-dark-gray margin-20px-bottom alt-font text-uppercase text-large font-weight-600 ">

					<h2 class="aside-title margin-0">{{ $blogData->title }}</h2>
				</div>
				<div class="blog-details-da border-all blog-details-text last-paragraph-no-margin">
					@if(!empty($blogData->blog_img)) 
					<img src="{{ asset($blogData->blog_img)}}" style="width: 100%;
							height: 400px;
							object-fit: cover;padding:15px;" alt="Blog Banner"/>
					@else 
					<img style="height: 400px !important;width:1500px !important;"src="{{ asset('assets/images/defaultblog.png')}}" alt="Blog Banner"/>
					@endif
					
					
			             <!-- <div class="blog-image pt-2">  
                              <a href="">                               
                                   <iframe width="400px" height="400px"  class="embed-responsive-item width-100" src="https://www.youtube.com/embed/zpOULjyy-n8?rel=0" allowfullscreen></iframe>                              
                              </a>
							  
                          </div> -->
                      <p class="pl-2 pr-2">
                        {!! $blogData->content !!}</p>
                          
                          
                      </div>
                      
                      <div class="col-md-12 blog-sectionss social-icon-style-6 text-center border-all pt-5 border-top-none">
                      	
                      	<h2 class="pb-4">Share Article</h2>
                      	
                      	
                      	<ul class="extra-small-icon pb-4 sharebut">
                      		<li class="pl-3 pr-3">
                      			<a class="facebook customer share" href="http://www.facebook.com/sharer.php?u={{Request::url()}}" shareButton="facebook" >
                      				<i class="fa fa-facebook"></i>
                      			</a>
                      		</li>
                      		<li class="pl-3 pr-3">
                      			<a class="twitter customer share" href="http://twitter.com/share?text=share&url={{Request::url()}}&amp;text=Share talent &amp;hashtags=FutureStarr
                      			" target="_blank" >
                      			<i class="fa fa-twitter"></i>
                      		</a>
                      	</li>
                      	<li class="pl-3 pr-3">
                      		<a class="linkedin customer share" href="http://www.linkedin.com/shareArticle?mini=true&amp;url={{Request::url()}}" target="_blank" target="_blank">
                      			<i class="fa fa-linkedin"></i>
                      		</a>
                      	</li>
                      	
                      	<li style="display:none;" class="pl-3 pr-3">
                      		<a class="google customer share" href="https://plus.google.com/share?url={{Request::url()}}" target="_blank" >
                      			<i class="fa fa-google-plus"></i>
                      		</a>
                      	</li>
                      	<li style="display:none;" class="pl-3 pr-3">
                      		<a class="pinterest customer share" href="javascript:void((function()%7Bvar%20e=document.createElement('script');e.setAttribute('type','text/javascript');e.setAttribute('charset','UTF-8');e.setAttribute('src','http://assets.pinterest.com/js/pinmarklet.js?r='+Math.random()*99999999);document.body.appendChild(e)%7D)());">
                      			<i class="fa fa-pinterest"></i>
                      		</a>
                      	</li>
                      </ul>
                      
                  </div>
                  
                  <div class="col-md-12 blog-sectionss border-all">
                  	
                  	<h2 class="pb-4 text-center">Related Articles</h2>
                  	
                  	<div class="demo">
                  		<ul id="lightSlider2">
                  			@if(count($relatedBlogs) > 0)
                  			@foreach($relatedBlogs as $key => $blog)
                  			<li>
                  				<div class="col-md-12 col-sm-12 blog-rela" style="padding:0px;">
                  					<div class="card mb-2">
                  						<img style="width: 100%;
						height: 300px;
						object-fit: cover;" class="p-4" src="{{asset( !empty($blog->blog_img) && file_exists($blog->blog_img) ? $blog->blog_img:'assets/images/default-ad-banner.png')}}" />
                  						
                  						<div class="card-body">
                  							<h4 class="card-title">{{ $blog->title ?: '' }}</h4>
                  							<p style="margin: 15px 5px;" class="card-text">{!! Str::limit(strip_tags($blog->content), 105) !!}</p>
                  							<a href="{{ route('blog.detailed', [ $blog->getBlogCatagories['slug'], $blog->slug] ) }}" class="btn btn-primary">Read More</a>
                  						</div>
                  						<div class="col-md-12 border-top pt-4 mb-5">
										
											<div class="dt-au-lestar col-xs-2 col-md-3 mb-5 star-author text-medium-gray text-extra-small text-uppercase alt-font">
                  							
                  							
                  								
                  								<img class="au-img-au" src="{{ asset('assets/images/star.png')}}" style="background-image: url({{asset( !empty($blog->author_image) && file_exists($blog->author_image) ?  str_replace(' ', '%20', $blog->author_image):'assets/images/aside-image-4.jpg')}});" alt="Author Profile Image">
												
												</div>
                  								
                  								
                  								<div class="dt-au-le col-md-9 col-xs-9 txt-sm-f pt-5  text-left text-medium-gray text-extra-small text-uppercase alt-font">
                  									{{date('F d, Y', strtotime($blog->created_at))}} &nbsp &nbsp  | &nbsp &nbsp
                  									
                  										<a href="javascript:void(0);" class="text-medium-gray margin-15px-top"> {{ $blog->author_first_name ?: '' }}  </a> 
														
														<a href="javascript:void(0);" class="text-medium-gray margin-15px-top"> {{ $blog->author_last_name ?: ''  }} </a> 
                  									
                  								</div>
                  							
                  						</div>
                  					</div>
                  				</div>
                  				
                  				
                  			</li>
							
						
                  			@endforeach
                  			
                  			@else
                  			
                  			<p class="color-danger text-center">
                  				Sorry, no blogs available for this category!
                  			</p>
                  			
                  			@endif
                  		</ul>
                  	</div>

                  	<style>
						.blog-sectionss p {
							color: #6f6f6f!important;
							font-size: 12px!important;
							max-height: 25px !important;
							overflow: hidden !important;
						}
                  		.sharebut{
                  			display: flex;
                  			justify-content: center;
                  		}
                  		.blog-details-da p{
                  			margin: 15px 15px !important;
                  		}
                  		.blog-details-da h1, h2, h3, h4, h5, h6{
                  			margin: 5px 5px !important;
                  		}

                  		.width-85 {
                  			width: 80px;
                  			height: 80px;
                  			object-fit: cover;
                  		}

                  		a.facebook.customer.share {
                  			color: white !important;
                  			background-color: #3B5998 !important;
                  			border: 1px solid #3B5998;
                  			width:30px !important;
                  			height:30px !important;
                  		}

                  		a.twitter.customer.share {
                  			color: white !important;
                  			background-color: #00acee !important;
                  			border: 1px solid #00acee;
                  			width:30px !important;
                  			height:30px !important;
                  		}

                  		a.linkedin.customer.share {
                  			color: white !important;
                  			background-color: #0e76a8 !important;
                  			border: 1px solid #0e76a8;
                  			width:30px !important;
                  			height:30px !important;
                  		}

                  		a.google.customer.share {
                  			color: white !important;
                  			background-color: #db4a39 !important;
                  			border: 1px solid #db4a39;
                  			width:30px !important;
                  			height:30px !important;
                  		}

                  		a.pinterest.customer.share {
                  			color: white !important;
                  			background-color: #c8232c !important;
                  			border: 1px solid #c8232c;
                  			width:30px !important;
                  			height:30px !important;
                  		}

                  		.au-imgs {
                  			height: 188px;
                  			max-width: 183px !important;
                  		}
						img.au-img-dd{
							background-repeat: no-repeat;
							background-size: cover;
							background-position: center center;
						}
                  		.au-img-au {
                  			width: 80%;
                  			float: left;
                  			margin-left: -20px;
                  			position: absolute;
							background-repeat: no-repeat;
							background-size: cover;
							background-position: center center;
                  		}

                  		.au-img-au-a {
                  			width: 60%;
                  			height: 60%;
                  			border-radius: 60%;
                  			margin-left: 18%;
                  			margin-top: 28%;
                  		}

                  		.txt-sm-f {	
                  			font-size: 12px;
                  			line-height: 20px;
                  		}

                  		.au-img-au-t {
                  			width: 25%;
                  			float: left;
                  			margin-left: 0px;
                  			position: absolute;
                  			top: 5%;
                  		}
                  		.au-img-au-a-t {
                  			width: 75%;
                  			height: 75%;
                  			border-radius: 75%;
                  			margin-left: 25%;
                  			margin-top: 40%;
                  		}
                  		.card-body a.btn.btn-primary {
							background: #FE0034 !important;
							color: white !important;
							border: 5px solid #FE0034 !important;
							float: left;
							padding: 5px 20px 5px 20px;
							text-transform: initial !important;
							font-size: 10px;
						}

                  		.blog-details .au-img-au-a {
                  			width: 55px;
                  			height: 55px;
                  			border-radius: 50px;
                  			margin-left: 15px;
                  			margin-top: 15px;
                  		}
                  		.blog-details .au-img-au {
                  			width: 95%;
                  			float: left;
                  			margin-left: 0px;
                  			position: absolute;
                  		}
                  		.blog-details .au-img-au-a {
                  			width: 55%;
                  			height: 55%;
                  			border-radius: 55%;
                  			margin-left: 22%;
                  			margin-top: 30%;
                  		}
                  		.dt-au{
                  			margin-top: 100px;
                  		}

                  		.au-img {
                  			width: 40%;
                  			height: 38%;
                  			border-radius: 50%;
                  			margin-left: 30%;
                  			margin-top: -65%;
                  			position: absolute !important;
                  		}

                  		.tt-au-data{
                  			position:relative !important;
                  		}
                  		@media only screen and (max-width: 400px) and (min-width: 320px)  {
							
							.bgc{
								width:95%;
								margin: 0 auto;
							}
							.bgcs{
								width:95%;
								margin: 0 auto;
							}
                  			
                  			.tt-au-data{
                  				position:relative !important;
                  			}
                  			
                  			img.au-img-dd {
                  				width: 100%;
                  			}
                  			
                  			
                  			
                  			.au-img {
                  				width: 36%;
                  				height: 40% !important;
                  				border-radius: 59%;
                  				margin-left: -63%;
                  				margin-top: 29%;
                  				position: absolute;
                  			}
                  			
                  			.au-imgs {
                  				height: 85px;
                  				max-width: 75px !important;
                  			}
                  			
                  			.au-img-au {
								width: 35%;
								margin-left: 0px;
							}
                  			
                  			
                  			
                  			.txt-sm-f {
                  				font-size: 9px;
                  				line-height: 20px;
								margin-top: 20px;
                  			}
                  		}

                  		@media only screen and (max-width: 575px) and (min-width:400px)  {
							
							.bgc{
								width:95%;
								margin: 0 auto;
							}
							.bgcs{
								width:95%;
								margin: 0 auto;
							}
                  			
                  			.tt-au-data{
                  				position:relative !important;
                  			}
                  			
                  			img.au-img-dd {
                  				width: 100%;
                  			}
                  			
                  			.au-img {
                  				width: 36%;
                  				height: 40% !important;
                  				border-radius: 59%;
                  				margin-left: -63%;
                  				margin-top: 29%;
                  				position: absolute;
                  			}
                  			
                  			.au-imgs {
                  				height: auto;
                  				max-width: 95px !important;
                  			}
                  			.au-img-au {
								width: 55% !important;
								float: left;
								margin-left: 5px;
								position: absolute;
							}
                  			.txt-sm-f {
                  				font-size: 12px;
                  				line-height: 20px;
								margin-top: 50px;
                  			}
                  		}

                  		@media only screen and (max-width: 767px) and (min-width:575px)  {
							
							.bgc{
								width:95%;
								margin: 0 auto;
							}
							.bgcs{
								width:95%;
								margin: 0 auto;
							}
                  			
                  			.tt-au-data{
                  				position:relative !important;
                  			}
                  			
                  			img.au-img-dd {
                  				width: 100%;
                  			}
                  			
                  			.au-img {
                  				width: 36%;
                  				height: 40% !important;
                  				border-radius: 59%;
                  				margin-left: -63%;
                  				margin-top: 29%;
                  				position: absolute;
                  			}
                  			
                  			.au-imgs {
                  				height: auto;
                  				max-width: 125px !important;
                  			}
                  			
                  			.au-img-au-a {
                  				width: 75%;
                  				height: 75%;
                  				border-radius: 75%;
                  				margin-left: 10%;
                  				margin-top: 25%;
                  			}
                  			
                  			.au-img-au {
								width: 55% !important;
								float: left;
								margin-left: 5px;
								position: absolute;
							}
                  			
                  			.txt-sm-f {
                  				font-size: 12px;
                  				line-height: 20px;
                  				margin-top: 25%;
                  				margin-left: 25px;
                  			}
                  		}

                  		@media only screen and (max-width: 990px) and (min-width:767px)  {
							
							.bgc{
								width:100%;
							}
							.bgcs{
								width:100%;
							}
                  			
                  			.au-imgs {
                  				height: auto;
                  				max-width: 125px !important;
                  			}
                  			
                  			.au-img-au-a {
                  				width: 75%;
                  				height: 75%;
                  				border-radius: 75%;
                  				margin-left: 10%;
                  				margin-top: 25%;
                  			}
                  			
                  			.au-img-au {
                  				width: 100%;
                  				float: left;
                  				margin-left: 0px;
                  				position: absolute;
                  			}
                  			
                  			.txt-sm-f {
                  				font-size: 12px;
                  				line-height: 20px;
                  				margin-top:0px;
                  				margin-left: 1px;
                  			}
                  		}



                  		.demo {
                  			width:100%;
                  		}
                  		#lightSlider2 + .lSAction > a {   
							background-image: url(/assets/images/a.png);
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
						#lightSlider2{
							height: auto !important;
						}

                  		ul {
                  			list-style: none outside none;
                  			padding-left: 0;
                  			margin-bottom:0;
                  		}
                  		li {
                  			display: block;
                  			float: left;
                  			margin-right: 6px;
                  			cursor:pointer;
                  		}
                  		img {
                  			display: block;
                  			height: auto;
                  			max-width: 100%;
                  		}
                  	</style>

                  	<script>
                  		$('#lightSlider2').lightSlider({
							item: 2,
							loop:true,
							slideMargin: 5,
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

                  	
                  	
                  	
                  </main>
                  <aside class="col-md-4 col-lg-3">
                  	<div class="margin-45px-bottom xs-margin-25px-bottom">
                  		<div class="text-extra-dark-gray margin-20px-bottom alt-font font-weight-600 text-small text-center">
                  			<h2> Super Star Author</h2>
                  		</div>	   
                  		
                  		<div class="row justify-content-between align-items-center">
                  			<div class="border-all bgcs">
                  				<div class="tag-cloud tt-au-data margin-20px-bottom">
                  					

                  					<img class="au-img-dd" src="{{asset('assets/images/star.png')}}" style="background-image:url({{ asset( !empty($blogData['author_image']) && file_exists($blogData['author_image']) ? str_replace(' ', '%20', $blogData->author_image) :'assets/images/aside-image-4.jpg')}})" alt="Author Profile Image">							
                          
									
                  					<br/>
                  				</div>
                  				<div class=" border-top pl-3 pr-3 pt-2 pb-t text-medium-gray text-small margin-5px-bottom text-uppercase alt-font">
                  					<a  href="javascript:void(0);"> {{ $blogData['author_first_name'] }} {{ $blogData['author_last_name'] }} <br/>
                  						<a href="javascript:void(0);">Posted on  {{date('F d , Y' , strtotime($blogData['date']))}}</a> 
                  					</a> 
                  				</div>
                  				<div class="border-top pt-4 social-icon-style-6 text-center">
                  					<h4 class="pb-4">Share Article</h4>
                  					<ul style="width: 100% !important;
                  					margin-left: 25px;" class="extra-small-icon">
                  					<li class="ml-2 pl-5 pr-3">
                  						<a class="facebook customer share" href="http://www.facebook.com/sharer.php?u={{Request::url()}}" shareButton="facebook" >
                  							<i class="fa fa-facebook"></i>
                  						</a>
                  					</li>
                  					<li class="pl-5 pr-3">
                  						<a class="twitter customer share" href="http://twitter.com/share?text=share&url={{Request::url()}}&amp;text=Share talent &amp;hashtags=FutureStarr
                  						" target="_blank" >
                  						<i class="fa fa-twitter"></i>
                  					</a>
                  				</li>
                  				<li class="pl-5 pr-3">
                  					<a class="linkedin customer share" href="http://www.linkedin.com/shareArticle?mini=true&amp;url={{Request::url()}}" target="_blank" target="_blank">
                  						<i class="fa fa-linkedin"></i>
                  					</a>
                  				</li>
                  				
                  				<li style="display:none;" class="pl-3 pr-3">
                  					<a class="google customer share" href="https://plus.google.com/share?url={{Request::url()}}" target="_blank" >
                  						<i class="fa fa-google-plus"></i>
                  					</a>
                  				</li>
                  				<li style="display:none;" class="pl-3 pr-3">
                  					<a class="pinterest customer share" href="javascript:void((function()%7Bvar%20e=document.createElement('script');e.setAttribute('type','text/javascript');e.setAttribute('charset','UTF-8');e.setAttribute('src','http://assets.pinterest.com/js/pinmarklet.js?r='+Math.random()*99999999);document.body.appendChild(e)%7D)());">
                  						<i class="fa fa-pinterest"></i>
                  					</a>
                  				</li>
                  			</ul>
                  		</div>
                  	</div>
                  	<div class="border-all bgc">
                  		<div class="blog-details-comments" *ngIf="blogComment && blogComment.length>0">
                  			<div class="width-100 margin-lr-auto text-center margin-four-tb sm-margin-50px-tb xs-margin-30px-tb">
                  				<div class="position-relative overflow-hidden width-100">
                  					<span class="text-medium text-outside-line-full alt-font font-weight-600 text-uppercase text-extra-dark-gray">{{ count($blogData->getBlogComments) }}
                  					Comments</span>
                  				</div>
                  			</div>
                  			<ul class="blog-comment">

                  				@if(count($blogComments) > 0)
                  				@foreach($blogComments as $blogComment)
                  				<li>
                  					<div class="display-table width-100">
                  						<div class="display-table-cell width-100px xs-width-50px text-center vertical-align-top xs-display-block xs-margin-10px-bottom border-all">
                  							<a href="javascript::void(0)" target="_blank">
                  								@if(!empty($blogComment->getCommentUser['profile_pic'])  && file_exists($blogComment->getCommentUser['profile_pic']))
                  								<img class="rounded-circle width-85 xs-width-100" src="{{ asset($blogComment->getCommentUser->profile_pic) }}">
                  								@else 
                  								<img class="rounded-circle width-85 xs-width-100" src="{{ asset('assets/images/profile.png') }}">
                  								@endif
                  							</a>
                  						</div>
                  						<div class="border-all padding-20px-left display-table-cell vertical-align-top last-paragraph-no-margin xs-no-padding-left xs-display-block margin-30px-bottom">
                  							
                  							<a href="/users-profile/1" class="text-extra-dark-gray text-uppercase alt-font font-weight-600 text-small" target="_blank">
                  								{{ $blogComment->getCommentUser['first_name'] }} {{ $blogComment->getCommentUser['last_name'] }}
                  							</a>
                           <!-- <a href="#comments"
                           	class="inner-link btn-reply text-uppercase alt-font text-extra-dark-gray">Reply</a> -->
                           	<div class="text-small text-medium-gray text-uppercase margin-10px-bottom">{{ date('F d, Y' , strtotime($blogComment->created_at)) }}</div>
                           	<p>{{ $blogComment->message }}</p>
                           </div>
                       </div>
                   </li>
                   @endforeach
                   @else
                   <li>No Comment Found!!</li>
                   @endif
               </ul>
           </div>
           <div class="margin-lr-auto pl-2 pr-2 text-center margin-four-tb sm-margin-50px-tb xs-margin-30px-tb">
           	<div class="position-relative overflow-hidden width-100">
           		<span class="text-small text-outside-line-full alt-font font-weight-600 text-uppercase text-extra-dark-gray">Write
           		A Comment</span>
           	</div>
           </div>
           <form class="pl-3 pr-3 pb-4" action="{{ route('comment.blog')}}" method="POST">
           	@csrf
           	<div class="row">
           		<div class="col-md-12">
           			<textarea placeholder="Enter your comment here.." rows="8" class="medium-textarea form-control" name="message" required></textarea>
           			@error('name')
           			<span class="invalid-feedback" role="alert">
           				<strong>{{ $message }}</strong>
           			</span>
           			@enderror
           		</div>
           		<div class="col-md-12 text-center">
           			<input type="hidden" name="category_id" value="{{ Request::segment(3) }}">
           			<input type="hidden" name="blog_id" value="{{$blogData->id}}">
           			@if($check =='true')
           			<button class="btn btn-dark-gray btn-small margin-15px-top" type="submit">Send message</button>
           			@else
           			<button type="button" class="btn btn-dark-gray btn-small margin-15px-top" data-toggle="modal" data-target="#register_my_model">Send message</button>
           			@endif
           		</div>
           	</div>
           </form>
       </div>
   </div>
   
   
   
</div>

</aside>
</div>
</div>
</section>
<!-- end blog content section -->
<!-- ASK TO LOGIN -->
<div class="modal-ask-to-login fade" id="askToLogin" role="dialog">
	<div class="modal-dialog">
		<form>
			<!-- Modal content-->
			<div class="ask-to-login">
				<div class="modal-body">
					<div class="form-group text-spinner">
						<h3 class="deleteConfirmation">Please login to use this feature! </h3>
						<i class="fa fa-circle-o-notch fa-spin"></i>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
<!-- Ask to join as Seller -->
<div class="container">
	<!-- Modal -->
	<div id="register_my_model" class="modal  modal-m" role="dialog">
		<div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header mob-cls" style="padding:5px;">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body" style=" position: relative; padding-top: 0px; padding-left: 15px; padding-right: 15px;padding-bottom: 0px;">
					<div class="row">
						<div class="col-sm-5 text-center login-back" style="background-color:#fff;">
							<h4 style="color:#ff503f;font-weight: 600;margin: 54px 0 0 0;">
								Awe, looks like you have not 
							</h4>
							<h4 style="color:#ff503f;font-weight: 600;text-align: center;">signed up for Future Starr.</h4>
							<p style="margin: 34px 0 0 0; text-align: center;"><b>No worries, click the Register</b></p>
							<p style="text-align: center;"><b>button and sign up now for FREE!</b></p>
							<a routerLink="/register" class="btn btn-danger" style="margin-bottom: 30px;" (click)="model_toggle()">Register</a>
						</div>
						<div class="col-sm-7 text-center login-back-img" style="height: auto;background-image:url({{ asset('assets/images/new_pop_up.jpg')}});background-size:cover;background-position:left;">
							<button type="button" class="close desk-cls" data-dismiss="modal">&times;</button>
							<br><br><br><br><br><br>
							<p style="color:#fff;"></p>
							<h3 style="color:#fff;"></h3>
							<p style="color:#fff;"></p>
							<br><br>  <br><br><br><br><br>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<a class="scroll-top-arrow" href="javascript:void(0);"><i   class="ti-arrow-up"></i></a>

@endsection
@section('javascript')
<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js" type="text/javascript"></script>
<script type="text/javascript">   
	;(function($){
		
   /**
   * jQuery function to prevent default anchor event and take the href * and the title to make a share popup
   *
   * @param  {[object]} e           [Mouse event]
   * @param  {[integer]} intWidth   [Popup width defalut 500]
   * @param  {[integer]} intHeight  [Popup height defalut 400]
   * @param  {[boolean]} blnResize  [Is popup resizeabel default true]
   */
   $.fn.customerPopup = function (e, intWidth, intHeight, blnResize) {
   	
   // Prevent default anchor event
   e.preventDefault();
   
   // Set values for window
   intWidth = intWidth || '500';
   intHeight = intHeight || '400';
   strResize = (blnResize ? 'yes' : 'no');
   
   // Set title and open popup with focus on it
   var strTitle = ((typeof this.attr('title') !== 'undefined') ? this.attr('title') : 'Social Share'),
   strParam = 'width=' + intWidth + ',height=' + intHeight + ',resizable=' + strResize,            
   objWindow = window.open(this.attr('href'), strTitle, strParam).focus();
}

/* ================================================== */

$(document).ready(function ($) {
	$('.customer.share').on("click", function(e) {
		$(this).customerPopup(e);
	});
});

}(jQuery));
</script>
@stop

