<?php
/**
 * Blog Post Detail Page
 * Displays single blog article with full content, FAQ, related posts, and schema.org markup
 */
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($post['title']) ?> - Blog | <?= e($site['name']) ?></title>
    <meta name="description" content="<?= e(substr(strip_tags($post['content']), 0, 155)) ?>">
    <meta name="keywords" content="<?= e($post['keywords'] ?? '') ?>">
    <meta property="og:title" content="<?= e($post['title']) ?>">
    <meta property="og:description" content="<?= e(substr(strip_tags($post['content']), 0, 155)) ?>">
    <meta property="og:type" content="article">
    <meta property="article:published_time" content="<?= e($post['date']) ?>">
    <meta property="article:author" content="<?= e($post['author']) ?>">

    <link rel="stylesheet" href="/assets/vendor/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/main.css">
    <style>
        .breadcrumb-section { background: var(--color-gray-50); padding: 20px 0; margin-top: calc(var(--topbar-height) + var(--header-height)); }
        .breadcrumb { display: flex; gap: 8px; align-items: center; font-size: 0.95rem; }
        .breadcrumb a { color: var(--color-blue-600); text-decoration: none; }
        .breadcrumb a:hover { text-decoration: underline; }
        .breadcrumb__sep { color: var(--color-gray-400); }
        .blog-header { background: var(--color-white); padding: 60px 0; }
        .blog-header__title { font-size: 2.5rem; font-weight: 800; line-height: 1.2; margin-bottom: 24px; color: var(--color-navy-900); }
        .blog-meta { display: flex; gap: 32px; flex-wrap: wrap; font-size: 0.95rem; color: var(--color-gray-600); margin-bottom: 32px; }
        .blog-meta__item { display: flex; align-items: center; gap: 8px; }
        .blog-content-wrap { display: grid; grid-template-columns: 1fr 320px; gap: 40px; margin: 60px 0; }
        .blog-content { font-size: 1.05rem; line-height: 1.8; color: var(--color-text-body); }
        .blog-content h2 { font-size: 1.8rem; margin-top: 40px; margin-bottom: 20px; color: var(--color-navy-900); }
        .blog-content h3 { font-size: 1.4rem; margin-top: 30px; margin-bottom: 16px; color: var(--color-navy-900); }
        .blog-content p { margin-bottom: 16px; }
        .blog-content ul, .blog-content ol { margin-bottom: 16px; padding-left: 24px; }
        .blog-content li { margin-bottom: 8px; }
        .blog-content strong { font-weight: 700; color: var(--color-navy-900); }
        .blog-sidebar { padding-top: 20px; }
        .sidebar-widget { background: var(--color-gray-50); border-radius: 12px; padding: 24px; margin-bottom: 24px; }
        .sidebar-widget h3 { font-size: 1.1rem; font-weight: 700; margin-bottom: 16px; color: var(--color-navy-900); }
        .related-posts { display: flex; flex-direction: column; gap: 16px; }
        .related-post { background: var(--color-white); border: 1px solid var(--color-gray-200); border-radius: 8px; padding: 12px; transition: all 0.2s ease; }
        .related-post:hover { box-shadow: 0 4px 12px rgba(0,0,0,0.08); border-color: var(--color-blue-300); }
        .related-post a { text-decoration: none; color: var(--color-navy-900); font-weight: 600; }
        .related-post a:hover { color: var(--color-blue-600); }
        .related-post__date { font-size: 0.85rem; color: var(--color-gray-500); margin-top: 8px; }
        .faq-section { background: var(--color-white); border-radius: 12px; padding: 40px; margin: 60px 0; border-left: 4px solid var(--color-blue-600); }
        .faq-section h2 { font-size: 2rem; margin-bottom: 32px; color: var(--color-navy-900); }
        .faq-item { margin-bottom: 16px; }
        .faq-question { cursor: pointer; display: flex; justify-content: space-between; align-items: center; padding: 16px 20px; background: var(--color-gray-50); border-radius: 8px; font-weight: 600; color: var(--color-navy-900); transition: all 0.2s ease; }
        .faq-question:hover { background: var(--color-blue-50); color: var(--color-blue-600); }
        .faq-question[aria-expanded="true"] { background: var(--color-blue-600); color: var(--color-white); }
        .faq-question__toggle { display: inline-flex; align-items: center; justify-content: center; width: 24px; height: 24px; font-size: 1.2rem; transition: transform 0.2s ease; }
        .faq-question[aria-expanded="true"] .faq-question__toggle { transform: rotate(180deg); }
        .faq-answer { background: var(--color-gray-50); padding: 20px; border-radius: 8px; margin-top: 8px; line-height: 1.7; color: var(--color-text-body); display: none; }
        .faq-answer[hidden="false"] { display: block; }
        .author-bio { background: var(--color-blue-50); border: 1px solid var(--color-blue-200); border-radius: 12px; padding: 24px; margin: 60px 0; display: flex; gap: 20px; align-items: flex-start; }
        .author-bio__avatar { width: 80px; height: 80px; border-radius: 50%; background: var(--color-blue-600); display: flex; align-items: center; justify-content: center; color: var(--color-white); font-weight: 800; font-size: 1.5rem; flex-shrink: 0; }
        .author-bio__info h3 { margin-top: 0; margin-bottom: 8px; color: var(--color-navy-900); }
        .author-bio__info p { margin: 0; font-size: 0.95rem; color: var(--color-text-body); }
        .cta-link { display: inline-block; margin-top: 32px; padding: 16px 32px; background: var(--color-blue-600); color: var(--color-white); text-decoration: none; border-radius: 8px; font-weight: 600; transition: background 0.2s ease; }
        .cta-link:hover { background: var(--color-blue-700); }
        @media (max-width: 1023px) {
            .blog-content-wrap { grid-template-columns: 1fr; }
            .blog-sidebar { display: none; }
            .blog-header__title { font-size: 2rem; }
        }
        @media (max-width: 767px) {
            .blog-header { padding: 40px 0; }
            .blog-header__title { font-size: 1.5rem; margin-bottom: 16px; }
            .blog-meta { gap: 16px; }
            .author-bio { flex-direction: column; text-align: center; }
            .author-bio__avatar { margin: 0 auto; }
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
                <a href="/blog">Blog</a>
                <span class="breadcrumb__sep">/</span>
                <span><?= e($post['title']) ?></span>
            </nav>
        </div>
    </section>

    <!-- Blog Header -->
    <section class="blog-header">
        <div class="container">
            <h1 class="blog-header__title"><?= e($post['title']) ?></h1>
            <div class="blog-meta">
                <div class="blog-meta__item">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="4" width="18" height="18" rx="2"></rect>
                        <path d="M16 2v4M8 2v4M3 10h18"></path>
                    </svg>
                    <span><?= date('d M Y', strtotime($post['date'])) ?></span>
                </div>
                <div class="blog-meta__item">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                    <span><?= e($post['author']) ?></span>
                </div>
                <div class="blog-meta__item">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10"></circle>
                    </svg>
                    <span><?= ceil(str_word_count(strip_tags($post['content'])) / 200) ?> dk okuma</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Blog Content -->
    <section class="blog-content-wrap container">
        <article class="blog-content">
            <?= $post['content'] ?>

            <?php if (!empty($post['faq'])): ?>
            <!-- FAQ Section -->
            <section class="faq-section" id="blog-faq">
                <h2>Sık Sorulan Sorular</h2>
                <div class="accordion">
                    <?php foreach ($post['faq'] as $idx => $faqItem): ?>
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
            </section>
            <?php endif; ?>

            <!-- Author Bio -->
            <section class="author-bio">
                <div class="author-bio__avatar"><?= substr($post['author'], 0, 1) ?></div>
                <div class="author-bio__info">
                    <h3><?= e($post['author']) ?></h3>
                    <p><?= e($post['author']) ?> tarafından yazılmıştır. Yazı hakkında yorum ve öneriler için iletişim sayfasını ziyaret edebilirsiniz.</p>
                </div>
            </section>
        </article>

        <!-- Sidebar -->
        <aside class="blog-sidebar">
            <!-- About Widget -->
            <div class="sidebar-widget">
                <h3>Hakkımızda</h3>
                <p><?= e($site['tagline'] ?? 'Bornova bölgesinde su kaçağı tespiti, tıkanıklık açma ve tesisat hizmetleri sunuyoruz.') ?></p>
                <a href="/hakkimizda" class="cta-link">Devamını Oku</a>
            </div>

            <!-- Recent Posts Widget -->
            <div class="sidebar-widget">
                <h3>Son Yazılar</h3>
                <div class="related-posts">
                    <?php
                    $recent = array_slice($blogPosts, 0, 4);
                    foreach ($recent as $relPost):
                    ?>
                    <div class="related-post">
                        <a href="/blog/<?= e($relPost['slug']) ?>"><?= e($relPost['title']) ?></a>
                        <div class="related-post__date"><?= date('d M Y', strtotime($relPost['date'])) ?></div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Contact Widget -->
            <div class="sidebar-widget">
                <h3>Hızlı İletişim</h3>
                <p><strong><?= e($site['phone']) ?></strong></p>
                <a href="tel:<?= e(str_replace(' ', '', $site['phone'])) ?>" class="cta-link">Ara</a>
            </div>
        </aside>
    </section>

    <!-- Schema.org Markup -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "BlogPosting",
        "headline": "<?= e($post['title']) ?>",
        "description": "<?= e(substr(strip_tags($post['content']), 0, 155)) ?>",
        "image": "<?= e($site['url'] ?? 'https://izmirkacaksutespiti.com') ?>/assets/img/logo-header.png",
        "datePublished": "<?= date('Y-m-d', strtotime($post['date'])) ?>",
        "dateModified": "<?= date('Y-m-d', strtotime($post['date'])) ?>",
        "author": {
            "@type": "Organization",
            "name": "<?= e($site['name']) ?>",
            "url": "<?= e($site['url'] ?? 'https://izmirkacaksutespiti.com') ?>"
        },
        "publisher": {
            "@type": "Organization",
            "name": "<?= e($site['name']) ?>",
            "url": "<?= e($site['url'] ?? 'https://izmirkacaksutespiti.com') ?>"
        }
    }
    </script>

    <?php
    if (!empty($post['faq'])):
        $faqSchema = [
            '@context' => 'https://schema.org',
            '@type' => 'FAQPage',
            'mainEntity' => array_map(function($item) {
                return [
                    '@type' => 'Question',
                    'name' => $item['question'],
                    'acceptedAnswer' => [
                        '@type' => 'Answer',
                        'text' => strip_tags($item['answer'])
                    ]
                ];
            }, $post['faq'])
        ];
    ?>
    <script type="application/ld+json">
    <?= json_encode($faqSchema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) ?>
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
