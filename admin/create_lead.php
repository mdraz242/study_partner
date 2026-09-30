<?php
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/db.php';

requireLogin();
$currentAdmin = getCurrentAdmin();

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    exit;
}

$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$phone = trim($_POST['phone'] ?? '');
$country = trim($_POST['country_origin'] ?? 'Zimbabwe');
$destination = trim($_POST['destination'] ?? 'Belarus');
$program = trim($_POST['program_interest'] ?? 'General Inquiry');
$degree = trim($_POST['degree_level'] ?? 'Undergraduate');
$status = trim($_POST['status'] ?? 'new');
$source = trim($_POST['source'] ?? 'Harare Office Walk-in');
$notes = trim($_POST['notes'] ?? '');

if ($name === '' || ($email === '' && $phone === '')) {
    echo json_encode(['success' => false, 'message' => 'Name and either Phone or Email are required']);
    exit;
}

try {
    $db = getDB();
    $ref = 'SP-' . date('Y') . '-' . mt_rand(1000, 9999);

    $stmt = $db->prepare("
        INSERT INTO leads (
            lead_ref, full_name, email, phone, country,
            destination, study_level, program, source, status, message, created_at, updated_at
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)
    ");
    $stmt->execute([
        $ref,
        $name,
        $email,
        $phone,
        $country,
        $destination,
        $degree,
        $program,
        $source,
        $status,
        $notes
    ]);

    $leadId = $db->lastInsertId();

    // Add initial note
    $adminName = $currentAdmin['full_name'] ?? $currentAdmin['username'] ?? 'Admin';
    $noteText = "Lead manually created by {$adminName} via CRM ({$source})";
    if ($notes !== '') {
        $noteText .= ". Initial Notes: " . $notes;
    }
    $noteStmt = $db->prepare("INSERT INTO lead_notes (lead_id, author, note, status_change, created_at) VALUES (?, ?, ?, ?, CURRENT_TIMESTAMP)");
    $noteStmt->execute([$leadId, $adminName, $noteText, $status]);

    echo json_encode([
        'success' => true,
        'message' => 'Lead created successfully',
        'reference' => $ref,
        'lead_id' => $leadId
    ]);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
}
