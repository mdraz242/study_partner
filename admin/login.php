<?php
/**
 * Study Partners - Admin Login Portal
 */
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/auth.php';

$pdo = getDB();
$error = '';

if (isLoggedIn()) {
    header('Location: index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if (empty($username) || empty($password)) {
        $error = 'Please enter both username and password.';
    } else {
        $stmt = $pdo->prepare('SELECT * FROM admin_users WHERE username = :username LIMIT 1');
        $stmt->execute([':username' => $username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password_hash'])) {
            $_SESSION['admin_user_id'] = $user['id'];
            $_SESSION['admin_username'] = $user['username'];
            $_SESSION['admin_full_name'] = $user['full_name'];
            $_SESSION['admin_email'] = $user['email'];
            $_SESSION['admin_role'] = $user['role'];
            header('Location: index.php');
            exit;
        } else {
            $error = 'Invalid username or password. Please try again.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin & Counselor CRM Login | Study Partners</title>
  <link rel="stylesheet" href="../css/style.css">
  <link rel="icon" type="image/png" href="../images/logo.png">
  <style>
    body {
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      background: radial-gradient(80% 60% at 50% 0%, #ECFDF5 0%, #F8FAFC 60%, #FFFFFF 100%);
      font-family: var(--font-body, system-ui, sans-serif);
      margin: 0;
    }
    .login-container {
      flex: 1;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 2rem 1.5rem;
    }
    .login-card {
      width: 100%;
      max-width: 440px;
      background: var(--white, #ffffff);
      border: 1px solid var(--neutral-200, #E2E8F0);
      border-radius: 20px;
      box-shadow: 0 20px 40px -10px rgba(15, 23, 42, 0.08);
      padding: 2.5rem 2rem;
    }
    .brand-header {
      text-align: center;
      margin-bottom: 2rem;
    }
    .brand-header img {
      height: 48px;
      width: auto;
      margin-bottom: 0.75rem;
    }
    .crm-badge {
      display: inline-block;
      padding: 0.25rem 0.75rem;
      background: #F0FDF4;
      color: #166534;
      font-size: 0.75rem;
      font-weight: 700;
      border-radius: 999px;
      border: 1px solid #DCFCE7;
      text-transform: uppercase;
      letter-spacing: 0.06em;
      margin-bottom: 0.5rem;
    }
    .form-group {
      margin-bottom: 1.25rem;
    }
    .form-label {
      display: block;
      font-size: 0.85rem;
      font-weight: 600;
      color: #334155;
      margin-bottom: 0.4rem;
    }
    .form-input {
      width: 100%;
      padding: 0.75rem 1rem;
      border: 1px solid #CBD5E1;
      border-radius: 10px;
      font-size: 0.95rem;
      box-sizing: border-box;
      transition: all 0.2s ease;
    }
    .form-input:focus {
      outline: none;
      border-color: #0D6938;
      box-shadow: 0 0 0 3px rgba(13, 105, 56, 0.15);
    }
    .btn-login {
      width: 100%;
      padding: 0.85rem;
      background: #0D6938;
      color: #ffffff;
      border: none;
      border-radius: 10px;
      font-weight: 700;
      font-size: 1rem;
      cursor: pointer;
      transition: background 0.2s ease;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 0.5rem;
    }
    .btn-login:hover {
      background: #0B572E;
    }
    .demo-hint {
      margin-top: 1.5rem;
      padding: 1rem;
      background: #F8FAFC;
      border: 1px dashed #CBD5E1;
      border-radius: 10px;
      font-size: 0.82rem;
      color: #475569;
    }
    .demo-hint strong {
      color: #0F172A;
    }
    .alert-error {
      background: #FEF2F2;
      border: 1px solid #F87171;
      color: #991B1B;
      padding: 0.75rem 1rem;
      border-radius: 8px;
      font-size: 0.875rem;
      margin-bottom: 1.25rem;
    }
  </style>
</head>
<body>

  <div class="login-container">
    <div class="login-card">
      <div class="brand-header">
        <a href="../index.php">
          <img src="../images/logo.png" alt="Study Partners Logo">
        </a>
        <div>
          <span class="crm-badge">Staff & Admissions CRM</span>
        </div>
        <h2 style="font-size: 1.4rem; color: #0F172A; margin: 0.25rem 0 0.5rem;">Admissions Portal Login</h2>
        <p style="font-size: 0.85rem; color: #64748B; margin: 0;">Harare Head Office &bull; European Operations</p>
      </div>

      <?php if (!empty($error)): ?>
        <div class="alert-error">
          <?= htmlspecialchars($error) ?>
        </div>
      <?php endif; ?>

      <form method="POST" action="login.php">
        <div class="form-group">
          <label class="form-label" for="username">Username</label>
          <input type="text" id="username" name="username" class="form-input" placeholder="e.g. admin" value="admin" required autofocus>
        </div>

        <div class="form-group">
          <label class="form-label" for="password">Password</label>
          <input type="password" id="password" name="password" class="form-input" placeholder="Enter password" value="admin123" required>
        </div>

        <button type="submit" class="btn-login">
          Sign In to CRM &rarr;
        </button>
      </form>

      <div class="demo-hint">
        <strong>Demo Login Credentials:</strong><br>
        Username: <code style="background: #E2E8F0; padding: 2px 6px; border-radius: 4px;">admin</code><br>
        Password: <code style="background: #E2E8F0; padding: 2px 6px; border-radius: 4px;">admin123</code>
      </div>

      <div style="text-align: center; margin-top: 1.5rem;">
        <a href="../index.php" style="color: #0D6938; font-size: 0.85rem; text-decoration: none; font-weight: 600;">&larr; Return to Public Website</a>
      </div>
    </div>
  </div>

</body>
</html>
