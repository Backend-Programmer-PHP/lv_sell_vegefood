<?php
namespace App\Modules\Site\Helpers;

use Illuminate\Http\Request;
use Illiminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Modules\Site\Models\Favorite_Model;

class Helper extends controller {
    // Get IP
    public static function getIpClient() {
        //whether ip is from share internet
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip_address = $_SERVER['HTTP_CLIENT_IP'];
        }
        //whether ip is from proxy
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        //whether ip is from remote address
        else {
            $ip_address = $_SERVER['REMOTE_ADDR'];
        }
        return $ip_address;
    }
    // Nav Category
    public static function navActive($routeActive, $r1, $r2, $r3, $r4, $r5) {
        Session::put($routeActive, 'active');
        Session::put($r1, null);
        Session::put($r2, null);
        Session::put($r3, null);
        Session::put($r4, null);
        Session::put($r5, null);
        return;
    }
    // Check Favourite
    public static function checkFavorte($id) {
        $check = Favorite_Model::where([
            'products_id' => $id,
            'users_id' => Auth::user()->id
        ])->count();
        return $check;
    }
}
