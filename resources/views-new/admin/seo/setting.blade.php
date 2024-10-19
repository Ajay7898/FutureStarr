@extends('admin.common')

@section('title', 'Seo Dashboard')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<div class="content-header ch users_monthly_signup">
		<div class="container-fluid">
			<div class="row mb-2">

			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<!-- /.content-header -->

	<!-- Main content -->
	<section class="content">
		<div class="card">
			<div class="card-header">
				<h3 class="card-title">@yield('title')</h3>
			</div>
			<!-- /.card-header -->


			<div style="background:#EBEBEB;" class="card">
				


				<!-- form start -->

				@include('admin.seo.common')

				<!-- /.card-body -->
			</div>
			<!-- /.card -->


			<div class="row mt-3">
				<!-- left column -->


				<div class="col-md-9">
                    <form action="{{ isset($seo) ? route('admin.seo.update', $seo['id']): route('admin.seo.store') }}" method="POST">
                    	@csrf
						<div class="card rounded-0 shadow-none ">

							<div class="card-body">

								Url  <input style="width:80%;float:right;" class="form-control @error('title') is-invalid @enderror" type="text" placeholder="Url" name="url" value="{{ old('url' , isset($seo['url']) ? $seo['url'] : '' )}}">
								@error('url')
		                            <span class="invalid-feedback" role="alert">
		                                <strong>{{ $message }}</strong>
		                            </span>
		                        @enderror

								<br/><br/><br/>

								Page Name   <input style="width:80%;float:right;" class="form-control @error('page_name') is-invalid @enderror" type="text" placeholder="About us" name="page_name" value="{{ old('page_name' , isset($seo['page_title']) ? $seo['page_title'] : '') }}">
								@error('page_name')
		                            <span class="invalid-feedback" role="alert">
		                                <strong>{{ $message }}</strong>
		                            </span>
		                        @enderror

								<br/><br/><br/>

								Seo Title   <input style="width:80%;float:right;" class="form-control @error('title') is-invalid @enderror" type="text" placeholder="Seo Title" name="title" value="{{ old('title' , isset($seo['title']) ? $seo['title'] : '') }}">
								@error('title')
		                            <span class="invalid-feedback" role="alert">
		                                <strong>{{ $message }}</strong>
		                            </span>
		                        @enderror

								<br/><br/><br/>

								Key word   <input style="width:80%;float:right;" class="form-control @error('keyword') is-invalid @enderror" type="text" placeholder="Key word" name="keyword" value="{{ old('keyword' , isset($seo['keywords']) ? $seo['keywords'] : '') }}">
								@error('keyword')
		                            <span class="invalid-feedback" role="alert">
		                                <strong>{{ $message }}</strong>
		                            </span>
		                        @enderror

								<br/><br/><br/>

								Meta description   <textarea style="width:80%;float:right;" class="form-control @error('description') is-invalid @enderror" rows="6" placeholder="Enter Description here name" name="description">{{ old('description' , isset($seo['description']) ? $seo['description'] : '') }}</textarea>		
								@error('description')
		                            <span class="invalid-feedback" role="alert">
		                                <strong>{{ $message }}</strong>
		                            </span>
		                        @enderror				

							</div>


							<div class="row">

								<div class="col-sm-3 col-md-2">

								</div>
								<!--/.col (left) -->

								<div class="col-sm-3 col-md-6">

									<div class="card-body">
										<button  type="submit" class="btn btn-primary sp ml-3 pl-5 pr-5 rounded-0">SAVE</button>&nbsp &nbsp  
										<button type="submit" class="btn btn-primary pp pl-5 pr-5 rounded-0">CANCEL</button>     

										<br/><br/><br/>
										<!-- /.card-body -->
									</div>

								</div>

								<!-- right column -->

								<!-- /.card-body -->
							</div>
						</div>
				

				</div>

				<div class="col-md-3">
					<!-- general form elements disabled -->

					<!-- /.card-header -->
					<div class="card-body">
						
							<div class="row">
								<div class="col-sm-12">
									<!-- text input -->
									<div class="form-group @error('page') is-invalid @enderror">
										<label>Page</label><br/>
										<input id="checkbox-listing-1" type="checkbox" name="page"> Home <br/><br/>
										<input id="checkbox-listing-2" type="checkbox" name="page"> About <br/><br/>
										<input id="checkbox-listing-3" type="checkbox" name="page"> Star Search <br/><br/>
										<input id="checkbox-listing-4" type="checkbox" name="page"> Social Buzz <br/><br/>
										<input id="checkbox-listing-5" type="checkbox" name="page"> Talent Mall <br/><br/>
										<input id="checkbox-listing-6" type="checkbox" name="page"> Blogs <br/><br/>
										<input id="checkbox-listing-7" type="checkbox" name="page"> Contact us <br/>

                                        @error('page')
				                            <span class="invalid-feedback" role="alert">
				                                <strong>{{ $message }}</strong>
				                            </span>
				                        @enderror	
									</div>
									<!-- /.card-body -->
								</div>
							</div>

						</div>
					</form>

					<!-- /.card-body -->
				</div>
				<!--/.col (right) -->
			</div>

			<!-- /.card-body -->
		</div>
		<!-- /.card -->
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection