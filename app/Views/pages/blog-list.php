<?php
/**
 * Blog List Page
 * Displays all blog posts with pagination
 */
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog - <?= e($site['name']) ?></title>
    <meta name="description" content="Su kaçağı tespiti, tıkanıklık açma, tesisat ve kombi bakımı hakkında bilgili makaleler ve rehberler.">
    <meta name="keywords" content="blog, su kaçağı, tıkanıklık, tesisat, kombi bakımı, rehber">

    <link rel="stylesheet" href="/assets/vendor/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/main.css">
    <style>
        .breadcrumb-section { background: var(--color-gray-50); padding: 20px 0; margin-top: calc(var(--topbar-height) + var(--header-height)); }
        .breadcrumb { display: flex; gap: 8px; align-items: center; font-size: 0.95rem; }
        .breadcrumb a { color: var(--color-blue-600); text-decoration: none; }
        .breadcrumb a:hover { text-decoration: underline; }
        .breadcrumb__sep { color: var(--color-gray-400); }
        .blog-header { background: var(--color-white); padding: 60px 0; text-align: center; }
        .blog-header__title { font-size: 2.5rem; font-weight: 800; line-height: 1.2; margin-bottom: 16px; color: var(--color-navy-900); }
        .blog-header__subtitle { font-size: 1.1rem; color: var(--color-gray-600); max-width: 600px; margin: 0 auto; }
        .blog-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 32px; margin: 60px 0; }
        .blog-card { background: var(--color-white); border: 1px solid var(--color-gray-200); border-radius: 12px; overflow: hidden; transition: all 0.3s ease; }
        .blog-card:hover { box-shadow: 0 8px 24px rgba(15,31,61,0.12); border-color: var(--color-blue-300); transform: translateY(-4px); }
        .blog-card__image { width: 100%; height: 220px; background: linear-gradient(135deg, var(--color-gray-100) 0%, var(--color-gray-50) 100%); overflow: hidden; }
        .blog-card__image img { width: 100%; height: 100%; object-fit: cover; }
        .blog-card__content { padding: 24px; }
        .blog-card__category { display: inline-block; background: var(--color-blue-100); color: var(--color-blue-600); padding: 4px 12px; border-radius: 20px; font-size: 0.8rem; font-weight: 600; text-transform: uppercase; margin-bottom: 12px; }
        .blog-card__title { font-size: 1.25rem; font-weight: 700; line-height: 1.4; margin-bottom: 12px; color: var(--color-navy-900); }
        .blog-card__title a { color: inherit; text-decoration: none; transition: color 0.2s ease; }
        .blog-card__title a:hover { color: var(--color-blue-600); }
        .blog-card__excerpt { color: var(--color-text-body); font-size: 0.95rem; line-height: 1.6; margin-bottom: 16px; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
        .blog-card__meta { display: flex; gap: 16px; font-size: 0.85rem; color: var(--color-gray-500); padding-top: 16px; border-top: 1px solid var(--color-gray-100); }
        .blog-card__meta-item { display: flex; align-items: center; gap: 6px; }
        .pagination { display: flex; justify-content: center; gap: 8px; margin: 60px 0; }
        .pagination__link { padding: 10px 14px; border: 1px solid var(--color-gray-300); border-radius: 6px; color: var(--color-text-body); text-decoration: none; transition: all 0.2s ease; }
        .pagination__link:hover { border-color: var(--color-blue-600); color: var(--color-blue-600); }
        .pagination__link.active { background: var(--color-blue-600); color: var(--color-white); border-color: var(--color-blue-600); }
        .pagination__link.disabled { opacity: 0.5; cursor: not-allowed; }
        .no-posts { text-align: center; padding: 60px 0; }
        .no-posts__title { font-size: 1.5rem; font-weight: 700; margin-bottom: 16px; color: var(--color-navy-900); }
        .no-posts__text { color: var(--color-gray-600); margin-bottom: 32px; }
        @media (max-width: 1199px) {
            .blog-grid { grid-template-columns: repeat(2, 1fr); }
        }
        @media (max-width: 767px) {
            .blog-grid { grid-template-columns: 1fr; }
            .blog-header { padding: 40px 0; }
            .blog-header__title { font-size: 2rem; }
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
                <span>Blog</span>
            </nav>
        </div>
    </section>

    <!-- Blog Header -->
    <section class="blog-header">
        <div class="container">
            <h1 class="blog-header__title">Blog</h1>
            <p class="blog-header__subtitle">Su kaçağı tespiti, tıkanıklık açma, tesisat ve kombi bakımı hakkında bilgili makaleler ve rehberler.</p>
        </div>
    </section>

    <!-- Blog Grid -->
    <section class="container">
        <?php if (!empty($posts)): ?>
        <div class="blog-grid">
            <?php foreach ($posts as $post): ?>
            <article class="blog-card">
                <div class="blog-card__image">
                    <?php
                    $imgNum = (array_search($post, $blogPosts) % 4) + 1;
                    ?>
                    <img src="/assets/img/blog-<?= $imgNum ?>.png" alt="<?= e($post['title']) ?>">
                </div>
                <div class="blog-card__content">
                    <span class="blog-card__category"><?= e($post['category'] ?? 'Bilgi') ?></span>
                    <h3 class="blog-card__title">
                        <a href="/blog/<?= e($post['slug']) ?>"><?= e($post['title']) ?></a>
                    </h3>
                    <p class="blog-card__excerpt"><?= e(substr(strip_tags($post['excerpt'] ?? $post['content']), 0, 150)) ?>...</p>
                    <div class="blog-card__meta">
                        <div class="blog-card__meta-item">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect x="3" y="4" width="18" height="18" rx="2"></rect>
                                <path d="M16 2v4M8 2v4M3 10h18"></path>
                            </svg>
                            <span><?= date('d M Y', strtotime($post['date'])) ?></span>
                        </div>
                        <div class="blog-card__meta-item">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="10"></circle>
                            </svg>
                            <span><?= ceil(str_word_count(strip_tags($post['content'])) / 200) ?> dk</span>
                        </div>
                    </div>
                </div>
            </article>
            <?php endforeach; ?>
        </div>

        <!-- Pagination -->
        <?php if ($pagination['total_pages'] > 1): ?>
        <nav class="pagination">
            <?php if ($pagination['current_page'] > 1): ?>
                <a href="/blog?page=1" class="pagination__link">İlk</a>
                <a href="/blog?page=<?= $pagination['current_page'] - 1 ?>" class="pagination__link">Önceki</a>
            <?php else: ?>
                <span class="pagination__link disabled">İlk</span>
                <span class="pagination__link disabled">Önceki</span>
            <?php endif; ?>

            <?php
            $start = max(1, $pagination['current_page'] - 2);
            $end = min($pagination['total_pages'], $pagination['current_page'] + 2);
            if ($start > 1) echo '<span class="pagination__link disabled">...</span>';

            for ($i = $start; $i <= $end; $i++):
            ?>
                <?php if ($i === $pagination['current_page']): ?>
                    <span class="pagination__link active"><?= $i ?></span>
                <?php else: ?>
                    <a href="/blog?page=<?= $i ?>" class="pagination__link"><?= $i ?></a>
                <?php endif; ?>
            <?php endfor;

            if ($end < $pagination['total_pages']) echo '<span class="pagination__link disabled">...</span>';
            ?>

            <?php if ($pagination['current_page'] < $pagination['total_pages']): ?>
                <a href="/blog?page=<?= $pagination['current_page'] + 1 ?>" class="pagination__link">Sonraki</a>
                <a href="/blog?page=<?= $pagination['total_pages'] ?>" class="pagination__link">Son</a>
            <?php else: ?>
                <span class="pagination__link disabled">Sonraki</span>
                <span class="pagination__link disabled">Son</span>
            <?php endif; ?>
        </nav>
        <?php endif; ?>

        <?php else: ?>
        <div class="no-posts">
            <h2 class="no-posts__title">Blog yazısı bulunamadı</h2>
            <p class="no-posts__text">Henüz blog yazısı yayınlanmamıştır. Lütfen daha sonra kontrol edin.</p>
        </div>
        <?php endif; ?>
    </section>

    <!-- Schema.org Markup -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Blog",
        "name": "<?= e($site['name']) ?> Blog",
        "url": "<?= e($site['url'] ?? 'https://izmirkacaksutespiti.com') ?>/blog",
        "description": "Su kaçağı tespiti, tıkanıklık açma, tesisat ve kombi bakımı hakkında bilgili makaleler",
        "publisher": {
            "@type": "Organization",
            "name": "<?= e($site['name']) ?>",
            "url": "<?= e($site['url'] ?? 'https://izmirkacaksutespiti.com') ?>"
        }
    }
    </script>

    <?php require __DIR__ . '/../layouts/footer.php'; ?>

    <script src="/assets/vendor/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="/assets/js/modules/nav.js"></script>
</body>
</html>
