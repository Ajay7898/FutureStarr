@extends('admin.common')

@section('title', 'Create Product')

@section('content')
	<section class="content-wrapper">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<a onclick="return confirm('Are you sure you want to delete this item?');" href="{{ route('admin.product.delete',$product['id']) }}" class="btn btn-primary" style="float: right; margin-top: 20px; margin-right: 30px;">Delete Product</a>
					<form method="post" action="{{ route('admin.product.update') }}" style="background: #ffffff; padding: 30px;">
						@csrf
						<div class="form-group">
							
							<input type="hidden" name="product_id" value="{{$product->id}}" class="form-control">
						</div>
						<div class="form-group">
							<label>Product Name</label>
							<input type="text" name="name" placeholder="Product Name" value="{{$product->name}}" class="form-control">
						</div>
						<div class="form-group">
							<label>Product Info</label>
							<input type="text" name="product_info" value="{{$product->product_info}}" placeholder="Product Info" class="form-control">
						</div>
						<div class="form-group">
							<label>Product Description</label>
							<input type="text" name="description" value="{{$product->description}}" placeholder="Product Description" class="form-control">
						</div>
						<div class="form-group">
							<label>Price</label>
							<input type="text" name="price" value="{{$product->price}}" placeholder="Product Price" class="form-control">
						</div>
						{{-- Start Gender --}}
						<div class="form-group">
							<label>Select Gender</label>
							<div style="display: block;">
								<?php $isVal = [] ?>								
								@foreach($variations['gender'] as $variation)
									@foreach($variants['gender'] as $variant)
										@if($variation == $variant)
											<div class="col-md-2 form-check-inline">
											    <input type="checkbox" class="form-check-input" id="{{$variation}}" name="gender[{{$variation}}]" checked>
											    <label class="form-check-label" for="{{$variation}}">{{ ucfirst($variation) }}</label>
											</div>
											<?php $isVal[] = $variation ?>
										@endif
									@endforeach
									@if(!in_array($variation, $isVal) )
										<div class="col-md-2 form-check-inline">
										    <input type="checkbox" class="form-check-input" id="{{$variation}}" name="gender[{{$variation}}]">
										    <label class="form-check-label" for="{{$variation}}">{{ ucfirst($variation) }}</label>
										</div>
										<?php $isVal[] = $variation ?>
									@endif
								@endforeach	
							</div>
						</div>
						{{-- End Gender --}}
						<div class="form-group">
							<label>Select Neck Type</label>							
							<div style="display: block;">
								<?php $isVal = [] ?>								
								@foreach($variations['type'] as $variation)
									@foreach($variants['type'] as $variant)
										@if($variation == $variant)
											<div class="col-md-2 form-check-inline">
											    <input type="checkbox" name="type[{{$variation}}]" class="form-check-input" id="{{$variation}}" checked>
											    <label class="form-check-label" for="{{$variation}}">{{ $variation }}</label>
											</div>
											<?php $isVal[] = $variation ?>
										@endif
									@endforeach
									@if(!in_array($variation, $isVal) )
										<div class="col-md-2 form-check-inline">
										    <input type="checkbox" name="type[{{$variation}}]" class="form-check-input" id="{{$variation}}">
										    <label class="form-check-label" for="{{$variation}}">{{ $variation }}</label>
										</div>
										<?php $isVal[] = $variation ?>
									@endif
								@endforeach	
							</div>
						</div>

						<div class="form-group">
							<label>Select Color</label> <button type="button" class="add-color btn btn-info btn-sm">Add Color</button>
							<div class="color-code-group" style="display: block;">
								@foreach($variants['color'] as $variant)
									<div class="col-md-2 form-check-inline">
									    <input type="color" class="change-color" name="color[{{$variant}}]" value="{{ $variant }}"/>
									</div>
								@endforeach
							</div>
						</div>

						<div class="form-group">
							<label>Select Size</label>
							<div style="display: block;">
								<?php $isVal = [] ?>								
								@foreach($variations['size'] as $variation)
									@foreach($variants['size'] as $variant)
										@if($variation == $variant)
											<div class="col-md-1 form-check-inline">
											    <input type="checkbox" class="form-check-input" name="size[{{$variation}}]" id="{{$variation}}" checked>
											    <label class="form-check-label" for="{{$variation}}">{{ strtoupper($variation) }}</label>
											</div>
											<?php $isVal[] = $variation ?>
										@endif
									@endforeach
									@if(!in_array($variation, $isVal) )
										<div class="col-md-1 form-check-inline">
										    <input type="checkbox" class="form-check-input" name="size[{{$variation}}]" id="{{$variation}}">
										    <label class="form-check-label" for="{{$variation}}">{{ strtoupper($variation) }}</label>
										</div>
										<?php $isVal[] = $variation ?>
									@endif
								@endforeach								
							</div>
						</div>
						<div class="form-group">
							<button style="margin-left: auto; display: block;" type="submit" class="btn btn-primary">Update Product</button>
						</div>
					</form>
				</div>	
			</div>
		</div>
	</section>
@endsection

@section('script')
	<script type="text/javascript">
		jQuery(document).ready(function(){
			jQuery(document).on('click', '.add-color', function(){
				console.log('logiiiii');
				html = 	'<div class="col-md-2 form-check-inline">'
				html +=		'<input type="color" class="change-color" name="color[#000000]" value="#000000"/>'
				html +=	'</div>'
				jQuery('.color-code-group').append(html);
			})
			jQuery(document).on('change', '.change-color', function(){
				jQuery(this).attr('name', 'color['+jQuery(this).val()+']');	
				jQuery(this).attr('value', jQuery(this).val());			
			})

		})
	</script>

@endsection