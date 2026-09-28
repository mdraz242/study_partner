/**
 * AfriEuro Bridge - Partner Your University
 * Handles European university institutional partnerships, leads intake,
 * and recruitment collaboration inquiries.
 */

document.addEventListener('DOMContentLoaded', () => {
  const partnerForm = document.querySelector('#partnerEnquiryForm');
  if (!partnerForm) return;

  partnerForm.addEventListener('submit', (e) => {
    e.preventDefault();

    const uniName = document.querySelector('#uniName')?.value.trim();
    const country = document.querySelector('#uniCountry')?.value;
    const contactPerson = document.querySelector('#repName')?.value.trim();
    const repRole = document.querySelector('#repRole')?.value.trim();
    const repEmail = document.querySelector('#repEmail')?.value.trim();
    const repPhone = document.querySelector('#repPhone')?.value.trim();
    const targetIntake = document.querySelector('#targetIntake')?.value;
    const message = document.querySelector('#repMessage')?.value.trim();

    if (!uniName || !repEmail || !contactPerson) {
      if (window.showToast) {
        window.showToast('Please fill in your institution and contact details.', 'warning');
      }
      return;
    }

    const leadRef = 'LEAD-UNI-' + Math.floor(10000 + Math.random() * 90000);

    const leadData = {
      leadRef,
      type: 'university_partner',
      universityName: uniName,
      country: country,
      contactPerson,
      repRole,
      email: repEmail,
      phone: repPhone,
      targetIntake,
      message,
      createdAt: new Date().toISOString(),
      status: 'new'
    };

    // Store in localStorage leads table (ready to bind to Supabase Postgres in Phase 2)
    try {
      const existingLeads = JSON.parse(localStorage.getItem('afrieuro_leads') || '[]');
      existingLeads.push(leadData);
      localStorage.setItem('afrieuro_leads', JSON.stringify(existingLeads));
    } catch(err) {
      console.warn('Storage quota', err);
    }

    // Success notification
    const modal = document.querySelector('#partnerSuccessModal');
    const modalLeadRef = document.querySelector('#modalPartnerLeadRef');
    if (modalLeadRef) modalLeadRef.textContent = leadRef;

    if (modal) {
      modal.classList.add('active');
    } else {
      if (window.showToast) {
        window.showToast(`Partnership inquiry (${leadRef}) sent successfully! Our European partnerships director will respond within 24 hours.`, 'success');
      }
      partnerForm.reset();
    }
  });
});
