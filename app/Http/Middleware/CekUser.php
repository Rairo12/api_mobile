<?php

namespace App\Http\Middleware;

use App\Models\PenggunaModel;
use Closure;
use Illuminate\Http\Request;

class CekUser
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
        $userid= $request->header("userid");
        $token = $request->header("token");

        $pengguna = PenggunaModel::query()->where([
            'id' -> $userid,
            'token' => $token
        ])->first();
        if ($pengguna == null){
            return response()->json([
                'message' => 'Pengguna belum login'
            ], 403);
        }
        
        $request->setUserResolver(function()use($pengguna){
            return $pengguna;
        });
        
        return $next($request);
    }
}
