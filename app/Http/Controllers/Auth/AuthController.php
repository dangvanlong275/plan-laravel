<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        //code
    }

    public function register(Request $request)
    {
        //code
    }

    public function updateProfile(User $user, Request $request)
    {
        //code
    }

    public function destroy(User $user)
    {
        //code
    }

    public function updatePassword(User $user, Request $request)
    {
        //code
    }

    public function options(Request $request, Response $response)
    {
        if (!empty($_SERVER['HTTP_ORIGIN']) && in_array($_SERVER['HTTP_ORIGIN'], [config('app.url')])) {
            $response->header('Access-Control-Allow-Origin', $_SERVER['HTTP_ORIGIN']);
        } else {
            $response->header('Access-Control-Allow-Origin', url()->current());
        }

        $response->header('Access-Control-Allow-Headers', 'Origin, Content-Type, Accept, Authorization');
        $response->header('Access-Control-Allow-Methods', 'POST, GET, OPTIONS, PUT, DELETE');
        $response->header('Access-Control-Allow-Credentials', 'true');
        $response->header('X-Content-Type-Options', 'nosniff');
        return $response;
    }
}
