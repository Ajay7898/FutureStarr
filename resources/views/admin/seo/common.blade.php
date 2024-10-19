  <h3 class="card-title mt-0 rounded-0"> 
  	<ul class="nav nav-pills">
  		<li   class="{{ Route::currentRouteName() == 'admin.seo'  ? 'bg-dark text-white' : 'bg-white text-black' }}  p-2 pl-4 pr-4"><a  href="{{ route('admin.seo') }}">Dashboard</a></li>

  		<li class="{{ Route::currentRouteName() == 'admin.seo.setting' || Route::currentRouteName() == 'admin.seo.edit' ? 'bg-dark text-white' : 'bg-white text-black' }} p-2 pl-4 pr-4"><a href="{{ route('admin.seo.setting') }}">Settings</a></li>
  	</ul> 
  </h3> 