<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hizmetler Yönetimi | Bornova Su Kaçak Tespiti</title>
    <link rel="stylesheet" href="/assets/css/admin.css">
</head>
<body class="admin-body">
    <div class="admin-wrapper">
        <!-- Sidebar -->
        <aside class="admin-sidebar">
            <div class="sidebar-header"><h2>Yönetim</h2></div>
            <nav class="sidebar-nav">
                <a href="/admin" class="nav-item">📊 Panoya Dön</a>
                <a href="/admin/crm/leads" class="nav-item">👥 CRM</a>
                <a href="/admin/hizmetler" class="nav-item active">⚙️ Hizmetler</a>
                <a href="/admin/blog" class="nav-item">📝 Blog</a>
                <a href="/admin/sss" class="nav-item">❓ SSS</a>
                <a href="/admin/ayarlar" class="nav-item">⚙️ Ayarlar</a>
            </nav>
            <div class="sidebar-footer">
                <form method="POST" action="/admin/logout"><button type="submit" class="btn-logout">Çıkış</button></form>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="admin-main">
            <div class="admin-header">
                <h1>Hizmetler Yönetimi</h1>
            </div>

            <div class="content-section">
                <div class="section-header">
                    <h2>Tüm Hizmetler</h2>
                    <a href="/admin/hizmetler/yeni" class="btn-primary">+ Yeni Hizmet</a>
                </div>

                <?php if (isset($_GET['success'])): ?>
                    <div class="alert alert-success">Hizmet başarıyla kaydedildi.</div>
                <?php endif; ?>

                <?php if (isset($_GET['deleted'])): ?>
                    <div class="alert alert-success">Hizmet başarıyla silindi.</div>
                <?php endif; ?>

                <?php if (empty($services)): ?>
                    <p class="empty-state">Henüz hizmet bulunmuyor. <a href="/admin/hizmetler/yeni">Yeni hizmet ekleyin</a></p>
                <?php else: ?>
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Ad</th>
                                <th>Slug</th>
                                <th>Renk</th>
                                <th>Durum</th>
                                <th>İşlemler</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($services as $service): ?>
                                <tr>
                                    <td><?php echo e($service['name']); ?></td>
                                    <td><code><?php echo e($service['slug']); ?></code></td>
                                    <td>
                                        <span class="color-badge" style="background: var(--color-<?php echo e($service['category_color']); ?>-500);">
                                            <?php echo e($service['category_color']); ?>
                                        </span>
                                    </td>
                                    <td>
                                        <?php echo $service['is_active'] ? '✓ Aktif' : '✗ İnaktif'; ?>
                                    </td>
                                    <td>
                                        <a href="/admin/hizmetler/<?php echo $service['id']; ?>/duzenle" class="btn-small">Düzenle</a>
                                        <form method="POST" action="/admin/hizmetler/<?php echo $service['id']; ?>" style="display:inline;">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit" class="btn-small btn-danger" onclick="return confirm('Emin misiniz?')">Sil</button>
                                        </form>
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
        .color-badge {
            display: inline-block;
            width: 24px;
            height: 24px;
            border-radius: 4px;
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
        .btn-primary:hover {
            background: var(--color-blue-600);
        }
        .btn-danger {
            background: #ef4444;
        }
        .btn-danger:hover {
            background: #dc2626;
        }
    </style>
</body>
</html>
