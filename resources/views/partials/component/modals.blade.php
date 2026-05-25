{{-- Login Modal --}}
<div class="modal-backdrop" id="login-modal">
    <div class="modal" onclick="event.stopPropagation()">
        <button class="modal-close" onclick="closeModal('login-modal')">&times;</button>
        <h2>Sign In</h2>
        <p>Masuk ke Client Area GoSocial.</p>
        
        <div id="login-error" class="error-message" style="display:none;"></div>
        
        <input type="email" class="modal-input" id="login-email" placeholder="Email address">
        <div style="position:relative;">
            <input type="password" class="modal-input" id="login-password" placeholder="Password">
            <button type="button" class="toggle-pw" data-target="login-password">👁️</button>
        </div>
        <label style="display:flex; align-items:center; gap:8px; margin:12px 0;">
            <input type="checkbox" id="login-remember"> Ingat saya
        </label>
        <a href="#" style="font-size:.82rem;color:var(--accent);display:block;margin-bottom:16px;" id="forgot-password-link">Lupa password?</a>
        
        <button class="btn-primary" id="login-btn" style="width:100%;justify-content:center;">Sign In</button>
        
        <button class="btn-outline" id="google-login-btn" style="width:100%;justify-content:center;margin-top:12px;">
            <svg width="18" height="18" viewBox="0 0 48 48" style="margin-right:8px;">
                <path fill="#4285F4" d="M24 9.5c3.54 0 6.71 1.22 9.21 3.6l6.85-6.85C35.9 2.38 30.47 0 24 0 14.62 0 6.51 5.38 2.56 13.22l7.98 6.19C12.43 13.72 17.74 9.5 24 9.5z"/>
                <path fill="#34A853" d="M46.98 24.55c0-1.57-.15-3.09-.38-4.55H24v9.02h12.94c-.58 2.96-2.26 5.48-4.78 7.18l7.73 6c4.51-4.18 7.09-10.36 7.09-17.65z"/>
                <path fill="#FBBC05" d="M10.53 28.59A14.5 14.5 0 019.5 24c0-1.59.28-3.14.76-4.59l-7.98-6.19A23.99 23.99 0 000 24c0 3.77.9 7.34 2.44 10.51l8.09-5.92z"/>
                <path fill="#EA4335" d="M24 48c6.48 0 11.93-2.13 15.89-5.81l-7.73-6c-2.15 1.45-4.92 2.3-8.16 2.3-6.26 0-11.57-4.22-13.47-9.91l-7.98 6.19C6.51 42.62 14.62 48 24 48z"/>
            </svg>
            Sign in with Google
        </button>
        
        <div class="modal-switch">Belum punya akun? <a href="#" onclick="switchModal('register-modal')">Sign Up</a></div>
    </div>
</div>

{{-- Register Modal --}}
<div class="modal-backdrop" id="register-modal">
    <div class="modal" onclick="event.stopPropagation()">
        <button class="modal-close" onclick="closeModal('register-modal')">&times;</button>
        <h2>Sign Up</h2>
        <p>Buat akun untuk akses Client Area.</p>
        
        <div id="register-error" class="error-message" style="display:none;"></div>
        <div id="register-success" class="success-message" style="display:none;"></div>
        
        <input type="text" class="modal-input" id="reg-name" placeholder="Nama Lengkap">
        <input type="email" class="modal-input" id="reg-email" placeholder="Email address">
        
        <div style="position:relative;">
            <input type="password" class="modal-input" id="reg-password" placeholder="Password">
            <button type="button" class="toggle-pw" data-target="reg-password">👁️</button>
        </div>
        
        <div class="pw-strength" id="pw-strength">
            <div class="pw-bar"><div class="pw-fill" id="pw-fill"></div></div>
            <span class="pw-text" id="pw-text"></span>
        </div>
        
        <div style="position:relative; margin-top:12px;">
            <input type="password" class="modal-input" id="reg-confirm" placeholder="Konfirmasi Password">
            <button type="button" class="toggle-pw" data-target="reg-confirm">👁️</button>
        </div>
        <div class="pw-match-msg" id="pw-match-msg"></div>
        
        <button class="btn-primary" id="register-btn" style="width:100%;justify-content:center;margin-top:16px;">Create Account</button>
        
        <div class="modal-switch">Sudah punya akun? <a href="#" onclick="switchModal('login-modal')">Sign In</a></div>
    </div>
</div>

{{-- Forgot Password Modal --}}
<div class="modal-backdrop" id="forgot-modal">
    <div class="modal" onclick="event.stopPropagation()">
        <button class="modal-close" onclick="closeModal('forgot-modal')">&times;</button>
        <h2>Lupa Password?</h2>
        <p>Masukkan email Anda, kami akan kirim link reset password.</p>
        
        <div id="forgot-error" class="error-message" style="display:none;"></div>
        <div id="forgot-success" class="success-message" style="display:none;"></div>
        
        <input type="email" class="modal-input" id="forgot-email" placeholder="Email address">
        
        <button class="btn-primary" id="forgot-btn" style="width:100%;justify-content:center;">Kirim Link Reset</button>
        
        <div class="modal-switch"><a href="#" onclick="switchModal('login-modal')">Kembali ke Login</a></div>
    </div>
</div>

{{-- Success/Error Toast --}}
<div id="toast-notification" class="toast-notification" style="display:none;">
    <span id="toast-message"></span>
</div>

<style>
.modal-backdrop {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.8);
    backdrop-filter: blur(8px);
    display: none;
    justify-content: center;
    align-items: center;
    z-index: 1000;
}

.modal {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 24px;
    padding: 32px;
    max-width: 450px;
    width: 90%;
    position: relative;
}

.modal-close {
    position: absolute;
    top: 20px;
    right: 20px;
    background: none;
    border: none;
    color: var(--text-secondary);
    font-size: 24px;
    cursor: pointer;
}

.modal-input {
    width: 100%;
    padding: 14px 16px;
    background: var(--bg);
    border: 1px solid var(--border);
    border-radius: 12px;
    color: var(--text-primary);
    font-size: 16px;
    margin-bottom: 16px;
}

.modal-input:focus {
    outline: none;
    border-color: var(--accent);
}

.btn-primary {
    background: var(--accent);
    color: #000;
    border: none;
    padding: 14px 24px;
    border-radius: 40px;
    font-weight: 600;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 8px;
    transition: all 0.3s;
}

.btn-primary:hover {
    transform: translateY(-2px);
    filter: brightness(0.95);
}

.btn-primary:disabled {
    opacity: 0.6;
    cursor: not-allowed;
}

.btn-outline {
    background: transparent;
    border: 1px solid var(--border);
    color: var(--text-primary);
    padding: 12px 20px;
    border-radius: 40px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
}

.toggle-pw {
    position: absolute;
    right: 12px;
    top: 50%;
    transform: translateY(-50%);
    background: none;
    border: none;
    cursor: pointer;
    font-size: 18px;
}

.pw-strength {
    margin-top: -8px;
    margin-bottom: 16px;
}

.pw-bar {
    height: 4px;
    background: var(--border);
    border-radius: 2px;
    overflow: hidden;
}

.pw-fill {
    width: 0%;
    height: 100%;
    transition: width 0.3s;
}

.pw-text {
    font-size: 11px;
    color: var(--text-secondary);
}

.error-message {
    background: rgba(255,68,68,0.1);
    border: 1px solid #ff4444;
    color: #ff4444;
    padding: 10px;
    border-radius: 8px;
    margin-bottom: 16px;
    font-size: 13px;
}

.success-message {
    background: rgba(0,200,83,0.1);
    border: 1px solid #00c853;
    color: #00c853;
    padding: 10px;
    border-radius: 8px;
    margin-bottom: 16px;
}

.toast-notification {
    position: fixed;
    bottom: 30px;
    right: 30px;
    background: var(--surface);
    border-left: 4px solid var(--accent);
    padding: 16px 24px;
    border-radius: 12px;
    z-index: 2000;
    animation: slideIn 0.3s ease;
}

@keyframes slideIn {
    from { transform: translateX(100%); opacity: 0; }
    to { transform: translateX(0); opacity: 1; }
}

.modal-switch {
    text-align: center;
    margin-top: 20px;
    color: var(--text-secondary);
}

.modal-switch a {
    color: var(--accent);
    text-decoration: none;
    cursor: pointer;
}
</style>

<script>
// Ambil CSRF token dari meta tag
const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

// Buka modal
function openModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }
}

// Tutup modal
function closeModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.style.display = 'none';
        document.body.style.overflow = 'auto';
    }
}

// Switch antar modal
function switchModal(modalId) {
    document.querySelectorAll('.modal-backdrop').forEach(m => m.style.display = 'none');
    openModal(modalId);
}

// Tampilkan toast
function showToast(message, isError = false) {
    const toast = document.getElementById('toast-notification');
    const toastMsg = document.getElementById('toast-message');
    toastMsg.textContent = message;
    toast.style.display = 'flex';
    toast.style.borderLeftColor = isError ? '#ff4444' : 'var(--accent)';
    setTimeout(() => {
        toast.style.display = 'none';
    }, 3000);
}

// Password Strength
function checkPasswordStrength(password) {
    const fill = document.getElementById('pw-fill');
    const text = document.getElementById('pw-text');
    if (!fill || !text) return;
    
    let strength = 0;
    if (password.length >= 8) strength++;
    if (password.match(/[a-z]/) && password.match(/[A-Z]/)) strength++;
    if (password.match(/[0-9]/)) strength++;
    if (password.match(/[^a-zA-Z0-9]/)) strength++;
    
    const width = (strength / 4) * 100;
    fill.style.width = width + '%';
    
    if (strength <= 1) {
        fill.style.background = '#ff4444';
        text.textContent = 'Weak';
    } else if (strength <= 2) {
        fill.style.background = '#ffaa00';
        text.textContent = 'Medium';
    } else {
        fill.style.background = '#00c853';
        text.textContent = 'Strong';
    }
}

// Check password match
function checkPasswordMatch() {
    const pass = document.getElementById('reg-password')?.value || '';
    const confirm = document.getElementById('reg-confirm')?.value || '';
    const msg = document.getElementById('pw-match-msg');
    if (!msg) return false;
    
    if (pass !== confirm && confirm.length > 0) {
        msg.textContent = 'Password tidak cocok';
        msg.style.color = '#ff4444';
        return false;
    } else if (pass === confirm && confirm.length > 0) {
        msg.textContent = 'Password cocok ✓';
        msg.style.color = '#00c853';
        return true;
    }
    msg.textContent = '';
    return false;
}

// Fungsi Forgot Password
function showForgotPassword() {
    closeModal('login-modal');
    openModal('forgot-modal');
}

// Event Listeners
const regPassword = document.getElementById('reg-password');
if (regPassword) {
    regPassword.addEventListener('input', (e) => {
        checkPasswordStrength(e.target.value);
    });
}

const regConfirm = document.getElementById('reg-confirm');
if (regConfirm) {
    regConfirm.addEventListener('input', () => {
        checkPasswordMatch();
    });
}

// Toggle password visibility
document.querySelectorAll('.toggle-pw').forEach(btn => {
    btn.addEventListener('mousedown', () => {
        const target = document.getElementById(btn.dataset.target);
        if (target) target.type = 'text';
    });
    btn.addEventListener('mouseup', () => {
        const target = document.getElementById(btn.dataset.target);
        if (target) target.type = 'password';
    });
    btn.addEventListener('mouseleave', () => {
        const target = document.getElementById(btn.dataset.target);
        if (target) target.type = 'password';
    });
});

// LOGIN FUNCTION
const loginBtn = document.getElementById('login-btn');
if (loginBtn) {
    loginBtn.addEventListener('click', async () => {
        const email = document.getElementById('login-email')?.value || '';
        const password = document.getElementById('login-password')?.value || '';
        const remember = document.getElementById('login-remember')?.checked || false;
        const errorDiv = document.getElementById('login-error');
        
        if (!email || !password) {
            if (errorDiv) {
                errorDiv.textContent = 'Email dan password wajib diisi';
                errorDiv.style.display = 'block';
            }
            return;
        }
        
        if (errorDiv) errorDiv.style.display = 'none';
        loginBtn.textContent = 'Loading...';
        loginBtn.disabled = true;
        
        try {
            const response = await fetch('/login', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ email, password, remember })
            });
            
            const data = await response.json();
            
            if (data.success) {
                showToast(data.message);
                setTimeout(() => {
                    window.location.href = data.redirect;
                }, 1000);
            } else {
                if (errorDiv) {
                    errorDiv.textContent = data.message || 'Login gagal';
                    errorDiv.style.display = 'block';
                }
                loginBtn.textContent = 'Sign In';
                loginBtn.disabled = false;
            }
        } catch (error) {
            console.error('Login error:', error);
            if (errorDiv) {
                errorDiv.textContent = 'Terjadi kesalahan, silakan coba lagi';
                errorDiv.style.display = 'block';
            }
            loginBtn.textContent = 'Sign In';
            loginBtn.disabled = false;
        }
    });
}

// REGISTER FUNCTION
const registerBtn = document.getElementById('register-btn');
if (registerBtn) {
    registerBtn.addEventListener('click', async () => {
        const name = document.getElementById('reg-name')?.value || '';
        const email = document.getElementById('reg-email')?.value || '';
        const password = document.getElementById('reg-password')?.value || '';
        const password_confirmation = document.getElementById('reg-confirm')?.value || '';
        const errorDiv = document.getElementById('register-error');
        const successDiv = document.getElementById('register-success');
        
        if (!name || !email || !password) {
            if (errorDiv) {
                errorDiv.textContent = 'Semua field wajib diisi';
                errorDiv.style.display = 'block';
            }
            return;
        }
        
        if (password !== password_confirmation) {
            if (errorDiv) {
                errorDiv.textContent = 'Password tidak cocok';
                errorDiv.style.display = 'block';
            }
            return;
        }
        
        if (errorDiv) errorDiv.style.display = 'none';
        if (successDiv) successDiv.style.display = 'none';
        registerBtn.textContent = 'Loading...';
        registerBtn.disabled = true;
        
        try {
            const response = await fetch('/register', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ name, email, password, password_confirmation })
            });
            
            const data = await response.json();
            
            if (data.success) {
                if (successDiv) {
                    successDiv.textContent = data.message;
                    successDiv.style.display = 'block';
                }
                showToast(data.message);
                setTimeout(() => {
                    window.location.href = data.redirect;
                }, 1500);
            } else {
                let errorMsg = '';
                if (data.errors) {
                    errorMsg = Object.values(data.errors).flat().join(', ');
                } else {
                    errorMsg = data.message || 'Registrasi gagal';
                }
                if (errorDiv) {
                    errorDiv.textContent = errorMsg;
                    errorDiv.style.display = 'block';
                }
                registerBtn.textContent = 'Create Account';
                registerBtn.disabled = false;
            }
        } catch (error) {
            console.error('Register error:', error);
            if (errorDiv) {
                errorDiv.textContent = 'Terjadi kesalahan, silakan coba lagi';
                errorDiv.style.display = 'block';
            }
            registerBtn.textContent = 'Create Account';
            registerBtn.disabled = false;
        }
    });
}

// FORGOT PASSWORD FUNCTION
const forgotBtn = document.getElementById('forgot-btn');
if (forgotBtn) {
    forgotBtn.addEventListener('click', async () => {
        const email = document.getElementById('forgot-email')?.value || '';
        const errorDiv = document.getElementById('forgot-error');
        const successDiv = document.getElementById('forgot-success');
        
        if (!email) {
            if (errorDiv) {
                errorDiv.textContent = 'Email wajib diisi';
                errorDiv.style.display = 'block';
            }
            return;
        }
        
        if (errorDiv) errorDiv.style.display = 'none';
        if (successDiv) successDiv.style.display = 'none';
        forgotBtn.textContent = 'Loading...';
        forgotBtn.disabled = true;
        
        try {
            const response = await fetch('/forgot-password', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ email })
            });
            
            const data = await response.json();
            
            if (data.success) {
                if (successDiv) {
                    successDiv.textContent = data.message;
                    successDiv.style.display = 'block';
                }
                setTimeout(() => {
                    switchModal('login-modal');
                }, 2000);
            } else {
                if (errorDiv) {
                    errorDiv.textContent = data.message;
                    errorDiv.style.display = 'block';
                }
            }
            forgotBtn.textContent = 'Kirim Link Reset';
            forgotBtn.disabled = false;
        } catch (error) {
            if (errorDiv) {
                errorDiv.textContent = 'Terjadi kesalahan, silakan coba lagi';
                errorDiv.style.display = 'block';
            }
            forgotBtn.textContent = 'Kirim Link Reset';
            forgotBtn.disabled = false;
        }
    });
}

// Google Login
const googleBtn = document.getElementById('google-login-btn');
if (googleBtn) {
    googleBtn.addEventListener('click', () => {
        window.location.href = '/auth/google';
    });
}

// Forgot password link
const forgotLink = document.getElementById('forgot-password-link');
if (forgotLink) {
    forgotLink.addEventListener('click', (e) => {
        e.preventDefault();
        showForgotPassword();
    });
}

// Close modal when clicking backdrop
document.querySelectorAll('.modal-backdrop').forEach(backdrop => {
    backdrop.addEventListener('click', (e) => {
        if (e.target === backdrop) {
            backdrop.style.display = 'none';
            document.body.style.overflow = 'auto';
        }
    });
});

// Enter key submit
const loginPassword = document.getElementById('login-password');
if (loginPassword) {
    loginPassword.addEventListener('keypress', (e) => {
        if (e.key === 'Enter') {
            const btn = document.getElementById('login-btn');
            if (btn) btn.click();
        }
    });
}
</script>