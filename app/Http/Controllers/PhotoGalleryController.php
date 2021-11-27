<?php

namespace App\Http\Controllers;

use App\PhotoGallery;
use Illuminate\Http\Request;

class PhotoGalleryController extends Controller
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
        $photo = PhotoGallery::all();
        return view('admin.photogallery.index',compact('photo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $photo = PhotoGallery::all();
        return view('admin.photogallery.create',compact('photo'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = $request->validate([
            'title'=>'required',
            'image'=>'required',
        ]);
        $photo = new PhotoGallery();
        $photo->title = $request->title;

        if ($request->image) {
            $path = 'public/image';
            $imageName = $this->random . '_' . $request->image->getClientOriginalName();
            $uploadFile = $request->file('image')->storeAs($path, $imageName);
            $photo->image = $imageName;
        }
        $photo->save();
        return redirect()->route('photogallery.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PhotoGallery  $photoGallery
     * @return \Illuminate\Http\Response
     */
    public function show(PhotoGallery $photoGallery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PhotoGallery  $photoGallery
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $photo = PhotoGallery::findOrFail($id);
        return view('admin.photogallery.edit',compact('photo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PhotoGallery  $photoGallery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $validation = $request->validate([
            'title'=>'required',
            'image'=>'required',
        ]);
        $photo =  PhotoGallery::findOrFail($id);
        $photo->title = $request->title;

        if ($request->image) {
            $path = 'public/image';
            $imageName = $this->random . '_' . $request->image->getClientOriginalName();
            $uploadFile = $request->file('image')->storeAs($path, $imageName);
            $photo->image = $imageName;
        }
        $photo->save();
        return redirect()->route('photogallery.index',compact('photo'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PhotoGallery  $photoGallery
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $photo =  PhotoGallery::findOrFail($id);
        $photo->delete();
        return redirect()->route('photogallery.index',compact('photo'));
    }
}
