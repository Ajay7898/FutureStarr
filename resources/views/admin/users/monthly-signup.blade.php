@extends('admin.common')

@section('title', 'Monthly Signup')

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
            <!-- general form elements disabled -->
            @php $months = Config::get('constants.months'); @endphp

            <!-- /.card-header -->
            <div style="border-bottom:none;" class="card-header">
              <select class="form-control filter_user_cal" id="filter-records" data-url="{{ route('admin.monthly-signup') }}">
                @if(count($months) > 0)
                  @foreach($months as $key => $value)
                       @if($current_month == $value) 
                          @php $selected = "selected";  @endphp
                       @elseif(!empty($filter) && $filter == $key)
                          @php $selected = "selected";  @endphp
                       @else
                          @php $selected = "";  @endphp
                       @endif  
                      <option value="{{ $key}}-{{ $value }}" {{ $selected }} >{{ $value }} {{ $current_year }}</option>
                  @endforeach
                @endif
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
              <i class="fa fa-user" aria-hidden="true"></i> <b>{{ count($users) }}</b> User Signup In {{ $current_month ?: '' }}
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
                <th class="text-left">Username</th>
                <th class="text-left">Name</th>
                <th class="text-left">Email</th>
                <th class="text-left">Role</th>
                <th class="text-left">Approve or <br/> Disapprove post</th>
                <th class="text-left">User ID</th>
                <th class="text-left">Date</th>
              </tr>	
            </thead>
            <tbody>
              @if(count($users) > 0)
               @foreach($users as $user)
                  <tr>
                      <td class="text-left">{{ $user->username ?? "---" }}</td>
                      <td class="text-left">{{ $user->first_name ?? "---" }}&nbsp;{{ $user->last_name ?? "---" }}</td>
                      <td class="text-left">{{ $user->email ?? "---"}}</td>
                      <td class="text-left"><span class="tag tag-success">{{ $user->getUserRole['name'] ?? "---" }}</span></td>
                      <td class="text-left">{{ $user->email_verified ?? "" }}</td>
                      <td class="text-left">{{ $user->id ?? "" }}</td>
                      <td class="text-left">{{  \Carbon\Carbon::parse($user->created_at)->format('d, M Y') }}</td>
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