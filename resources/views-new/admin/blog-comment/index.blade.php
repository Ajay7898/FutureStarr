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
            <h3 class="card-title">Total Blog Comment</h3>
         </div>
         <!-- /.card-header -->
         <div class="card">
            <div class="row">
               <div class="col-sm-6 col-md-12">
                  <!-- form start -->
                  <div class="card-body">
                       
                  </div>
               </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
             @if(count($comments) > 0 )
               <table class="table table-hover text-nowrap">
                  <thead>
                     <tr>
                        <th>S.No</th>
                        <th>Blog Title</th>
                        <th>Comment</th>
                        <th>Posted By</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     
                     @php $counter = 0; @endphp
                     @foreach($comments as $comment)

                        @if($comment->status == '0')
                            @php  $status = 'Not Approved' @endphp
                        @else
                            @php  $status = 'Approved' @endphp
                        @endif

                         <tr>
                            <td>{{ ++$counter }}</td>
                            <td>{{ $comment->blogData['title'] }}</td>
                            <td>{{ $comment->message }}</td>
                            <td>{{ $comment->getCommentUser['first_name'] }}&nbsp; {{ $comment->getCommentUser['last_name'] }}</td>
                            <td>{{ \Carbon\Carbon::parse($comment->created_by)->format('d, M Y')}}</td>
                            <td>{{ $status }}</td>
                            <td>
                               @if($comment->status == '0')
                                  <a class="btn btn-success" href="javascript:void();" data-commentid="{{ $comment->id }}" id="approve-blog-comment-{{ $comment->id }}" data-url="{{ route('admin.blog.comment.status', $comment->id ) }}">Approve</a> 
                                  
                               @else
                                  <a href="javascript:void();" class="btn btn-warning"><i class="fa fa-check"></i>Approved</a>
                               @endif

                            </td>
            
                         </tr>

                       @endforeach

                  </tbody>

               </table>

               @else
                 
                 <p class="text-danger text-center" style="font-size: 20px;">No Comment available</p>

               @endif
             
               <div class="card-footer clearfix">
  
                  <ul class="pagination pagination-sm m-0 float-right">
                       {!! $comments->render() !!}
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




