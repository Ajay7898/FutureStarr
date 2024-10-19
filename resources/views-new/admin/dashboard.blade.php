@extends('admin.common')

@section('title', 'Dashboard')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header ch">
      <div class="container-fluid">
        <div class="row mb-2">
         
         
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content dashboard">	
           
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
		 <p class="dash-t">DASHBOARD</p>
        <div class="row pl-4 pb-4 pr-4">		
          <div class="col-lg-4 col-sm-12 col-md-6 pr-5">
            <!-- small box -->
            <div class="small-box bg-white text-dark text-center pt-4">
              <div class="inner">
			   <img src="{{ asset('assets/admin/dist/img/Layer 7.png') }}"  alt="User Image">
                <h3>{{ userCount() }}</h3>

                <p>Users Registered</p>
              </div>
             
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4 col-sm-12 col-md-6 pr-5">
            <!-- small box -->
            <div class="small-box bg-white text-dark text-center pt-3">
              <div class="inner">
			   <img src="{{ asset('assets/admin/dist/img/Layer 10.png') }}"  alt="User Image">
                <h3>500</h3>

                <p>Monthly Sales</p>
              </div>            
          
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4 col-sm-12 col-md-6 pr-5">
            <!-- small box -->
            <div class="small-box bg-white text-dark text-center pt-4">
              <div class="inner">
			   <img src="{{ asset('assets/admin/dist/img/Layer 9.png') }}"  alt="User Image">
                <h3>10,000</h3>

                <p>Receive Monthly Emails</p>
              </div>            
            
            </div>
          </div>
		  
		  
		  
		    <div class="col-lg-4 col-sm-12 col-md-6 pr-5">
            <!-- small box -->
            <div class="small-box bg-white text-dark text-center pt-2">
              <div class="inner">
			   <img src="{{ asset('assets/admin/dist/img/Layer 11.png') }}"  alt="User Image">
                <h3>8,000</h3>

                <p>Monthly Comments </p>
              </div>
             
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4 col-sm-12 col-md-6 pr-5">
            <!-- small box -->
            <div class="small-box bg-white text-dark text-center pt-3">
              <div class="inner">
			   <img src="{{ asset('assets/admin/dist/img/Layer 12 copy.png') }}"  alt="User Image">
                <h3>200</h3>

                <p>Signup Monthly</p>
              </div>            
          
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4 col-sm-12 col-md-6 pr-5">
            <!-- small box -->
            <div class="small-box bg-white text-dark text-center pt-4">
              <div class="inner">
			   <img src="{{ asset('assets/admin/dist/img/Layer 13.png') }}"  alt="User Image">
                <h3>12,000</h3>

                <p>Monthly Visitors</p>
              </div>            
            
            </div>
          </div>
         
        </div>
        <!-- /.row -->
        <!-- Main row -->
		
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  @endsection