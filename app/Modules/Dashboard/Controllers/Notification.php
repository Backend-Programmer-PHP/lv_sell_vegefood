<?php
namespace App\Modules\Dashboard\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Modules\Dashboard\Models\Notification_Model;
use App\Modules\Dashboard\Models\Order_Model;

class Notification extends Controller {

    public function index() {
        return view("Dashboard::components.notification.index");
    }
    public function showNotification(Request $request) {
        $notification = Auth::user()->notifications
            ->where('id',$request->id)
            ->first();
        if($notification) {
            $notification->markAsRead();
            // return redirect($notification->data['actionURL']); // For user notifications
            // return view("Dashboard::components.notification.show",[
            //    'notification' => $notification
            // ]);
        }
    }
    public function delete($id) {
        $notification = Notification_Model::find($id);
        if ($notification) {
            if ($notification->delete()) {
                request()->session()->flash('success', 'Notification successfully deleted');
                return back();
            } else {
                request()->session()->flash('error', 'Error please try again');
                return back();
            }
        } else {
            request()->session()->flash('error', 'Notification not found');
            return back();
        }
    }
    // Tạm
    public function showOrder() {
        $order = Order_Model::findOrFail($id);
        return view('Dashboard::components.order.show')->with('order', $order);
    }
}
