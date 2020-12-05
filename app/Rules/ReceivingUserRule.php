<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ReceivingUserRule implements Rule
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
        $discordUsername = preg_match("/(.*#\d{4})/", $value);
        $email = filter_var($value, FILTER_VALIDATE_EMAIL);

        if($discordUsername != true && $email == false) {
            return false;
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The provided input was not an email or a Discord Username.';
    }
}
