@extends('admin.common')

@section('title', 'Starr Search Categories')

@section('content')
<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">

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
            <h3 class="card-title">Product Listing</h3>
         </div>
         <!-- /.card-header -->
         <div class="card">           
            <div class="card-body table-responsive p-0">             
               <table class="table table-hover text-nowrap">
                  <thead>
                     <tr>
                        <th>Sr.No</th>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Publish</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     @if(count($products) > 0 )
                     @php  $counter = 0; @endphp
                     @foreach($products as $product)                        
                         <tr>
                            <td>{{ ++$counter }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->price }}</td>
                            <td>
                              <label class='checkbox-inline pl-4'>
                                <input type='checkbox' @if($product->is_publish == 1) checked @endif data-toggle_id='{{ $product->id }}' data-toggle='toggle' data-onstyle='success' class='product-publish-toggle' data-offstyle='danger' name='publish' data-size='xs'>
                              </label>                          
                            </td>
                            <td>
                              <a title="EDIT STARR SEARCH {{ $product->name }}" href="{{ route('admin.product.edit', $product->id) }}" alt="blog-edit"><i style="color:#8bc34a;" class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                              &nbsp;
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

@section('script')
  <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
<script type='text/javascript'>
  jQuery(document).ready(function() {
    var token = jQuery('meta[name="csrf-token"]').attr('content')
    var site_url = jQuery('meta[name="site-url"]').attr('content')

    jQuery(document).on('change', '.product-publish-toggle', function(){
        var isThis = this;
        $.ajax({
            type:'post',
            url: site_url+'/admin/product/publish',
            data:{
                'id': jQuery(this).data('toggle_id'),
                'publish': jQuery(this).prop('checked'),
                _token:token
            },
            success:function(data){
            }
        });
    });

});
</script>
@endsection


