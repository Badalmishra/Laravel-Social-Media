<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class like extends Model
{
  protected $fillable = [
      'user_id',
  ];
  public function user()
  {
    return $this->belongsTo('App\User');
  }
  public function photo()
  {
    return $this->belongsTo('App\photo');
  }
}
