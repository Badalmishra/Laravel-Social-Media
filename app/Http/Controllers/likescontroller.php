<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Photo;
use Auth;
class likescontroller extends Controller
{

    function index($photo){

    $new = Photo::find($photo);
    $k=$new->like()->get();
    $me=false;
    $mylikeid=null;

    foreach ($k as $key ) {
      if (Auth::guard('api')->user()->id == $key->user_id) {
      $me=true;
      $mylikeid=$key->id;
      }
    }
    if(!$me){
      $new->like()->create([
        'user_id'=>Auth::guard('api')->user()->id,

      ]);
      $me=!$me;
    }
    else {
      $k->find($mylikeid)->delete();
      $me=!$me;
    }
    $likes=$new->like()->get();
     return response()->json(array('msg'=> $likes,"me"=>$me), 200);
    }

}
