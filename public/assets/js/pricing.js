(() => {
    'use strict';
    const root = document.querySelector('[data-billing-switch]');
    const card = document.querySelector('[data-premium-card]');
    if (!root || !card) return;

    const translationsNode = document.getElementById('pricingTranslations');
    const translations = translationsNode ? JSON.parse(translationsNode.textContent) : {};
    const buttons = [...root.querySelectorAll('[data-billing]')];
    const price = card.querySelector('[data-price]');
    const period = card.querySelector('[data-period]');
    const description = card.querySelector('[data-price-description]');
    const cta = card.querySelector('[data-premium-cta]');

    const setBilling = (billing) => {
        const yearly = billing === 'yearly';
        buttons.forEach((button) => {
            const active = button.dataset.billing === billing;
            button.classList.toggle('is-active', active);
            button.setAttribute('aria-pressed', String(active));
        });
        price.classList.add('is-changing');
        window.setTimeout(() => {
            price.textContent = yearly ? translations.yearlyPrice : translations.monthlyPrice;
            period.textContent = yearly ? translations.perYear : translations.perMonth;
            description.textContent = yearly ? translations.yearlyDescription : translations.monthlyDescription;
            cta.href = yearly ? cta.dataset.yearlyUrl : cta.dataset.monthlyUrl;
            price.classList.remove('is-changing');
        }, 140);
    };

    buttons.forEach((button) => button.addEventListener('click', () => setBilling(button.dataset.billing)));
})();
