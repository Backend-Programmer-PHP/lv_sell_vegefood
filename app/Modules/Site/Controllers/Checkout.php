<?php
namespace App\Modules\Site\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use App\Http\Controllers\Controller;
use App\Modules\Site\Models\Region_Model;
use App\Modules\Site\Models\Cart_Model;
use App\Modules\Site\Models\Order_Model;
use App\Modules\Site\Requests\CheckoutRequest;
use App\Notifications\OffersNotification;
use App\Mail\MailCheckout;
use App\Models\User;

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
        $order->save();
        //dd($order->id);
        Cart_Model::where(['users_id' => auth()->user()->id, 'orders_id' => 0])
                ->update(['orders_id' => $order->id]);
        request()->session()->flash('success', 'Your product successfully placed in order');
        $userSchema = User::find(auth()->user()->id);
        // Mail::to($request->email)->send(new MailCheckout($order->id));
        // Mail::to($userSchema)->send(new MailCheckout($order->id));
        $details = [
            'title' => 'New order created',
            'actionURL' => route('order.show', $order->id),
            'photo' => 'https://dietmoibachkhoa24h.com/wp-content/uploads/2020/01/cart-icon.png',
            'content' => 'Thank you for your support.!'
        ];
        Notification::send($userSchema, new OffersNotification($details));
        return back();
    }
    // show orders:
    public function showCheckout($id) {
        $order = Order_Model::findOrFail($id);
        return view('Dashboard::components.order.show')->with('order', $order);
    }
}
