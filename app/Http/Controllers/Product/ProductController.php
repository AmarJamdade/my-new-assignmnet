<?php

namespace App\Http\Controllers\Product;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Http\Requests\Product\AddProductRequest;
use App\Http\Requests\Product\EditProductRequest;
use DataTables;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $model = Product::all();
            return Datatables::of($model)
            ->addIndexColumn()
            ->addColumn('product_sku', '{{ $product_sku }}')
            ->addColumn('product_name', '{{ $product_name }}')
            ->addColumn('category_id',function($model){
                return $model->category->category_name;
            })
            ->addColumn('status','{{ $status == 1 ? "Inactive" : "Active" }}')
            ->addColumn('edit',function($model){
                return '<a href="'.route("edit-product",[$model->id]).'" class="btn btn-warning btn-xs">edit</a>
                <a href="'.route("delete-product",[$model->id]).'" class="btn btn-danger btn-xs">delete</a>';
            })
            ->rawColumns(['edit'])
            ->make(true); 
        }
        return view('pages.product.index');
    }

    public function add()
    {
        $category = Category::where('status',0)->get();
        return view('pages.product.add',compact('category'));
    }

    public function store(AddProductRequest $request)
    {
        $product                = new Product();
        $product->product_sku   = $request->product_sku;
        $product->product_name  = $request->product_name;
        $product->category_id   = $request->category;
        $product->status        = $request->status;
        $product->save();

        \Session::flash('flash_message', 'Product Added Succesfully. Thanks');
        return redirect()->route('index-product');
    }

    public function edit($id)
    {
        $product = Product::find($id);
        $category = Category::where('status',0)->get();
        return view('pages.product.edit',compact('product','category'));
    }

    public function update(EditProductRequest $request,$id)
    {
        $product                = Product::find($id);
        $product->product_sku   = $request->product_sku;
        $product->product_name  = $request->product_name;
        $product->category_id   = $request->category;
        $product->status        = $request->status;
        $product->save();

        \Session::flash('flash_message', 'Product Updated Succesfully. Thanks');
        return redirect()->route('index-product');
    }

    public function delete($id)
    {
        $product = Product::find($id);
        $product->delete();

        \Session::flash('flash_message', 'Product Deleted Succesfully. Thanks');
        return redirect()->route('index-product');
    }
}
