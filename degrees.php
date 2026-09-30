<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Accredited European Degrees & Programs | Study Partners</title>
  <meta name="description" content="Browse English-taught European degrees in Medicine (MBBS), Computer Science, Software Engineering, and Business. Filter by category, study level, and language.">
  <link rel="stylesheet" href="css/style.css">
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
        <a href="login.php" class="top-notice-item" style="color: var(--accent-emerald-700); font-weight: 700;">
          Portal Login &rarr;
        </a>
      </div>
    </div>
  </div>

  <!-- Sticky Navbar with Dropdowns -->
  <nav class="navbar" id="siteNavbar">
    <div class="container navbar-container">
      <a href="index.php" class="brand-logo" aria-label="Study Partners Home">
        <img src="images/logo.png" alt="Study Partners" class="brand-logo-img">
      </a>

      <!-- Desktop & Mobile Nav Menu -->
      <ul class="nav-menu" id="navMenu">
        <li class="nav-item">
          <a href="index.php" class="nav-link">Home</a>
        </li>
        <li class="nav-item">
          <a href="destinations.php" class="nav-link">Destinations</a>
        </li>
        <li class="nav-item">
          <a href="degrees.php" class="nav-link active">Degrees</a>
        </li>
        <li class="nav-item">
          <a href="how-it-works.php" class="nav-link">How It Works</a>
        </li>
        <li class="nav-item">
          <a href="pricing.php" class="nav-link">Pricing</a>
        </li>
        <li class="nav-item">
          <a href="faq.php" class="nav-link">FAQ</a>
        </li>
        <li class="nav-item">
          <a href="stories.php" class="nav-link">Student Stories</a>
        </li>
        <li class="nav-item">
          <a href="about.php" class="nav-link">About</a>
        </li>
        <li class="nav-item">
          <a href="contact.php" class="nav-link">Contact</a>
        </li>
        <li class="nav-item">
          <a href="partner.php" class="nav-link" style="color: var(--sp-green); font-weight: 700;">Universities</a>
        </li>
      </ul>

      <!-- Action CTAs -->
      <div class="nav-actions">
        <a href="apply.php" class="btn btn-primary" id="navApplyBtn">Apply Now</a>
        <button class="mobile-toggle" id="mobileMenuToggle" aria-label="Toggle navigation menu">
          <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
        </button>
      </div>
    </div>
  </nav>

  <!-- Page Header -->
  <header class="inner-hero-header">
    <div class="container">
      <span class="section-tag" style="background: rgba(16, 185, 129, 0.15); border-color: rgba(16, 185, 129, 0.3);">Academic Catalog</span>
      <h1>Accredited Degrees & Programs</h1>
      <p>Search, filter, and compare English-taught undergraduate, postgraduate, and preparatory programs at recognized European state universities.</p>
      <div class="breadcrumbs">
        <a href="index.php">Home</a> &rsaquo; <span>Degrees</span>
      </div>
    </div>
  </header>

  <!-- Filterable Catalog Section -->
  <section class="section-padding" style="background: var(--neutral-50);">
    <div class="container">
      <!-- Filter Bar -->
      <div class="catalog-filter-bar">
        <div class="filters-grid">
          <div class="form-group" style="margin-bottom: 0;">
            <label class="form-label" for="searchProgramInput">Search Program or University</label>
            <input type="text" id="searchProgramInput" class="form-input" placeholder="e.g. Medicine, Software, BSMU, Vitebsk...">
          </div>

          <div class="form-group" style="margin-bottom: 0;">
            <label class="form-label" for="filterCategory">Category</label>
            <select id="filterCategory" class="form-select">
              <option value="all">All Categories</option>
              <option value="medicine">Medicine & Health</option>
              <option value="engineering">Engineering & IT</option>
              <option value="business">Business & Economics</option>
              <option value="foundation">Foundation / Languages</option>
            </select>
          </div>

          <div class="form-group" style="margin-bottom: 0;">
            <label class="form-label" for="filterLevel">Study Level</label>
            <select id="filterLevel" class="form-select">
              <option value="all">All Levels</option>
              <option value="bachelor">Bachelor's / Undergraduate</option>
              <option value="master">Master's / Postgraduate</option>
              <option value="foundation">Preparatory / Foundation</option>
            </select>
          </div>

          <div class="form-group" style="margin-bottom: 0;">
            <label class="form-label" for="filterLanguage">Language</label>
            <select id="filterLanguage" class="form-select">
              <option value="all">All Languages</option>
              <option value="english">English Medium</option>
              <option value="russian">Russian / Bilingual</option>
            </select>
          </div>

          <div>
            <button id="resetFiltersBtn" class="btn btn-secondary" style="height: 44px; width: 100%;">Reset</button>
          </div>
        </div>

        <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 1.25rem; padding-top: 1rem; border-top: 1px solid var(--neutral-200);">
          <span id="programsCount" style="font-weight: 700; color: var(--primary-900); font-size: 0.9rem;">Loading programs...</span>
          <span style="font-size: 0.8rem; color: var(--neutral-500);">Tuition fees are official state university rates per year</span>
        </div>
      </div>

      <!-- Programs Grid (Dynamically Populated via programs.js) -->
      <div id="programsListContainer" class="programs-grid">
        <!-- Javascript renders program cards here -->
      </div>
    </div>
  </section>

  <!-- Accreditation Banner -->
  <section class="container" style="margin-bottom: 5rem;">
    <div style="background: var(--white); border-radius: var(--radius-2xl); padding: 3rem; border: 1px solid var(--neutral-200); box-shadow: var(--shadow-md); text-align: center;">
      <span class="section-tag gold">Global Credential Recognition</span>
      <h3 style="font-size: 1.8rem; color: var(--primary-900); margin: 0.5rem 0 1rem;">Are European degrees from Belarus recognized in Africa & Worldwide?</h3>
      <p style="color: var(--neutral-600); max-width: 780px; margin: 0 auto 2rem; font-size: 1rem; line-height: 1.6;">
        Yes. All featured institutions are State Universities accredited by their national Ministry of Education, listed in the World Directory of Medical Schools (WDOMS/FAIMER), and fully accredited by WFME. Graduates are eligible to sit for licensing exams including MDCN (Nigeria), KMPDC (Kenya), MDC (Ghana), USMLE (USA), and PLAB/GMC (UK).
      </p>
      <div style="display: flex; justify-content: center; gap: 1rem; flex-wrap: wrap;">
        <a href="apply.php" class="btn btn-primary">Start Admission &rarr;</a>
        <a href="https://wa.me/263773966111?text=Hello%20Study%20Partners%2C%20I%20would%20like%20guidance%20on%20studying%20in%20Europe" target="_blank" class="btn btn-whatsapp">Speak to Academic Advisor</a>
      </div>
    </div>
  </section>

  <!-- Site Footer -->
  <footer class="site-footer">
    <div class="container">
      <div class="footer-top-grid">
        <div class="footer-brand-col">
          <a href="index.php" class="brand-logo" style="margin-bottom: 1rem; display: inline-block;">
            <img src="images/logo.png" alt="Study Partners" class="brand-logo-img" style="height: 48px;">
          </a>
          <p style="margin-top: 0.75rem;">
            Connecting African students to accredited European universities with transparent fees, guaranteed official study invitations, and dedicated visa support.
          </p>
          <div style="margin-top: 1.25rem; font-size: 0.85rem; color: var(--neutral-600); line-height: 1.6;">
            <p>📍 <strong>5 Premium Close</strong>, Mount Pleasant Business Park, Mount Pleasant, Harare, Zimbabwe</p>
            <p style="margin-top: 0.35rem;">📞 <strong>Zimbabwe:</strong> <a href="tel:+263773966111" style="color: var(--accent-emerald-700); font-weight: 700;">+263 773 966 111</a></p>
            <p style="margin-top: 0.2rem;">📞 <strong>South Africa:</strong> <a href="tel:+27833454421" style="color: var(--accent-emerald-700); font-weight: 700;">+27 833 454 421</a></p>
          </div>
          <div class="footer-socials">
            <a href="#" class="social-icon-btn" aria-label="Facebook">FB</a>
            <a href="#" class="social-icon-btn" aria-label="Instagram">IG</a>
            <a href="#" class="social-icon-btn" aria-label="LinkedIn">IN</a>
            <a href="#" class="social-icon-btn" aria-label="YouTube">YT</a>
          </div>
        </div>

        <div>
          <h4 class="footer-heading">Quick Links</h4>
          <ul class="footer-links-list">
            <li><a href="destinations.php">Study Destinations</a></li>
            <li><a href="degrees.php">Search Degrees & Fees</a></li>
            <li><a href="how-it-works.php">5-Step Process</a></li>
            <li><a href="pricing.php">Tuition & Living Costs</a></li>
            <li><a href="stories.php">Student Stories</a></li>
            <li><a href="apply.php">Apply Online</a></li>
          </ul>
        </div>

        <div>
          <h4 class="footer-heading">Portals & Partners</h4>
          <ul class="footer-links-list">
            <li><a href="login.php">Student Dashboard Login</a></li>
            <li><a href="login.php?role=agent">Authorized Agent Portal</a></li>
            <li><a href="login.php?role=admin">University Admin Panel</a></li>
            <li><a href="partner.php">Partner Your University</a></li>
            <li><a href="faq.php">FAQ & Visa Guidelines</a></li>
            <li><a href="contact.php">Contact Harare Office</a></li>
          </ul>
        </div>

        <div>
          <h4 class="footer-heading">Admissions Newsletter</h4>
          <p style="font-size: 0.85rem; color: var(--neutral-600); line-height: 1.5;">
            Get updates on new university intakes, European admission deadlines, and visa briefing dates.
          </p>
          <form class="newsletter-form" onsubmit="event.preventDefault(); showToast('Subscribed! Check your inbox for study guides.', 'success'); this.reset();">
            <input type="email" class="newsletter-input" placeholder="Enter student email" required>
            <button type="submit" class="btn btn-primary btn-sm">Join</button>
          </form>
          <p style="font-size: 0.72rem; color: var(--neutral-500); margin-top: 0.6rem;">No spam. Unsubscribe anytime.</p>
        </div>
      </div>

      <div class="footer-bottom-bar">
        <div>&copy; 2026 Study Partners. All rights reserved.</div>
        <div style="display: flex; gap: 1.5rem;">
          <a href="#" onclick="alert('Privacy policy: We respect student data strictly in compliance with data privacy standards.'); return false;">Privacy Policy</a>
          <a href="#" onclick="alert('Terms: Study Partners facilitates official institutional admissions.'); return false;">Terms of Service</a>
          <a href="sitemap.xml">Sitemap</a>
        </div>
      </div>

      <div class="footer-disclaimer">
        Disclaimer: Study Partners is an independent educational consultancy operating in direct liaison with accredited European State Universities and respective Ministries of Education. University tuition fees are payable directly into official State University treasury bank accounts.
      </div>
    </div>
  </footer>

  <!-- Floating WhatsApp Action Button & Interactive Chat Popup -->
  <button class="floating-whatsapp-btn" id="floatingWhatsAppBtn" aria-label="Chat with Admissions Counselor on WhatsApp">
    <svg width="34" height="34" fill="currentColor" viewBox="0 0 24 24">
      <path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.77-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.069-.252-.08-.575-.187-.988-.365-1.739-.751-2.874-2.502-2.961-2.617-.087-.116-.708-.94-.708-1.793s.448-1.273.607-1.446c.159-.173.346-.217.462-.217l.332.006c.106.005.249-.04.39.299.144.347.491 1.2.534 1.287.043.087.072.188.014.303-.058.116-.087.188-.173.289l-.26.303c-.087.087-.179.182-.077.356.101.173.449.741.964 1.201.662.591 1.221.774 1.394.861.173.086.275.072.376-.044.101-.116.433-.506.549-.679.116-.173.231-.144.39-.086s1.011.477 1.184.564.289.13.332.202c.043.073.043.419-.101.824z"/>
    </svg>
    <span class="whatsapp-tooltip">Chat on WhatsApp</span>
  </button>

  <!-- Interactive WhatsApp Popup Box -->
  <div class="whatsapp-chat-popup" id="whatsappPopup">
    <div class="popup-header">
      <div class="popup-advisor">
        <div class="advisor-avatar">SP</div>
        <div>
          <div class="advisor-name">Study Partners Counselor</div>
          <div class="advisor-status"><span class="status-dot"></span> Online &bull; Direct WhatsApp</div>
        </div>
      </div>
      <button class="popup-close" id="closeWhatsAppPopup" aria-label="Close Chat">&times;</button>
    </div>
    <div class="popup-body">
      <div class="chat-bubble received">
        👋 Hello! Welcome to Study Partners. Interested in studying Medicine, Engineering, or IT in Belarus or Europe?
      </div>
      <div class="chat-bubble received" style="font-size: 0.8rem; margin-top: -0.4rem; color: var(--neutral-600);">
        Tap below to start a live conversation with our official admissions counselor on WhatsApp.
      </div>
    </div>
    <div class="popup-footer">
      <a href="https://wa.me/263773966111?text=Hello%20Study%20Partners%2C%20I%20would%20like%20guidance%20on%20studying%20in%20Europe" target="_blank" class="btn btn-whatsapp-direct" id="startWhatsAppChatBtn">
        Open WhatsApp Chat &rarr;
      </a>
    </div>
  </div>

  <script src="js/main.js"></script>
  <script src="js/programs.js"></script>
</body>
</html>
