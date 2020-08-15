<?php

// main site
Route::domain(config('app.domain'))->group(function(){
	// homepage && other stuff
	Route::get('/', 'PubSite\IndexPage@index');
	Route::name('about')->get('about', function () { return view('about'); });

	// search
	Route::get('search', function(){ return view('search'); });
	Route::post('search', 'PubSite\SearchAddress@search');
	Route::name('site-search-address')->get('search/{address}', 'PubSite\SearchAddress@searchGET');

	// report
	Route::name('report')->get('report', function(){ return view('report'); });
	Route::post('report', 'PubSite\ReportAddress@report');
	Route::name('latest-reports')->get('latest-reports', 'PubSite\LatestReports@getReports');

	// acc
	Route::name('register')->get('register', function(){ return view('acc.register'); });
	Route::post('register', 'PubSite\Acc\Register@register');
});

// static area
Route::domain('static.'. config('app.domain'))->group(function(){
	Route::name('proof-download')->get('{file}', function($file){
		return \Storage::disk('proofs')->download($file) ;
	});
});

// api

Route::get('test', function(){
	return response(
		\App\Models\Cry\Types::select('name')->orderBy('name')->get()->pluck('name')->implode("\r\n - ")
	);
});