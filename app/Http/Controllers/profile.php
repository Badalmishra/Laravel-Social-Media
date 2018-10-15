<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\User;
class profile extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function __construct()
     {
         $this->middleware('auth');
     }
    public function index()
    {
      $user = User::All();
      return view('artists')->with('users',$user);
    }
    public function bio(Request $request)
    {
      $user = User::find(auth()->user()->id);
      $user->bio=$request->input('YourBio');
      $user->save();
      $biosuc="Bio Updated";
      return redirect('/home')->with('biosuc',$biosuc);

      }
      public function delbio(Request $request)
      {
        $user = User::find(auth()->user()->id);
        $user->bio=null;
        $user->save();
        $biosuc="Bio Deleted";
        return redirect('/home')->with('biosuc',$biosuc);

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
      if ($request->hasFile('cover_image')) {
        $fileNameWithExt =$request->file('cover_image')->getClientOriginalName();
        $filename=pathinfo($fileNameWithExt,  PATHINFO_FILENAME);
        $extension = $request->file('cover_image')->getClientOriginalExtension();
        $fileNameToStore=auth()->user()->id.'_'.time().'.'.$extension;
        $path= $request->file('cover_image')->storeAs('public/user',$fileNameToStore);
      }else {
        $fileNameToStore ='noimage.jpg';
        # code...
      }
      $user = User::find(auth()->user()->id);
      $user->pic = $fileNameToStore;
      $user->save();
      return redirect('/home');
    }
    public function cover(Request $request)
    {
      if ($request->hasFile('cover_image')) {
        $fileNameWithExt =$request->file('cover_image')->getClientOriginalName();
        $filename=pathinfo($fileNameWithExt,  PATHINFO_FILENAME);
        $extension = $request->file('cover_image')->getClientOriginalExtension();
        $fileNameToStore=auth()->user()->id.'_'.time().'.'.$extension;
        $path= $request->file('cover_image')->storeAs('public/usercover',$fileNameToStore);
      }else {
        $fileNameToStore ='noimage.jpg';
        # code...
      }
      $user = User::find(auth()->user()->id);
      $user->usercover = $fileNameToStore;
      $user->save();
      return redirect('/home');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('out.profile')->with('user',$user);
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
      $user = User::find(auth()->user()->id);
        Storage::delete('public/user/'.$user->pic);
      $user->pic=null;
      $user->save();
      $picsuc="Pic Deleted";
      return redirect('/home')->with('picsuc',$picsuc);

    }
    public function delcover()
    {
      $user = User::find(auth()->user()->id);
        Storage::delete('public/usercover/'.$user->usercover);
      $user->usercover=null;
      $user->save();
      $picsuc="usercover Deleted";
      return redirect('/home')->with('picsuc',$picsuc);

    }
}
