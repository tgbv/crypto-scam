<?php

namespace App\Http\Controllers\Api;

use App\Models\Cry\Types;
use App\Models\Cry\AddressesList;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GetCryptos extends Controller
{
    #
    #	retrieves address details
    #
    public function getAddress(string $address, string $with = null)
    {
    	# attempt to retrieve the address from database
    	$Address = AddressesList::select('id', 'type_id')
                                ->where('address', $address)
    							->first();

    	# return appropriate response
    	if($Address)
	    	return response()->json([
	    		'data' => $this->buildData($Address, $with),
	    	]);
	    else
	    	return response()->json([
                'status' => 'unknown',
	    		'message' => 'Address not reported yet.',
	    	], 404);
    }

    #
    #	builds the data
    #
    protected function buildData($Address, $with)
    {
    	# holds the parsed 'with' params from get request
    	$with = $this->parseWithParams($with);

    	# holds the returned array
    	$ret = [
            # we already know it's a scam
    		'status' => 'scam',
    	];

        # get type if requested
        if( in_array('type', $with) )
        {
            $this->getType($Address);
            $this->appendType($ret, $Address->getType);
        }

    	# get reports if requested
    	if( in_array('rep', $with) )
    	{
    		# get reports from DB
    		$this->getReports($Address);

    		# append them to ret array & hide the pivot
    		$this->appendReports($ret, $Address->getReports);
    	}

    	#
    	return $ret;
    }

    #
    #	parse 'with' data
    #
    private function parseWithParams(string $params = null): array
    {
    	return explode(',', $params);
    }

    #
    #	retrieves address's reports from db
    #
    private function getReports($Address): void
    {
		$Address->load([
			'getReports' => function($q){
				$q->select('id', 'description', 'attachments', 'created_at');
			}
		]);
    }

    #
    #   retrieves address's type
    #
    private function getType($Address):void
    {
        $Address->load( 'getType' );
    }

    #
    #	appends reports to array
    #
    private function appendReports(array &$array, $Reports)
    {
	    $array['reports'] = $Reports->map(function($item){
			return $item->makeHidden('pivot');
		});
    }

    #
    #   appends type to array
    #
    private function appendType(array &$array, $Type)
    {
        $array['type'] = $Type->makeHidden('id');
    }
}
