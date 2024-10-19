@extends('layouts.talent') @section('content')
<!-- banner start -->
<section class="wow fadeIn blog-sec cover-background background-position-top top-space" style="background-image:url({{ asset('assets/images/blog-list-banner.jpg')}});">
	<div class="opacity-medium bg-extra-dark-gray" style="opacity: 0.1;"></div>
	<div class="container">
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12 display-table page-title-large">
				<div class="display-table-cell vertical-align-middle text-center padding-30px-tb">
					<!-- start page title --
					<h1 class="alt-font text-white font-weight-600 mb-2">FutureStarr</h1>
					<!-- end page title -->
					<!-- start sub title --
					<span class="display-block text-white opacity6 alt-font">
					Blog Update</span>
					<!-- end sub title -->
				</div>
			</div>
		</div>
	</div>
</section>
<!-- End banner  -->
<!-- Start Content  --> 

<section>

	<div class="container">


		<div class="row">
			<main class="col-md-12 blog-sectionss" style="margin-bottom: -40px;">
				<div class="col-md-8 col-sm-8 col-xs-12 blog-post-content blog-first-sec margin-10px-bottom xs-margin-10px-bottom xs-text-center">

					<h1   class="text-extra-dark-gray text-uppercase alt-font text-large font-weight-600 margin-15px-bottom display-block"> Latest Blogs </h1>		

				</div>

				<div class="col-md-4 col-sm-4 col-xs-12 blog-post-content blog-first-sec margin-10px-bottom xs-margin-10px-bottom xs-text-center">

					<li class="dropdown ddho mb-4">
						<a href="#" class="dropdown-toggle text-extra-dark-gray text-uppercase alt-font font-weight-600 margin-15px-bottom " data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> Categories  </a>
						<ul class="dropdown-menu dropdown-menu1">



							@if(count($talentCategories) > 0)
							@foreach($talentCategories as $category)

							@if($category->slug == Request::segment(2))
							@php $activeClass = 'selected' @endphp
							@elseif(Request::segment(2) == '')
							@if($category->slug =='author')
							@php $activeClass = 'selected' @endphp
							@else
							@php $activeClass = '' @endphp
							@endif
							@else 
							@php $activeClass = '' @endphp
							@endif
							<li><a href="{{ route('blog.index', $category->slug) }}" class="{{  $activeClass }}">{{ $category->name }}</a></li>

							@endforeach
							@else
							<li>No Categories Found!!</li>
							@endif


						</ul>
					</li>

				</div> 

				<!-- start post item -->
				@if(!empty($latestBlog))

				<div class="col-md-12 border-all col-sm-12 col-xs-12 blog-post-content blog-first-sec margin-60px-bottom xs-margin-30px-bottom xs-text-center blog-category">

					<div class="blog-image pt-4">  
						<a href="{{ route('blog.detailed', [$latestBlog['getBlogCatagories']['slug'] ,$latestBlog['slug'] ]) }}" >

							@if(!empty($latestBlog['blog_img'])) 

							<img src="{{ asset($latestBlog['blog_img'])}}" style="width: 100%;
							height: 400px;
							object-fit: cover;" alt="Blog Banner"/>
							@else 
							<img src="{{ asset('assets/images/defaultblog.png')}}" alt="Blog Banner"/>
							@endif
						</a>

					</div>
					<br/>
  <!--       <div class="blog-image">  
          <a href="">                               
           <iframe width="400px" height="400px"  class="embed-responsive-item width-100" src="https://www.youtube.com/embed/zpOULjyy-n8?rel=0" allowfullscreen></iframe>                              
         </a>

     </div> -->


     <div class="col-md-12 col-sm-12 col-xs-12 blog-post-content blog-first-sec xs-text-center pb-4">

     	<div class="blog-text display-inline-block width-10">
     		<div class="content">
             
     			<img class="au-img-au-t"  src="{{asset(str_replace(' ', '%20', $latestBlog['author_image']))}}"  alt="Author Profile Image" />   

				
     			<!-- <img class="au-img-au-t"  src="{{ asset('assets/images/star.png')}}" style="background-image: url({{asset(str_replace(' ', '%20', $latestBlog['author_image']))}});" alt="Author Profile Image" />-->
             
     		</div>

     	</div>

     	<div class="blog-text blog-text-content float-right">

     		<div class="content pt-4">
					
     			<div class="text-medium-gray text-extra-small margin-5px-bottom text-uppercase alt-font">
     				<img class="au-img-au-shape"  src="{{ asset('assets/images/Shape 1.png')}}" alt="Author Profile Image" />
					<span><h3 style="color: #000 !important;" class="pb-2"> {{ $latestBlog['title'] }} </h3></span>
     				<span>Posted on {{date('F d, Y', strtotime($latestBlog['date']))}} </span>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
     				<span><a href="javascript:void(0);" class="text-medium-gray"> {{ $latestBlog['author_first_name'] }} </a> <a href="javascript:void(0);" class="text-medium-gray"> {{ $latestBlog['author_last_name'] }} </a>  </span>
     			</div>

     			<p class="no-margin padd-0">
     				{!! Str::limit(strip_tags($latestBlog['content']), 485) !!}   
     			</p>
 
     		</div>
     		<a style="" class="mb-4 margin-15px-top btn btn-very-small btn-dark-gray text-uppercase" href="{{ route('blog.detailed',[ $latestBlog['getBlogCatagories']['slug'], $latestBlog['slug'] ]) }}">Read More</a>
     	</div>

     </div>
 </div>

 @else
 <div class="no-blogs col-md-12 col-sm-12 col-xs-12 blog-post-content margin-60px-bottom xs-margin-30px-bottom xs-text-center">
 	<h5 class="text-uppercase alt-font text-extra-dark-gray margin-20px-bottom font-weight-700 sm-width-100 xs-width-100">
 		Sorry, no blogs available for this category!
 	</h5>
 </div>
 @endif
 <!-- end post item --> 
</main>



<!--- for article 3 rows -->

<main class="col-md-12 blog-sectionss">

	<div class="demo">
		<ul id="lightSlider1">
			@if(count($blogs) > 0)
			@foreach($blogs as $key => $blog)
			<li>
				<div class="col-md-12 col-sm-12 blog-rela" style="padding:0px;">
					<div class="card mb-2">
						<img style="width: 100%;
						height: 300px;
						object-fit: cover;" class="p-4" src="{{asset( !empty($blog->blog_img) && file_exists($blog->blog_img) ? asset($blog->blog_img) :'assets/images/default-ad-banner.png')}}" alt="Blog Image"/>

						<div class="card-body">
							<h4 class="card-title">{{ $blog->title ?: '' }}</h4>
							<p class="card-text">{!! Str::limit(strip_tags($blog->content), 105) !!}</p>
							<a href="{{ route('blog.detailed', [ $blog->getBlogCatagories['slug'], $blog->slug] ) }}" class="btn btn-primary">Read More</a>
						</div>  

						<div class="border-top padd-15">
							<div class="dt-au-lestar star-author text-medium-gray text-extra-small text-uppercase alt-font">
                              
							  	<img class="au-img-au" src="{{ asset( !empty($blog->author_image) && file_exists($blog->author_image) ? str_replace(' ', '%20', $blog->author_image):'assets/images/aside-image-4.jpg')}}"  alt="Author Profile Image">	
								<!--<img class="au-img-au" src="{{ asset('assets/images/star.png')}}" style="background-image: url({{ asset( !empty($blog->author_image) && file_exists($blog->author_image) ? str_replace(' ', '%20', $blog->author_image):'assets/images/aside-image-4.jpg')}});" alt="Author Profile Image">-->
                              
							</div>

							<div class="dt-au-le txt-sm-f pt-5  text-left text-medium-gray text-extra-small text-uppercase alt-font">
								{{ \Carbon\Carbon::parse($blog->date)->format('F d, Y')}} &nbsp &nbsp  | &nbsp &nbsp <a href="javascript:void(0);" class="text-medium-gray margin-15px-top"> {{ $blog->author_first_name ?: '' }}  </a>  <a href="javascript:void(0);" class="text-medium-gray margin-15px-top"> {{ $blog->author_last_name ?: ''  }} </a> 

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

		<div class="row">

			<div class="col-xs-12 pt-5">


				<div class="border-top border-light pt-4 mb-4">

					<div class="text-center">
						<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal-subscibed"><i class="fa fa-envelope-o" aria-hidden="true"></i>&nbsp Subscribe</button>
					</div>

				</div>

			</div>

		</div>
	</div>

	<style>
	.dt-au-lestar{
			margin-left:-20px;
		}
	</style>

	<script>
		$('#lightSlider1').lightSlider({
			item: 2,
			loop:true,
			slideMargin: 15,
			useCSS:true,
			pager: true,
			responsive : [
			{
				breakpoint:767,
				settings: {
					item:1,
					slideMove:1
				}
			}
			],

		});
	</script>

	<!-- Modal -->
	<div id="myModal-subscibed" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Subscribe to new trendy updates</h5>        
				</div>
				<div class="modal-body">
					<span class="text-danger" id="validation_error"></span>
					<form class="pt-4">

						<div class="form-group">
							<label for="exampleInputPassword1">First Name</label>
							<input type="text" class="form-control" id="subscribe-first-name" placeholder="First Name" name="first_name" value="{{ !empty(Auth::user()->first_name) ? Auth::user()->first_name : '' }}" required>
							
						</div>

						<div class="form-group">
							<label for="exampleInputPassword1">Last Name</label>
							<input type="text" class="form-control" id="subscribe-last-name" placeholder="Last Name" name="last_name" value="{{ !empty(Auth::user()->last_name) ? Auth::user()->last_name : '' }}" required>
							
						</div>

						<div class="form-group">
							<label for="exampleInputEmail1">Email address</label>
							<input type="email" class="form-control" id="subscribe-email" aria-describedby="emailHelp" name="email" value="{{ !empty(Auth::user()->email) ? Auth::user()->email : '' }}" placeholder="Enter email" required>
							
						</div>

						<small id="emailHelp" class="form-text text-muted">We may communicate with you about the information you’ve requested and other FutureStarr services. The use of your information is governed by FutureStarr privacy policy.</small>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="button" id="subscribe" class="btn btn-primary" >Save</button>

				</div>
			</div>
		</div>

	</div>

	

</div>



<!-- end post item --> 
</main>

</div>
</div>
</section>
<!-- End content -->
<!-- Button trigger modal -->




<a class="scroll-top-arrow" href="javascript:void(0);" style="display: inline;"><i  class="ti-arrow-up"></i></a>

<!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script> -->

<script type="text/javascript">
	$(document).ready(function() {
         $("#subscribe").click(function(e){
             e.preventDefault(); 
             $("#validation_error").text('');
             $("#subscribe").prop('disabled',true);
		     var url  = '{!! route('blog.subscribe.store') !!}';
		     var first_name = $("#subscribe-first-name").val();
		     var last_name = $("#subscribe-last-name").val();
		     var email = $("#subscribe-email").val();

		     $.ajax({
		     	 type: 'POST',
                 url: url,
	             data: {
	                  "_token": "{{ csrf_token() }}",
	                  "first_name":first_name,
	                  "last_name":last_name,
	                  "email":email
	            },
	            success:function(response) {
	               $("#subscribe").prop('disabled',false);
                   if(response.success) {
	                  
	                   toastr.success(response.success);
	               }
	               if(response.error) {
	               	    $("#subscribe").prop('disabled',false);
	                    toastr.error(response.error);
	                    if(response.status) {
	                    	$("#validation_error").text(response.error);
	                    }
	                }
	               if(response.info) {
	               	   
	                    toastr.info(response.info);
	                }
		        },
		        complete:function(data){
		        	 $("#subscribe").prop('disabled',false);
                     $("#loader").hide();

                },
	
		     });

        });
	});
</script>
@endsection