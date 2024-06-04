<?php

namespace App\Models;

use Core\Database;
use stdClass;

class User extends Database
{
    protected string $table = 'users';

    public function findByEmail(string $email): bool|stdClass
    {
        $sql = <<<SQL
                SELECT * FROM $this->table 
                         WHERE email = :email  
        SQL;
        $statement = $this->prepare($sql);
        $statement->execute(['email' => $email]);

        return $statement->fetch();
    }
}
