<?php
namespace App\Modules\Site\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Modules\Site\Models\Banner_Model;
use App\Modules\Site\Models\Product_Model;
use App\Modules\Site\Models\Category_Model;

class Blog extends Controller {
    public function index() {
        return view('Site::blog.index');
    }
    public function getBlogSingle() {
        return view('Site::blog.blog_single');
    }
}
