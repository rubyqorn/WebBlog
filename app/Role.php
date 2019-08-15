<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
	/**
	* @return Relationships with App\User
	*/ 
    public function users()
    {
    	return $this->hasMany(User::class);
    } 
}
