<?php

// Seed tables
echo 'Seeding User table'.PHP_EOL;

$password = password_hash('ch4nge_th1s', PASSWORD_DEFAULT);
$users = [
    ['email' => 'dominique.vilain@hepl.be', 'password' => $password],
    ['email' => 'daniel.schreurs@hepl.be', 'password' => $password],
];
$insert_user_in_users_table_sql = 'INSERT INTO users (email, password) VALUES (:email, :password)';
$insert_user_in_users_table_stmt = $db->prepare($insert_user_in_users_table_sql);
foreach ($users as $user) {
    $insert_user_in_users_table_stmt->bindValue('email', $user['email']);
    $insert_user_in_users_table_stmt->bindValue('password', $user['password']);
    $insert_user_in_users_table_stmt->execute();
}
$count_users = count($users);
echo "User table seeded with {$count_users} users".PHP_EOL;

echo 'Seeding Jiri table'.PHP_EOL;
$jiris = [
    ['name' => 'Projets Web 2024', 'starting_at' => '2024-01-19 08:30:00', 'user_id' => '1'],
    ['name' => 'Design Web 2024', 'starting_at' => '2024-06-19 08:30:00', 'user_id' => '1'],
    ['name' => 'Design Web 2022', 'starting_at' => '2022-06-19 08:30:00', 'user_id' => '2'],
    ['name' => 'Design Web 2021', 'starting_at' => '2021-06-19 08:30:00', 'user_id' => '1'],
    ['name' => 'Projets Web 2025', 'starting_at' => '2025-01-19 08:30:00', 'user_id' => '1'],
    ['name' => 'Projets Web 2026', 'starting_at' => '2026-01-19 08:30:00', 'user_id' => '2'],
    ['name' => 'Projets Web 2027', 'starting_at' => '2027-01-19 08:30:00', 'user_id' => '1'],
    ['name' => 'Design Web 2023', 'starting_at' => '2023-06-19 08:30:00', 'user_id' => '2'],
];
$insert_jiri_in_jiris_table_sql = 'INSERT INTO jiris (name, starting_at, user_id) VALUES (:name, :starting_at, :user_id)';
$insert_jiri_in_jiris_table_stmt = $db->prepare($insert_jiri_in_jiris_table_sql);
foreach ($jiris as $jiri) {
    $insert_jiri_in_jiris_table_stmt->bindValue('name', $jiri['name']);
    $insert_jiri_in_jiris_table_stmt->bindValue('starting_at', $jiri['starting_at']);
    $insert_jiri_in_jiris_table_stmt->bindValue('user_id', $jiri['user_id']);
    $insert_jiri_in_jiris_table_stmt->execute();
}
$count_jiris = count($jiris);
echo "Jiri table seeded with {$count_jiris} jiris".PHP_EOL;

echo 'Seeding Contact table'.PHP_EOL;
$contacts = [
    ['name' => 'Shannon Klocko', 'email' => 'tonette.jenkins@hotmail.com', 'user_id' => '1'],
    ['name' => 'Nedra Gleason', 'email' => 'sherley.bartell@yahoo.com', 'user_id' => '1'],
    ['name' => 'Dr. Willis Bogan', 'email' => 'valentin.schowalter@yahoo.com', 'user_id' => '2'],
    ['name' => 'Carolyn McCullough', 'email' => 'willy.hirthe@gmail.com', 'user_id' => '1'],
    ['name' => 'Jeff Kemmer', 'email' => 'louie.jakubowski@yahoo.com', 'user_id' => '1'],
    ['name' => 'Dr. Daniella Murphy', 'email' => 'joannie.ruecker@hotmail.com', 'user_id' => '2'],
    ['name' => 'Hector Harvey', 'email' => 'buster.herzog@hotmail.com', 'user_id' => '2'],
    ['name' => 'Lonnie Ullrich', 'email' => 'julio.gusikowski@gmail.com', 'user_id' => '1'],
    ['name' => 'Lou Kilback', 'email' => 'wayne.bogan@gmail.com', 'user_id' => '2'],
];
$insert_contact_in_contacts_table_sql = 'INSERT INTO contacts (name, email, user_id) VALUES (:name, :email, :user_id)';
$insert_contact_in_contacts_table_stmt = $db->prepare($insert_contact_in_contacts_table_sql);
foreach ($contacts as $contact) {
    $insert_contact_in_contacts_table_stmt->bindValue('name', $contact['name']);
    $insert_contact_in_contacts_table_stmt->bindValue('email', $contact['email']);
    $insert_contact_in_contacts_table_stmt->bindValue('user_id', $contact['user_id']);
    $insert_contact_in_contacts_table_stmt->execute();
}
$count_contacts = count($contacts);
echo "Contact table seeded with {$count_contacts} contacts".PHP_EOL;


echo 'Seeding Attendance table'.PHP_EOL;
$attendances = [
    ['contact_id' => '1', 'jiri_id' => '1', 'role' => 'evaluator'],
    ['contact_id' => '2', 'jiri_id' => '1', 'role' => 'student'],
    ['contact_id' => '3', 'jiri_id' => '3', 'role' => 'evaluator'],
    ['contact_id' => '6', 'jiri_id' => '3', 'role' => 'evaluator'],
    ['contact_id' => '7', 'jiri_id' => '3', 'role' => 'student'],
    ['contact_id' => '4', 'jiri_id' => '5', 'role' => 'evaluator'],
    ['contact_id' => '1', 'jiri_id' => '5', 'role' => 'evaluator'],
];
$insert_attendance_in_attendances_table_sql = 'INSERT INTO attendances (contact_id, jiri_id, role) VALUES (:contact_id, :jiri_id, :role)';
$insert_attendance_in_attendances_table_stmt = $db->prepare($insert_attendance_in_attendances_table_sql);
foreach ($attendances as $attendance) {
    $insert_attendance_in_attendances_table_stmt->bindValue('contact_id', $attendance['contact_id']);
    $insert_attendance_in_attendances_table_stmt->bindValue('jiri_id', $attendance['jiri_id']);
    $insert_attendance_in_attendances_table_stmt->bindValue('role', $attendance['role   ']);
    $insert_attendance_in_attendances_table_stmt->execute();
}
$count_attendances = count($attendances);
echo "Contact table seeded with {$count_attendances} attendances".PHP_EOL;


