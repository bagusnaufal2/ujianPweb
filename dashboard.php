<?php
include 'db.php';

$total = $conn->query("SELECT COUNT(*) as count FROM tasks")->fetch_assoc()['count'];
$selesai = $conn->query("SELECT COUNT(*) as count FROM tasks WHERE status = 1")->fetch_assoc()['count'];
$belum_selesai = $conn->query("SELECT COUNT(*) as count FROM tasks WHERE status = 0")->fetch_assoc()['count'];

$prioritas_penting = $conn->query("SELECT COUNT(*) as count FROM tasks WHERE priority = 'Penting'")->fetch_assoc()['count'];
$prioritas_kurangpenting = $conn->query("SELECT COUNT(*) as count FROM tasks WHERE priority = 'Kurang penting'")->fetch_assoc()['count'];
$prioritas_mendesak = $conn->query("SELECT COUNT(*) as count FROM tasks WHERE priority = 'Mendesak'")->fetch_assoc()['count'];
$prioritas_tidakmendesak = $conn->query("SELECT COUNT(*) as count FROM tasks WHERE priority = 'Tidak mendesak'")->fetch_assoc()['count'];

header('Content-Type: application/json');
echo json_encode([
    'total' => $total,
    'selesai' => $selesai,
    'belum_selesai' => $belum_selesai,
    'prioritas_penting' => $prioritas_penting,
    'prioritas_kurangpenting' => $prioritas_kurangpenting,
    'prioritas_mendesak' => $prioritas_mendesak,
    'prioritas_tidakmendesak' => $prioritas_tidakmendesak
]);
?>