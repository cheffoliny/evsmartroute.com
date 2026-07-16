(() => {
    'use strict';

    const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    if (reducedMotion) return;

    const parallaxItems = [...document.querySelectorAll('[data-parallax]')];
    let scheduled = false;

    const updateParallax = () => {
        const viewportHeight = window.innerHeight;
        parallaxItems.forEach((item) => {
            const rect = item.getBoundingClientRect();
            if (rect.bottom < -100 || rect.top > viewportHeight + 100) return;
            const speed = Number(item.dataset.parallax) || 0;
            const offset = (rect.top - (viewportHeight / 2)) * speed;
            item.style.setProperty('--parallax-y', `${offset.toFixed(1)}px`);
        });
        scheduled = false;
    };

    const requestParallax = () => {
        if (scheduled) return;
        scheduled = true;
        requestAnimationFrame(updateParallax);
    };

    parallaxItems.forEach((item) => item.classList.add('has-parallax'));
    updateParallax();
    window.addEventListener('scroll', requestParallax, { passive: true });
    window.addEventListener('resize', requestParallax, { passive: true });

    const batteryVisual = document.querySelector('[data-battery-visual]');
    if (!batteryVisual || !('IntersectionObserver' in window)) return;

    const fill = batteryVisual.querySelector('[data-battery-fill]');
    const output = batteryVisual.querySelector('[data-soc-output]');
    const batteryObserver = new IntersectionObserver((entries) => {
        if (!entries.some((entry) => entry.isIntersecting)) return;
        let value = 100;
        const target = 78;
        const timer = window.setInterval(() => {
            value -= 1;
            output.textContent = `${value}%`;
            fill.style.width = `calc(${value}% - 14px)`;
            if (value <= target) window.clearInterval(timer);
        }, 28);
        batteryObserver.disconnect();
    }, { threshold: 0.45 });
    batteryObserver.observe(batteryVisual);
})();

