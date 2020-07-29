<?php

namespace App\Http\Controllers\PubSite;

use App\Models\Cry\AddressesList;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LatestReports extends Controller
{
    #
    #	get reports
    #
    public function getReports()
    {
    	return view('latest-reports', [
    		'DATA' => AddressesList::withCount('getReports')
    							->orderBy('id', 'desc')
    							->limit(10)
    							->get()
    	]);
    }
}
