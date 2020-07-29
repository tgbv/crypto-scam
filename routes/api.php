<?php

// routes vars filter
Route::pattern('with', '[a-z\,\_]+');
Route::pattern('address', '[a-zA-Z0-9]+');

// address related
Route::get('a/{address}/{with?}', 'Api\GetCryptos@getAddress');
Route::get('a-types', function(){
	return response(\App\Models\Cry\Types::select('name', 'abb')->orderBy('name')->get());
});