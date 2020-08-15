<?php

namespace App\Http\Controllers\PubSite\Acc;

use Mail;
use Exception;
use App\Models\Acc\Users;
use App\Mail\UserPasswordReset;
use App\Rules\IdentificatorExistsInDatabase;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PasswordReset extends Controller
{
    #
    # resets password`
    #
    public function resetPassword(Request $Request)
    {
      $this->validateData($Request);
    }

    #
    # validate data
    #
    public function validateData($Request)
    {
      return $Request->validate([
        'id' => ['bail', 'required', new IdentificatorExistsInDatabase],
        'type' => 'bail|required|in:1,2',
      ]);
    }

    #
    # insert validation data into db
    #
    private function insertDataIntoDB(array $validated, $User)
    {
      $User->getPasswordResets()->create([
        'type' => $validated['type'],
        'passphrase' => $User->generatePhoneConfirmationToken(),
      ]);
    }

    #
    # send mail to user
    #
    private function sendMail(array $validated, $User)
    {
      Mail::send(new UserPasswordReset([
        'User' => $User,
        'validated' => $validated,
      ]))-> to($validated['id']);
    }

    #
    # send SMS to user
    #
    private function sendSMS($User)
    {
      
    }

    #
    # retrieves the user from database
    #
    private function getUser(array $validated)
    {
      $U = Users::getByEmail($validated['id'], ['id']);

      return (bool)$U ? $U : Users::getByPhone($validated['id'], ['id']);
    }

}
