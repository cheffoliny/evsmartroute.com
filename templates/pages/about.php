<?php

declare(strict_types=1);

$page = $translations['pages']['about'];
require TEMPLATE_PATH . '/header.php';
?>
<main id="main-content" class="about-page">
    <section class="about-hero" aria-labelledby="about-title">
        <img class="about-hero__image" src="<?= e(asset_url('/assets/images/about-hero.webp')) ?>" width="1920" height="1080" alt="" fetchpriority="high" decoding="async">
        <div class="about-hero__scrim" aria-hidden="true"></div>
        <div class="container about-hero__content reveal">
            <p class="eyebrow"><?= e($page['eyebrow']) ?></p>
            <h1 id="about-title"><?= e($page['title']) ?></h1>
            <p><?= e($page['intro']) ?></p>
            <span class="about-hero__badge"><i></i><?= e($page['hero_badge']) ?></span>
        </div>
    </section>

    <section class="section about-story" aria-labelledby="about-story-title">
        <div class="container about-story__grid">
            <div class="about-story__copy reveal">
                <p class="eyebrow"><?= e($page['story_eyebrow']) ?></p>
                <h2 id="about-story-title"><?= e($page['story_title']) ?></h2>
                <p><?= e($page['story_text_1']) ?></p>
                <p><?= e($page['story_text_2']) ?></p>
            </div>
            <div class="about-metrics reveal" aria-label="EVSmartRoute platform metrics">
                <?php foreach ([['1,200+', $page['metric_models']], ['2,800+', $page['metric_locations']], ['BG / EN', $page['metric_languages']]] as [$value, $label]): ?>
                    <div><strong><?= e($value) ?></strong><span><?= e($label) ?></span></div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="section about-mission" aria-labelledby="about-mission-title">
        <div class="container">
            <div class="section-heading section-heading--center reveal">
                <p class="eyebrow"><?= e($page['mission_eyebrow']) ?></p>
                <h2 id="about-mission-title"><?= e($page['mission_title']) ?></h2>
            </div>
            <div class="about-mission__grid">
                <article class="about-mission__card glass-panel reveal"><span>01</span><h3><?= e($lang === 'bg' ? 'Нашата мисия' : 'Our mission') ?></h3><p><?= e($page['mission_text']) ?></p></article>
                <article class="about-mission__card glass-panel reveal"><span>02</span><h3><?= e($page['vision_title']) ?></h3><p><?= e($page['vision_text']) ?></p></article>
            </div>
        </div>
    </section>

    <section class="section about-freedom" aria-labelledby="about-freedom-title">
        <div class="container">
            <div class="about-freedom__panel reveal">
                <div class="about-freedom__copy">
                    <p class="eyebrow"><?= e($page['freedom_eyebrow']) ?></p>
                    <h2 id="about-freedom-title"><?= e($page['freedom_title']) ?></h2>
                    <p><?= e($page['freedom_text']) ?></p>
                    <ul>
                        <?php foreach ($page['freedom_points'] as $point): ?>
                            <li><span>✓</span><?= e($point) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="about-freedom__symbol" aria-hidden="true">
                    <span class="about-freedom__orbit about-freedom__orbit--one"></span>
                    <span class="about-freedom__orbit about-freedom__orbit--two"></span>
                    <svg viewBox="0 0 440 440">
                        <defs><linearGradient id="freedomRoute" x1="0" y1="0" x2="1" y2="1"><stop stop-color="#22c55e"/><stop offset="1" stop-color="#0ea5e9"/></linearGradient></defs>
                        <path d="M70 300 C128 276 122 188 205 181 S285 255 365 125"/>
                        <circle cx="70" cy="300" r="7"/><circle cx="205" cy="181" r="7"/><circle cx="365" cy="125" r="7"/>
                    </svg>
                    <strong><?= e($page['freedom_label']) ?></strong>
                </div>
            </div>
        </div>
    </section>

    <section class="section about-intelligence" aria-label="EVSmartRoute intelligence">
        <div class="container">
            <figure class="about-intelligence__visual glass-panel reveal" data-parallax="-0.018">
                <img src="<?= e(asset_url('/assets/images/about-intelligence.webp')) ?>" width="1280" height="720" alt="<?= e($lang === 'bg' ? 'Визуализация на свързани EV маршрути, батерии и зарядни станции' : 'Visualization of connected EV routes, batteries and charging stations') ?>" loading="lazy" decoding="async">
                <figcaption><span class="live-badge"><span></span><?= e($page['intelligence_badge']) ?></span><strong><?= e($page['intelligence_caption']) ?></strong></figcaption>
            </figure>
        </div>
    </section>

    <section class="section about-values" aria-labelledby="about-values-title">
        <div class="container">
            <div class="section-heading reveal"><p class="eyebrow"><?= e($page['values_eyebrow']) ?></p><h2 id="about-values-title"><?= e($page['values_title']) ?></h2></div>
            <div class="about-values__grid">
                <?php foreach ($page['values'] as $value): ?>
                    <article class="about-value glass-panel reveal"><span aria-hidden="true"><?= e($value['icon']) ?></span><h3><?= e($value['title']) ?></h3><p><?= e($value['text']) ?></p></article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="section about-help" aria-labelledby="about-help-title">
        <div class="container">
            <div class="section-heading section-heading--center reveal"><p class="eyebrow"><?= e($page['help_eyebrow']) ?></p><h2 id="about-help-title"><?= e($page['help_title']) ?></h2></div>
            <div class="about-help__grid">
                <?php foreach ($page['help'] as $index => $item): ?>
                    <article class="about-help__card reveal"><span>0<?= $index + 1 ?></span><h3><?= e($item['title']) ?></h3><p><?= e($item['text']) ?></p></article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="section section--cta">
        <div class="container"><div class="cta-panel glass-panel reveal"><div><p class="eyebrow"><?= e($page['cta_eyebrow']) ?></p><h2><?= e($page['cta_title']) ?></h2><p><?= e($page['cta_text']) ?></p></div><div class="button-group"><a class="button button--primary" href="<?= e(app_url('/')) ?>"><?= e($page['cta_primary']) ?></a><a class="button button--ghost" href="<?= e(localized_url('contact')) ?>"><?= e($page['cta_secondary']) ?></a></div></div></div>
    </section>
</main>
<?php require TEMPLATE_PATH . '/footer.php'; ?>
