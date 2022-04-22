<?php

namespace App\Http\Controllers\Category;

use App\Models\Category;
use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Category\AddcategoryRequest;
use App\Http\Requests\Category\EditcategoryRequest;
use DataTables;
class CategoryController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $model = Category::all();
            return Datatables::of($model)
            ->addIndexColumn()
            ->addColumn('category_name', '{{ $category_name }}')
            ->addColumn('status','{{ $status == 1 ? "Inactive" : "Active" }}')
            ->addColumn('edit',function($model){
                return '<a href="'.route("edit-category",[$model->id]).'" class="btn btn-warning btn-xs">Edit</a>
                <a href="'.route("delete-category",[$model->id]).'" class="btn btn-danger btn-xs">delete</a>';
            })
            ->rawColumns(['edit'])
            ->make(true); 
        }
        return view('pages.category.index');
    }

    public function add()
    {
        return view('pages.category.add');
    }

    public function store(AddcategoryRequest $request)
    {
        $category                   = new Category();
        $category->category_name    = $request->category_name;
        $category->status           = $request->status;
        $category->save();

        \Session::flash('flash_message', 'Category Added Succesfully. Thanks');
        return redirect()->route('index-category');
    }

    public function edit($id)
    {
        $category = Category::find($id);
        return view('pages.category.edit',compact('category'));
    }

    public function update(EditcategoryRequest $request,$id)
    {
        $category                   = Category::find($id);
        $category->category_name    = $request->category_name;
        $category->status           = $request->status;
        $category->save();

        \Session::flash('flash_message', 'Category Updated Succesfully. Thanks');
        return redirect()->route('index-category');
    }

    public function delete($id)
    {
        $category = Category::find($id);
        $product = Product::where('category_id',$category->id);
        $category->delete();
        $product->delete();

        \Session::flash('flash_message', 'Category Deleted Succesfully. Thanks');
        return redirect()->route('index-category');
    }

}
