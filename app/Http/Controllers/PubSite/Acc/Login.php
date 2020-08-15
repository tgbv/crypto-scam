<?php

namespace App\Http\Controllers\PubSite\Acc;

use Hash;
use Exception;
use App\Models\Acc\Users;
use App\Rules\IdentificatorExistsInDatabase;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Login extends Controller
{
    #
    #	logins the user
    # currently the authentication will not be RESTful
    #
    public function login(Request $Request)
    {
      # get user if exists
      $User = $this->getUser(
        $this->validateRequest($Request)
      );

      # validate password && return appropriate views
      if($this->validatePassword($User))
      {
        $this->storeInSession($User);
        return view('dash.dash', [
          'User' => $User,
        ]);
      }
      else
        return redirect()
              ->back()
              ->withErrors('Password is incorrect.');
    }

    #
    # validate request
    #
    private function validateRequest($Request)
    {
      return $Request->validate([
        'id' => ['bail', 'required', new IdentificatorExistsInDatabase],
        'password' => ['bail', 'required', 'min:5', 'max:50'],
      ]);
    }

    #
    # validate password
    #
    private function validatePassword(array $validated, $User)
    {
      return Hash::check($validated['password'], $User->password);
    }

    #
    # get user from database
    #
    private function getUser(array $validated): Users
    {
      $U = Users::getByEmail($validated['id'], ['id', 'password');

      return (bool)$U ? $U : Users::getByPhone($validated['id'], ['id', 'password']);
    }

    #
    # store session
    #
    private function storeInSession($User)
    {
      session()->put('user.id', $User->id);
      session()->put('user.roles', $User->roles);
    }


}
