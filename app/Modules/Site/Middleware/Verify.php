<?php

namespace App\Modules\Site\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Verify
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if (Auth::user() == null) {
            return redirect()->route('login');
        }
        // if (!Auth::user()->status) {
        //     return redirect()->route('ico.account.index')->with(["type" => "warning", "flash_message" => "Please verify Kyc !."]);
        // }

        return $next($request);
    }
}
