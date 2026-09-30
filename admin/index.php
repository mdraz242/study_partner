<?php
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/db.php';

requireLogin();
$currentAdmin = getCurrentAdmin();
$db = getDB();

// Parameters
$statusFilter = isset($_GET['status']) ? trim($_GET['status']) : '';
$destinationFilter = isset($_GET['destination']) ? trim($_GET['destination']) : '';
$sourceFilter = isset($_GET['source']) ? trim($_GET['source']) : '';
$searchQuery = isset($_GET['q']) ? trim($_GET['q']) : '';

// KPI Counts
$kpis = [
    'total' => (int)$db->query("SELECT COUNT(*) FROM leads")->fetchColumn(),
    'new' => (int)$db->query("SELECT COUNT(*) FROM leads WHERE status = 'new'")->fetchColumn(),
    'contacted' => (int)$db->query("SELECT COUNT(*) FROM leads WHERE status = 'contacted'")->fetchColumn(),
    'consultation' => (int)$db->query("SELECT COUNT(*) FROM leads WHERE status = 'consultation'")->fetchColumn(),
    'docs_pending' => (int)$db->query("SELECT COUNT(*) FROM leads WHERE status = 'docs_pending'")->fetchColumn(),
    'deal' => (int)$db->query("SELECT COUNT(*) FROM leads WHERE status = 'deal'")->fetchColumn(),
    'lost' => (int)$db->query("SELECT COUNT(*) FROM leads WHERE status = 'lost'")->fetchColumn()
];

// Query Leads
$sql = "SELECT * FROM leads WHERE 1=1";
$params = [];

if ($statusFilter !== '' && $statusFilter !== 'all') {
    $sql .= " AND status = ?";
    $params[] = $statusFilter;
}
if ($destinationFilter !== '' && $destinationFilter !== 'all') {
    $sql .= " AND destination = ?";
    $params[] = $destinationFilter;
}
if ($sourceFilter !== '' && $sourceFilter !== 'all') {
    $sql .= " AND source = ?";
    $params[] = $sourceFilter;
}
if ($searchQuery !== '') {
    $sql .= " AND (full_name LIKE ? OR email LIKE ? OR phone LIKE ? OR lead_ref LIKE ?)";
    $like = "%$searchQuery%";
    $params[] = $like;
    $params[] = $like;
    $params[] = $like;
    $params[] = $like;
}

$sql .= " ORDER BY id DESC";
$stmt = $db->prepare($sql);
$stmt->execute($params);
$leads = $stmt->fetchAll();

// Distinct destinations and sources for filters
$destinations = $db->query("SELECT DISTINCT destination FROM leads WHERE destination IS NOT NULL AND destination != '' ORDER BY destination ASC")->fetchAll(PDO::FETCH_COLUMN);
$sources = $db->query("SELECT DISTINCT source FROM leads WHERE source IS NOT NULL AND source != '' ORDER BY source ASC")->fetchAll(PDO::FETCH_COLUMN);

// Status config helper
$statusConfig = [
    'new' => ['label' => 'New Lead', 'bg' => '#EBF5FF', 'color' => '#1E40AF', 'badge' => 'status-new'],
    'contacted' => ['label' => 'Contacted', 'bg' => '#FEF3C7', 'color' => '#92400E', 'badge' => 'status-contacted'],
    'consultation' => ['label' => 'In Consultation', 'bg' => '#EDE9FE', 'color' => '#5B21B6', 'badge' => 'status-consultation'],
    'docs_pending' => ['label' => 'Docs Pending', 'bg' => '#FFFBEB', 'color' => '#B45309', 'badge' => 'status-docs_pending'],
    'deal' => ['label' => 'Deal / Admitted', 'bg' => '#ECFDF5', 'color' => '#065F46', 'badge' => 'status-deal'],
    'lost' => ['label' => 'Lost / Dropped', 'bg' => '#FEE2E2', 'color' => '#991B1B', 'badge' => 'status-lost']
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRM Leads Management | Study Partners Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Outfit:wght@500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --brand-primary: #0D6938;
            --brand-primary-dark: #094F2A;
            --brand-gold: #E5A812;
            --brand-accent: #22c55e;
            --slate-50: #f8fafc;
            --slate-100: #f1f5f9;
            --slate-200: #e2e8f0;
            --slate-300: #cbd5e1;
            --slate-400: #94a3b8;
            --slate-500: #64748b;
            --slate-600: #475569;
            --slate-700: #334155;
            --slate-800: #1e293b;
            --slate-900: #0f172a;
            --radius-md: 10px;
            --radius-lg: 14px;
            --shadow-sm: 0 1px 3px rgba(0,0,0,0.06);
            --shadow-md: 0 4px 12px rgba(0,0,0,0.07);
            --shadow-lg: 0 10px 25px rgba(0,0,0,0.1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
        }

        body {
            background-color: #F8FAFC;
            color: var(--slate-800);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Top Navigation Bar */
        .topbar {
            background: #ffffff;
            border-bottom: 1px solid var(--slate-200);
            padding: 0.85rem 1.75rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 40;
            box-shadow: var(--shadow-sm);
        }

        .brand-container {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .brand-logo {
            height: 40px;
            width: auto;
            object-fit: contain;
        }

        .brand-title {
            font-size: 1.15rem;
            font-weight: 700;
            color: var(--brand-primary);
            letter-spacing: -0.02em;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .brand-badge {
            font-size: 0.7rem;
            font-weight: 700;
            background: #FEF3C7;
            color: #92400E;
            padding: 2px 8px;
            border-radius: 9999px;
            border: 1px solid #FDE68A;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .topbar-actions {
            display: flex;
            align-items: center;
            gap: 0.85rem;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.55rem 1.1rem;
            font-size: 0.85rem;
            font-weight: 600;
            border-radius: var(--radius-md);
            text-decoration: none;
            border: 1px solid transparent;
            cursor: pointer;
            transition: all 0.15s ease;
        }

        .btn-primary {
            background: var(--brand-primary);
            color: white;
            box-shadow: 0 2px 6px rgba(13,105,56,0.25);
        }

        .btn-primary:hover {
            background: var(--brand-primary-dark);
            transform: translateY(-1px);
        }

        .btn-secondary {
            background: white;
            border-color: var(--slate-300);
            color: var(--slate-700);
        }

        .btn-secondary:hover {
            background: var(--slate-50);
            border-color: var(--slate-400);
        }

        .btn-danger {
            background: #FEE2E2;
            color: #991B1B;
            border-color: #FECACA;
        }

        .btn-danger:hover {
            background: #FCA5A5;
        }

        .admin-profile {
            display: flex;
            align-items: center;
            gap: 0.6rem;
            padding: 0.4rem 0.8rem;
            background: var(--slate-100);
            border-radius: var(--radius-md);
            font-size: 0.82rem;
            color: var(--slate-700);
            font-weight: 600;
        }

        .admin-avatar {
            width: 28px;
            height: 28px;
            background: var(--brand-primary);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.8rem;
            font-weight: 700;
        }

        /* Main Container */
        .admin-container {
            max-width: 1440px;
            margin: 0 auto;
            padding: 1.75rem 1.5rem 3rem 1.5rem;
            width: 100%;
        }

        /* Welcome & Office Bar */
        .dashboard-header {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: flex-end;
            margin-bottom: 1.5rem;
            gap: 1rem;
        }

        .dashboard-header h1 {
            font-size: 1.65rem;
            font-weight: 800;
            color: var(--slate-900);
            letter-spacing: -0.02em;
        }

        .dashboard-header p {
            font-size: 0.88rem;
            color: var(--slate-500);
            margin-top: 0.2rem;
        }

        .office-tag {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            font-size: 0.8rem;
            color: var(--slate-600);
            background: white;
            padding: 0.4rem 0.8rem;
            border-radius: var(--radius-md);
            border: 1px solid var(--slate-200);
        }

        /* KPI Cards Grid */
        .kpi-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 1rem;
            margin-bottom: 1.75rem;
        }

        .kpi-card {
            background: white;
            border-radius: var(--radius-lg);
            padding: 1.15rem 1.25rem;
            border: 1px solid var(--slate-200);
            box-shadow: var(--shadow-sm);
            position: relative;
            overflow: hidden;
            transition: transform 0.15s ease, box-shadow 0.15s ease;
            text-decoration: none;
            color: inherit;
            display: block;
        }

        .kpi-card:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .kpi-card.active {
            border-color: var(--brand-primary);
            box-shadow: 0 0 0 2px rgba(13,105,56,0.2);
        }

        .kpi-card::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 4px;
            background: var(--card-accent, var(--slate-400));
        }

        .kpi-label {
            font-size: 0.78rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--slate-500);
            margin-bottom: 0.4rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .kpi-value {
            font-size: 1.75rem;
            font-weight: 800;
            color: var(--slate-900);
            line-height: 1;
        }

        /* Filter Controls */
        .controls-card {
            background: white;
            border-radius: var(--radius-lg);
            padding: 1.25rem;
            border: 1px solid var(--slate-200);
            box-shadow: var(--shadow-sm);
            margin-bottom: 1.5rem;
        }

        .filters-form {
            display: flex;
            flex-wrap: wrap;
            gap: 0.85rem;
            align-items: center;
        }

        .search-box {
            flex: 1 1 280px;
            position: relative;
        }

        .search-box i {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--slate-400);
            font-size: 0.85rem;
        }

        .search-box input {
            width: 100%;
            padding: 0.6rem 1rem 0.6rem 2.4rem;
            border: 1px solid var(--slate-200);
            border-radius: var(--radius-md);
            font-size: 0.88rem;
            background: var(--slate-50);
            outline: none;
            transition: all 0.15s ease;
        }

        .search-box input:focus {
            background: white;
            border-color: var(--brand-primary);
            box-shadow: 0 0 0 3px rgba(13,105,56,0.1);
        }

        .filter-select {
            padding: 0.6rem 2.2rem 0.6rem 0.9rem;
            border: 1px solid var(--slate-200);
            border-radius: var(--radius-md);
            font-size: 0.85rem;
            background: var(--slate-50);
            font-weight: 500;
            color: var(--slate-700);
            outline: none;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%2364748b'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 0.75rem center;
            background-size: 0.9rem;
            cursor: pointer;
        }

        .filter-select:focus {
            background-color: white;
            border-color: var(--brand-primary);
        }

        /* Leads Table */
        .table-card {
            background: white;
            border-radius: var(--radius-lg);
            border: 1px solid var(--slate-200);
            box-shadow: var(--shadow-sm);
            overflow: hidden;
        }

        .table-responsive {
            width: 100%;
            overflow-x: auto;
        }

        table.leads-table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
            font-size: 0.85rem;
        }

        table.leads-table th {
            background: #F8FAFC;
            padding: 0.85rem 1rem;
            color: var(--slate-600);
            font-weight: 700;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            border-bottom: 1px solid var(--slate-200);
            white-space: nowrap;
        }

        table.leads-table td {
            padding: 0.95rem 1rem;
            border-bottom: 1px solid var(--slate-200);
            vertical-align: middle;
        }

        table.leads-table tr:last-child td {
            border-bottom: none;
        }

        table.leads-table tr:hover {
            background: #F8FAFC;
        }

        .lead-ref {
            font-family: monospace;
            font-weight: 700;
            color: var(--slate-600);
            background: var(--slate-100);
            padding: 2px 6px;
            border-radius: 4px;
            font-size: 0.75rem;
            display: inline-block;
        }

        .lead-name {
            font-weight: 700;
            color: var(--slate-900);
            font-size: 0.92rem;
            margin-bottom: 0.15rem;
        }

        .lead-sub {
            font-size: 0.76rem;
            color: var(--slate-500);
            display: flex;
            align-items: center;
            gap: 0.35rem;
        }

        .lead-contact-links {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-top: 0.3rem;
        }

        .contact-pill {
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
            padding: 2px 7px;
            font-size: 0.73rem;
            border-radius: 4px;
            text-decoration: none;
            font-weight: 600;
            transition: opacity 0.15s;
        }

        .pill-whatsapp {
            background: #DCFCE7;
            color: #15803D;
        }

        .pill-email {
            background: #E0F2FE;
            color: #0369A1;
        }

        .pill-call {
            background: #F3E8FF;
            color: #7E22CE;
        }

        .contact-pill:hover {
            opacity: 0.8;
        }

        .dest-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            font-weight: 600;
            color: var(--slate-700);
            background: var(--slate-100);
            padding: 3px 8px;
            border-radius: 6px;
            font-size: 0.78rem;
        }

        .source-tag {
            font-size: 0.75rem;
            color: var(--slate-500);
            display: inline-block;
            background: #F1F5F9;
            padding: 2px 6px;
            border-radius: 4px;
        }

        /* Status Select in Table */
        .status-dropdown {
            font-size: 0.78rem;
            font-weight: 700;
            padding: 0.35rem 0.6rem;
            border-radius: 6px;
            border: 1px solid transparent;
            cursor: pointer;
            outline: none;
            text-transform: capitalize;
            transition: all 0.15s ease;
        }

        .status-dropdown.status-new { background: #EBF5FF; color: #1E40AF; border-color: #BFDBFE; }
        .status-dropdown.status-contacted { background: #FEF3C7; color: #92400E; border-color: #FDE68A; }
        .status-dropdown.status-consultation { background: #EDE9FE; color: #5B21B6; border-color: #DDD6FE; }
        .status-dropdown.status-docs_pending { background: #FFFBEB; color: #B45309; border-color: #FDE68A; }
        .status-dropdown.status-deal { background: #ECFDF5; color: #065F46; border-color: #A7F3D0; }
        .status-dropdown.status-lost { background: #FEE2E2; color: #991B1B; border-color: #FECACA; }

        .table-actions {
            display: flex;
            align-items: center;
            gap: 0.4rem;
        }

        .action-btn {
            width: 32px;
            height: 32px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 6px;
            border: 1px solid var(--slate-200);
            background: white;
            color: var(--slate-600);
            cursor: pointer;
            transition: all 0.15s ease;
            font-size: 0.8rem;
        }

        .action-btn:hover {
            background: var(--slate-100);
            color: var(--slate-900);
        }

        .action-btn.btn-notes:hover {
            background: #EBF5FF;
            color: #1E40AF;
            border-color: #BFDBFE;
        }

        .action-btn.btn-delete:hover {
            background: #FEE2E2;
            color: #991B1B;
            border-color: #FECACA;
        }

        .empty-state {
            padding: 3.5rem 1.5rem;
            text-align: center;
            color: var(--slate-500);
        }

        .empty-state i {
            font-size: 3rem;
            color: var(--slate-300);
            margin-bottom: 1rem;
        }

        .empty-state h3 {
            font-size: 1.1rem;
            color: var(--slate-700);
            margin-bottom: 0.3rem;
        }

        /* Modal Styles */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(15, 23, 42, 0.5);
            backdrop-filter: blur(4px);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 100;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.2s ease;
            padding: 1rem;
        }

        .modal-overlay.active {
            opacity: 1;
            pointer-events: auto;
        }

        .modal-box {
            background: white;
            border-radius: var(--radius-lg);
            width: 100%;
            max-width: 680px;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: var(--shadow-lg);
            transform: scale(0.96);
            transition: transform 0.2s ease;
            display: flex;
            flex-direction: column;
        }

        .modal-overlay.active .modal-box {
            transform: scale(1);
        }

        .modal-header {
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid var(--slate-200);
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            background: white;
            z-index: 2;
        }

        .modal-header h3 {
            font-size: 1.15rem;
            font-weight: 700;
            color: var(--slate-900);
        }

        .modal-close {
            background: transparent;
            border: none;
            color: var(--slate-400);
            font-size: 1.2rem;
            cursor: pointer;
            padding: 0.2rem 0.5rem;
            border-radius: 4px;
        }

        .modal-close:hover {
            color: var(--slate-700);
            background: var(--slate-100);
        }

        .modal-body {
            padding: 1.5rem;
        }

        .timeline-box {
            border-left: 2px solid var(--slate-200);
            margin-left: 0.75rem;
            padding-left: 1.25rem;
            display: flex;
            flex-direction: column;
            gap: 1rem;
            margin-top: 1rem;
        }

        .timeline-item {
            position: relative;
        }

        .timeline-dot {
            position: absolute;
            left: -1.65rem;
            top: 0.25rem;
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: var(--brand-primary);
            border: 2px solid white;
            box-shadow: 0 0 0 2px rgba(13,105,56,0.2);
        }

        .timeline-header {
            display: flex;
            justify-content: space-between;
            font-size: 0.75rem;
            color: var(--slate-500);
            margin-bottom: 0.2rem;
        }

        .timeline-author {
            font-weight: 700;
            color: var(--slate-700);
        }

        .timeline-content {
            font-size: 0.85rem;
            color: var(--slate-800);
            background: var(--slate-50);
            padding: 0.6rem 0.85rem;
            border-radius: 6px;
            border: 1px solid var(--slate-200);
        }

        .quick-stage-btn {
            padding: 0.35rem 0.75rem;
            font-size: 0.78rem;
            font-weight: 700;
            border-radius: 6px;
            border: 1px solid var(--slate-200);
            background: white;
            cursor: pointer;
            transition: all 0.15s ease;
        }

        .quick-stage-btn:hover {
            border-color: var(--brand-primary);
            background: #F0FDF4;
            color: var(--brand-primary);
        }

        /* Toast notifications */
        .toast {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            background: var(--slate-900);
            color: white;
            padding: 0.85rem 1.25rem;
            border-radius: var(--radius-md);
            box-shadow: var(--shadow-lg);
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-size: 0.88rem;
            font-weight: 500;
            z-index: 999;
            transform: translateY(100px);
            opacity: 0;
            transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .toast.show {
            transform: translateY(0);
            opacity: 1;
        }

        .toast-success {
            border-left: 4px solid var(--brand-accent);
        }

        .toast-error {
            border-left: 4px solid #ef4444;
        }

        /* Form Inputs */
        .form-group {
            margin-bottom: 1rem;
        }

        .form-label {
            display: block;
            font-size: 0.82rem;
            font-weight: 700;
            color: var(--slate-700);
            margin-bottom: 0.35rem;
        }

        .form-control {
            width: 100%;
            padding: 0.65rem 0.85rem;
            border: 1px solid var(--slate-300);
            border-radius: var(--radius-md);
            font-size: 0.88rem;
            outline: none;
            transition: border-color 0.15s;
        }

        .form-control:focus {
            border-color: var(--brand-primary);
            box-shadow: 0 0 0 3px rgba(13,105,56,0.1);
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0.85rem;
        }

        @media (max-width: 640px) {
            .form-row {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>

    <!-- TOPBAR -->
    <header class="topbar">
        <div class="brand-container">
            <img src="../images/logo.png" alt="Study Partners" class="brand-logo" onerror="this.src='../images/logo.jpeg'">
            <div class="brand-title">
                Study Partners <span class="brand-badge">CRM Admin</span>
            </div>
        </div>

        <div class="topbar-actions">
            <button class="btn btn-primary" onclick="openAddLeadModal()">
                <i class="fa-solid fa-user-plus"></i>
                <span>Add Walk-in Lead</span>
            </button>
            <a href="export_leads.php?status=<?= urlencode($statusFilter) ?>&destination=<?= urlencode($destinationFilter) ?>&source=<?= urlencode($sourceFilter) ?>&q=<?= urlencode($searchQuery) ?>" class="btn btn-secondary" title="Export CSV">
                <i class="fa-solid fa-file-arrow-down"></i>
                <span>Export CSV</span>
            </a>
            <a href="../index.php" target="_blank" class="btn btn-secondary" title="View Student Website">
                <i class="fa-solid fa-arrow-up-right-from-square"></i>
                <span>Live Site</span>
            </a>
            <div class="admin-profile">
                <div class="admin-avatar"><?= strtoupper(substr($currentAdmin['full_name'] ?? $currentAdmin['username'] ?? 'A', 0, 1)) ?></div>
                <span><?= htmlspecialchars($currentAdmin['full_name'] ?? $currentAdmin['username'] ?? 'Admin') ?></span>
            </div>
            <a href="logout.php" class="btn btn-danger" title="Logout" style="padding: 0.5rem 0.75rem;">
                <i class="fa-solid fa-right-from-bracket"></i>
            </a>
        </div>
    </header>

    <!-- MAIN CRM CONTAINER -->
    <main class="admin-container">

        <!-- DASHBOARD HEADER -->
        <div class="dashboard-header">
            <div>
                <h1>Student Leads & Pipeline</h1>
                <p>Track inquiries from Contact, Apply Wizard, and Institutional Partners in real time.</p>
            </div>
            <div class="office-tag">
                <i class="fa-solid fa-location-dot" style="color: var(--brand-primary);"></i>
                <span>5 Premium Close, Mount Pleasant, Harare &bull; +263 773 966 111</span>
            </div>
        </div>

        <!-- KPI SUMMARY TILES -->
        <section class="kpi-grid">
            <a href="index.php" class="kpi-card <?= empty($statusFilter) ? 'active' : '' ?>" style="--card-accent: #0D6938;">
                <div class="kpi-label">
                    <span>Total Leads</span>
                    <i class="fa-solid fa-users" style="color: #0D6938;"></i>
                </div>
                <div class="kpi-value"><?= $kpis['total'] ?></div>
            </a>

            <a href="index.php?status=new" class="kpi-card <?= $statusFilter === 'new' ? 'active' : '' ?>" style="--card-accent: #2563EB;">
                <div class="kpi-label">
                    <span>New Leads</span>
                    <i class="fa-solid fa-bolt" style="color: #2563EB;"></i>
                </div>
                <div class="kpi-value"><?= $kpis['new'] ?></div>
            </a>

            <a href="index.php?status=contacted" class="kpi-card <?= $statusFilter === 'contacted' ? 'active' : '' ?>" style="--card-accent: #D97706;">
                <div class="kpi-label">
                    <span>Contacted</span>
                    <i class="fa-solid fa-phone" style="color: #D97706;"></i>
                </div>
                <div class="kpi-value"><?= $kpis['contacted'] ?></div>
            </a>

            <a href="index.php?status=consultation" class="kpi-card <?= $statusFilter === 'consultation' ? 'active' : '' ?>" style="--card-accent: #7C3AED;">
                <div class="kpi-label">
                    <span>In Consultation</span>
                    <i class="fa-solid fa-comments" style="color: #7C3AED;"></i>
                </div>
                <div class="kpi-value"><?= $kpis['consultation'] ?></div>
            </a>

            <a href="index.php?status=docs_pending" class="kpi-card <?= $statusFilter === 'docs_pending' ? 'active' : '' ?>" style="--card-accent: #B45309;">
                <div class="kpi-label">
                    <span>Docs Pending</span>
                    <i class="fa-solid fa-file-lines" style="color: #B45309;"></i>
                </div>
                <div class="kpi-value"><?= $kpis['docs_pending'] ?></div>
            </a>

            <a href="index.php?status=deal" class="kpi-card <?= $statusFilter === 'deal' ? 'active' : '' ?>" style="--card-accent: #059669;">
                <div class="kpi-label">
                    <span>Deals / Admitted</span>
                    <i class="fa-solid fa-circle-check" style="color: #059669;"></i>
                </div>
                <div class="kpi-value"><?= $kpis['deal'] ?></div>
            </a>

            <a href="index.php?status=lost" class="kpi-card <?= $statusFilter === 'lost' ? 'active' : '' ?>" style="--card-accent: #DC2626;">
                <div class="kpi-label">
                    <span>Lost / Dropped</span>
                    <i class="fa-solid fa-circle-xmark" style="color: #DC2626;"></i>
                </div>
                <div class="kpi-value"><?= $kpis['lost'] ?></div>
            </a>
        </section>

        <!-- FILTERS & SEARCH -->
        <section class="controls-card">
            <form method="GET" action="index.php" class="filters-form">
                <div class="search-box">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" name="q" placeholder="Search by name, phone, email, or ref code..." value="<?= htmlspecialchars($searchQuery) ?>">
                </div>

                <select name="status" class="filter-select" onchange="this.form.submit()">
                    <option value="">All Pipeline Stages</option>
                    <option value="new" <?= $statusFilter === 'new' ? 'selected' : '' ?>>New Leads (<?= $kpis['new'] ?>)</option>
                    <option value="contacted" <?= $statusFilter === 'contacted' ? 'selected' : '' ?>>Contacted (<?= $kpis['contacted'] ?>)</option>
                    <option value="consultation" <?= $statusFilter === 'consultation' ? 'selected' : '' ?>>In Consultation (<?= $kpis['consultation'] ?>)</option>
                    <option value="docs_pending" <?= $statusFilter === 'docs_pending' ? 'selected' : '' ?>>Docs Pending (<?= $kpis['docs_pending'] ?>)</option>
                    <option value="deal" <?= $statusFilter === 'deal' ? 'selected' : '' ?>>Deals Won (<?= $kpis['deal'] ?>)</option>
                    <option value="lost" <?= $statusFilter === 'lost' ? 'selected' : '' ?>>Lost / Dropped (<?= $kpis['lost'] ?>)</option>
                </select>

                <select name="destination" class="filter-select" onchange="this.form.submit()">
                    <option value="">All Destinations</option>
                    <?php foreach ($destinations as $d): ?>
                        <option value="<?= htmlspecialchars($d) ?>" <?= $destinationFilter === $d ? 'selected' : '' ?>><?= htmlspecialchars($d) ?></option>
                    <?php endforeach; ?>
                </select>

                <select name="source" class="filter-select" onchange="this.form.submit()">
                    <option value="">All Sources</option>
                    <?php foreach ($sources as $s): ?>
                        <option value="<?= htmlspecialchars($s) ?>" <?= $sourceFilter === $s ? 'selected' : '' ?>><?= htmlspecialchars($s) ?></option>
                    <?php endforeach; ?>
                </select>

                <?php if (!empty($statusFilter) || !empty($destinationFilter) || !empty($sourceFilter) || !empty($searchQuery)): ?>
                    <a href="index.php" class="btn btn-secondary" style="padding: 0.6rem 0.9rem;">
                        <i class="fa-solid fa-xmark"></i> Clear Filters
                    </a>
                <?php endif; ?>
            </form>
        </section>

        <!-- LEADS TABLE -->
        <section class="table-card">
            <div class="table-responsive">
                <table class="leads-table">
                    <thead>
                        <tr>
                            <th>Ref Code</th>
                            <th>Student & Contact</th>
                            <th>Origin</th>
                            <th>Destination & Program</th>
                            <th>Source</th>
                            <th>Pipeline Stage</th>
                            <th>Date</th>
                            <th style="text-align: right;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($leads)): ?>
                            <tr>
                                <td colspan="8">
                                    <div class="empty-state">
                                        <i class="fa-solid fa-inbox"></i>
                                        <h3>No leads found</h3>
                                        <p>Try clearing filters or search query, or add a new walk-in lead.</p>
                                    </div>
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($leads as $l): ?>
                                <?php 
                                    $cleanPhone = preg_replace('/[^0-9]/', '', $l['phone'] ?? '');
                                    $currStatus = $l['status'] ?? 'new';
                                    $cfg = $statusConfig[$currStatus] ?? $statusConfig['new'];
                                ?>
                                <tr id="lead-row-<?= $l['id'] ?>">
                                    <td>
                                        <span class="lead-ref"><?= htmlspecialchars($l['lead_ref']) ?></span>
                                    </td>
                                    <td>
                                        <div class="lead-name"><?= htmlspecialchars($l['full_name']) ?></div>
                                        <div class="lead-sub">
                                            <span><?= htmlspecialchars($l['email'] ?: 'No email') ?></span>
                                        </div>
                                        <div class="lead-contact-links">
                                            <?php if (!empty($cleanPhone)): ?>
                                                <a href="https://wa.me/<?= $cleanPhone ?>" target="_blank" class="contact-pill pill-whatsapp" title="Open WhatsApp Chat">
                                                    <i class="fa-brands fa-whatsapp"></i> WhatsApp
                                                </a>
                                                <a href="tel:<?= htmlspecialchars($l['phone']) ?>" class="contact-pill pill-call" title="Call Number">
                                                    <i class="fa-solid fa-phone"></i> <?= htmlspecialchars($l['phone']) ?>
                                                </a>
                                            <?php endif; ?>
                                            <?php if (!empty($l['email'])): ?>
                                                <a href="mailto:<?= htmlspecialchars($l['email']) ?>" class="contact-pill pill-email" title="Send Email">
                                                    <i class="fa-solid fa-envelope"></i> Email
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                    <td>
                                        <span style="font-weight: 600; color: var(--slate-700);"><?= htmlspecialchars($l['country'] ?: 'Zimbabwe') ?></span>
                                    </td>
                                    <td>
                                        <div class="dest-badge">
                                            <i class="fa-solid fa-plane-departure" style="color: var(--brand-primary); font-size: 0.75rem;"></i>
                                            <?= htmlspecialchars($l['destination'] ?: 'Undecided') ?>
                                        </div>
                                        <div style="font-size: 0.75rem; color: var(--slate-500); margin-top: 3px;">
                                            <?= htmlspecialchars($l['study_level'] ? ($l['study_level'] . ' - ' . $l['program']) : ($l['program'] ?: 'General')) ?>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="source-tag"><?= htmlspecialchars($l['source'] ?: 'Website') ?></span>
                                    </td>
                                    <td>
                                        <select class="status-dropdown status-<?= $currStatus ?>" onchange="updateLeadStatus(<?= $l['id'] ?>, this.value, this)">
                                            <option value="new" <?= $currStatus === 'new' ? 'selected' : '' ?>>New Lead</option>
                                            <option value="contacted" <?= $currStatus === 'contacted' ? 'selected' : '' ?>>Contacted</option>
                                            <option value="consultation" <?= $currStatus === 'consultation' ? 'selected' : '' ?>>In Consultation</option>
                                            <option value="docs_pending" <?= $currStatus === 'docs_pending' ? 'selected' : '' ?>>Docs Pending</option>
                                            <option value="deal" <?= $currStatus === 'deal' ? 'selected' : '' ?>>Deal / Admitted</option>
                                            <option value="lost" <?= $currStatus === 'lost' ? 'selected' : '' ?>>Lost / Dropped</option>
                                        </select>
                                    </td>
                                    <td style="font-size: 0.75rem; color: var(--slate-500); white-space: nowrap;">
                                        <?= date('M d, Y', strtotime($l['created_at'])) ?>
                                        <br>
                                        <span style="color: var(--slate-400); font-size: 0.7rem;"><?= date('H:i', strtotime($l['created_at'])) ?></span>
                                    </td>
                                    <td style="text-align: right;">
                                        <div class="table-actions" style="justify-content: flex-end;">
                                            <button class="action-btn btn-notes" onclick="openLeadModal(<?= $l['id'] ?>)" title="View Timeline & Add Notes">
                                                <i class="fa-solid fa-clipboard-list"></i>
                                            </button>
                                            <button class="action-btn btn-delete" onclick="deleteLead(<?= $l['id'] ?>, '<?= htmlspecialchars(addslashes($l['full_name'])) ?>')" title="Delete Lead">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </section>

    </main>

    <!-- LEAD DETAILS & TIMELINE MODAL -->
    <div class="modal-overlay" id="leadModal">
        <div class="modal-box">
            <div class="modal-header">
                <div>
                    <h3 id="modalLeadName">Student Lead Details</h3>
                    <div style="font-size: 0.75rem; color: var(--slate-500);" id="modalLeadRef"></div>
                </div>
                <button class="modal-close" onclick="closeLeadModal()"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="modal-body">
                <!-- Info Grid -->
                <div style="background: var(--slate-50); border: 1px solid var(--slate-200); border-radius: var(--radius-md); padding: 1rem; margin-bottom: 1.25rem;">
                    <div class="form-row" style="font-size: 0.85rem; margin-bottom: 0.5rem;">
                        <div><strong>Phone:</strong> <span id="modalPhone">-</span></div>
                        <div><strong>Email:</strong> <span id="modalEmail">-</span></div>
                    </div>
                    <div class="form-row" style="font-size: 0.85rem; margin-bottom: 0.5rem;">
                        <div><strong>Destination:</strong> <span id="modalDestination">-</span></div>
                        <div><strong>Origin:</strong> <span id="modalOrigin">-</span></div>
                    </div>
                    <div class="form-row" style="font-size: 0.85rem; margin-bottom: 0.5rem;">
                        <div><strong>Program:</strong> <span id="modalProgram">-</span></div>
                        <div><strong>Source:</strong> <span id="modalSource">-</span></div>
                    </div>
                    <div style="font-size: 0.85rem; margin-top: 0.5rem; padding-top: 0.5rem; border-top: 1px dashed var(--slate-200);">
                        <strong>Inquiry Message:</strong>
                        <p id="modalMessage" style="color: var(--slate-600); margin-top: 0.2rem; font-style: italic;"></p>
                    </div>
                </div>

                <!-- Fast Stage Changers -->
                <div style="margin-bottom: 1.25rem;">
                    <label class="form-label">Quick Pipeline Stage Update:</label>
                    <div style="display: flex; flex-wrap: wrap; gap: 0.4rem;">
                        <button class="quick-stage-btn" onclick="quickSetStatus('contacted')">📞 Contacted</button>
                        <button class="quick-stage-btn" onclick="quickSetStatus('consultation')">💬 In Consultation</button>
                        <button class="quick-stage-btn" onclick="quickSetStatus('docs_pending')">📄 Docs Pending</button>
                        <button class="quick-stage-btn" onclick="quickSetStatus('deal')" style="border-color: #A7F3D0; color: #065F46;">🎉 Deal Won</button>
                        <button class="quick-stage-btn" onclick="quickSetStatus('lost')" style="border-color: #FECACA; color: #991B1B;">❌ Lost</button>
                    </div>
                </div>

                <!-- Add Note Form -->
                <div style="margin-bottom: 1.5rem;">
                    <label class="form-label">Add Follow-Up Note / Activity:</label>
                    <div style="display: flex; gap: 0.5rem;">
                        <input type="text" id="newNoteInput" class="form-control" placeholder="e.g. Sent WhatsApp brochure, student will visit Harare office on Friday...">
                        <button class="btn btn-primary" onclick="submitNewNote()" style="white-space: nowrap;">Add Note</button>
                    </div>
                </div>

                <!-- Activity Timeline -->
                <div>
                    <label class="form-label">Activity & Notes History:</label>
                    <div class="timeline-box" id="modalTimeline">
                        <!-- Populated by JS -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ADD WALK-IN LEAD MODAL -->
    <div class="modal-overlay" id="addLeadModal">
        <div class="modal-box" style="max-width: 580px;">
            <div class="modal-header">
                <h3>Add Walk-in or Phone Lead</h3>
                <button class="modal-close" onclick="closeAddLeadModal()"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="modal-body">
                <form id="createLeadForm" onsubmit="handleCreateLead(event)">
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Student Full Name *</label>
                            <input type="text" name="name" class="form-control" required placeholder="e.g. Tafadzwa Moyo">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Phone / WhatsApp *</label>
                            <input type="text" name="phone" class="form-control" required placeholder="+263 77...">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Email Address</label>
                            <input type="email" name="email" class="form-control" placeholder="student@example.com">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Country of Origin</label>
                            <input type="text" name="country_origin" class="form-control" value="Zimbabwe">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Destination Country</label>
                            <select name="destination" class="form-control">
                                <option value="Belarus">Belarus</option>
                                <option value="China">China</option>
                                <option value="Poland">Poland</option>
                                <option value="Germany">Germany</option>
                                <option value="Cyprus">Cyprus</option>
                                <option value="Malta">Malta</option>
                                <option value="Ireland">Ireland</option>
                                <option value="Other">Other / Undecided</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Degree Level</label>
                            <select name="degree_level" class="form-control">
                                <option value="Undergraduate">Undergraduate Degree</option>
                                <option value="Postgraduate / Masters">Postgraduate / Masters</option>
                                <option value="Doctorate (PhD)">Doctorate (PhD)</option>
                                <option value="Preparatory / Language">Preparatory / Language</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Program of Interest</label>
                        <input type="text" name="program_interest" class="form-control" placeholder="e.g. General Medicine (MBBS), Computer Science, Business...">
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Initial Pipeline Stage</label>
                            <select name="status" class="form-control">
                                <option value="new">New Lead</option>
                                <option value="contacted" selected>Contacted</option>
                                <option value="consultation">In Consultation</option>
                                <option value="docs_pending">Docs Pending</option>
                                <option value="deal">Deal / Admitted</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Inquiry Source</label>
                            <select name="source" class="form-control">
                                <option value="Harare Office Walk-in">Harare Office Walk-in</option>
                                <option value="Direct Phone Call">Direct Phone Call</option>
                                <option value="WhatsApp Direct">Direct WhatsApp</option>
                                <option value="Agent Referral">Agent Referral</option>
                                <option value="Education Expo">Education Expo</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Initial Counselor Notes</label>
                        <textarea name="notes" rows="2" class="form-control" placeholder="Briefly note student's current grades, budget, or target intake..."></textarea>
                    </div>

                    <div style="display: flex; justify-content: flex-end; gap: 0.75rem; margin-top: 1.25rem;">
                        <button type="button" class="btn btn-secondary" onclick="closeAddLeadModal()">Cancel</button>
                        <button type="submit" class="btn btn-primary" id="btnSaveLead">Save & Add to Pipeline</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- TOAST NOTIFICATION -->
    <div class="toast toast-success" id="toast">
        <i class="fa-solid fa-circle-check" id="toastIcon"></i>
        <span id="toastMsg">Action completed successfully</span>
    </div>

    <script>
        let currentModalLeadId = null;

        // Show Toast Helper
        function showToast(message, isError = false) {
            const toast = document.getElementById('toast');
            const toastMsg = document.getElementById('toastMsg');
            const toastIcon = document.getElementById('toastIcon');

            toastMsg.innerText = message;
            if (isError) {
                toast.className = 'toast toast-error show';
                toastIcon.className = 'fa-solid fa-triangle-exclamation';
            } else {
                toast.className = 'toast toast-success show';
                toastIcon.className = 'fa-solid fa-circle-check';
            }

            setTimeout(() => {
                toast.classList.remove('show');
            }, 3500);
        }

        // Update Lead Status via Dropdown
        async function updateLeadStatus(leadId, newStatus, selectElement) {
            try {
                const formData = new FormData();
                formData.append('lead_id', leadId);
                formData.append('action', 'update_status');
                formData.append('status', newStatus);

                const response = await fetch('update_lead.php', {
                    method: 'POST',
                    body: formData
                });
                const result = await response.json();

                if (result.success) {
                    showToast('Lead status updated to ' + newStatus.toUpperCase());
                    // Update class of select element
                    selectElement.className = 'status-dropdown status-' + newStatus;
                } else {
                    showToast(result.message || 'Error updating status', true);
                }
            } catch (err) {
                console.error(err);
                showToast('Failed to communicate with server', true);
            }
        }

        // Open Lead Modal & Fetch Details
        async function openLeadModal(leadId) {
            currentModalLeadId = leadId;
            const modal = document.getElementById('leadModal');
            modal.classList.add('active');

            document.getElementById('modalTimeline').innerHTML = '<div style="font-size:0.8rem; color:var(--slate-400);">Loading notes...</div>';

            try {
                const formData = new FormData();
                formData.append('lead_id', leadId);
                formData.append('action', 'get_details');

                const res = await fetch('update_lead.php', { method: 'POST', body: formData });
                const data = await res.json();

                if (data.success) {
                    const l = data.lead;
                    document.getElementById('modalLeadName').innerText = l.full_name;
                    document.getElementById('modalLeadRef').innerText = 'Reference: ' + l.lead_ref + ' • Added on ' + l.created_at;
                    document.getElementById('modalPhone').innerText = l.phone || 'N/A';
                    document.getElementById('modalEmail').innerText = l.email || 'N/A';
                    document.getElementById('modalDestination').innerText = l.destination || 'N/A';
                    document.getElementById('modalOrigin').innerText = l.country || 'Zimbabwe';
                    document.getElementById('modalProgram').innerText = (l.study_level ? l.study_level + ' - ' : '') + (l.program || 'General');
                    document.getElementById('modalSource').innerText = l.source || 'Website';
                    document.getElementById('modalMessage').innerText = l.message ? `"${l.message}"` : 'No message provided.';

                    renderTimeline(data.notes);
                } else {
                    showToast(data.message || 'Could not load lead', true);
                }
            } catch (err) {
                console.error(err);
                showToast('Server error loading lead', true);
            }
        }

        function closeLeadModal() {
            document.getElementById('leadModal').classList.remove('active');
            currentModalLeadId = null;
        }

        function renderTimeline(notes) {
            const container = document.getElementById('modalTimeline');
            if (!notes || notes.length === 0) {
                container.innerHTML = '<div style="font-size:0.8rem; color:var(--slate-400); font-style:italic;">No notes or activity logged yet.</div>';
                return;
            }

            let html = '';
            notes.forEach(n => {
                html += `
                    <div class="timeline-item">
                        <div class="timeline-dot"></div>
                        <div class="timeline-header">
                            <span class="timeline-author">${n.author || 'Admin'}</span>
                            <span>${n.created_at}</span>
                        </div>
                        <div class="timeline-content">${n.note}</div>
                    </div>
                `;
            });
            container.innerHTML = html;
        }

        // Quick Stage set from inside modal
        async function quickSetStatus(status) {
            if (!currentModalLeadId) return;
            const formData = new FormData();
            formData.append('lead_id', currentModalLeadId);
            formData.append('action', 'update_status');
            formData.append('status', status);

            const res = await fetch('update_lead.php', { method: 'POST', body: formData });
            const data = await res.json();
            if (data.success) {
                showToast('Status changed to ' + status.toUpperCase());
                // Refresh modal details
                openLeadModal(currentModalLeadId);
                // Also update row dropdown
                const row = document.getElementById('lead-row-' + currentModalLeadId);
                if (row) {
                    const sel = row.querySelector('.status-dropdown');
                    if (sel) {
                        sel.value = status;
                        sel.className = 'status-dropdown status-' + status;
                    }
                }
            }
        }

        // Submit new note
        async function submitNewNote() {
            const input = document.getElementById('newNoteInput');
            const noteText = input.value.trim();
            if (!noteText || !currentModalLeadId) return;

            try {
                const formData = new FormData();
                formData.append('lead_id', currentModalLeadId);
                formData.append('action', 'add_note');
                formData.append('note', noteText);

                const res = await fetch('update_lead.php', { method: 'POST', body: formData });
                const data = await res.json();
                if (data.success) {
                    input.value = '';
                    showToast('Note added');
                    openLeadModal(currentModalLeadId);
                } else {
                    showToast(data.message, true);
                }
            } catch (e) {
                showToast('Error saving note', true);
            }
        }

        // Delete Lead
        async function deleteLead(leadId, leadName) {
            if (!confirm(`Are you sure you want to permanently delete lead "${leadName}"?`)) {
                return;
            }

            try {
                const formData = new FormData();
                formData.append('lead_id', leadId);

                const res = await fetch('delete_lead.php', { method: 'POST', body: formData });
                const data = await res.json();

                if (data.success) {
                    showToast('Lead deleted successfully');
                    const row = document.getElementById('lead-row-' + leadId);
                    if (row) row.remove();
                } else {
                    showToast(data.message || 'Error deleting lead', true);
                }
            } catch (err) {
                showToast('Error communicating with server', true);
            }
        }

        // Add Lead Modal handlers
        function openAddLeadModal() {
            document.getElementById('addLeadModal').classList.add('active');
        }

        function closeAddLeadModal() {
            document.getElementById('addLeadModal').classList.remove('active');
        }

        async function handleCreateLead(e) {
            e.preventDefault();
            const btn = document.getElementById('btnSaveLead');
            btn.disabled = true;
            btn.innerText = 'Saving...';

            try {
                const form = document.getElementById('createLeadForm');
                const formData = new FormData(form);

                const res = await fetch('create_lead.php', { method: 'POST', body: formData });
                const data = await res.json();

                if (data.success) {
                    showToast('Lead created! Ref: ' + data.reference);
                    closeAddLeadModal();
                    setTimeout(() => {
                        window.location.reload();
                    }, 800);
                } else {
                    showToast(data.message || 'Could not create lead', true);
                    btn.disabled = false;
                    btn.innerText = 'Save & Add to Pipeline';
                }
            } catch (err) {
                showToast('Server error creating lead', true);
                btn.disabled = false;
                btn.innerText = 'Save & Add to Pipeline';
            }
        }

        // Close modal on Escape
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                closeLeadModal();
                closeAddLeadModal();
            }
        });
    </script>
</body>
</html>
