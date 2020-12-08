<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class DiscordLinkRule implements Rule
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
        $regex = [];
        preg_match('/(https?:\/\/discord.gg\/)(\w{1,})/', $value, $regex);
        if(str_contains($value, $regex[1])) {
            return true;
        }
        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The discord link provided is not a discord invite link.';
    }
}
