<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Category as CategoryResource;
use App\Category;

class CategoriesController extends Controller
{
    public function index()
    {
        // return response()->json(['categories' => Category::with('subCatoegory')
        //             ->where('parent_id', 0)
        //     ], 200);

        // return response()->json(['categories' => Category::with('subCategory')
        //              ->where('parent_id', 0)->get()
        //      ], 200);

        return CategoryResource::collection(Category::all());
    }

    public function categoryList()
    {
        return response()->json(['categories' => Category::with('subCategory')
                     ->where('parent_id', 0)->get()
             ], 200);
    }

    public function store(Request $request)
    {
        $category = Category::create([
            'name' => $request->name,
            'link' => $request->link,
            'is_active' => $request->is_active,
            'parent_id' => $request->parent_id,
            'icon' => $request->icon,
            'sort_id' => $request->sort_id,
        ]);
        return response()->json(['category' => $category], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        $category->name = $request->name;
        $category->link = $request->link;
        $category->is_active = $request->is_active;
        $category->parent_id = $request->parent_id;
        $category->icon = $request->icon;
        $category->sort_id = $request->sort_id;
        $category->save();
        return response()->json(['category' => $category], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id)->delete();
        return response()->json(['category' => $category], 200);
    }
}
