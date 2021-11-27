<?php

namespace App\Http\Controllers;

use App\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use App\Category;

class NewsController extends Controller
{
    protected $random;

    public function __construct()
    {
        $this->random = substr(str_shuffle("0123456hdgafshgdfahaiudvfgybsauydgafueGFHFVDAHSFH"), 0, 5);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = News::latest()->get();
        return view('admin.news.index',compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $news = News::all();
        $categories = Category::where(['parent_id' => 0])->where('status', 1)->get();
        $categories_dropdown = "<option selected disabled> Select Category </option>";
        foreach ($categories as $cat){
            $categories_dropdown .= "<option value='". $cat->id ."'>". $cat->category_name ." </option>";
            $sub_categories = Category::where(['parent_id' => $cat->id])->get();
            foreach ($sub_categories as $sub_cat){
                $categories_dropdown .= "<option value='". $sub_cat->id ."'>  &nbsp; &nbsp; ---- ". $sub_cat->category_name ." </option>";
            }
        }

        return view('admin.news.create',compact('news','categories_dropdown'));
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
            'news_title' => 'required|max:255',
            'category_id' => 'required',
            'news_content' => 'required',
            'image' => 'required',
        ]);
        
        $news = new News();
        $news->news_title = $request->news_title;
        $news->slug = Str::slug($request->news_title);
        $news->category_id = $request->category_id;
        $news->news_content = $request->news_content;

        $news->user_id = Auth::id();
        $news->seo_title = $request->seo_title;
        $news->seo_subtitle = $request->seo_subtitle;
        $news->seo_keywords = $request->seo_keywords;
        $news->seo_description = $request->seo_description;

        if ($request->image) {
            $path = 'public/image';
            $imageName = $this->random . '_' . $request->image->getClientOriginalName();
            $uploadFile = $request->file('image')->storeAs($path, $imageName);
            $news->image = $imageName;
        }


        if(empty($request->status)){
            $news->status = 0;
        } else {
            $news->status = 1;
        }

        $news->save();
        Session::flash('success_message', 'News Has Been Added Successfully');
        return redirect()->route('news.index');


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function show(News $news)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $news = News::findOrFail($id);
        $categories = Category::where(['parent_id' => 0])->where('status', 1)->get();
        $categories_dropdown = "<option selected disabled> Select Category </option>";
        foreach ($categories as $cat){
            $categories_dropdown .= "<option value='". $cat->id ."'>". $cat->category_name ." </option>";
            $sub_categories = Category::where(['parent_id' => $cat->id])->get();
            foreach ($sub_categories as $sub_cat){
                $categories_dropdown .= "<option value='". $sub_cat->id ."'>  &nbsp; &nbsp; ---- ". $sub_cat->category_name ." </option>";
            }
        }
        return view('admin.news.edit',compact('news','categories_dropdown'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'news_title' => 'required|max:255',
            'category_id' => 'required',
            'news_content' => 'required',
            'image' => 'required',
        ]);
        
        $news =  News::findOrFail($id);
        $news->news_title = $request->news_title;
        $news->slug = Str::slug($request->news_title);
        $news->category_id = $request->category_id;
        $news->news_content = $request->news_content;

        $news->user_id = Auth::id();
        $news->seo_title = $request->seo_title;
        $news->seo_subtitle = $request->seo_subtitle;
        $news->seo_keywords = $request->seo_keywords;
        $news->seo_description = $request->seo_description;

        if ($request->image) {
            $path = 'public/image';
            $imageName = $this->random . '_' . $request->image->getClientOriginalName();
            $uploadFile = $request->file('image')->storeAs($path, $imageName);
            $news->image = $imageName;
        }


        if(empty($request->status)){
            $news->status = 0;
        } else {
            $news->status = 1;
        }

        $news->save();
        Session::flash('success_message', 'News Has Been Added Successfully');
        return redirect()->route('news.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $news =  News::findOrFail($id);
        $news->delete();
        return redirect()->route('category.index',compact('news'));
    }
}
