<?php

namespace App\Http\Controllers;

use App\Advertisement;
use App\News;
use Illuminate\Http\Request;

class AdvertisementController extends Controller
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
        $advertisement = Advertisement::paginate(10);
        return view('admin.advertisement.index',compact('advertisement'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $advertisement = Advertisement::all();
        return view('admin.advertisement.create',compact('advertisement'));
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
            'url' =>'required',
        ]);
        $advertisement = new Advertisement();
        $advertisement->title = $request->title;
        $advertisement->url = $request->url;

        if ($request->image) {
            $path = 'public/image';
            $imageName = $this->random . '_' . $request->image->getClientOriginalName();
            $uploadFile = $request->file('image')->storeAs($path, $imageName);
            $advertisement->image = $imageName;
        }


        if(empty($request->status)){
            $advertisement->status = 0;
        } else {
            $advertisement->status = 1;
        }

        $advertisement->save();
        return redirect()->route('advertisement.index');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Advertisement  $advertisement
     * @return \Illuminate\Http\Response
     */
    public function show(Advertisement $advertisement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Advertisement  $advertisement
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $advertisement = Advertisement::findOrFail($id);
        return view('admin.advertisement.edit',compact('advertisement'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Advertisement  $advertisement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        
        $validation = $request->validate([
            'title'=>'required',
            'image'=>'required',
            'url' =>'required',
        ]);
        $advertisement =  Advertisement::findOrFail($id);
        $advertisement->title = $request->title;
        $advertisement->url = $request->url;

        if ($request->image) {
            $path = 'public/image';
            $imageName = $this->random . '_' . $request->image->getClientOriginalName();
            $uploadFile = $request->file('image')->storeAs($path, $imageName);
            $advertisement->image = $imageName;
        }


        if(empty($request->status)){
            $advertisement->status = 0;
        } else {
            $advertisement->status = 1;
        }

        $advertisement->save();
        return redirect()->route('advertisement.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Advertisement  $advertisement
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $advertisement = Advertisement::findOrFail($id);
        $advertisement->delete();
        return redirect()->route('advertisement.index');
    }
}
