<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function user()
    {
		return $this->belongsTo('App\User');
	}
	public function comment()
    {
		return $this->hasMany('App\Comment');
	}
	public function cost()
    {
		return $this->hasOne('App\Cost');
	}
}
