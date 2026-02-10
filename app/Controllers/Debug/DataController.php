<?php

namespace App\Controllers\Debug;

use App\Controllers\BaseController;

class DataController extends BaseController
{
    public function checkWasteData()
    {
        $db = \Config\Database::connect();
        
        echo "<h1>Debug: Waste Management Data</h1>";
        echo "<style>table { border-collapse: collapse; width: 100%; } th, td { border: 1px solid #ddd; padding: 8px; text-align: left; } th { background-color: #4CAF50; color: white; }</style>";
        
        // Latest 10 records
        echo "<h2>Latest 10 Records</h2>";
        $query = $db->query("SELECT id, unit_id, user_id, jenis_sampah, berat_kg, status, created_at 
                             FROM waste_management 
                             ORDER BY created_at DESC 
                             LIMIT 10");
        $results = $query->getResultArray();
        
        if (empty($results)) {
            echo "<p style='color: red; font-weight: bold;'>NO DATA FOUND IN waste_management TABLE!</p>";
        } else {
            echo "<table>";
            echo "<tr><th>ID</th><th>Unit ID</th><th>User ID</th><th>Jenis Sampah</th><th>Berat (kg)</th><th>Status</th><th>Created At</th></tr>";
            foreach ($results as $row) {
                $statusColor = match($row['status']) {
                    'draft' => '#6c757d',
                    'dikirim_ke_tps' => '#ffc107',
                    'disetujui_tps' => '#28a745',
                    'ditolak_tps' => '#dc3545',
                    default => '#000'
                };
                echo "<tr>";
                echo "<td>{$row['id']}</td>";
                echo "<td>{$row['unit_id']}</td>";
                echo "<td>{$row['user_id']}</td>";
                echo "<td>{$row['jenis_sampah']}</td>";
                echo "<td>{$row['berat_kg']}</td>";
                echo "<td style='color: {$statusColor}; font-weight: bold;'>{$row['status']}</td>";
                echo "<td>{$row['created_at']}</td>";
                echo "</tr>";
            }
            echo "</table>";
        }
        
        // Status summary
        echo "<h2>Status Summary</h2>";
        $statusQuery = $db->query("SELECT status, COUNT(*) as count 
                                   FROM waste_management 
                                   GROUP BY status");
        $statusResults = $statusQuery->getResultArray();
        
        echo "<table>";
        echo "<tr><th>Status</th><th>Count</th></tr>";
        foreach ($statusResults as $row) {
            echo "<tr><td>{$row['status']}</td><td>{$row['count']}</td></tr>";
        }
        echo "</table>";
        
        // Data with status 'dikirim_ke_tps'
        echo "<h2>Data with Status 'dikirim_ke_tps'</h2>";
        $tpsQuery = $db->query("SELECT id, unit_id, user_id, jenis_sampah, berat_kg, status, created_at 
                                FROM waste_management 
                                WHERE status = 'dikirim_ke_tps'
                                ORDER BY created_at DESC");
        $tpsResults = $tpsQuery->getResultArray();
        
        if (empty($tpsResults)) {
            echo "<p style='color: orange; font-weight: bold;'>NO DATA WITH STATUS 'dikirim_ke_tps' FOUND!</p>";
        } else {
            echo "<p style='color: green; font-weight: bold;'>Found " . count($tpsResults) . " records with status 'dikirim_ke_tps'</p>";
            echo "<table>";
            echo "<tr><th>ID</th><th>Unit ID</th><th>User ID</th><th>Jenis Sampah</th><th>Berat (kg)</th><th>Status</th><th>Created At</th></tr>";
            foreach ($tpsResults as $row) {
                echo "<tr>";
                echo "<td>{$row['id']}</td>";
                echo "<td>{$row['unit_id']}</td>";
                echo "<td>{$row['user_id']}</td>";
                echo "<td>{$row['jenis_sampah']}</td>";
                echo "<td>{$row['berat_kg']}</td>";
                echo "<td style='color: #ffc107; font-weight: bold;'>{$row['status']}</td>";
                echo "<td>{$row['created_at']}</td>";
                echo "</tr>";
            }
            echo "</table>";
        }
        
        // Check users
        echo "<h2>Sample Users</h2>";
        $userQuery = $db->query("SELECT id, username, role, unit_id FROM users WHERE role IN ('user', 'pengelola_tps') LIMIT 10");
        $userResults = $userQuery->getResultArray();
        
        echo "<table>";
        echo "<tr><th>ID</th><th>Username</th><th>Role</th><th>Unit ID</th></tr>";
        foreach ($userResults as $user) {
            echo "<tr>";
            echo "<td>{$user['id']}</td>";
            echo "<td>{$user['username']}</td>";
            echo "<td>{$user['role']}</td>";
            echo "<td>{$user['unit_id']}</td>";
            echo "</tr>";
        }
        echo "</table>";
        
        // Check units
        echo "<h2>Units</h2>";
        $unitQuery = $db->query("SELECT id, nama_unit FROM unit LIMIT 10");
        $unitResults = $unitQuery->getResultArray();
        
        echo "<table>";
        echo "<tr><th>ID</th><th>Nama Unit</th></tr>";
        foreach ($unitResults as $unit) {
            echo "<tr>";
            echo "<td>{$unit['id']}</td>";
            echo "<td>{$unit['nama_unit']}</td>";
            echo "</tr>";
        }
        echo "</table>";
        
        echo "<hr>";
        echo "<p><a href='" . base_url() . "'>Back to Home</a></p>";
    }
}
