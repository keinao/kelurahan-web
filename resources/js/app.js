import './bootstrap';
import '@fontsource-variable/cormorant-garamond/wght.css';
import '@fontsource-variable/inter/wght.css';
import * as bootstrap from 'bootstrap';

window.bootstrap = bootstrap;
document.documentElement.classList.add('js');
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