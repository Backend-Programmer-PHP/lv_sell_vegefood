<?php
namespace App\Modules\Site\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Modules\Site\Models\Banner_Model;
use App\Modules\Site\Models\Product_Model;
use App\Modules\Site\Models\Category_Model;

class Order extends Controller {
    public function index() {
        return view('Site::orders.cart');
    }
    public function getCheckout() {
        return view('Site::orders.checkout');
    }

}
