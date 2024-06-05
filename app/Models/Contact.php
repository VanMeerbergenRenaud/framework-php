<?php

namespace App\Models;

use Core\Database;

class Contact extends Database
{
    protected string $table = 'contacts';

    public function distinctsContacts(int $jiri_id, int $user_id): array
    {
        // Select only the contacts that are not in the attendance table for the given jiri_id for the authorized user
        $sql = <<<SQL
            SELECT * FROM contacts
            WHERE id NOT IN (
                SELECT contact_id FROM attendances
                WHERE jiri_id = :id
            )
            AND user_id = :user_id
            ORDER BY name;
        SQL;

        $statement = $this->prepare($sql);
        $statement->bindValue(':id', $jiri_id);
        $statement->bindValue(':user_id', $user_id);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function jiris(int $id): false|array
    {
        $sql = <<<SQL
            SELECT jiris.id, jiris.name, jiris.starting_at
            FROM jiris
            JOIN attendances ON jiris.id = attendances.jiri_id
            WHERE attendances.contact_id = :id
            ORDER BY jiris.starting_at DESC;
        SQL;

        $statement = $this->prepare($sql);
        $statement->bindValue(':id', $id);
        $statement->execute();
        return $statement->fetchAll();
    }
}