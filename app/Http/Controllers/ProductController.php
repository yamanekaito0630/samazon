<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort_query = [];
        $sorted = "";

        if ($request->sort !== null) {
            $slices = explode(' ', $request->sort);
            $sort_query[$slices[0]] = $slices[1];
            $sorted = $request->sort;
        }

        if ($request->category !== null) {
            $products = Product::where('category_id', $request->category)->sortable($sort_query)->paginate(15);
            $total_count = Product::where('category_id', $request->category)->count();
            $category = Category::find($request->category);
        } else {
            $products = Product::sortable($sort_query)->paginate(15);
            $total_count = "";
            $category = null;
        }

        $sort = [
            '並び替え'=>'',
            '価格の安い順'=>'price asc',
            '価格の高い順'=>'price desc',
            '出品の古い順'=>'updated_at asc',
            '出品の新しい順'=>'updated_at desc'
        ];

        $categories = Category::all();
        $major_category_names = Category::pluck('major_category_name')->unique();

        return view('products.index', compact('products', 'categories', 'major_category_names', 'total_count', 'category', 'sort', 'sorted'));
    }

    public function favorite(Product $product)
    {
        $user = Auth::user();

        if ($user->hasFavorited($product)) {
            $user->unfavorite($product);
        } else {
            $user->favorite($product);
        }

        return redirect()->route('products.show', $product);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StoreProductRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        $product = new Product();
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->category_id = $request->input('category_id');
        $product->save();

        return redirect()->route('products.show', $product);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $reviews = $product->reviews()->get();

        return view('products.show', compact('product', 'reviews'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateProductRequest $request
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->category_id = $request->input('category_id');
        $product->update();

        return redirect()->route('products.show', $product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index');
    }
}
