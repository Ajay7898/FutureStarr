<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TalentCatagory;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductImage;
use App\Models\ShippingType;
use App\Models\CartProduct;
use App\Models\UserAddress;
use App\Models\Cart;
use Auth;
use DB;

class TShirtProductController extends Controller
{
	public function show()
    {
        $var = [];
        $product = Product::with('variants')->find(1);
        // return $product->variants;
        foreach ($product->variants as $key => $variant) {
            if ($variant->status == 1) {
                $var['gender'][] = $variant->gender;
                $var['type'][] = $variant->type;
                $var['color'][] = $variant->color;
                $var['size'][] = $variant->size;
            }            
        }

        $variant['gender'] = array_unique($var['gender']);
        $variant['type'] = array_unique($var['type']);
        $variant['color'] = array_unique($var['color']);
        $variant['size'] = array_unique($var['size']);

        return view('frontend.buyer.t-shirt.t-shirt-show', compact('product', 'variant'));
    }


    public function tShirtAddToCart(Request $request)
    {

        $validator = $request->validate([
            'gender' => 'required',
            'color' => 'required',
            'neck' => 'required',
            'size' => 'required',
        ]);

    	$product = Product::where('id', $request->slug)->first();
    	$variant = ProductVariant::where('product_id', $product->id)
    			->where('gender', $request->gender)	
    			->where('color', $request->color)	
    			->where('type', $request->neck)	
    			->where('size', $request->size)	
    			->first();

    	$cart = Cart::where('user_id', Auth::id())->whereNull('status')->first();
        if ($cart == null) {
        	$cart = new Cart;
        	$cart->user_id 	=	Auth::id();
        	$cart->save();
        }

        $cart_product = CartProduct::Where('cart_id', $cart->id)
        				->where('sku', $variant->sku)
        				->first();                        
		if ($cart_product == null) {
			$cart_product = new CartProduct;
	        $cart_product->cart_id		=	$cart->id;
	        $cart_product->product_id	=	$product->id;	
	        $cart_product->sku			=	$variant->sku;
	        $cart_product->price		=	$product->price;
            $cart_product->save();
		}

		$subtotal = CartProduct::Where('cart_id', $cart->id)->get()->pluck('price')->sum();
        
        $shipping = ShippingType::find(1);
		$cart->subtotal 	=	$subtotal;
		$cart->total 		=	$subtotal + $shipping->price + round($cart->subtotal * 0.04, 2);
		$cart->shipping 	=	$shipping->price;
		$cart->tax 			=	round($cart->subtotal * 0.04, 2);
		$cart->shipping_id 	=	$shipping->id;
		$cart->save();

        return $subtotal;
    }


    public function tShirtCheckoutShow(){
    	$shipping = ShippingType::all();
    	$cart = Cart::with('cart_products', 'billing_address', 'shipping_address')
                ->where('user_id', Auth::id())->whereNull('status')->first();
        // $address = 
                // return $cart;
    	$variants = ProductVariant::whereIn('sku', $cart->cart_products->pluck('sku'))->get();

    	return view('frontend.buyer.t-shirt.t-shirt-checkout', compact('cart', 'shipping', 'variants'));
    }


    public function changeShipping(Request $request){
        $shipping = ShippingType::all();
        $set_shipping = ShippingType::find($request->sid);

        $cart = Cart::where('user_id', Auth::id())->whereNull('status')->first();

        $cart->total        =   $cart->subtotal + $set_shipping->price + round($cart->subtotal * 0.04, 2);
        $cart->shipping     =   $set_shipping->price;
        $cart->tax          =   round($cart->subtotal * 0.04, 2);
        $cart->shipping_id  =   $set_shipping->id;
        $cart->save();

        return view('frontend.buyer.t-shirt.checkout-shipping-render', compact('cart', 'shipping'))->render();
    }


    public function removeCartProduct(Request $request){
        $cart = Cart::where('user_id', Auth::id())->whereNull('status')->first();
        $shipping = ShippingType::all();

        $cart_product = CartProduct::Where('cart_id', $cart->id)
                        ->where('sku', $request->sku)
                        ->delete();

        $subtotal = CartProduct::Where('cart_id', $cart->id)->get()->pluck('price')->sum();
        
        $cart->subtotal =   $subtotal;                
        $cart->total    =   $subtotal + $cart->shipping + round($cart->subtotal * 0.04, 2);
        $cart->tax      =   round($cart->subtotal * 0.04, 2);
        $cart->save();

        return view('frontend.buyer.t-shirt.checkout-shipping-render', compact('cart', 'shipping'))->render();
    }


    public function saveShippingAddress(Request $request){

        $address = UserAddress::Where('user_id', Auth::id())->where('address_type', 'shipping')->first();
        if ($address == null) {
            $address = new UserAddress;
            $address->user_id   =   Auth::id();
        }
        $address->name          =   $request->name;
        $address->phone         =   $request->phone;
        $address->address       =   $request->address;
        $address->street        =   $request->street;
        $address->city          =   $request->city;
        $address->state         =   $request->state;
        $address->country       =   $request->country;
        $address->zipcode       =   $request->zipcode;
        $address->address_type  =   'shipping';
        $address->save();

        $cart = Cart::where('user_id', Auth::id())->whereNull('status')->first();
        $cart->ship_addr_id =   $address->id;
        $cart->save();

        return view('frontend.buyer.t-shirt.change-addr-render', compact('address'))->render();

    }

    public function saveBillingAddress(Request $request){
        $address = UserAddress::Where('user_id', Auth::id())->where('address_type', 'billing')->first();
        if ($address == null) {
            $address = new UserAddress;
            $address->user_id   =   Auth::id();
        }
        $address->name          =   $request->name;
        $address->phone         =   $request->phone;
        $address->address       =   $request->address;
        $address->street        =   $request->street;
        $address->city          =   $request->city;
        $address->state         =   $request->state;
        $address->country       =   $request->country;
        $address->zipcode       =   $request->zipcode;
        $address->address_type  =   'billing';
        $address->save();

        $cart = Cart::where('user_id', Auth::id())->whereNull('status')->first();
        $cart->bill_addr_id =   $address->id;
        $cart->save();


        return view('frontend.buyer.t-shirt.change-addr-render', compact('address'))->render();
    }

}