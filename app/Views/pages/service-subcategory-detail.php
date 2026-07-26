<?php
/**
 * Service Subcategory Detail Page
 * Displays detailed information about a specific service subcategory
 */
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($subcategory['title']) ?> - <?= e($site['name']) ?></title>
    <meta name="description" content="<?= e($subcategory['title']) ?> hizmeti hakkında detaylı bilgi. Profesyonel hizmetler için bize ulaşın.">
    <meta name="keywords" content="<?= e($subcategory['keywords'] ?? '') ?>">
    <meta property="og:title" content="<?= e($subcategory['title']) ?>">
    <meta property="og:description" content="<?= e($subcategory['title']) ?> hizmeti hakkında detaylı bilgi.">
    <meta property="og:type" content="website">

    <link rel="stylesheet" href="/assets/vendor/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/main.css">
    <style>
        .breadcrumb-section { background: var(--color-gray-50); padding: 20px 0; margin-top: calc(var(--topbar-height) + var(--header-height)); }
        .breadcrumb { display: flex; gap: 8px; align-items: center; font-size: 0.95rem; flex-wrap: wrap; }
        .breadcrumb a { color: var(--color-blue-600); text-decoration: none; }
        .breadcrumb a:hover { text-decoration: underline; }
        .breadcrumb__sep { color: var(--color-gray-400); }
        .hero { background: linear-gradient(135deg, var(--color-navy-900) 0%, #1a3a5c 100%); color: var(--color-white); padding: 60px 0; }
        .hero__title { font-size: 2.5rem; font-weight: 800; line-height: 1.2; margin-bottom: 16px; }
        .hero__subtitle { font-size: 1rem; opacity: 0.95; margin-bottom: 24px; }
        .hero__btn { display: inline-block; padding: 12px 28px; background: var(--color-blue-500); color: var(--color-white); text-decoration: none; border-radius: 8px; font-weight: 600; transition: background 0.2s ease; }
        .hero__btn:hover { background: var(--color-blue-600); }
        .content-section { padding: 60px 0; }
        .content-wrap { display: grid; grid-template-columns: 1fr 300px; gap: 40px; }
        .content-main { font-size: 1.05rem; line-height: 1.8; color: var(--color-text-body); }
        .content-main h2 { font-size: 2rem; margin-top: 40px; margin-bottom: 20px; color: var(--color-navy-900); }
        .content-main h3 { font-size: 1.5rem; margin-top: 32px; margin-bottom: 16px; color: var(--color-navy-900); }
        .content-main p { margin-bottom: 16px; }
        .content-main ul, .content-main ol { margin-bottom: 16px; padding-left: 24px; }
        .content-main li { margin-bottom: 12px; }
        .benefit-list { display: flex; flex-direction: column; gap: 12px; margin: 24px 0; }
        .benefit-item { display: flex; gap: 16px; align-items: flex-start; }
        .benefit-item__icon { width: 32px; height: 32px; background: var(--color-blue-100); border-radius: 6px; display: flex; align-items: center; justify-content: center; color: var(--color-blue-600); font-weight: 700; flex-shrink: 0; }
        .benefit-item__text { }
        .benefit-item__text strong { color: var(--color-navy-900); }
        .content-sidebar { padding-top: 20px; }
        .sidebar-widget { background: var(--color-gray-50); border-radius: 12px; padding: 24px; margin-bottom: 24px; }
        .sidebar-widget h3 { font-size: 1.1rem; font-weight: 700; margin-bottom: 16px; color: var(--color-navy-900); }
        .sidebar-widget p { margin: 0; font-size: 0.95rem; color: var(--color-text-body); }
        .sidebar-widget a { display: inline-block; margin-top: 12px; color: var(--color-blue-600); text-decoration: none; font-weight: 600; }
        .sidebar-widget a:hover { color: var(--color-blue-700); }
        .sidebar-widget .cta-btn { display: inline-block; margin-top: 16px; padding: 12px 24px; background: var(--color-blue-600); color: var(--color-white); text-decoration: none; border-radius: 8px; font-weight: 600; transition: background 0.2s ease; }
        .sidebar-widget .cta-btn:hover { background: var(--color-blue-700); }
        .related-items { display: flex; flex-direction: column; gap: 12px; }
        .related-item { padding: 12px; background: var(--color-white); border: 1px solid var(--color-gray-200); border-radius: 8px; }
        .related-item a { color: var(--color-blue-600); text-decoration: none; font-weight: 600; }
        .related-item a:hover { color: var(--color-blue-700); }
        .faq-section { background: var(--color-white); border-radius: 12px; padding: 40px; margin: 60px 0; border-left: 4px solid var(--color-blue-600); }
        .faq-section h2 { font-size: 2rem; margin-bottom: 32px; color: var(--color-navy-900); }
        .faq-item { margin-bottom: 16px; }
        .faq-question { cursor: pointer; display: flex; justify-content: space-between; align-items: center; padding: 16px 20px; background: var(--color-gray-50); border-radius: 8px; font-weight: 600; color: var(--color-navy-900); transition: all 0.2s ease; border: none; width: 100%; }
        .faq-question:hover { background: var(--color-blue-50); color: var(--color-blue-600); }
        .faq-question[aria-expanded="true"] { background: var(--color-blue-600); color: var(--color-white); }
        .faq-question__toggle { display: inline-flex; align-items: center; justify-content: center; width: 24px; height: 24px; font-size: 1.2rem; transition: transform 0.2s ease; }
        .faq-question[aria-expanded="true"] .faq-question__toggle { transform: rotate(180deg); }
        .faq-answer { background: var(--color-gray-50); padding: 20px; border-radius: 8px; margin-top: 8px; line-height: 1.7; color: var(--color-text-body); display: none; }
        .faq-answer[hidden="false"] { display: block; }
        .cta-band { background: linear-gradient(135deg, var(--color-green-600) 0%, #1a8f52 100%); color: var(--color-white); padding: 40px; border-radius: 12px; text-align: center; margin: 60px 0; }
        .cta-band h3 { margin-top: 0; margin-bottom: 16px; font-size: 1.5rem; }
        .cta-band p { margin-bottom: 24px; }
        .cta-band .btn { display: inline-block; padding: 12px 32px; background: var(--color-white); color: var(--color-green-600); text-decoration: none; border-radius: 8px; font-weight: 700; transition: all 0.2s ease; }
        .cta-band .btn:hover { transform: scale(1.05); }
        @media (max-width: 1023px) {
            .content-wrap { grid-template-columns: 1fr; }
            .content-sidebar { display: none; }
            .hero__title { font-size: 2rem; }
        }
        @media (max-width: 767px) {
            .hero { padding: 40px 0; }
            .hero__title { font-size: 1.5rem; }
            .cta-band { padding: 32px; }
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
                <a href="/hizmetler">Hizmetler</a>
                <span class="breadcrumb__sep">/</span>
                <a href="/hizmet/<?= e($slug) ?>"><?= e($service['name']) ?></a>
                <span class="breadcrumb__sep">/</span>
                <span><?= e($subcategory['title']) ?></span>
            </nav>
        </div>
    </section>

    <!-- Hero -->
    <section class="hero">
        <div class="container">
            <h1 class="hero__title"><?= e($subcategory['title']) ?></h1>
            <p class="hero__subtitle">Profesyonel ve güvenilir hizmet için bize ulaşın</p>
            <a href="tel:<?= e(str_replace(' ', '', $site['phone'])) ?>" class="hero__btn">Hemen Arayın: <?= e($site['phone']) ?></a>
        </div>
    </section>

    <!-- Content -->
    <section class="content-section">
        <div class="container">
            <div class="content-wrap">
                <article class="content-main">
                    <h2><?= e($subcategory['title']) ?> Hizmeti</h2>
                    <p>Bornova bölgesinde <?= strtolower(e($subcategory['title'])) ?> hizmetleri profesyonel ve deneyimli ekibimiz tarafından sunulmaktadır. Kaliteli malzeme ve modern teknoloji kullanarak, en kısa sürede sorununuzun çözümünü sağlıyoruz.</p>

                    <h3>Hizmet Kapsamı</h3>
                    <div class="benefit-list">
                        <div class="benefit-item">
                            <div class="benefit-item__icon">✓</div>
                            <div class="benefit-item__text"><strong>Profesyonel Değerlendirme:</strong> Sorunu detaylı şekilde inceleyerek en uygun çözümü sunuyoruz</div>
                        </div>
                        <div class="benefit-item">
                            <div class="benefit-item__icon">✓</div>
                            <div class="benefit-item__text"><strong>Modern Teknoloji:</strong> En güncel cihaz ve yöntemler kullanarak hizmet veriyoruz</div>
                        </div>
                        <div class="benefit-item">
                            <div class="benefit-item__icon">✓</div>
                            <div class="benefit-item__text"><strong>Garantili Çalışma:</strong> Tüm işlerimize garantisi bulunmaktadır</div>
                        </div>
                        <div class="benefit-item">
                            <div class="benefit-item__icon">✓</div>
                            <div class="benefit-item__text"><strong>24/7 Hizmet:</strong> Acil durumlarda kapınıza hızlı ulaşabiliyoruz</div>
                        </div>
                    </div>

                    <h3>Neden Bizi Tercih Etmelisiniz?</h3>
                    <ul>
                        <li>Deneyimli ve sertifikalı teknisyenler</li>
                        <li>Rekabetçi fiyatlandırma</li>
                        <li>Hızlı ve güvenilir hizmet</li>
                        <li>Müşteri memnuniyeti garantisi</li>
                        <li>Tüm işlere yazılı garanti</li>
                    </ul>

                    <h3>Hizmet Süreci</h3>
                    <ol>
                        <li><strong>İletişim:</strong> Bize telefonla, WhatsApp veya form üzerinden ulaşın</li>
                        <li><strong>Randevu:</strong> Uygun bir saati belirleyin</li>
                        <li><strong>Ziyaret:</strong> Ekibimiz belirlenen saatte sizde olur</li>
                        <li><strong>Teşhis:</strong> Sorunu profesyonel olarak teşhis ederiz</li>
                        <li><strong>Çözüm:</strong> Uygun fiyata kaliteli çözüm sunuyoruz</li>
                        <li><strong>Destek:</strong> İş bitiminde sonrası da desteğimiz devam eder</li>
                    </ol>
                </article>

                <!-- Sidebar -->
                <aside class="content-sidebar">
                    <!-- Quick Contact -->
                    <div class="sidebar-widget">
                        <h3>Hızlı İletişim</h3>
                        <p><?= e($site['tagline']) ?></p>
                        <p style="margin-top: 12px; font-size: 1.2rem; font-weight: 700; color: var(--color-blue-600);"><?= e($site['phone']) ?></p>
                        <a href="tel:<?= e(str_replace(' ', '', $site['phone'])) ?>" class="cta-btn">Ara</a>
                        <a href="https://wa.me/<?= e(str_replace([' ', '(', ')', '-', '+'], '', $site['phone'])) ?>" class="cta-btn" target="_blank" style="display: block; margin-top: 8px; background: #25d366;">WhatsApp</a>
                    </div>

                    <!-- Related Subcategories -->
                    <div class="sidebar-widget">
                        <h3>Diğer Hizmetler</h3>
                        <div class="related-items">
                            <?php foreach (array_slice($subcategories, 0, 3) as $other):
                                if ($other['slug'] !== $subcategory['slug']):
                            ?>
                                <div class="related-item">
                                    <a href="/hizmet/<?= e($slug) ?>/<?= e($other['slug']) ?>"><?= e($other['title']) ?></a>
                                </div>
                            <?php endif; endforeach; ?>
                        </div>
                    </div>

                    <!-- Parent Service -->
                    <div class="sidebar-widget">
                        <h3>Ana Hizmet</h3>
                        <p><?= e($service['name']) ?></p>
                        <a href="/hizmet/<?= e($slug) ?>">Tüm hizmetleri gör →</a>
                    </div>
                </aside>
            </div>
        </div>
    </section>

    <!-- CTA Band -->
    <section class="cta-band container">
        <h3>Sorununuz Çözüldü mü?</h3>
        <p>Herhangi bir sorun veya başka hizmetler için lütfen bizimle iletişime geçin. Profesyonel ekibimiz her zaman yardım için hazır.</p>
        <a href="/iletisim" class="btn">İletişim Formu Doldur</a>
    </section>

    <!-- FAQ Section -->
    <?php
    $subFaqs = [];
    $keywordLower = strtolower(preg_replace('/[^a-z0-9]/', '', $subcategory['title']));
    foreach ($faqs as $faq) {
        $questionLower = strtolower(preg_replace('/[^a-z0-9]/', '', $faq['question']));
        if (strpos($questionLower, $keywordLower) !== false ||
            strpos($questionLower, 'nasıl') !== false ||
            strpos($questionLower, 'nedir') !== false) {
            $subFaqs[] = $faq;
        }
    }
    if (empty($subFaqs)) {
        $subFaqs = array_slice($faqs, 0, 3);
    }
    if (!empty($subFaqs)):
    ?>
    <section class="container faq-section">
        <h2>Sık Sorulan Sorular</h2>
        <div class="accordion">
            <?php foreach ($subFaqs as $idx => $faqItem): ?>
            <div class="faq-item">
                <button class="faq-question" aria-expanded="false" data-toggle="faq-<?= $idx ?>">
                    <span><?= e($faqItem['question']) ?></span>
                    <span class="faq-question__toggle">▼</span>
                </button>
                <div class="faq-answer" id="faq-<?= $idx ?>" hidden="true">
                    <?= e($faqItem['answer']) ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </section>
    <?php endif; ?>

    <!-- Schema.org Markup -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Service",
        "name": "<?= e($subcategory['title']) ?>",
        "description": "<?= e($subcategory['title']) ?> hizmeti",
        "provider": {
            "@type": "LocalBusiness",
            "name": "<?= e($site['name']) ?>",
            "telephone": "<?= e($site['phone']) ?>",
            "url": "<?= e($site['url'] ?? 'https://izmirkacaksutespiti.com') ?>"
        },
        "areaServed": {
            "@type": "City",
            "name": "Bornova"
        }
    }
    </script>

    <?php if (!empty($subFaqs)): ?>
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "FAQPage",
        "mainEntity": [
            <?php
            $faqJson = [];
            foreach ($subFaqs as $item) {
                $faqJson[] = '{"@type":"Question","name":"' . addslashes($item['question']) . '","acceptedAnswer":{"@type":"Answer","text":"' . addslashes(strip_tags($item['answer'])) . '"}}';
            }
            echo implode(',', $faqJson);
            ?>
        ]
    }
    </script>
    <?php endif; ?>

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
