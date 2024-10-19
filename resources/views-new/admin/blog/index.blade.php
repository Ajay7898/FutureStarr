@extends('admin.common')

@section('title', 'Blog Listing')

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
            <h3 class="card-title">Total Blog Post</h3>
         </div>
         <!-- /.card-header -->
         <div class="card">
            <div class="row">
               <div class="col-sm-3 col-md-6">
                  <!-- form start -->
                  <div style="border-bottom:none;" class="card-header">
                     <h3 class="card-title">  Filter &nbsp &nbsp </h3>
                     <select class="form-control select2" id="filter-blog" name="filter-blog">
                        <option value="">Select All</option>
                        @if(count($categories) > 0)
                          @foreach($categories as $value)
                           <option value="{{ $value->id }}"> {{ $value->name }} </option>
                          @endforeach
                        @endif
                     </select>
                  </div>
               </div>
               <div class="col-sm-3 col-md-3 pr-0">
                  <!-- general form elements disabled -->
                  <!-- /.card-header -->
                  <div class="card-body">
                     <button style="float:right;" type="button" class="btn btn-primary sp" id="in-progress"><i class="fa fa-repeat" aria-hidden="true"></i> UNDELETE ITEM</button>          
                     <!-- /.card-body -->
                  </div>
                  <!-- /.card -->
                  <!-- /.card -->
               </div>
               <div class="col-sm-6 col-md-3 pl-0">
                  <!-- general form elements disabled -->
                  <!-- /.card-header -->
                  <div class="card-body">
                     <button type="button" class="btn btn-primary pp" id="delete_records"><i class="fa fa-trash-o" aria-hidden="true"></i> TRASH COMPLETELY</button> 
                     <input type="hidden" name="bulk_del_url" id="bulk_del_url" value="{{ route('blog.bulk.delete') }}" >
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
                        <th class="check-add">                     
                           <input type="checkbox" name="emp_checkbox" id="select_all" style="display: block !important;">
                        </th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Categories</th>
                        <th>Comments</th>
                        <th>Date</th>
                        <th>Social Share</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     @if(count($blogs) > 0 )
                     @foreach($blogs as $blog)
                        @php $output = str_split($blog->title, 21);@endphp
                        @php $sup_text = !empty($blog->blog_status == 1) ? 'Published' : 'Draft'; @endphp
                        @php $sup_class = !empty($blog->blog_status == 1) ? 'text-success' : 'text-danger'; @endphp
                         <tr>
                            <td class="check-add">
                               <input type="checkbox" id="blog-{{ $blog->id }}" name="products" value="{{ $blog->id }}" class="emp_checkbox" data-emp-id="{{ $blog->id }}"> 
                            </td>
                            <td>{{ $output[0] ?? "" }}<br/>{{ $output[1] ?? "" }}...<sup class="{{ $sup_class }}">[{{ $sup_text }}]</sup></td>
                            <td>{{ $blog->author_first_name ?? "" }}&nbsp;{{ $blog->author_last_name ?? "" }}</td>
                            <td>{{ $blog->getBlogCatagories['name'] }}</td>
                            <td><span class="tag tag-success">
                                 {{ count($blog->getBlogComments) }}
                               </span>
                            </td>
                            <td>{{ \Carbon\Carbon::parse($blog->date)->format('d, M Y')}}</td>
                            <td>1</td>
                            <td>

                              <a title="EDIT BLOG" href="{{ route('admin.blog.edit', $blog->id) }}" alt="blog-edit"><i style="color:#8bc34a;" class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                              &nbsp;
                              <a href="javascript:void(0)" title="DELETE BlOG" id="delete-{{ $blog->id }}" data-url="{{ route('admin.blog.delete' ,$blog->id) }}">
                              <i style="color:  #FF503F !important;" class="fa fa-trash-o" aria-hidden="true"></i>
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
                       {!! $blogs->links() !!}
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




