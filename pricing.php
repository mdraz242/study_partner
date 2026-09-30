<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tuition & Cost Transparency | Study Partners</title>
  <meta name="description" content="100% transparent European tuition and living cost breakdown for African students. Compare annual tuition, dormitory fees, and living costs in Belarus.">
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
          <a href="degrees.php" class="nav-link">Degrees</a>
        </li>
        <li class="nav-item">
          <a href="how-it-works.php" class="nav-link">How It Works</a>
        </li>
        <li class="nav-item">
          <a href="pricing.php" class="nav-link active">Pricing</a>
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
      <span class="section-tag" style="background: rgba(16, 185, 129, 0.15); border-color: rgba(16, 185, 129, 0.3);">Financial Transparency</span>
      <h1>Transparent Pricing & Living Costs</h1>
      <p>Clear, honest, and predictable educational budgeting. All university tuition is paid directly into official state university accounts upon arrival.</p>
      <div class="breadcrumbs">
        <a href="index.php">Home</a> &rsaquo; <span>Pricing</span>
      </div>
    </div>
  </header>

  <!-- Currency Converter Bar -->
  <div style="background: var(--white); border-bottom: 1px solid var(--neutral-200); padding: 1.25rem 0;">
    <div class="container" style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 1rem;">
      <div style="display: flex; align-items: center; gap: 0.75rem;">
        <span style="font-weight: 700; color: var(--primary-900); font-size: 0.95rem;">Select Display Currency:</span>
        <select id="currencySelector" class="form-select" style="width: auto; padding: 0.45rem 1rem; font-weight: 600;">
          <option value="USD" selected>USD ($) - US Dollar</option>
          <option value="EUR">EUR (€) - Euro</option>
          <option value="NGN">NGN (₦) - Nigerian Naira</option>
          <option value="GHS">GHS (GH₵) - Ghanaian Cedi</option>
          <option value="KES">KES (KSh) - Kenyan Shilling</option>
        </select>
      </div>
      <div style="font-size: 0.8rem; color: var(--neutral-500);">
        *Indicative rates. Official payments to universities are cleared in USD or EUR.
      </div>
    </div>
  </div>

  <!-- Pricing Cards Breakdown -->
  <section class="section-padding" style="background: var(--neutral-50);">
    <div class="container">
      <div class="text-center">
        <span class="section-tag">Annual University Tuition</span>
        <h2 class="section-title">Official Tuition by Program Tier</h2>
        <p class="section-desc">Fixed state university fees. Pay semester-by-semester directly to university bursars.</p>
      </div>

      <div class="pricing-cards-grid">
        <!-- Tier 1: Engineering & IT -->
        <div class="pricing-card">
          <span style="font-size: 0.8rem; font-weight: 700; color: var(--primary-600); text-transform: uppercase;">Engineering & Technology</span>
          <h3 style="font-size: 1.4rem; color: var(--primary-900); margin: 0.5rem 0;">Computer Science / AI / Civil</h3>
          <div class="pricing-price" data-usd="3500">$3,500 <span>/ year</span></div>
          <p style="font-size: 0.85rem; color: var(--neutral-500);">BSUIR & BNTU &bull; English Medium</p>

          <div class="pricing-features-list">
            <div class="pricing-feature-item">
              <span style="color: var(--accent-emerald-600);">&#10003;</span>
              <span>4-Year Bachelor of Engineering</span>
            </div>
            <div class="pricing-feature-item">
              <span style="color: var(--accent-emerald-600);">&#10003;</span>
              <span>Access to Minsk Tech Park Labs</span>
            </div>
            <div class="pricing-feature-item">
              <span style="color: var(--accent-emerald-600);">&#10003;</span>
              <span>Semester installment payment allowed</span>
            </div>
            <div class="pricing-feature-item">
              <span style="color: var(--accent-emerald-600);">&#10003;</span>
              <span>European Bologna ECTS diploma supplement</span>
            </div>
          </div>

          <a href="apply.php?program=Computer%20Science" class="btn btn-secondary" style="width: 100%;">Select Engineering</a>
        </div>

        <!-- Tier 2: Medicine (Featured) -->
        <div class="pricing-card featured">
          <span class="pricing-featured-badge">Most Popular</span>
          <span style="font-size: 0.8rem; font-weight: 700; color: var(--accent-emerald-700); text-transform: uppercase;">Medical Sciences</span>
          <h3 style="font-size: 1.4rem; color: var(--primary-900); margin: 0.5rem 0;">General Medicine (MBBS / MD)</h3>
          <div class="pricing-price" data-usd="4900">$4,900 <span>/ year</span></div>
          <p style="font-size: 0.85rem; color: var(--neutral-500);">BSMU & VSMU &bull; 6-Year English Track</p>

          <div class="pricing-features-list">
            <div class="pricing-feature-item">
              <span style="color: var(--accent-emerald-600); font-weight: 800;">&#10003;</span>
              <span>WHO, WFME, GMC UK & USMLE Eligible</span>
            </div>
            <div class="pricing-feature-item">
              <span style="color: var(--accent-emerald-600); font-weight: 800;">&#10003;</span>
              <span>Direct Hospital Rotations from Year 3</span>
            </div>
            <div class="pricing-feature-item">
              <span style="color: var(--accent-emerald-600); font-weight: 800;">&#10003;</span>
              <span>Cadaveric & simulation center training</span>
            </div>
            <div class="pricing-feature-item">
              <span style="color: var(--accent-emerald-600); font-weight: 800;">&#10003;</span>
              <span>African Medical Council accreditation</span>
            </div>
          </div>

          <a href="apply.php?program=General%20Medicine" class="btn btn-primary" style="width: 100%;">Apply for MBBS</a>
        </div>

        <!-- Tier 3: Business & Foundation -->
        <div class="pricing-card">
          <span style="font-size: 0.8rem; font-weight: 700; color: var(--accent-gold-600); text-transform: uppercase;">Business & Foundation</span>
          <h3 style="font-size: 1.4rem; color: var(--primary-900); margin: 0.5rem 0;">BBA, MBA & Prep Courses</h3>
          <div class="pricing-price" data-usd="2900">$2,900 <span>/ year</span></div>
          <p style="font-size: 0.85rem; color: var(--neutral-500);">BSEU & BSU &bull; English / Foundation</p>

          <div class="pricing-features-list">
            <div class="pricing-feature-item">
              <span style="color: var(--accent-emerald-600);">&#10003;</span>
              <span>Intensive language and foundation prep ($2,200)</span>
            </div>
            <div class="pricing-feature-item">
              <span style="color: var(--accent-emerald-600);">&#10003;</span>
              <span>4-Year Bachelor of Business Admin</span>
            </div>
            <div class="pricing-feature-item">
              <span style="color: var(--accent-emerald-600);">&#10003;</span>
              <span>International trade law & European marketing</span>
            </div>
            <div class="pricing-feature-item">
              <span style="color: var(--accent-emerald-600);">&#10003;</span>
              <span>Guaranteed progression upon completion</span>
            </div>
          </div>

          <a href="apply.php?program=International%20Business" class="btn btn-secondary" style="width: 100%;">Select Business</a>
        </div>
      </div>
    </div>
  </section>

  <!-- Real Living Cost Breakdown Table -->
  <section class="section-padding" style="background: var(--white);">
    <div class="container">
      <div class="text-center" style="margin-bottom: 3rem;">
        <span class="section-tag gold">Student Budgeting</span>
        <h2 class="section-title">Estimated Monthly Living Expenses in Minsk</h2>
        <p class="section-desc">Belarus offers the lowest cost of living in Europe with world-class public infrastructure.</p>
      </div>

      <div style="max-width: 800px; margin: 0 auto; background: var(--neutral-50); border-radius: var(--radius-xl); overflow: hidden; border: 1px solid var(--neutral-200);">
        <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 0.95rem;">
          <thead>
            <tr style="background: #F0FDF4; color: #166534; border-bottom: 2px solid #DCFCE7;">
              <th style="padding: 1.25rem 1.5rem;">Expense Category</th>
              <th style="padding: 1.25rem 1.5rem;">Estimated Monthly Cost</th>
              <th style="padding: 1.25rem 1.5rem;">Remarks</th>
            </tr>
          </thead>
          <tbody>
            <tr style="border-bottom: 1px solid var(--neutral-200);">
              <td style="padding: 1.1rem 1.5rem; font-weight: 600;">University Dormitory Hostel</td>
              <td style="padding: 1.1rem 1.5rem; color: var(--accent-emerald-600); font-weight: 700;">$35 - $60 / month</td>
              <td style="padding: 1.1rem 1.5rem; font-size: 0.85rem; color: var(--neutral-600);">Furnished room, 24/7 heating, high-speed WiFi</td>
            </tr>
            <tr style="border-bottom: 1px solid var(--neutral-200);">
              <td style="padding: 1.1rem 1.5rem; font-weight: 600;">Food & Groceries</td>
              <td style="padding: 1.1rem 1.5rem; color: var(--accent-emerald-600); font-weight: 700;">$120 - $160 / month</td>
              <td style="padding: 1.1rem 1.5rem; font-size: 0.85rem; color: var(--neutral-600);">Supermarkets, chicken, rice, bread, fruits</td>
            </tr>
            <tr style="border-bottom: 1px solid var(--neutral-200);">
              <td style="padding: 1.1rem 1.5rem; font-weight: 600;">City Metro & Bus Pass</td>
              <td style="padding: 1.1rem 1.5rem; color: var(--accent-emerald-600); font-weight: 700;">$15 / month</td>
              <td style="padding: 1.1rem 1.5rem; font-size: 0.85rem; color: var(--neutral-600);">Unlimited student travel across Minsk metro</td>
            </tr>
            <tr style="border-bottom: 1px solid var(--neutral-200);">
              <td style="padding: 1.1rem 1.5rem; font-weight: 600;">Mobile SIM & 5G Unlimited Data</td>
              <td style="padding: 1.1rem 1.5rem; color: var(--accent-emerald-600); font-weight: 700;">$8 - $12 / month</td>
              <td style="padding: 1.1rem 1.5rem; font-size: 0.85rem; color: var(--neutral-600);">High-speed mobile data (A1 or MTS Belarus)</td>
            </tr>
            <tr style="background: rgba(16, 185, 129, 0.08); font-weight: 800;">
              <td style="padding: 1.25rem 1.5rem; color: var(--primary-900);">Total Estimated Monthly Living</td>
              <td style="padding: 1.25rem 1.5rem; color: var(--accent-emerald-700); font-size: 1.2rem;">~$200 - $280 / mo</td>
              <td style="padding: 1.25rem 1.5rem; font-size: 0.85rem; color: var(--neutral-700);">Approx. 3x cheaper than UK / Germany</td>
            </tr>
          </tbody>
        </table>
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
  <script>
    // Simple client-side currency converter
    const rates = {
      USD: { rate: 1, symbol: '$', suffix: '/ year' },
      EUR: { rate: 0.92, symbol: '€', suffix: '/ year' },
      NGN: { rate: 1520, symbol: '₦', suffix: '/ year' },
      GHS: { rate: 15.2, symbol: 'GH₵', suffix: '/ year' },
      KES: { rate: 130, symbol: 'KSh', suffix: '/ year' }
    };

    const currencySelect = document.querySelector('#currencySelector');
    const priceElements = document.querySelectorAll('.pricing-price[data-usd]');

    currencySelect?.addEventListener('change', () => {
      const cur = currencySelect.value;
      const config = rates[cur] || rates.USD;

      priceElements.forEach(el => {
        const usdVal = parseFloat(el.dataset.usd);
        const converted = Math.round(usdVal * config.rate);
        el.innerHTML = `${config.symbol}${converted.toLocaleString()} <span>${config.suffix}</span>`;
      });
    });
  </script>
</body>
</html>
