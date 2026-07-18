<?php declare(strict_types=1); ?>
<section class="cookie-banner" id="cookieConsentBanner" role="dialog" aria-modal="false" aria-labelledby="cookieConsentTitle" hidden>
    <div class="cookie-banner__icon" aria-hidden="true">
        <svg viewBox="0 0 24 24"><path d="M20.5 13.2A8.5 8.5 0 1 1 10.8 3.5a4.2 4.2 0 0 0 4.9 4.9 4.2 4.2 0 0 0 4.8 4.8Z"/><circle cx="8.5" cy="11" r="1"/><circle cx="12" cy="16" r="1"/><circle cx="7.5" cy="17" r=".8"/></svg>
    </div>
    <div class="cookie-banner__copy">
        <span class="cookie-banner__eyebrow">EVSmartRoute</span>
        <h2 id="cookieConsentTitle"><?= e(t('cookie_consent.title')) ?></h2>
        <p><?= e(t('cookie_consent.description')) ?> <a href="<?= e(localized_url('cookies')) ?>"><?= e(t('cookie_consent.policy_link')) ?></a></p>
    </div>
    <div class="cookie-banner__actions">
        <button class="cookie-button cookie-button--ghost" type="button" data-cookie-action="settings"><?= e(t('cookie_consent.settings')) ?></button>
        <button class="cookie-button cookie-button--secondary" type="button" data-cookie-action="necessary"><?= e(t('cookie_consent.necessary_only')) ?></button>
        <button class="cookie-button cookie-button--primary" type="button" data-cookie-action="accept-all"><?= e(t('cookie_consent.accept_all')) ?></button>
    </div>
</section>

<div class="cookie-modal" id="cookieConsentModal" aria-hidden="true" hidden>
    <button class="cookie-modal__backdrop" type="button" tabindex="-1" data-cookie-action="close-settings" aria-label="<?= e(t('cookie_consent.close')) ?>"></button>
    <section class="cookie-modal__dialog" role="dialog" aria-modal="true" aria-labelledby="cookieSettingsTitle" aria-describedby="cookieSettingsIntro">
        <header class="cookie-modal__header">
            <div><span>EVSmartRoute</span><h2 id="cookieSettingsTitle"><?= e(t('cookie_consent.settings_title')) ?></h2></div>
            <button class="cookie-modal__close" type="button" data-cookie-action="close-settings" aria-label="<?= e(t('cookie_consent.close')) ?>">&times;</button>
        </header>
        <div class="cookie-modal__body">
            <p class="cookie-modal__intro" id="cookieSettingsIntro"><?= e(t('cookie_consent.settings_intro')) ?></p>

            <div class="cookie-category">
                <div><h3><?= e(t('cookie_consent.necessary_title')) ?></h3><p><?= e(t('cookie_consent.necessary_text')) ?></p></div>
                <span class="cookie-category__required"><?= e(t('cookie_consent.always_active')) ?></span>
            </div>

            <label class="cookie-category" for="cookiePreferences">
                <div><h3><?= e(t('cookie_consent.preferences_title')) ?></h3><p><?= e(t('cookie_consent.preferences_text')) ?></p></div>
                <span class="cookie-switch"><input id="cookiePreferences" type="checkbox" data-cookie-category="preferences"><span aria-hidden="true"></span></span>
            </label>

            <label class="cookie-category" for="cookieAnalytics">
                <div><h3><?= e(t('cookie_consent.analytics_title')) ?></h3><p><?= e(t('cookie_consent.analytics_text')) ?></p></div>
                <span class="cookie-switch"><input id="cookieAnalytics" type="checkbox" data-cookie-category="analytics"><span aria-hidden="true"></span></span>
            </label>
        </div>
        <footer class="cookie-modal__footer">
            <button class="cookie-button cookie-button--secondary" type="button" data-cookie-action="necessary"><?= e(t('cookie_consent.reject_optional')) ?></button>
            <button class="cookie-button cookie-button--primary" type="button" data-cookie-action="save"><?= e(t('cookie_consent.save')) ?></button>
        </footer>
    </section>
</div>
