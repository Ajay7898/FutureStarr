@extends('layouts.talent') @section('content')
<!-- banner start -->
<section class="wow fadeIn cover-background background-position-top top-space talent-mall" style="background-image:url({{ asset('assets/images/talent-mall-new.jpg')}});">
  <div class="opacity-medium bg-extra-dark-gray"></div>
  <div class="container">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12 display-table page-title-large">
        <div class="display-table-cell vertical-align-middle text-center padding-30px-tb">
          <!-- start page title -->
          <h1 class="alt-font text-white font-weight-600 mb-2">Talent Mall</h1>
          <!-- end page title -->
          <!-- start sub title -->
          <span class="display-block text-white opacity6 alt-font">
          Browse and Purchase Talents</span>
          <!-- end sub title -->
        </div>
      </div>
    </div>
  </div>
</section>
<!-- End banner  -->
<!-- Start Content  -->


<section class="wow fadeIn pt-5"> 
  <!-- start filter content -->
  <div class="container">
    <div class="row">
	
	   <div class="col-md-4 xs-padding-15px-lr">
      
          <div id="section">
		  <div class="article">
			<h2> Welcome To FutureStarr Browse And Buy Talents Across The Globe </h2>
			<p>Are you looking to purchase and support undiscovered entrepreneurs with amazing talent? Wouldn't it be awesome to see a display of talented people you can browse, shop online, and store it in your personal account to have immediate access to? Future Starr - Talent Mall is one of its kind and unique online marketplaces that give buyers a gateway to identify their favorite <strong>model photos</strong> ,  <strong>music songs</strong> ,  <strong>educational courses</strong> ,  <strong>fitness tips</strong> , and more. All you need to do is simply select which category best fits your interests and browse through a list of authentic talent that's seeking support to help grow their career. You as a buyer will be shopping for talented artists, teachers, fitness trainers, cooks, etc. looking to manage their social media networks and followers to make money online turning their hard work into viral dollars. 
			</p>
			<p class="moretext">
			  Through our platform, you can shop for the best talent on the internet or make money through promotion. <a href="{{ route('register') }}" title="register"> Sign up </a> with <a href='/' title='futurestarr'> Future Starr </a> and start your online shopping today or boost up your reputation among your followers. Future Starr's goal is to make sure we provide the best local talent across the globe. Our large and well-built industry network will also help people grow in their business ventures. Joining hands with <a href='/' title='futurestarr'> Future Starr </a> is the perfect matchmaker with buyers and talent owners making both stars in the market. Once you've uploaded your profile on the portal, you can alter and refresh it whenever you need it and start shopping. You can approach top talented owners and get associated with their significant audience everywhere throughout the globe. 
			</p>
		  </div>
		  <a class="moreless-button" href="javascript: void(0)">Read more</a>
		</div>
    
      </div>
	
	
	
      <div class="col-md-8 no-padding xs-padding-15px-lr">
        <div class="filter-content overflow-hidden talent-mall">
          <ul class="portfolio-grid portfolio-metro-grid work-2col hover-option5 gutter-large talent-mall-grid">
            <li class="grid-sizer" ></li>
            <!-- start portfolio item -->
		
            @foreach($catagories as $catagory)
            <li class="grid-item web advertising wow zoomIn tallent-mall " >
              <a href="{{ route('talent.show',$catagory->slug)}}">
                <figure>
                  <div class="portfolio-img talent-mall-port">
                    <img  title="catagory of futurestarr" src="{{ asset( $catagory->catagory_image_path)}}" alt="{{$catagory->category_alt}}" />
					  
                    <!-- <img   title="" src="{{asset('assets/images/talent-mall/no_image-200x200.jpg')}}" /> -->
                  </div>
                  <figcaption>
                    <div class="portfolio-hover-main text-center" > 
                      <div class="portfolio-hover-box vertical-align-middle">
                        <div class="portfolio-hover-content position-relative last-paragraph-no-margin">
                          <div class="bg-deep-pink center-col separator-line-horrizontal-medium-light2 position-relative"></div>
                          <span class="font-weight-600 letter-spacing-1 alt-font text-white text-uppercase margin-5px-bottom display-block">{{$catagory->name}}</span>
                        </div>
                      </div>
                    </div>
                  </figcaption>
                </figure>
              </a>
			  
             <div id="author-section">
          		  <div class="author-article">
          			<p></p>
          			<p class="author-moretext" id="des-{{$catagory->id}}">
          			  {!! $catagory->category_read !!}
          			</p>
          		  </div>
          		  <a class="authors-moreless-button"  href="javascript: void(0)" onclick='desopen("des-{{$catagory->id}}")'>More Info</a>
    		    </div>
			 
            </li>
            @endforeach
            <!-- End portfolio item -->
          </ul>
        </div>
      </div>
    </div>
  </div>
  <!-- end filter content -->
</section>
<!-- End content -->
<a class="scroll-top-arrow" href="javascript:void(0);" style="display: inline;"><i  class="ti-arrow-up"></i></a>

<script>
$('.moreless-button').click(function() {
  $('.moretext').slideToggle();
  if ($('.moreless-button').text() == "Read more") {
    $(this).text("Read less")
  } else {
    $(this).text("Read more")
  }
});


$('.author-moreless-button').click(function() {
  $('.author-moretext').slideToggle();
  if ($('.author-moreless-button').text() == "Read more") {
    $(this).text("Read less")
  } else {
    $(this).text("Read more")
  }
});

function desopen(id){ 
 $('#'+id).slideToggle();
}
</script>

@endsection