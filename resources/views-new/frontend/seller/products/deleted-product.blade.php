@extends('layouts.seller') @section('content')
<div id="seller-header">
	<div id="sub-header" class="container-fluid" >
		<div class="row">
			<div class="col-sm-12 top-cls top-cls-l"></div>
		</div>
	</div>
</div>
<!--SideBar-Start---->
<section class="buyer-con-section">
	<div class="container">
		<div class="row">
			@include('frontend.sidebar.seller')
			<div class="col-md-8 col-sm-8 col-xs-12">
				<div class="buyer-form commercial-sec deleted">
					<div class="row">
		              <div class="col-md-6">
		                  <h4>Deleted Items</h4>
		              </div>
		              <div class="col-md-6">
		                <a href="{{route('seller.index')}}" class="pull-right back-btn seller-graph-back-btn" title="Go Back"><i class="ti-arrow-left" aria-hidden="true"></i></a>
		              </div>
                    </div>
					<div class="row">
						@if(count($talents) == 0 )
		                  @php $class = 'talent_list'; @endphp
		                @endif
						@if(count($talents)> 0)
						<div class="col-md-12 col-sm-12 col-xs-12">
							<div class="dash-box-sec table-sec-btn">
								<div class="filter-n-btn-sec">
									Filter
									<select class="form-control b-select" onchange="filterDeletedProducts(this)">
										<option value="">Default</option>
										<option value="30" <?php if(Request::segment(4) =='30') {echo 'selected';}?>>Last 30 Days</option>
										<option value="20" <?php if(Request::segment(4) =='20') {echo 'selected';}?>>Last 20 Days</option>
										<option value="10" <?php if(Request::segment(4) =='10') {echo 'selected';}?>>Last 10 Days</option>
									</select>
								</div>
								<div class="filter-n-btn-sec">
									<a href="javascript:void(0)" id="delete_records_undo"><i class="fa fa-undo" aria-hidden="true"></i> Undelete Item</a>
									<a href="javascript:void(0)" id="delete_records_permanently"><i class="fa fa-trash-o" aria-hidden="true"></i> Trash Completely</a>
								</div>
							</div>
							<div class="dash-box-sec commercila tabs-n">
								<div class="img-box-tab">
									<div class="table-data">
										<div class="table-responsive">
											<table class="table table-striped">
												<thead>
													<tr>
														<th><input type="checkbox" name="vehicle1" value="" id="select_all" style="display: block !important;"></th>
														<th>Product</th>
														<th></th>
														<th></th>
														<th></th>
														<th></th>
														<th></th>
														<th></th>
														<th></th>
													</tr>
												</thead>
												<tbody>
													
													@foreach($talents as $talent)
													@php 
													$urlToShare = route('talent.productInfo',$talent->id);
													if(file_exists($talent->getCommercila['image_path'])) {
														$allowedMimeTypes = ['image/jpeg','image/gif','image/png','image/bmp','image/svg+xml'];
														$contentType = mime_content_type($talent->getCommercila['image_path']);

														if(! in_array($contentType, $allowedMimeTypes) ){
														$productImage= 'assets/images/star-logo.png'; 

												} else {
												$productImage= $talent->getCommercila['image_path']; 
											}
											 } else {
                                       $productImage= 'assets/images/star-logo.png'; 
                                  }
											@endphp
											<tr>
												<td><input type="checkbox" name="products" value="{{$talent->id}}" class="emp_checkbox" data-emp-id="{{$talent->id}}"></td>
												<td class="img-sec"><img src="{{ asset($productImage)}}" alt="productImage"></td>
												<td><span>{{$talent->title}}</span></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td class="product-sell"></td>
											</tr>
											@endforeach
										


										</tbody>
									</table>
									<div class="pagination-n">
										{!! $talents->render() !!}
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				 @else
                <div class="col-md-12 col-sm-12 col-xs-12 {{$class}}">
                  
                 
             </div>
             @endif
			</div>
		</div>
	</div>
</div>
</section>
<!-- all models -->
@include('frontend.talent.login')
<a class="scroll-top-arrow" href="javascript:void(0);"><i  class="ti-arrow-up"></i></a>
@endsection