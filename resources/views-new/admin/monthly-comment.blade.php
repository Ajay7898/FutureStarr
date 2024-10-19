@extends('admin.common')

@section('title', 'Monthly Comments')

@section('content')

 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header ch monthly_comments">
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
          <h3 class="card-title">Monthly Comments</h3>
        </div>
        <!-- /.card-header -->
      
         
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">  Filter &nbsp &nbsp </h3> 
				<select class="form-control select2" style="width: 15%;">
                    <option selected="selected">Select All</option>
                    <option></option>
                    <option></option>
                    <option></option>
                    <option></option>
                    <option></option>
                    <option></option>
                  </select>

                
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th class="check-add">                     
                        <input type="checkbox"> 
                    </th>
                      <th>Author</th>
                      <th>Comment</th>
                      <th>Email</th>
                      <th>Date</th>
                      <th>View</th>
                      <th>Remove</th>
                      <th>Reply</th>
                      <th>Edit</th>
                    </tr>	
                  </thead>
                  <tbody>
                    <tr>
                      <td class="check-add"> <input type="checkbox"> </td>
                      <td>abbiebicheno39</td>
                      <td>Lorem Ipsum is simply ...</td>
                      <td>abbie-bicheno@<br/>hybridmc.net</td>
                      <td><span class="tag tag-success">2Jan2018</span></td>
                      <td><i class="fa fa-search" aria-hidden="true"></i></td>
                      <td><i class="fa fa-trash-o" aria-hidden="true"></i></td>
                      <td><i class="fa fa-comment-o" aria-hidden="true"></i></td>
                      <td><i class="fa fa-pencil-square-o" aria-hidden="true"></i></td>
                    </tr>
                    <tr>
                       <td class="check-add"> <input type="checkbox"> </td>
                      <td>abbiebicheno39</td>
                      <td>Lorem Ipsum is simply ...</td>
                      <td>abbie-bicheno@<br/>hybridmc.net</td>
                      <td><span class="tag tag-success">2Jan2018</span></td>
                      <td><i class="fa fa-search" aria-hidden="true"></i></td>
                      <td><i class="fa fa-trash-o" aria-hidden="true"></i></td>
                      <td><i class="fa fa-comment-o" aria-hidden="true"></i></td>
                      <td><i class="fa fa-pencil-square-o" aria-hidden="true"></i></td>
                    </tr>
                    <tr>
                      <td class="check-add"> <input type="checkbox"> </td>
                      <td>abbiebicheno39</td>
                      <td>Lorem Ipsum is simply ...</td>
                      <td>abbie-bicheno@<br/>hybridmc.net</td>
                      <td><span class="tag tag-success">2Jan2018</span></td>
                      <td><i class="fa fa-search" aria-hidden="true"></i></td>
                      <td><i class="fa fa-trash-o" aria-hidden="true"></i></td>
                      <td><i class="fa fa-comment-o" aria-hidden="true"></i></td>
                      <td><i class="fa fa-pencil-square-o" aria-hidden="true"></i></td>
                    </tr>
                    <tr>
                       <td class="check-add"> <input type="checkbox"> </td>
                      <td>abbiebicheno39</td>
                      <td>Lorem Ipsum is simply ...</td>
                      <td>abbie-bicheno@<br/>hybridmc.net</td>
                      <td><span class="tag tag-success">2Jan2018</span></td>
                      <td><i class="fa fa-search" aria-hidden="true"></i></td>
                      <td><i class="fa fa-trash-o" aria-hidden="true"></i></td>
                      <td><i class="fa fa-comment-o" aria-hidden="true"></i></td>
                      <td><i class="fa fa-pencil-square-o" aria-hidden="true"></i></td>
                    </tr>
                  </tbody>
                </table>
				<div class="card-footer clearfix">
				<ul class="pagination pagination-sm m-0 float-right">
                  <li class="page-item"><a class="page-link gret" href="#">«</a></li>
                  <li class="page-item"><a class="page-link" href="#">1</a></li>
                  <li class="page-item"><a class="page-link" href="#">2</a></li>
                  <li class="page-item"><a class="page-link active" href="#">3</a></li>
                  <li class="page-item"><a class="page-link gret" href="#">»</a></li>
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