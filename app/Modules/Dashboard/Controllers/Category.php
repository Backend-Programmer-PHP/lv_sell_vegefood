<?php
namespace App\Modules\Dashboard\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Modules\Dashboard\Models\Category_Model;
use App\Modules\Dashboard\Requests\CategoryRequest;

class Category extends Controller {

    public function index() {
        $categories = Category_Model::select('*')
            ->orderBy('id','desc')
            ->paginate(1);
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
        if($category->save()) {
            request()->session()->flash('success', 'Update success category.');
            return back();
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
    // Tìm kiếm thể loại
    public function search(Request $request) {
        if($request->get('keyword')) {
            $ouput = '';
            $query = $request->get('keyword');
            $keyword = Category_Model::where('name','like',"%{$query}%")
                ->get();
            // if ($keyword) {
            //     foreach ($keyword as $key => $val) {
            //         $output .= '<tr>
            //         <td>' . $val->id . '</td>
            //         <td>' . $val->name . '</td>
            //         <td>' . date_format($val->created_at, 'd F Y') . '</td>
            //         <td>' . date_format($val->updated_at, 'd F Y') . '</td>
            //         <td>Paid</td>
            //         </tr>';
            //     }
            // }
            return response()->json($output);
        }
    }
}
