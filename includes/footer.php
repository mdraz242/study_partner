<?php
/**
 * Study Partners - Shared Footer Component
 */
$root = $root ?? '';
?>
  <!-- Site Footer -->
  <footer class="site-footer">
    <div class="container">
      <div class="footer-top-grid">
        <div class="footer-brand-col">
          <a href="<?= $root ?>index.php" class="brand-logo" style="margin-bottom: 1rem; display: inline-block;">
            <img src="<?= $root ?>images/logo.png" alt="Study Partners" class="brand-logo-img" style="height: 48px;">
          </a>
          <p style="margin-top: 0.75rem;">
            Connecting African students to accredited European & Asian universities with transparent fees, guaranteed official study invitations, and dedicated visa support.
          </p>
          <div style="margin-top: 1.25rem; font-size: 0.85rem; color: var(--neutral-600); line-height: 1.6;">
            <p>📍 <strong>5 Premium Close</strong>, Mount Pleasant Business Park, Mount Pleasant, Harare, Zimbabwe</p>
            <p style="margin-top: 0.35rem;">📞 <strong>Zimbabwe:</strong> <a href="tel:+263773966111" style="color: var(--accent-emerald-700); font-weight: 700;">+263 773 966 111</a></p>
            <p style="margin-top: 0.2rem;">📞 <strong>South Africa:</strong> <a href="tel:+27833454421" style="color: var(--accent-emerald-700); font-weight: 700;">+27 833 454 421</a></p>
          </div>
        </div>

        <div class="footer-links-col">
          <h4>Destinations</h4>
          <ul>
            <li><a href="<?= $root ?>destinations.php#belarus">Belarus (Primary Hub)</a></li>
            <li><a href="<?= $root ?>destinations.php#europe-expansion">China (CSC Scholarships)</a></li>
            <li><a href="<?= $root ?>destinations.php#europe-expansion">Poland (EU Expansion)</a></li>
            <li><a href="<?= $root ?>destinations.php#europe-expansion">Germany (Tech Hub)</a></li>
            <li><a href="<?= $root ?>destinations.php#europe-expansion">Hungary (Stipendium)</a></li>
          </ul>
        </div>

        <div class="footer-links-col">
          <h4>Degree Tracks</h4>
          <ul>
            <li><a href="<?= $root ?>degrees.php?category=medicine">General Medicine (MBBS)</a></li>
            <li><a href="<?= $root ?>degrees.php?category=medicine">Dentistry (BDS)</a></li>
            <li><a href="<?= $root ?>degrees.php?category=engineering">Computer Science & AI</a></li>
            <li><a href="<?= $root ?>degrees.php?category=engineering">Software Engineering</a></li>
            <li><a href="<?= $root ?>degrees.php?category=business">Business Administration</a></li>
            <li><a href="<?= $root ?>degrees.php?category=foundation">Preparatory / Foundation</a></li>
          </ul>
        </div>

        <div class="footer-links-col">
          <h4>Quick Links & Portals</h4>
          <ul>
            <li><a href="<?= $root ?>how-it-works.php">How It Works</a></li>
            <li><a href="<?= $root ?>pricing.php">Pricing & Packages</a></li>
            <li><a href="<?= $root ?>faq.php">Frequently Asked Questions</a></li>
            <li><a href="<?= $root ?>stories.php">Student Success Stories</a></li>
            <li><a href="<?= $root ?>partner.php" style="color: var(--accent-gold-600); font-weight: 700;">University Partners</a></li>
            <li><a href="<?= $root ?>admin/login.php" style="color: var(--accent-emerald-700); font-weight: 700;">Staff / Admin CRM</a></li>
          </ul>
        </div>
      </div>

      <div class="footer-bottom">
        <div>
          &copy; <?= date('Y') ?> Study Partners. All rights reserved. Registered Educational Consultancy &middot; Harare, Zimbabwe.
        </div>
        <div class="footer-bottom-links">
          <a href="<?= $root ?>contact.php">Harare Admissions Office</a>
          <a href="<?= $root ?>apply.php">Online Application</a>
          <a href="<?= $root ?>admin/login.php">Staff Login</a>
        </div>
      </div>
    </div>
  </footer>

  <!-- Floating WhatsApp Action Button -->
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
        👋 Hello! Welcome to Study Partners. Interested in studying Medicine, Engineering, or IT in Belarus, China, or Europe?
      </div>
      <div class="chat-bubble received" style="font-size: 0.8rem; margin-top: -0.4rem; color: var(--neutral-600);">
        Tap below to start a live conversation with our official admissions counselor on WhatsApp.
      </div>
    </div>
    <div class="popup-footer">
      <a href="https://wa.me/263773966111?text=Hello%20Study%20Partners%2C%20I%20would%20like%20guidance%20on%20studying%20abroad" target="_blank" class="btn btn-whatsapp-direct" id="startWhatsAppChatBtn">
        Open WhatsApp Chat &rarr;
      </a>
    </div>
  </div>

  <!-- Toast Notification Container -->
  <div class="toast-container" id="toastContainer"></div>

  <script src="<?= $root ?>js/main.js"></script>
  <?php if (!empty($extra_scripts)): ?>
    <?php foreach ($extra_scripts as $script): ?>
      <script src="<?= $root . $script ?>"></script>
    <?php endforeach; ?>
  <?php endif; ?>
</body>
</html>
