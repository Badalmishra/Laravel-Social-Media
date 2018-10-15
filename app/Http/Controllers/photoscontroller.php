<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Photo;
use App\like;
class photoscontroller extends Controller
{
    public function __construct()
      {
        $this->middleware('auth',['except' =>['index','show']]);
      }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $photo = Photo::orderBy('id','desc')->get();
      return view('photo.index')->with('photo',$photo);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request,[
          'title' => 'required',
          'story' => 'required',
          'cover_image'=>'image|nullable'
        ]);
        if ($request->hasFile('cover_image')) {
          $fileNameWithExt =$request->file('cover_image')->getClientOriginalName();
          $filename=pathinfo($fileNameWithExt,  PATHINFO_FILENAME);
          $extension = $request->file('cover_image')->getClientOriginalExtension();
          $fileNameToStore=auth()->user()->id.'_'.time().'.'.$extension;
          $path= $request->file('cover_image')->storeAs('public/cover_image',$fileNameToStore);
        }else {
          $fileNameToStore ='noimage.jpg';
          # code...
        }

        $photo = new Photo;
        $photo->title = $request->input('title');
        $photo->caption = $request->input('story');
        $photo->user_id = auth()->user()->id;
        $photo->path = $fileNameToStore;
        $photo->save();
        $success="photo Created";
        return redirect('/home')->with('success',$success);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $photo = Photo::find($id);
      if (auth()->user()->id !== $photo->user_id) {
      return  redirect('/posts')->with('error','Unauthorized Page');
      }
      if ($photo->cover_image !=='noimage.jpg') {
        Storage::delete('public/cover_image/'.$photo->cover_image);
      }
      $photo->delete();
      return redirect('/home')->with('success','Post Removed');
    }
}
