<?php
Route::group(['prefix' => '/linford', 'namespace' => 'CodeSmithTech\\Linford\\Http\\Controllers'], function() {
    Route::get('/', 'ContentController@index');
    
    Route::get('/api/entities', 'ApiController@listEntities');
    Route::post('/api/entities', 'ApiController@create');
});