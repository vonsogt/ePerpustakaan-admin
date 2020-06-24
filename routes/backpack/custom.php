<?php
Route::group([
    'prefix'     => 'api',
    'middleware' => ['web', 'cors'],
    'namespace'  => 'App\Http\Controllers\Api'
], function () {
    Route::get('client', 'ClientController@index');
    Route::get('client/{id}', 'ClientController@show');

    Route::get('book', 'BookController@index');
    Route::get('book/{id}', 'BookController@show');
});

// Route::group([
//     'prefix'     => 'client',
//     'middleware' => ['auth:api'],
//     'namespace'  => 'App\Http\Controllers\Api'
// ], function () {
//     Route::post('login', 'ClientController@login');
//     Route::post('register', 'ClientController@register');
//     Route::post('details', 'ClientController@details');
// });

Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => ['web', config('backpack.base.middleware_key', 'admin')],
    'namespace'  => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
    Route::crud('client', 'ClientCrudController');
    Route::crud('book', 'BookCrudController');
    Route::crud('archive', 'ArchiveCrudController');
}); // this should be the absolute last line of this file
