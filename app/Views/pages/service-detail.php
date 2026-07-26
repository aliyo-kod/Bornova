<?php
/**
 * Service Detail Page
 * Displays single service with subcategories, FAQ, related posts, and schema markup
 */
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($service['name']) ?> - <?= e($site['name']) ?></title>
    <meta name="description" content="<?= e(substr($service['description'], 0, 155)) ?>">
    <meta name="keywords" content="<?= e($service['keywords'] ?? '') ?>">
    <meta property="og:title" content="<?= e($service['name']) ?>">
    <meta property="og:description" content="<?= e(substr($service['description'], 0, 155)) ?>">
    <meta property="og:type" content="website">

    <link rel="stylesheet" href="/assets/vendor/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/main.css">
    <style>
        .breadcrumb-section { background: var(--color-gray-50); padding: 20px 0; margin-top: calc(var(--topbar-height) + var(--header-height)); }
        .breadcrumb { display: flex; gap: 8px; align-items: center; font-size: 0.95rem; flex-wrap: wrap; }
        .breadcrumb a { color: var(--color-blue-600); text-decoration: none; }
        .breadcrumb a:hover { text-decoration: underline; }
        .breadcrumb__sep { color: var(--color-gray-400); }
        .service-hero { background: linear-gradient(135deg, var(--color-navy-900) 0%, #1a3a5c 100%); color: var(--color-white); padding: 80px 0; text-align: center; }
        .service-hero__title { font-size: 2.8rem; font-weight: 800; line-height: 1.2; margin-bottom: 16px; }
        .service-hero__subtitle { font-size: 1.1rem; opacity: 0.9; max-width: 600px; margin: 0 auto; }
        .subcategories-section { padding: 60px 0; }
        .subcategories-section h2 { font-size: 2rem; font-weight: 800; margin-bottom: 40px; color: var(--color-navy-900); text-align: center; }
        .subcategories-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px; margin-bottom: 60px; }
        .subcat-card { background: var(--color-white); border: 1px solid var(--color-gray-200); border-radius: 12px; overflow: hidden; transition: all 0.3s ease; }
        .subcat-card:hover { box-shadow: 0 8px 24px rgba(15,31,61,0.12); border-color: var(--color-blue-300); transform: translateY(-4px); }
        .subcat-card__content { padding: 28px 24px; }
        .subcat-card__icon { width: 48px; height: 48px; background: var(--color-blue-100); border-radius: 8px; display: flex; align-items: center; justify-content: center; margin-bottom: 16px; color: var(--color-blue-600); font-size: 1.5rem; }
        .subcat-card__title { font-size: 1.15rem; font-weight: 700; margin-bottom: 12px; color: var(--color-navy-900); }
        .subcat-card__link { display: inline-block; color: var(--color-blue-600); text-decoration: none; font-weight: 600; transition: all 0.2s ease; }
        .subcat-card__link:hover { color: var(--color-blue-700); transform: translateX(4px); }
        .subcat-card__link::after { content: ' →'; }

        .content-section { background: var(--color-white); padding: 60px 0; }
        .content-wrap { display: grid; grid-template-columns: 1fr 300px; gap: 40px; }
        .content-main { font-size: 1.05rem; line-height: 1.8; color: var(--color-text-body); }
        .content-main h3 { font-size: 1.6rem; margin-top: 32px; margin-bottom: 16px; color: var(--color-navy-900); }
        .content-main p { margin-bottom: 16px; }
        .content-main ul { margin-bottom: 16px; padding-left: 24px; }
        .content-main li { margin-bottom: 8px; }
        .content-sidebar { padding-top: 20px; }
        .sidebar-widget { background: var(--color-gray-50); border-radius: 12px; padding: 24px; margin-bottom: 24px; }
        .sidebar-widget h3 { font-size: 1.1rem; font-weight: 700; margin-bottom: 16px; color: var(--color-navy-900); }
        .sidebar-widget p { margin: 0; font-size: 0.95rem; color: var(--color-text-body); }
        .sidebar-widget .cta-btn { display: inline-block; margin-top: 16px; padding: 12px 24px; background: var(--color-blue-600); color: var(--color-white); text-decoration: none; border-radius: 8px; font-weight: 600; transition: background 0.2s ease; }
        .sidebar-widget .cta-btn:hover { background: var(--color-blue-700); }
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
        .cta-section { background: linear-gradient(135deg, var(--color-blue-600) 0%, #1e5fa8 100%); color: var(--color-white); padding: 60px 0; text-align: center; margin: 60px 0; }
        .cta-section h2 { font-size: 2rem; margin-bottom: 24px; }
        .cta-section p { font-size: 1.1rem; margin-bottom: 32px; opacity: 0.95; }
        .cta-btn-group { display: flex; gap: 16px; justify-content: center; flex-wrap: wrap; }
        .cta-btn-primary { padding: 14px 32px; background: var(--color-white); color: var(--color-blue-600); text-decoration: none; border-radius: 8px; font-weight: 700; transition: all 0.2s ease; }
        .cta-btn-primary:hover { transform: scale(1.05); box-shadow: 0 8px 24px rgba(0,0,0,0.15); }
        .cta-btn-secondary { padding: 14px 32px; background: rgba(255,255,255,0.2); color: var(--color-white); text-decoration: none; border-radius: 8px; font-weight: 700; border: 2px solid var(--color-white); transition: all 0.2s ease; }
        .cta-btn-secondary:hover { background: rgba(255,255,255,0.3); }
        @media (max-width: 1023px) {
            .content-wrap { grid-template-columns: 1fr; }
            .content-sidebar { display: none; }
            .subcategories-grid { grid-template-columns: repeat(2, 1fr); }
            .service-hero__title { font-size: 2rem; }
            .cta-btn-group { flex-direction: column; }
            .cta-btn-primary, .cta-btn-secondary { width: 100%; }
        }
        @media (max-width: 767px) {
            .subcategories-grid { grid-template-columns: 1fr; }
            .service-hero { padding: 40px 0; }
            .service-hero__title { font-size: 1.5rem; }
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
                <span><?= e($service['name']) ?></span>
            </nav>
        </div>
    </section>

    <!-- Service Hero -->
    <section class="service-hero">
        <div class="container">
            <h1 class="service-hero__title"><?= e($service['name']) ?></h1>
            <p class="service-hero__subtitle"><?= e($service['description']) ?></p>
        </div>
    </section>

    <!-- Subcategories Section -->
    <section class="subcategories-section container">
        <h2>Hizmet Alanlarımız</h2>
        <div class="subcategories-grid">
            <?php foreach ($subcategories as $idx => $subcat): ?>
            <div class="subcat-card">
                <div class="subcat-card__content">
                    <div class="subcat-card__icon">
                        <?php
                        $icons = ['🔍', '🛠️', '💧', '🔧', '🚰', '📹'];
                        echo $icons[$idx % 6];
                        ?>
                    </div>
                    <h3 class="subcat-card__title"><?= e($subcat['title']) ?></h3>
                    <a href="/hizmet/<?= e($slug) ?>/<?= e($subcat['slug']) ?>" class="subcat-card__link">Detayları Gör</a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- Content Section -->
    <section class="content-section">
        <div class="container">
            <div class="content-wrap">
                <article class="content-main">
                    <h2><?= e($service['name']) ?> Nedir?</h2>
                    <p><?= e($service['description']) ?></p>
                    <p>Bornova bölgesinde <?= strtolower(e($service['name'])) ?> hizmetleri sunmaktayız. Profesyonel ekibimiz, modern teknoloji ve deneyim ile en iyi hizmeti sağlamaktadır.</p>

                    <h3>Neden Bizi Tercih Etmelisiniz?</h3>
                    <ul>
                        <li><strong>24/7 Hizmet:</strong> Acil durumlarda kapınıza hızlı şekilde ulaşabiliyoruz</li>
                        <li><strong>Profesyonel Ekip:</strong> Deneyimli ve sertifikalı teknisyenlerimiz</li>
                        <li><strong>Garantili Çalışma:</strong> Tüm işlerimize garantisi bulunmaktadır</li>
                        <li><strong>Rekabetçi Fiyatlar:</strong> Pazar fiyatının altında kaliteli hizmet</li>
                        <li><strong>Modern Teknoloji:</strong> En güncel cihaz ve yöntemler kullanıyoruz</li>
                    </ul>

                    <h3>Nasıl Hizmet Alabilirsiniz?</h3>
                    <ol>
                        <li>Bize telefonla veya WhatsApp üzerinden ulaşın</li>
                        <li>Sorununuzu açıklayın ve uygun saati belirleyin</li>
                        <li>Ekibimiz belirlenen saatte sizde olur</li>
                        <li>Sorununuzu hızlı ve profesyonel şekilde çözeriz</li>
                    </ol>
                </article>

                <!-- Sidebar -->
                <aside class="content-sidebar">
                    <!-- Quick Contact Widget -->
                    <div class="sidebar-widget">
                        <h3>Hızlı İletişim</h3>
                        <p><?= e($site['tagline'] ?? 'Kaliteli ve güvenilir hizmet') ?></p>
                        <p style="margin-top: 12px; font-size: 1.2rem; font-weight: 700; color: var(--color-blue-600);"><?= e($site['phone']) ?></p>
                        <a href="tel:<?= e(str_replace(' ', '', $site['phone'])) ?>" class="cta-btn">Ara</a>
                    </div>

                    <!-- Related Services Widget -->
                    <div class="sidebar-widget">
                        <h3>Diğer Hizmetler</h3>
                        <div style="display: flex; flex-direction: column; gap: 12px;">
                            <?php foreach (array_slice($services, 0, 3) as $relService): ?>
                                <?php if ($relService['slug'] !== $slug): ?>
                                <a href="/hizmet/<?= e($relService['slug']) ?>" style="color: var(--color-blue-600); text-decoration: none; font-weight: 600; transition: color 0.2s ease;" onmouseover="this.style.color='var(--color-blue-700)'" onmouseout="this.style.color='var(--color-blue-600)'"><?= e($relService['name']) ?></a>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <!-- Service Info Widget -->
                    <div class="sidebar-widget">
                        <h3>Hizmet Alanlarımız</h3>
                        <p>Bornova'nın tüm mahallelerine hizmet vermekteyiz. Ayrıntılı bilgi için <a href="/bolgeler" style="color: var(--color-blue-600); font-weight: 600;">bölgeler sayfasını</a> ziyaret edin.</p>
                    </div>
                </aside>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="container faq-section">
        <h2>Sık Sorulan Sorular</h2>
        <div class="accordion">
            <?php
            $serviceFaqs = [];
            foreach ($faqs as $faq) {
                if (strpos(strtolower($faq['question']), strtolower(preg_replace('/[^a-z0-9]/', '', $service['name']))) !== false) {
                    $serviceFaqs[] = $faq;
                }
            }
            if (empty($serviceFaqs)) {
                $serviceFaqs = array_slice($faqs, 0, 4);
            }
            foreach ($serviceFaqs as $idx => $faqItem):
            ?>
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

    <!-- CTA Section -->
    <section class="cta-section container">
        <h2>Hemen Çözüm Alın</h2>
        <p><?= e($service['name']) ?> konusunda sorunu yaşıyor musunuz? Bize ulaşın ve en kısa sürede çözüm alalım.</p>
        <div class="cta-btn-group">
            <a href="tel:<?= e(str_replace(' ', '', $site['phone'])) ?>" class="cta-btn-primary">Telefonla Arayın</a>
            <a href="https://wa.me/<?= e(str_replace([' ', '(', ')', '-', '+'], '', $site['phone'])) ?>" target="_blank" class="cta-btn-secondary">WhatsApp Yazın</a>
        </div>
    </section>

    <!-- Schema.org Markup -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "LocalBusiness",
        "name": "<?= e($site['name']) ?>",
        "url": "<?= e($site['url'] ?? 'https://izmirkacaksutespiti.com') ?>",
        "telephone": "<?= e($site['phone']) ?>",
        "address": {
            "@type": "PostalAddress",
            "streetAddress": "<?= e($site['address'] ?? 'Bornova, İzmir') ?>",
            "addressLocality": "Bornova",
            "addressRegion": "İzmir",
            "postalCode": "35000",
            "addressCountry": "TR"
        },
        "description": "<?= e($service['name']) ?>",
        "areaServed": {
            "@type": "City",
            "name": "Bornova"
        }
    }
    </script>

    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "FAQPage",
        "mainEntity": [
            <?php
            $faqJson = [];
            foreach ($serviceFaqs as $item) {
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
