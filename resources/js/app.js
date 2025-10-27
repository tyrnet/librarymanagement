import './bootstrap';

// Theme toggle with persistence
document.addEventListener('DOMContentLoaded', () => {
    const body = document.body;
    const THEME_KEY = 'lm-theme';
    const prefersDark = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
    const saved = localStorage.getItem(THEME_KEY);
    const isDark = saved ? saved === 'dark' : prefersDark;

    function applyTheme(dark) {
        body.classList.toggle('dark', dark);
        const btn = document.getElementById('theme-toggle');
        if (btn) {
            btn.innerHTML = dark ? '<i class="fas fa-sun"></i>' : '<i class="fas fa-moon"></i>';
        }
    }

    applyTheme(isDark);

    const toggle = document.getElementById('theme-toggle');
    if (toggle) {
        toggle.addEventListener('click', () => {
            const next = !document.body.classList.contains('dark');
            applyTheme(next);
            localStorage.setItem(THEME_KEY, next ? 'dark' : 'light');
        });
    }

    // Reveal on scroll for cards
    const revealElements = Array.from(document.querySelectorAll('.reveal'));
    if ('IntersectionObserver' in window && revealElements.length) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('revealed');
                    observer.unobserve(entry.target);
                }
            });
        }, { rootMargin: '0px 0px -10% 0px', threshold: 0.1 });

        revealElements.forEach(el => observer.observe(el));
    } else {
        revealElements.forEach(el => el.classList.add('revealed'));
    }
});
