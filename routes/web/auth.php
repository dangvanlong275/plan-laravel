<?php

use Illuminate\Support\Facades\Route;
use App\Helpers\RouteHelper;
use App\Http\Controllers\Auth\AuthController;

/**
 * as: group name
 * multy middleware: ['middware1', 'middware2']
 */
Route::group(['prefix' => 'user', 'namespace' => 'Auth', 'as' => 'user.'], function () {

    RouteHelper::handleRoutePost([
        AuthController::class => [
            'login' => ['use' => 'login', 'name' => 'login'],
            'register' => ['use' => 'register', 'name' => 'register']
        ]
    ]);

    RouteHelper::handleRoutePatch([
        AuthController::class => [
            '{user}/change-password' => ['use' => 'updatePassword', 'name' => 'change_password', 'middleware' => 'web']
        ]
    ]);

    RouteHelper::handleRoutePatch([
        AuthController::class => [
            '{user}/edit' => ['use' => 'updateProfile', 'name' => 'edit']
        ]
    ]);

    RouteHelper::handleRouteDelete([
        AuthController::class => [
            '{user}' => ['use' => 'destroy', 'name' => 'delete']
        ]
    ]);

    RouteHelper::handleRouteMatch([
        AuthController::class => [
            'match' => ['method' => ['GET', 'POST', 'PUT'], 'use' => 'login', 'name' => 'match']
        ]
    ]);

    RouteHelper::handleRouteAny([
        AuthController::class => [
            'any' => ['use' => 'login', 'name' => 'any']
        ]
    ]);

    RouteHelper::handleRouteOptions([
        AuthController::class => [
            '{options}' => ['use' => 'options', 'name' => 'options', 'where' => ['options', '.*']]
        ]
    ]);

});
