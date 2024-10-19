@extends('admin.common')

@section('title', 'Social Share Dashboard')

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
          <h3 class="card-title">Social Shares</h3>
        </div>
        <!-- /.card-header -->
      
         
            <div class="card">
				<div class="row">
              <div class="col-sm-3 col-md-6">
          
              <!-- form start -->
             <div style="border-bottom:none;" class="card-header">
                <h3 class="card-title">  Filter &nbsp &nbsp </h3> 
				<select class="form-control filter_user select2">
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
		  
		  <div class="row pb-4">
		  
		    <div class="col-md-1">
			</div>
          <div class="col-md-5">
        
          <div class="card card-primary card-outline">
		  
		  <div class="card-header border-bottom-0 mb-0 pb-0 mt-0 pt-0 ">
              
                <div  class="card-tools mt-0 pt-0">
                 <p> &nbsp </p>
                </div>
              </div>
		   
              <div class="card-body">
                <div id="bar-chart" style="height: 204px;"></div>
              </div>
              <!-- /.card-body-->
            </div>

          </div>
          <!-- /.col -->

          <div class="col-md-5">
            <!-- Bar chart -->
			<div  class="card card-primary card-outline">
				 
				 <div style="border: 1px solid gray;
					border-style: dashed;
					width: 93%;
					MARGIN: 15PX;
				HEIGHT: 254PX;"  class="in-border">
			
				 <div  class="card-header border-bottom-0 mb-0 pb-0 mt-0 pt-0 ">
              
                <div style="margin-right: -1rem !important;" class="card-tools mt-0 pt-0">
                 <p style="color:white;background:#DD0334;padding: 2px 5px 2px 5px;"> 2018 </p>
                </div>
              </div>
             
             
               
              <div style="padding: 0.25rem;" class="card-body">
                <div class="n_emils">
				
				<i class="fa fa-share-alt mb-1" aria-hidden="true"></i>
				<p style="font-family: Overpass;font-weight: normal;" class="mt-2 mb-0"> Total Number Of Social Share </p>
				<p class="mb-0" style="font-size: 30px;"> <b>1805</b> </p>
				</div>
              </div>
              <!-- /.card-body-->
            </div>
			 </div>
          
          </div>
          <!-- /.col -->
        </div>
		  
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
					  <th class="check-add">                     
                        <input type="checkbox"> 
                      </th>
                      <th class="text-left">Author</th>
                      <th class="text-left">Categories</th>
                      <th class="text-left">Share Post</th>
                      <th class="text-left">Comments</th>
                      <th class="text-left">Date</th>
                      <th class="text-left">Social Media</th>
                      <th class="text-left">View</th>
                      <th class="text-left">Remove</th>
                    </tr>	
                  </thead>
                  <tbody>
                    <tr>
					  <td class="check-add"> <input type="checkbox"></td>
                      <td class="text-left">Abbie</td>
                      <td class="text-left">Music</td>
                      <td class="text-left">Music</td>
                      <td class="text-left">Lorem Ipsum is simply ....</td>
                      <td class="text-left">2Jan2018</td>
                      <td class="text-center"><i class="fa fa-facebook" aria-hidden="true"></i></td>
                      <td class="text-center"><i class="fa fa-search" aria-hidden="true"></i></td>
                      <td class="text-center"><i class="fa fa-trash-o" aria-hidden="true"></i></td>
                    </tr>
                 <tr>
					  <td class="check-add"> <input type="checkbox"></td>
                      <td class="text-left">Abbie</td>
                      <td class="text-left">Music</td>
                      <td class="text-left">Music</td>
                      <td class="text-left">Lorem Ipsum is simply ....</td>
                      <td class="text-left">2Jan2018</td>
                      <td class="text-center"><i class="fa fa-twitter" aria-hidden="true"></i></td>
                      <td class="text-center"><i class="fa fa-search" aria-hidden="true"></i></td>
                      <td class="text-center"><i class="fa fa-trash-o" aria-hidden="true"></i></td>
                    </tr>
                    <tr>
					  <td class="check-add"> <input type="checkbox"></td>
                      <td class="text-left">Abbie</td>
                      <td class="text-left">Music</td>
                      <td class="text-left">Music</td>
                      <td class="text-left">Lorem Ipsum is simply ....</td>
                      <td class="text-left">2Jan2018</td>
                      <td class="text-center"><i class="fa fa-linkedin" aria-hidden="true"></i></td>
                      <td class="text-center"><i class="fa fa-search" aria-hidden="true"></i></td>
                      <td class="text-center"><i class="fa fa-trash-o" aria-hidden="true"></i></td>
                    </tr>
                   <tr>
					  <td class="check-add"> <input type="checkbox"></td>
                      <td class="text-left">Abbie</td>
                      <td class="text-left">Music</td>
                      <td class="text-left">Music</td>
                      <td class="text-left">Lorem Ipsum is simply ....</td>
                      <td class="text-left">2Jan2018</td>
                      <td class="text-center"><i class="fa fa-facebook" aria-hidden="true"></i></td>
                      <td class="text-center"><i class="fa fa-search" aria-hidden="true"></i></td>
                      <td class="text-center"><i class="fa fa-trash-o" aria-hidden="true"></i></td>
                    </tr>
					<tr>
					  <td class="check-add"> <input type="checkbox"></td>
                      <td class="text-left">Abbie</td>
                      <td class="text-left">Music</td>
                      <td class="text-left">Music</td>
                      <td class="text-left">Lorem Ipsum is simply ....</td>
                      <td class="text-left">2Jan2018</td>
                      <td class="text-center"><i class="fa fa-twitter" aria-hidden="true"></i></td>
                      <td class="text-center"><i class="fa fa-search" aria-hidden="true"></i></td>
                      <td class="text-center"><i class="fa fa-trash-o" aria-hidden="true"></i></td>
                    </tr>
					<tr>
					  <td class="check-add"> <input type="checkbox"></td>
                      <td class="text-left">Abbie</td>
                      <td class="text-left">Music</td>
                      <td class="text-left">Music</td>
                      <td class="text-left">Lorem Ipsum is simply ....</td>
                      <td class="text-left">2Jan2018</td>
                      <td class="text-center"><i class="fa fa-linkedin" aria-hidden="true"></i></td>
                      <td class="text-center"><i class="fa fa-search" aria-hidden="true"></i></td>
                      <td class="text-center"><i class="fa fa-trash-o" aria-hidden="true"></i></td>
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