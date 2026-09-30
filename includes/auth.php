<?php
/**
 * Study Partners - Admin Authentication Helper
 */

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function isLoggedIn() {
    return !empty($_SESSION['admin_user_id']);
}

function requireLogin() {
    if (!isLoggedIn()) {
        header('Location: login.php');
        exit;
    }
}

function getCurrentAdmin() {
    if (!isLoggedIn()) {
        return null;
    }
    return [
        'id' => $_SESSION['admin_user_id'] ?? null,
        'username' => $_SESSION['admin_username'] ?? 'admin',
        'full_name' => $_SESSION['admin_full_name'] ?? 'Admissions Admin',
        'email' => $_SESSION['admin_email'] ?? '',
        'role' => $_SESSION['admin_role'] ?? 'admin'
    ];
}
