import './bootstrap';
import '@fontsource-variable/cormorant-garamond/wght.css';
import '@fontsource-variable/inter/wght.css';
import * as bootstrap from 'bootstrap';

window.bootstrap = bootstrap;
document.documentElement.classList.add('js');
const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

const siteNavs = document.querySelectorAll('.kn-site-nav');
let previousNavScrollY = window.scrollY;
window.addEventListener('scroll', () => {
    const currentScrollY = window.scrollY;
    const scrollingUp = currentScrollY < previousNavScrollY;
    const scrollingDown = currentScrollY > previousNavScrollY;

    siteNavs.forEach((nav) => {
        if (currentScrollY <= 60 || scrollingUp) nav.classList.remove('is-scroll-hidden');
        else if (scrollingDown) nav.classList.add('is-scroll-hidden');
    });
    previousNavScrollY = currentScrollY;
}, { passive: true });

const homeNav = document.querySelector('.kn-site-nav--home');
if (homeNav) {
    const updateHomeNav = () => homeNav.classList.toggle('is-scrolled', window.scrollY > 60);
    updateHomeNav();
    window.addEventListener('scroll', updateHomeNav, { passive: true });
}

const homeStats = document.querySelector('[data-home-stats]');
if (homeStats) {
    let statsRevealed = false;
    let statsObserver;
    const revealHomeStats = () => {
        if (statsRevealed || window.scrollY <= 40 || homeStats.getBoundingClientRect().top >= window.innerHeight) return;
        statsRevealed = true;
        homeStats.classList.add('is-visible');
        statsObserver?.disconnect();
        window.removeEventListener('scroll', revealHomeStats);
        window.removeEventListener('resize', revealHomeStats);
    };

    if ('IntersectionObserver' in window && !reduceMotion) {
        statsObserver = new IntersectionObserver((entries) => {
            if (entries.some((entry) => entry.isIntersecting)) revealHomeStats();
        }, { threshold: 0.12 });
        statsObserver.observe(homeStats);
    }
    window.addEventListener('scroll', revealHomeStats, { passive: true });
    window.addEventListener('resize', revealHomeStats);
    revealHomeStats();
}
const revealElements = document.querySelectorAll('[data-reveal]');

if ('IntersectionObserver' in window && !reduceMotion) {
    const revealObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-visible');
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.12 });
    revealElements.forEach((element) => revealObserver.observe(element));
} else {
    revealElements.forEach((element) => element.classList.add('is-visible'));
}
// Count up homepage highlights when they enter the viewport; leave final values for reduced motion.
const counters = document.querySelectorAll('[data-countup]');
if (counters.length) {
    const finishCounter = (element) => {
        const value = Number(element.dataset.countup);
        const decimals = Number(element.dataset.countupDecimals || 0);
        const prefix = element.dataset.countupPrefix || ''; const suffix = element.dataset.countupSuffix || '';
        element.textContent = prefix + new Intl.NumberFormat('id-ID', {
            minimumFractionDigits: decimals,
            maximumFractionDigits: decimals,
        }).format(value) + suffix;
    };

    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches || !('IntersectionObserver' in window)) {
        counters.forEach(finishCounter);
    } else {
        const counterObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach((entry) => {
                if (!entry.isIntersecting) return;
                const element = entry.target;
                const end = Number(element.dataset.countup);
                const decimals = Number(element.dataset.countupDecimals || 0);
                const prefix = element.dataset.countupPrefix || ''; const suffix = element.dataset.countupSuffix || '';
                const duration = 1400;
                let startTime;

                const tick = (time) => {
                    startTime ??= time;
                    const progress = Math.min((time - startTime) / duration, 1);
                    const eased = 1 - ((1 - progress) ** 3);
                    const current = end * eased;
                    element.textContent = prefix + new Intl.NumberFormat('id-ID', {
                        minimumFractionDigits: decimals,
                        maximumFractionDigits: decimals,
                    }).format(progress === 1 ? end : current) + suffix;

                    if (progress < 1) requestAnimationFrame(tick);
                };

                const homeStatIndex = Number(element.closest('[data-home-stat]')?.dataset.homeStat || 0);
                window.setTimeout(() => requestAnimationFrame(tick), homeStatIndex * 450);
                observer.unobserve(element);
            });
        }, { threshold: 0.7 });

        counters.forEach((element) => counterObserver.observe(element));
    }
}