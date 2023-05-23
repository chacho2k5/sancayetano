<?php

namespace App\Actions\Fortify;

use Laravel\Fortify\Rules\Password;

trait PasswordValidationRules
{
    /**
     * Get the validation rules used to validate passwords.
     *
     * @return array
     */
    protected function passwordRules()
    {

        // Require at least 10 characters...
        //(new Password)->length(10)
        return ['required', 'string', new Password, 'confirmed'];
    }
}
