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
          <h3 class="card-title">Seo</h3>
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
        
		  <div class="col-md-12">
            
			<div class="card-body table-responsive p-0">
			
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>S.No</th>
                      <th class="check-add">                     
                        Page name
                    </th>
                      <th>Seo Titles</th>
                      <th>Urls</th>
                      <th>Meta description</th>
                      <th>Edit</th>
                    </tr>	
                  </thead>
                  <tbody>
                  	@if(count($seo) > 0 )
                  	    @php $counter = 0; @endphp
	                  	@foreach($seo as $value)
		                    <tr>
		                      <td class="text-danger">#{{ ++$counter }}</td>
		                      <td>{{ $value->page_title ?: '' }}</td>
		                      <td>{{ $value->title ?: '' }}</td>
		                      <td>{{ $value->url ?: '---' }}</td>
		                      <td>{!! Str::limit($value->description, 30) !!}</td>
		                      <td><a href="{{ route('admin.seo.edit', $value->id) }}" title="EDIT {{ $value->page_title }} SEO"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
		                    </tr>
	                    @endforeach
	                    @else
		                 <tr>
		                      <td><p class="text-center text-danger">No record available.</p></td>
		                  </tr>
		            @endif
                  </tbody>
                </table>
                 <div class="card-footer clearfix">
		            
		                {!!  $seo->render() !!}
		            
		          </div>
               
              </div>
            
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