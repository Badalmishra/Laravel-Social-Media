<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class follow extends Model
{
  protected $fillable = [
      'user_id','followers',
  ];
  public function user()
  {
    return $this->belongsTo('App\User');
  }

}
