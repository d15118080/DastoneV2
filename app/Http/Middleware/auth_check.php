<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class auth_check
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

        if (empty($_COOKIE['H-Token'])) {
            return redirect('/login');
        } else {
            $HToken = base_64_end_code_de($_COOKIE['H-Token'], _key_, _iv_);
            $data = User::where('identification', $HToken)->exists();
            if (!$data) {
                return redirect('/login');
            } else {
                $user_data = User::where('identification', $HToken)->first();
                session([
                    'state' => $user_data->user_state,
                    'user_name'=>"$user_data->user_name",
                    'ck_id' =>$user_data->ck_id,
                ]);

            }
        }

        return $next($request);
    }
}
