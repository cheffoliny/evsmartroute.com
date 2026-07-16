<?php
declare(strict_types=1);
$page = $translations['pages']['pricing'];
$faqItems = $page['faq_items'];
require TEMPLATE_PATH . '/header.php';
?>
<main id="main-content">
    <section class="inner-hero pricing-hero section">
        <div class="inner-hero__glow" aria-hidden="true"></div>
        <div class="container inner-hero__content reveal">
            <p class="eyebrow"><?= e($page['eyebrow']) ?></p>
            <h1><?= e($page['title']) ?></h1>
            <p><?= e($page['intro']) ?></p>
            <div class="billing-switch" role="group" aria-label="<?= e($page['billing_label']) ?>" data-billing-switch>
                <button type="button" class="is-active" data-billing="monthly" aria-pressed="true"><?= e($page['monthly']) ?></button>
                <button type="button" data-billing="yearly" aria-pressed="false"><?= e($page['yearly']) ?><span><?= e($page['save']) ?></span></button>
            </div>
        </div>
    </section>

    <section class="pricing-detail-section section">
        <div class="container detailed-plan-grid">
            <article class="detailed-plan glass-panel reveal">
                <p class="plan-kicker">FREE</p><h2>€0</h2><p><?= e($page['free_description']) ?></p>
                <a class="button button--ghost" href="<?= e(app_url('/register?plan=free')) ?>"><?= e(t('actions.start_free')) ?></a>
                <ul class="plan-features"><?php foreach ($page['free_features'] as $item): ?><li class="is-included"><?= e($item) ?></li><?php endforeach; ?></ul>
            </article>
            <article class="detailed-plan detailed-plan--premium glass-panel reveal" data-premium-card>
                <span class="popular-badge"><?= e($page['recommended']) ?></span><p class="plan-kicker">PREMIUM</p>
                <div class="dynamic-price"><span>€</span><strong data-price>4.99</strong><small data-period><?= e($page['per_month']) ?></small></div>
                <p data-price-description><?= e($page['monthly_description']) ?></p>
                <a class="button button--primary" data-premium-cta data-monthly-url="<?= e(app_url('/register?plan=premium_monthly&trial=true')) ?>" data-yearly-url="<?= e(app_url('/register?plan=premium_yearly&trial=true')) ?>" href="<?= e(app_url('/register?plan=premium_monthly&trial=true')) ?>"><?= e(t('actions.start_trial')) ?></a>
                <ul class="plan-features"><?php foreach ($page['premium_features'] as $item): ?><li class="is-included"><?= e($item) ?></li><?php endforeach; ?></ul>
            </article>
        </div>
    </section>

    <section class="section comparison-section" aria-labelledby="comparison-title">
        <div class="container">
            <div class="section-heading reveal"><p class="eyebrow"><?= e($page['comparison_eyebrow']) ?></p><h2 id="comparison-title"><?= e($page['comparison_title']) ?></h2></div>
            <div class="comparison-table-wrap glass-panel reveal"><table class="comparison-table"><thead><tr><th><?= e($page['feature']) ?></th><th>FREE</th><th>PREMIUM</th></tr></thead><tbody>
                <?php foreach ($page['comparison'] as $row): ?><tr><th><?= e($row[0]) ?></th><td><?= e($row[1]) ?></td><td class="premium-value"><?= e($row[2]) ?></td></tr><?php endforeach; ?>
            </tbody></table></div>
        </div>
    </section>

    <section class="section faq-section" aria-labelledby="pricing-faq-title"><div class="container faq-layout"><div class="section-heading reveal"><p class="eyebrow">FAQ</p><h2 id="pricing-faq-title"><?= e($page['faq_title']) ?></h2><p><?= e($page['faq_intro']) ?></p></div><div class="accordion" data-accordion>
        <?php foreach ($faqItems as $index => $item): ?><details class="glass-panel reveal"<?= $index === 0 ? ' open' : '' ?>><summary><?= e($item['question']) ?><span aria-hidden="true">+</span></summary><p><?= e($item['answer']) ?></p></details><?php endforeach; ?>
    </div></div></section>
</main>
<script type="application/json" id="pricingTranslations"><?= json_encode(['perMonth' => $page['per_month'], 'perYear' => $page['per_year'], 'monthlyDescription' => $page['monthly_description'], 'yearlyDescription' => $page['yearly_description']], JSON_UNESCAPED_UNICODE | JSON_HEX_TAG) ?></script>
<?php require TEMPLATE_PATH . '/footer.php'; ?>

