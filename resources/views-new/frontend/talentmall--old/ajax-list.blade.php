  @if(count($talents) > 0)
  @foreach($talents as $talent)
  <li class="design web photography grid-item wow fadeInUp last-paragraph-no-margin">
   <figure>
      @if(!empty($talent->sampleMedia[0]->path_name))
      @php $video = explode(".",$talent->sampleMedia[0]->path_name) @endphp
      @if(strtolower(end($video)) =="mp4" || strtolower(end($video)) =="ogv")
      <video id="my-player" poster="{{asset('assets/images/talent-mall/audio-bg.png')}}"  controls>
         <source src="{{asset($talent->sampleMedia[0]->path_name)}}" type="video/mp4">
            <source src="{{asset($talent->sampleMedia[0]->path_name)}}" type="video/oggy">
               Your browser does not support
               HTML5 video.
            </video>
            @endif
            @if(strtolower(end($video)) =="mkv")
            <video id="my-player" poster="{{asset('assets/images/talent-mall/audio-bg.png')}}"  controls>
               <source src="{{asset($talent->sampleMedia[0]->path_name)}}" type="video/x-matroska">
                  <source src="{{asset($talent->sampleMedia[0]->path_name)}}" type="video/x-matroska">
                     Your browser does not support
                     HTML5 video.
                  </video>
                  @endif
                  @if(strtolower(end($video)) =="mp3" || strtolower(end($video)) =="mpeg")
                  <video poster="{{asset('assets/images/talent-mall/audio-bg.png')}}"  controls>
                     <source src="{{asset($talent->sampleMedia[0]->path_name)}}" type="video/mp3">
                        <source src="{{asset($talent->sampleMedia[0]->path_name)}}" type="video/ogg">
                           Your browser does not support
                           HTML5 mp3.
                        </video>
                        @endif
                        @if(strtolower(end($video)) =="png" || strtolower(end($video)) =="jpg" || strtolower(end($video)) =="jpeg")
                        @if(file_exists($talent->sampleMedia[0]->path_name))
                        @php $image = $talent->sampleMedia[0]->path_name @endphp
                        @else
                        @php  $image = 'assets/images/star-logo.png'; @endphp
                        @endif
                        <a href="javascript:void(0);"  class="cursor">
                           <img alt="productInfo" src="{{ asset($image)}}"/>
                        </a>
                        @endif
                        @elseif(!empty($talent->commercialMedia[0]->image_path))
                        @php
                        $allowedMimeTypes = ['image/jpeg','image/gif','image/png','image/bmp','image/svg+xml'];
                        $contentType = mime_content_type($talent->commercialMedia[0]->image_path);
                        if(in_array($contentType, $allowedMimeTypes) && file_exists($talent->commercialMedia[0]->image_path)){
                        $imagePath = $talent->commercialMedia[0]->image_path;                  
                     } else {
                     $imagePath= 'assets/images/star-logo.png';       
                  }
                  @endphp
                  <div class="portfolio-img bg-extra-dark-gray position-relative text-center overflow-hidden border border-bottom-0">
                     <a href="javascript:void(0);"  class="cursor">
                        <img src="{{ asset($imagePath)}}" alt="productInfo"/>
                     </a>
                  </div>
                  @else 
                  <div class="portfolio-img bg-extra-dark-gray position-relative text-center overflow-hidden border border-bottom-0">
                     <a href="javascript:void(0);"  class="cursor">
                        <img src="{{ asset('assets/images/star-logo.png')}}" alt="logo"/>
                     </a>
                  </div>
                  @endif
                  <figcaption class="bg-white p-3 border border-top-0">
                     <div class="portfolio-hover-main">
                        <div class="portfolio-hover-box">
                           <div class="portfolio-hover-content position-relative text-left">
                              <a href="{{ route('talent.productInfo', $talent->slug )}}" >
                                 <span  class="line-height-normal font-weight-600 text-small margin-5px-bottom text-extra-dark-gray display-block pro-tit">{{$talent->title}}
                                 </span>
                              </a>
                              <p  class="text-medium-gray text-extra-small mb-0 pro-info">{{ Str::limit($talent->product_info,35) }}
                              </p>
                              <p class="d-flex justify-content-between text-primary pt-1 mt-2 pro-pri"><strong>${{$talent->price}}</strong>   
                                 <a class="pro-more" href="{{ route('talent.productInfo', $talent->slug )}}" class="text-uppercase text-small">View more <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
                              </p>
                           </div>
                        </div>
                     </div>
                  </figcaption>
               </figure>
            </li>
            @endforeach
            @endif