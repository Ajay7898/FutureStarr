@extends('admin.common')

@section('title', 'Starr Search Categories')

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
            <h3 class="card-title">Categories Listing</h3>
         </div>
         <!-- /.card-header -->
         <div class="card">
            <!-- <div class="row">
               <div class="col-sm-3 col-md-6">
                  
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
                  
                  <div class="card-body">
                     <button style="float:right;" type="button" class="btn btn-primary sp" id="in-progress"><i class="fa fa-repeat" aria-hidden="true"></i> UNDELETE ITEM</button>          
                     
                  </div>
                 
               </div>
               <div class="col-sm-6 col-md-3 pl-0">
                  
                  <div class="card-body">
                     <button type="button" class="btn btn-primary pp" id="delete_records"><i class="fa fa-trash-o" aria-hidden="true"></i> TRASH COMPLETELY</button> 
                     <input type="hidden" name="bulk_del_url" id="bulk_del_url" value="{{ route('blog.bulk.delete') }}" >
                    
                  </div>
                 
               </div>
            </div> -->
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
             
               <table class="table table-hover text-nowrap">
                  <thead>
                     <tr>
                        <th>Sr.No</th>
                        <th>Title</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     @if(count($categories) > 0 )
                     @php  $counter = 0; @endphp
                     @foreach($categories as $category)
                        
                         <tr>
                            <td>{{ ++$counter }}</td>
                            <td>{{ $category->name }}</td>
                            <td>

                              <a title="EDIT STARR SEARCH {{ $category->name }}" href="{{ route('admin.starr-search.edit', $category->id) }}" alt="blog-edit"><i style="color:#8bc34a;" class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                              &nbsp;
                              
                              <a title="PREVIEW STARR SEARCH {{ $category->name }} PAGE." href="{{ route('search.index',$category->slug) }}" target="_blank">
                                <i class="fa fa-eye text-danger" aria-hidden="true"></i>
                              </a>

                            </td>
                         </tr>
                       @endforeach
                       @else
                       <h4 class="text-center text-danger">No Blog Available.</h4>
                       @endif
                  </tbody>
               </table>
             
               <div class="card-footer clearfix">
  
                  <ul class="pagination pagination-sm m-0 float-right">
                       {!! $categories->render() !!}
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




