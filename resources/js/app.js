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