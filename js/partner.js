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

    const submitBtn = partnerForm.querySelector('button[type="submit"]');
    const origBtnText = submitBtn ? submitBtn.innerHTML : 'Submit';
    if (submitBtn) {
      submitBtn.disabled = true;
      submitBtn.innerHTML = 'Submitting Enquiry...';
    }

    const payload = {
      source: 'Partner University Inquiry',
      fullName: contactPerson + (repRole ? ' (' + repRole + ')' : ''),
      email: repEmail,
      phone: repPhone,
      country: country,
      destination: country,
      program: 'Institutional Partnership',
      schoolName: uniName,
      intake: targetIntake,
      message: message || 'University Partnership Inquiry'
    };

    fetch('api/submit_lead.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(payload)
    })
    .then(res => res.json())
    .then(data => {
      const leadRef = data.success ? data.lead_ref : ('LEAD-UNI-' + Math.floor(10000 + Math.random() * 90000));
      const modal = document.querySelector('#partnerSuccessModal');
      const modalLeadRef = document.querySelector('#modalPartnerLeadRef');
      if (modalLeadRef) modalLeadRef.textContent = leadRef;

      if (modal) {
        modal.classList.add('active');
      } else {
        if (window.showToast) {
          window.showToast(`Partnership inquiry (${leadRef}) sent successfully!`, 'success');
        }
      }
      partnerForm.reset();
    })
    .catch(err => {
      console.error(err);
      alert('Error submitting inquiry. Please contact us on WhatsApp: +263 773 966 111.');
    })
    .finally(() => {
      if (submitBtn) {
        submitBtn.disabled = false;
        submitBtn.innerHTML = origBtnText;
      }
    });
  });
});
