{{-- WhatsApp Modal --}}
<div class="modal-backdrop" id="wa-modal">
    <div class="modal" onclick="event.stopPropagation()">
        <button class="modal-close">&times;</button>
        <h2>Hubungi Kami</h2>
        <p>Pilih cara yang paling nyaman untuk Anda.</p>
        <div class="wa-modal-options">
            <a href="https://wa.me/6281234567890?text=Halo%20diver.ent%2C%20saya%20ingin%20jadwalkan%20online%20meeting" target="_blank" class="wa-option">
                <span class="wa-option-icon">💻</span>
                <div><h4>Online Meeting</h4><p>Senin – Jumat, 09.00 – 17.00 WIB</p></div>
            </a>
            <a href="https://wa.me/6281234567890?text=Halo%20diver.ent%2C%20saya%20ingin%20konsultasi" target="_blank" class="wa-option">
                <span class="wa-option-icon">💬</span>
                <div><h4>Chat WhatsApp</h4><p>Setiap hari, 08.00 – 21.00 WIB</p></div>
            </a>
        </div>
    </div>
</div>

{{-- Login Modal --}}
<div class="modal-backdrop" id="login-modal">
    <div class="modal" onclick="event.stopPropagation()">
        <button class="modal-close">&times;</button>
        <h2>Sign In</h2>
        <p>Masuk ke Client Area diver.ent.</p>
        <button class="btn-outline" style="width:100%;justify-content:center;margin-bottom:16px;">🔵 Sign in with Google</button>
        <div style="text-align:center;color:var(--text-secondary);font-size:.85rem;margin-bottom:16px;">atau</div>
        <input type="email" class="modal-input" id="login-email" placeholder="Email address">
        <div style="position:relative;">
            <input type="password" class="modal-input" id="login-password" placeholder="Password">
            <button type="button" class="toggle-pw" data-target="login-password" aria-label="Hold to show password">👁️</button>
        </div>
        <a href="#" style="font-size:.82rem;color:var(--accent);display:block;margin-bottom:16px;">Forgot password?</a>
        <button class="btn-primary" style="width:100%;justify-content:center;">Sign In</button>
        <div class="modal-switch">Belum punya akun? <a href="#" id="switch-to-register">Sign Up</a></div>
    </div>
</div>

{{-- Register Modal --}}
<div class="modal-backdrop" id="register-modal">
    <div class="modal" onclick="event.stopPropagation()">
        <button class="modal-close">&times;</button>
        <h2>Sign Up</h2>
        <p>Buat akun untuk akses Client Area.</p>
        <button class="btn-outline" style="width:100%;justify-content:center;margin-bottom:16px;" onclick="alert('Google OAuth akan diintegrasikan di fase berikutnya')">
            <svg width="18" height="18" viewBox="0 0 48 48" style="margin-right:8px;"><path fill="#4285F4" d="M24 9.5c3.54 0 6.71 1.22 9.21 3.6l6.85-6.85C35.9 2.38 30.47 0 24 0 14.62 0 6.51 5.38 2.56 13.22l7.98 6.19C12.43 13.72 17.74 9.5 24 9.5z"/><path fill="#34A853" d="M46.98 24.55c0-1.57-.15-3.09-.38-4.55H24v9.02h12.94c-.58 2.96-2.26 5.48-4.78 7.18l7.73 6c4.51-4.18 7.09-10.36 7.09-17.65z"/><path fill="#FBBC05" d="M10.53 28.59A14.5 14.5 0 019.5 24c0-1.59.28-3.14.76-4.59l-7.98-6.19A23.99 23.99 0 000 24c0 3.77.9 7.34 2.44 10.51l8.09-5.92z"/><path fill="#EA4335" d="M24 48c6.48 0 11.93-2.13 15.89-5.81l-7.73-6c-2.15 1.45-4.92 2.3-8.16 2.3-6.26 0-11.57-4.22-13.47-9.91l-7.98 6.19C6.51 42.62 14.62 48 24 48z"/></svg>
            Sign up with Google
        </button>
        <div style="text-align:center;color:var(--text-secondary);font-size:.85rem;margin-bottom:16px;">atau daftar dengan email</div>
        <form id="register-form" onsubmit="return handleRegister(event)">
            <input type="text" class="modal-input" id="reg-name" placeholder="Full Name" required>
            <input type="email" class="modal-input" id="reg-email" placeholder="Email address" required>
            <div style="position:relative;">
                <input type="password" class="modal-input" id="reg-password" placeholder="Password" required minlength="8" oninput="checkPasswordStrength(this.value)">
                <button type="button" class="toggle-pw" data-target="reg-password" aria-label="Hold to show password">👁️</button>
            </div>
            <div class="pw-strength" id="pw-strength">
                <div class="pw-bar"><div class="pw-fill" id="pw-fill"></div></div>
                <span class="pw-text" id="pw-text"></span>
            </div>
            <div style="position:relative;">
                <input type="password" class="modal-input" id="reg-confirm" placeholder="Konfirmasi Password" required oninput="checkPasswordMatch()">
                <button type="button" class="toggle-pw" data-target="reg-confirm" aria-label="Hold to show password">👁️</button>
            </div>
            <div class="pw-match-msg" id="pw-match-msg"></div>
            <button type="submit" class="btn-primary" id="reg-submit" style="width:100%;justify-content:center;" disabled>Create Account</button>
        </form>
        <div class="modal-switch">Sudah punya akun? <a href="#" id="switch-to-login">Sign In</a></div>
    </div>
</div>
