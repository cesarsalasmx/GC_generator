<?php

use Illuminate\Support\Facades\Auth;

if (!function_exists('isAdmin')) {
    function isAdmin()
    {
        $user = Auth::user();
        return $user && $user->role === 'administrator';
    }
}
