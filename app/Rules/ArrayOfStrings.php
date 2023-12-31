<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ArrayOfStrings implements Rule
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
        if(!is_array($value)){
            return false;
        }
        foreach($value as $item){
            if(!is_string($item)){
                return false;
            }
        }
        return true;
        //
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Los elementos del array deben ser de tipo  string perra o usa un maldito arraaay';
    }
}
