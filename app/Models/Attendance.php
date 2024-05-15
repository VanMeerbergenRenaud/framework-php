<?php

namespace App\Models;

use Core\Database;

class Attendance extends Database
{
    protected string $table = 'attendances';

    public function setRole(array $data): bool
    {
        $sql = <<<SQL
            UPDATE $this->table 
            SET role = :role
                WHERE jiri_id = :jiri_id
            AND contact_id = :contact_id
        SQL;

        $statement = $this->prepare($sql);
        $statement->bindValue('role', $data['role']);
        $statement->bindValue('jiri_id', $data['jiri_id']);
        $statement->bindValue('contact_id', $data['contact_id']);

        return $statement->execute();
    }
}