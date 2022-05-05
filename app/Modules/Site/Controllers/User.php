<?php
namespace App\Modules\Site\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use App\Modules\Site\Requests\UserRequest;
use App\Modules\Site\Models\User_Model;
use App\Modules\Site\Helpers\Helper;
class User extends Controller {

    // sign in
    public function login() {
        return view("Site::act.login");
    }
    // sign up
    public function register() {
        return view("Site::act.register");
    }
    // post sign up
    public function signUpSubmit(UserRequest $request) {
        $user = new User_Model;
        $user->ip = Helper::getIpClient();
        $user->name = $request->name;
        // create slug
        $code = strtoupper(substr(md5(time()), 0, 4));
        $slug = Str::slug($request->name.'-'.$code);
        $check = User_Model::where('slug', $slug)->count();
        if ($check > 0) {
            $slug = $slug . '-' . date('ymdis') . '-' . rand(0, 999);
        }
        $user->slug = $slug;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->status = $request->status ? 'active' : 'inactive';
        if($user->save()) {
            $email = $request->email;
            Mail::send('Site::email.verify', [
                'email' => $email,
            ], function ($message) use ($email) {
                $message->from('ngoctam2303001@gmail.com', 'Vegefoods');
                $message->to($email);
                $message->subject('Successful account registration');
            });
            request()->session()->flash('success', 'Add success category - Please check your email.!');
        } else {
            request()->session()->flash('error', 'Please try again!');
        }
        return redirect()->route('register');
    }
    //forgot password
    public function forgotPassword() {
        return view("Site::act.forgot-password");
    }
    // lock
    public function lock() {
        return view("Site::act.lock");
    }
    // error 404
    public function error($err) {
        if($err == '404') {
            return view("Site::errors.404");
        } elseif($err == '500') {
            return view("Site::errors.500");
        }
    }
}
