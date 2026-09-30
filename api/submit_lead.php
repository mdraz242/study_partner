<?php
/**
 * Study Partners - Public Lead Submission API
 * Captures inquiries from Contact Form, Apply Wizard, and Partner Form.
 */

header('Content-Type: application/json; charset=UTF-8');
require_once __DIR__ . '/../includes/db.php';

// Accept both JSON payload and standard form-encoded POST
$rawInput = file_get_contents('php://input');
$jsonData = json_decode($rawInput, true);

$data = !empty($jsonData) && is_array($jsonData) ? $jsonData : $_POST;

if (empty($data)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'No submission data received.']);
    exit;
}

// Extract and sanitize fields
$source = trim($data['source'] ?? 'Website Inquiry');
$fullName = trim($data['fullName'] ?? $data['full_name'] ?? $data['contactName'] ?? $data['repName'] ?? '');
$email = trim($data['email'] ?? $data['contactEmail'] ?? $data['repEmail'] ?? '');
$phone = trim($data['phone'] ?? $data['contactPhone'] ?? $data['repPhone'] ?? '');
$country = trim($data['country'] ?? $data['contactCountry'] ?? $data['uniCountry'] ?? 'Zimbabwe');
$destination = trim($data['destination'] ?? 'Belarus');
$program = trim($data['program'] ?? $data['contactProgram'] ?? 'General Medicine (MBBS)');
$studyLevel = trim($data['level'] ?? $data['study_level'] ?? 'Undergraduate');
$school = trim($data['schoolName'] ?? $data['uniName'] ?? $data['school_or_institution'] ?? '');
$grades = trim($data['gradeGPA'] ?? $data['grades_or_gpa'] ?? '');
$passport = trim($data['passportNo'] ?? $data['passport_no'] ?? '');
$intake = trim($data['intake'] ?? $data['targetIntake'] ?? 'Fall 2026');
$message = trim($data['message'] ?? $data['contactMessage'] ?? $data['repMessage'] ?? '');

// Fallback validation
if (empty($fullName) || empty($email)) {
    http_response_code(422);
    echo json_encode(['success' => false, 'error' => 'Full name and email address are required.']);
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(422);
    echo json_encode(['success' => false, 'error' => 'Please provide a valid email address.']);
    exit;
}

try {
    $pdo = getDB();

    // Generate unique Lead Reference (e.g. SP-2026-4821)
    $leadRef = 'SP-' . date('Y') . '-' . mt_rand(1000, 9999);

    $stmt = $pdo->prepare("
        INSERT INTO leads (
            lead_ref, source, full_name, email, phone, country,
            destination, program, study_level, school_or_institution,
            grades_or_gpa, passport_no, intake, message, status, created_at, updated_at
        ) VALUES (
            :lead_ref, :source, :full_name, :email, :phone, :country,
            :destination, :program, :study_level, :school_or_institution,
            :grades_or_gpa, :passport_no, :intake, :message, 'new', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP
        )
    ");

    $stmt->execute([
        ':lead_ref' => $leadRef,
        ':source' => $source,
        ':full_name' => $fullName,
        ':email' => $email,
        ':phone' => $phone,
        ':country' => $country,
        ':destination' => $destination,
        ':program' => $program,
        ':study_level' => $studyLevel,
        ':school_or_institution' => $school,
        ':grades_or_gpa' => $grades,
        ':passport_no' => $passport,
        ':intake' => $intake,
        ':message' => $message
    ]);

    $leadId = $pdo->lastInsertId();

    // Log creation note in timeline
    $noteStmt = $pdo->prepare("
        INSERT INTO lead_notes (lead_id, author, note, status_change, created_at)
        VALUES (:lead_id, 'System', :note, 'new', CURRENT_TIMESTAMP)
    ");
    $noteStmt->execute([
        ':lead_id' => $leadId,
        ':note' => "Lead captured via {$source}. Initial status assigned as New Inquiry."
    ]);

    echo json_encode([
        'success' => true,
        'lead_id' => $leadId,
        'lead_ref' => $leadRef,
        'message' => 'Thank you! Your inquiry has been registered with reference ' . $leadRef . '. Our admissions counselor will follow up promptly.'
    ]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'error' => 'Database error: ' . $e->getMessage()]);
}
