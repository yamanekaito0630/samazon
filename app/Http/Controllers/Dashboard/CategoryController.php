<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Category;
use App\Models\MajorCategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::paginate(15);

        $major_categories = MajorCategory::all();

        return view('dashboard.categories.index', compact('categories', 'major_categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|unique:categories',
            'description'=>'required',
        ],
        [
            'name.required'=>'カテゴリ名は必須です。',
            'name.unique'=>'カテゴリ名「' . $request->input('name') . '」は登録済みです。',
            'description.required'=>'カテゴリの説明は必須です。',
        ]);

        $category = new Category();
        $category->name = $request->input('name');
        $category->description = $request->input('description');
        $category->major_category_id=$request->input('major_category_id');
        $category->major_category_name = MajorCategory::find($request->input('major_category_id'))->name;
        $category->save();

        return redirect("/dashboard/categories");
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $major_categories=MajorCategory::all();

        return view('dashboard.categories.edit', compact('category', 'major_categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name'=>'required|unique:categories',
            'description'=>'required',
        ],
            [
                'name.required'=>'カテゴリ名は必須です。',
                'name.unique'=>'カテゴリ名「' . $request->input('name') . '」は登録済みです。',
                'description.required'=>'カテゴリの説明は必須です。',
            ]);

        $category->name = $request->input('name');
        $category->description = $request->input('description');
        $category->major_category_id=$request->input('major_category_id');
        $category->major_category_name = MajorCategory::find($request->input('major_category_id'))->name;
        $category->update();

        return redirect("/dashboard/categories");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect("/dashboard/categories");
    }
}
