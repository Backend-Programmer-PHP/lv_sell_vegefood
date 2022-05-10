<?php
namespace App\Modules\Dashboard\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Modules\Dashboard\Models\Banner_Model;
use App\Modules\Dashboard\Requests\BannerRequest;
use Intervention\Image\ImageManagerStatic as Image;

class Banner extends Controller {

    public function index() {
        $banners = Banner_Model::select('*')
            ->orderBy('id','desc')
            ->paginate(10);
        return view("Dashboard::components.banner.index",[
            'banners' => $banners,
        ]);
    }
    public function create() {
        return view("Dashboard::components.banner.create");
    }
    public function store(BannerRequest $request) {
        $banner = new Banner_Model;
        $banner->title = $request->title;
        //Create title
        $slug = Str::slug($request->title);
        //Check if slug matches or not?
        $count = Banner_Model::where('slug', $slug)->count();
        if ($count > 0) {
            $slug = $slug . '-' . date('ymdis') . '-' . rand(0, 999);
        }
        //Reassign the slug to $data
        $banner->slug = $slug;
        $banner->description = empty($request->description) ? null : $request->description;
        $checkStatus = Banner_Model::where('status', 'on')->first();
        if($checkStatus != null) {
            $banner->status = 'off';
        } else {
            $banner->status = 'on';
        }
        if($request->hasFile('photo')) {
            $file = $request->photo;
            $file_name = Str::slug($file->getClientOriginalName(), "-"). "-" . time() . "." . $file->getClientOriginalExtension();
            //resize file befor to upload large
            if($file->getClientOriginalExtension() != "svg") {
                $image_resize = Image::make($file->getRealPath());
                $image_resize->save('public/dashboard/uploads/banners/thumb/' . $file_name);
            }
            //close upload image
            $file->move("public/dashboard/uploads/banners/large", $file_name);
            //save db
            $url = "http://vegefoods.local/public/dashboard/uploads/banners/thumb/";
            $banner->photo = $url. $file_name;
        }
        if($banner->save()) {
            request()->session()->flash('success', 'Add success banner.');
        } else {
            request()->session()->flash('error', 'Please try again!');
        }
        return redirect()->route('banner.index');
    }
    public function edit($slug) {
        $banner = Banner_Model::where('slug',$slug)->first();
        return view("Dashboard::components.banner.edit", [
            'banner' => $banner
        ]);
    }
    public function update(BannerRequest $request, $slug) {
        $banner = Banner_Model::where('slug',$slug)->first();
        $banner->title = $request->title;
        $slug = Str::slug($request->title);
        $count = Banner_Model::where('slug', $slug)->count();
        if ($count > 0) {
            $slug = $slug . '-' . date('ymdis') . '-' . rand(0, 999);
        }
        $banner->slug = $slug;
        $banner->description = empty($request->description) ? null : $request->description;
        if($request->status == null) {
            $banner->status = 'off';
        } else {
            $banner->status = 'on';
        }
        if($request->hasFile('photo')) {
            $file = $request->photo;
            $file_name = Str::slug($file->getClientOriginalName(), "-"). "-" . time() . "." . $file->getClientOriginalExtension();
            //resize file befor to upload large
            if($file->getClientOriginalExtension() != "svg") {
                $image_resize = Image::make($file->getRealPath());
                $image_resize->save('public/dashboard/uploads/categories/thumb/' . $file_name);
            }
            //close upload image
            $file->move("public/dashboard/uploads/categories/large", $file_name);
            //save db
            $url = "http://vegefoods.local/public/dashboard/uploads/categories/thumb/";
            $banner->photo = $url. $file_name;
        }
        if($banner->save()) {
            request()->session()->flash('success', 'Update success banner.');
        } else {
            request()->session()->flash('error', 'Please try again!');
        }
        return redirect()->route('banner.index');
    }
    public function delete($slug = "") {
        $banner = Banner_Model::where('slug',$slug)->first();
        if($banner->delete()) {
            request()->session()->flash('success', 'Delete success banner.');
        } else {
            request()->session()->flash('error', 'Please try again!');
        }
        return redirect()->route('banner.index');
    }

}
