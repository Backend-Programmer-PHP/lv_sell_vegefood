<?php
namespace App\Modules\Site\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class Site extends Controller {

    public function index() {
        return view("Site::welcome.index");
    }
}
