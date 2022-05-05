<?php
namespace App\Modules\Dashboard\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Modules\Dashboard\Models\Category_Model;
use App\Modules\Dashboard\Requests\CategoryRequest;
use Intervention\Image\ImageManagerStatic as Image;

class Category extends Controller {

    public function index() {
        $categories = Category_Model::select('*')
            ->orderBy('id','desc')
            ->paginate(10);
        return view("Dashboard::components.category.index",[
            'categories' => $categories,
        ]);
    }
    public function create() {
        return view("Dashboard::components.category.create");
    }
    public function edit($slug) {
        $category = Category_Model::where('slug',$slug)->first();
        return view("Dashboard::components.category.edit")
            ->with('category', $category);
    }
    public function store(CategoryRequest $request) {
        $category = new Category_Model;
        $category->name = $request->name;
        //Create slug
        $slug = Str::slug($request->name);
        //Check if slug matches or not?
        $count = Category_Model::where('slug', $slug)->count();
        if ($count > 0) {
            $slug = $slug . '-' . date('ymdis') . '-' . rand(0, 999);
        }
        //Reassign the slug to $data
        $category->slug = $slug;
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
            $category->photo = $url. $file_name;
        }
        if($category->save()) {
            request()->session()->flash('success', 'Add success category.');
        } else {
            request()->session()->flash('error', 'Please try again!');
        }
        return redirect()->route('category.index');
    }
    public function update(CategoryRequest $request, $id) {
        $category = Category_Model::find($id);
        $category->name = $request->name;
        $slug = Str::slug($request->name);
        $count = Category_Model::where('slug', $slug)->count();
        if ($count > 0) {
            $slug = $slug . '-' . date('ymdis') . '-' . rand(0, 999);
        }
        $category->slug = $slug;
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
            $category->photo = $url. $file_name;
        }
        if($category->save()) {
            request()->session()->flash('success', 'Update success category.');
        } else {
            request()->session()->flash('error', 'Please try again!');
        }
        return redirect()->route('category.index');
    }
    public function delete($id = "") {
        $category = Category_Model::findOrFail($id);
        if($category->delete()) {
            request()->session()->flash('success', 'Delete success category.');
        } else {
            request()->session()->flash('error', 'Please try again!');
        }
        return redirect()->route('category.index');
    }
    // Genre Search
    public function search(Request $request) {
        $categories = Category_Model::where('name','like',"%{$request->keyword}%")
            ->paginate(1);
        if($categories) {
            request()->session()->flash('success', 'Search for a successful genre!');
        } else {
            request()->session()->flash('error', 'Please try again!');
        }
        return view('Dashboard::components.category.index',[
            'categories' => $categories
        ]);
    }
}
