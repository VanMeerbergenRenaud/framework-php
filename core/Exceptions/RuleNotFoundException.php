<?php

namespace Core\Exceptions;

class RuleNotFoundException extends \Exception
{
    public function __construct(string $message = '')
    {
        parent::__construct($message);
    }
}
