@extends('admin.common')

@section('title', 'Blog Tags')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <div class="content-header ch total_blog_post">
      <div class="container-fluid">
         <div class="row mb-2">
         </div>
         <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
   </div>
   <!-- /.content-header -->
   <!-- Main content -->
   <section class="content">
      <div class="card">
         <div class="card-header">
            <h3 class="card-title">Blog Tags</h3>
         </div>
         <!-- /.card-header -->
         <div class="card">
            <div class="row">
               <div class="col-sm-3 col-md-6">
                  <!-- form start -->
                  <div style="border-bottom:none;" class="card-header">
                     <h3 class="card-title">  Filter &nbsp &nbsp </h3>
                     <select class="form-control select2">
                        <option selected="selected">Select All</option>
                        <option></option>
                        <option></option>
                        <option></option>
                        <option></option>
                        <option></option>
                        <option></option>
                     </select>
                  </div>
               </div>
               <div class="col-sm-3 col-md-3 pr-0">
                  <!-- general form elements disabled -->
                  <!-- /.card-header -->
                  <!-- <div class="card-body">
                     <button style="float:right;" type="button" class="btn btn-primary sp" id="in-progress"><i class="fa fa-repeat" aria-hidden="true"></i> UNDELETE ITEM</button>          
                   
                  </div> -->
                  <!-- /.card -->
                  <!-- /.card -->
               </div>
               <div class="col-sm-6 col-md-3 pl-0">
                  <!-- general form elements disabled -->
                  <!-- /.card-header -->
                  <div class="card-body">
                     <a href="{{ route('admin.create-tag') }}" class="btn btn-primary pp"><i class="fa fa-plus-o" aria-hidden="true"></i> Create Tag</a> 
                     
                     <!-- /.card-body -->
                  </div>
                  <!-- /.card -->
                  <!-- /.card -->
               </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
             
               <table class="table table-hover text-nowrap">
                  <thead>
                     <tr>
                        <th>S.No</th>
                        <th>Name</th>
                        <th>Slug Url</th>
                        <th>Status</th>
                       
                     </tr>
                  </thead>
                  <tbody>
                  @if(count($tags) > 0)
                    @php $counter = 0 @endphp
                    @foreach($tags as $value)
                      <tr>
                        <td>{{ ++$counter }}</td>
                        <td>{{ $value['name'] }} </td>
                        <td>{{ $value['url_slug'] }}</td>
                        <td>{{ $value['status'] }}</td>
                        
                      </tr>
                    @endforeach
                  @endif
                     
                  </tbody>
               </table>
             
               <div class="card-footer clearfix">
  
                  <ul class="pagination pagination-sm m-0 float-right">
                       {!! $tags->render() !!}
                </ul>
               </div>
            </div>
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




