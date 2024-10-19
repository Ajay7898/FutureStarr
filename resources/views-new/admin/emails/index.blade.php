@extends('admin.common')

@section('title', 'Emails')

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
        <h3 class="card-title">Monthly Signups</h3>
      </div>
      <!-- /.card-header -->
      
      
      <div class="card">
        <div class="row">
          <div class="col-sm-3 col-md-3">
            
            <!-- form start -->
            <div style="border-bottom:none;" class="card-header">
              <h3 class="card-title">  Filter &nbsp &nbsp </h3> 
              <select class="form-control filter_user">
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
          
          <div class="col-sm-3 col-md-6 pr-0 cal">
           
            <div style="border-bottom:none;" class="card-header">
              <select class="form-control filter_user_cal" >
                <option selected="selected">Jan 2018</option>
                <option></option>
                <option></option>
                <option></option>
                <option></option>
                <option></option>
                <option></option>
              </select>   
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            
            <!-- /.card -->
          </div>
          
          <div class="col-sm-6 col-md-3 pl-0 cou">
            <!-- general form elements disabled -->
            
            <!-- /.card-header -->
            <div style="border-bottom:none;" class="card-header">
              
            </div>
            <!-- /.card -->
            
            <!-- /.card -->
          </div>
        </div>
        
        <div class="row pb-4">
          
          <div class="col-md-1">
          </div>
          <div class="col-md-5">
            
            <div class="card card-primary card-outline">
              
              <div class="card-header border-bottom-0 mb-0 pb-0 mt-0 pt-0 ">
                
                <div class="card-tools mt-0 pt-0">
                 <p> &nbsp </p>
               </div>
             </div>
             
             <div class="card-body">
              <div id="bar-chart" style="height: 200px;"></div>
            </div>
            <!-- /.card-body-->
          </div>

        </div>
        <!-- /.col -->

        <div class="col-md-5">
          <!-- Bar chart -->
          <div class="card card-primary card-outline">
           
           <div class="card-header border-bottom-0 mb-0 pb-0 mt-0 pt-0 ">
            
            <div class="card-tools mt-0 pt-0">
             <p style="color:white;background:#DD0334;padding: 2px 5px 2px 5px;"> 2018 </p>
           </div>
         </div>
         
         
         <div class="card-body">
          <div class="n_emils">
            
            <i class="fa fa-envelope-o mb-1" aria-hidden="true"></i>
            <p style="font-family: Overpass;font-weight: normal;" class="mt-2 mb-0"> Total Number Of Emails </p>
            <p class="mb-0" style="font-size: 30px;"> <b>1805</b> </p>
          </div>
        </div>
        <!-- /.card-body-->
      </div>
      
      
    </div>
    <!-- /.col -->
  </div>
  
  <!-- /.card-header -->
  <div class="card-body table-responsive p-0">
    <table class="table table-hover text-nowrap">
      <thead>
        <tr>
          <th class="text-left">Sender</th>
          <th class="text-left">Subject</th>
          <th class="text-left">Message</th>
          <th class="text-left">Date</th>
        </tr>	
      </thead>
      <tbody>
        <tr>
          <td class="text-left">abbiebicheno39</td>
          <td class="text-left">Abbie Bicheno</td>
          <td class="text-left">Lorem Ipsum is simply dummy text of the printing and typesetting i....</td>
          <td class="text-left">2Jan2018</td>
        </tr>
        <tr>
          <td class="text-left">abbiebicheno39</td>
          <td class="text-left">Abbie Bicheno</td>
          <td class="text-left">Lorem Ipsum is simply dummy text of the printing and typesetting i....</td>
          <td class="text-left">2Jan2018</td>
        </tr>
        <tr>
          <td class="text-left">abbiebicheno39</td>
          <td class="text-left">Abbie Bicheno</td>
          <td class="text-left">Lorem Ipsum is simply dummy text of the printing and typesetting i....</td>
          <td class="text-left">2Jan2018</td>
        </tr>
        <tr>
          <td class="text-left">abbiebicheno39</td>
          <td class="text-left">Abbie Bicheno</td>
          <td class="text-left">Lorem Ipsum is simply dummy text of the printing and typesetting i....</td>
          <td class="text-left">2Jan2018</td>
        </tr>
        <tr>
          <td class="text-left">abbiebicheno39</td>
          <td class="text-left">Abbie Bicheno</td>
          <td class="text-left">Lorem Ipsum is simply dummy text of the printing and typesetting i....</td>
          <td class="text-left">2Jan2018</td>
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