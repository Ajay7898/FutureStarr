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
       <form id="blog-form" role="form" class="mgt" action="{{ route('admin.site.config.store') }}" method="POST" enctype="multipart/form-data">

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
          <div class="col-md-9">
            <!-- general form elements -->

            <!-- form start -->

            <div class="card-body">

              <div class="form-group">
                  <div class="card-details mb-2">
                     <label>Email:</label>
                     <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $settings['email']) }}" required>
                      @error('email')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
              </div>
              <div class="form-group">
                  <div class="card-details mb-2">
                     <label>Contact Number:</label>
                     <input type="text" name="contact_number" class="form-control @error('contact_number') is-invalid @enderror" value="{{ old('contact_number', $settings['contact_number']) }}" required>
                      @error('contact_number')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
              </div>
              <div class="form-group">
                  <div class="card-details mb-2">
                     <label>Working Hours (Weekdays):</label>
                     <input type="text" name="work_hours_weekdays" class="form-control @error('work_hours_weekdays') is-invalid @enderror" value="{{ old('work_hours_weekdays', $settings['work_hours_weekdays']) }}" required>
                      @error('work_hours_weekdays')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
              </div>
              <div class="form-group">
                  <div class="card-details mb-2">
                     <label>Working Hours (Weekend):</label>
                     <input type="text" name="work_hours_weekends" class="form-control @error('work_hours_weekends') is-invalid @enderror" value="{{ old('work_hours_weekends', $settings['work_hours_weekends']) }}" required>
                      @error('work_hours_weekends')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
              </div>
              <div class="form-group">  
                  <div class="card-details mb-2">
                    <label>Address:</label>
                      <textarea class="textarea form-control @error('address') is-invalid @enderror" rows="3" placeholder="Enter address here" name="address">{{ old('address', $settings['address']) }}</textarea>
                      @error('address')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>  
              </div>
              <div class="form-group">
                  <div class="card-details mb-2">
                     <label>Facebook:</label>
                     <input type="text" name="facebook" class="form-control @error('facebook') is-invalid @enderror" value="{{ old('facebook', $settings['facebook']) }}">
                      @error('facebook')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
              </div>
              <div class="form-group">
                  <div class="card-details mb-2">
                     <label>Instagram:</label>
                     <input type="text" name="instagram" class="form-control @error('instagram') is-invalid @enderror" value="{{ old('instagram', $settings['instagram']) }}">
                      @error('instagram')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
              </div>
              <div class="form-group">
                  <div class="card-details mb-2">
                     <label>Twitter:</label>
                     <input type="text" name="twitter" class="form-control @error('twitter') is-invalid @enderror" value="{{ old('twitter', $settings['twitter']) }}">
                      @error('twitter')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
              </div>
              <div class="form-group">
                  <div class="card-details mb-2">
                     <label>LinkedIn:</label>
                     <input type="text" name="linkedin" class="form-control @error('linkedin') is-invalid @enderror" value="{{ old('linkedin', $settings['linkedin']) }}">
                      @error('linkedin')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
              </div>
              <div class="form-group">
                  <div class="card-details mb-2">
                     <label>Youtube:</label>
                     <input type="text" name="youtube" class="form-control @error('youtube') is-invalid @enderror" value="{{ old('youtube', $settings['youtube']) }}">
                      @error('youtube')
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