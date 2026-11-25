<!-- Dynamic Hover Curved Wave Sidebar Trigger (Floating Button Default -> Wave on Hover) -->
<div id="hm-curved-tab" class="fixed right-0 top-1/2 -translate-y-1/2 z-40 h-[60vh] w-24 flex items-center justify-end pointer-events-auto group cursor-pointer" title="Buka Menu Navigasi">
    <!-- SVG Curved Background Wave on Hover -->
    <svg id="hm-tab-svg" class="absolute right-0 top-0 h-full w-24 text-forest drop-shadow-2xl transition-all duration-500 ease-out opacity-0 group-hover:opacity-100 transform origin-right scale-x-75 group-hover:scale-x-100"
         viewBox="0 0 100 600" preserveAspectRatio="none">
        <path id="hm-tab-path" fill="currentColor" d="M 100 0 C 100 150, 100 200, 100 300 C 100 400, 100 450, 100 600 L 100 0 Z" />
    </svg>

    <!-- Floating Circular Icon Button (Always Visible) -->
    <button id="hm-menu-btn" type="button"
            class="relative z-50 mr-4 w-12 h-12 rounded-full bg-forest text-white shadow-2xl flex items-center justify-center border border-white/20 group-hover:scale-110 transition-all duration-300 focus:outline-none"
            aria-label="Buka menu">
        <svg id="hm-hamburger-icon" class="w-6 h-6 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 8h16M4 16h16"></path>
        </svg>
    </button>
</div>

<!-- Hello Monday / DEPT Style Fullscreen Wave Overlay & Page Transition Curtain -->
<div id="hm-menu-wrapper" class="fixed inset-0 z-50 pointer-events-none hidden overflow-hidden">
    <!-- Fullscreen Morphing SVG Background (Solid Forest Green #2F4A33) -->
    <svg id="hm-overlay-svg" class="absolute inset-0 w-full h-full pointer-events-none z-0" preserveAspectRatio="none" viewBox="0 0 1000 1000">
        <path id="hm-overlay-path" fill="#2F4A33" d="M 1000 0 Q 1000 500 1000 1000 L 1000 1000 L 1000 0 Z" />
    </svg>

    <!-- Overlay Content Layer -->
    <div id="hm-overlay-content" class="relative z-10 w-full h-full flex flex-col justify-between p-8 sm:p-14 opacity-0 pointer-events-auto">
        <!-- Top Left Brand Logo -->
        <div class="max-w-7xl mx-auto w-full flex items-center justify-between">
            <a href="{{ route('home') }}" onclick="navigateWithCurtain(event, this.href)" class="font-heading text-2xl sm:text-3xl font-extrabold tracking-tight text-white uppercase leading-none hover:text-tosca transition">
                Satu Meja
            </a>
        </div>

        <!-- Center Right Main Navigation Links (Hello Monday Stagger & Serif Layout) -->
        <div class="max-w-7xl mx-auto w-full my-auto flex justify-center sm:justify-end pr-0 sm:pr-20 md:pr-36">
            <nav aria-label="Main Fullscreen Menu" class="text-left">
                <ul class="space-y-3 sm:space-y-6 md:space-y-7">
                    <li class="hm-menu-item transform translate-y-8 opacity-0">
                        <a href="{{ route('home') }}" onclick="navigateWithCurtain(event, this.href)" class="font-heading text-4xl sm:text-6xl md:text-7xl font-bold text-white hover:text-tosca transition-colors duration-300 inline-block">
                            Beranda
                        </a>
                    </li>
                    <li class="hm-menu-item transform translate-y-8 opacity-0">
                        <a href="{{ route('donations.index') }}" onclick="navigateWithCurtain(event, this.href)" class="font-heading text-4xl sm:text-6xl md:text-7xl font-bold text-white hover:text-tosca transition-colors duration-300 inline-block">
                            Cari Donasi
                        </a>
                    </li>

                    @auth
                        <li class="hm-menu-item transform translate-y-8 opacity-0">
                            <a href="{{ route(auth()->user()->isAdmin() ? 'admin.dashboard' : (auth()->user()->isPendonasi() ? 'pendonasi.dashboard' : 'penerima.dashboard')) }}"
                               onclick="navigateWithCurtain(event, this.href)" class="font-heading text-4xl sm:text-6xl md:text-7xl font-bold text-white hover:text-tosca transition-colors duration-300 inline-block">
                                Dasbor {{ ucfirst(auth()->user()->role) }}
                            </a>
                        </li>

                        @if(auth()->user()->isPendonasi() && auth()->user()->status === 'verified')
                            <li class="hm-menu-item transform translate-y-8 opacity-0">
                                <a href="{{ route('pendonasi.donations.create') }}" onclick="navigateWithCurtain(event, this.href)" class="font-heading text-3xl sm:text-5xl md:text-6xl font-bold text-tosca hover:text-white transition-colors duration-300 inline-block">
                                    + Bagikan Pangan
                                </a>
                            </li>
                        @endif
                    @else
                        <li class="hm-menu-item transform translate-y-8 opacity-0">
                            <a href="{{ route('login') }}" onclick="navigateWithCurtain(event, this.href)" class="font-heading text-4xl sm:text-6xl md:text-7xl font-bold text-white hover:text-tosca transition-colors duration-300 inline-block">
                                Masuk Portal
                            </a>
                        </li>
                    @endauth

                    <li class="hm-menu-item transform translate-y-8 opacity-0">
                        <a href="{{ route('home') }}#tentang" onclick="closeHmMenu()" class="font-heading text-3xl sm:text-5xl md:text-6xl font-bold text-sage-200 hover:text-white transition-colors duration-300 inline-block">
                            Filosofi
                        </a>
                    </li>
                    <li class="hm-menu-item transform translate-y-8 opacity-0">
                        <a href="{{ route('home') }}#cara-kerja" onclick="closeHmMenu()" class="font-heading text-3xl sm:text-5xl md:text-6xl font-bold text-sage-200 hover:text-white transition-colors duration-300 inline-block">
                            Cara Kerja
                        </a>
                    </li>
                </ul>
            </nav>
        </div>

        <!-- Bottom Footer Info & Social Links -->
        <div class="max-w-7xl mx-auto w-full flex flex-col sm:flex-row items-center justify-between gap-4 text-xs sm:text-sm text-sage-200 border-t border-white/10 pt-6">
            <p>&copy; {{ date('Y') }} Satu Meja — Platform Berbagi Pangan Zero Hunger</p>
            <div class="flex items-center gap-6 text-white/80 font-medium">
                <a href="{{ route('home') }}#tentang" onclick="closeHmMenu()" class="hover:text-tosca transition">SDG 2 Zero Hunger</a>
                <a href="{{ route('donations.index') }}" onclick="navigateWithCurtain(event, this.href)" class="hover:text-tosca transition">Jelajah Donasi</a>
            </div>
        </div>
    </div>

    <!-- Hello Monday Curved White Right Notch with Close Button -->
    <div id="hm-close-notch" class="fixed right-0 top-1/2 -translate-y-1/2 z-30 h-44 sm:h-56 w-20 sm:w-24 flex items-center justify-end pr-3 sm:pr-4 opacity-0 pointer-events-auto">
        <!-- White Curve SVG background attached to right edge -->
        <svg class="absolute right-0 top-0 h-full w-full text-white drop-shadow-2xl pointer-events-none" viewBox="0 0 100 300" preserveAspectRatio="none">
            <path d="M 100 0 C 20 75, 20 225, 100 300 Z" fill="currentColor" />
        </svg>

        <!-- Close 'X' Button inside notch -->
        <button type="button" id="hm-close-overlay-btn"
                class="relative z-40 w-11 h-11 sm:w-12 sm:h-12 rounded-full text-forest hover:text-black hover:rotate-90 hover:scale-110 active:scale-95 transition-all duration-300 flex items-center justify-center focus:outline-none"
                aria-label="Tutup menu">
            <svg class="w-6 h-6 sm:w-7 sm:h-7 stroke-current" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        let isHmMenuOpen = false;
        let isAnimating = false;

        const curvedTabContainer = document.getElementById('hm-curved-tab');
        const tabPath = document.getElementById('hm-tab-path');
        const wrapper = document.getElementById('hm-menu-wrapper');
        const overlayPath = document.getElementById('hm-overlay-path');
        const overlayContent = document.getElementById('hm-overlay-content');
        const closeNotch = document.getElementById('hm-close-notch');
        const closeOverlayBtn = document.getElementById('hm-close-overlay-btn');
        const menuItems = document.querySelectorAll('.hm-menu-item');

        const tabFlatPath = "M 100 0 C 100 150, 100 200, 100 300 C 100 400, 100 450, 100 600 L 100 0 Z";
        const tabWavePath = "M 100 0 C 100 150, 15 200, 15 300 C 15 400, 100 450, 100 600 L 100 0 Z";

        // Tab Hover Effect (GSAP Direct Path Morphing)
        if (curvedTabContainer && tabPath) {
            curvedTabContainer.addEventListener('mouseenter', () => {
                if (!isHmMenuOpen && typeof gsap !== 'undefined') {
                    gsap.killTweensOf(tabPath);
                    gsap.to(tabPath, {
                        attr: { d: tabWavePath },
                        duration: 0.55,
                        ease: "power3.out"
                    });
                }
            });

            curvedTabContainer.addEventListener('mouseleave', () => {
                if (!isHmMenuOpen && typeof gsap !== 'undefined') {
                    gsap.killTweensOf(tabPath);
                    gsap.to(tabPath, {
                        attr: { d: tabFlatPath },
                        duration: 0.45,
                        ease: "power2.inOut"
                    });
                }
            });
        }

        // Open Hello Monday Wave Menu
        window.openHmMenu = function(callback) {
            if (isAnimating) return;
            isAnimating = true;
            isHmMenuOpen = true;

            if (wrapper) {
                wrapper.classList.remove('hidden');
                wrapper.classList.remove('pointer-events-none');
            }

            if (typeof gsap !== 'undefined' && overlayPath) {
                gsap.killTweensOf([overlayPath, overlayContent, closeNotch, menuItems]);

                const tl = gsap.timeline({
                    onComplete: () => {
                        isAnimating = false;
                        if (callback) callback();
                    }
                });

                // Step 1: Fluid Wave Morph Sweep from Right to Left
                tl.to(overlayPath, {
                    duration: 0.65,
                    ease: "power3.inOut",
                    attr: { d: "M 1000 0 Q -300 500 1000 1000 L 1000 1000 L 1000 0 Z" }
                })
                .to(overlayPath, {
                    duration: 0.45,
                    ease: "power2.out",
                    attr: { d: "M 0 0 Q 0 500 0 1000 L 1000 1000 L 1000 0 Z" }
                }, "-=0.25")

                // Step 2: Content Fade In & Menu Items Stagger Up
                .to(overlayContent, {
                    opacity: 1,
                    duration: 0.35,
                    ease: "power2.out"
                }, "-=0.5")
                .to(closeNotch, {
                    opacity: 1,
                    duration: 0.35,
                    ease: "power2.out"
                }, "-=0.4")
                .to(menuItems, {
                    opacity: 1,
                    y: 0,
                    duration: 0.5,
                    stagger: 0.07,
                    ease: "power3.out"
                }, "-=0.35");
            } else {
                if (wrapper) wrapper.classList.remove('hidden');
                isAnimating = false;
                if (callback) callback();
            }
        };

        // Close Hello Monday Wave Menu (Runs Fluid Wave Sweep Closing Animation)
        window.closeHmMenu = function(callback) {
            if (isAnimating) return;
            isAnimating = true;

            if (typeof gsap !== 'undefined' && overlayPath) {
                gsap.killTweensOf([overlayPath, overlayContent, closeNotch, menuItems]);

                const tl = gsap.timeline({
                    onComplete: () => {
                        isHmMenuOpen = false;
                        isAnimating = false;
                        if (wrapper) {
                            wrapper.classList.add('hidden');
                            wrapper.classList.add('pointer-events-none');
                        }

                        // Reset positions for next open
                        gsap.set(menuItems, { opacity: 0, y: 32 });
                        gsap.set(overlayContent, { opacity: 0 });
                        gsap.set(closeNotch, { opacity: 0 });
                        gsap.set(overlayPath, { attr: { d: "M 1000 0 Q 1000 500 1000 1000 L 1000 1000 L 1000 0 Z" } });

                        if (callback && typeof callback === 'function') callback();
                    }
                });

                // Fade out items & notch
                tl.to(closeNotch, {
                    opacity: 0,
                    duration: 0.25,
                    ease: "power2.in"
                })
                .to(menuItems, {
                    opacity: 0,
                    y: 20,
                    duration: 0.2,
                    stagger: 0.03,
                    ease: "power2.in"
                }, "-=0.2")
                .to(overlayContent, {
                    opacity: 0,
                    duration: 0.2,
                    ease: "power2.in"
                }, "-=0.1")

                // Fluid Wave Sweep back to Right
                .to(overlayPath, {
                    duration: 0.55,
                    ease: "power3.inOut",
                    attr: { d: "M 1000 0 Q 1300 500 1000 1000 L 1000 1000 L 1000 0 Z" }
                })
                .to(overlayPath, {
                    duration: 0.35,
                    ease: "power2.out",
                    attr: { d: "M 1000 0 Q 1000 500 1000 1000 L 1000 1000 L 1000 0 Z" }
                }, "-=0.15");
            } else {
                if (wrapper) wrapper.classList.add('hidden');
                isHmMenuOpen = false;
                isAnimating = false;
                if (callback && typeof callback === 'function') callback();
            }
        };

        // Navigation Handler (Runs the EXACT SAME closeHmMenu() wave closing animation before navigating!)
        window.navigateWithCurtain = function(e, url) {
            if (!url || url === '#' || url.startsWith('#')) return;

            const targetUrl = new URL(url, window.location.origin);
            if (targetUrl.origin !== window.location.origin) return; // External link

            // If same page URL
            if (targetUrl.pathname === window.location.pathname && targetUrl.search === window.location.search) {
                if (isHmMenuOpen) closeHmMenu();
                return;
            }

            e.preventDefault();

            if (isHmMenuOpen) {
                // Call closeHmMenu with callback so it executes the EXACT SAME smooth closing wave animation!
                closeHmMenu(function() {
                    window.location.href = url;
                });
            } else {
                openHmMenu(function() {
                    window.location.href = url;
                });
            }
        };

        // Event Listeners
        if (curvedTabContainer) {
            curvedTabContainer.addEventListener('click', (e) => {
                e.stopPropagation();
                if (!isHmMenuOpen) openHmMenu(); else closeHmMenu();
            });
        }

        if (closeOverlayBtn) {
            closeOverlayBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                closeHmMenu();
            });
        }

        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && isHmMenuOpen) {
                closeHmMenu();
            }
        });
    });
</script>
