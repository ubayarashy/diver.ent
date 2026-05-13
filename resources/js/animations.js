/**
 * Diver Entertainment - Animations.js
 * Cinematic animations, scroll effects, and interactive experiences
 */

// ============================================
// WAIT FOR DOM TO LOAD
// ============================================
document.addEventListener('DOMContentLoaded', () => {
    initAllAnimations();
});

// ============================================
// INITIALIZE ALL ANIMATIONS
// ============================================
function initAllAnimations() {
    initScrollReveal();
    initParallaxEffects();
    initMagneticButtons();
    initGrayscaleHover();
    initCinematicImageTransition();
    initTextReveal();
    initCursorFollower();
    initNumberCounter();
    initSplitTextAnimation();
    initFloatingBlurEffect();
    initSmoothScroll();
    initLenisScroll();
    initHorizontalScroll();
    initVideoBackground();
    initLoadingTransition();
    initHoverGlowEffect();
    initTypewriterEffect();
}

// ============================================
// 1. SCROLL REVEAL ANIMATION
// ============================================
function initScrollReveal() {
    const revealElements = document.querySelectorAll('.reveal, .reveal-left, .reveal-right, .reveal-up, .reveal-scale');
    
    const revealOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const revealObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                // Add animation class
                entry.target.classList.add('animated');
                
                // Add specific animation based on class
                if (entry.target.classList.contains('reveal-left')) {
                    entry.target.style.animation = 'slideInLeft 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94) forwards';
                } else if (entry.target.classList.contains('reveal-right')) {
                    entry.target.style.animation = 'slideInRight 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94) forwards';
                } else if (entry.target.classList.contains('reveal-up')) {
                    entry.target.style.animation = 'slideInUp 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94) forwards';
                } else if (entry.target.classList.contains('reveal-scale')) {
                    entry.target.style.animation = 'scaleIn 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94) forwards';
                } else {
                    entry.target.style.animation = 'fadeInUp 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94) forwards';
                }
                
                // Unobserve after animation
                revealObserver.unobserve(entry.target);
            }
        });
    }, revealOptions);
    
    revealElements.forEach(el => revealObserver.observe(el));
}

// ============================================
// 2. PARALLAX EFFECTS
// ============================================
function initParallaxEffects() {
    const parallaxElements = document.querySelectorAll('[data-parallax], .parallax');
    
    window.addEventListener('scroll', () => {
        const scrolled = window.pageYOffset;
        
        parallaxElements.forEach(el => {
            const speed = el.dataset.speed || 0.5;
            const direction = el.dataset.direction || 'up';
            const offset = scrolled * speed;
            
            if (direction === 'up') {
                el.style.transform = `translateY(${offset}px)`;
            } else if (direction === 'down') {
                el.style.transform = `translateY(-${offset}px)`;
            } else if (direction === 'left') {
                el.style.transform = `translateX(${offset}px)`;
            } else if (direction === 'right') {
                el.style.transform = `translateX(-${offset}px)`;
            }
        });
    });
}

// ============================================
// 3. MAGNETIC BUTTON EFFECT
// ============================================
function initMagneticButtons() {
    const magneticBtns = document.querySelectorAll('.magnetic-btn, [data-magnetic]');
    
    magneticBtns.forEach(btn => {
        btn.addEventListener('mousemove', (e) => {
            const rect = btn.getBoundingClientRect();
            const x = e.clientX - rect.left - rect.width / 2;
            const y = e.clientY - rect.top - rect.height / 2;
            
            // Magnetic effect with smooth transition
            btn.style.transform = `translate(${x * 0.3}px, ${y * 0.3}px)`;
            
            // Add intensity effect
            const intensity = Math.sqrt(x * x + y * y) / 100;
            btn.style.transition = 'transform 0.05s linear';
        });
        
        btn.addEventListener('mouseleave', () => {
            btn.style.transform = 'translate(0, 0)';
            btn.style.transition = 'transform 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94)';
        });
    });
}

// ============================================
// 4. GRAYSCALE HOVER EFFECT
// ============================================
function initGrayscaleHover() {
    const grayscaleElements = document.querySelectorAll('.grayscale-hover');
    
    grayscaleElements.forEach(el => {
        el.addEventListener('mouseenter', () => {
            el.style.filter = 'grayscale(0%)';
            el.style.transition = 'all 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94)';
        });
        
        el.addEventListener('mouseleave', () => {
            el.style.filter = 'grayscale(100%)';
        });
    });
}

// ============================================
// 5. CINEMATIC IMAGE TRANSITION
// ============================================
function initCinematicImageTransition() {
    const cinematicImages = document.querySelectorAll('.cinematic-img, [data-cinematic]');
    
    cinematicImages.forEach(img => {
        const container = img.parentElement;
        
        img.addEventListener('mouseenter', () => {
            img.style.transform = 'scale(1.08)';
            img.style.filter = 'brightness(1.1) contrast(1.05)';
            
            // Add overlay effect
            if (container && !container.querySelector('.cinematic-overlay')) {
                const overlay = document.createElement('div');
                overlay.className = 'cinematic-overlay';
                overlay.style.cssText = `
                    position: absolute;
                    inset: 0;
                    background: linear-gradient(135deg, rgba(255,255,255,0.1) 0%, rgba(0,0,0,0.3) 100%);
                    opacity: 0;
                    transition: opacity 0.5s ease;
                    pointer-events: none;
                    z-index: 1;
                `;
                container.style.position = 'relative';
                container.style.overflow = 'hidden';
                container.appendChild(overlay);
            }
            
            const overlayElem = container.querySelector('.cinematic-overlay');
            if (overlayElem) overlayElem.style.opacity = '1';
        });
        
        img.addEventListener('mouseleave', () => {
            img.style.transform = 'scale(1)';
            img.style.filter = 'brightness(1) contrast(1)';
            
            const overlayElem = container?.querySelector('.cinematic-overlay');
            if (overlayElem) overlayElem.style.opacity = '0';
        });
    });
}

// ============================================
// 6. TEXT REVEAL ANIMATION
// ============================================
function initTextReveal() {
    const textElements = document.querySelectorAll('[data-text-reveal], .animated-text');
    
    textElements.forEach(el => {
        const text = el.innerText;
        const words = text.split(' ');
        
        el.innerHTML = words.map(word => `
            <span class="word-reveal" style="display: inline-block; overflow: hidden;">
                <span style="display: inline-block; transform: translateY(100%); transition: transform 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94);">${word}</span>
            </span>
        `).join(' ');
        
        // Animate when visible
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.querySelectorAll('.word-reveal span').forEach((span, i) => {
                        setTimeout(() => {
                            span.style.transform = 'translateY(0)';
                        }, i * 50);
                    });
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.5 });
        
        observer.observe(el);
    });
}

// ============================================
// 7. CUSTOM CURSOR FOLLOWER
// ============================================
function initCursorFollower() {
    const cursor = document.createElement('div');
    cursor.className = 'custom-cursor';
    cursor.style.cssText = `
        position: fixed;
        width: 30px;
        height: 30px;
        border: 2px solid white;
        border-radius: 50%;
        pointer-events: none;
        z-index: 9999;
        transition: transform 0.1s ease, width 0.2s, height 0.2s, background 0.2s;
        transform: translate(-50%, -50%);
        opacity: 0;
        mix-blend-mode: difference;
    `;
    document.body.appendChild(cursor);
    
    let mouseX = 0, mouseY = 0;
    let cursorX = 0, cursorY = 0;
    
    document.addEventListener('mousemove', (e) => {
        mouseX = e.clientX;
        mouseY = e.clientY;
        
        if (cursor.style.opacity === '0') {
            cursor.style.opacity = '1';
        }
    });
    
    function animateCursor() {
        cursorX += (mouseX - cursorX) * 0.1;
        cursorY += (mouseY - cursorY) * 0.1;
        cursor.style.left = cursorX + 'px';
        cursor.style.top = cursorY + 'px';
        requestAnimationFrame(animateCursor);
    }
    animateCursor();
    
    // Hover effect on interactive elements
    const interactiveElements = document.querySelectorAll('a, button, .magnetic-btn, .project-card');
    interactiveElements.forEach(el => {
        el.addEventListener('mouseenter', () => {
            cursor.style.width = '50px';
            cursor.style.height = '50px';
            cursor.style.background = 'rgba(255,255,255,0.1)';
            cursor.style.backdropFilter = 'blur(4px)';
        });
        el.addEventListener('mouseleave', () => {
            cursor.style.width = '30px';
            cursor.style.height = '30px';
            cursor.style.background = 'transparent';
            cursor.style.backdropFilter = 'none';
        });
    });
}

// ============================================
// 8. NUMBER COUNTER ANIMATION
// ============================================
function initNumberCounter() {
    const counters = document.querySelectorAll('[data-counter]');
    
    const animateNumber = (el) => {
        const target = parseInt(el.dataset.target || el.innerText);
        const duration = parseInt(el.dataset.duration) || 2000;
        const step = target / (duration / 16);
        let current = 0;
        
        const updateCounter = () => {
            current += step;
            if (current < target) {
                el.innerText = Math.floor(current).toLocaleString();
                requestAnimationFrame(updateCounter);
            } else {
                el.innerText = target.toLocaleString();
            }
        };
        updateCounter();
    };
    
    const counterObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                animateNumber(entry.target);
                counterObserver.unobserve(entry.target);
            }
        });
    }, { threshold: 0.5 });
    
    counters.forEach(counter => counterObserver.observe(counter));
}

// ============================================
// 9. SPLIT TEXT ANIMATION
// ============================================
function initSplitTextAnimation() {
    const splitTexts = document.querySelectorAll('[data-split-text]');
    
    splitTexts.forEach(el => {
        const text = el.innerText;
        const chars = text.split('');
        
        el.innerHTML = chars.map(char => `
            <span class="split-char" style="display: inline-block; opacity: 0; transform: translateY(30px); transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);">${char === ' ' ? '&nbsp;' : char}</span>
        `).join('');
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.querySelectorAll('.split-char').forEach((char, i) => {
                        setTimeout(() => {
                            char.style.opacity = '1';
                            char.style.transform = 'translateY(0)';
                        }, i * 30);
                    });
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.5 });
        
        observer.observe(el);
    });
}

// ============================================
// 10. FLOATING BLUR EFFECT
// ============================================
function initFloatingBlurEffect() {
    const blurs = document.querySelectorAll('.floating-blur');
    
    blurs.forEach(blur => {
        let x = 0, y = 0;
        let targetX = 0, targetY = 0;
        
        document.addEventListener('mousemove', (e) => {
            targetX = (e.clientX / window.innerWidth - 0.5) * 100;
            targetY = (e.clientY / window.innerHeight - 0.5) * 100;
        });
        
        function animateBlur() {
            x += (targetX - x) * 0.05;
            y += (targetY - y) * 0.05;
            blur.style.transform = `translate(${x}px, ${y}px)`;
            requestAnimationFrame(animateBlur);
        }
        animateBlur();
    });
}

// ============================================
// 11. SMOOTH SCROLL (LENIS)
// ============================================
function initLenisScroll() {
    // Check if Lenis is available (will load from CDN)
    if (typeof Lenis !== 'undefined') {
        const lenis = new Lenis({
            duration: 1.2,
            easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)),
            orientation: 'vertical',
            gestureOrientation: 'vertical',
            smoothWheel: true,
            smoothTouch: false,
            touchMultiplier: 2,
        });
        
        function raf(time) {
            lenis.raf(time);
            requestAnimationFrame(raf);
        }
        requestAnimationFrame(raf);
    }
}

// ============================================
// 12. SMOOTH SCROLL FOR ANCHOR LINKS
// ============================================
function initSmoothScroll() {
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
}

// ============================================
// 13. HORIZONTAL SCROLL (for showcase)
// ============================================
function initHorizontalScroll() {
    const horizontalScrollers = document.querySelectorAll('.horizontal-scroll');
    
    horizontalScrollers.forEach(scroller => {
        let isDown = false;
        let startX;
        let scrollLeft;
        
        scroller.addEventListener('mousedown', (e) => {
            isDown = true;
            startX = e.pageX - scroller.offsetLeft;
            scrollLeft = scroller.scrollLeft;
            scroller.style.cursor = 'grabbing';
        });
        
        scroller.addEventListener('mouseleave', () => {
            isDown = false;
            scroller.style.cursor = 'grab';
        });
        
        scroller.addEventListener('mouseup', () => {
            isDown = false;
            scroller.style.cursor = 'grab';
        });
        
        scroller.addEventListener('mousemove', (e) => {
            if (!isDown) return;
            e.preventDefault();
            const x = e.pageX - scroller.offsetLeft;
            const walk = (x - startX) * 2;
            scroller.scrollLeft = scrollLeft - walk;
        });
        
        // Wheel scroll for horizontal
        scroller.addEventListener('wheel', (e) => {
            e.preventDefault();
            scroller.scrollLeft += e.deltaY;
        });
    });
}

// ============================================
// 14. VIDEO BACKGROUND ANIMATION
// ============================================
function initVideoBackground() {
    const videos = document.querySelectorAll('video[data-autoplay]');
    
    videos.forEach(video => {
        video.play().catch(e => console.log('Video autoplay failed:', e));
        
        // Parallax effect on video
        window.addEventListener('scroll', () => {
            const scrolled = window.pageYOffset;
            const speed = video.dataset.speed || 0.3;
            video.style.transform = `translateY(${scrolled * speed}px)`;
        });
    });
}

// ============================================
// 15. LOADING TRANSITION
// ============================================
function initLoadingTransition() {
    const loadingScreen = document.querySelector('.loading-screen');
    
    if (loadingScreen) {
        // Fade out loading screen
        setTimeout(() => {
            loadingScreen.style.opacity = '0';
            setTimeout(() => {
                loadingScreen.style.display = 'none';
            }, 1000);
        }, 1500);
    }
    
    // Page transition on link clicks
    document.querySelectorAll('a:not([target="_blank"]):not([href^="#"]):not([href^="mailto"])').forEach(link => {
        link.addEventListener('click', (e) => {
            const href = link.getAttribute('href');
            if (href && href !== '#' && !href.startsWith('javascript')) {
                e.preventDefault();
                
                // Show loading screen
                if (loadingScreen) {
                    loadingScreen.style.display = 'flex';
                    loadingScreen.style.opacity = '1';
                }
                
                setTimeout(() => {
                    window.location.href = href;
                }, 500);
            }
        });
    });
}

// ============================================
// 16. HOVER GLOW EFFECT
// ============================================
function initHoverGlowEffect() {
    const glowElements = document.querySelectorAll('[data-glow], .glow-hover');
    
    glowElements.forEach(el => {
        el.addEventListener('mousemove', (e) => {
            const rect = el.getBoundingClientRect();
            const x = ((e.clientX - rect.left) / rect.width) * 100;
            const y = ((e.clientY - rect.top) / rect.height) * 100;
            
            el.style.background = `radial-gradient(circle at ${x}% ${y}%, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0) 50%)`;
        });
        
        el.addEventListener('mouseleave', () => {
            el.style.background = 'none';
        });
    });
}

// ============================================
// 17. TYPEWRITER EFFECT
// ============================================
function initTypewriterEffect() {
    const typewriters = document.querySelectorAll('[data-typewriter]');
    
    typewriters.forEach(async (el) => {
        const texts = el.dataset.typewriter.split(',');
        let textIndex = 0;
        let charIndex = 0;
        let isDeleting = false;
        
        const type = () => {
            const currentText = texts[textIndex];
            if (isDeleting) {
                el.textContent = currentText.substring(0, charIndex - 1);
                charIndex--;
            } else {
                el.textContent = currentText.substring(0, charIndex + 1);
                charIndex++;
            }
            
            if (!isDeleting && charIndex === currentText.length) {
                isDeleting = true;
                setTimeout(type, 2000);
                return;
            }
            
            if (isDeleting && charIndex === 0) {
                isDeleting = false;
                textIndex = (textIndex + 1) % texts.length;
                setTimeout(type, 500);
                return;
            }
            
            const speed = isDeleting ? 50 : 100;
            setTimeout(type, speed);
        };
        
        type();
    });
}

// ============================================
// ADD CSS ANIMATIONS TO DOCUMENT
// ============================================
const styleSheet = document.createElement('style');
styleSheet.textContent = `
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    @keyframes slideInLeft {
        from {
            opacity: 0;
            transform: translateX(-50px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }
    
    @keyframes slideInRight {
        from {
            opacity: 0;
            transform: translateX(50px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }
    
    @keyframes slideInUp {
        from {
            opacity: 0;
            transform: translateY(50px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    @keyframes scaleIn {
        from {
            opacity: 0;
            transform: scale(0.9);
        }
        to {
            opacity: 1;
            transform: scale(1);
        }
    }
    
    .reveal, .reveal-left, .reveal-right, .reveal-up, .reveal-scale {
        opacity: 0;
    }
    
    /* Page transition */
    .loading-screen {
        transition: opacity 0.5s ease, visibility 0.5s ease;
    }
    
    /* Smooth hover transitions */
    .project-card, .team-card, .creator-card {
        transition: transform 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94), box-shadow 0.3s ease;
    }
    
    .project-card:hover, .team-card:hover, .creator-card:hover {
        transform: translateY(-10px);
    }
    
    /* Image zoom effect on scroll */
    .parallax-image {
        transition: transform 0.3s ease-out;
    }
`;
document.head.appendChild(styleSheet);

// ============================================
// EXPORT FOR MODULE USE
// ============================================
if (typeof module !== 'undefined' && module.exports) {
    module.exports = {
        initAllAnimations,
        initScrollReveal,
        initParallaxEffects,
        initMagneticButtons,
        initGrayscaleHover,
        initCinematicImageTransition
    };
}