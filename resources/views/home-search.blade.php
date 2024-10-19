<li class="search-results-heading">Seller
  <span class="search-result-counts">({{ $sellersCount }})</span>
</li>

@if(count($sellers))
  @foreach($sellers as $user)
  
	
  
    <li class="search-results-items seller-search col-sm-12" > 
	<div class="">
		<a href="{{ route('seller-public-profile', $user['public_profile'])  }}" target="_blank">
			         {{ $user->username  }}              
          </a> 
	</div>
          
	<div class="">
		@if($user->profile_pic && file_exists($user->profile_pic))
               <span class="search-result-counts"><img src="{{ asset($user->profile_pic) }}"></span>
			   @else
				<span class="search-result-counts"><img src="{{ asset('assets/images/buyer/b-acount.png') }}"></span>
				@endif
	</div>
      </li>
	  
	  
	
  @endforeach
@endif
	
<li class="search-results-heading">Talents 
  <span class="search-result-counts">({{ $talentCount }})</span>
</li>
@if(count($talents) > 0) 
    @foreach($talents as $talent) 
    
        <li class="search-results-items" > 
          <a href="{{ route('talent.productInfo',$talent->slug) }}" target="_blank">
            {{ $talent->title }} 
          </a> 
        </li>

    @endforeach
    @else
       <li class="search-results-error">No results found.</li>
@endif

<li class="search-results-heading Categories">Categories 
   <span class="search-result-counts">({{ $categoriescount }})</span>
</li>

@if(count($categories) > 0) 
    @foreach($categories as $category)
       
          
         <li class="search-results-items">
            <a target="_blank" href="{{ route('talent.show',$category->slug) }}">{{ $category->name }} </a>
         </li> <br>
          
    @endforeach
    @else
        <li class="search-results-error">No results found.</li>
@endif