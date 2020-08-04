<?php

namespace App\Http\Controllers\PubSite;

use App\Models\Cry\Reports;
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
        'DATA' => Reports::select('id')
                        ->orderBy('id', 'desc')
                        ->limit(10)
                        ->with([
                          'getAddresses' => function($q){
                            $q->withCount('getReports');
                          }
                        ])
                        ->get()
                        ->getAddresses
    	]);
    }
}
