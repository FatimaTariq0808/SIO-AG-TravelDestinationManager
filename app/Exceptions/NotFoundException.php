<?php

namespace App\Exceptions;
use App\Http\Responses\BaseAPIResponse;
use Exception;

class NotFoundException extends Exception
{
    public function __construct($message = 'Data not found.', $code = 404)
    {
        parent::__construct($message, $code);
    }
    public function render()
    {
        return BaseAPIResponse::error($this->getMessage(), $this->getCode());
    }
}