<?php 
Route::group(['prefix' =>'admin', 'middleware' => ['auth', 'admin']], function(){
	//Update Routes
    Route::resource('captains','CaptainController',[
        'as' => 'admin'
    ]);
    Route::get('captains/delete/{captain}','CaptainController@destroy')->name('admin.captains.delete-captain');

});