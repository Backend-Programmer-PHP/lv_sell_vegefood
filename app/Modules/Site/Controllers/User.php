<?php
namespace App\Modules\Site\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use App\Modules\Site\Requests\UserRequest;
use App\Modules\Site\Models\User_Model;
use App\Modules\Site\Helpers\Helper;
use Intervention\Image\ImageManagerStatic as Image;
class User extends Controller {

    //Profile information
    public function profile($slug) {
        $user = User_Model::where('slug',$slug)->first();
        return view ('Site::act.profile',[
            'user' => $user
        ]);
    }
    // sign in
    public function login() {
        return view("Site::act.login");
    }
    // post sign in
    public function postLogin(Request $request) {
        $data = $request->all();
        $remember_token = ($request->has('remember_token')) ? true : false; // add
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password,'status' => 'active'], $remember_token)) {
            Session::put('user', $data['email']);
            request()->session()->flash('success', 'Successfully login');
            return redirect('/');
        } else {
            request()->session()->flash('error', 'Invalid email and password pleas try again!');
            return redirect()->back();
        }
    }
    // post logout:
    public function postLogout() {
        Auth::logout();
        return back();
    }
    // sign up
    public function register() {
        return view("Site::act.register");
    }
    // post sign up
    public function postSignUp(UserRequest $request) {
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
    //Update avatar:
    public function postUpdateAvatar(Request $request, $slug) {
        $user = User_Model::where('slug', $slug)->first();
        if($request->hasFile('photo')) {
            $file = $request->photo;
            $file_name = Str::slug($file->getClientOriginalName(), "-"). "-" . time() . "." . $file->getClientOriginalExtension();
            //resize file befor to upload large
            if($file->getClientOriginalExtension() != "svg") {
                $image_resize = Image::make($file->getRealPath());
                $image_resize->save('public/site/uploads/users/thumb/' . $file_name);
            }
            //close upload image
            $file->move("public/site/uploads/users/large", $file_name);
            //save db
            $url = "http://vegefoods.local/public/site/uploads/users/thumb/";
            $user->photo = $url. $file_name;
        }
        if ($user->save()) {
            request()->session()->flash('success', 'user successfully updated');
        } else {
            request()->session()->flash('error', 'Error occurred, Please try again!');
        }
        return back();

    }
    //Update cover photo:
    public function postUpdateCover(Request $request, $slug) {
        $user = User_Model::where('slug', $slug)->first();
        if($request->hasFile('photo')) {
            $file = $request->photo;
            $file_name = Str::slug($file->getClientOriginalName(), "-"). "-" . time() . "." . $file->getClientOriginalExtension();
            //resize file befor to upload large
            if($file->getClientOriginalExtension() != "svg") {
                $image_resize = Image::make($file->getRealPath());
                $image_resize->save('public/site/uploads/users/thumb/' . $file_name);
            }
            //close upload image
            $file->move("public/site/uploads/users/large", $file_name);
            //save db
            $url = "http://vegefoods.local/public/site/uploads/users/thumb/";
            $user->cover_photo = $url. $file_name;
        }
        if ($user->save()) {
            request()->session()->flash('success', 'user successfully updated');
        } else {
            request()->session()->flash('error', 'Error occurred, Please try again!');
        }
        return back();

    }
    //Update personal records
    public function postUpdatePersonal(Request $request, $slug) {
        $user = User_Model::where('slug', $slug)->first();
        $user->name = $request->first_name. ' ' .$request->last_name;
        $user->birthday = $request->birthday;
        $user->gender = $request->gender;
        $user->phone = empty($request->phone) ? '0123456789' : $request->phone;
        if ($user->save()) {
            request()->session()->flash('success', 'user successfully updated');
        } else {
            request()->session()->flash('error', 'Error occurred, Please try again!');
        }
        return back();
    }
}
