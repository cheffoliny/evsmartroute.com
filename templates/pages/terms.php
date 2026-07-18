<?php

declare(strict_types=1);

$page = $translations['pages']['terms'] ?? [];

require TEMPLATE_PATH . '/header.php';
?>
<main id="main-content" class="legal-page">
    <section class="inner-hero legal-hero section" aria-labelledby="terms-title">
        <div class="inner-hero__glow" aria-hidden="true"></div>
        <div class="container inner-hero__content reveal">
            <p class="eyebrow"><?= e($page['eyebrow'] ?? 'EVSmartRoute') ?></p>
            <h1 id="terms-title"><?= e($page['title'] ?? $pageTitle) ?></h1>
            <p><?= e($page['intro'] ?? $pageDescription) ?></p>
            <?php if (!empty($page['last_updated'])): ?>
                <p class="legal-meta">
                    <span><?= e($page['last_updated_label'] ?? '') ?></span>
                    <strong><?= e($page['last_updated']) ?></strong>
                </p>
            <?php endif; ?>
        </div>
    </section>

    <section class="section legal-content-section">
        <div class="container legal-layout">
            <aside class="legal-toc glass-panel reveal" aria-labelledby="terms-toc-title">
                <h2 id="terms-toc-title"><?= e($page['toc_title'] ?? '') ?></h2>
                <nav aria-label="<?= e($page['toc_aria'] ?? ($page['toc_title'] ?? '')) ?>">
                    <?php foreach (($page['sections'] ?? []) as $section): ?>
                        <a href="#<?= e($section['id']) ?>"><?= e($section['title']) ?></a>
                    <?php endforeach; ?>
                </nav>
                <div class="legal-toc__links">
                    <a href="<?= e(localized_url('privacy')) ?>"><?= e(t('footer.privacy')) ?></a>
                    <a href="<?= e(localized_url('cookies')) ?>"><?= e(t('footer.cookies')) ?></a>
                    <a href="<?= e(localized_url('contact')) ?>"><?= e(t('footer.contact')) ?></a>
                </div>
            </aside>

            <article class="legal-document glass-panel reveal">
                <?php if (!empty($page['acceptance'])): ?>
                    <div class="legal-summary">
                        <p><?= e($page['acceptance']) ?></p>
                    </div>
                <?php endif; ?>

                <?php foreach (($page['sections'] ?? []) as $section): ?>
                    <section class="legal-clause" id="<?= e($section['id']) ?>" aria-labelledby="<?= e($section['id']) ?>-title">
                        <h2 id="<?= e($section['id']) ?>-title"><?= e($section['title']) ?></h2>
                        <?php foreach (($section['paragraphs'] ?? []) as $paragraph): ?>
                            <p><?= e($paragraph) ?></p>
                        <?php endforeach; ?>
                        <?php if (!empty($section['items'])): ?>
                            <ul>
                                <?php foreach ($section['items'] as $item): ?>
                                    <li><?= e($item) ?></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </section>
                <?php endforeach; ?>

                <?php if (!empty($page['note'])): ?>
                    <div class="legal-review-note" role="note">
                        <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 3 2.8 20h18.4L12 3Z"/><path d="M12 9v5M12 17.5v.1"/></svg>
                        <div>
                            <h2><?= e($page['note_title'] ?? '') ?></h2>
                            <p><?= e($page['note']) ?></p>
                        </div>
                    </div>
                <?php endif; ?>
            </article>
        </div>
    </section>
</main>
<?php require TEMPLATE_PATH . '/footer.php'; ?>
