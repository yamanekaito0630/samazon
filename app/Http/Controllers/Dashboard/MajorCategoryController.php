<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\MajorCategory;
use Illuminate\Http\Request;

class MajorCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $major_categories = MajorCategory::paginate(15);

        return view('dashboard.major_categories.index', compact('major_categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'name' => 'required|unique:major_categories',
            'description' => 'required',
        ],
            [
                'name.required' => '親カテゴリ名は必須です。',
                'name.unique' => '親カテゴリ名「' . $request->input('name') . '」は登録済みです。',
                'description.required' => '親カテゴリの説明は必須です。',
            ]);

        $major_category = new MajorCategory();
        $major_category->name = $request->input('name');
        $major_category->description = $request->input('description');
        $major_category->save();

        return redirect("/dashboard/major_categories");
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\MajorCategory $majorCategory
     * @return \Illuminate\Http\Response
     */
    public function show(MajorCategory $major_category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\MajorCategory $majorCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(MajorCategory $major_category)
    {
        return view('dashboard.major_categories.edit', compact('major_category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\MajorCategory $majorCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MajorCategory $major_category)
    {
        $request->validate([
            'name' => 'required|unique:major_categories',
            'description' => 'required',
        ],
            [
                'name.required' => '親カテゴリ名は必須です。',
                'name.unique' => '親カテゴリ名「' . $request->input('name') . '」は登録済みです。',
                'description.required' => '親カテゴリの説明は必須です。',
            ]);

        $major_category->name = $request->input('name');
        $major_category->description = $request->input('description');
        $major_category->update();

        return redirect("/dashboard/major_categories");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\MajorCategory $majorCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(MajorCategory $major_category)
    {
        $major_category->delete();

        return redirect("/dashboard/major_categories");
    }
}
