<?php
// Debug script to check waste_management data
define('FCPATH', __DIR__ . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR);

require __DIR__ . '/vendor/autoload.php';

// Bootstrap CodeIgniter
$pathsConfig = require __DIR__ . '/app/Config/Paths.php';
$paths = new \Config\Paths();

// Load database config
require __DIR__ . '/app/Config/Database.php';

$db = \Config\Database::connect();

echo "=== CHECKING WASTE_MANAGEMENT TABLE ===\n\n";

// Get latest 10 records
echo "Latest 10 records:\n";
echo str_repeat("-", 120) . "\n";
printf("%-5s %-10s %-10s %-20s %-10s %-20s %-20s\n", 
    "ID", "unit_id", "user_id", "jenis_sampah", "berat_kg", "status", "created_at");
echo str_repeat("-", 120) . "\n";

$query = $db->query("SELECT id, unit_id, user_id, jenis_sampah, berat_kg, status, created_at 
                     FROM waste_management 
                     ORDER BY created_at DESC 
                     LIMIT 10");

$results = $query->getResultArray();

if (empty($results)) {
    echo "NO DATA FOUND!\n";
} else {
    foreach ($results as $row) {
        printf("%-5s %-10s %-10s %-20s %-10s %-20s %-20s\n",
            $row['id'],
            $row['unit_id'] ?? 'NULL',
            $row['user_id'] ?? 'NULL',
            substr($row['jenis_sampah'] ?? 'NULL', 0, 20),
            $row['berat_kg'] ?? 'NULL',
            $row['status'] ?? 'NULL',
            $row['created_at'] ?? 'NULL'
        );
    }
}

echo "\n\n=== STATUS SUMMARY ===\n";
$statusQuery = $db->query("SELECT status, COUNT(*) as count 
                           FROM waste_management 
                           GROUP BY status");
$statusResults = $statusQuery->getResultArray();

foreach ($statusResults as $row) {
    echo "Status: " . ($row['status'] ?? 'NULL') . " - Count: " . $row['count'] . "\n";
}

echo "\n\n=== DATA WITH STATUS 'dikirim_ke_tps' ===\n";
$tpsQuery = $db->query("SELECT id, unit_id, user_id, jenis_sampah, berat_kg, status, created_at 
                        FROM waste_management 
                        WHERE status = 'dikirim_ke_tps'
                        ORDER BY created_at DESC");
$tpsResults = $tpsQuery->getResultArray();

if (empty($tpsResults)) {
    echo "NO DATA WITH STATUS 'dikirim_ke_tps' FOUND!\n";
} else {
    echo "Found " . count($tpsResults) . " records:\n";
    echo str_repeat("-", 120) . "\n";
    printf("%-5s %-10s %-10s %-20s %-10s %-20s %-20s\n", 
        "ID", "unit_id", "user_id", "jenis_sampah", "berat_kg", "status", "created_at");
    echo str_repeat("-", 120) . "\n";
    
    foreach ($tpsResults as $row) {
        printf("%-5s %-10s %-10s %-20s %-10s %-20s %-20s\n",
            $row['id'],
            $row['unit_id'] ?? 'NULL',
            $row['user_id'] ?? 'NULL',
            substr($row['jenis_sampah'] ?? 'NULL', 0, 20),
            $row['berat_kg'] ?? 'NULL',
            $row['status'] ?? 'NULL',
            $row['created_at'] ?? 'NULL'
        );
    }
}

echo "\n\n=== CHECKING USERS ===\n";
$userQuery = $db->query("SELECT id, username, role, unit_id FROM users WHERE role IN ('user', 'pengelola_tps') LIMIT 5");
$userResults = $userQuery->getResultArray();

echo "Sample users:\n";
foreach ($userResults as $user) {
    echo "ID: {$user['id']}, Username: {$user['username']}, Role: {$user['role']}, Unit ID: {$user['unit_id']}\n";
}

echo "\n\nDone!\n";
