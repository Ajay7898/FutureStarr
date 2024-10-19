@extends('admin.common')

@section('title', 'Users Registered')

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
            <h3 class="card-title">Users Registered</h3>
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
                  <div class="card-body">
                     <button style="float:right;" type="submit" class="btn btn-primary sp"><i class="fa fa-repeat" aria-hidden="true"></i> UNDELETE ITEM</button>          
                     <!-- /.card-body -->
                  </div>
                  <!-- /.card -->
                  <!-- /.card -->
               </div>
               <div class="col-sm-6 col-md-3 pl-0">
                  <!-- general form elements disabled -->
                  <!-- /.card-header -->
                  <div class="card-body">
                     <button type="submit" class="btn btn-primary pp"><i class="fa fa-trash-o" aria-hidden="true"></i> TRASH COMPLETELY</button>          
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
                        <th class="check-add pb-4">                     
                           <input type="checkbox"> 
                        </th>
                        <th class="text-left pb-4">Username</th>
                        <th class="text-left pb-4">Name</th>
                        <th class="text-left pb-4">Email</th>
                        <th class="text-left pb-4">Role</th>
                        <th>Approve or<br/>Disapprove</th>
                        <th class="text-left pb-4">Block User</th>
                        <th class="text-left pb-4">Posts</th>
                        <th class="text-left pb-4">User ID</th>
                     </tr>
                  </thead>
                  <tbody>
                   @if(count($users) > 0)
                     @foreach($users as $user)
                       <tr>
                          <td class="check-add"> <input type="checkbox"> </td>
                          <td>{{ $user->username ?? "-- --" }}</td>
                          <td>{{ $user->first_name ?? "--" }}&nbsp;{{ $user->last_name ?? "--" }}</td>
                          <td>{{ $user->email ?? "" }}</td>
                          <td>{{ $user->getUserRole['name'] ?? "" }}</td>
                          <td>{{ $user->email_verified }}</td>
                          <td><i class="fa fa-ban" aria-hidden="true"></i></td>
                          <td>{{ $user->id }}</td>
                          <td>{{  \Carbon\Carbon::parse($user->created_at)->format('d, M Y') }}</td>
                       </tr>
                      @endforeach
                      @else 
                         <tr>
                          <h5 class="text-center text-danger">No record available.</h5></td>
                       </tr>
                    @endif
                  </tbody>
               </table>
               <div class="card-footer clearfix">
                  <ul class="pagination pagination-sm m-0 float-right">
                     {!!  $users->render() !!}
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