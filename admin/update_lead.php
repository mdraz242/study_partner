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

$leadId = isset($_POST['lead_id']) ? (int)$_POST['lead_id'] : 0;
$action = isset($_POST['action']) ? trim($_POST['action']) : 'update_status';

if ($leadId <= 0) {
    echo json_encode(['success' => false, 'message' => 'Missing valid lead ID']);
    exit;
}

$db = getDB();

// Verify lead exists
$stmt = $db->prepare("SELECT * FROM leads WHERE id = ?");
$stmt->execute([$leadId]);
$lead = $stmt->fetch();

if (!$lead) {
    echo json_encode(['success' => false, 'message' => 'Lead not found']);
    exit;
}

try {
    if ($action === 'update_status') {
        $allowedStatuses = ['new', 'contacted', 'consultation', 'docs_pending', 'deal', 'lost'];
        $newStatus = isset($_POST['status']) ? trim($_POST['status']) : '';
        $note = isset($_POST['note']) ? trim($_POST['note']) : '';

        if (!in_array($newStatus, $allowedStatuses, true)) {
            echo json_encode(['success' => false, 'message' => 'Invalid status']);
            exit;
        }

        $oldStatus = $lead['status'];

        $updateStmt = $db->prepare("UPDATE leads SET status = ?, updated_at = CURRENT_TIMESTAMP WHERE id = ?");
        $updateStmt->execute([$newStatus, $leadId]);

        // If status changed or note provided, log to lead_notes
        $noteText = "Status changed from " . strtoupper($oldStatus) . " to " . strtoupper($newStatus);
        if ($note !== '') {
            $noteText .= ". Note: " . $note;
        }

        $noteStmt = $db->prepare("INSERT INTO lead_notes (lead_id, author, note) VALUES (?, ?, ?)");
        $noteStmt->execute([$leadId, $currentAdmin['name'] ?? 'Admin', $noteText]);

        echo json_encode([
            'success' => true,
            'message' => 'Status updated successfully',
            'lead_id' => $leadId,
            'status' => $newStatus,
            'updated_at' => date('Y-m-d H:i')
        ]);
        exit;
    }

    if ($action === 'add_note') {
        $note = isset($_POST['note']) ? trim($_POST['note']) : '';
        if ($note === '') {
            echo json_encode(['success' => false, 'message' => 'Note content cannot be empty']);
            exit;
        }

        $noteStmt = $db->prepare("INSERT INTO lead_notes (lead_id, author, note) VALUES (?, ?, ?)");
        $noteStmt->execute([$leadId, $currentAdmin['name'] ?? 'Admin', $note]);

        // Touch updated_at
        $db->prepare("UPDATE leads SET updated_at = CURRENT_TIMESTAMP WHERE id = ?")->execute([$leadId]);

        echo json_encode([
            'success' => true,
            'message' => 'Note added successfully',
            'note' => [
                'author' => $currentAdmin['name'] ?? 'Admin',
                'note' => htmlspecialchars($note),
                'created_at' => date('Y-m-d H:i')
            ]
        ]);
        exit;
    }

    if ($action === 'get_details') {
        $notesStmt = $db->prepare("SELECT * FROM lead_notes WHERE lead_id = ? ORDER BY id DESC");
        $notesStmt->execute([$leadId]);
        $notes = $notesStmt->fetchAll();

        echo json_encode([
            'success' => true,
            'lead' => $lead,
            'notes' => $notes
        ]);
        exit;
    }

    echo json_encode(['success' => false, 'message' => 'Unknown action']);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
}
