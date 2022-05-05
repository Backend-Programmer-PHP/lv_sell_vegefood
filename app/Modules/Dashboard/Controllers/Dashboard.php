<?php
namespace App\Modules\Dashboard\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class Dashboard extends Controller {

    public function index() {
        return view("Dashboard::dashboard.index");
    }
}
