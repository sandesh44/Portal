<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.category.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.category.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'category_name' => 'required|max:255',
            'parent_id' => 'required',
            'description' => 'required'
        ]);
        $categories = new Category();
        $categories->category_name = $request->category_name;
        $categories->slug = Str::slug($request->category_name);
        $categories->description = $request->description;
        $categories->parent_id = $request->parent_id;
        if(!empty($request['status'])){
            $categories->status = 1;
        } else {
            $categories->status = 0;
        }
        $categories->save();
        Session::flash('success_message', 'Category Has Been Added Successfully');
        return redirect()->route('category.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        $categories = Category::where('parent_id', 0)->get();
        return view ('admin.category.edit', compact('category', 'categories'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $validateData = $request->validate([
            'category_name' => 'required|max:255',
            'parent_id' => 'required',
            'description' => 'required'
        ]);
        $categories =  Category::findOrFail($id);
        $categories->category_name = $request->category_name;
        $categories->slug = Str::slug($request->category_name);
        $categories->description = $request->description;
        $categories->parent_id = $request->parent_id;
        if(!empty($request['status'])){
            $categories->status = 1;
        } else {
            $categories->status = 0;
        }
        $categories->save();
        Session::flash('success_message', 'Category Has Been Added Successfully');
        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $categories =  Category::findOrFail($id);
        $categories->delete();
        return redirect()->route('category.index',compact('categories'));
    }
}
