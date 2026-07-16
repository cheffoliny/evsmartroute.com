<?php

declare(strict_types=1);

require dirname(__DIR__) . '/templates/bootstrap.php';

$pageKey = 'home';
$pageTitle = t('seo.home.title');
$pageDescription = t('seo.home.description');
$canonicalPath = '';

$evModels = [
    ['id' => 'tesla-model-3-lr', 'brand' => 'Tesla', 'model' => 'Model 3 Long Range', 'range' => 629, 'efficiency' => 14.0, 'battery' => 75, 'curve' => '250 kW'],
    ['id' => 'vw-id4-pro', 'brand' => 'Volkswagen', 'model' => 'ID.4 Pro', 'range' => 550, 'efficiency' => 16.4, 'battery' => 77, 'curve' => '175 kW'],
    ['id' => 'hyundai-ioniq5-84', 'brand' => 'Hyundai', 'model' => 'Ioniq 5 84 kWh', 'range' => 570, 'efficiency' => 17.2, 'battery' => 84, 'curve' => '260 kW'],
    ['id' => 'peugeot-e208', 'brand' => 'Peugeot', 'model' => 'e-208 51 kWh', 'range' => 410, 'efficiency' => 15.1, 'battery' => 51, 'curve' => '100 kW'],
    ['id' => 'bmw-i4-edrive40', 'brand' => 'BMW', 'model' => 'i4 eDrive40', 'range' => 590, 'efficiency' => 16.1, 'battery' => 81.1, 'curve' => '205 kW'],
    ['id' => 'audi-q4-45', 'brand' => 'Audi', 'model' => 'Q4 e-tron 45', 'range' => 562, 'efficiency' => 17.6, 'battery' => 77, 'curve' => '175 kW'],
    ['id' => 'kia-ev6-long-range', 'brand' => 'Kia', 'model' => 'EV6 Long Range', 'range' => 528, 'efficiency' => 16.5, 'battery' => 77.4, 'curve' => '240 kW'],
    ['id' => 'renault-megane-ev60', 'brand' => 'Renault', 'model' => 'Megane E-Tech EV60', 'range' => 470, 'efficiency' => 16.1, 'battery' => 60, 'curve' => '130 kW'],
    ['id' => 'byd-seal-design', 'brand' => 'BYD', 'model' => 'Seal Design', 'range' => 570, 'efficiency' => 16.6, 'battery' => 82.5, 'curve' => '150 kW'],
    ['id' => 'skoda-enyaq-85', 'brand' => 'Škoda', 'model' => 'Enyaq 85', 'range' => 565, 'efficiency' => 16.2, 'battery' => 77, 'curve' => '175 kW'],
];

require TEMPLATE_PATH . '/header.php';
?>
<main id="main-content">
    <section class="hero hero--fullbleed" aria-labelledby="hero-title">
        <img class="hero__backdrop" src="<?= e(asset_url('/assets/images/hero-fullbleed.webp')) ?>" width="1920" height="1080" alt="" fetchpriority="high" decoding="async">
        <div class="hero__scrim" aria-hidden="true"></div>
        <div class="container hero__inner">
            <div class="hero__content">
                <p class="eyebrow"><?= e(t('home.hero.eyebrow')) ?></p>
                <h1 id="hero-title" class="hero__title"><?php if ($lang === 'bg'): ?>Пътувай по-далеч.<br>Зареждай <span>по-умно.</span><?php else: ?>Drive farther.<br>Charge <span>smarter.</span><?php endif; ?></h1>
                <p class="hero__lead"><?= e(t('home.hero.description')) ?></p>
                <div class="button-group">
                    <a class="button button--primary" href="<?= e(app_url('/')) ?>"><?= e(t('actions.plan_route')) ?></a>
                    <a class="button button--ghost" href="#how-it-works" data-smooth-scroll><?= e(t('actions.see_how')) ?></a>
                </div>
                <p class="trust-line"><span aria-hidden="true">✓</span> <?= e(t('home.hero.trust')) ?></p>
            </div>

            <div class="hero-hud" aria-label="Sofia to the Black Sea EV route" data-parallax="-0.018">
                <svg class="hero-route-motion" viewBox="0 0 1000 620" preserveAspectRatio="none" data-route-motion aria-hidden="true">
                    <path class="hero-route-motion__base" d="M90 485 C260 420 320 270 510 310 S720 400 900 150"/>
                    <path class="hero-route-motion__pulse" d="M90 485 C260 420 320 270 510 310 S720 400 900 150"/>
                </svg>
                <div class="hud-waypoint hud-waypoint--start"><i></i><strong>📍 <?= $lang === 'bg' ? 'София' : 'Sofia' ?></strong><span>100% SoC</span></div>
                <div class="hud-waypoint hud-waypoint--charge"><i></i><strong>⚡ HPC Charging</strong><span>350 kW</span></div>
                <div class="hud-waypoint hud-waypoint--finish"><i></i><strong>🏁 <?= $lang === 'bg' ? 'Варна / Бургас' : 'Varna / Burgas' ?></strong><span>25% SoC</span></div>
            </div>
        </div>
    </section>

    <section class="simulator-stage section" aria-labelledby="range-lab-title">
        <div class="container simulator-lab">
            <div class="simulator-stage__inner reveal">
            <div class="range-simulator glass-panel" data-simulator>
                <div class="simulator-header">
                    <div>
                        <p class="eyebrow"><?= e(t('home.simulator.eyebrow')) ?></p>
                        <h2 id="range-lab-title"><?= e(t('home.simulator.title')) ?></h2>
                    </div>
                    <span class="live-badge"><span></span><?= e(t('home.simulator.live')) ?></span>
                </div>

                <div class="simulator-range" aria-live="polite">
                    <div>
                        <span><?= e(t('home.simulator.estimated_range')) ?></span>
                        <strong><span data-range-output>498</span> <small>km</small></strong>
                    </div>
                    <div class="climate-loss">
                        <span><?= e(t('home.simulator.climate_loss')) ?></span>
                        <strong data-loss-output>−8%</strong>
                    </div>
                </div>

                <div class="range-meter" aria-hidden="true"><span data-range-meter></span></div>

                <div class="simulator-controls">
                    <label class="control-group" for="temperatureRange">
                        <span class="control-label"><span><?= e(t('home.simulator.temperature')) ?></span><strong><span data-temperature-output>12</span>°C</strong></span>
                        <input id="temperatureRange" type="range" min="-10" max="35" value="12" step="1" data-temperature>
                        <span class="range-labels"><span>−10°C</span><span>35°C</span></span>
                    </label>

                    <label class="control-group" for="vehicleModel">
                        <span class="control-label"><span><?= e(t('home.simulator.vehicle')) ?></span><strong data-battery-output>75 kWh</strong></span>
                        <span class="select-shell">
                            <select id="vehicleModel" data-vehicle>
                                <?php foreach (array_slice($evModels, 0, 4) as $model): ?>
                                    <option value="<?= e($model['id']) ?>"
                                            data-range="<?= e((string) $model['range']) ?>"
                                            data-efficiency="<?= e((string) $model['efficiency']) ?>"
                                            data-battery="<?= e((string) $model['battery']) ?>">
                                        <?= e($model['brand'] . ' ' . $model['model']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </span>
                    </label>
                </div>

                <div class="simulator-insight">
                    <span aria-hidden="true">✦</span>
                    <p data-insight><?= e(t('home.simulator.insight_mild')) ?></p>
                </div>
            </div>
            </div>
            <figure class="simulator-lab__visual reveal" data-parallax="0.025">
                <img src="<?= e(asset_url('/assets/images/battery-chassis.webp')) ?>" width="1280" height="720" alt="<?= e($lang === 'bg' ? 'EV шаси с визуализирани батерия и термичен поток' : 'EV chassis with visualized battery and thermal flow') ?>" loading="lazy" decoding="async">
                <figcaption><span></span><?= e($lang === 'bg' ? 'Battery & Thermal Intelligence' : 'Battery & Thermal Intelligence') ?></figcaption>
            </figure>
        </div>
    </section>

    <section class="stats-section" aria-label="<?= e(t('home.stats.aria')) ?>">
        <div class="container stats-grid" data-stats>
            <?php foreach ([['locations', 2840], ['connectors', 6170], ['operators', 15], ['models', 300]] as [$stat, $value]): ?>
                <div class="stat-item reveal">
                    <strong><span data-count-up="<?= $value ?>">0</span>+</strong>
                    <span><?= e(t("home.stats.$stat")) ?></span>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <section class="section compatibility-section" id="how-it-works" aria-labelledby="compatibility-title">
        <div class="container">
            <div class="section-heading section-heading--center reveal">
                <p class="eyebrow"><?= e(t('home.compatibility.eyebrow')) ?></p>
                <h2 id="compatibility-title"><?= e(t('home.compatibility.title')) ?></h2>
                <p><?= e(t('home.compatibility.description')) ?></p>
            </div>

            <div class="vehicle-search glass-panel reveal" data-vehicle-search>
                <div class="vehicle-search__icon" aria-hidden="true">⌕</div>
                <label class="sr-only" for="vehicleSearch"><?= e(t('home.compatibility.placeholder')) ?></label>
                <input id="vehicleSearch" type="search" placeholder="<?= e(t('home.compatibility.placeholder')) ?>" autocomplete="off" role="combobox" aria-autocomplete="list" aria-expanded="false" aria-controls="vehicleResults" data-vehicle-query>
                <span class="vehicle-search__hint"><?= e($lang === 'bg' ? 'EV каталог' : 'EV Catalog') ?></span>
                <div class="autocomplete-list" id="vehicleResults" role="listbox" hidden data-vehicle-results></div>
            </div>
            <div class="vehicle-support-message glass-panel" aria-live="polite" hidden data-vehicle-message></div>

            <div class="brand-marquee reveal" aria-label="<?= e(t('home.compatibility.brands')) ?>">
                <?php foreach (['TESLA', 'BMW', 'Audi', 'HYUNDAI', 'KIA', 'Volkswagen', 'RENAULT', 'BYD', 'ŠKODA'] as $brand): ?>
                    <span><?= e($brand) ?></span>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="section battery-section" aria-labelledby="battery-title">
        <div class="battery-orbit battery-orbit--one" data-parallax="0.05" aria-hidden="true"></div>
        <div class="battery-orbit battery-orbit--two" data-parallax="-0.04" aria-hidden="true"></div>
        <div class="container battery-layout">
            <div class="battery-copy reveal">
                <p class="eyebrow"><?= e(t('home.battery.eyebrow')) ?></p>
                <h2 id="battery-title"><?= e(t('home.battery.title')) ?></h2>
                <p><?= e(t('home.battery.description')) ?></p>
                <ul class="check-list">
                    <li><?= e(t('home.battery.factor_temperature')) ?></li>
                    <li><?= e(t('home.battery.factor_load')) ?></li>
                    <li><?= e(t('home.battery.factor_buffer')) ?></li>
                </ul>
                <a class="text-link" href="<?= e(localized_url('battery-intelligence')) ?>"><?= e(t('home.battery.learn_more')) ?> <span>→</span></a>
            </div>

            <figure class="battery-photo glass-panel reveal" data-parallax="-0.018">
                <img src="<?= e(asset_url('/assets/images/ev-charging-parallax.webp')) ?>" width="1280" height="720" alt="<?= e(t('home.battery.image_alt')) ?>" loading="lazy" decoding="async">
                <span class="battery-photo__glow" aria-hidden="true"></span>
            </figure>
        </div>
    </section>

    <section class="section network-section" aria-labelledby="network-title">
        <div class="container">
            <div class="section-heading reveal">
                <p class="eyebrow"><?= e(t('home.network.eyebrow')) ?></p>
                <h2 id="network-title"><?= e(t('home.network.title')) ?></h2>
                <p><?= e(t('home.network.description')) ?></p>
            </div>
            <div class="operator-grid reveal">
                <?php foreach ([['Tesla', 'Supercharger'], ['Eldrive', 'Bulgaria'], ['FINES', 'Charging'], ['EVPoint', 'Network'], ['Electrip', 'Europe'], ['Kia', 'Charge']] as [$operator, $meta]): ?>
                    <div class="operator-card glass-panel"><span class="operator-dot"></span><strong><?= e($operator) ?></strong><small><?= e($meta) ?></small></div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="section pricing-preview" aria-labelledby="pricing-title">
        <div class="container">
            <div class="section-heading section-heading--center reveal">
                <p class="eyebrow"><?= e(t('home.pricing.eyebrow')) ?></p>
                <h2 id="pricing-title"><?= e(t('home.pricing.title')) ?></h2>
                <p><?= e(t('home.pricing.description')) ?></p>
            </div>

            <div class="plan-grid">
                <article class="plan-card glass-panel reveal">
                    <div class="plan-card__header"><div><span><?= e(t('home.pricing.free_name')) ?></span><strong>€0</strong></div><small><?= e(t('home.pricing.forever')) ?></small></div>
                    <ul class="plan-features">
                        <li class="is-included"><?= e(t('home.pricing.free_routes')) ?></li>
                        <li class="is-included"><?= e(t('home.pricing.free_distance')) ?></li>
                        <li class="is-included"><?= e(t('home.pricing.free_vehicle')) ?></li>
                        <li class="is-muted"><?= e(t('home.pricing.no_multistop')) ?></li>
                        <li class="is-muted"><?= e(t('home.pricing.no_traffic')) ?></li>
                    </ul>
                    <a class="button button--ghost" href="<?= e(app_url('/register?plan=free')) ?>"><?= e(t('actions.start_free')) ?></a>
                </article>

                <article class="plan-card plan-card--premium glass-panel reveal">
                    <span class="popular-badge"><?= e(t('home.pricing.popular')) ?></span>
                    <div class="plan-card__header"><div><span>PREMIUM</span><strong>€4.99 <small>/ <?= e(t('home.pricing.month')) ?></small></strong></div><small><?= e(t('home.pricing.trial')) ?></small></div>
                    <ul class="plan-features">
                        <li class="is-included"><?= e(t('home.pricing.unlimited_routes')) ?></li>
                        <li class="is-included"><?= e(t('home.pricing.long_routes')) ?></li>
                        <li class="is-included"><?= e(t('home.pricing.multistop')) ?></li>
                        <li class="is-included"><?= e(t('home.pricing.unlimited_garage')) ?></li>
                        <li class="is-included"><?= e(t('home.pricing.live_traffic')) ?></li>
                    </ul>
                    <a class="button button--primary" href="<?= e(app_url('/register?plan=premium_monthly&trial=true')) ?>"><?= e(t('actions.start_trial')) ?></a>
                </article>
            </div>
            <div class="pricing-more reveal"><a class="text-link" href="<?= e(localized_url('pricing')) ?>"><?= e(t('home.pricing.compare_all')) ?> <span>→</span></a></div>
        </div>
    </section>

    <section class="section section--cta">
        <div class="container">
            <div class="cta-panel glass-panel reveal">
                <div><p class="eyebrow"><?= e(t('home.cta.eyebrow')) ?></p><h2><?= e(t('home.cta.title')) ?></h2><p><?= e(t('home.cta.description')) ?></p></div>
                <a class="button button--primary" href="<?= e(app_url('/register')) ?>"><?= e(t('actions.start_free')) ?></a>
            </div>
        </div>
    </section>
</main>

<script type="application/json" id="evCatalogData"><?= json_encode($evModels, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG | JSON_HEX_AMP) ?></script>
<script type="application/json" id="homeTranslations"><?= json_encode([
    'supported' => t('home.compatibility.supported'),
    'noResults' => t('home.compatibility.no_results'),
    'insightCold' => t('home.simulator.insight_cold'),
    'insightMild' => t('home.simulator.insight_mild'),
    'insightHot' => t('home.simulator.insight_hot'),
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG | JSON_HEX_AMP) ?></script>
<?php require TEMPLATE_PATH . '/footer.php'; ?>
