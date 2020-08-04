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
            'DATA' => Reports::select('id', 'created_at')
                            ->with([
                                'getAddresses' => function($getAddresses){
                                   // $getAddresses->orderBy('id', 'desc');
                                  // $getAddresses->limit(1);
                                }
                            ])
                            ->orderBy('id', 'desc')
                            ->limit(10) 
                            ->get() 
    	]);
    }
}
