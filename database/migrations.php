<?php

const BASE_PATH = __DIR__ . '/..';
require BASE_PATH . '/vendor/autoload.php';

use Core\Database;

// Get connection to database
$db = new Database(BASE_PATH . '/.env.local.ini');

echo 'Dropping tables';

// Drop all tables from database
$db->dropTables();

echo 'Tables dropped';

$db->exec(<<<SQL
    CREATE TABLE `jiris` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `starting_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
SQL
);

echo 'Tables created';

$jiri_insert_statement = $db->prepare(
    'INSERT INTO jiris (name, starting_at, created_at, updated_at)
    VALUES(:name, :starting_at, :created_at, :updated_at)'
);

$jiris = [
    [
        'name' => 'Projet web 2021',
        'starting_at' => '2021-02-19 14:57:49',
        'created_at' => '2024-02-19 14:57:54',
        'updated_at' => '2024-02-19 14:57:55'
    ], [
        'name' => 'Projet web 2022',
        'starting_at' => '2022-02-19 14:57:49',
        'created_at' => '2024-02-19 14:57:54',
        'updated_at' => '2024-02-19 14:57:55'
    ], [
        'name' => 'Projet web 2023',
        'starting_at' => '2023-02-19 14:57:49',
        'created_at' => '2024-02-19 14:57:54',
        'updated_at' => '2024-02-19 14:57:55'
    ], [
        'name' => 'Projet web 2024',
        'starting_at' => '2024-03-19 14:57:49',
        'created_at' => '2024-02-19 14:57:54',
        'updated_at' => '2024-02-19 14:57:55'
    ], [
        'name' => 'Projet web 2025',
        'starting_at' => '2025-03-19 14:57:49',
        'created_at' => '2024-02-19 14:57:54',
        'updated_at' => '2024-02-19 14:57:55'
    ], [
        'name' => 'Projet web 2026',
        'starting_at' => '2026-03-19 14:57:49',
        'created_at' => '2024-02-19 14:57:54',
        'updated_at' => '2024-02-19 14:57:55'
    ]
];

echo 'Seeding table';

foreach ($jiris as $jiri) {
    $jiri_insert_statement->bindValue('name', $jiri['name']);
    $jiri_insert_statement->bindValue('starting_at', $jiri['starting_at']);
    $jiri_insert_statement->bindValue('created_at', $jiri['created_at']);
    $jiri_insert_statement->bindValue('updated_at', $jiri['updated_at']);
    $jiri_insert_statement->execute();
}

echo 'Jiri table seeded';

// Create tables
// $db->createTables();

// Seed tables
// $db->seedTables();