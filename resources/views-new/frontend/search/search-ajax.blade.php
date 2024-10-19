@if(count($categories) > 0)
     
    @if($event == 'odd')
        @php $j=0; $i=0; @endphp
        @foreach($categories as $key=>$catagory)
            <div class="col-lg-6 mb-4 mb-sm-0 post-id" id="{{ $catagory->id }}" data-even-odd="even">
                <div class="row h-100">
                    @if($i <= 1 && $j < 1)

                     <div class="order-2 order-lg-1 d-flex flex-column col-sm-6 p-5 position-relative bg-extra-dark-gray wow fadeIn" data-wow-delay="0.2s">
                        <div class="alt-font text-extra-large text-white mb-3">{{$catagory->name}}</div>
                        <p style="color: #fff !important;">{!! Str::limit(strip_tags($catagory->catagory_desc), 200) !!}</p>
                        <div class="mt-auto">
                            <a href="{{ route('search.index',$catagory->slug) }}" class="btn btn-transparent-white btn-small border-radius-4" >
                                <i class="fa fa-play-circle icon-very-small mr-2" aria-hidden="true"></i>Read More
                            </a>
                        </div>
                    </div>
                    <div class="order-1 order-lg-2 col-sm-6 p-0 xs-height-300px cover-background position-relativewow fadeIn"  style="background: transparent url({{ asset('assets/'.$catagory->catagory_banner)}}"></div>
                 
                    @elseif($j <= 2)
                    
                    <div class="col-sm-6 p-0 xs-height-300px cover-background position-relative wow fadeIn" style="background: transparent url({{ asset('assets/'.$catagory->catagory_banner)}}" >
                    </div>
                    
                    <div class="d-flex flex-column col-sm-6 p-5 position-relative bg-extra-dark-gray wow fadeIn" data-wow-delay="0.2s">
                        <div class="alt-font text-extra-large text-white mb-3">{{$catagory->name}}</div>
                        <p style="color: #fff !important;">{!! Str::limit(strip_tags($catagory->catagory_desc), 200) !!}</p>
                        <div class="mt-auto">
                        
                            <a href="{{ route('search.index',$catagory->slug) }}" class="btn btn-transparent-white btn-small border-radius-4" ><i class="fa fa-play-circle icon-very-small mr-2" aria-hidden="true"></i>Read More
                            </a>
                        </div>
                    </div>

                    @endif
                </div>
            </div>
                @php 
                    if($j == 2){
                        $i=0;$j=0;
                    }elseif($i == 1){
                    $j++;
                }elseif($i< 1){
                $i++;
            }
            @endphp
    @endforeach
    @endif

    @if($event == 'even') 
    
     @php $j=0; $i=0; @endphp
        @foreach($categories as $key=>$catagory)
            <div class="col-lg-6 mb-4 mb-sm-0 post-id" id="{{ $catagory->id }}" data-even-odd="odd">
                <div class="row h-100">
                    @if($i <= 1 && $j < 1)

                    <div class="col-sm-6 p-0 xs-height-300px cover-background position-relative wow fadeIn" style="background: transparent url({{ asset('assets/'.$catagory->catagory_banner)}}" >
                    </div>
                    
                    <div class="d-flex flex-column col-sm-6 p-5 position-relative bg-extra-dark-gray wow fadeIn" data-wow-delay="0.2s">
                        <div class="alt-font text-extra-large text-white mb-3">{{$catagory->name}}</div>
                        <p style="color: #fff !important;">{!! Str::limit(strip_tags($catagory->catagory_desc), 200) !!}</p>
                        <div class="mt-auto">
                        
                            <a href="{{ route('search.index',$catagory->slug) }}" class="btn btn-transparent-white btn-small border-radius-4" ><i class="fa fa-play-circle icon-very-small mr-2" aria-hidden="true"></i>Read More
                            </a>
                        </div>
                    </div>
                 
                    @elseif($j <= 2)
                     
                     <div class="order-2 order-lg-1 d-flex flex-column col-sm-6 p-5 position-relative bg-extra-dark-gray wow fadeIn" data-wow-delay="0.2s">
                        <div class="alt-font text-extra-large text-white mb-3">{{$catagory->name}}</div>
                        <p style="color: #fff !important;">{!! Str::limit(strip_tags($catagory->catagory_desc), 200) !!}</p>
                        <div class="mt-auto">
                            <a href="{{ route('search.index',$catagory->slug) }}" class="btn btn-transparent-white btn-small border-radius-4" >
                                <i class="fa fa-play-circle icon-very-small mr-2" aria-hidden="true"></i>Read More
                            </a>
                        </div>
                    </div>
                    <div class="order-1 order-lg-2 col-sm-6 p-0 xs-height-300px cover-background position-relativewow fadeIn"  style="background: transparent url({{ asset('assets/'.$catagory->catagory_banner)}}"></div>

                    @endif
                </div>
            </div>
                @php 
                    if($j == 2){
                        $i=0;$j=0;
                    }elseif($i == 1){
                    $j++;
                }elseif($i< 1){
                $i++;
            }
            @endphp
    @endforeach

    @endif
@endif