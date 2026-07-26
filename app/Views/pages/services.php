<?php
/**
 * Services Listing Page
 * Displays all main service categories with their subcategories
 */
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hizmetler - <?= e($site['name']) ?></title>
    <meta name="description" content="Su kaçağı tespiti, tıkanıklık açma, tesisat kurulumu ve kombi/petek servis hizmetlerimiz hakkında bilgi alın.">
    <meta name="keywords" content="hizmetler, su kaçağı, tıkanıklık, tesisat, kombi, petek, servis">

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
        .services-section { padding: 60px 0; }
        .service-card { background: var(--color-white); border: 1px solid var(--color-gray-200); border-radius: 12px; overflow: hidden; transition: all 0.3s ease; }
        .service-card:hover { box-shadow: 0 12px 32px rgba(15,31,61,0.15); border-color: var(--color-blue-300); transform: translateY(-6px); }
        .service-card__header { padding: 32px 28px; background: linear-gradient(135deg, var(--color-blue-50) 0%, var(--color-blue-100) 100%); display: flex; align-items: flex-start; justify-content: space-between; }
        .service-card__title { font-size: 1.5rem; font-weight: 800; color: var(--color-navy-900); margin: 0; }
        .service-card__icon { font-size: 2rem; }
        .service-card__content { padding: 28px; }
        .service-card__description { color: var(--color-text-body); margin-bottom: 24px; line-height: 1.6; }
        .service-subcats { display: flex; flex-direction: column; gap: 12px; margin-bottom: 24px; }
        .service-subcat { padding: 12px 16px; background: var(--color-gray-50); border-radius: 6px; transition: all 0.2s ease; }
        .service-subcat a { color: var(--color-blue-600); text-decoration: none; font-weight: 600; display: flex; justify-content: space-between; align-items: center; }
        .service-subcat a:hover { color: var(--color-blue-700); }
        .service-subcat a::after { content: '→'; font-weight: 700; }
        .service-subcat:hover { background: var(--color-blue-50); }
        .service-card__cta { display: inline-block; padding: 12px 28px; background: var(--color-blue-600); color: var(--color-white); text-decoration: none; border-radius: 8px; font-weight: 600; transition: background 0.2s ease; }
        .service-card__cta:hover { background: var(--color-blue-700); }
        .color-blue { border-top: 4px solid var(--color-blue-600); }
        .color-blue .service-card__header { background: linear-gradient(135deg, #e0ebf7 0%, #c5dcf0 100%); }
        .color-green { border-top: 4px solid #1fa35b; }
        .color-green .service-card__header { background: linear-gradient(135deg, #e8f5e9 0%, #c8e6c9 100%); }
        .color-orange { border-top: 4px solid #f2892e; }
        .color-orange .service-card__header { background: linear-gradient(135deg, #fff3e0 0%, #ffe0b2 100%); }
        .color-purple { border-top: 4px solid #7c4fd6; }
        .color-purple .service-card__header { background: linear-gradient(135deg, #f3e5f5 0%, #e1bee7 100%); }
        .services-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 32px; margin-top: 40px; }
        @media (max-width: 1023px) {
            .services-grid { grid-template-columns: 1fr; }
            .page-header__title { font-size: 2rem; }
            .service-card__header { flex-direction: column; }
            .service-card__icon { font-size: 1.5rem; margin-top: 12px; }
        }
        @media (max-width: 767px) {
            .page-header { padding: 40px 0; }
            .page-header__title { font-size: 1.5rem; }
            .service-card__header { padding: 24px; }
            .service-card__content { padding: 20px; }
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
                <span>Hizmetler</span>
            </nav>
        </div>
    </section>

    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <h1 class="page-header__title">Hizmetlerimiz</h1>
            <p class="page-header__subtitle">Bornova bölgesinde su kaçağı tespiti, tıkanıklık açma, tesisat kurulumu ve kombi servis hizmetleri</p>
        </div>
    </section>

    <!-- Services Grid -->
    <section class="services-section container">
        <div class="services-grid">
            <?php foreach ($services as $service): ?>
            <div class="service-card color-<?= e($service['color']) ?>">
                <div class="service-card__header">
                    <div>
                        <h2 class="service-card__title"><?= e($service['name']) ?></h2>
                    </div>
                    <div class="service-card__icon"><?php
                        $icons = [
                            'su-kacagi-tespiti' => '🔍',
                            'tikaniklik-acma' => '🛠️',
                            'tesisat-kurulumu' => '💧',
                            'petek-kombi' => '🔥'
                        ];
                        echo $icons[$service['slug']] ?? '💼';
                    ?></div>
                </div>
                <div class="service-card__content">
                    <p class="service-card__description"><?= e($service['description']) ?></p>
                    <div class="service-subcats">
                        <?php
                        $subcats = $serviceSubcategories[$service['slug']] ?? [];
                        foreach (array_slice($subcats, 0, 4) as $subcat):
                        ?>
                        <div class="service-subcat">
                            <a href="/hizmet/<?= e($service['slug']) ?>/<?= e($subcat['slug']) ?>"><?= e($subcat['title']) ?></a>
                        </div>
                        <?php endforeach;
                        if (count($subcats) > 4):
                        ?>
                        <div class="service-subcat">
                            <a href="/hizmet/<?= e($service['slug']) ?>">+<?= count($subcats) - 4 ?> daha...</a>
                        </div>
                        <?php endif; ?>
                    </div>
                    <a href="/hizmet/<?= e($service['slug']) ?>" class="service-card__cta">Tüm Hizmetleri Gör</a>
                </div>
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
        "url": "<?= e($site['url'] ?? 'https://izmirkacaksutespiti.com') ?>/hizmetler",
        "telephone": "<?= e($site['phone']) ?>",
        "hasOfferCatalog": {
            "@type": "OfferCatalog",
            "name": "Hizmetler",
            "itemListElement": [
                <?php
                $catalogs = [];
                foreach ($services as $service) {
                    $catalogs[] = '{"@type":"Offer","name":"' . addslashes($service['name']) . '","description":"' . addslashes($service['description']) . '"}';
                }
                echo implode(',', $catalogs);
                ?>
            ]
        }
    }
    </script>

    <?php require __DIR__ . '/../layouts/footer.php'; ?>

    <script src="/assets/vendor/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="/assets/js/modules/nav.js"></script>
</body>
</html>
