<?php
/**
 * Reviews Page
 * Display all customer reviews and testimonials
 */
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Müşteri Yorumları - <?= e($site['name']) ?></title>
    <meta name="description" content="Bornova Su Kaçak Tespiti müşterilerinin gerçek yorumlarını ve deneyimlerini okuyun.">
    <meta name="keywords" content="yorumlar, müşteri yorumları, referanslar, deneyimler, değerlendirmeler">

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
        .reviews-section { padding: 60px 0; }
        .reviews-intro { background: var(--color-blue-50); border-radius: 12px; padding: 40px; margin-bottom: 60px; text-align: center; }
        .reviews-intro h2 { font-size: 1.8rem; margin-bottom: 16px; color: var(--color-navy-900); }
        .reviews-intro p { font-size: 1.05rem; color: var(--color-text-body); margin: 0; }
        .reviews-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 24px; }
        .review-card { background: var(--color-white); border: 1px solid var(--color-gray-200); border-radius: 12px; padding: 28px; }
        .review-card:hover { box-shadow: 0 8px 24px rgba(15,31,61,0.12); }
        .review-header { display: flex; align-items: center; gap: 16px; margin-bottom: 16px; }
        .review-avatar { width: 60px; height: 60px; border-radius: 50%; background: linear-gradient(135deg, var(--color-blue-400) 0%, var(--color-blue-600) 100%); display: flex; align-items: center; justify-content: center; color: var(--color-white); font-weight: 700; font-size: 1.5rem; flex-shrink: 0; }
        .review-info h3 { margin: 0 0 4px 0; font-size: 1.1rem; color: var(--color-navy-900); }
        .review-info p { margin: 0; font-size: 0.85rem; color: var(--color-gray-600); }
        .review-rating { display: flex; gap: 4px; margin-bottom: 12px; }
        .review-star { color: #ffc107; font-size: 1.1rem; }
        .review-text { font-size: 0.95rem; line-height: 1.6; color: var(--color-text-body); }
        .review-text::before { content: '"'; font-size: 2rem; color: var(--color-blue-200); margin-right: 4px; }
        .review-text::after { content: '"'; font-size: 2rem; color: var(--color-blue-200); margin-left: 4px; }
        .cta-section { background: linear-gradient(135deg, var(--color-blue-600) 0%, #1e5fa8 100%); color: var(--color-white); padding: 40px; border-radius: 12px; text-align: center; margin-top: 60px; }
        .cta-section h3 { margin-top: 0; margin-bottom: 16px; font-size: 1.5rem; }
        .cta-section p { margin-bottom: 24px; }
        .cta-btn { display: inline-block; padding: 14px 32px; background: var(--color-white); color: var(--color-blue-600); text-decoration: none; border-radius: 8px; font-weight: 700; transition: all 0.2s ease; }
        .cta-btn:hover { transform: scale(1.05); }
        .no-reviews { text-align: center; padding: 60px 0; }
        .no-reviews__title { font-size: 1.5rem; font-weight: 700; margin-bottom: 16px; color: var(--color-navy-900); }
        .no-reviews__text { color: var(--color-gray-600); }
        @media (max-width: 1023px) {
            .reviews-grid { grid-template-columns: 1fr; }
            .page-header__title { font-size: 2rem; }
        }
        @media (max-width: 767px) {
            .page-header { padding: 40px 0; }
            .page-header__title { font-size: 1.5rem; }
            .reviews-intro { padding: 24px; }
            .review-card { padding: 20px; }
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
                <span>Müşteri Yorumları</span>
            </nav>
        </div>
    </section>

    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <h1 class="page-header__title">Müşteri Yorumları</h1>
            <p class="page-header__subtitle">Bizden hizmet alan müşterilerimizin gerçek deneyimleri ve değerlendirmeleri</p>
        </div>
    </section>

    <!-- Reviews Section -->
    <section class="reviews-section container">
        <div class="reviews-intro">
            <h2>Müşteri Memnuniyeti Bizim Önceliğimiz</h2>
            <p>Bornova Su Kaçak Tespiti olarak 10+ yıldır binlerce müşterimizi memnun ettik. Aşağıdaki yorumlar bizim kalitesi ve profesyonelliğimizin kanıtıdır.</p>
        </div>

        <?php if (!empty($reviews)): ?>
        <div class="reviews-grid">
            <?php foreach ($reviews as $review): ?>
            <div class="review-card">
                <div class="review-header">
                    <div class="review-avatar"><?= substr($review['name'] ?? 'M', 0, 1) ?></div>
                    <div class="review-info">
                        <h3><?= e($review['name'] ?? 'Müşteri') ?></h3>
                        <p><?= e($review['service'] ?? 'Hizmet') ?></p>
                    </div>
                </div>
                <div class="review-rating">
                    <?php
                    $rating = $review['rating'] ?? 5;
                    for ($i = 0; $i < 5; $i++):
                    ?>
                        <span class="review-star"><?= $i < $rating ? '★' : '☆' ?></span>
                    <?php endfor; ?>
                </div>
                <p class="review-text"><?= e($review['content'] ?? 'Müşteri yorumu bulunmamaktadır.') ?></p>
            </div>
            <?php endforeach; ?>
        </div>

        <?php else: ?>
        <div class="no-reviews">
            <h2 class="no-reviews__title">Henüz Yorum Bulunmamaktadır</h2>
            <p class="no-reviews__text">Bizim hizmetimizi kullanmış müşterilerimiz yaşadıkları deneyimleri burada paylaşacaklar.</p>
        </div>
        <?php endif; ?>

        <!-- CTA Section -->
        <div class="cta-section">
            <h3>Bizim Hizmetimizi Deneyin</h3>
            <p>Bornova Su Kaçak Tespiti'nin profesyonel hizmetinden faydalanın ve siz de deneyiminizi paylaşın.</p>
            <a href="/iletisim" class="cta-btn">Şimdi İletişim Kurun</a>
        </div>
    </section>

    <!-- Schema.org Markup -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "LocalBusiness",
        "name": "<?= e($site['name']) ?>",
        "url": "<?= e($site['url'] ?? 'https://izmirkacaksutespiti.com') ?>",
        "aggregateRating": {
            "@type": "AggregateRating",
            "ratingValue": "4.8",
            "reviewCount": "<?= count($reviews ?? []) ?>"
        }
    }
    </script>

    <?php require __DIR__ . '/../layouts/footer.php'; ?>

    <script src="/assets/vendor/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="/assets/js/modules/nav.js"></script>
</body>
</html>
