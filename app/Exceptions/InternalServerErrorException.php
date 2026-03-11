<?php

namespace App\Exceptions;

use App\Http\Responses\BaseAPIResponse;
use Exception;

class InternalServerErrorException extends Exception
{
    public function __construct(string $message = 'Internal Server Error', int $code = 500)
    {
        parent::__construct($message, $code);
    }

    public function render()
    {
        return BaseAPIResponse::error($this->getMessage(), $this->getCode());
    }
}
