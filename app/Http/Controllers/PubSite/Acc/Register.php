<?php

namespace App\Http\Controllers\PubSite\Acc;

use App\Models\Acc\Users;
use App\Rules\UserEmailIsUnique;
use App\Rules\UserPhoneIsUnique;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Register extends Controller
{
	#	dynamic validation rules
	private $validationRules = [];

	#
	#	injects validation rules based on environment
	#
	public function __construct()
	{
		$this->validationRules = [
    		'email' => ['bail', 'required', 'email', new UserEmailIsUnique],
    		'phone' => ['bail', 'required', 'regex:/\+{1}[0-9]+/', 'phone:AUTO,mobile', new UserPhoneIsUnique],
    		'password' => 'bail|required|min:5|max:50',
    		recaptchaFieldName() => recaptchaRuleName(),
		];

		# hcaptcha only for production
		if(config('app.env') === 'production')
			$this->validationRules['h-captcha-response'] = 'required|HCaptcha' ;
	}

    #
    #	registers the user
    #
    public function register(Request $Request)
    {
    	return view('acc.registered', [
    		'DATA' => Users::createStandardUser(
    			$this->validateData($Request)
    		)
    	]);
    }

    #
    #	validates data
    #
    private function validateData($Request)
    {
    	return $Request->validate($this->validationRules);
    }
}
