 
 @if(count($totalCount) > 9)
      
      @php
          $index = count($talents) - 1;
      @endphp

	  <a href="javascript:void(0);" id="{{ $talents[$index]->id }}" class="show_more btn btn-success text-center" title="Load more posts" data-category="">Show more</a>
	  <span class="loding btn btn-success text-center" style="display: none;">
	       <span class="loding_txt">Loading...</span>
	  </span>
 @endif