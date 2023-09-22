<?php

namespace App\Rules;
use Illuminate\Contracts\Validation\Rule;

class AccessoryValidator implements Rule
{   
    protected $messageErr;
    /**
     * Create a new rule instance.
     *
     * @return void
     */

    public function __construct()
    {  
        $this->messageErr = "";
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
            $this->messageErr = "El valor no es un array";
            return false;

        }
        foreach($value as $item){
            if(!is_array($item)){
                $this->messageErr = "El valor no es un array de arrays";
                return false;
            }
            if(!array_key_exists("name",$item) || !array_key_exists("price",$item)){
                $this->messageErr = "El array no tiene las llaves name o price";
                //validar que los valores de name y price sean string y numerico
                
                return false;
            }
            if(!is_string($item["name"]) || !is_numeric($item["price"])){
                $this->messageErr = "El valor de name no es string o el valor de price no es numerico";
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
        return $this->messageErr;
    }
}
