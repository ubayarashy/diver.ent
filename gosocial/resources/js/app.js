/* ===== diver.ent JavaScript ===== */

document.addEventListener('DOMContentLoaded', () => {
    // Announcement Bar Dismiss
    const annBar = document.querySelector('.announcement-bar');
    const closeBtn = document.querySelector('.announcement-bar .close-btn');
    if (closeBtn && annBar) {
        closeBtn.addEventListener('click', () => annBar.classList.add('hidden'));
    }

    // Mobile Menu Toggle
    const hamburger = document.querySelector('.hamburger');
    const navLinks = document.querySelector('.nav-links');
    if (hamburger && navLinks) {
        hamburger.addEventListener('click', () => {
            navLinks.classList.toggle('active');
            hamburger.classList.toggle('active');
        });
    }

    // Scroll Reveal Animations
    const reveals = document.querySelectorAll('.reveal');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
            }
        });
    }, { threshold: 0.1, rootMargin: '0px 0px -50px 0px' });
    reveals.forEach(el => observer.observe(el));

    // Portfolio Filter
    const filterBtns = document.querySelectorAll('.filter-btn');
    const portfolioItems = document.querySelectorAll('.portfolio-item');
    filterBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            filterBtns.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            const filter = btn.dataset.filter;
            portfolioItems.forEach(item => {
                if (filter === 'all' || item.dataset.category === filter) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    });

    // Modal System
    document.querySelectorAll('[data-modal]').forEach(trigger => {
        trigger.addEventListener('click', (e) => {
            e.preventDefault();
            const modal = document.getElementById(trigger.dataset.modal);
            if (modal) modal.classList.add('active');
        });
    });
    document.querySelectorAll('.modal-close, .modal-backdrop').forEach(el => {
        el.addEventListener('click', (e) => {
            if (e.target === el) {
                el.closest('.modal-backdrop')?.classList.remove('active');
                if (el.classList.contains('modal-backdrop')) el.classList.remove('active');
            }
        });
    });

    // WhatsApp Float
    const waFloat = document.querySelector('.wa-float');
    if (waFloat) {
        waFloat.addEventListener('click', () => {
            const modal = document.getElementById('wa-modal');
            if (modal) modal.classList.add('active');
        });
    }

    // Testimonial Auto-Slide (simple index-based for mobile)
    const cards = document.querySelectorAll('.testimonial-card');
    let currentTestimonial = 0;
    if (window.innerWidth <= 768 && cards.length > 1) {
        const showCard = (idx) => {
            cards.forEach((c, i) => {
                c.style.display = i === idx ? 'block' : 'none';
            });
        };
        showCard(0);
        setInterval(() => {
            currentTestimonial = (currentTestimonial + 1) % cards.length;
            showCard(currentTestimonial);
        }, 4000);
    }

    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(a => {
        a.addEventListener('click', (e) => {
            e.preventDefault();
            const target = document.querySelector(a.getAttribute('href'));
            if (target) {
                target.scrollIntoView({ behavior: 'smooth' });
                navLinks?.classList.remove('active');
            }
        });
    });

    // Counter Animation
    const counters = document.querySelectorAll('.stat-number');
    const counterObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const el = entry.target;
                const end = parseInt(el.dataset.count) || 0;
                const suffix = el.dataset.suffix || '';
                let start = 0;
                const duration = 2000;
                const step = end / (duration / 16);
                const animate = () => {
                    start += step;
                    if (start < end) {
                        el.textContent = Math.floor(start) + suffix;
                        requestAnimationFrame(animate);
                    } else {
                        el.textContent = end + suffix;
                    }
                };
                animate();
                counterObserver.unobserve(el);
            }
        });
    }, { threshold: 0.5 });
    counters.forEach(c => counterObserver.observe(c));

    // Modal Switching (Login <-> Register)
    const switchToReg = document.getElementById('switch-to-register');
    const switchToLog = document.getElementById('switch-to-login');
    if (switchToReg) {
        switchToReg.addEventListener('click', (e) => {
            e.preventDefault();
            document.getElementById('login-modal')?.classList.remove('active');
            document.getElementById('register-modal')?.classList.add('active');
        });
    }
    if (switchToLog) {
        switchToLog.addEventListener('click', (e) => {
            e.preventDefault();
            document.getElementById('register-modal')?.classList.remove('active');
            document.getElementById('login-modal')?.classList.add('active');
        });
    }

    // Theme Toggle
    const themeToggle = document.getElementById('theme-toggle');
    if (themeToggle) {
        themeToggle.addEventListener('click', () => {
            const currentTheme = document.documentElement.getAttribute('data-theme') || 'light';
            const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
            document.documentElement.setAttribute('data-theme', newTheme);
            localStorage.setItem('theme', newTheme);
        });
    }

    // Password Visibility (Hold to show)
    document.querySelectorAll('.toggle-pw').forEach(btn => {
        const target = document.getElementById(btn.dataset.target);
        if (!target) return;
        
        const show = () => { target.type = 'text'; btn.textContent = '🙈'; };
        const hide = () => { target.type = 'password'; btn.textContent = '👁️'; };
        
        btn.addEventListener('mousedown', show);
        btn.addEventListener('touchstart', (e) => { e.preventDefault(); show(); }, {passive: false});
        
        btn.addEventListener('mouseup', hide);
        btn.addEventListener('mouseleave', hide);
        btn.addEventListener('touchend', hide);
        btn.addEventListener('touchcancel', hide);
    });
});

// ===== Registration Form Functions =====


function checkPasswordStrength(pw) {
    const fill = document.getElementById('pw-fill');
    const text = document.getElementById('pw-text');
    if (!fill || !text) return;

    let score = 0;
    if (pw.length >= 8) score++;
    if (pw.length >= 12) score++;
    if (/[A-Z]/.test(pw)) score++;
    if (/[0-9]/.test(pw)) score++;
    if (/[^A-Za-z0-9]/.test(pw)) score++;

    const levels = [
        { width: '0%', color: 'transparent', label: '' },
        { width: '20%', color: '#f87171', label: 'Sangat Lemah' },
        { width: '40%', color: '#fb923c', label: 'Lemah' },
        { width: '60%', color: '#fbbf24', label: 'Cukup' },
        { width: '80%', color: '#a3e635', label: 'Kuat' },
        { width: '100%', color: '#4ade80', label: 'Sangat Kuat' },
    ];

    const level = levels[score] || levels[0];
    fill.style.width = level.width;
    fill.style.background = level.color;
    text.textContent = level.label;
    text.style.color = level.color;

    checkPasswordMatch();
}

function checkPasswordMatch() {
    const pw = document.getElementById('reg-password');
    const confirm = document.getElementById('reg-confirm');
    const msg = document.getElementById('pw-match-msg');
    const btn = document.getElementById('reg-submit');
    if (!pw || !confirm || !msg || !btn) return;

    if (confirm.value === '') {
        msg.textContent = '';
        msg.className = 'pw-match-msg';
        btn.disabled = true;
        return;
    }

    if (pw.value === confirm.value) {
        msg.textContent = '✓ Password cocok';
        msg.className = 'pw-match-msg success';
        btn.disabled = pw.value.length < 8;
    } else {
        msg.textContent = '✗ Password tidak cocok';
        msg.className = 'pw-match-msg error';
        btn.disabled = true;
    }
}

function handleRegister(e) {
    e.preventDefault();
    const name = document.getElementById('reg-name').value;
    const email = document.getElementById('reg-email').value;
    const pw = document.getElementById('reg-password').value;
    const confirm = document.getElementById('reg-confirm').value;

    if (pw !== confirm) {
        alert('Password tidak cocok!');
        return false;
    }
    if (pw.length < 8) {
        alert('Password minimal 8 karakter!');
        return false;
    }

    // Show success feedback
    const modal = document.getElementById('register-modal');
    const inner = modal.querySelector('.modal');
    inner.innerHTML = `
        <div style="text-align:center;padding:20px 0;">
            <div style="font-size:3rem;margin-bottom:16px;">✅</div>
            <h2 style="font-family:var(--font-display);font-size:1.5rem;font-weight:800;margin-bottom:8px;">Akun Berhasil Dibuat!</h2>
            <p style="color:var(--text-secondary);font-size:.9rem;margin-bottom:24px;">Selamat datang, ${name}. Silakan login untuk mengakses Client Area.</p>
            <button class="btn-primary" style="width:100%;justify-content:center;" onclick="document.getElementById('register-modal').classList.remove('active');document.getElementById('login-modal').classList.add('active');">
                Login Sekarang →
            </button>
        </div>
    `;
    return false;
}
