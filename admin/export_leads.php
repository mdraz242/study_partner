<?php
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/db.php';

requireLogin();

$status = isset($_GET['status']) ? trim($_GET['status']) : '';
$destination = isset($_GET['destination']) ? trim($_GET['destination']) : '';
$source = isset($_GET['source']) ? trim($_GET['source']) : '';
$search = isset($_GET['q']) ? trim($_GET['q']) : '';

$db = getDB();

$query = "SELECT * FROM leads WHERE 1=1";
$params = [];

if ($status !== '' && $status !== 'all') {
    $query .= " AND status = ?";
    $params[] = $status;
}
if ($destination !== '' && $destination !== 'all') {
    $query .= " AND destination = ?";
    $params[] = $destination;
}
if ($source !== '' && $source !== 'all') {
    $query .= " AND source = ?";
    $params[] = $source;
}
if ($search !== '') {
    $query .= " AND (full_name LIKE ? OR email LIKE ? OR phone LIKE ? OR lead_ref LIKE ?)";
    $like = "%$search%";
    $params[] = $like;
    $params[] = $like;
    $params[] = $like;
    $params[] = $like;
}

$query .= " ORDER BY id DESC";

$stmt = $db->prepare($query);
$stmt->execute($params);
$leads = $stmt->fetchAll();

$filename = 'study_partners_leads_' . date('Ymd_His') . '.csv';

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=' . $filename);

$output = fopen('php://output', 'w');

// UTF-8 BOM for Excel
fprintf($output, chr(0xEF).chr(0xBB).chr(0xBF));

fputcsv($output, [
    'Ref Code',
    'Date Created',
    'Student Full Name',
    'Email Address',
    'Phone / WhatsApp',
    'Country of Origin',
    'Inquiry Source',
    'Destination Country',
    'Degree Level',
    'Program of Interest',
    'Target Intake',
    'Pipeline Status',
    'Student Message / Notes'
], ',', '"', "\\");

foreach ($leads as $l) {
    fputcsv($output, [
        $l['lead_ref'],
        $l['created_at'],
        $l['full_name'],
        $l['email'],
        $l['phone'],
        $l['country'],
        $l['source'],
        $l['destination'],
        $l['study_level'],
        $l['program'],
        $l['intake'],
        strtoupper($l['status']),
        $l['message']
    ], ',', '"', "\\");
}

fclose($output);
exit;
