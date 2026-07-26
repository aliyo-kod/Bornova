<?php
/**
 * FAQ Page
 * Displays all frequently asked questions with accordion interface
 */
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sık Sorulan Sorular (SSS) - <?= e($site['name']) ?></title>
    <meta name="description" content="Su kaçağı, tıkanıklık, tesisat ve kombi hakkında sık sorulan sorular ve cevapları.">
    <meta name="keywords" content="sss, sık sorulan sorular, faq, su kaçağı, tıkanıklık, tesisat">

    <link rel="stylesheet" href="/assets/vendor/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/main.css">
    <style>
        .breadcrumb-section { background: var(--color-gray-50); padding: 20px 0; margin-top: calc(var(--topbar-height) + var(--header-height)); }
        .breadcrumb { display: flex; gap: 8px; align-items: center; font-size: 0.95rem; flex-wrap: wrap; }
        .breadcrumb a { color: var(--color-blue-600); text-decoration: none; }
        .breadcrumb a:hover { text-decoration: underline; }
        .breadcrumb__sep { color: var(--color-gray-400); }
        .page-header { background: linear-gradient(135deg, var(--color-navy-900) 0%, #1a3a5c 100%); color: var(--color-white); padding: 80px 0; text-align: center; }
        .page-header__title { font-size: 2.8rem; font-weight: 800; line-height: 1.2; margin-bottom: 16px; }
        .page-header__subtitle { font-size: 1.1rem; opacity: 0.9; max-width: 600px; margin: 0 auto; }
        .faq-section { padding: 60px 0; }
        .faq-intro { background: var(--color-blue-50); border-radius: 12px; padding: 40px; margin-bottom: 60px; text-align: center; }
        .faq-intro h2 { font-size: 1.8rem; margin-bottom: 16px; color: var(--color-navy-900); }
        .faq-intro p { font-size: 1.05rem; color: var(--color-text-body); margin: 0; }
        .faq-list { display: flex; flex-direction: column; gap: 16px; }
        .faq-item { background: var(--color-white); border: 1px solid var(--color-gray-200); border-radius: 8px; }
        .faq-question { cursor: pointer; display: flex; justify-content: space-between; align-items: center; padding: 20px 24px; background: var(--color-white); border: none; width: 100%; text-align: left; font-weight: 600; color: var(--color-navy-900); transition: all 0.2s ease; border-radius: 8px; }
        .faq-question:hover { background: var(--color-blue-50); color: var(--color-blue-600); }
        .faq-question[aria-expanded="true"] { background: var(--color-blue-600); color: var(--color-white); border-bottom-left-radius: 0; border-bottom-right-radius: 0; }
        .faq-question__toggle { display: inline-flex; align-items: center; justify-content: center; width: 28px; height: 28px; font-size: 1.3rem; transition: transform 0.2s ease; flex-shrink: 0; }
        .faq-question[aria-expanded="true"] .faq-question__toggle { transform: rotate(180deg); }
        .faq-answer { background: var(--color-gray-50); padding: 24px; border-radius: 0 0 8px 8px; line-height: 1.7; color: var(--color-text-body); display: none; }
        .faq-answer[hidden="false"] { display: block; }
        .faq-answer p { margin-bottom: 12px; }
        .faq-answer p:last-child { margin-bottom: 0; }
        .faq-answer strong { color: var(--color-navy-900); font-weight: 700; }
        .faq-answer ul { margin: 12px 0; padding-left: 24px; }
        .faq-answer li { margin-bottom: 8px; }
        .faq-cta { background: linear-gradient(135deg, var(--color-blue-600) 0%, #1e5fa8 100%); color: var(--color-white); padding: 40px; border-radius: 12px; text-align: center; margin-top: 60px; }
        .faq-cta h3 { margin-top: 0; margin-bottom: 16px; font-size: 1.5rem; }
        .faq-cta p { margin-bottom: 24px; font-size: 1.05rem; }
        .faq-cta-btn { display: inline-block; padding: 14px 32px; background: var(--color-white); color: var(--color-blue-600); text-decoration: none; border-radius: 8px; font-weight: 700; transition: all 0.2s ease; }
        .faq-cta-btn:hover { transform: scale(1.05); }
        .faq-categories { display: grid; grid-template-columns: repeat(2, 1fr); gap: 16px; margin-bottom: 40px; }
        .faq-cat-btn { padding: 12px 20px; background: var(--color-gray-100); border: 2px solid transparent; border-radius: 8px; color: var(--color-navy-900); text-decoration: none; font-weight: 600; text-align: center; transition: all 0.2s ease; cursor: pointer; }
        .faq-cat-btn:hover, .faq-cat-btn.active { background: var(--color-blue-600); color: var(--color-white); border-color: var(--color-blue-600); }
        @media (max-width: 1023px) {
            .page-header__title { font-size: 2rem; }
            .faq-categories { grid-template-columns: 1fr; }
        }
        @media (max-width: 767px) {
            .page-header { padding: 40px 0; }
            .page-header__title { font-size: 1.5rem; }
            .faq-intro { padding: 24px; }
            .faq-question { padding: 16px; }
            .faq-answer { padding: 16px; }
        }
    </style>
</head>
<body>
    <?php require __DIR__ . '/../layouts/header.php'; ?>

    <!-- Breadcrumb -->
    <section class="breadcrumb-section">
        <div class="container">
            <nav class="breadcrumb">
                <a href="/">Anasayfa</a>
                <span class="breadcrumb__sep">/</span>
                <span>Sık Sorulan Sorular</span>
            </nav>
        </div>
    </section>

    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <h1 class="page-header__title">Sık Sorulan Sorular</h1>
            <p class="page-header__subtitle">Su kaçağı, tıkanıklık, tesisat ve kombi hakkında merak ettiklerinize yanıt bulun</p>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="faq-section container">
        <div class="faq-intro">
            <h2>Sorunuzu Bulabildiniz mi?</h2>
            <p>Aşağıdaki sorular ve cevapları göz atın. Bulamamanız durumunda iletişim sayfasından bize yazabilirsiniz.</p>
        </div>

        <div class="faq-list">
            <?php foreach ($faqs as $idx => $faqItem): ?>
            <div class="faq-item">
                <button class="faq-question" aria-expanded="false" data-toggle="faq-<?= $idx ?>">
                    <span><?= e($faqItem['question']) ?></span>
                    <span class="faq-question__toggle">▼</span>
                </button>
                <div class="faq-answer" id="faq-<?= $idx ?>" hidden="true">
                    <?= $faqItem['answer'] ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <!-- CTA Section -->
        <div class="faq-cta">
            <h3>Sorunuz hala cevapsız mı?</h3>
            <p>Bizimle iletişime geçin ve deneyimli ekibimizden cevap alın.</p>
            <a href="/iletisim" class="faq-cta-btn">İletişim Formunu Doldur</a>
        </div>
    </section>

    <!-- Schema.org Markup -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "FAQPage",
        "mainEntity": [
            <?php
            $faqJson = [];
            foreach ($faqs as $item) {
                $faqJson[] = '{"@type":"Question","name":"' . addslashes($item['question']) . '","acceptedAnswer":{"@type":"Answer","text":"' . addslashes(strip_tags($item['answer'])) . '"}}';
            }
            echo implode(',', $faqJson);
            ?>
        ]
    }
    </script>

    <?php require __DIR__ . '/../layouts/footer.php'; ?>

    <script src="/assets/vendor/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="/assets/js/modules/nav.js"></script>
    <script>
        document.querySelectorAll('[data-toggle^="faq-"]').forEach(btn => {
            btn.addEventListener('click', function() {
                const isOpen = this.getAttribute('aria-expanded') === 'true';
                const targetId = this.getAttribute('data-toggle');
                const answer = document.getElementById(targetId);

                this.setAttribute('aria-expanded', !isOpen);
                answer.setAttribute('hidden', isOpen ? 'true' : 'false');
            });
        });
    </script>
</body>
</html>
