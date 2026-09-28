/**
 * AfriEuro Bridge - Degrees & Programs Directory
 * Accredited European Universities (focusing on Belarus initially)
 */

const programsDatabase = [
  {
    id: 'med-01',
    title: 'General Medicine (MBBS / MD)',
    university: 'Belarusian State Medical University (BSMU)',
    city: 'Minsk, Belarus',
    category: 'medicine',
    categoryLabel: 'Medical & Health Sciences',
    level: 'bachelor',
    levelLabel: "Undergraduate (6 Years MD)",
    duration: '6 Years',
    language: 'english',
    languageLabel: 'English Medium',
    tuitionUSD: 4900,
    tuitionNote: 'per academic year',
    accreditations: ['WHO Recognized', 'WFME Accredited', 'MDC / PMDC / ECFMG Eligible'],
    featured: true,
    description: 'Fully English-taught 6-year General Medicine degree with direct hospital clinical rotations starting from 3rd year. Recognized worldwide including GMC UK, USMLE, and Medical Dental Councils across Africa.'
  },
  {
    id: 'med-02',
    title: 'Dentistry (BDS / Stomatology)',
    university: 'Belarusian State Medical University (BSMU)',
    city: 'Minsk, Belarus',
    category: 'medicine',
    categoryLabel: 'Medical & Health Sciences',
    level: 'bachelor',
    levelLabel: "Undergraduate (5 Years BDS)",
    duration: '5 Years',
    language: 'english',
    languageLabel: 'English Medium',
    tuitionUSD: 4600,
    tuitionNote: 'per academic year',
    accreditations: ['WHO Recognized', 'WFME Accredited'],
    featured: true,
    description: 'Practical clinical training at modern dental simulation labs in Minsk. Rigorous European curriculum covering orthodontics, oral surgery, and pediatric dentistry.'
  },
  {
    id: 'med-03',
    title: 'Pharmacy (B.Pharm)',
    university: 'Vitebsk State Medical University (VSMU)',
    city: 'Vitebsk, Belarus',
    category: 'medicine',
    categoryLabel: 'Medical & Health Sciences',
    level: 'bachelor',
    levelLabel: "Undergraduate (5 Years)",
    duration: '5 Years',
    language: 'english',
    languageLabel: 'English Medium',
    tuitionUSD: 4100,
    tuitionNote: 'per academic year',
    accreditations: ['WHO Recognized', 'European Pharmacopoeia standard'],
    featured: false,
    description: 'Modern pharmaceutical laboratory research, drug formulation, and clinical pharmacy practice recognized across African health ministries.'
  },
  {
    id: 'cs-01',
    title: 'Computer Science & Software Engineering',
    university: 'Belarusian State University of Informatics and Radioelectronics (BSUIR)',
    city: 'Minsk, Belarus',
    category: 'engineering',
    categoryLabel: 'Engineering & Technology',
    level: 'bachelor',
    levelLabel: "Bachelor of Science (4 Years)",
    duration: '4 Years',
    language: 'english',
    languageLabel: 'English Medium',
    tuitionUSD: 3600,
    tuitionNote: 'per academic year',
    accreditations: ['European Bologna Standard', 'High Tech Park Partner'],
    featured: true,
    description: 'Top-tier tech university in Eastern Europe. Curriculum includes algorithms, cloud computing, cybersecurity, and internships with Minsk High-Tech Park companies.'
  },
  {
    id: 'cs-02',
    title: 'Artificial Intelligence & Data Systems',
    university: 'Belarusian State University (BSU)',
    city: 'Minsk, Belarus',
    category: 'engineering',
    categoryLabel: 'Engineering & Technology',
    level: 'master',
    levelLabel: "Master of Science (2 Years)",
    duration: '2 Years',
    language: 'english',
    languageLabel: 'English Medium',
    tuitionUSD: 3800,
    tuitionNote: 'per academic year',
    accreditations: ['Top 300 QS World Ranked', 'IEEE Member University'],
    featured: true,
    description: 'Advanced postgraduate specialization in machine learning, neural networks, predictive big data models, and computer vision with modern GPU labs.'
  },
  {
    id: 'eng-01',
    title: 'Civil & Architectural Engineering',
    university: 'Belarusian National Technical University (BNTU)',
    city: 'Minsk, Belarus',
    category: 'engineering',
    categoryLabel: 'Engineering & Technology',
    level: 'bachelor',
    levelLabel: "Bachelor of Engineering (4 Years)",
    duration: '4 Years',
    language: 'english',
    languageLabel: 'English Medium',
    tuitionUSD: 3300,
    tuitionNote: 'per academic year',
    accreditations: ['UNESCO-FEANI recognized', 'Bologna Process'],
    featured: false,
    description: 'Structural engineering, CAD BIM design, seismic-resilient infrastructure construction and sustainable building technology.'
  },
  {
    id: 'eng-02',
    title: 'Aeronautical & Mechanical Engineering',
    university: 'Belarusian National Technical University (BNTU)',
    city: 'Minsk, Belarus',
    category: 'engineering',
    categoryLabel: 'Engineering & Technology',
    level: 'bachelor',
    levelLabel: "Bachelor of Engineering (4 Years)",
    duration: '4 Years',
    language: 'english',
    languageLabel: 'English Medium',
    tuitionUSD: 3500,
    tuitionNote: 'per academic year',
    accreditations: ['ICAO aligned training', 'BNTU Aeronautics Institute'],
    featured: false,
    description: 'Aerodynamics, aircraft maintenance, propulsion systems, and robotics design with practical workshop exposure.'
  },
  {
    id: 'bus-01',
    title: 'International Business & Digital Management',
    university: 'Belarusian State Economic University (BSEU)',
    city: 'Minsk, Belarus',
    category: 'business',
    categoryLabel: 'Business & Management',
    level: 'bachelor',
    levelLabel: "BBA (4 Years)",
    duration: '4 Years',
    language: 'english',
    languageLabel: 'English Medium',
    tuitionUSD: 2900,
    tuitionNote: 'per academic year',
    accreditations: ['European Business Education standard', 'Ministry of Education'],
    featured: true,
    description: 'Strategic international management, trade finance, digital marketing, supply chain logistics, and cross-border European entrepreneurship.'
  },
  {
    id: 'bus-02',
    title: 'MBA - Master of Business Administration',
    university: 'School of Business of Belarusian State University',
    city: 'Minsk, Belarus',
    category: 'business',
    categoryLabel: 'Business & Management',
    level: 'master',
    levelLabel: "MBA (1.5 - 2 Years)",
    duration: '1.5 - 2 Years',
    language: 'english',
    languageLabel: 'English Medium',
    tuitionUSD: 3900,
    tuitionNote: 'per academic year',
    accreditations: ['AMBA aligned', 'Central European Quality Assurance'],
    featured: false,
    description: 'Designed for young African entrepreneurs and corporate leaders seeking global business perspectives, investment modeling, and leadership.'
  },
  {
    id: 'fnd-01',
    title: 'Preparatory / University Foundation Year',
    university: 'Pre-University Faculty at Belarusian State University',
    city: 'Minsk / Grodno / Vitebsk',
    category: 'foundation',
    categoryLabel: 'Foundation & Languages',
    level: 'foundation',
    levelLabel: 'Foundation Program (9-10 Months)',
    duration: '10 Months',
    language: 'russian',
    languageLabel: 'Russian Intensive + English Prep',
    tuitionUSD: 2200,
    tuitionNote: 'total program fee',
    accreditations: ['Guaranteed European University Entry on Completion'],
    featured: false,
    description: 'Intensive language certification and prerequisite science/math training guaranteeing progression into any university program in Belarus or Eastern Europe.'
  }
];

function initDegreesFilter() {
  const container = document.querySelector('#programsListContainer');
  const countBadge = document.querySelector('#programsCount');
  const categoryFilter = document.querySelector('#filterCategory');
  const levelFilter = document.querySelector('#filterLevel');
  const languageFilter = document.querySelector('#filterLanguage');
  const searchInput = document.querySelector('#searchProgramInput');
  const resetBtn = document.querySelector('#resetFiltersBtn');

  if (!container) return;

  function renderPrograms(list) {
    if (countBadge) {
      countBadge.textContent = `${list.length} Programs Found`;
    }

    if (list.length === 0) {
      container.innerHTML = `
        <div class="empty-state-card" style="grid-column: 1/-1; text-align: center; padding: 4rem 2rem; background: var(--white); border-radius: var(--radius-xl); border: 1px dashed var(--neutral-300);">
          <div style="font-size: 3rem; margin-bottom: 1rem;">🔍</div>
          <h3 style="font-size: 1.4rem; color: var(--primary-900); margin-bottom: 0.5rem;">No programs match your search</h3>
          <p style="color: var(--neutral-600); max-width: 500px; margin: 0 auto 1.5rem;">Try adjusting your filters or search keywords. You can also chat directly with our university admissions advisors.</p>
          <button class="btn btn-primary" onclick="window.resetFilters()">Reset All Filters</button>
        </div>
      `;
      return;
    }

    container.innerHTML = list.map(prog => `
      <div class="program-card">
        <div class="prog-card-header">
          <div class="prog-badges">
            <span class="prog-category-badge">${prog.categoryLabel}</span>
            <span class="prog-lang-badge">${prog.languageLabel}</span>
          </div>
          <div class="prog-fee-box">
            <span class="prog-fee-amt">$${prog.tuitionUSD.toLocaleString()}</span>
            <span class="prog-fee-sub">USD / year</span>
          </div>
        </div>

        <h3 class="prog-title">${prog.title}</h3>
        <div class="prog-university">
          <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20"><path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z"/></svg>
          <span>${prog.university}</span>
        </div>
        <div class="prog-city">
          <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
          <span>${prog.city} &bull; ${prog.duration}</span>
        </div>

        <p class="prog-desc">${prog.description}</p>

        <div class="prog-accreditations">
          ${prog.accreditations.map(acc => `<span class="acc-tag">&#10003; ${acc}</span>`).join('')}
        </div>

        <div class="prog-card-footer">
          <a href="apply.html?program=${encodeURIComponent(prog.title)}&uni=${encodeURIComponent(prog.university)}" class="btn btn-primary btn-sm" style="flex: 1;">Apply for this Program &rarr;</a>
          <a href="contact.html?subject=${encodeURIComponent('Inquiry: ' + prog.title)}" class="btn btn-secondary btn-sm" title="Inquire on Program">Ask Advisor</a>
        </div>
      </div>
    `).join('');
  }

  function applyFilters() {
    const selectedCat = categoryFilter?.value || 'all';
    const selectedLevel = levelFilter?.value || 'all';
    const selectedLang = languageFilter?.value || 'all';
    const query = searchInput?.value.trim().toLowerCase() || '';

    const filtered = programsDatabase.filter(prog => {
      const matchCat = (selectedCat === 'all' || prog.category === selectedCat);
      const matchLevel = (selectedLevel === 'all' || prog.level === selectedLevel);
      const matchLang = (selectedLang === 'all' || prog.language === selectedLang);
      const matchQuery = !query || (
        prog.title.toLowerCase().includes(query) ||
        prog.university.toLowerCase().includes(query) ||
        prog.description.toLowerCase().includes(query)
      );
      return matchCat && matchLevel && matchLang && matchQuery;
    });

    renderPrograms(filtered);
  }

  window.resetFilters = function() {
    if (categoryFilter) categoryFilter.value = 'all';
    if (levelFilter) levelFilter.value = 'all';
    if (languageFilter) languageFilter.value = 'all';
    if (searchInput) searchInput.value = '';
    renderPrograms(programsDatabase);
  };

  categoryFilter?.addEventListener('change', applyFilters);
  levelFilter?.addEventListener('change', applyFilters);
  languageFilter?.addEventListener('change', applyFilters);
  searchInput?.addEventListener('input', applyFilters);
  resetBtn?.addEventListener('click', window.resetFilters);

  // Check URL query parameters for pre-filtering (e.g. ?category=medicine)
  const urlParams = new URLSearchParams(window.location.search);
  const catParam = urlParams.get('category');
  if (catParam && categoryFilter) {
    categoryFilter.value = catParam;
  }

  applyFilters();
}

document.addEventListener('DOMContentLoaded', () => {
  initDegreesFilter();
});
