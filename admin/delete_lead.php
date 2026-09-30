<?php
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/db.php';

requireLogin();

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    exit;
}

$leadId = isset($_POST['lead_id']) ? (int)$_POST['lead_id'] : 0;
if ($leadId <= 0) {
    echo json_encode(['success' => false, 'message' => 'Invalid lead ID']);
    exit;
}

try {
    $db = getDB();
    $db->prepare("DELETE FROM lead_notes WHERE lead_id = ?")->execute([$leadId]);
    $stmt = $db->prepare("DELETE FROM leads WHERE id = ?");
    $stmt->execute([$leadId]);

    echo json_encode(['success' => true, 'message' => 'Lead deleted successfully']);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Failed to delete lead: ' . $e->getMessage()]);
}
