<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Image;

class ImagesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $images = Image::all();
        return view('images.index')->with('images', $images);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('images.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'caption' => 'required',
            'image' => 'image|max:1999|required'
        ]);
        
        // Handle image upload
        if ($request->hasFile('image')) {
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $filenameToStore = $filename.'_'.time().'.'.$extension;
            // upload image
            $path = $request->file('image')->storeAs('public/images', $filenameToStore);
        }

        // upload new image
        $image = new Image;
        $image->caption = $request->input('caption');
        $image->user_id = auth()->user()->id;
        $image->image_name = $filenameToStore;
        $image->save();

        return redirect('/images')->with('success', 'Image uploaded');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $image = Image::find($id);
        return view('images.show')->with('image', $image);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $image = Image::find($id);

        // check for correct user
        if (auth()->user()->id !== $image->user_id) {
            return redirect('/images')->with('error', 'Unauthorised Page');
        }

        return view('images.edit')->with('image', $image);
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
        $this->validate($request, [
            'caption' => 'required',
            'image' => 'image|max:1999'
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $filenameToStore = $filename.'_'.time().'.'.$extension;
            // upload image
            $path = $request->file('image')->storeAs('public/images', $filenameToStore);
        }
            
        // upload new image
        $image = Image::find($id);
        $image->caption = $request->input('caption');
        if ($request->hasFile('image')){
            Storage::delete('public/images/'.$image->image_name);
            $image->image_name = $filenameToStore;
        }
        $image->save();

        return redirect('/images')->with('success', 'Image Edited');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $image = Image::find($id);

        // check for correct user
        if (auth()->user()->id !== $image->user_id) {
            return redirect('/images')->with('error', 'Unauthorised Page');
        }
        Storage::delete('public/images/'.$image->image_name);
        $image->delete();
        return redirect('/images')->with('success', 'Image Deleted');
    }
}
