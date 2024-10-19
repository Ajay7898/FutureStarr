@extends('admin.common')

@section('title', 'Create Product')

@section('content')
	<section class="content-wrapper">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<form method="post" action="{{ route('admin.product.store') }}" style="background: #ffffff; padding: 30px;">
						@csrf
						<div class="form-group">
							<label>Product Name</label>
							<input type="text" name="name" placeholder="Product Name" class="form-control">
						</div>
						<div class="form-group">
							<label>Product Info</label>
							<input type="text" name="product_info" placeholder="Product Info" class="form-control">
						</div>
						<div class="form-group">
							<label>Product Description</label>
							<input type="text" name="description" placeholder="Product Description" class="form-control">
						</div>
						<div class="form-group">
							<label>Price</label>
							<input type="text" name="price" placeholder="Product Price" class="form-control">
						</div>
						{{-- Start Gender --}}
						<div class="form-group">
							<label>Select Gender</label>
							<div style="display: block;">
								<div class="col-md-2 form-check-inline">
								    <input type="checkbox" class="form-check-input" id="male" name="gender[male]">
								    <label class="form-check-label" for="male">Male</label>
								</div>
								<div class="col-md-2 form-check-inline">
								    <input type="checkbox" class="form-check-input" id="female" name="gender[female]">
								    <label class="form-check-label" for="female">Female</label>
								</div>
							</div>
						</div>
						{{-- End Gender --}}
						<div class="form-group">
							<label>Select Neck Type</label>							
							<div style="display: block;">
								<div class="col-md-2 form-check-inline">
								    <input type="checkbox" name="type[round_neck]" class="form-check-input" id="round_neck">
								    <label class="form-check-label" for="round_neck">Round Neck</label>
								</div>
								<div class="col-md-2 form-check-inline">
								    <input type="checkbox" class="form-check-input" name="type[v_neck]" id="v_neck">
								    <label class="form-check-label" for="v_neck">V Neck</label>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label>Select Color</label> <button type="button" class="add-color btn btn-info btn-sm">Add Color</button>
							<div class="color-code-group" style="display: block;">
								<div class="col-md-2 form-check-inline">
								    <input type="color" class="change-color" name="color[#000000]" value="#000000"/>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label>Select Size</label>
							<div style="display: block;">
								<div class="col-md-1 form-check-inline">
								    <input type="checkbox" class="form-check-input" name="size[s]" id="s">
								    <label class="form-check-label" for="s">S</label>
								</div>
								<div class="col-md-1 form-check-inline">
								    <input type="checkbox" class="form-check-input" name="size[m]" id="m">
								    <label class="form-check-label" for="m">M</label>
								</div>
								<div class="col-md-1 form-check-inline">
								    <input type="checkbox" class="form-check-input" name="size[l]" id="l">
								    <label class="form-check-label" for="l">L</label>
								</div>
								<div class="col-md-1 form-check-inline">
								    <input type="checkbox" class="form-check-input" name="size[xl]" id="xl">
								    <label class="form-check-label" for="xl">XL</label>
								</div>
								<div class="col-md-1 form-check-inline">
								    <input type="checkbox" class="form-check-input" name="size[xxl]" id="xxl">
								    <label class="form-check-label" for="xxl">XXL</label>
								</div>
							</div>
						</div>
						<div class="form-group">
							<button style="margin-left: auto; display: block;" type="submit" class="btn btn-primary">Save Product</button>
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
				console.log('logiiiii');
				console.log(jQuery(this).val())
				jQuery(this).attr('name', 'color['+jQuery(this).val()+']');	
				jQuery(this).attr('value', jQuery(this).val());			
			})

		})
	</script>

@endsection