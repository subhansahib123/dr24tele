<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Str;
class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            $url = url()->previous();
            $containsHospital = Str::contains($url, 'hospital');
            $containsDoctor = Str::contains($url, 'doctor');
            $containsAdmin = Str::contains($url, 'admin');
            $containsPatient = Str::contains($url, 'patient');

            if( $containsHospital) {
                return  route('hospital.login');
            }else if($containsDoctor){
                return  route('doctor.login');
            }else if($containsAdmin){
                return  route('login.show');
            }
            else if($containsPatient){
                return  route('login.show');
            }else {
                return route('home.page');
            }

        }
    }
}
