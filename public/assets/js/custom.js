jQuery(document).ready(function() {
  jQuery(window).width() > 767 ? (jQuery(".navbar-inverse").css("background-color", "transparent"), jQuery(window).on("scroll", function() {
    jQuery(window).scrollTop() > 50 ? jQuery(".navbar-inverse").css("background-color", "rgb(21, 24, 41)") : jQuery(".navbar-inverse").css("background-color", "transparent")
  })) : jQuery(".navbar-inverse").css("background-color", "rgb(21, 24, 41)")
});

lightbox.option({
  'resizeDuration': 200,
  'wrapAround': true,
  'fitImagesInViewport':true,
  'minHeight': 700, 
  'minWidth': 700
})


// new WOW().init();