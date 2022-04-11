<?php

use Illuminate\Support\Facades\Route;

Route::group(['as' => 'student.', 'namespace' => 'API'], function(){
    /**
     * Resource:
     * GET: /students => index
     * GET: /students/{id} => show
     * POST: /students => store
     * PUT/PATCH: /students/{id} => update
     * DELETE: /students/{id} => destroy
     */
    Route::resources([
        'students' => 'StudentController'
    ]);
});
