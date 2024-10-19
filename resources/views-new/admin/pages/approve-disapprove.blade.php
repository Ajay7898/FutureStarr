@extends('admin.common')

@section('title', 'Approve/Disapprove Products')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<div class="content-header ch users_monthly_signup approve_disapprove">
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
				<h3 class="card-title">@yield('title')</h3>
			</div>
			<!-- /.card-header -->

			<div class="card">
				<div class="row">
					<div class="col-sm-3 col-md-3">
                    @php $months = Config::get('constants.months'); @endphp

						<!-- form start -->
						<div style="border-bottom:none;" class="card-header">
							<h3 class="card-title">  Filter &nbsp &nbsp </h3> 
							<select class="form-control filter_user" id="filter-records" data-url="{{ route('admin.pages') }}">
								
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
						</div>

					</div>

					<div class="col-sm-3 col-md-6 pr-0 cal">
						<!-- general form elements disabled -->

						<!-- /.card-header -->
						<div style="border-bottom:none;" class="card-header">

							<!-- /.card-body -->
						</div>
						<!-- /.card -->

						<!-- /.card -->
					</div>

					<div class="col-sm-6 col-md-3 pl-0 cou">
						<!-- general form elements disabled -->

						<!-- /.card-header -->
						<div style="border-bottom:none;" class="card-header">
							<button id="delete_records" style="float:right;" type="button" class="btn btn-primary sp"><i class="fa fa-trash-o" aria-hidden="true"></i> MASS DELETE</button>   
							<input type="hidden" name="bulk_del_url" id="bulk_del_url" value="{{ route('talent.bulk.delete') }}" >
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
									 <input type="checkbox" name="emp_checkbox" id="select_all" style="display: block !important;">
								</th>
								<th class="text-left pb-4">Username</th>
								<th class="text-left pb-4">New Product</th>
								<th class="text-left">Approve or<br/>Disapprove
								</th>
								<th class="text-left"></th>
								<th class="text-left"></th>
								<th class="text-center pb-4">View</th>
								<th class="text-center pb-4">Remove</th>
							</tr>	
						</thead>
						<tbody>
						 @if(count($talents) > 0)
						   @foreach($talents as $talent)
                             @if($talent->approved == '1') 
                                @php $_variable = 'Approved' @endphp 
                             @else
                                @php $_variable = 'Disapproved'; @endphp
                             @endif
							<tr>
								<td class="check-add">
								   <input type="checkbox" id="blog-{{ $talent->id }}" name="products" value="{{ $talent->id }}" class="emp_checkbox" data-emp-id="{{ $talent->id }}"> 
								</td>
								<td class="text-left">{{ $talent->user['first_name'] ?? "" }}&nbsp;{{ $talent->user['last_name'] ?? "" }}</td>
								<td class="text-left">{{ $talent->getTalentCategories['name'] ?? "" }}</td>
								<td class="text-left">{{ $_variable ?? "" }}</td>
								<td class="text-left"> 

									<button  class="btn btn-primary sp approve_disapprove_yes" type="button"  data-toggle="modal" data-target="#myModal-{{ $talent->id }}"> Yes</button> &nbsp; &nbsp;

                                    <button type="button" data-toggle="modal" data-target="#myModal{{ $talent->id }}" class="btn btn-primary sp approve_disapprove_no"> No</button>

									<!-- Modal -->
									<div class="modal fade" id="myModal-{{ $talent->id }}" role="dialog">
										<div class="modal-dialog pt-20">

											<!-- Modal content-->
											<div class="modal-content">
												<div class="modal-header">
												<h4 class="modal-title">Approve/Disapprove Product {{$talent->name}}</h4>
												</div>
												<div class="modal-body">
													<p class="text-center">Are you sure you want to approve this product.<br/><br/>

														<button  class="btn btn-primary sp approve_disapprove_yes" type="button"  data-toggle="modal" data-url="{{ route('admin.talent.store') }}" id="yes-{{ $talent->id }}" data-id="{{ $talent->id }}" data-name="yes-"> Yes</button> 

                                                        <button class="btn btn-primary sp approve_disapprove_yes loader" type="button" disabled style="display: none;">
														  <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
														  Loading...
														</button>

														<button type="button" data-toggle="modal" data-target="#myModal-{{ $talent->id }}" class="btn btn-primary sp approve_disapprove_no" id="No-{{ $talent->id }}" data-name="No-"> No</button>
                                                         
														<br/><br/>
													</p>
												</div>
											</div>
										</div>
									</div>
								</td>
								<td class="text-left"></td>
								<td class="text-center"><i class="fa fa-search" aria-hidden="true"></i></td>
								<td class="text-center">
								  <a href="javascript:void(0)" title="DELETE PRODUCT" id="delete-{{ $talent->id }}" data-url="{{ route('admin.talent.delete' ,$talent->id) }}">
									<i style="color:  #FF503F !important;" class="fa fa-trash-o" aria-hidden="true"></i>
								  </a>
								</td>
							</tr>
						   @endforeach
						  @endif
						</tbody>
					</table>
					<div class="card-footer clearfix">
						<ul class="pagination pagination-sm m-0 float-right">
							{!! $talents->render()  !!}
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




