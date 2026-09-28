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
   Navbar & Navigation Logic
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

  // Mobile menu toggle
  if (mobileToggle && navMenu) {
    mobileToggle.addEventListener('click', () => {
      const isOpen = navMenu.classList.toggle('open');
      mobileToggle.setAttribute('aria-expanded', isOpen);
      const icon = mobileToggle.querySelector('svg');
      if (icon) {
        if (isOpen) {
          icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />';
        } else {
          icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />';
        }
      }
    });
  }

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
