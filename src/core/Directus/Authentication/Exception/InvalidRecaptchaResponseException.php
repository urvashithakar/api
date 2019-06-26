<?php

namespace Directus\Authentication\Exception;

use Directus\Exception\Exception;

class InvalidRecaptchaResponseException extends Exception
{
    const ERROR_CODE = 109;

    public function __construct()
    {
        parent::__construct('Invalid Google Recaptcha Response');
    }
}
