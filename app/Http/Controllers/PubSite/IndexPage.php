<?php

namespace App\Http\Controllers\PubSite;

use App\Models\Cry\Reports;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexPage extends Controller
{
    #
    #	returns view with latest reports
    #
    public function index()
    {
    	return view('index', [
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
