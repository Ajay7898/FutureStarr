@extends('backend.admin.common')

@section('content')
      <div class="content">
        <div class="container-fluid">
          <div class="row">
             <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-warning card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">store</i>
                  </div>
                  <p class="card-category">Divison officer's</p>
                  <h3 class="card-title">{{ allUsersByRoleCount(2) }}</h3>
                </div>
                <div class="card-footer">
                  <!-- <div class="stats">
                    <i class="material-icons">date_range</i> Last 24 Hours
                  </div> -->
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-success card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">store</i>
                  </div>
                  <p class="card-category">Sub-divison officer's</p>
                  <h3 class="card-title">{{ allUsersByRoleCount('3') }}</h3>
                </div>
                <div class="card-footer">
                  <!-- <div class="stats">
                    <i class="material-icons">date_range</i> Last 24 Hours
                  </div> -->
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-danger card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">info_outline</i>
                  </div>
                  <p class="card-category">Customers</p>
                  <h3 class="card-title">{{ allUsersByRoleCount('4') }}</h3>
                </div>
                <div class="card-footer">
                  
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-info card-header-icon">
                  <div class="card-icon">
                    <i class="fa fa-inr"></i>
                  </div>
                  <p class="card-category">Total Transactions</p>
                  <h3 class="card-title">{{ totalTransactions() }}</h3>
                </div>
                <div class="card-footer">
                 
                </div>
              </div>
            </div> 
            
            <div class="col-lg-9 col-md-9 col-sm-9">
              <div class="card card-stats">
                <div class="card-header card-header-info card-header-icon">
                  <div class="card-icon">
                    <i class="fa fa-inr"></i>
                  </div>
                  @php $payments = payemtnHistory() @endphp

                  <p class="card-category">Recent Transactions</p>
                  <h3 class="card-title">Last 10 Transactions </h3>
                </div>
                <div class="card-footer">
                  <div class="table-responsive">

                  @if(count($payments) > 0)
                  <table class="table">
                    <thead class=" text-primary">  
                        <th>S.No</th>
                        <th>H.O.F</th>
                        <th>Officer Email</th>
                        <th>Transaction Id</th>
                        <th>Amount</th>
                        <th>Healthcard No</th>
                        <th>Transaction Status</th> 
                        <th>Created At</th>
                      </thead>
                      <tbody> 
                        @if(!empty($payments))
                         @foreach($payments as $key => $payments)

                          <tr>
                            <td class="text-warning">#{{$key+1}}</td>
                            <td>{{$payments->firstname}}</td>
                            <td>{{$payments->email}}</td>
                            <td>{{$payments->txnid}}</td>
                            @if($payments->status == 'Completed')
                                <td class="text-success"><i class="fa fa-inr"></i> {{$payments->amount}}</td>
                            @else
                                <td class="text-danger"><i class="fa fa-inr"></i> {{$payments->amount}}</td>
                            @endif
                            <td>
                            <?php  
                            if($payments->status == 'Completed'){
                              echo $payments->unique_number;
                            }
                            else
                            {
                              echo '-';
                            }
                            ?>
                            </td>
                            @if($payments->status == 'Completed')
                              <td class="text-success">{{$payments->status}}</td>
                            @else
                              <td class="text-danger">{{$payments->status}}</td>
                            @endif
                            <td>{{ Carbon\Carbon::parse($payments->created_at)->format('M d, Y') }}</td>
                           </tr>
                          @endforeach
                        @endif 
                        
                      </tbody>
                    </table> 
                    @else
                    <h3 class="text-center text-danger">No record available.</h3>
                    @endif
                  </div>

                </div>
              </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-info card-header-icon">
                  <div class="card-icon">
                    <i class="fa fa-inr"></i>
                  </div>
                  <p class="card-category">Total Budget Collected</p>
                  <h3 class="card-title">{{ totalBudget() }}</h3>
                </div>
                <div class="card-footer">
                  <h4 class="text-success">Success - {{ totalSuccessTransactions() }}</h4>
                  <h4 class="text-danger">Failure - {{ totalFailedTransactions() }}</h4>
                 </div>
              </div>
            </div>



          </div>
        </div>
      </div>
      <script type="text/javascript">
        $(document).ready(function () {
          $('#dtBasicExample').DataTable();
          $('.dataTables_length').addClass('bs-select');
        });
      </script>
@endsection