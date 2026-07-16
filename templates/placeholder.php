<?php
declare(strict_types=1);
require TEMPLATE_PATH . '/header.php';
?>
<main id="main-content">
    <section class="section placeholder-page">
        <div class="container placeholder-page__inner">
            <p class="eyebrow"><?= $route === '404' ? '404' : e(t('placeholder.eyebrow')) ?></p>
            <h1><?= e($route === '404' ? t('placeholder.not_found') : t('placeholder.title')) ?></h1>
            <p><?= e($route === '404' ? t('placeholder.not_found_text') : t('placeholder.text')) ?></p>
            <a class="button button--primary" href="<?= e(localized_url()) ?>"><?= e(t('actions.back_home')) ?></a>
        </div>
    </section>
</main>
<?php require TEMPLATE_PATH . '/footer.php'; ?>

