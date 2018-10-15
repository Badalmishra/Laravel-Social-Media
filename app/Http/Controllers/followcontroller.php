<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\User;
use App\Follow;
use App\Http\Controllers\Auth;
class followcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $some='';
        $profileuser = User::find($id);
        $status = true;
        foreach ( $profileuser->followers as $followers ) {
          if ($followers->followers==auth()->user()->id) {
            $followrecid=$followers->id;
            $status= false;
            Follow::find($followrecid)->delete();
          }
          else {



          }
        }
        if ($status==true) {
          $profileuser->followers()->create(['user_id'=>$id,'followers'=>auth()->user()->id,  ]);
          $profileuser = User::find($id);
          $count=$profileuser->followers->count();
          $res ='Inserted';
        }
        else {
          $profileuser = User::find($id);
          $count=$profileuser->followers->count();
          $res='Deleted';
        }
        return  response()->json(array('count'=> $count,"res"=>$res), 200);
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
        //
    }
}
