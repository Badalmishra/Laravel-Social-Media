<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
class find extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }
  public function index()
     {

       $user = User::all();

       return View('findartists')->with('user',$user);
       // code...
     }
   public function search(Request $request)
     {

      $pattern=$request->input('search');
       $user = User::where('name','LIKE',"$pattern%")

                  ->get();
       return View('findartists')->with('user',$user);
     }
}
