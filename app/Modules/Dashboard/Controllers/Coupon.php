<?php
namespace App\Modules\Dashboard\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Modules\Dashboard\Models\Coupon_Model;
use App\Modules\Dashboard\Requests\CouponRequest;
use Intervention\Image\ImageManagerStatic as Image;

class Coupon extends Controller {

    public function index() {
        $coupons = Coupon_Model::select('*')
            ->orderBy('id','desc')
            ->paginate(10);
        return view("Dashboard::components.coupon.index",[
            'coupons' => $coupons,
        ]);
    }
    public function create() {
        return view("Dashboard::components.coupon.create");
    }
    public function store(CouponRequest $request) {
        $coupon = new Coupon_Model;
        $coupon->code = $request->code;
        $coupon->type = $request->type;
        $coupon->value = $request->value;
        $coupon->status = $request->status;
        $coupon->created_at = $request->createdAt;
        $coupon->updated_at = $request->updatedAt;
        if($coupon->save()) {
            request()->session()->flash('success', 'Coupon Successfully added');
        } else {
            request()->session()->flash('error', 'Please try again!!');
        }
        return redirect()->route('coupon.index');
    }
    public function edit($id) {
        if(Coupon_Model::find($id)) {
            return view('Dashboard::components.coupon.edit')->with('coupon', Coupon_Model::find($id));
        } else {
            return view('Dashboard::components.coupon.index')->with('error', 'Coupon not found');
        }
    }
    public function update(CouponRequest $request, $id) {
        $coupon = Coupon_Model::find($id);
        $coupon->code = $request->code;
        $coupon->type = $request->type;
        $coupon->value = $request->value;
        $coupon->status = $request->status;
        $coupon->created_at = empty($request->createdAt) ? date('m/d/Y') : $request->createdAt;
        $coupon->updated_at = empty($request->updatedAt) ? date('m/d/Y') : $request->updatedAt;
        if($coupon->save()) {
            request()->session()->flash('success', 'Coupon Successfully updated');
        } else {
            request()->session()->flash('error', 'Please try again!!');
        }
        return redirect()->route('coupon.index');
    }
    public function delete($id) {
        if(Coupon_Model::find($id)) {
            if(Coupon_Model::find($id)->delete()) {
                request()->session()->flash('success', 'Coupon successfully deleted');
            } else {
                request()->session()->flash('error', 'Error, Please try again');
            }
            return redirect()->route('coupon.index');
        } else {
            request()->session()->flash('error', 'Coupon not found');
            return redirect()->back();
        }
    }

}
