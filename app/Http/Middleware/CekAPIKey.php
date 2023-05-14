<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CekAPIKey
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $apikey = $request->header('apikey');
        if ($apikey != 'buatsajakodeapapundisini'){
            return response()->json([
                'message' => 'API Key Invalid'
            ], 401);
        }

        return $next($request);
    }
}
