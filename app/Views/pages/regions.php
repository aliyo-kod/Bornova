<?php
/**
 * Regions/Areas Page
 * Shows all areas where services are available
 */
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bölgeler - <?= e($site['name']) ?></title>
    <meta name="description" content="Bornova ve çevresindeki tüm bölgelere hizmet vermekteyiz. Detaylar için tıklayın.">
    <meta name="keywords" content="bölgeler, bornova, izmir, hizmet alanı, bölge detayları">

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
        .regions-section { padding: 60px 0; }
        .regions-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px; }
        .region-card { background: var(--color-white); border: 1px solid var(--color-gray-200); border-radius: 12px; padding: 28px; text-align: center; transition: all 0.3s ease; }
        .region-card:hover { box-shadow: 0 8px 24px rgba(15,31,61,0.12); border-color: var(--color-blue-300); transform: translateY(-4px); }
        .region-card__icon { font-size: 2.5rem; margin-bottom: 16px; }
        .region-card__name { font-size: 1.2rem; font-weight: 700; color: var(--color-navy-900); margin-bottom: 12px; }
        .region-card__desc { font-size: 0.95rem; color: var(--color-text-body); line-height: 1.6; margin-bottom: 20px; }
        .region-card__link { display: inline-block; padding: 10px 24px; background: var(--color-blue-600); color: var(--color-white); text-decoration: none; border-radius: 6px; font-weight: 600; transition: background 0.2s ease; }
        .region-card__link:hover { background: var(--color-blue-700); }
        .regions-info { background: var(--color-blue-50); border-radius: 12px; padding: 40px; text-align: center; margin-bottom: 60px; }
        .regions-info h2 { font-size: 1.8rem; margin-bottom: 16px; color: var(--color-navy-900); }
        .regions-info p { font-size: 1.05rem; color: var(--color-text-body); margin: 0; }
        @media (max-width: 1199px) {
            .regions-grid { grid-template-columns: repeat(2, 1fr); }
        }
        @media (max-width: 1023px) {
            .page-header__title { font-size: 2rem; }
        }
        @media (max-width: 767px) {
            .page-header { padding: 40px 0; }
            .page-header__title { font-size: 1.5rem; }
            .regions-grid { grid-template-columns: 1fr; }
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
                <span>Bölgeler</span>
            </nav>
        </div>
    </section>

    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <h1 class="page-header__title">Bölgeler</h1>
            <p class="page-header__subtitle">Bornova ve çevresindeki tüm bölgelere 24/7 hizmet vermekteyiz</p>
        </div>
    </section>

    <!-- Regions Section -->
    <section class="regions-section container">
        <div class="regions-info">
            <h2>Hizmet Alanlarımız</h2>
            <p>Bornova ve çevresinde yaşayan tüm müşterilerimize profesyonel su kaçağı tespiti, tıkanıklık açma, tesisat kurulumu ve kombi servis hizmetleri sunmaktayız.</p>
        </div>

        <div class="regions-grid">
            <?php
            $regions = [
                ['name' => 'Bornova Merkez', 'desc' => 'Bornova\'nın merkez mahallelerine hızlı hizmet', 'icon' => '🏘️'],
                ['name' => 'Alsancak', 'desc' => 'Alsancak bölgesinde kesintisiz hizmet', 'icon' => '🏛️'],
                ['name' => 'Alsağ', 'desc' => 'Alsağ mahallelerinde profesyonel çözüm', 'icon' => '🏘️'],
                ['name' => 'Narlıdere', 'desc' => 'Narlıdere bölgesine acil hizmet', 'icon' => '🌳'],
                ['name' => 'Karşıyaka', 'desc' => 'Karşıyaka\'da hızlı yanıt garantili', 'icon' => '🌊'],
                ['name' => 'Çeşme', 'desc' => 'Çeşme ve çevresine tam hizmet', 'icon' => '⛱️'],
                ['name' => 'Balçova', 'desc' => 'Balçova\'da 24 saat hizmet aktif', 'icon' => '🏘️'],
                ['name' => 'Konak', 'desc' => 'Konak merkeze yakın hızlı ulaşım', 'icon' => '🏙️'],
                ['name' => 'Ödemiş', 'desc' => 'Ödemiş bölgesine uzun mesafe hizmet', 'icon' => '🌾'],
            ];

            foreach ($regions as $region):
            ?>
            <div class="region-card">
                <div class="region-card__icon"><?= $region['icon'] ?></div>
                <h3 class="region-card__name"><?= e($region['name']) ?></h3>
                <p class="region-card__desc"><?= e($region['desc']) ?></p>
                <a href="tel:<?= e(str_replace(' ', '', $site['phone'])) ?>" class="region-card__link">Hızlı Arayın</a>
            </div>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- Schema.org Markup -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "LocalBusiness",
        "name": "<?= e($site['name']) ?>",
        "url": "<?= e($site['url'] ?? 'https://izmirkacaksutespiti.com') ?>/bolgeler",
        "telephone": "<?= e($site['phone']) ?>",
        "areaServed": {
            "@type": "State",
            "name": "İzmir"
        }
    }
    </script>

    <?php require __DIR__ . '/../layouts/footer.php'; ?>

    <script src="/assets/vendor/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="/assets/js/modules/nav.js"></script>
</body>
</html>
