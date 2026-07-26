<?php
/**
 * About Page
 * Information about the business, company history, values, and team
 */
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hakkımızda - <?= e($site['name']) ?></title>
    <meta name="description" content="Bornova Su Kaçak Tespiti hakkında bilgi. 10+ yıl deneyim, profesyonel ekip, garantili hizmet.">
    <meta name="keywords" content="hakkımızda, kurumsal, bornova, su kaçağı, profesyonel">

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
        .content-section { padding: 60px 0; }
        .content-wrap { display: grid; grid-template-columns: 1fr 300px; gap: 40px; }
        .content-main { font-size: 1.05rem; line-height: 1.8; color: var(--color-text-body); }
        .content-main h2 { font-size: 2rem; margin-top: 40px; margin-bottom: 20px; color: var(--color-navy-900); }
        .content-main h3 { font-size: 1.5rem; margin-top: 32px; margin-bottom: 16px; color: var(--color-navy-900); }
        .content-main p { margin-bottom: 16px; }
        .content-main ul { margin-bottom: 16px; padding-left: 24px; }
        .content-main li { margin-bottom: 12px; }
        .stats { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; margin: 40px 0; }
        .stat-card { background: var(--color-blue-50); border: 1px solid var(--color-blue-200); border-radius: 12px; padding: 24px; text-align: center; }
        .stat-card__number { font-size: 2.5rem; font-weight: 800; color: var(--color-blue-600); }
        .stat-card__label { font-size: 0.95rem; color: var(--color-text-body); margin-top: 8px; }
        .values { display: grid; grid-template-columns: repeat(2, 1fr); gap: 24px; margin: 32px 0; }
        .value-item { background: var(--color-white); border: 1px solid var(--color-gray-200); border-radius: 12px; padding: 24px; }
        .value-item__icon { font-size: 2rem; margin-bottom: 12px; }
        .value-item__title { font-size: 1.1rem; font-weight: 700; margin-bottom: 8px; color: var(--color-navy-900); }
        .value-item__text { font-size: 0.95rem; color: var(--color-text-body); margin: 0; }
        .team { display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px; margin: 32px 0; }
        .team-member { text-align: center; }
        .team-member__avatar { width: 120px; height: 120px; border-radius: 50%; background: linear-gradient(135deg, var(--color-blue-400) 0%, var(--color-blue-600) 100%); display: flex; align-items: center; justify-content: center; color: var(--color-white); font-size: 3rem; margin: 0 auto 16px; }
        .team-member__name { font-size: 1.1rem; font-weight: 700; color: var(--color-navy-900); margin-bottom: 4px; }
        .team-member__role { font-size: 0.95rem; color: var(--color-gray-600); }
        .content-sidebar { padding-top: 20px; }
        .sidebar-widget { background: var(--color-gray-50); border-radius: 12px; padding: 24px; margin-bottom: 24px; }
        .sidebar-widget h3 { font-size: 1.1rem; font-weight: 700; margin-bottom: 16px; color: var(--color-navy-900); }
        .sidebar-widget p { margin: 0; font-size: 0.95rem; color: var(--color-text-body); }
        .sidebar-widget .cta-btn { display: inline-block; margin-top: 16px; padding: 12px 24px; background: var(--color-blue-600); color: var(--color-white); text-decoration: none; border-radius: 8px; font-weight: 600; transition: background 0.2s ease; }
        .sidebar-widget .cta-btn:hover { background: var(--color-blue-700); }
        @media (max-width: 1023px) {
            .content-wrap { grid-template-columns: 1fr; }
            .content-sidebar { display: none; }
            .page-header__title { font-size: 2rem; }
            .stats { grid-template-columns: repeat(2, 1fr); }
            .values { grid-template-columns: 1fr; }
            .team { grid-template-columns: repeat(2, 1fr); }
        }
        @media (max-width: 767px) {
            .page-header { padding: 40px 0; }
            .page-header__title { font-size: 1.5rem; }
            .stats { grid-template-columns: 1fr; }
            .team { grid-template-columns: 1fr; }
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
                <span>Hakkımızda</span>
            </nav>
        </div>
    </section>

    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <h1 class="page-header__title">Bornova Su Kaçak Tespiti</h1>
            <p class="page-header__subtitle">Profesyonel, Güvenilir ve Garantili Su Kaçağı Tespit ve Tesisat Hizmetleri</p>
        </div>
    </section>

    <!-- Content -->
    <section class="content-section">
        <div class="container">
            <div class="content-wrap">
                <article class="content-main">
                    <h2>Biz Kimiz?</h2>
                    <p>Bornova Su Kaçak Tespiti, 10+ yıldır Bornova bölgesinde su kaçağı tespiti, tıkanıklık açma, tesisat kurulumu ve kombi servis hizmetleri sunan profesyonel bir işletmedir. Müşteri memnuniyeti ve kaliteli hizmet anlayışıyla hareket ediyoruz.</p>

                    <h3>Misyonumuz</h3>
                    <p>Bornova bölgesinde yaşayan ve çalışan insanların tesisat sorunlarını, en kısa sürede, en uygun fiyatla ve en yüksek kalite standartlarında çözmek.</p>

                    <h3>Vizyonumuz</h3>
                    <p>Türkiye'nin en güvenilir ve kapsamlı tesisat hizmet sağlayıcısı olmak. Müşteri referansları ve tavsiyeler sayesinde büyümeye devam etmek.</p>

                    <!-- Stats -->
                    <div class="stats">
                        <div class="stat-card">
                            <div class="stat-card__number">10+</div>
                            <div class="stat-card__label">Yıl Deneyim</div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-card__number">5000+</div>
                            <div class="stat-card__label">Müşteri</div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-card__number">24/7</div>
                            <div class="stat-card__label">Hizmet</div>
                        </div>
                    </div>

                    <h2>Neden Bizi Seçmelisiniz?</h2>

                    <!-- Values -->
                    <div class="values">
                        <div class="value-item">
                            <div class="value-item__icon">⚡</div>
                            <div class="value-item__title">Hızlı Hizmet</div>
                            <p class="value-item__text">Acil durumlarda 30 dakika içinde kapınıza ulaşabiliyoruz</p>
                        </div>
                        <div class="value-item">
                            <div class="value-item__icon">✓</div>
                            <div class="value-item__title">Garantili Çalışma</div>
                            <p class="value-item__text">Tüm işlerimize yazılı garanti veriyor ve sonrası desteği sağlıyoruz</p>
                        </div>
                        <div class="value-item">
                            <div class="value-item__icon">💰</div>
                            <div class="value-item__title">Rekabetçi Fiyatlar</div>
                            <p class="value-item__text">Aynı kalitede daha uygun fiyatlar sunar, malzeme masrafında iskonto yaparız</p>
                        </div>
                        <div class="value-item">
                            <div class="value-item__icon">🛠️</div>
                            <div class="value-item__title">Profesyonel Ekip</div>
                            <p class="value-item__text">Deneyimli ve sertifikalı teknisyenler, düzenli eğitim alıyorlar</p>
                        </div>
                        <div class="value-item">
                            <div class="value-item__icon">📱</div>
                            <div class="value-item__title">Kolay İletişim</div>
                            <p class="value-item__text">Telefonla, WhatsApp'la veya form aracılığıyla iletişim kurabilirsiniz</p>
                        </div>
                        <div class="value-item">
                            <div class="value-item__icon">🔧</div>
                            <div class="value-item__title">Modern Teknoloji</div>
                            <p class="value-item__text">Termal kamera, akustik dinleme, CCTV kamera ve diğer modern cihazları kullanıyoruz</p>
                        </div>
                    </div>

                    <h2>Ekibimiz</h2>
                    <p>Deneyimli ve profesyonel teknisyenlerden oluşan ekibimiz, her zaman müşteri memnuniyeti için çalışmaktadır.</p>

                    <div class="team">
                        <div class="team-member">
                            <div class="team-member__avatar">👨</div>
                            <div class="team-member__name">Ali Yılmaz</div>
                            <div class="team-member__role">Kurucusu & Müdürü</div>
                        </div>
                        <div class="team-member">
                            <div class="team-member__avatar">👨</div>
                            <div class="team-member__name">Mehmet Koç</div>
                            <div class="team-member__role">Baş Teknisyen</div>
                        </div>
                        <div class="team-member">
                            <div class="team-member__avatar">👨</div>
                            <div class="team-member__name">Şaban Demir</div>
                            <div class="team-member__role">Teknisyen</div>
                        </div>
                    </div>

                    <h2>Sertifikalar ve Lisanslar</h2>
                    <ul>
                        <li>İSO 9001:2015 Kalite Yönetim Belgesi</li>
                        <li>Bornova Ticaret Odası Kayıtlı İşletme</li>
                        <li>SGK'ya Kayıtlı Çalışan Sosyal Sigortaları</li>
                        <li>Müşteri Hizmeti Eğitim Sertifikaları</li>
                    </ul>
                </article>

                <!-- Sidebar -->
                <aside class="content-sidebar">
                    <!-- Contact Widget -->
                    <div class="sidebar-widget">
                        <h3>Hemen İletişim Kurun</h3>
                        <p><?= e($site['tagline']) ?></p>
                        <p style="margin-top: 12px; font-size: 1.2rem; font-weight: 700; color: var(--color-blue-600);"><?= e($site['phone']) ?></p>
                        <a href="tel:<?= e(str_replace(' ', '', $site['phone'])) ?>" class="cta-btn">Ara</a>
                    </div>

                    <!-- Services Widget -->
                    <div class="sidebar-widget">
                        <h3>Hizmetlerimiz</h3>
                        <div style="display: flex; flex-direction: column; gap: 12px;">
                            <?php foreach ($services as $service): ?>
                            <a href="/hizmet/<?= e($service['slug']) ?>" style="color: var(--color-blue-600); text-decoration: none; font-weight: 600; transition: color 0.2s ease;" onmouseover="this.style.color='var(--color-blue-700)'" onmouseout="this.style.color='var(--color-blue-600)'"><?= e($service['name']) ?></a>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <!-- Hours Widget -->
                    <div class="sidebar-widget">
                        <h3>Çalışma Saatleri</h3>
                        <p><strong>Pazartesi - Cuma:</strong> 08:00 - 18:00</p>
                        <p><strong>Cumartesi:</strong> 10:00 - 14:00</p>
                        <p><strong>Pazar & Tatil:</strong> Açık (Acil Durum)</p>
                    </div>
                </aside>
            </div>
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
        "description": "10+ yıldır Bornova bölgesinde su kaçağı tespiti, tıkanıklık açma ve tesisat hizmetleri",
        "areaServed": {
            "@type": "City",
            "name": "Bornova"
        },
        "foundingDate": "2014",
        "openingHoursSpecification": [
            {
                "@type": "OpeningHoursSpecification",
                "dayOfWeek": ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday"],
                "opens": "08:00",
                "closes": "18:00"
            },
            {
                "@type": "OpeningHoursSpecification",
                "dayOfWeek": "Saturday",
                "opens": "10:00",
                "closes": "14:00"
            }
        ]
    }
    </script>

    <?php require __DIR__ . '/../layouts/footer.php'; ?>

    <script src="/assets/vendor/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="/assets/js/modules/nav.js"></script>
</body>
</html>
