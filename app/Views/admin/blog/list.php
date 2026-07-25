<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Yönetimi | Bornova Su Kaçak Tespiti</title>
    <link rel="stylesheet" href="/assets/css/admin.css">
</head>
<body class="admin-body">
    <div class="admin-wrapper">
        <aside class="admin-sidebar">
            <div class="sidebar-header"><h2>Yönetim</h2></div>
            <nav class="sidebar-nav">
                <a href="/admin" class="nav-item">📊 Panoya Dön</a>
                <a href="/admin/crm/leads" class="nav-item">👥 CRM</a>
                <a href="/admin/hizmetler" class="nav-item">⚙️ Hizmetler</a>
                <a href="/admin/blog" class="nav-item active">📝 Blog</a>
                <a href="/admin/sss" class="nav-item">❓ SSS</a>
                <a href="/admin/ayarlar" class="nav-item">⚙️ Ayarlar</a>
            </nav>
            <div class="sidebar-footer">
                <form method="POST" action="/admin/logout"><button type="submit" class="btn-logout">Çıkış</button></form>
            </div>
        </aside>

        <main class="admin-main">
            <div class="admin-header">
                <h1>Blog Yazıları Yönetimi</h1>
            </div>

            <div class="content-section">
                <div class="section-header">
                    <h2>Tüm Yazılar</h2>
                    <a href="/admin/blog/yeni" class="btn-primary">+ Yeni Yazı</a>
                </div>

                <?php if (isset($_GET['success'])): ?>
                    <div class="alert alert-success">Blog yazısı başarıyla kaydedildi.</div>
                <?php endif; ?>

                <?php if (empty($posts)): ?>
                    <p class="empty-state">Henüz yazı bulunmuyor.</p>
                <?php else: ?>
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Başlık</th>
                                <th>Slug</th>
                                <th>Yazar</th>
                                <th>Yayın Tarihi</th>
                                <th>Durum</th>
                                <th>İşlemler</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($posts as $post): ?>
                                <tr>
                                    <td><?php echo e($post['title']); ?></td>
                                    <td><code><?php echo e($post['slug']); ?></code></td>
                                    <td>Admin</td>
                                    <td><?php echo $post['published_at'] ? date('d.m.Y', strtotime($post['published_at'])) : '-'; ?></td>
                                    <td><?php echo $post['is_published'] ?? false ? '✓ Yayında' : '○ Taslak'; ?></td>
                                    <td>
                                        <a href="/admin/blog/<?php echo $post['id']; ?>/duzenle" class="btn-small">Düzenle</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            </div>
        </main>
    </div>

    <style>
        .alert {
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
        }
        .alert-success {
            background: #dcfce7;
            color: #166534;
            border: 1px solid #bbf7d0;
        }
        .btn-primary {
            padding: 10px 16px;
            background: var(--color-blue-500);
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 14px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }
    </style>
</body>
</html>
