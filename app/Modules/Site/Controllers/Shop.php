<?php
namespace App\Modules\Site\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use App\Modules\Site\Helpers\Helper;
use App\Modules\Site\Models\Product_Model;
use App\Modules\Site\Models\Category_Model;
use App\Modules\Site\Models\Favorite_Model;

class Shop extends Controller {

    public function index() {
        $products = Product_Model::where('quantity','>=' , 0)
            ->orderBy('id','desc')
            ->paginate(4);
        $categories = Category_Model::where('status','active')
            ->orderBy('id','desc')->get();
        Helper::navActive('all', 'fruits', 'juices','vegetables','dried','drinks');
        return view("Site::shop.index", [
            'products' => $products,
            'categories' => $categories
        ]);
    }
    // Products by category
    public function productCategory($slug) {
        $products = Product_Model::select('products.*')
            ->join('categories','products.categories_id','categories.id')
            ->where('products.quantity','>=' , 0)
            ->where('categories.slug', $slug)
            ->orderBy('id','desc')
            ->paginate(4);
        $categories = Category_Model::where('status','active')
            ->orderBy('id','desc')->get();
        // fillter:
        if($slug == 'fruits') {
            Helper::navActive('fruits','all', 'juices','vegetables','dried','drinks');
        } elseif($slug == 'juices') {
            Helper::navActive('juices','fruits', 'all','vegetables','dried','drinks');
        } elseif($slug == 'vegetables') {
            Helper::navActive('vegetables','fruits', 'juices','all','dried','drinks');
        } elseif($slug == 'dried') {
            Helper::navActive('dried','fruits', 'juices','vegetables','all','drinks');
        } elseif($slug == 'drinks') {
            Helper::navActive('drinks','fruits', 'juices','vegetables','dried','all');
        }
        return view("Site::shop.product_category")
            ->with('products', $products)
            ->with('categories', $categories);
    }
    // Product details slug
    public function productDetalSlug($slug) {
        $product = Product_Model::select('products.*')
            ->where('products.slug', $slug)
            ->first();

        return view("Site::shop.product_single")
            ->with('product', $product);
    }
    // Display a favorites list
    public function getFavorites() {
        $favorites = Favorite_Model::select('products.*','users.id as users_id',
            'users.name as users_name','favorites.id as favorites_id')
            ->join('products','favorites.products_id','products.id')
            ->join('users','favorites.users_id','users.id')
            ->where('favorites.users_id', Auth::user()->id)
            ->orderBy('id','desc')
            ->paginate(2);
        if(!empty($favorites)) {
            return view("Site::shop.favourite")->with('favorites', $favorites);
        } else {
            return view("Site::errors.404");
        }

    }
    // Add a product to your favorites list
    public function addAndDeleteFavorite($id) {
        $checkDB = Helper::checkFavorte($id);
        if($checkDB == 0) {
            $favorite = new Favorite_Model;
            $favorite->users_id = Auth::user()->id;
            $favorite->products_id = $id;
            if($favorite->save()) {
                request()->session()->flash('success', 'Add success favorite.');
            } else {
                request()->session()->flash('error', 'Please try again!');
            }
        } else {
            $deleteFavorite = Favorite_Model::where('products_id', $id)->delete();
            if($deleteFavorite) {
                request()->session()->flash('success', 'Delete success favorite.');
            } else {
                request()->session()->flash('error', 'Please try again!');
            }
        }
        return back();
    }
}
