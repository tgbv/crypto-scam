<?php

namespace App\Rules;

use CryptoValidation;
use App\Models\Cry\Types as CryptoTypes;
use Illuminate\Contracts\Validation\Rule;

class CheckCryptoAddress implements Rule
{
    private $Cryptos;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->Cryptos = CryptoTypes::all();
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        foreach($this->Cryptos as $Crypto)
            if( $this->checkAddress($value, $Crypto->abb) )
                return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Invalid crypto address.';
    }

    #
    #   check address
    #
    private function checkAddress(string $address, string $crypto_abb): bool
    {
        return CryptoValidation::make(strtoupper($crypto_abb))
                            ->validate($address);
    }
}
