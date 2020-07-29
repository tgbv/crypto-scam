<?php

namespace App\Http\Controllers\PubSite;

use App\Models\Cry\AddressesList;
use App\Http\Controllers\Controller;
use App\Rules\CheckCryptoAddress;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;

class SearchAddress extends Controller
{
	# holds the errors
	private $errors = [];

    #
    #	search
    #
    public function search(Request $Request)
    {
    	return view('search', [
    		'DATA' => $this->getData(
    			$this->validateData($Request)
    		)
    	])->withErrors($this->errors ?? null);
    }

    #
    #   search GET
    #
    public function searchGET($address)
    {
        return view('search', [
            'DATA' => $this->getData(
                $this->validateData(new Request([
                    'address' => $address
                ]))
            )
        ])->withErrors($this->errors ?? null);
    }

    #
    #	get data
    #
    private function getData(string $address) 
    {
    	return AddressesList::select('id', 'address')
						->where('address', $address)
						->with([
							'getReports' => function($q){
								$q->select('id', 'description', 'attachments', 'created_at');
                                $q->orderBy('id', 'desc');
							},
							'getType'
						])
						->first() ?? false;
    }

    #
    #	validate data; redirects page back automatically in case of errors
    #
    private function validateData($Request): string
    {
    	return $Request->validate([
    		'address' => ['bail', 'required', 'regex:/[a-zA-Z0-9]/', new CheckCryptoAddress],
    	])['address'];
    }
}
