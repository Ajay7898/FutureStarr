<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') </title>
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
    <script src="{{ asset('js/app.js') }}"></script>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="{{asset('favicon.ico')}}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link href="{{ asset('style.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/register.css') }}" rel="stylesheet"><!-- <script src="{{ asset('assets/js/jquery.min.js') }}" crossorigin="anonymous"></script> -->
    <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet">
    <!--<link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">-->

<!--     <link href="{{ asset('assets/css/socialbuzz/style.css') }}" rel="stylesheet">
 -->    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->
    <script src="{{ asset('assets/js/jquery.min.js') }}" type="text/javascript"></script>
    <!-- <script src="{{ asset('assets/js/video.min.js') }}"></script> -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.0/js/bootstrap.min.js"></script>
    <script src="{{ asset('assets/js/wow.min.js') }}" type="text/javascript"></script>
   <script src="{{ asset('assets/js/bs.modal.pop.js') }}" type="text/javascript"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <!-- <div id="load"></div> -->

    
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-39143753-1"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'UA-39143753-1');
	</script>
</head>
@php $segment = Request::segment(1);
 if(!empty($segment)) { $bodyClass = Request::segment(1); } else { $bodyClass ='home'; }
@endphp
<body class="{{ $bodyClass }}">
<body>
		    @yield('content')
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
    <script src="{{ asset('assets/js/custom.js') }}" type="text/javascript"></script>
</body>
</html>
