/**
 * AfriEuro Bridge - Multi-step Application Form Wizard
 * Handles 5-step application submission:
 * 1. Personal Information
 * 2. Academic Background
 * 3. Program Choice
 * 4. Document Upload
 * 5. Review & Submit
 */

document.addEventListener('DOMContentLoaded', () => {
  initApplyWizard();
});

function initApplyWizard() {
  const wizardForm = document.querySelector('#multiStepApplyForm');
  if (!wizardForm) return;

  let currentStep = 1;
  const totalSteps = 5;

  const stepIndicators = document.querySelectorAll('.wizard-step-node');
  const stepPanels = document.querySelectorAll('.wizard-step-panel');
  const btnPrev = document.querySelector('#btnStepPrev');
  const btnNext = document.querySelector('#btnStepNext');
  const btnSubmit = document.querySelector('#btnStepSubmit');
  const formProgress = document.querySelector('#wizardProgressBar');

  // Pre-fill program or university if specified in query string
  const urlParams = new URLSearchParams(window.location.search);
  const progParam = urlParams.get('program');
  const uniParam = urlParams.get('uni');
  if (progParam && document.querySelector('#appProgram')) {
    document.querySelector('#appProgram').value = progParam;
  }
  if (uniParam && document.querySelector('#appUniversity')) {
    document.querySelector('#appUniversity').value = uniParam;
  }

  function updateWizardView() {
    // Show active panel
    stepPanels.forEach(panel => {
      panel.classList.remove('active');
      if (parseInt(panel.dataset.step) === currentStep) {
        panel.classList.add('active');
      }
    });

    // Update step indicator status
    stepIndicators.forEach((node, index) => {
      const stepIdx = index + 1;
      node.classList.remove('active', 'completed');
      if (stepIdx < currentStep) {
        node.classList.add('completed');
      } else if (stepIdx === currentStep) {
        node.classList.add('active');
      }
    });

    // Update progress bar
    if (formProgress) {
      const pct = ((currentStep - 1) / (totalSteps - 1)) * 100;
      formProgress.style.width = `${pct}%`;
    }

    // Toggle navigation buttons
    if (btnPrev) {
      btnPrev.style.display = currentStep > 1 ? 'inline-flex' : 'none';
    }

    if (currentStep === totalSteps) {
      if (btnNext) btnNext.style.display = 'none';
      if (btnSubmit) btnSubmit.style.display = 'inline-flex';
      populateReviewData();
    } else {
      if (btnNext) btnNext.style.display = 'inline-flex';
      if (btnSubmit) btnSubmit.style.display = 'none';
    }

    window.scrollTo({ top: wizardForm.offsetTop - 90, behavior: 'smooth' });
  }

  function validateStep(step) {
    const activePanel = document.querySelector(`.wizard-step-panel[data-step="${step}"]`);
    if (!activePanel) return true;

    const requiredFields = activePanel.querySelectorAll('[required]');
    let isValid = true;

    requiredFields.forEach(field => {
      field.style.borderColor = '';
      if (!field.value.trim()) {
        field.style.borderColor = '#EF4444';
        isValid = false;
      }
      if (field.type === 'email' && field.value) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(field.value)) {
          field.style.borderColor = '#EF4444';
          isValid = false;
        }
      }
    });

    if (!isValid) {
      if (window.showToast) {
        window.showToast('Please fill in all required fields accurately.', 'warning');
      }
    }

    return isValid;
  }

  function populateReviewData() {
    const reviewData = {
      fullName: document.querySelector('#appFullName')?.value || 'Not provided',
      email: document.querySelector('#appEmail')?.value || 'Not provided',
      phone: document.querySelector('#appPhone')?.value || 'Not provided',
      nationality: document.querySelector('#appNationality')?.value || 'Not provided',
      passportNo: document.querySelector('#appPassport')?.value || 'Pending renewal',
      highestEdu: document.querySelector('#appHighestEdu')?.value || 'Not provided',
      schoolName: document.querySelector('#appSchoolName')?.value || 'Not provided',
      gradeGPA: document.querySelector('#appGradeGPA')?.value || 'Not provided',
      destination: document.querySelector('#appDestination')?.value || 'Belarus',
      university: document.querySelector('#appUniversity')?.value || 'Not specified',
      program: document.querySelector('#appProgram')?.value || 'General Medicine (MBBS)',
      level: document.querySelector('#appLevel')?.value || "Undergraduate Bachelor's",
      intake: document.querySelector('#appIntake')?.value || 'Fall 2026'
    };

    const reviewContainer = document.querySelector('#reviewSummaryContainer');
    if (reviewContainer) {
      reviewContainer.innerHTML = `
        <div class="review-grid" style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; background: var(--neutral-50); padding: 1.5rem; border-radius: var(--radius-lg); border: 1px solid var(--neutral-200);">
          <div class="review-block">
            <h4 style="font-size: 0.95rem; color: var(--primary-900); border-bottom: 1px solid var(--neutral-300); padding-bottom: 0.5rem; margin-bottom: 0.75rem;">1. Personal Information</h4>
            <p><strong>Name:</strong> ${reviewData.fullName}</p>
            <p><strong>Email:</strong> ${reviewData.email}</p>
            <p><strong>Phone / WhatsApp:</strong> ${reviewData.phone}</p>
            <p><strong>Nationality:</strong> ${reviewData.nationality}</p>
            <p><strong>Passport No:</strong> ${reviewData.passportNo}</p>
          </div>
          <div class="review-block">
            <h4 style="font-size: 0.95rem; color: var(--primary-900); border-bottom: 1px solid var(--neutral-300); padding-bottom: 0.5rem; margin-bottom: 0.75rem;">2. Academic Background</h4>
            <p><strong>Highest Level:</strong> ${reviewData.highestEdu}</p>
            <p><strong>Previous Institution:</strong> ${reviewData.schoolName}</p>
            <p><strong>Grade / GPA:</strong> ${reviewData.gradeGPA}</p>
          </div>
          <div class="review-block" style="grid-column: 1 / -1;">
            <h4 style="font-size: 0.95rem; color: var(--primary-900); border-bottom: 1px solid var(--neutral-300); padding-bottom: 0.5rem; margin-bottom: 0.75rem;">3. Selected European University & Program</h4>
            <p><strong>Destination:</strong> ${reviewData.destination}</p>
            <p><strong>University:</strong> ${reviewData.university}</p>
            <p><strong>Chosen Degree:</strong> <span style="color: var(--accent-emerald-600); font-weight: 700;">${reviewData.program}</span></p>
            <p><strong>Level & Intake:</strong> ${reviewData.level} &bull; ${reviewData.intake}</p>
          </div>
        </div>
      `;
    }
  }

  // File upload previews
  const fileInputs = document.querySelectorAll('.wizard-file-input');
  fileInputs.forEach(input => {
    input.addEventListener('change', () => {
      const previewTag = document.querySelector(`#${input.dataset.preview}`);
      if (previewTag && input.files.length > 0) {
        previewTag.textContent = `Attached: ${input.files[0].name} (${(input.files[0].size / 1024).toFixed(1)} KB)`;
        previewTag.style.color = 'var(--accent-emerald-600)';
        previewTag.style.fontWeight = '600';
      }
    });
  });

  // Next / Prev listeners
  btnNext?.addEventListener('click', () => {
    if (validateStep(currentStep)) {
      if (currentStep < totalSteps) {
        currentStep++;
        updateWizardView();
      }
    }
  });

  btnPrev?.addEventListener('click', () => {
    if (currentStep > 1) {
      currentStep--;
      updateWizardView();
    }
  });

  // Direct step click
  stepIndicators.forEach((node, index) => {
    node.addEventListener('click', () => {
      const targetStep = index + 1;
      if (targetStep < currentStep) {
        currentStep = targetStep;
        updateWizardView();
      } else if (targetStep === currentStep + 1 && validateStep(currentStep)) {
        currentStep = targetStep;
        updateWizardView();
      }
    });
  });

  // Final Submission
  wizardForm.addEventListener('submit', async (e) => {
    e.preventDefault();
    const agreeTerms = document.querySelector('#agreeTermsCheckbox');
    if (agreeTerms && !agreeTerms.checked) {
      alert('Please agree to the privacy policy and data evaluation terms.');
      return;
    }

    const submitBtn = wizardForm.querySelector('button[type="submit"]');
    const origBtnText = submitBtn ? submitBtn.innerHTML : 'Submit';
    if (submitBtn) {
      submitBtn.disabled = true;
      submitBtn.innerHTML = 'Registering Application...';
    }

    const payload = {
      source: 'Application Wizard',
      fullName: document.querySelector('#appFullName')?.value.trim(),
      email: document.querySelector('#appEmail')?.value.trim(),
      phone: document.querySelector('#appPhone')?.value.trim(),
      country: document.querySelector('#appNationality')?.value.trim(),
      destination: document.querySelector('#appDestination')?.value,
      program: document.querySelector('#appProgram')?.value,
      level: document.querySelector('#appLevel')?.value,
      schoolName: document.querySelector('#appSchoolName')?.value.trim(),
      gradeGPA: document.querySelector('#appGradeGPA')?.value.trim(),
      passportNo: document.querySelector('#appPassport')?.value.trim(),
      intake: document.querySelector('#appIntake')?.value,
      message: document.querySelector('#appNotes')?.value || 'Student Application Wizard Submission'
    };

    try {
      const res = await fetch('api/submit_lead.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(payload)
      });
      const data = await res.json();

      const appId = data.success ? data.lead_ref : ('SP-2026-' + Math.floor(1000 + Math.random() * 9000));

      // Store in localStorage for dashboard/preview
      const appRecord = {
        appId,
        submittedAt: new Date().toISOString(),
        studentName: payload.fullName,
        email: payload.email,
        program: payload.program,
        destination: payload.destination,
        status: 'Lead',
        stageIndex: 0
      };
      try {
        localStorage.setItem('afrieuro_latest_application', JSON.stringify(appRecord));
      } catch(err) {}

      // Show Confirmation Modal
      const modal = document.querySelector('#applySuccessModal');
      const displayAppId = document.querySelector('#modalAppId');
      if (displayAppId) displayAppId.textContent = appId;
      if (modal) {
        modal.classList.add('active');
      } else {
        if (window.showToast) {
          window.showToast(`Application ${appId} submitted successfully! Our admissions office in Harare is reviewing your files.`, 'success');
        }
      }
    } catch (err) {
      console.error(err);
      alert('Network error while saving application. Please contact us on WhatsApp: +263 773 966 111.');
    } finally {
      if (submitBtn) {
        submitBtn.disabled = false;
        submitBtn.innerHTML = origBtnText;
      }
    }
  });

  updateWizardView();
}
