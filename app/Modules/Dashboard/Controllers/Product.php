<?php
namespace App\Modules\Dashboard\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Modules\Dashboard\Models\Product_Model;
use App\Modules\Dashboard\Models\Category_Model;
use App\Modules\Dashboard\Requests\ProductRequest;
use Intervention\Image\ImageManagerStatic as Image;

class Product extends Controller {

    public function index() {
        $products = Product_Model::select('products.id','products.name', 'products.slug',
            'products.photo','products.protype','products.price',
            'products.status','categories.name as categories_name')
            ->join('categories','products.categories_id','categories.id')
            ->where('products.status','active')
            ->whereNull('products.deleted_at')
            ->orderBy('products.id','desc')
            ->paginate(10);
        return view("Dashboard::components.product.index",[
            'products' => $products
        ]);
    }
    public function create() {
        $categories = Category_Model::select('id','slug','name')
            ->get();
        return view("Dashboard::components.product.create",[
            'categories' =>  $categories
        ]);
    }
    public function edit($slug) {
        $product = Product_Model::where('slug',$slug)->first();
        $categories = Category_Model::select('id','slug','name')
            ->get();
        return view("Dashboard::components.product.edit",[
            'product'    => $product,
            'categories' =>  $categories
        ]);
    }
    public function store(ProductRequest $request) {
        $product = new Product_Model;
        $product->name = $request->name;
        $slug = Str::slug($request->name);
        //Check if slug matches or not?
        $check = Product_Model::where('slug', $slug)->count();
        if ($check > 0) {
            $slug = $slug . '-' . date('ymdis') . '-' . rand(0, 999);
        }
        $product->slug = $slug;
        $product->price = $request->price;
        $product->discount = $request->discount;
        $product->quantity = $request->quantity;
        $product->mass = $request->mass;
        $product->protype = $request->protype;
        $product->description = $request->description;
        $product->categories_id = $request->category;
        if($request->hasFile('photo')) {
            $file = $request->photo;
            $file_name = Str::slug($file->getClientOriginalName(), "-"). "-" . time() . "." . $file->getClientOriginalExtension();
            //resize file befor to upload large
            if($file->getClientOriginalExtension() != "svg") {
                $image_resize = Image::make($file->getRealPath());
                $image_resize->save('public/dashboard/uploads/products/thumb/' . $file_name);
            }
            //close upload image
            $file->move("public/dashboard/uploads/products/large", $file_name);
            //save db
            $url = "http://vegefoods.local/public/dashboard/uploads/products/thumb/";
            $product->photo = $url. $file_name;
            if($product->save()) {
                request()->session()->flash('success', 'Add success product.');
            } else {
                request()->session()->flash('error', 'Please try again!');
            }
            return redirect()->route('product.index');
        }
    }
    public function update(ProductRequest $request, $slug) {
        $product = Product_Model::where('slug',$slug)->first();
        $product->name = $request->name;
        $slug = Str::slug($request->name);
        //Check if slug matches or not?
        $check = Product_Model::where('slug', $slug)->count();
        if ($check > 0) {
            $slug = $slug . '-' . date('ymdis') . '-' . rand(0, 999);
        }
        $product->slug = $slug;
        $product->price = $request->price;
        $product->discount = $request->discount;
        $product->quantity = $request->quantity;
        $product->mass = $request->mass;
        $product->protype = $request->protype;
        $product->description = $request->description;
        $product->categories_id = $request->category;
        if($request->hasFile('photo')) {
            $file = $request->photo;
            $file_name = Str::slug($file->getClientOriginalName(), "-"). "-" . time() . "." . $file->getClientOriginalExtension();
            //resize file befor to upload large
            if($file->getClientOriginalExtension() != "svg") {
                $image_resize = Image::make($file->getRealPath());
                $image_resize->save('public/dashboard/uploads/products/thumb/' . $file_name);
            }
            //close upload image
            $file->move("public/dashboard/uploads/products/large", $file_name);
            //save db
            $url = "http://vegefoods.local/public/dashboard/uploads/products/thumb/";
            $product->photo = $url. $file_name;
        }
        if($product->save()) {
            request()->session()->flash('success', 'Update success product.');
        } else {
            request()->session()->flash('error', 'Please try again!');
        }
        return redirect()->route('product.index');
    }
    public function delete($slug = "") {
        $product = Product_Model::where('slug', $slug)->first();
        if($product->delete()) {
            request()->session()->flash('success', 'Delete success product.');
        } else {
            request()->session()->flash('error', 'Please try again!');
        }
        return redirect()->route('product.index');
    }
    // Soft delete
    public function moveTrash($slug) {
        $product = Product_Model::where('slug', $slug)
            ->update(['deleted_at' => Carbon::now()]);
        if ($product) {
            request()->session()->flash('success', 'Successfully moved to trash');
        } else {
            request()->session()->flash('error', 'Unexpected error');
        }
        return redirect()->route('product.index');
    }
    //Display the list of vehicles that are moved to the trash:
    public function trash() {
        $products = Product_Model::select('products.id','products.name', 'products.slug',
            'products.photo','products.protype','products.price',
            'products.status','categories.name as categories_name')
            ->join('categories','products.categories_id','categories.id')
            ->where('products.status','active')
            ->whereNotNull('deleted_at')
            ->orderBy('id','desc')
            ->paginate(10);
        return view("Dashboard::components.product.trash",[
            'products' => $products
        ]);
    }
    //Product recovery
    public function rehibilitate($slug) {
        $product = Product_Model::where('slug', $slug)
            ->update(['deleted_at' => NULL]);
        if ($product) {
            request()->session()->flash('success', 'Successful recovery!');
        } else {
            request()->session()->flash('error', 'Please try again!');
        }
        return redirect()->route('product.trash');
    }
    // Tìm kiếm sản phẩm:
    public function search(Request $request) {
        $products = Product_Model::where('name','like',"%{$request->keyword}%")
            ->paginate(10);
        if($products) {
            request()->session()->flash('success', 'Search for a successful product!');
        } else {
            request()->session()->flash('error', 'Please try again!');
        }
        return view('Dashboard::components.product.index',[
            'products' => $products
        ]);
    }

}
