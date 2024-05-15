<?php

namespace Core\Exceptions;

class MiddlewareNotFoundException extends \Exception
{
    public function __construct(string $name)
    {
        parent::__construct($name);
    }
}
