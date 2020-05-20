<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles()
    {
        return $this->belongsTo(Role::class);
    }

    public function discussions()
    {
        return $this->hasMany(Discussion::class, 'id');
    }

    public function articles()
    {
        return $this->hasMany(Article::class, 'id');
    }

    public function newsComment()
    {
        return $this->belongsTo(NewsComment::class, 'user_id', 'id');
    }

    public function articleComment()
    {
        return $this->belongsTo(ArticleComment::class, 'user_id', 'id');
    }

    /**
    * Check for user has an admin role
    * or return false
    *
    * @return bool 
    */ 
    public function hasAdminRole()
    {
        if (Auth::user()->role_id == 1) {
            return true;
        }

        return false;
        
    }

    /**
	* Get and count records by month
	*
	* @param $month int|string Have to be like 01, 02...
	*
	* @return counted records by month
	*/ 
	public function getRecordsByMonth($month) 
	{
		return News::whereMonth('created_at', $month)->count();
	}
}
