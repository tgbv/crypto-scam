<?php

namespace App\Http\Controllers\PubSite;

use App\Models\Cry\Reports;
use App\Models\Cry\Types as AddressesTypes;
use App\Models\Cry\AddressesList;
use App\Rules\CheckCryptoAddress;
use App\Http\Controllers\Controller;

use Storage;
use CryptoValidation;
use Illuminate\Http\Request;

class ReportAddress extends Controller
{
    #
    #	report address
    #
    public function report(Request $Request)
    {
      # validate report
    	$validated = $this->validateData($Request);

      # checks if a client already reported an address.
      # one client can report one address once every 15 minutes
      if($this->clientCanReportAddress($Request))
      {
        # store report
      	$this->storeReport(
      		$validated,
      		$this->storeFiles($validated['proofs'] ?? []),
      		$Request,
      	);

        # return
      	return redirect()
      			->route('site-search-address', $validated['address'])
      			->withErrors('Address reported with success!');
      }
      else
        return redirect()
              ->back()
              ->withErrors('You can report once every 15 minutes.');
    }

    #
    #	validates data
    #
    private function validateData($Request)
    {
    	return $Request->validate([
    		'address' => ['bail', 'required', 'regex:/[a-zA-Z0-9]/', new CheckCryptoAddress],
    		'description' => 'bail|required|max:1023',
    		'proofs' => 'array|max:2',
    		'proofs.*' => 'image|max:4096',
            recaptchaFieldName() => recaptchaRuleName(),
    	]);
    }

    #
    #	store files
    #
    private function storeFiles(array $files): array
    {
    	$ret = [];

    	foreach($files as $file)
    		$ret[] = $file->storeAs('', $this->generateFilename($file->clientExtension()), [
    			'disk' => 'proofs'
    		]);


    	return $ret;
    }

    #
    #	generates filename
    #
    private function generateFilename(string $ext): string
    {
    	return date('Y_m_d_'). substr(microtime(), 2, 8) . '.' .$ext;
    }

    #
    #	store report in database via address
    #
    private function storeReport(array $validated, array $fnames, $Request)
    {
    	return $this->getAddress($validated['address'])
		    		->getReports()
		    		->create([
		    			'description' => $validated['description'],
		    			'attachments' => $fnames,
              'client_fingerprint' => $this->genFingerprint($Request),
		    		]);
    }

    #
    #	attempt to retrieve crypto address from database || create it
    #
    private function getAddress(string $address)
    {
    	return AddressesList::firstOrCreate([
    		'address' => $address
    	], [
    		'address' => $address,
    		'type_id' => $this->getAddressType($address)->id,
    	]);
    }

    #
    #	get crypto address type
    #
    private function getAddressType(string $address)
    {
    	foreach(AddressesTypes::all() as $Type)
    		if( CryptoValidation::make(strtoupper($Type->abb))->validate($address) )
    			return $Type;
    }

    #
    # checks if client can report an address
    #
    private function clientCanReportAddress($Request)
    {
      $report = Reports::getByFingerprint($this->genFingerprint($Request));

      if($report !== null)
        return $report->created_at->timestamp+15*60 < time() ;
      else
        return true ;
    }

    #
    # generates a client fingerprint
    #
    private function genFingerprint($Request): string
    {
      return sha1($Request->ip().$Request->userAgent()) ;
    }
}
