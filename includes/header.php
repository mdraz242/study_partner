<?php
/**
 * Study Partners - Shared Header Component
 */
$page_title = $page_title ?? 'Study Partners | European & Global University Placement Consultancy';
$meta_desc = $meta_desc ?? 'Official admission invitations, guaranteed university placement & dedicated visa guidance. Headquartered in Harare, Zimbabwe.';
$active_page = $active_page ?? '';
$root = $root ?? '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= htmlspecialchars($page_title) ?></title>
  <meta name="description" content="<?= htmlspecialchars($meta_desc) ?>">
  
  <meta property="og:type" content="website">
  <meta property="og:url" content="https://studypartners.co.zw/">
  <meta property="og:title" content="<?= htmlspecialchars($page_title) ?>">
  <meta property="og:description" content="<?= htmlspecialchars($meta_desc) ?>">
  
  <link rel="stylesheet" href="<?= $root ?>css/style.css">
  <link rel="icon" type="image/png" href="<?= $root ?>images/logo.png">
</head>
<body>

  <!-- Top Info Bar -->
  <div class="top-notice-bar">
    <div class="container top-notice-content">
      <div class="top-notice-left">
        <span class="top-notice-item">
          <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
          Admissions Open &bull; 5 Premium Close, Mount Pleasant, Harare
        </span>
      </div>
      <div class="top-notice-right">
        <a href="tel:+263773966111" class="top-notice-item">
          <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
          +263 773 966 111
        </a>
        <a href="tel:+27833454421" class="top-notice-item">
          +27 833 454 421
        </a>
        <a href="<?= $root ?>admin/login.php" class="top-notice-item" style="color: var(--accent-emerald-700); font-weight: 700;">
          Staff / Admin CRM &rarr;
        </a>
      </div>
    </div>
  </div>

  <!-- Sticky Navbar with Dropdowns -->
  <nav class="navbar" id="siteNavbar">
    <div class="container navbar-container">
      <a href="<?= $root ?>index.php" class="brand-logo" aria-label="Study Partners Home">
        <img src="<?= $root ?>images/logo.png" alt="Study Partners" class="brand-logo-img">
      </a>

      <!-- Desktop & Mobile Nav Menu -->
      <ul class="nav-menu" id="navMenu">
        <li class="nav-item">
          <a href="<?= $root ?>index.php" class="nav-link <?= $active_page === 'home' ? 'active' : '' ?>">Home</a>
        </li>
        <li class="nav-item">
          <a href="<?= $root ?>destinations.php" class="nav-link <?= $active_page === 'destinations' ? 'active' : '' ?>">
            Destinations
            <svg class="arrow" width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
          </a>
          <div class="dropdown-menu">
            <a href="<?= $root ?>destinations.php#belarus" class="dropdown-item">
              <div class="dropdown-item-icon">🇧🇾</div>
              <div>
                <div class="dropdown-title">Belarus (Featured)</div>
                <div class="dropdown-desc">Minsk, Grodno & Vitebsk Universities</div>
              </div>
            </a>
            <a href="<?= $root ?>destinations.php#europe-expansion" class="dropdown-item">
              <div class="dropdown-item-icon">🇨🇳</div>
              <div>
                <div class="dropdown-title">China (CSC Scholarships)</div>
                <div class="dropdown-desc">Beijing, Shanghai & Wuhan Programs</div>
              </div>
            </a>
            <a href="<?= $root ?>destinations.php#europe-expansion" class="dropdown-item">
              <div class="dropdown-item-icon">🇪🇺</div>
              <div>
                <div class="dropdown-title">European Destinations</div>
                <div class="dropdown-desc">Poland, Germany, Hungary, Czechia</div>
              </div>
            </a>
          </div>
        </li>
        <li class="nav-item">
          <a href="<?= $root ?>degrees.php" class="nav-link <?= $active_page === 'degrees' ? 'active' : '' ?>">
            Degrees
            <svg class="arrow" width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
          </a>
          <div class="dropdown-menu">
            <a href="<?= $root ?>degrees.php?category=medicine" class="dropdown-item">
              <div class="dropdown-item-icon">🩺</div>
              <div>
                <div class="dropdown-title">Medicine & Dentistry</div>
                <div class="dropdown-desc">MBBS / MD 6-yr English medium</div>
              </div>
            </a>
            <a href="<?= $root ?>degrees.php?category=engineering" class="dropdown-item">
              <div class="dropdown-item-icon">💻</div>
              <div>
                <div class="dropdown-title">Computer Science & AI</div>
                <div class="dropdown-desc">Software & Tech Engineering</div>
              </div>
            </a>
            <a href="<?= $root ?>degrees.php?category=business" class="dropdown-item">
              <div class="dropdown-item-icon">📈</div>
              <div>
                <div class="dropdown-title">Business & Economics</div>
                <div class="dropdown-desc">BBA & MBA Programs</div>
              </div>
            </a>
            <a href="<?= $root ?>degrees.php?category=foundation" class="dropdown-item">
              <div class="dropdown-item-icon">🎓</div>
              <div>
                <div class="dropdown-title">Preparatory / Foundation</div>
                <div class="dropdown-desc">Language & University Prep</div>
              </div>
            </a>
          </div>
        </li>
        <li class="nav-item">
          <a href="<?= $root ?>how-it-works.php" class="nav-link <?= $active_page === 'how-it-works' ? 'active' : '' ?>">How It Works</a>
        </li>
        <li class="nav-item">
          <a href="<?= $root ?>pricing.php" class="nav-link <?= $active_page === 'pricing' ? 'active' : '' ?>">Pricing</a>
        </li>
        <li class="nav-item">
          <a href="<?= $root ?>faq.php" class="nav-link <?= $active_page === 'faq' ? 'active' : '' ?>">FAQ</a>
        </li>
        <li class="nav-item">
          <a href="<?= $root ?>stories.php" class="nav-link <?= $active_page === 'stories' ? 'active' : '' ?>">Student Stories</a>
        </li>
        <li class="nav-item">
          <a href="<?= $root ?>about.php" class="nav-link <?= $active_page === 'about' ? 'active' : '' ?>">About</a>
        </li>
        <li class="nav-item">
          <a href="<?= $root ?>contact.php" class="nav-link <?= $active_page === 'contact' ? 'active' : '' ?>">Contact</a>
        </li>
        <li class="nav-item">
          <a href="<?= $root ?>partner.php" class="nav-link <?= $active_page === 'partner' ? 'active' : '' ?>" style="color: var(--accent-gold-600); font-weight: 700;">Partner Universities</a>
        </li>
      </ul>

      <!-- Navbar CTAs -->
      <div class="nav-actions">
        <a href="<?= $root ?>apply.php" class="btn btn-primary" id="navApplyBtn">
          Apply Now
          <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
        </a>
        <button class="mobile-toggle" id="mobileMenuToggle" aria-label="Toggle navigation menu">
          <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
          </svg>
        </button>
      </div>
    </div>
  </nav>
