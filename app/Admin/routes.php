<?php

Admin::registerAdminRoutes();

Route::group([
    'namespace' => 'App\Admin\Controllers',
    'prefix' => 'admin',
    'middleware' => ['web', 'admin'],
    'as' => 'admin::'
], function () {
    Route::get('/', 'HomeController@index')->name('main');

    ///
    Route::group([
       'middleware' => ['admin.check_permission']
    ], function(){
        ///树木管理
        Route::group([
            'namespace' => 'Trees'
        ], function(){
            Route::resource('areas','AreaController')->except('show');
            Route::get('areas/check','AreaController@checkName')->name('areas.check');
            Route::resource('categories','CategoryController')->except('show');
            Route::get('categories/check','CategoryController@checkName')->name('categories.check');
            //Route::resource('trees','TreeController')->except('show');
        });
    });
});