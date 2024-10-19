<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
	@if(Request::is('social-buzz/*') || Request::is('talent-mall/*')|| Request::is('buyer/*') || Request::is('contact-us'))
	<meta name="robots" content="noindex" />
	@endif
	@if(Request::is('social-buzz/*'))
		@php
			$social_title = [
			1 => 'How to Promote book | Future Starr- Social Buzz',
			2 => 'Future Starr - Social Buzz | Entertainment Promotion',
			4 => 'Global Music Promotion | Future Starr',
			5 => 'Global Photography Promotion | Future Starr',
			6 => 'Comedy for sale - Online | Future Starr',
			7 => 'Premier Models- Available | Future Starr',
			8 => 'Fitness Your Way | Future Starr - Social Buzz',
			9 => 'National Geographic Hot Zone - Promotion | Future Starr',
			10 => 'Science Revolution- Social Update | Future Starr',
			11 => 'Future Starr- Social Buzz | Food open',
			12 => 'Promote and Sell - Nutrition | Future Starr',
			13 => 'Future Starr | Self-employed - Mathematics jobs',
			14 => 'Future Starr- Global cosmetics brands | Social Buzz',
			15 => 'American Fashion Designer - Social News | Future Starr',
			16 => 'Promote Your Tattoos ideas - Future Starr | Social Buzz'
		]
    @endphp
    <title>{{$social_title[$categorySelect]}}</title>
	@elseif(isset($metaTags['title'])) 
	<title>{{ isset($metaTags['title']) ? $metaTags['title'].' | Future Starr' : '' }}</title>
	@else 
	<title> @yield('title') </title>
	@endif
	<script type="application/ld+json">
		{
			"@context": "https://schema.org",
			"@type": "Future Starr | Self Promotion | Entertainment Careers",
			"url": "https://www.futurestarr.com",
			"name": "Future Starr",
			"contactPoint": {
			"@type": "ContactPoint",
			"telephone": "(800) 667-4919",
			"contactType": "Customer service"
		}
	}
</script>
<meta name="csrf-token" content="{{ csrf_token() }}">
@php $registerRoute = Route::currentRouteName() @endphp
@if($registerRoute =='register')
<meta name="title" content="Sign Up: Earn Income | Buy or Sell Talent From Home">
<meta name="description" content="Sign up today! Earn income from your home. Receive high commission pay deposited into your Stripe's merchant account from selling your Talent.">
<meta name="keywords" content="Register, sign up, earn income, how to make money on the side, make money collecting, hobbies that make money, commission pay,">
@elseif($registerRoute =='about-us')
<meta name="title" content="The Road to Success | Future Starr">
<meta name="description" content="To be successful: The road to success does not happen overnight! You must be passionate and ready to make sacrifices to achieve what you want.">
<meta name="keywords" content="road to success, secret of my success, standard for success, about us, about Future Starr, critical factor success, success of the new deal, success by health, symbol of success, key success factors, connections to success,">
@elseif($registerRoute =='term-conditions')
<meta name="title" content="Terms and Conditions | Future Starr">
<meta name="description" content="At Future Starr, we collect and manage user data according to the following Privacy Policy, with the goal of incorporating our company values: transparency, accessibility, sanity, usability.">
<meta name="keywords" content="Terms and conditions, terms and conditions at Future Starr, terms and conditions on website, terms and conditions definition, terms and conditions may apply summary,">
@elseif($registerRoute =='refund-policy')
<meta name="title" content="Refund Policy | Future Starr">
<meta name="description" content="Welcome to Future Starr's refund policy section. Our mission at FutureStarr is to ensure you are completely satisfied. Read more about our refund policy.">
<meta name="keywords" content="refund policy of Future Starr, refund policy at Future Starr, refund policy, customer service, satisfaction, quality service, happy customers. satisfied customers,">
@elseif($registerRoute =='privacy-policy')
<meta name="title" content="Privacy Policy | Future Starr">
<meta name="description" content="Here at Future Starr, your privacy is among our top priorities. This Privacy Policy explains how Future Starr collects, uses, stores, and discloses your personal information when you use our Website and all related products, properties, tools, and services provided by Future Starr.">
<meta name="keywords" content="privacy policy, privacy policy at Future Starr, Future Starr privacy policy, privacy policy update,">
@elseif($registerRoute == 'talent.index')
<meta name="title" content="Future Starr | Talent Mall | Star Shopping">
<meta name="description" content="Future Starr online Talent Mall was discovered in Atlanta! Browse and Purchase some of the hottest undiscovered talents across the globe.">
<meta name="keywords" content="biggest malls in america, largest malls in the world, largest malls in us, star shopping, where can I purchase, define purchase, underground rapper, atlanta underground mall, underground tattooing, hiphop undergound, undiscovered,">
@elseif(Request::is('social-buzz/*'))
@php
$social_desc = [
1 => "Book Authors: Unleash the full potential of drawing an audience of buyers who is ready to purchase on Future Starr's social buzz page.",
2 => "Are you in search of new entertainers asking them to entertain me? Future Starr's unique social buzz outlet help to connect with passionate entertainers.",
4 => "Global Music Promotion: To underground artist trying to get their music out. Future Starr social buzz page has a community of music riders ready.",
5 => "Future Starr has a place for photographers from across the globe who has a database full of professional photography for sale globally.",
6 => "Comedy for sale: Locate the best undiscovered comedy videos here on Future Starr. Use our social buzz to begin promoting and selling your comedy talent.",
7 => "Casting call for premier model entrepreneurs: Chocolate models, Asian models, hot bikini models, Japanese models, etc. Utilize Social Buzz to network.",
8 => "Fitness Gurus: Do Fitness your way. Establish a new realm of riders ready to ride with you and support your fitness achievements by joining Future Starr.",
9 => "Future Starr social buzz is the new hot zone for the national geographic society to promote and sell their knowledge and expertise. Start up a discussion about your national geographic photo of the day. ",
10 => "Science includes fair ideas for local schools and colleges. Future Starr social buzz page provides an outlet for science geniuses.",
11 => "Future Starr has an online community of buyers that's ready to support and purchase your food expertise. Start socializing on Future Starr today!",
12 => "Future Starr Social buzz page gives nutritionists a way to discuss and sell on topics on nutrition. Nutrition should be a habit in our daily lives.",
13 => "Mathematic jobs are the past, present, and future.The Social Buzz platform allows math teachers to become entrepreneurs by selling their math online.",
14 => "Global cosmetic interns and professionals: Create a new fan base stream through Future Starr social buzz page to promote or sell to cosmetics consumers.",
15 => "The next American fashion designer star may not get discovered on Facebook, Instagram, or YouTube. The next star will appear right on Future Starr.",
16 => "Tattoos and Tattoo's ideas are a true representation of a person's artistic side. Why not see if you can sell your tattoo ideas to our community?"
]
@endphp
@php
$social_keyword = [
1 => "how to promote book, promote myself published book, how to promote book on social media, promote book, sell books comparison site, site book, sell books online, advertise a book poster,",
2 => "entertainment promotion, entertainment marketing, are you not entertained, entertain me, entertain persuade inform, entertain an idea,",
4 => "now that's what I call music, rate your music, new music releases, music promotion, music riders,",
5 => "photography for sale, photography promotion, photography promotion ideas, props for photography for sale, photography ideas, best camera for professional photography,",
6 => "salesman comedy, comedy for sale, comedy zone, comedy videos, comedy catch, comedy open mic, comedy jokes, comedy unleashed,",
7 => "price is right models, chocolate models, asian models, Japanese models, blackmale models, micro bikini models, underwear models, hot bikini models, plus size lingerie models,",
8 => "fitness trainers near me, types of fitness trainers, fitness singles, fitness pal, fitness motivation, fitness your way, fitness evolution, fitness goals, ",
9 => "national geographic photographer,national geographic society, national geographic  your shot, national geographic  hot zone, national geographic  photo of the day,",
10 => "science revolution, science fair ideas, science experiments for kids, science jokes, science words, science variables, science fiction books,",
11 => "food high in protein,  food high in potassium,  food in spanish,  food open,  food high in magnesium,  food network shows,  food recipes,  food and wine",
12 => "mushroom nutrition, black beans  nutrition, brussel sprouts  nutrition, salmon  nutrition, green bean  nutrition, shrimp  nutrition, pinto beans  nutrition, oat milk  nutrition, ",
13 => "mathematics vision project,  mathematic range, mathematics clipart, mathematic quizzes, mathematics properties, mathematics jobs,",
14 => "cosmetic brands,  cosmetics market, it  cosmetics, mented  cosmetics, mac  cosmetics, profussion  cosmetics, fashion fair  cosmetics, jaclyn hill  cosmetics, give me glow  cosmetics, ",
15 => "college fashion designer, fashion designer course, fashion designer software, italian fashion designer, new york fashion designer,american fashion designer, fashion designer portfolios,",
16 => "Tattoos, Tattoos ideas, Tattoos roses, Tattoos for women, Tattoos for men, Tattoos sleeves, Tattoos on high,"
]
@endphp
<meta name="title" content="{{$social_title[$categorySelect]}}">
<meta name="description" content="{{$social_desc[$categorySelect]}}">
<meta name="keywords" content="{{$social_keyword[$categorySelect]}}">
@elseif($registerRoute == 'blog.detailed')
<meta name="title" content="{{ isset($tag_array['meta_tags']) ? $tag_array['meta_tags']: '' }}">
<meta name="description" content="{{ isset($tag_array['meta_keywords']) ? $tag_array['meta_keywords'] : '' }}">
<meta name="keywords" content="{{ isset($tag_array['meta_description']) ? $tag_array['meta_description'] : ''  }}">
@else 
<meta name="title" content="{{isset($metaTags['title'])?$metaTags['title']: '' }}">
<meta name="description" content="{{isset($metaTags['description'])?$metaTags['description']: '' }}">
<meta name="keywords" content="{{isset($metaTags['keywords'])?$metaTags['keywords']: '' }}">
@endif
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- CSRF Token -->
@php $homeRoute = Route::currentRouteName() @endphp
<meta name="google-site-verification" content="googlecf56ce18dcbc5c8c.html" />
<meta property="og:title" content="Future Starr | Self Promotion | Entertainment Careers"/>
<meta property="og:image" content="{{ isset($metaTags['og_image']) ? $metaTags['og_image'] : 'https://www.futurestarr.com/assets/images/futurestarrlogo.jpg' }}">
@if($registerRoute == 'register')
<meta property="og:description" content="{{isset($metaTags['description'])?$metaTags['description']: "Sign up today! Earn income from your home. Receive high commission pay deposited into your Stripe's merchant account from selling your Talent. "}}"/>
@else 
<meta property="og:description" content="{{isset($metaTags['description'])?$metaTags['description']: ''}}"/>
@endif
<meta property="og:url" content="{{ Request::url() }}"/>
<meta property="og:site_name" content="FutureStarr"/><meta property="og:site_name" content="FutureStarr"/>
<meta property="og:type" content="website"/>
<meta name="twitter:card" content="summary_large_image"/>
<meta name= "twitter:url" content="{{ Request::url() }}"/>
<meta name="twitter:site" content="@FutureStarrcom"/>
<meta name="twitter:creator" content="@FutureStarrcom"/>
<meta name="twitter:title" content="Future Starr | Self Promotion | Entertainment Careers"/>
<meta name="twitter:description" content="Future Starr promotes promising talent from around the world. Our platform helps you in becoming a famous celebrity. Only requirement is; just upload your talent videos on Future Starr and showcase your talent to the world. Sell your Talent Free - Make Sales and Be your Own Boss!"/>
<meta name="twitter:image" content="{{ isset($metaTags['og_image']) ? $metaTags['og_image'] : 'https://www.futurestarr.com/assets/images/futurestarrlogo.jpg' }}"/>
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<link rel="icon" type="image/x-icon" href="{{asset('favicon.ico')}}">
<link href="{{ asset('assets/css/et-line-icons.css') }}" rel="stylesheet">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css">
{{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css"> --}}
<link href="{{ asset('assets/prod/css/main.min.css') }}" rel="stylesheet">
{{-- <link href="{{ asset('style.css') }}" rel="stylesheet">
<link href="{{ asset('assets/css/animate.css') }}" rel="stylesheet">
<link href="{{ asset('assets/css/register.css') }}" rel="stylesheet">
<link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet">
<link href="{{ asset('assets/css/style.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/css/buyer-dashboard/style.css') }}" rel="stylesheet">
<link href="{{ asset('assets/css/cart/style.css') }}" rel="stylesheet"> --}}
<link href="https://fonts.googleapis.com/css?family=Overpass:100,100i,200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">
{{-- <link href="{{ asset('css/lightslider.css') }}" rel="stylesheet"> --}}
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->
<script src="{{ asset('assets/js/jquery.min.js') }}" type="text/javascript"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.0/js/bootstrap.min.js"></script>
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
{{-- <script src="https://www.google.com/recaptcha/api.js" async defer></script> --}}
{{-- <script src="{{ asset('assets/js/wow.min.js') }}" type="text/javascript"></script> --}}
{{-- <script type="text/javascript" src="https://js.stripe.com/v2/"></script> --}}
{{-- <script src="{{ asset('js/lightslider.js') }}" type="text/javascript"></script> --}}
<link rel="stylesheet" href="{{ asset('assets/admin/css/croppie.css')}}">
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script> --}}
<link rel='canonical' href="@php echo url()->current(); @endphp" />

{{-- <link href="{{asset('assets/lightbox.css')}}" rel="stylesheet" /> --}}

<script>
 var currentHost = window.location.host;
 var currentPathname = window.location.pathname;
 //console.log('https://'+currentHost+currentPathname);
 
 //console.log("<link rel='canonical' href='"+currentHost+""+currentPathname+"' />");
var url = 'https://'+currentHost+currentPathname;
console.log(url);

</script> 

<script>
	window.dataLayer = window.dataLayer || [];
	function gtag() {
		dataLayer.push(arguments);
	}
	gtag('js', new Date());
	gtag('config', 'UA-39143753-1');
	new WOW().init();
</script>

<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-KM8SJS');</script>
<!-- End Google Tag Manager -->

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-39143753-1"></script>
<script>
	window.dataLayer = window.dataLayer || [];
	function gtag(){dataLayer.push(arguments);}
	gtag('js', new Date());

	gtag('config', 'UA-39143753-1');
</script>
@yield('front_page_head')

<input type="hidden" id="current_user" value="{{ !empty(Auth::check() ) ? Auth::user()->id: '' }}" />
<input type="hidden" id="pusher_app_key" value="{{ Config::get('constants.pusher.app_key') }}" />
<input type="hidden" id="pusher_cluster" value="{{ Config::get('constants.pusher.cluster') }}" />
<style>
.unread-msg{
    background: #69d569db;
    padding: 3px;
    border-radius: 50%;
    color: #000000;
}
</style>
</head>
	@php $segment = Request::segment(1);
	$segment2 = Request::segment(2);

	if($segment == 'talent-mall' && $segment2 != ''){
		$secondclass = ' product_data_page';
	}
	else if($segment == 'blog' && $segment2 != ''){
		$secondclass = ' blog-detail-page';
	}
	else if($segment == 'star-search' && $segment2 != ''){
		$secondclass = ' star-search-detail-page';
	}
	else{
		$secondclass = '';
	}

if(!empty($segment)) { $bodyClass = Request::segment(1); } else { $bodyClass ='home'; }
@endphp
<body class="{{ $bodyClass }}{{ $secondclass }} {{ !empty(Auth::check() ) ? 'is_logged_in': '' }}">
	<body class="">
		<script>
			var base_url = '{{ url("/") }}';
		</script>
		<!-- Google Tag Manager (noscript) -->
		<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KM8SJS"
			height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
			<!-- End Google Tag Manager (noscript) -->
			<!-- <div id="load"></div> -->
			@include('layouts.talent.header')
			@yield('content')
			@include('layouts.talent.footer')
			@yield('javascript')
			<script>
				document.onreadystatechange = function () {
					var state = document.readyState
					if (state == 'complete') {
						setTimeout(function(){
							document.getElementById('interactive');
							//document.getElementById('load').style.visibility="hidden";
							$("#load").hide();
						},1000);
					}
				}
			</script>
			<script>
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
			</script>
			<script type="text/javascript">
				jQuery('#navbar-search').on('click', function(e) {
					e.preventDefault();
					jQuery(this).addClass('hide');
					jQuery('#navbar-searchbar').removeClass('hide');
				});
			</script>
			<script src="{{ asset('assets/js/custom.js') }}" type="text/javascript"></script>
			@yield('front_page_script')

			<script type="text/javascript">
				(function(w,d){
					w.HelpCrunch=function(){w.HelpCrunch.q.push(arguments)};w.HelpCrunch.q=[];
					function r(){var s=document.createElement('script');s.async=1;s.type='text/javascript';s.src='https://widget.helpcrunch.com/';(d.body||d.head).appendChild(s);}
					if(w.attachEvent){w.attachEvent('onload',r)}else{w.addEventListener('load',r,false)}
				})(window, document)
		</script>
		<script type="text/javascript">
			HelpCrunch('init', 'futurestarr', {
				applicationId: 1,
				applicationSecret: 'Ns0ynOloC5Af/kb8xI3/UkQQ3XHJACiejXZ8LorjMvcLvuPvyxErFgv2kTtzR3KunGaM+IB6exYVq3CK4r/K2w=='
			});
			HelpCrunch('showChatWidget');
		</script>
	</body>
	</html>
