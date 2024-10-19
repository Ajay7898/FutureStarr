<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductImage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$products = Product::all();
        return view('admin.product.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->all();
        $product = new Product;
        $product->name  =   $request->name;
        $product->product_info  =   $request->product_info;
        $product->description  =   $request->description;
        // $product->SKU  =   'SKU';
        $product->price  =   $request->price;
        $product->save();

        $product->sku    =  'P'.str_pad($product->id, 5, '0', STR_PAD_LEFT);
        $product->save();

        foreach ($request->gender as $genKey => $newGender) {
            if ($newGender == 'on') {
                foreach ($request->type as $typeKey => $newType) {
                    if ($newType == 'on') {
                        foreach ($request->color as $colorKey => $newColor) {
                            // if ($newColor == 'on') {
                                foreach ($request->size as $sizeKey => $newSize) {
                                    if ($newSize == 'on') {
                                        $variant = new ProductVariant;
                                        $variant->gender    =   $genKey;
                                        $variant->color     =   $colorKey;
                                        $variant->type      =   $typeKey;
                                        $variant->size      =   $sizeKey;
                                        $variant->product_id =  $product->id;

                                        $variant->save();

                                        $variant->sku       =   str_pad($product->id, 4, '0', STR_PAD_LEFT).'V'.str_pad($variant->id, 5, '0', STR_PAD_LEFT);;
                                        $variant->save();
                                    }
                                // }
                            }
                        }
                    }
                }
            }
        }
        
        return redirect('admin/product/media-upload');
         

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function mediaUpload(){
        return view('admin.product.upload-media');
    }


    public function mediaUploadStore(Request $request){
        // return $request->all();
        //  $request->validate([
        //     'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        // ]);
  
        $imageName = time().'.'.$request->file->extension();  
   
        $request->file->move(public_path('uploads/products'), $imageName);

        $image =  new ProductImage;
        $image->product_id  =   $request->product_id;
        $image->path        =   'uploads/products/'.$imageName;
        // $image->ext
        $image->save();

        return $image; 

    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $variations = $this->product_variant();
    	$product = Product::with('variants')->where('id',$id)->first();
        $var = [];
        foreach ($product->variants as $key => $variant) {
            if ($variant->status == 1) {
                $var['gender'][] = $variant->gender;
                $var['type'][] = $variant->type;
                $var['color'][] = $variant->color;
                $var['size'][] = $variant->size;
            }
        }

        if (!empty($var)) {
            $variants['gender'] = array_unique($var['gender']);
            $variants['type'] = array_unique($var['type']);
            $variants['color'] = array_unique($var['color']);
            $variants['size'] = array_unique($var['size']);
            // return $variants;
        }else{
            return redirect('admin/product');
        }

        return view('admin.product.edit',compact('product', 'variants', 'variations'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // return $request->all();
        $product = Product::where('id', $request->product_id)->first();
		$product->name = $request->name;
        $product->product_info = $request->product_info;
		$product->description = $request->description;
		$product->price = $request->price;
		$product->save();

	    $pr = ProductVariant::where('product_id', $product->id)
	    	->update([
	    		'status'	=>	0
	    	]);

	    foreach ($request->gender as $genKey => $newGender) {
            if ($newGender == 'on') {
                foreach ($request->type as $typeKey => $newType) {
                    if ($newType == 'on') {
                        foreach ($request->color as $colorKey => $newColor) {
                            // if ($newColor == 'on') {
                                foreach ($request->size as $sizeKey => $newSize) {
                                    if ($newSize == 'on') {
                                    	$variant = ProductVariant::where('gender', $genKey)
                                    		->where('gender', $genKey)
                                    		->where('color', $colorKey)
                                    		->where('type', $typeKey)
                                    		->where('size', $sizeKey)
                                    		->first();

                                		if ($variant == null) {
                                        	$variant = new ProductVariant;
                                        	$variant->product_id =  $product->id;
                                        }
                                        $variant->gender    =   $genKey;
                                        $variant->color     =   $colorKey;
                                        $variant->type      =   $typeKey;
                                        $variant->size      =   $sizeKey;
                                        $variant->status 	=	1;                                        
                                        $variant->save();

                                        $variant->sku       =   str_pad($product->id, 4, '0', STR_PAD_LEFT).'V'.str_pad($variant->id, 5, '0', STR_PAD_LEFT);;
                                        $variant->save();
                                    }
                                // }
                            }
                        }
                    }
                }
            }
        }
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {    	
    	Product::Where('id',$id)->delete();
    	return view('admin.product.index');        
    }



    public function publish(Request $request){
        $product = Product::find($request->id);
        $product->is_publish = $request->publish == 'true' ? true : false;
        $product->save();
        return $product;
    }


    public function product_variant(){
        return [
            "gender" => [
                "male",
                "female"
            ],
            "type" => [
                "round_neck",
                "v_neck"
            ],
            "color" => [
                "#000000",
                "#ffffff"
            ],
            "size" => [
                "s",
                "m",
                "l",
                "xl",
                "xxl"
            ]
        ];
    }
}


        // return [
        //     "gender" => [
        //         "male" => 0,
        //         "female"  => 0
        //     ],
        //     "type" => [
        //         "round_neck"  => 0,
        //         "v_neck"  => 0
        //     ],
        //     "color" => [
        //         "#000000"  => 0,
        //         "#ffffff"  => 0
        //     ],
        //     "size" => [
        //         "s"  => 0,
        //         "m"  => 0,
        //         "l"  => 0,
        //         "xl"  => 0,
        //         "xxl"  => 0
        //     ]
        // ];