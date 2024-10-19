<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
     @if(isset($custom))
    <title>{{ $custom['title'] }}</title>
    @else
    <title>@yield('title')</title>
    @endif
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="title" content="{{isset($metaTags['title'])?$metaTags['title']: '' }}">
    <meta name="description" content="{{isset($metaTags['description'])?$metaTags['description']: '' }}">
    <meta name="keywords" content="{{isset($metaTags['keywords'])?$metaTags['keywords']: '' }}">
   
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
    <!-- Scripts -->
    <!-- <script src="{{ asset('js/app.js') }}"></script> -->
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="{{asset('favicon.ico')}}">
    <!-- Latest compiled and minified CSS -->
    <!-- Latest compiled and minified CSS -->
    <link href="{{ asset('assets/css/font.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css">
    <link href="{{ asset('assets/css/et-line-icons.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link href="{{ asset('style.css') }}" rel="stylesheet">
   <link href="{{ asset('assets/css/style.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/register.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/profile.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/buyer-dashboard/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/croppie.css')}}">
    <link href="{{ asset('css/lightslider.css') }}" rel="stylesheet">
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->
    <script src="{{ asset('assets/js/jquery.min.js') }}" type="text/javascript"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.0/js/bootstrap.min.js"></script>
    <script src="{{ asset('assets/js/wow.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/bs.modal.pop.js') }}" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="{{ asset('js/lightslider.js') }}" type="text/javascript"></script>
   
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', 'UA-39143753-1');
        new WOW().init();
    </script>
	
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-39143753-1"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'UA-39143753-1');
	</script>

    <input type="hidden" id="current_user" value="{{ !empty(Auth::check() ) ? Auth::user()->id: '' }}" />
    <input type="hidden" id="pusher_app_key" value="{{ Config::get('constants.pusher.app_key') }}" />
    <input type="hidden" id="pusher_cluster" value="{{ Config::get('constants.pusher.cluster') }}" />
   <script>
            var base_url = '{{ url("/") }}';
        </script>
</head>
@php $segment = Request::segment(1);
 if(!empty($segment)) { $bodyClass = Request::segment(1); } else { $bodyClass ='home'; }
@endphp
<body class="{{ $bodyClass }}">
     <!-- <div id="load"></div> -->
    @include('layouts.talent.header')
    @yield('content')
    @include('layouts.talent.footer')
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
    @yield('javascript')
    <script src="{{ asset('assets/js/custom.js') }}" type="text/javascript"></script>


</body>
</html>
