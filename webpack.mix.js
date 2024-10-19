const mix = require('laravel-mix');
require('laravel-mix-purgecss');

mix.js([
		'resources/js/app.js',
	],
	'public/assets/prod/js/vendor.min.js');


mix.js([
		// 'public/js/lightslider.js',		
		// 'public/assets/lightbox.js',
		// 'public/assets/js/toastr.min.js',
		// 'public/assets/js/sweetalert2@9',
		// 'public/assets/js/wow.min.js',				
		'public/assets/js/pusher.min.js',
		'public/assets/js/chat.js',
		'public/assets/js/custom.js',
		// 'public/assets/js/more_scripts.js',
		
	],
	'public/assets/prod/js/main.min.js');


// mix.styles([
// 		// 'public/assets/css/bootstrap/bootstrap.min.css',
// 		// 'public/assets/prod/cssmove/style.min.css',	
// 		// 'public/style.css',
// 		'public/assets/css/custom.css',
// 		'public/assets/css/cart/style.css',
// 		'public/css/lightslider.css',
// 		'public/assets/admin/css/croppie.css',
// 		'public/assets/lightbox.css',
// 		'public/assets/css/owl.carousel.min.css',
// 		'public/assets/css/toaster.css',
// 		'public/assets/css/register.css',
// 		'public/assets/css/buyer-dashboard/style.css',
// 	],
// 	'public/assets/prod/cssmove/extra.min.css');

// @import "~bootstrap/scss/bootstrap";

// mix.postCss('public/assets/prod/cssmove/extra.min.css', 
// 	'public/assets/prod/cssmove/style2.min.css')
//    .purgeCss();

mix.postCss('public/style.css', 
	'public/assets/prod/cssmove/style.min.css')
   .purgeCss();

mix.styles([
		'public/assets/css/bootstrap/bootstrap.min.css',
		'public/assets/prod/cssmove/style.min.css',	
		'public/assets/css/custom.css',
		'public/assets/css/cart/style.css',
		'public/css/lightslider.css',
		'public/assets/admin/css/croppie.css',
		'public/assets/lightbox.css',
		'public/assets/css/owl.carousel.min.css',
		'public/assets/css/toaster.css',
		'public/assets/css/register.css',
		'public/assets/css/animate.css',
		// 'public/assets/prod/cssmove/style2.min.css',
		'public/assets/css/style.css',
		// 'public/assets/css/style.min.css',
		'public/assets/css/buyer-dashboard/style.css',
	],
	'public/assets/prod/css/main.min.css');
