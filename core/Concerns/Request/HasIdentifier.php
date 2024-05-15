<?php

namespace Core\Concerns\Request;

use Core\Response;

trait HasIdentifier
{
    private function checkValidId(): mixed
    {
        //Récupérer l'id
        if (!isset($_REQUEST['id']) || !ctype_digit($_REQUEST['id'])) {
            Response::abort(Response::BAD_REQUEST);
        }

        return $_REQUEST['id'];
    }
}
