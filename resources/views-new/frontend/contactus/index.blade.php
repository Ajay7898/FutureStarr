@extends('layouts.talent') @section('content')
<!-- banner start -->
<section class="wow fadeIn contact-sec-n cover-background background-position-top" style="background-image:url({{ asset('assets/images/homepage-5-slider-img-2.jpg')}});">
  <div class="opacity-medium bg-extra-dark-gray"></div>
  <div class="container">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12 display-table page-title-large">
        <div class="display-table-cell vertical-align-middle text-center padding-30px-tb">
          <!-- start page title -->
          <h1 class="alt-font text-white font-weight-600 mb-2">Contact Us</h1>
          <!-- end page title -->
        </div>
      </div>
    </div>
  </div>
</section>
<!-- End banner  -->
<!-- start contact section -->
@php $site_config = site_config() @endphp
<section class="no-padding bg-extra-dark-gray search-content-sec">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-8 col-lg-6 col p-0 cover-background wow fadeInLeft" style="background-image:url({{ asset('assets/images/contact-img2.jpg')}});"></div>
      <div class="col-md-4 col-lg-6 col p-0 wow fadeInRight text-center">
        <div class="row no-gutters">
          <!-- start contact item -->
          <div class="col-lg-6 bg-extra-dark-gray p-5 p-md-4 p-lg-5">
            <i class="icon-map text-deep-pink icon-medium margin-25px-bottom"></i>
            <div class="text-white text-uppercase alt-font font-weight-600 margin-5px-bottom">Contact Address</div>
            <p class="text-medium mb-0">{!!  strip_tags($site_config->address) !!}</p>
          </div>
          <!-- end contact item -->
          <!-- start contact item -->
          <div class="col-lg-6 bg-black p-5 p-md-4 p-lg-5">
            <i class="icon-chat text-deep-pink icon-medium margin-25px-bottom"></i>
            <div class="text-white text-uppercase alt-font font-weight-600 margin-5px-bottom">Let's Talk</div>
            <p class="text-medium m-0">Phone: <a href="tel:{{ $site_config->contact_number }}">{{ $site_config->contact_number }}</a></p>
          </div>
          <!-- end contact item -->
          <!-- start contact item -->
          <div class="col-lg-6 bg-black p-5 p-md-4 p-lg-5">
            <i class="icon-envelope text-deep-pink icon-medium margin-25px-bottom"></i>
            <div class="text-white text-uppercase alt-font font-weight-600 margin-5px-bottom">Email Us</div>
            <p class="text-medium mb-0"><a href="mailto:{{ $site_config->email }}">{{ $site_config->email }}</a></p>
          </div>
          <!-- end contact item -->
          <!-- start contact item -->
          <div class="col-lg-6 bg-extra-dark-gray p-5 p-md-4 p-lg-5">
            <i class="icon-clock text-deep-pink icon-medium margin-25px-bottom"></i>
            <div class="text-white text-uppercase alt-font font-weight-600 margin-5px-bottom">Working Hours</div>
            <p class="text-medium m-0">{{ $site_config->work_hours_weekdays }}</p>
            <p class="text-medium mb-0">{{ $site_config->work_hours_weekends }}</p>
          </div>
          <!-- end contact item -->
        </div>
      </div>
    </div>
  </div>
</section>
<!-- end contact section -->

<!-- start form section -->
<section class="wow fadeIn" id="start-your-project">
  <div class="container">
      <div class="row justify-content-center">
          <div class="col-md-10 col-lg-8 text-center mb-4">
              <h5 class="alt-font font-weight-700 text-extra-dark-gray text-uppercase">tell us about your project</h5>
              <p>Our friendly team can be reached Monday through Friday, from 9 am to 6 pm, Eastern time, Just fill out the contact form and click the button 
below to contact us.</p>
          </div>  
      </div>
      <form id="project-contact-form" method="POST" action="{{route('contact-us.store')}}">
        @csrf
          <div class="row">
               <div class="col-md-12">
                  <div id="success-project-contact-form" class="no-margin-lr"></div>
              </div>
              <div class="col-md-4">
                  <input type="text" name="name" id="name" required pattern="[a-zA-Z ]*" placeholder="Name *" class="big-input @error('name') is-invalid @enderror">
                   @error('name')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                    @enderror
              </div>
              <div class="col-md-4">
                  <input type="text" name="phone" id="phone" placeholder="Phone *" pattern="^[0-9]*$" class="big-input @error('phone') is-invalid @enderror" required>
                   @error('phone')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                   @enderror 

              </div>
              <div class="col-md-4">
                  <input type="text" name="email" id="email" required pattern="([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA])+$" placeholder="E-mail *" class="big-input @error('email') is-invalid @enderror">
                   @error('email')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                    @enderror
              </div>
              <div class="col-md-12">
                  <textarea name="message" id="message" placeholder="Describe your project *" rows="6" class="big-textarea @error('message') is-invalid @enderror" required></textarea>
                   @error('message')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
              </div>
               <div class="g-recaptcha" data-sitekey="6Lf4BwUTAAAAAFJibAut9uEkKIMp5jnc5K8838YV"></div>
                    @error('g-recaptcha-response')
                      <span class="invalid-feedback" role="alert">
                        <strong>Please check on the reCAPTCHA box.</strong>
                      </span>
                    @enderror
              <div class="col-md-12 text-center">
                  <button id="project-contact-us-button" type="submit" class="btn btn-transparent-dark-gray btn-large margin-20px-top">send message</button>
              </div>
          </div>
      </form><br/><br/><br/><br/>
	  <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3313.3470391704755!2d-84.38720248479015!3d33.85494608065997!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x378a4386f69fb469!2sFuture%20Starr%20%7C%20Talent%20Marketplace!5e0!3m2!1sen!2sus!4v1579147842176!5m2!1sen!2sus" width="100%" height="400" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
  </div>
</section>

<!-- end form section -->
<section class="wow fadeIn bg-light-gray">
  <div class="container">
      <div class="row">
          <div class="col-md-12 text-center social-style-4">
              <span class="text-medium font-weight-600 text-uppercase display-block alt-font text-extra-dark-gray margin-30px-bottom">On social networks</span>
              <div class="social-icon-style-4">
                  <ul class="margin-30px-top large-icon">
                      <li><a class="facebook" href="https://www.facebook.com/FutureStarrcom/" target="_blank"><i class="fa fa-facebook"></i><span></span></a></li>
                      <li><a class="twitter" href="https://twitter.com/futurestarrcom?lang=en/" target="_blank"><i class="fa fa-twitter"></i><span></span></a></li>
                      <li><a class="google" href="javascript:void(0);"><i class="fa fa-google"></i><span></span></a></li>
                      <li><a class="dribbble" href="javascript:void(0);"><i class="fa fa-dribbble"></i><span></span></a></li>
                      <li><a class="linkedin" href="https://www.linkedin.com/in/futurestarr/" target="_blank"><i class="fa fa-linkedin "></i><span></span></a></li>
                  </ul>
              </div>
          </div>
      </div>
  </div>
</section>  
<a class="scroll-top-arrow" href="javascript:void(0);" style="display: inline;"><i  class="ti-arrow-up"></i></a>
@endsection
@section('javascript')
<script type="text/javascript">
  $('input[name="phone"]').keyup(function(e) {
  if (/\D/g.test(this.value)) {
    // Filter non-digits from input value.
    this.value = this.value.replace(/\D/g, '');
    toastr.error('','Only digit values are allowed in phone field.');
  }
});
</script>
@stop