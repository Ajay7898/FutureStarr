@extends('admin.common')

@section('title', 'Add Tags')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header ch">
      <div class="container-fluid">
        <div class="row mb-2">
         
         
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">	
           
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
		 <p class="dash-t">Create Tag</p>
         <div class="row pl-4 pb-4 pr-4">		
    
          <div class="col-lg-12 col-12 pr-4">

          	<form action="{{ route('admin.blog.store-tag') }}" method="POST">
          		@csrf

          		<div class="form-group col-md-6">
          			<label>Name:</label>
          			<input type="text" name="tag_name" id="tag_name"  class="form-control @error('tag_name') is-invalid @enderror">
          			 @if ($errors->has('tag_name'))
                         <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('tag_name') }}</strong>
                          </span>
                     @endif
          		</div>

              <div class="form-group col-md-6">
                <label>Url Slug:</label>
                <input type="text" name="url_slug" id="url_slug"  class="form-control @error('url_slug') is-invalid @enderror">
                 @if ($errors->has('url_slug'))
                         <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('url_slug') }}</strong>
                          </span>
                     @endif
              </div>


              <div class="form-group col-md-6">
                <label>Status:</label>
               
                <select name="status" id="status" class="form-control @error('status') is-invalid @enderror">
                  <option value="Active">Active</option>
                  <option value="In-Active">In-Active</option>
                </select>
                 @if ($errors->has('status'))
                         <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('status') }}</strong>
                          </span>
                 @endif
              </div>

    

          		<button type="submit" class="btn btn-primary">Submit</button>
          		
          	</form>
         
          </div>
         
        </div>
        <!-- /.row -->
        <!-- Main row -->
		
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  @endsection