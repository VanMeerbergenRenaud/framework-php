<?php

namespace Core;

use Core\Exceptions\FileNotFoundException;
use PDO;
use PDOException;
use stdClass;

class Database extends PDO
{
    protected string $table;

    private array $tables;

    private string $database_name;

    public function __construct(string $ini_path)
    {
        if (file_exists($ini_path)) {
            $config = parse_ini_file($ini_path, true);
            $driver = $config['DATABASE']['DB_DRIVER'];
            $host = $config['DATABASE']['DB_HOST'];
            $this->database_name = $config['DATABASE']['DB_NAME'];
            $port = $config['DATABASE']['DB_PORT'];
            $charset = $config['DATABASE']['DB_CHARSET'];
            $username = $config['DATABASE']['DB_USER'];
            $password = $config['DATABASE']['DB_PASSWORD'];
        } else {
            throw new FileNotFoundException('Un problème est apparu dans la phase d’initialisation de l’application');
        }

        $dsn = sprintf(
            '%s:host=%s;port=%s;dbname=%s;charset=%s',
            $driver,
            $host,
            $port,
            $this->database_name,
            $charset
        );

        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        ];

        try {
            parent::__construct($dsn, $username, $password, $options);
        } catch (PDOException $exception) {
            // TODO Rediriger vers une page d'erreur générique qui invite à contacter l'admin
            exit('Un problème de connection avec la base de données est apparu, contactez l’administrateur');
        }

        $this->tables = $this->query('SHOW TABLES')->fetchAll();
    }

    public function dropTables(): void
    {
        foreach ($this->tables as $table) {
            $field_name = "Tables_in_{$this->database_name}";
            $this->exec("DROP TABLE IF EXISTS {$table->$field_name}");
        }
    }

    public function findOrFail(string $id): ?stdClass
    {
        $jiri = $this->find($id);

        if (!$jiri) {
            Response::abort();
        }

        return $jiri;
    }

    public function find(string $id): bool|stdClass
    {
        $sql = <<<SQL
                SELECT * FROM $this->table 
                         WHERE id = :id  
        SQL;
        $statement = $this->prepare($sql);
        $statement->execute(['id' => $id]);

        return $statement->fetch();
    }

    public function delete(string $id): bool
    {
        $sql = <<<SQL
                DELETE FROM $this->table 
                         WHERE id = :id  
        SQL;

        return $this->prepare($sql)->execute(['id' => $id]);
    }

    public function update(string $id, array $data): bool
    {
        $updateString = implode(', ', array_map(static function ($key) {
            return "`$key` = :$key";
        }, array_keys($data)));

        $sql = <<<SQL
            UPDATE $this->table 
            SET $updateString
                WHERE id = :id
        SQL;
        $statement = $this->prepare($sql);
        $statement->bindValue('id', $id);

        foreach ($data as $k => $v) {
            $statement->bindValue($k, $v);
        }

        return $statement->execute();
    }

    public function create(array $data): bool
    {
        $columns = implode(',', array_keys($data));
        $placeholders = implode(', ', array_map(static function ($key) {
            return ":$key";
        }, array_keys($data)));

        $sql = <<<SQL
            INSERT INTO $this->table ($columns)
            VALUES ($placeholders)
        SQL;

        $statement = $this->prepare($sql);

        foreach ($data as $k => $v) {
            $statement->bindValue($k, $v);
        }

        return $statement->execute();
    }

    public function belongingTo(int $id, string $model_name): array
    {
        $foreign_key = "{$model_name}_id";
        $sql = <<<SQL
            SELECT * FROM $this->table
                     WHERE $foreign_key = :id
            SQL;
        $statement = $this->prepare($sql);
        $statement->bindValue(':id', $id);
        $statement->execute();
        return $statement->fetchAll();
    }
}
