<?php
/**
 * Study Partners - Database Connection & CRM Schema Manager
 * Supports SQLite (zero-config, portable) with automatic table creation & demo seeding.
 */

function getDB() {
    static $pdo = null;
    if ($pdo !== null) {
        return $pdo;
    }

    $dbDir = __DIR__ . '/../data';
    if (!is_dir($dbDir)) {
        mkdir($dbDir, 0777, true);
    }

    $dbFile = $dbDir . '/study_partner.sqlite';
    $isNewDB = !file_exists($dbFile);

    try {
        $pdo = new PDO('sqlite:' . $dbFile);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        // Performance & concurrency pragmas
        $pdo->exec('PRAGMA journal_mode = WAL;');
        $pdo->exec('PRAGMA foreign_keys = ON;');

        if ($isNewDB || filesize($dbFile) === 0) {
            initializeSchema($pdo);
        }

        return $pdo;
    } catch (PDOException $e) {
        die('Database initialization error: ' . htmlspecialchars($e->getMessage()));
    }
}

/**
 * Creates tables and seeds initial administrator & sample leads
 */
function initializeSchema(PDO $pdo) {
    // 1. Admin Users Table
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS admin_users (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            username TEXT UNIQUE NOT NULL,
            password_hash TEXT NOT NULL,
            full_name TEXT NOT NULL,
            email TEXT NOT NULL,
            role TEXT DEFAULT 'admin',
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP
        );
    ");

    // 2. Leads Table
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS leads (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            lead_ref TEXT UNIQUE NOT NULL,
            source TEXT NOT NULL,
            full_name TEXT NOT NULL,
            email TEXT NOT NULL,
            phone TEXT NOT NULL,
            country TEXT NOT NULL,
            destination TEXT DEFAULT 'Belarus',
            program TEXT DEFAULT 'General Medicine (MBBS)',
            study_level TEXT DEFAULT 'Undergraduate',
            school_or_institution TEXT,
            grades_or_gpa TEXT,
            passport_no TEXT,
            intake TEXT DEFAULT 'Fall 2026',
            message TEXT,
            status TEXT DEFAULT 'new',
            assigned_agent TEXT DEFAULT 'Harare Admissions Desk',
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
            updated_at DATETIME DEFAULT CURRENT_TIMESTAMP
        );
    ");

    // 3. Lead Notes & Activity Table
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS lead_notes (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            lead_id INTEGER NOT NULL,
            author TEXT NOT NULL,
            note TEXT NOT NULL,
            status_change TEXT,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (lead_id) REFERENCES leads(id) ON DELETE CASCADE
        );
    ");

    // Seed default admin user: admin / admin123
    $checkAdmin = $pdo->query("SELECT COUNT(*) as count FROM admin_users")->fetch();
    if ($checkAdmin['count'] == 0) {
        $stmt = $pdo->prepare("
            INSERT INTO admin_users (username, password_hash, full_name, email, role)
            VALUES (:username, :password_hash, :full_name, :email, :role)
        ");
        $stmt->execute([
            ':username' => 'admin',
            ':password_hash' => password_hash('admin123', PASSWORD_DEFAULT),
            ':full_name' => 'Admissions Director',
            ':email' => 'admissions@studypartners.co.zw',
            ':role' => 'admin'
        ]);
    }

    // Seed demo realistic leads
    $checkLeads = $pdo->query("SELECT COUNT(*) as count FROM leads")->fetch();
    if ($checkLeads['count'] == 0) {
        $seedLeads = [
            [
                'lead_ref' => 'SP-2026-1001',
                'source' => 'Contact Page',
                'full_name' => 'Tendai Moyo',
                'email' => 'tendai.moyo99@gmail.com',
                'phone' => '+263 772 123 456',
                'country' => 'Zimbabwe',
                'destination' => 'Belarus',
                'program' => 'General Medicine (MBBS / MD)',
                'study_level' => 'Undergraduate',
                'school_or_institution' => 'St George\'s College, Harare',
                'grades_or_gpa' => 'A-Level: Biology (A), Chemistry (B), Math (B)',
                'passport_no' => 'FN782914',
                'intake' => 'Fall 2026',
                'message' => 'Interested in Belarusian State Medical University (BSMU). Need guidance on WHO recognition and clinical rotation accreditation.',
                'status' => 'consultation',
                'created_at' => date('Y-m-d H:i:s', strtotime('-2 days'))
            ],
            [
                'lead_ref' => 'SP-2026-1002',
                'source' => 'Application Wizard',
                'full_name' => 'Blessing Ndlovu',
                'email' => 'b.ndlovu@outlook.com',
                'phone' => '+263 719 884 210',
                'country' => 'Zimbabwe',
                'destination' => 'China',
                'program' => 'Computer Science & Artificial Intelligence',
                'study_level' => 'Undergraduate',
                'school_or_institution' => 'Milton High School, Bulawayo',
                'grades_or_gpa' => 'Math (A), Physics (A), Computer Science (A)',
                'passport_no' => 'Pending Renewal',
                'intake' => 'Fall 2026',
                'message' => 'Applying for CSC scholarship in Beijing or Shanghai. Completed Cambridge A-Levels.',
                'status' => 'new',
                'created_at' => date('Y-m-d H:i:s', strtotime('-4 hours'))
            ],
            [
                'lead_ref' => 'SP-2026-1003',
                'source' => 'Contact Page',
                'full_name' => 'Sipho Dlamini',
                'email' => 'sipho.d@yahoo.co.za',
                'phone' => '+27 82 459 3321',
                'country' => 'South Africa',
                'destination' => 'Belarus',
                'program' => 'Dentistry (BDS)',
                'study_level' => 'Undergraduate',
                'school_or_institution' => 'Parktown Boys\' High, Johannesburg',
                'grades_or_gpa' => 'Matric: Physical Sciences (78%), Life Sciences (84%), English (75%)',
                'passport_no' => 'M0049281',
                'intake' => 'Spring 2027',
                'message' => 'Called regarding South African HPCSA registration process after completing BDS in Belarus.',
                'status' => 'contacted',
                'created_at' => date('Y-m-d H:i:s', strtotime('-1 day'))
            ],
            [
                'lead_ref' => 'SP-2026-1004',
                'source' => 'Application Wizard',
                'full_name' => 'Tariro Chitepo',
                'email' => 'tariro.chitepo@gmail.com',
                'phone' => '+263 774 551 902',
                'country' => 'Zimbabwe',
                'destination' => 'Poland',
                'program' => 'International Business Management (BBA)',
                'study_level' => 'Undergraduate',
                'school_or_institution' => 'Dominican Convent, Harare',
                'grades_or_gpa' => 'Economics (A), Accounts (B), Business Studies (A)',
                'passport_no' => 'FN892301',
                'intake' => 'Fall 2026',
                'message' => 'Documents submitted. Target university: University of Warsaw. Ready for visa submission.',
                'status' => 'deal',
                'created_at' => date('Y-m-d H:i:s', strtotime('-5 days'))
            ],
            [
                'lead_ref' => 'SP-2026-1005',
                'source' => 'Partner Inquiry',
                'full_name' => 'Dr. Marek Kowalski',
                'email' => 'international@uni-lodz.edu.pl',
                'phone' => '+48 42 635 4000',
                'country' => 'Poland',
                'destination' => 'Poland',
                'program' => 'Institutional University Partnership',
                'study_level' => 'Partnership',
                'school_or_institution' => 'University of Lodz (Poland)',
                'grades_or_gpa' => 'Accredited EU Public University',
                'passport_no' => 'Official Representative',
                'intake' => 'Academic Year 2026/2027',
                'message' => 'Seeking direct student recruitment agency agreement for African applicants to English-taught degree tracks.',
                'status' => 'contacted',
                'created_at' => date('Y-m-d H:i:s', strtotime('-3 days'))
            ],
            [
                'lead_ref' => 'SP-2026-1006',
                'source' => 'Contact Page',
                'full_name' => 'Kudzai Marume',
                'email' => 'kudzai.marume@gmail.com',
                'phone' => '+263 773 990 114',
                'country' => 'Zimbabwe',
                'destination' => 'Germany',
                'program' => 'Mechanical & Automotive Engineering',
                'study_level' => 'Postgraduate Master\'s',
                'school_or_institution' => 'University of Zimbabwe (BSc Honours)',
                'grades_or_gpa' => 'Upper Second Class (2.1 Honours)',
                'passport_no' => 'FN551982',
                'intake' => 'Spring 2027',
                'message' => 'Looking for English-medium master\'s programs in applied engineering in Germany. Inquiring on block account support.',
                'status' => 'docs_pending',
                'created_at' => date('Y-m-d H:i:s', strtotime('-6 hours'))
            ]
        ];

        $stmt = $pdo->prepare("
            INSERT INTO leads (
                lead_ref, source, full_name, email, phone, country,
                destination, program, study_level, school_or_institution,
                grades_or_gpa, passport_no, intake, message, status, created_at
            ) VALUES (
                :lead_ref, :source, :full_name, :email, :phone, :country,
                :destination, :program, :study_level, :school_or_institution,
                :grades_or_gpa, :passport_no, :intake, :message, :status, :created_at
            )
        ");

        $noteStmt = $pdo->prepare("
            INSERT INTO lead_notes (lead_id, author, note, status_change, created_at)
            VALUES (:lead_id, :author, :note, :status_change, :created_at)
        ");

        foreach ($seedLeads as $lead) {
            $stmt->execute($lead);
            $leadId = $pdo->lastInsertId();

            if ($lead['status'] === 'consultation') {
                $noteStmt->execute([
                    ':lead_id' => $leadId,
                    ':author' => 'Harare Admissions Desk',
                    ':note' => 'Spoke with applicant and parent on WhatsApp. Sent BSMU Medical Curriculum & Fee structure. Very positive response.',
                    ':status_change' => 'consultation',
                    ':created_at' => date('Y-m-d H:i:s', strtotime('-1 day'))
                ]);
            } elseif ($lead['status'] === 'deal') {
                $noteStmt->execute([
                    ':lead_id' => $leadId,
                    ':author' => 'Senior Counselor',
                    ':note' => 'Admission Invitation letter received from Polish partner university! Student paid initial registration fee. Visa appointment scheduled.',
                    ':status_change' => 'deal',
                    ':created_at' => date('Y-m-d H:i:s', strtotime('-2 days'))
                ]);
            } elseif ($lead['status'] === 'contacted') {
                $noteStmt->execute([
                    ':lead_id' => $leadId,
                    ':author' => 'Admissions Team',
                    ':note' => 'Initial introductory email and WhatsApp catalog dispatched. Awaiting response.',
                    ':status_change' => 'contacted',
                    ':created_at' => date('Y-m-d H:i:s', strtotime('-18 hours'))
                ]);
            }
        }
    }
}
