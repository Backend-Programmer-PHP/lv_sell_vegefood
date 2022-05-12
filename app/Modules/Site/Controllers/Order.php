<?php
namespace App\Modules\Site\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Modules\Site\Models\Product_Model;
use App\Modules\Site\Models\Category_Model;
use App\Modules\Site\Models\Cart_Model;
use App\Modules\Site\Models\Coupon_Model;
use App\Modules\Site\Models\City_Model;
use App\Modules\Site\Models\Region_Model;

class Order extends Controller {
    // construct
    protected $product = null;
    public function __construct(Product_Model $product) {
        $this->product = $product;
    }
    public function index() {
        $carts = Cart_Model::select('products.*','carts.price as carts_price',
            'carts.quantity as carts_quantity','carts.amount','carts.id as carts_id')
            ->join('products','carts.products_id','products.id')
            ->where('orders_id', 0)
            ->where('users_id', Auth::user()->id)
            ->orderBy('id','DESC')
            ->get();
        $regions = Region_Model::select('region.id','region.title')
            ->get();
        return view('Site::orders.cart',[
            'carts' => $carts,
            'regions' => $regions,
        ]);
    }
    // Add a product to a cart:
    public function addToCart(Request $request) {
        $quant = $request->quantity;
        if(!$quant) {
            $quant = 1;
        }
        if (empty($request->slug)) {
            request()->session()->flash('error', 'Invalid Products');
            return back();
        }
        $product = Product_Model::where('slug', $request->slug)->first();
        // return $product;
        if (empty($product)) {
            request()->session()->flash('error', 'Invalid Products');
            return back();
        }
        $already_cart = Cart_Model::where('users_id', auth()->user()->id)
            ->where('orders_id', 0)
            ->where('products_id', $product->id)
            ->first();
        // return $already_cart;
        if ($already_cart) {
            //dd($already_cart);
            $already_cart->quantity = $already_cart->quantity + $quant;
            $already_cart->amount = $product->price + $already_cart->amount;
            // return $already_cart->quantity;
            $already_cart->save();
        } else {
            $cart = new Cart_Model;
            $cart->users_id = auth()->user()->id;
            $cart->products_id = $product->id;
            $cart->price = ($product->price - ($product->price * $product->discount) / 100);
            $cart->quantity = $quant;
            $cart->amount = $cart->price * $cart->quantity;
            //dd($product->stock);
            $cart->save();
            //$wishlist=Wishlist::where('user_id',auth()->user()->id)->where('cart_id',null)->update(['cart_id'=>$cart->id]);
        }
        request()->session()->flash('success', 'Product successfully added to cart');
        return back();
    }
    // Delete products in carts:
    public function deleteToCart(Request $request) {
        $cart = Cart_Model::find($request->id);
        if ($cart->delete()) {
            request()->session()->flash('success', 'Cart successfully removed');
            return back();
        }
        request()->session()->flash('error', 'Error please try again');
        return back();
    }
    //Update the number of products in the cart:
    public function updateToCart(Request $request) {
        //dd($request->quantity);
        if($request->quantity) {
            foreach($request->quantity as $position => $key) {
                $id = $request->cartId[$position];
                $cart = Cart_Model::find($id);
                if($key > 0 && $cart) {
                    $cart->quantity =  $key;
                    $after_price = ($cart->product->price - ($cart->product->price * $cart->product->discount) / 100);
                    $cart->amount = $after_price * $key;
                    $cart->save();
                }
            }
            return back()->with('success', 'Cart successfully updated!');
        } else {
            return back()->with('Cart Invalid!');
        }
    }
    // Apply coupon into orders
    public function applyCouponIntoOrders(Request $request) {
        $coupon = Coupon_Model::where('code', $request->code)
            ->where('status','active')
            ->where('updated_at','>=', now())
            ->first();
        if(!$coupon) {
            request()->session()->flash('error', 'Invalid coupon code, Please try again');
            return back();
        } else {
            $totalPrice = Cart_Model::where([
                'users_id' => Auth::user()->id,
                'orders_id' => 0
            ])->sum('price');
            session()->put('coupon', [
                'id' => $coupon->id,
                'code' => $coupon->code,
                'value' => $coupon->discount($totalPrice),
            ]);
            request()->session()->flash('success', 'Coupon successfully applied');
            return redirect()->back();
        }
    }
    // Filter ajax province, district, ward
    public function filterRegion(Request $request) {
        $region_id = $request->region;
        if($region_id) {
            $region = City_Model::select('id','title')
                ->where('region_id',$region_id)
                ->get();
            return response(['data' => $region]);
        }
    }
    // Estimate shipping and tax:
    public function estimateShippingCharges(Request $request) {
        $region = City_Model::select('region.*','city.id as city_id','city.title as city_title')
            ->join('region','city.region_id','region.id')
            ->where('region.id' , $request->region)
            ->where('city.id', $request->district)
            ->first();
        if(!$region) {
            request()->session()->flash('error', 'Invalid region, Please try again');
            return back();
        } else {
            switch($region->title) {
                case 'Hồ Chí Minh':
                    session()->put('region', [
                        'shipping' => 10,
                    ]);
                    break;
                case 'Hà Nội':
                    session()->put('region', [
                        'shipping' => 56,
                    ]);
                    break;
                case 'Đà Nẵng':
                    session()->put('region', [
                        'shipping' => 47,
                    ]);
                    break;
                default:
                    session()->put('region', [
                        'shipping' => 0,
                    ]);
                    break;
            }
            request()->session()->flash('success', 'Coupon successfully applied');
            return redirect()->back();
        }
    }
}
