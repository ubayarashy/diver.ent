@extends('layouts.app')
@section('content')
@include('partials.client.navbar-sidebar')

<div class="app-main">
    <div class="app-content">
        <div class="page-header">
            <h1>Ayo Kerjasama</h1>
            <p>Isi brief project Anda, tim kami akan segera menghubungi</p>
        </div>

        <div class="step-progress">
            <div class="step-item" id="step1Item">
                <div class="step-number">1</div>
                <div class="step-label">Pilih Layanan</div>
            </div>
            <div class="step-item" id="step2Item">
                <div class="step-number">2</div>
                <div class="step-label">Detail Proyek</div>
            </div>
            <div class="step-item" id="step3Item">
                <div class="step-number">3</div>
                <div class="step-label">Budget</div>
            </div>
            <div class="step-item" id="step4Item">
                <div class="step-number">4</div>
                <div class="step-label">Konfirmasi</div>
            </div>
        </div>

        <div class="form-card">
            <form id="briefForm">
                @csrf

                <div class="form-step" id="step1">
                    <div class="form-group">
                        <label>Pilih Layanan yang Dibutuhkan <span class="required">*</span></label>
                        <p class="form-hint">Kamu bisa memilih lebih dari satu layanan</p>
                        <div class="services-grid">
                            <div class="service-card" data-service="Social Media Management">
                                <div class="service-icon"><i class="fab fa-instagram"></i></div>
                                <div class="service-name">Social Media Management</div>
                                <div class="service-desc">Kelola akun Instagram, TikTok, Facebook</div>
                                <div class="service-check"><i class="fas fa-check-circle"></i></div>
                            </div>
                            <div class="service-card" data-service="Videography">
                                <div class="service-icon"><i class="fas fa-video"></i></div>
                                <div class="service-name">Videography</div>
                                <div class="service-desc">Produksi video company profile, iklan</div>
                                <div class="service-check"><i class="fas fa-check-circle"></i></div>
                            </div>
                            <div class="service-card" data-service="Fotografi">
                                <div class="service-icon"><i class="fas fa-camera"></i></div>
                                <div class="service-name">Fotografi</div>
                                <div class="service-desc">Foto produk, commercial, portrait</div>
                                <div class="service-check"><i class="fas fa-check-circle"></i></div>
                            </div>
                            <div class="service-card" data-service="Digital Ads">
                                <div class="service-icon"><i class="fas fa-chart-line"></i></div>
                                <div class="service-name">Digital Ads</div>
                                <div class="service-desc">Google Ads, Meta Ads, TikTok Ads</div>
                                <div class="service-check"><i class="fas fa-check-circle"></i></div>
                            </div>
                        </div>
                        <input type="hidden" id="selected_services">
                    </div>
                </div>

                <div class="form-step" id="step2">
                    <div class="form-group">
                        <label>Nama Proyek / Brand <span class="required">*</span></label>
                        <input type="text" id="project_name" placeholder="Contoh: Branding Cafe Aesthetic">
                    </div>
                    <div class="form-group">
                        <label>Deskripsi Proyek</label>
                        <textarea id="description" rows="4" placeholder="Ceritakan tentang proyek Anda, target audiens, konsep yang diinginkan..."></textarea>
                    </div>
                    <div class="form-group">
                        <label>Timeline / Deadline</label>
                        <input type="text" id="timeline" placeholder="Contoh: 2 minggu, 1 bulan, flexible">
                    </div>
                    <div class="form-group">
                        <label>Contact Information <span class="required">*</span></label>
                        <input type="text" id="contact" placeholder="Contoh: +62xxxxxxxxxx">
                    </div>
                </div>

                <div class="form-step" id="step3">
                    <div class="form-group">
                        <label>Estimasi Budget</label>
                        <div class="budget-wrapper">
                            <span class="budget-prefix">Rp</span>
                            <input type="text" id="budget" placeholder="1.000.000" oninput="formatRupiah(this)">
                        </div>
                        <p class="form-hint">Kosongkan jika belum tahu</p>
                    </div>
                    <div class="form-group">
                        <label>Referensi (Opsional)</label>
                        <input type="url" id="reference_link" placeholder="https://...">
                        <p class="form-hint">Contoh portfolio atau desain yang kamu suka</p>
                    </div>
                </div>

                <div class="form-step" id="step4">
                    <div class="summary-card">
                        <h3>Ringkasan Brief</h3>
                        <div class="summary-item">
                            <span class="summary-label">Layanan Dipilih</span>
                            <span class="summary-value" id="summaryServices">—</span>
                        </div>
                        <div class="summary-item">
                            <span class="summary-label">Nama Proyek</span>
                            <span class="summary-value" id="summaryProject">—</span>
                        </div>
                        <div class="summary-item">
                            <span class="summary-label">Deskripsi</span>
                            <span class="summary-value" id="summaryDesc">—</span>
                        </div>
                        <div class="summary-item">
                            <span class="summary-label">Timeline</span>
                            <span class="summary-value" id="summaryTimeline">—</span>
                        </div>
                        <div class="summary-item">
                            <span class="summary-label">Contact</span>
                            <span class="summary-value" id="summaryContact">—</span>
                        </div>
                        <div class="summary-item">
                            <span class="summary-label">Budget</span>
                            <span class="summary-value" id="summaryBudget">—</span>
                        </div>
                        <div class="summary-item">
                            <span class="summary-label">Referensi</span>
                            <span class="summary-value" id="summaryReference">—</span>
                        </div>
                    </div>
                    <div id="submitFeedback"></div>
                </div>

                <div class="form-navigation">
                    <button type="button" class="btn-prev" id="prevBtn" style="display: none;">Kembali</button>
                    <button type="button" class="btn-next" id="nextBtn">Lanjut</button>
                    <button type="submit" class="btn-submit" id="submitBtn" style="display: none;">Kirim Brief</button>
                </div>
            </form>
        </div>

        <div class="back-link">
            <a href="{{ route('home') }}" class="btn-back">Kembali ke Landing Page</a>
        </div>
    </div>
</div>

<div id="logout-modal" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.7); backdrop-filter: blur(8px); z-index: 1000; justify-content: center; align-items: center;">
    <div style="background: var(--surface); border: 1px solid var(--border); border-radius: 20px; padding: 32px; max-width: 400px; width: 90%; text-align: center;">
        <i class="fas fa-question-circle" style="font-size: 48px; color: var(--accent); margin-bottom: 16px;"></i>
        <h3>Konfirmasi Keluar</h3>
        <p>Apakah Anda yakin ingin keluar?</p>
        <div style="display: flex; gap: 12px; justify-content: center;">
            <button onclick="closeLogoutModal()" class="btn-outline">Batal</button>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn-primary">Keluar</button>
            </form>
        </div>
    </div>
</div>

<style>
.app-main {
    margin-left: 280px;
    min-height: 100vh;
    background: var(--bg);
     padding-top: 10px;
}

.app-content {
    max-width: 800px;
    margin: 0 auto;
    padding: 40px 48px;
}

.page-header {
    text-align: center;
    margin-bottom: 32px;
}

.page-header h1 {
    font-family: var(--font-display);
    font-size: 1.8rem;
    font-weight: 700;
    letter-spacing: -0.02em;
    margin-bottom: 8px;
}

.page-header p {
    color: var(--text-secondary);
    font-size: 0.9rem;
}

.step-progress {
    display: flex;
    justify-content: space-between;
    margin-bottom: 48px;
    position: relative;
    max-width: 500px;
    margin-left: auto;
    margin-right: auto;
}

.step-progress::before {
    content: '';
    position: absolute;
    top: 20px;
    left: 0;
    right: 0;
    height: 2px;
    background: var(--border);
    z-index: 0;
}

.step-item {
    text-align: center;
    position: relative;
    z-index: 1;
    flex: 1;
}

.step-number {
    width: 40px;
    height: 40px;
    background: var(--surface);
    border: 2px solid var(--border);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 10px;
    font-weight: 700;
    font-size: 0.9rem;
    transition: all 0.3s ease;
}

.step-item.active .step-number {
    background: var(--accent);
    border-color: var(--accent);
    color: #000;
}

.step-item.completed .step-number {
    background: #10b981;
    border-color: #10b981;
    color: #fff;
}

.step-label {
    font-size: 0.7rem;
    color: var(--text-secondary);
    font-weight: 500;
}

.step-item.active .step-label {
    color: var(--accent);
    font-weight: 600;
}

.form-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 20px;
    padding: 32px;
    margin-bottom: 24px;
}

.form-step {
    display: none;
    animation: fadeIn 0.3s ease;
}

.form-step.active-step {
    display: block;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(8px); }
    to { opacity: 1; transform: translateY(0); }
}

.form-group {
    margin-bottom: 24px;
}

.form-group label {
    display: block;
    margin-bottom: 8px;
    font-weight: 600;
    font-size: 0.85rem;
}

.required {
    color: #ef4444;
    margin-left: 4px;
}

.form-hint {
    font-size: 0.65rem;
    color: var(--text-secondary);
    margin-top: 6px;
}

.services-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 16px;
    margin-top: 16px;
}

.service-card {
    background: var(--bg);
    border: 1px solid var(--border);
    border-radius: 16px;
    padding: 20px;
    cursor: pointer;
    transition: all 0.3s ease;
    position: relative;
    text-align: center;
}

.service-card:hover {
    border-color: var(--accent);
    transform: translateY(-2px);
}

.service-card.selected {
    background: rgba(59, 130, 255, 0.06);
    border-color: var(--accent);
}

.service-card.selected .service-check {
    opacity: 1;
}

.service-icon {
    font-size: 1.8rem;
    margin-bottom: 12px;
    color: var(--accent);
}

.service-name {
    font-weight: 700;
    margin-bottom: 6px;
    font-size: 0.9rem;
}

.service-desc {
    font-size: 0.65rem;
    color: var(--text-secondary);
}

.service-check {
    position: absolute;
    top: 12px;
    right: 12px;
    color: var(--accent);
    opacity: 0;
    transition: opacity 0.3s;
    font-size: 1rem;
}

input, textarea {
    width: 100%;
    padding: 12px 16px;
    background: var(--bg);
    border: 1px solid var(--border);
    border-radius: 12px;
    color: var(--text);
    font-size: 0.85rem;
    font-family: inherit;
    transition: all 0.3s ease;
}

textarea {
    resize: vertical;
}

input:focus, textarea:focus {
    outline: none;
    border-color: var(--accent);
    box-shadow: 0 0 0 3px rgba(59, 130, 255, 0.08);
}

.budget-wrapper {
    position: relative;
}

.budget-prefix {
    position: absolute;
    left: 16px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--accent);
    font-weight: 600;
    font-size: 0.85rem;
}

.budget-wrapper input {
    padding-left: 48px;
}

.form-navigation {
    display: flex;
    justify-content: space-between;
    gap: 12px;
    margin-top: 32px;
}

.btn-prev, .btn-next, .btn-submit {
    padding: 10px 28px;
    border-radius: 40px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    border: none;
    font-size: 0.8rem;
}

.btn-prev {
    background: transparent;
    border: 1px solid var(--border);
    color: var(--text);
}

.btn-prev:hover {
    border-color: var(--accent);
    color: var(--accent);
    transform: translateX(-2px);
}

.btn-next, .btn-submit {
    background: var(--accent);
    color: #000;
    margin-left: auto;
}

.btn-next:hover, .btn-submit:hover {
    transform: translateY(-2px);
    opacity: 0.9;
}

.summary-card {
    background: var(--bg);
    border: 1px solid var(--border);
    border-radius: 16px;
    padding: 24px;
    margin-bottom: 24px;
}

.summary-card h3 {
    font-size: 1rem;
    font-weight: 600;
    margin-bottom: 20px;
    padding-bottom: 12px;
    border-bottom: 1px solid var(--border);
}

.summary-item {
    display: flex;
    justify-content: space-between;
    padding: 10px 0;
    border-bottom: 1px solid var(--border);
    gap: 16px;
}

.summary-item:last-child {
    border-bottom: none;
}

.summary-label {
    color: var(--text-secondary);
    font-size: 0.8rem;
    min-width: 110px;
}

.summary-value {
    font-weight: 500;
    text-align: right;
    font-size: 0.8rem;
    word-break: break-word;
    max-width: 60%;
}

.alert-success {
    background: rgba(16, 185, 129, 0.08);
    border-left: 3px solid #10b981;
    padding: 16px;
    border-radius: 12px;
    font-size: 0.85rem;
}

.back-link {
    text-align: center;
    margin-top: 16px;
}

.btn-back {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: transparent;
    border: none;
    color: var(--text-secondary);
    padding: 8px 16px;
    border-radius: 40px;
    text-decoration: none;
    font-size: 0.75rem;
    transition: all 0.3s ease;
}

.btn-back:hover {
    color: var(--accent);
    transform: translateX(-3px);
}

.btn-outline {
    background: transparent;
    border: 1px solid var(--border);
    color: var(--text);
    padding: 8px 20px;
    border-radius: 40px;
    font-weight: 600;
    font-size: 0.75rem;
    cursor: pointer;
    transition: all 0.3s ease;
}

.btn-outline:hover {
    border-color: var(--accent);
    color: var(--accent);
}

.btn-primary {
    background: var(--accent);
    color: #000;
    padding: 8px 20px;
    border-radius: 40px;
    font-weight: 600;
    font-size: 0.75rem;
    border: none;
    cursor: pointer;
    transition: all 0.3s ease;
}

.btn-primary:hover {
    transform: translateY(-2px);
    opacity: 0.9;
}

@media (max-width: 992px) {
    .app-main {
        margin-left: 0;
    }
    .app-content {
        padding: 32px 24px;
    }
}

@media (max-width: 768px) {
    .app-content {
        padding: 24px 20px;
    }
    .form-card {
        padding: 24px;
    }
    .services-grid {
        grid-template-columns: 1fr;
        gap: 12px;
    }
    .step-label {
        font-size: 0.6rem;
    }
    .step-number {
        width: 34px;
        height: 34px;
        font-size: 0.8rem;
    }
    .step-progress::before {
        top: 17px;
    }
    .summary-item {
        flex-direction: column;
        gap: 6px;
    }
    .summary-value {
        text-align: left;
        max-width: 100%;
    }
    .form-navigation {
        flex-direction: column;
    }
    .btn-next, .btn-submit {
        margin-left: 0;
        width: 100%;
        justify-content: center;
    }
    .btn-prev {
        width: 100%;
        justify-content: center;
    }
}

.reveal {
    opacity: 0;
    transform: translateY(20px);
    transition: opacity 0.7s ease, transform 0.7s ease;
}

.reveal.active {
    opacity: 1;
    transform: translateY(0);
}
</style>

<script>
    function formatRupiah(input) {
        let value = input.value.replace(/\D/g, '');
        if (value) {
            input.value = new Intl.NumberFormat('id-ID').format(value);
        } else {
            input.value = '';
        }
    }

    let currentStep = 1;
    let selectedServices = [];

    const step1 = document.getElementById('step1');
    const step2 = document.getElementById('step2');
    const step3 = document.getElementById('step3');
    const step4 = document.getElementById('step4');
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');
    const submitBtn = document.getElementById('submitBtn');
    const stepItems = {
        1: document.getElementById('step1Item'),
        2: document.getElementById('step2Item'),
        3: document.getElementById('step3Item'),
        4: document.getElementById('step4Item')
    };

    document.querySelectorAll('.service-card').forEach(card => {
        card.addEventListener('click', () => {
            const service = card.getAttribute('data-service');
            const index = selectedServices.indexOf(service);
            if (index === -1) {
                selectedServices.push(service);
                card.classList.add('selected');
            } else {
                selectedServices.splice(index, 1);
                card.classList.remove('selected');
            }
            document.getElementById('selected_services').value = JSON.stringify(selectedServices);
            updateSummary();
        });
    });

    function updateSummary() {
        const services = selectedServices.length > 0 ? selectedServices.join(', ') : '—';
        if (selectedServices.length > 0) {
            document.getElementById('summaryServices').innerHTML = `<div style="display: flex; flex-wrap: wrap; gap: 6px; justify-content: flex-end;">${selectedServices.map(s => `<span style="background: rgba(59,130,255,0.1); padding: 4px 10px; border-radius: 50px; font-size: 0.65rem;">${s}</span>`).join('')}</div>`;
        } else {
            document.getElementById('summaryServices').innerHTML = '—';
        }
        document.getElementById('summaryProject').innerText = document.getElementById('project_name').value || '—';
        let desc = document.getElementById('description').value || '—';
        document.getElementById('summaryDesc').innerText = desc.length > 100 ? desc.substring(0, 100) + '...' : desc;
        document.getElementById('summaryTimeline').innerText = document.getElementById('timeline').value || '—';
        document.getElementById('summaryContact').innerText = document.getElementById('contact').value || '—';
        const budgetRaw = document.getElementById('budget').value;
        document.getElementById('summaryBudget').innerText = budgetRaw ? 'Rp ' + budgetRaw : '—';
        document.getElementById('summaryReference').innerText = document.getElementById('reference_link').value || '—';
    }

    function showStep(step) {
        step1.classList.remove('active-step');
        step2.classList.remove('active-step');
        step3.classList.remove('active-step');
        step4.classList.remove('active-step');
        
        for (let i = 1; i <= 4; i++) {
            if (stepItems[i]) stepItems[i].classList.remove('active', 'completed');
        }
        
        for (let i = 1; i < step; i++) {
            if (stepItems[i]) stepItems[i].classList.add('completed');
        }
        if (stepItems[step]) stepItems[step].classList.add('active');
        
        if (step === 1) {
            step1.classList.add('active-step');
            prevBtn.style.display = 'none';
            nextBtn.style.display = 'flex';
            submitBtn.style.display = 'none';
        } else if (step === 2 || step === 3) {
            if (step === 2) {
                step2.classList.add('active-step');
            } else {
                step3.classList.add('active-step');
            }
            prevBtn.style.display = 'flex';
            nextBtn.style.display = 'flex';
            submitBtn.style.display = 'none';
        } else if (step === 4) {
            step4.classList.add('active-step');
            prevBtn.style.display = 'flex';
            nextBtn.style.display = 'none';
            submitBtn.style.display = 'flex';
            updateSummary();
        }
        currentStep = step;
    }

    function validateStep1() {
        if (selectedServices.length === 0) {
            alert('Mohon pilih minimal satu layanan');
            return false;
        }
        return true;
    }

    function validateStep2() {
        const projectName = document.getElementById('project_name').value.trim();
        if (!projectName) {
            alert('Mohon isi nama proyek');
            return false;
        }
        const contact = document.getElementById('contact').value.trim();
        if (!contact) {
            alert('Mohon isi contact information');
            return false;
        }
        if (contact.length < 8) {
            alert('Contact information minimal 8 karakter (nomor telepon/email)');
            return false;
        }
        return true;
    }

    nextBtn.addEventListener('click', () => {
        if (currentStep === 1 && !validateStep1()) return;
        if (currentStep === 2 && !validateStep2()) return;
        showStep(currentStep + 1);
    });

    prevBtn.addEventListener('click', () => {
        showStep(currentStep - 1);
    });

    // SUBMIT FORM - FULLY FIXED
    document.getElementById('briefForm').addEventListener('submit', async (e) => {
        e.preventDefault();
        
        // Validasi final
        if (!validateStep1() || !validateStep2()) {
            showStep(1);
            return;
        }
        
        // Disable submit button
        const submitButton = submitBtn;
        submitButton.disabled = true;
        submitButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Mengirim...';
        
        // Get CSRF token
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || 
                         document.querySelector('input[name="_token"]')?.value;
        
        if (!csrfToken) {
            alert('CSRF token tidak ditemukan. Silakan refresh halaman.');
            submitButton.disabled = false;
            submitButton.innerHTML = 'Kirim Brief';
            return;
        }
        
        // Get budget value (remove formatting)
        const budgetRaw = document.getElementById('budget').value;
        const budgetNumber = budgetRaw ? parseInt(budgetRaw.replace(/\D/g, '')) : null;
        
        // Prepare payload
        const payload = {
            project_name: document.getElementById('project_name').value.trim(),
            categories: selectedServices,
            description: document.getElementById('description').value.trim(),
            timeline: document.getElementById('timeline').value.trim(),
            contact: document.getElementById('contact').value.trim(),
            budget: budgetNumber,
            reference_link: document.getElementById('reference_link').value.trim(),
            _token: csrfToken
        };
        
        console.log('Sending payload:', payload); // Debug log
        
        try {
            const response = await fetch('/client/create-project/store', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'X-Requested-With': 'XMLHttpRequest'
                },
                credentials: 'same-origin',
                body: JSON.stringify(payload)
            });
            
            // Handle response
            let data;
            const contentType = response.headers.get('content-type');
            if (contentType && contentType.includes('application/json')) {
                data = await response.json();
            } else {
                const text = await response.text();
                console.error('Non-JSON response:', text);
                throw new Error('Server mengembalikan response yang tidak valid');
            }
            
            if (!response.ok) {
                throw new Error(data.message || `HTTP ${response.status}: ${response.statusText}`);
            }
            
            if (data.success) {
                // Success!
                document.getElementById('submitFeedback').innerHTML = `
                    <div class="alert-success" style="background: rgba(16, 185, 129, 0.1); border-left: 3px solid #10b981; padding: 16px; border-radius: 12px; margin-top: 16px;">
                        <strong style="color: #10b981;">✓ ${data.message}</strong>
                        <br><br>
                        <span style="font-size: 0.85rem;">Tim kami akan segera menghubungi Anda maksimal 1x24 jam.</span>
                    </div>
                `;
                
                // Disable all inputs
                document.querySelectorAll('input, textarea, .service-card, button').forEach(el => {
                    el.style.pointerEvents = 'none';
                    if (el.tagName === 'BUTTON' && el !== submitButton) {
                        el.disabled = true;
                    }
                });
                
                submitButton.style.display = 'none';
                prevBtn.style.display = 'none';
                
                // Optional: Reset after 5 seconds
                setTimeout(() => {
                    if (confirm('Brief berhasil dikirim! Ingin mengisi brief baru?')) {
                        window.location.reload();
                    }
                }, 3000);
            } else {
                throw new Error(data.message || 'Gagal mengirim brief');
            }
            
        } catch (error) {
            console.error('Error details:', error);
            
            let errorMessage = error.message;
            
            // Check for specific errors
            if (error.message.includes('Failed to fetch') || error.message.includes('NetworkError')) {
                errorMessage = 'Tidak dapat terhubung ke server. Periksa koneksi internet Anda.';
            } else if (error.message.includes('419')) {
                errorMessage = 'Sesi telah berakhir. Silakan refresh halaman dan coba lagi.';
            } else if (error.message.includes('500')) {
                errorMessage = 'Terjadi kesalahan pada server. Tim kami sedang memperbaikinya.';
            } else if (error.message.includes('422')) {
                errorMessage = 'Data tidak lengkap atau tidak valid. Periksa kembali form Anda.';
            }
            
            alert('Gagal mengirim brief: ' + errorMessage);
            
            // Re-enable submit button
            submitButton.disabled = false;
            submitButton.innerHTML = 'Kirim Brief';
        }
    });

    // Initialize
    showStep(1);

    // Add event listeners for real-time summary update
    document.getElementById('project_name').addEventListener('input', updateSummary);
    document.getElementById('description').addEventListener('input', updateSummary);
    document.getElementById('timeline').addEventListener('input', updateSummary);
    document.getElementById('contact').addEventListener('input', updateSummary);
    document.getElementById('budget').addEventListener('input', updateSummary);
    document.getElementById('reference_link').addEventListener('input', updateSummary);

    // Logout modal function
    function closeLogoutModal() {
        document.getElementById('logout-modal').style.display = 'none';
    }

    // 
    function reveal() {
        reveals.forEach(el => {
            const windowHeight = window.innerHeight;
            const revealTop = el.getBoundingClientRect().top;
            const revealPoint = 100;
            if (revealTop < windowHeight - revealPoint) {
                el.classList.add('active');
            }
        });
    }
    window.addEventListener('scroll', reveal);
    window.addEventListener('load', reveal);
</script>
@endsection