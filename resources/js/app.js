import './bootstrap';
import '@fontsource-variable/cormorant-garamond/wght.css';
import '@fontsource-variable/inter/wght.css';
import * as bootstrap from 'bootstrap';

window.bootstrap = bootstrap;
document.documentElement.classList.add('js');
const homeNav = document.querySelector('.kn-site-nav--home');

if (homeNav) {
    const updateHomeNav = () => homeNav.classList.toggle('is-scrolled', window.scrollY > 60);
    updateHomeNav();
    window.addEventListener('scroll', updateHomeNav, { passive: true });
}

const revealElements = document.querySelectorAll('[data-reveal]');
const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

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
const counters = Array.from(document.querySelectorAll('[data-countup]'))
    .filter((element) => !element.closest('.kn-home-stats'));
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
                const duration = 1050;
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

                requestAnimationFrame(tick);
                observer.unobserve(element);
            });
        }, { threshold: 0.7 });

        counters.forEach((element) => counterObserver.observe(element));
    }
}

const homeStatCards = Array.from(document.querySelectorAll('[data-home-stat]'));
if (homeStatCards.length) {
    const homeStatsGrid = document.querySelector('.kn-home-stats__grid');
    const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    const formatNumber = (number, decimals) => new Intl.NumberFormat('id-ID', {
        minimumFractionDigits: decimals,
        maximumFractionDigits: decimals,
    }).format(number);
    const statParts = (card) => {
        const value = card.querySelector('[data-countup]');
        return {
            value,
            end: Number(value.dataset.countup),
            decimals: Number(value.dataset.countupDecimals || 0),
            prefix: value.dataset.countupPrefix || '',
            suffix: value.dataset.countupSuffix || '',
        };
    };
    const showFinalStat = (card) => {
        const { value, end, decimals, prefix, suffix } = statParts(card);
        value.textContent = `${prefix}${formatNumber(end, decimals)}${suffix}`;
        card.classList.add('is-visible');
    };

    if (reducedMotion) {
        homeStatCards.forEach(showFinalStat);
    } else {
        const startedCards = new Set();
        const animateStat = (card) => {
            if (startedCards.has(card)) return;
            startedCards.add(card);
            const index = homeStatCards.indexOf(card);

            window.setTimeout(() => {
                const { value, end, decimals, prefix, suffix } = statParts(card);
                const duration = 1400;
                let startTime;
                card.classList.add('is-visible');
                value.textContent = `${prefix}${formatNumber(0, decimals)}${suffix}`;

                const tick = (time) => {
                    startTime ??= time;
                    const progress = Math.min((time - startTime) / duration, 1);
                    const eased = 1 - ((1 - progress) ** 3);
                    value.textContent = `${prefix}${formatNumber(progress === 1 ? end : end * eased, decimals)}${suffix}`;
                    if (progress < 1) requestAnimationFrame(tick);
                };

                requestAnimationFrame(tick);
            }, index * 450);
        };

        const revealEligibleStats = () => {
            if (window.scrollY <= 40) return;
            if (homeStatsGrid && homeStatCards.some((card) => card.dataset.inViewport === 'true')) {
                homeStatsGrid.classList.add('is-visible');
            }
            homeStatCards.forEach((card) => {
                if (card.dataset.inViewport === 'true') animateStat(card);
            });
        };

        if ('IntersectionObserver' in window) {
            const statsObserver = new IntersectionObserver((entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) entry.target.dataset.inViewport = 'true';
                });
                revealEligibleStats();
            }, { threshold: 0.2 });
            homeStatCards.forEach((card) => statsObserver.observe(card));
        } else {
            const checkStatVisibility = () => {
                if (window.scrollY <= 40) return;
                homeStatCards.forEach((card) => {
                    const bounds = card.getBoundingClientRect();
                    if (bounds.top < window.innerHeight && bounds.bottom > 0) card.dataset.inViewport = 'true';
                });
                revealEligibleStats();
            };
            window.addEventListener('scroll', checkStatVisibility, { passive: true });
            checkStatVisibility();
        }

        window.addEventListener('scroll', revealEligibleStats, { passive: true });
    }
}
