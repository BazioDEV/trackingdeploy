<?php 
Route::group(['prefix' =>'admin', 'middleware' => ['auth', 'admin']], function(){
	//Update Routes
    Route::resource('clients','ClientController',[
        'as' => 'admin'
    ]);
    Route::get('clients/delete/{client}','ClientController@destroy')->name('admin.clients.delete-client');

});