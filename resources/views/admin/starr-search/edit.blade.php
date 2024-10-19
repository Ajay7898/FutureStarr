@extends('admin.common')

@section('title', 'Edit Starr Search Category')

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
  <section class="content post_new_blog">
    <div class="card">

      <!-- /.card-header -->
      

      <div class="card">
       <form id="blog-form" role="form" class="mgt" action="{{ route('admin.starr-search.update', $category['id']) }}" method="POST" enctype="multipart/form-data">

        @csrf

        <div class="row">


          <div class="col-sm-3 col-md-3" id="loader" style="display: none;">
            <!-- general form elements disabled -->

            <!-- /.card-header -->
            <div class="card-body">
              
                 <button class="btn btn-primary" type="button" disabled>
                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                Loading...
              </button>

              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- /.card -->
          </div>

          <div class="col-sm-3 col-md-3">
            <!-- general form elements disabled -->

            <!-- /.card-header -->
            <div class="card-body">
             
             <input type="submit" class="btn btn-primary sp hide-off" name="submit" value="UPDATE CONTENT">

             <!-- /.card-body -->
            </div>
           <!-- /.card -->

           <!-- /.card -->
         </div>

         <!-- right column -->
       <!--   <div class="col-sm-6 col-md-3">
            <div class="card-body">
             <input type="submit" class="btn btn-primary pp hide-off" name="publish" value="PUBLISH POST">
           </div>
        </div>
 -->
       <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->

            <!-- form start -->
            <form role="form" class="mgt">
              <div class="card-body">
                <div class="form-group">  

                  <div class="card-details mb-2">     
                    <div class="card card-outline card-info">
                      <div class="card-header">
                        <h3 class="card-title">
                          Text item
                          <small> Data</small>
                        </h3>
                        <!-- tools box -->
                        <div class="card-tools">
                          <button type="button" class="btn btn-tool btn-sm" data-card-widget="collapse" data-toggle="tooltip"
                          title="Collapse">
                          <i class="fas fa-minus"></i></button>
                          <button type="button" class="btn btn-tool btn-sm" data-card-widget="remove" data-toggle="tooltip"
                          title="Remove">
                          <i class="fas fa-times"></i></button>
                        </div>
                        <!-- /. tools -->
                      </div>
                      <!-- /.card-header -->
                      <div class="card-body pad">
                        <div class="mb-3">
                          <textarea name="content" class="textarea @error('content') is-invalid @enderror" placeholder="" rows="5" cols="5">{{ $category['catagory_desc']}}</textarea>
                          @error('content')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                        <p class="text-sm mb-0">
                        </a>
                      </p>
                    </div>
                  </div>
                <br>
                <div class="card-details mb-2">
                   <label>Meta Title:</label>
                   <input type="text" class="form-control @error('meta_title') is-invalid @enderror"  placeholder="Enter Meta title here" name="meta_title" value="{{ old('meta_title', $category['meta_title']) }}"> 
                      @error('meta_title')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                     @enderror 
                </div> 

                <div class="card-details mb-2">
                   <label>Meta Keywords:</label>
                   <input type="text" class="form-control @error('meta_keywords') is-invalid @enderror"  placeholder="Enter Keyword here" name="meta_keywords" value="{{ old('meta_keywords', $category['meta_keywords']) }}"> 
                    @error('meta_keywords')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                     @enderror
                </div> 

                <div class="card-details mb-2">
                  <label>Meta Description:</label>
                  <textarea class="form-control @error('meta_description') is-invalid @enderror" rows="3" placeholder="Enter Description here" name="meta_description">{{ old('meta_description', $category['meta_description']) }}</textarea>
                    @error('meta_description')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                     @enderror
                </div>  


                </div>
              </div>
            </div>
            <!-- /.card-body -->

            <!-- /.card -->
          </div>
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-3">
            <!-- general form elements disabled -->




          </form>

          <!-- /.card-body -->
        </div>
        <!-- /.card -->

        <!-- /.card -->
      </div>
      <!--/.col (right) -->
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->



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