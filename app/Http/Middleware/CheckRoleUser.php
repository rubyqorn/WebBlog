<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\User;

class CheckRoleUser
{
    /**
     * @var \App\User
     */ 
    private $user;

    public function __construct()
    {
        $this->user = new User();
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($this->user->hasAdminRole()) {
            return $next($request);
        }
        
        return redirect()->route('home');
    }
}
