<?php

namespace App\Rules;

use App\Models\Acc\Users;
use Illuminate\Contracts\Validation\Rule;

class IdentificatorExistsInDatabase implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
        return Users::getByEmail($value, ['id']) || Users::getByPhone($value, ['id']);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'User does not exist in system.';
    }
}
