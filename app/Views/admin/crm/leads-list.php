<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRM - Liderler | Bornova Su Kaçak Tespiti</title>
    <link rel="stylesheet" href="/assets/css/admin.css">
</head>
<body class="admin-body">
    <div class="admin-wrapper">
        <!-- Sidebar -->
        <aside class="admin-sidebar">
            <div class="sidebar-header"><h2>Yönetim</h2></div>
            <nav class="sidebar-nav">
                <a href="/admin" class="nav-item">📊 Panoya Dön</a>
                <a href="/admin/crm/leads" class="nav-item active">👥 CRM</a>
                <a href="/admin/hizmetler" class="nav-item">⚙️ Hizmetler</a>
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
                <h1>CRM - Liderler Yönetimi</h1>
            </div>

            <div class="content-section">
                <div class="section-header">
                    <h2>Tüm Liderler</h2>
                    <div class="filter-buttons">
                        <a href="/admin/crm/leads" class="btn-filter <?php echo !isset($_GET['status']) ? 'active' : ''; ?>">Tümü</a>
                        <a href="?status=new" class="btn-filter <?php echo ($_GET['status'] ?? '') === 'new' ? 'active' : ''; ?>">Yeni</a>
                        <a href="?status=contacted" class="btn-filter <?php echo ($_GET['status'] ?? '') === 'contacted' ? 'active' : ''; ?>">İletişim</a>
                        <a href="?status=qualified" class="btn-filter <?php echo ($_GET['status'] ?? '') === 'qualified' ? 'active' : ''; ?>">Nitelikli</a>
                        <a href="?status=won" class="btn-filter <?php echo ($_GET['status'] ?? '') === 'won' ? 'active' : ''; ?>">Kazanıldı</a>
                    </div>
                </div>

                <?php if (empty($leads)): ?>
                    <p class="empty-state">Bu kategoride lider bulunmuyor.</p>
                <?php else: ?>
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Ad</th>
                                <th>E-posta</th>
                                <th>Telefon</th>
                                <th>Durum</th>
                                <th>Atanan Kişi</th>
                                <th>Tarih</th>
                                <th>İşlemler</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($leads as $lead): ?>
                                <tr>
                                    <td><strong><?php echo e($lead['name']); ?></strong></td>
                                    <td><?php echo e($lead['email']); ?></td>
                                    <td><?php echo e($lead['phone']); ?></td>
                                    <td>
                                        <span class="status-badge status-<?php echo e($lead['status']); ?>">
                                            <?php
                                            $statusLabels = [
                                                'new' => 'Yeni',
                                                'contacted' => 'İletişim',
                                                'qualified' => 'Nitelikli',
                                                'proposal' => 'Teklif',
                                                'won' => 'Kazanıldı',
                                                'lost' => 'Kaybedildi',
                                            ];
                                            echo $statusLabels[$lead['status']] ?? $lead['status'];
                                            ?>
                                        </span>
                                    </td>
                                    <td><?php echo e($lead['assigned_to'] ? 'Atanmış' : '-'); ?></td>
                                    <td><?php echo date('d.m.Y', strtotime($lead['created_at'])); ?></td>
                                    <td>
                                        <a href="/admin/crm/leads/<?php echo $lead['id']; ?>" class="btn-small">Detaylar</a>
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
        .filter-buttons {
            display: flex;
            gap: 8px;
        }
        .btn-filter {
            padding: 8px 12px;
            background: var(--color-gray-100);
            color: var(--color-gray-700);
            border: 1px solid var(--color-gray-200);
            border-radius: 6px;
            font-size: 13px;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.2s;
        }
        .btn-filter:hover,
        .btn-filter.active {
            background: var(--color-blue-500);
            color: white;
            border-color: var(--color-blue-500);
        }
    </style>
</body>
</html>
