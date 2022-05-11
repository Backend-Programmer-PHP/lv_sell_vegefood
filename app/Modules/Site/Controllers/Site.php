<?php
namespace App\Modules\Site\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Modules\Site\Helpers\Helper;
use App\Modules\Site\Models\Banner_Model;
use App\Modules\Site\Models\Product_Model;
use App\Modules\Site\Models\Category_Model;


class Site extends Controller {

    public function index() {
        $banners = Banner_Model::where('status','on')
            ->orderBy('id','desc')
            ->get();
        $products = Product_Model::where('quantity','>=' , 0)
            ->orderBy('id','desc')
            ->limit(8)
            ->orderBy('id','desc')
            ->get();
        $categoryDesc = Category_Model::where('status','active')
            ->orderBy('id','desc')
            ->limit(2)
            ->get();
        $categoryAsc = Category_Model::where('status','active')
            ->orderBy('id','asc')
            ->limit(2)
            ->get();
        return view("Site::welcome.index")
            ->with('banners', $banners)
            ->with('products', $products)
            ->with('categoryDesc', $categoryDesc)
            ->with('categoryAsc', $categoryAsc);
    }
    // about:
    public function about() {
        return view('Site::support.about');
    }
    // contact us
    public function contact() {
        return view('Site::support.contact');
    }
}
