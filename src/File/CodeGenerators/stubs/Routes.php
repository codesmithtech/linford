
Route::group(['prefix' => '/URL_PREFIX'], function() {
    Route::get('', 'CONTROLLER@search');
    Route::get('{VAR_NAME}', 'CONTROLLER@view')->where('VAR_NAME', '[0-9]+');
    Route::post('', 'CONTROLLER@create');
    Route::post('{VAR_NAME}', 'CONTROLLER@update')->where('VAR_NAME', '[0-9]+');;
    Route::delete('{VAR_NAME}', 'CONTROLLER@remove')->where('VAR_NAME', '[0-9]+');;
});