/**
 * AfriEuro Bridge - Core Application JavaScript
 * Handles navigation, mobile menu, toast alerts, WhatsApp widgets,
 * and interactive pipeline demonstrators.
 */

document.addEventListener('DOMContentLoaded', () => {
  initNavbar();
  initWhatsAppWidget();
  initPipelineDemo();
  initFaqAccordion();
});

/* ==========================================================================
   Navbar & Mobile Navigation Logic
   ========================================================================== */
function initNavbar() {
  const navbar = document.querySelector('.navbar');
  const mobileToggle = document.querySelector('.mobile-toggle');
  const navMenu = document.querySelector('.nav-menu');

  // Sticky navbar shadow on scroll
  window.addEventListener('scroll', () => {
    if (window.scrollY > 20) {
      navbar?.classList.add('scrolled');
    } else {
      navbar?.classList.remove('scrolled');
    }
  });

  if (!mobileToggle || !navMenu) return;

  // 1. Ensure Backdrop Element exists
  let backdrop = document.querySelector('.nav-backdrop');
  if (!backdrop) {
    backdrop = document.createElement('div');
    backdrop.className = 'nav-backdrop';
    backdrop.id = 'navBackdrop';
    document.body.appendChild(backdrop);
  }

  // 2. Ensure Mobile Drawer Header exists inside navMenu
  if (!navMenu.querySelector('.mobile-nav-header')) {
    const mobileHeader = document.createElement('div');
    mobileHeader.className = 'mobile-nav-header';
    mobileHeader.innerHTML = `
      <a href="index.html" class="mobile-nav-brand" aria-label="Study Partners">
        <img src="images/logo.png" alt="Study Partners" class="mobile-nav-logo">
      </a>
      <button class="mobile-nav-close" id="mobileNavClose" aria-label="Close navigation menu">
        <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M6 18L18 6M6 6l12 12"/>
        </svg>
      </button>
    `;
    navMenu.prepend(mobileHeader);
  }

  // 3. Ensure Mobile Drawer Footer with CTAs & Quick Contacts exists
  if (!navMenu.querySelector('.mobile-nav-footer')) {
    const mobileFooter = document.createElement('div');
    mobileFooter.className = 'mobile-nav-footer';
    mobileFooter.innerHTML = `
      <div class="mobile-nav-cta">
        <a href="apply.html" class="btn btn-primary btn-block">
          Apply Now
          <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
        </a>
      </div>
      <div class="mobile-nav-portal">
        <a href="login.html" class="mobile-portal-link">
          <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/></svg>
          Student Portal Login
        </a>
      </div>
      <div class="mobile-nav-contacts">
        <div class="mobile-contact-title">Direct Student Support</div>
        <a href="tel:+263773966111" class="mobile-contact-chip">
          <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
          +263 773 966 111 (Harare)
        </a>
        <a href="tel:+27833454421" class="mobile-contact-chip">
          <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
          +27 833 454 421 (South Africa)
        </a>
        <div class="mobile-contact-address">
          <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
          5 Premium Close, Mount Pleasant, Harare
        </div>
      </div>
    `;
    navMenu.appendChild(mobileFooter);
  }

  const mobileNavClose = document.getElementById('mobileNavClose');

  // Open & Close Menu Helpers
  function openMobileMenu() {
    navMenu.classList.add('open');
    backdrop?.classList.add('active');
    document.body.classList.add('nav-locked');
    mobileToggle.setAttribute('aria-expanded', 'true');
    const icon = mobileToggle.querySelector('svg');
    if (icon) {
      icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />';
    }
  }

  function closeMobileMenu() {
    navMenu.classList.remove('open');
    backdrop?.classList.remove('active');
    document.body.classList.remove('nav-locked');
    mobileToggle.setAttribute('aria-expanded', 'false');
    const icon = mobileToggle.querySelector('svg');
    if (icon) {
      icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />';
    }
  }

  mobileToggle.addEventListener('click', (e) => {
    e.stopPropagation();
    if (navMenu.classList.contains('open')) {
      closeMobileMenu();
    } else {
      openMobileMenu();
    }
  });

  mobileNavClose?.addEventListener('click', (e) => {
    e.stopPropagation();
    closeMobileMenu();
  });

  backdrop?.addEventListener('click', () => {
    closeMobileMenu();
  });

  // Close on Escape key
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && navMenu.classList.contains('open')) {
      closeMobileMenu();
    }
  });

  // Auto-close on resize to desktop (> 900px)
  window.addEventListener('resize', () => {
    if (window.innerWidth > 900 && navMenu.classList.contains('open')) {
      closeMobileMenu();
    }
  });

  // 4. Accordion Toggle for Submenus on Mobile
  const navItems = navMenu.querySelectorAll('.nav-item');
  navItems.forEach(item => {
    const dropdown = item.querySelector('.dropdown-menu');
    const link = item.querySelector('.nav-link');
    if (dropdown && link) {
      link.addEventListener('click', (e) => {
        if (window.innerWidth <= 900) {
          e.preventDefault();
          const wasOpen = item.classList.contains('dropdown-open');
          // Close other open dropdowns for a clean accordion effect
          navItems.forEach(other => {
            if (other !== item) other.classList.remove('dropdown-open');
          });
          item.classList.toggle('dropdown-open', !wasOpen);
        }
      });
    } else if (link) {
      // Regular link without dropdown: close menu upon click
      link.addEventListener('click', () => {
        if (window.innerWidth <= 900) {
          closeMobileMenu();
        }
      });
    }
  });

  // Submenu dropdown items: close menu upon click
  navMenu.querySelectorAll('.dropdown-item').forEach(item => {
    item.addEventListener('click', () => {
      if (window.innerWidth <= 900) {
        closeMobileMenu();
      }
    });
  });

  // Active link highlighter based on current page
  const currentPath = window.location.pathname.split('/').pop() || 'index.html';
  const navLinks = document.querySelectorAll('.nav-link');
  navLinks.forEach(link => {
    const href = link.getAttribute('href');
    if (href === currentPath || (currentPath === '' && href === 'index.html')) {
      link.classList.add('active');
    }
  });
}

/* ==========================================================================
   WhatsApp Floating Widget & Chat Trigger
   ========================================================================== */
function initWhatsAppWidget() {
  const whatsappBtn = document.querySelector('#floatingWhatsAppBtn');
  const whatsappPopup = document.querySelector('#whatsappPopup');
  const popupCloseBtn = document.querySelector('#closeWhatsappPopup');
  const quickChatInput = document.querySelector('#whatsappQuickInput');
  const sendQuickChat = document.querySelector('#sendQuickChatBtn');

  const defaultPhone = '263773966111'; // Study Partners Admissions Desk (+263 773 966 111)

  if (whatsappBtn && whatsappPopup) {
    whatsappBtn.addEventListener('click', (e) => {
      e.stopPropagation();
      whatsappPopup.classList.toggle('active');
    });

    popupCloseBtn?.addEventListener('click', () => {
      whatsappPopup.classList.remove('active');
    });

    document.addEventListener('click', (e) => {
      if (!whatsappPopup.contains(e.target) && !whatsappBtn.contains(e.target)) {
        whatsappPopup.classList.remove('active');
      }
    });

    const triggerWhatsAppMessage = () => {
      const msg = quickChatInput?.value.trim() || 'Hello Study Partners! I am interested in applying to accredited European universities. Can you guide me?';
      const encoded = encodeURIComponent(msg);
      window.open(`https://wa.me/${defaultPhone}?text=${encoded}`, '_blank');
      whatsappPopup.classList.remove('active');
      if (quickChatInput) quickChatInput.value = '';
    };

    sendQuickChat?.addEventListener('click', triggerWhatsAppMessage);
    quickChatInput?.addEventListener('keypress', (e) => {
      if (e.key === 'Enter') triggerWhatsAppMessage();
    });
  }
}

/* ==========================================================================
   Interactive Student Portal Pipeline Demo (Home Page & Dashboard Showcase)
   ========================================================================== */
const pipelineStages = [
  {
    step: 1,
    id: 'lead',
    name: 'Lead',
    date: 'Sep 12, 2026',
    title: 'Profile Created & Consultation Booked',
    desc: 'Student profile verified by Study Partners advisor. Free 1-on-1 counseling session held to evaluate high school transcripts and select optimal European university matches.',
    badgeClass: 'status-pill',
    items: ['Passport scanned & verified', 'WAEC/NECO/KCSE transcript evaluated', 'Program options selected (MBBS / Computer Eng.)']
  },
  {
    step: 2,
    id: 'consulted',
    name: 'Consulted',
    date: 'Sep 16, 2026',
    title: 'Academic Pathway Formulated',
    desc: 'University eligibility confirmed. Complete cost sheet prepared with transparent tuition, dormitory fees, and health insurance breakdown.',
    badgeClass: 'status-pill',
    items: ['University selection finalized', 'Direct eligibility review passed', 'Sponsor affidavit prepared']
  },
  {
    step: 3,
    id: 'applied',
    name: 'Applied',
    date: 'Sep 21, 2026',
    title: 'Dossier Submitted to University Dean',
    desc: 'Official application submitted directly to the Ministry of Education & University International Department in Belarus.',
    badgeClass: 'status-pill',
    items: ['Legalized translations submitted', 'Application fee processed', 'University registration code generated']
  },
  {
    step: 4,
    id: 'admitted',
    name: 'Admitted',
    date: 'Sep 27, 2026',
    title: 'Official Invitation Letter Issued!',
    desc: 'University and Ministry of Migration issued the official Study Invitation Letter required for European study entry.',
    badgeClass: 'status-pill admitted',
    items: ['Official Ministry Invitation approved', 'Admission certificate ready for download', 'Pre-departure briefing scheduled']
  },
  {
    step: 5,
    id: 'visa',
    name: 'Visa Pending',
    date: 'In Progress',
    title: 'Embassy Visa Processing / Airport Entry Visa',
    desc: 'Visa application package collated with air tickets and medical clearance certificates.',
    badgeClass: 'status-pill',
    items: ['Flight itinerary booked', 'Medical fitness test certified', 'Airport migration clearance filed']
  },
  {
    step: 6,
    id: 'enrolled',
    name: 'Enrolled',
    date: 'Upcoming',
    title: 'Campus Arrival & Student Dormitory Check-in',
    desc: 'Airport reception in Minsk by Study Partners student coordinator, university hostel check-in, and student biometric card issuance.',
    badgeClass: 'status-pill',
    items: ['Airport pickup by student rep', 'Dormitory room assigned', 'Student ID card issued']
  }
];

function initPipelineDemo() {
  const nodes = document.querySelectorAll('.stepper-node');
  const progressBar = document.querySelector('.stepper-pipeline-progress');
  const statusTitle = document.querySelector('#pipelineStageTitle');
  const statusDesc = document.querySelector('#pipelineStageDesc');
  const checklistContainer = document.querySelector('#pipelineChecklist');
  const statusPill = document.querySelector('#pipelineStatusPill');

  if (!nodes.length || !progressBar) return;

  function updatePipeline(index) {
    const stage = pipelineStages[index];
    if (!stage) return;

    // Update progress bar width
    const pct = (index / (pipelineStages.length - 1)) * 100;
    progressBar.style.width = `${pct}%`;

    // Update nodes styling
    nodes.forEach((node, i) => {
      node.classList.remove('completed', 'current');
      if (i < index) {
        node.classList.add('completed');
      } else if (i === index) {
        node.classList.add('current');
      }
    });

    // Update dynamic stage text
    if (statusTitle) statusTitle.textContent = stage.title;
    if (statusDesc) statusDesc.textContent = stage.desc;
    if (statusPill) {
      statusPill.textContent = stage.name;
      statusPill.className = stage.badgeClass;
    }

    if (checklistContainer) {
      checklistContainer.innerHTML = stage.items.map(item => `
        <div class="check-item">
          <svg class="check-icon" width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
          </svg>
          <span>${item}</span>
        </div>
      `).join('');
    }
  }

  nodes.forEach((node, index) => {
    node.addEventListener('click', () => {
      updatePipeline(index);
    });
    node.style.cursor = 'pointer';
  });

  // Default to step 4 (Admitted) for demonstration
  updatePipeline(3);
}

/* ==========================================================================
   Accordion Component (FAQ Page)
   ========================================================================== */
function initFaqAccordion() {
  const faqItems = document.querySelectorAll('.faq-item');
  faqItems.forEach(item => {
    const header = item.querySelector('.faq-header');
    if (header) {
      header.addEventListener('click', () => {
        const isOpen = item.classList.contains('active');
        // Close others
        faqItems.forEach(other => other.classList.remove('active'));
        if (!isOpen) {
          item.classList.add('active');
        }
      });
    }
  });
}

/* ==========================================================================
   Toast Notification Helper
   ========================================================================== */
function showToast(message, type = 'success') {
  let toast = document.querySelector('.toast-notification');
  if (!toast) {
    toast = document.createElement('div');
    toast.className = 'toast-notification';
    document.body.appendChild(toast);
  }

  const iconSvg = type === 'success' 
    ? `<svg class="toast-icon" width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>`
    : `<svg class="toast-icon" width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>`;

  toast.innerHTML = `${iconSvg} <span>${message}</span>`;
  toast.classList.add('active');

  setTimeout(() => {
    toast.classList.remove('active');
  }, 4000);
}

window.showToast = showToast;
