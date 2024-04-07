<?php

use Core\Database;

// Get connection from db
$db = new Database(BASE_PATH . '/.env.local.ini');

// Drop all the tables from db
echo 'Dropping tables' . PHP_EOL;
$db->dropTables();
echo 'Tables dropped' . PHP_EOL;
echo 'Creating tables' . PHP_EOL;

// Create table
$db->exec(<<<SQL
    create table jiris
    (
        id int auto_increment primary key,
        name varchar(255) not null,
        starting_at timestamp not null,
        created_at timestamp default CURRENT_TIMESTAMP not null,
        updated_at timestamp default CURRENT_TIMESTAMP not null on update CURRENT_TIMESTAMP
    );
SQL
);
echo 'Tables created' . PHP_EOL;