{{-- Footer --}}
<footer class="footer" id="footer">
    <div class="container">
        <div class="footer-grid">
            <div class="footer-about">
                <h4>diver.ent</h4>
                <p>Digital marketing agency terpercaya di Medan. Kami membantu bisnis tumbuh melalui strategi digital yang terukur dan kreatif sejak 2019.</p>
                <div class="footer-badges">
                    <span class="footer-badge">Google Ads Certified</span>
                    <span class="footer-badge">Meta Certified</span>
                    <span class="footer-badge">PSE Kominfo</span>
                    <span class="footer-badge">TikTok Partner</span>
                </div>
            </div>
            <div>
                <h4>Company</h4>
                <a href="/#about">About Us</a>
                <a href="/#why-us">How It Works</a>
                <a href="{{ route('portfolio') }}">Portfolio</a>
                <a href="#">Careers</a>
                <a href="#">Blog</a>
            </div>
            <div>
                <h4>Top Services</h4>
                <a href="{{ route('service.smm') }}">Social Media Management</a>
                <a href="{{ route('service.dc') }}">Digital Ads</a>
                <a href="/#services">Website Development</a>
                <a href="/#services">SEO Optimization</a>
                <a href="/#services">Branding & Design</a>
            </div>
            <div>
                <h4>Contact</h4>
                <a href="https://wa.me/6281234567890" target="_blank"> +62 812-3456-7890</a>
                <a href="mailto:hello@diverent.co.id">hello@diverent.co.id</a>
                <p style="margin-top:8px;"> Medan, Sumatera Utara, Indonesia</p>
            </div>
        </div>
        <div class="footer-bottom">
            <span>© {{ date('Y') }} diver.ent. All rights reserved.</span>
            <div class="social-links">
                <a href="#" aria-label="Instagram">IG</a>
                <a href="#" aria-label="Facebook">FB</a>
                <a href="#" aria-label="YouTube">YT</a>
                <a href="#" aria-label="LinkedIn">LI</a>
            </div>
        </div>
    </div>
</footer>

