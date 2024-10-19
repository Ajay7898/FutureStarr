@extends('admin.common')

@section('title', 'Compose Email')

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


			<div class="card">
				<div class="row">
					<div class="card-body table-responsive p-0">
                        <form action="{{ route('admin.send-email') }}" method="POST" enctype="multipart/form-data">
                        	@csrf
							<div class="col-md-12">

								<div style="border: none;padding:0px;" class="card-header">
									<h3 class="card-title">&nbsp </h3>
								</div>

								<div style="background:black;border-radius:0px;" class="card-header pt-1 pb-1">
									<h3 style="color:gray;" class="card-title">New Message</h3>
								</div>
								<!-- /.card-header -->

								<div class="card-header pt-1 pb-1">
									<input type="email" style="border: none;padding:0px;" class="form-control @error('to') is-invalid @enderror" placeholder="To" name="to">
									 @error('to')
			                            <span class="invalid-feedback" role="alert">
			                                <strong>{{ $message }}</strong>
			                            </span>
			                        @enderror
								</div>

								<div class="card-header pt-1 pb-1">
									<input type="text" style="border: none;padding:0px;" class="form-control @error('title') is-invalid @enderror" placeholder="First Name"  name="first_name" >
									 @error('first_name')
			                            <span class="invalid-feedback" role="alert">
			                                <strong>{{ $message }}</strong>
			                            </span>
			                        @enderror
								</div>

								<div class="card-header pt-1 pb-1">
									<input type="text" style="border: none;padding:0px;" class="form-control @error('last_name') is-invalid @enderror" placeholder="Last Name"  name="last_name" >
									 @error('last_name')
			                            <span class="invalid-feedback" role="alert">
			                                <strong>{{ $message }}</strong>
			                            </span>
			                        @enderror
								</div>

								<div class="card-header pt-1 pb-1">
									<input type="text" style="border: none;padding:0px;" class="form-control @error('subject') is-invalid @enderror" placeholder="Subject" name="subject" >
									 @error('subject')
			                            <span class="invalid-feedback" role="alert">
			                                <strong>{{ $message }}</strong>
			                            </span>
			                        @enderror
								</div>
								<div class="form-group">
									<textarea name="message" id="compose-textarea"  class="form-control @error('message') is-invalid @enderror" style="height: 500px" >

									</textarea>
									 @error('title')
			                            <span class="invalid-feedback" role="alert">
			                                <strong>{{ $message }}</strong>
			                            </span>
			                        @enderror
								</div>


								<!-- /.card-body -->
								<div style="background:white;" class="card-footer">
									<div class="float-right">
										<span style='font-size:20px;'>&#128522;</span>&nbsp
										<div class="btn btn-default btn-file">
											<i class="fas fa-paperclip"></i> 
											<input type="file" name="attachment">
										</div>&nbsp &nbsp &nbsp
										<button type="submit" class="btn btn-primary" name="send" value="send"><i class="fa fa-paper-plane" aria-hidden="true"></i> SEND</button>
										<button type="submit" class="btn btn-primary" name="send" value="send_all">SEND TO ALL</button>
									</div>

								</div>
								<!-- /.card-footer -->

								<!-- /.card -->
							</div>
                        </form>

					</div>
				</div>
				<!-- /.card-header -->
				<!-- /.card-body -->
			</div>
			<!-- /.card -->
			<!-- /.card-body -->
		</div>
		<!-- /.card -->
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection