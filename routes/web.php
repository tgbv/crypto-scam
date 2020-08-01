<?php

// main site
Route::domain(config('app.domain'))->group(function(){
	// homepage
	Route::get('/', function () { return view('index'); });

	// search
	Route::get('search', function(){ return view('search'); });
	Route::post('search', 'PubSite\SearchAddress@search');
	Route::name('site-search-address')->get('search/{address}', 'PubSite\SearchAddress@searchGET');

	// report
	Route::get('report', function(){ return view('report'); });
	Route::post('report', 'PubSite\ReportAddress@report');
	Route::name('latest-reports')->get('latest-reports', 'PubSite\LatestReports@getReports');
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