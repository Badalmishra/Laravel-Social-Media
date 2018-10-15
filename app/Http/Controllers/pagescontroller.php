<?php

namespace App\Http\Controllers;
use App\Photo;
use App\like;
use Illuminate\Http\Request;

class pagescontroller extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }
  public function index()
  {
    $photo = Photo::orderBy('id','desc')->get();
    return view('out.home')->with('photo',$photo);
  }
}
