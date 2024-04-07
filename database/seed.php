<?php

$jiri_insert_statement = $db->prepare('INSERT INTO jiris(name, starting_at)
VALUES (:name, :starting_at)');

$jiris = [
    ['name' => 'Projet Web 2019', 'starting_at' => '2019-01-19 08:30:00'],
    ['name' => 'Design Web 2020', 'starting_at' => '2020-06-19 08:30:00'],
    ['name' => 'Projet Web 2021', 'starting_at' => '2021-01-19 08:30:00'],
    ['name' => 'Design Web 2022', 'starting_at' => '2022-06-19 08:30:00'],
    ['name' => 'Design Web 2023', 'starting_at' => '2023-06-19 08:30:00'],
    ['name' => 'Design Web 2024', 'starting_at' => '2024-06-19 08:30:00'],
    ['name' => 'Design Web 2025', 'starting_at' => '2025-06-19 08:30:00'],
    ['name' => 'Design Web 2026', 'starting_at' => '2026-06-19 08:30:00'],
];

echo 'Seeding jiri table' . PHP_EOL;

foreach ($jiris as $jiri) {
    $jiri_insert_statement->bindValue('name', $jiri['name']);
    $jiri_insert_statement->bindValue('starting_at', $jiri['starting_at']);
    $jiri_insert_statement->execute();
}

echo 'Jiri table seeded' . PHP_EOL;