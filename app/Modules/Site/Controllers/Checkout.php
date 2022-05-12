<?php
namespace App\Modules\Site\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Modules\Site\Models\Region_Model;
use App\Modules\Site\Models\Cart_Model;
use App\Modules\Site\Models\Order_Model;
use App\Modules\Site\Requests\CheckoutRequest;

class Checkout extends Controller {
    public function getCheckout() {
        $carts = Cart_Model::select('products.*','carts.price as carts_price',
            'carts.quantity as carts_quantity','carts.amount','carts.id as carts_id')
            ->join('products','carts.products_id','products.id')
            ->where('orders_id', 0)
            ->where('users_id', Auth::user()->id)
            ->orderBy('id','DESC')
            ->get();
        $regions = Region_Model::select('region.id','region.title')
            ->get();
        return view('Site::orders.checkout',[
            'carts' => $carts,
            'regions' => $regions
        ]);
    }
    // [POST]Save order information and advance orders
    public function postBillingOrder(CheckoutRequest $request) {
        if(empty(Cart_Model::where(['users_id' => auth()->user()->id, 'orders_id' => 0])->first())) {
            request()->session()->flash('error', 'Cart is Empty !');
            return back();
        }
        $order = new Order_Model();
        $order->order_number = 'ORD-' . strtoupper(Str::random(10));
        $order->users_id     = auth()->user()->id;
        $order->city_id      = $request->city_id;
        $order->region_id    = $request->region_id;
        $order->sub_total    = $request->sub_total;
        $order->coupon       = $request->coupon;
        $order->total_amount = $request->total;
        $order->quantity     = $request->quantity;
        $order->shipping     = $request->shipping;
        $order->first_name   = $request->first_name;
        $order->last_name    = $request->last_name;
        $order->email        = $request->email;
        $order->phone        = $request->phone;
        $order->address      = $request->address;
        if (request('status') == 'new') {
            $order->status = 'new';
        } else {
            $order->status = 'cancel';
        }
        if($order->save()) {
            Cart_Model::where(['users_id' => auth()->user()->id, 'orders_id' => 0])
                ->update(['orders_id' => $order->id]);
            request()->session()->flash('success', 'Your product successfully placed in order');
            return back();
        }
    }
}
