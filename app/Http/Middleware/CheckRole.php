<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {   
        if (!Auth::check()) {
            return redirect()->route('login'); 
        }
        
        $roles = [
            'admin' => [1],
            'instructor' => [2],
            'student' => [3],
        ];

        $roleIDs = $roles[$role] ?? [];

        if(!in_array(auth()->user()->role_id, $roleIDs)){
            abort(code:403);
        }
        return $next($request);
    }
}
