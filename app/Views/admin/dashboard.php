<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yönetim Paneli | Bornova Su Kaçak Tespiti</title>
    <link rel="stylesheet" href="/assets/css/admin.css">
</head>
<body class="admin-body">
    <div class="admin-wrapper">
        <!-- Sidebar -->
        <aside class="admin-sidebar">
            <div class="sidebar-header">
                <h2>Yönetim Paneli</h2>
            </div>

            <nav class="sidebar-nav">
                <a href="/admin" class="nav-item active">
                    <span class="nav-icon">📊</span>
                    <span class="nav-text">Panoya Dön</span>
                </a>
                <a href="/admin/crm/leads" class="nav-item">
                    <span class="nav-icon">👥</span>
                    <span class="nav-text">CRM Liderler</span>
                </a>
                <a href="/admin/hizmetler" class="nav-item">
                    <span class="nav-icon">⚙️</span>
                    <span class="nav-text">Hizmetler</span>
                </a>
                <a href="/admin/blog" class="nav-item">
                    <span class="nav-icon">📝</span>
                    <span class="nav-text">Blog Yazıları</span>
                </a>
                <a href="/admin/sss" class="nav-item">
                    <span class="nav-icon">❓</span>
                    <span class="nav-text">Sıkça Sorulan Sorular</span>
                </a>
                <a href="/admin/ayarlar" class="nav-item">
                    <span class="nav-icon">⚙️</span>
                    <span class="nav-text">Site Ayarları</span>
                </a>
            </nav>

            <div class="sidebar-footer">
                <div class="user-info">
                    <p class="user-name"><?php echo e($user->attributes['name'] ?? 'Admin'); ?></p>
                    <p class="user-email"><?php echo e($user->attributes['email'] ?? ''); ?></p>
                </div>
                <form method="POST" action="/admin/logout" style="margin: 0;">
                    <button type="submit" class="btn-logout">Çıkış Yap</button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="admin-main">
            <div class="admin-header">
                <h1>Hoş Geldiniz, <?php echo e($user->attributes['name'] ?? 'Admin'); ?></h1>
                <p class="subtitle">Bornova Su Kaçak Tespiti Yönetim Paneline Hoş Geldiniz</p>
            </div>

            <div class="admin-grid">
                <!-- Stats -->
                <div class="stat-card">
                    <div class="stat-icon">👥</div>
                    <div class="stat-content">
                        <h3>Aktif Liderler</h3>
                        <?php
                        $leadCount = \App\Models\CrmLead::query()->where('status', '<>', 'lost')->count();
                        ?>
                        <p class="stat-number"><?php echo $leadCount; ?></p>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">📝</div>
                    <div class="stat-content">
                        <h3>Blog Yazıları</h3>
                        <?php
                        $postCount = \App\Models\Post::query()->count();
                        ?>
                        <p class="stat-number"><?php echo $postCount; ?></p>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">⚙️</div>
                    <div class="stat-content">
                        <h3>Hizmetler</h3>
                        <?php
                        $serviceCount = \App\Models\Service::query()->count();
                        ?>
                        <p class="stat-number"><?php echo $serviceCount; ?></p>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">❓</div>
                    <div class="stat-content">
                        <h3>Sıkça Sorulan Sorular</h3>
                        <?php
                        $faqCount = \App\Models\Faq::query()->count();
                        ?>
                        <p class="stat-number"><?php echo $faqCount; ?></p>
                    </div>
                </div>
            </div>

            <!-- Recent Leads -->
            <div class="content-section">
                <div class="section-header">
                    <h2>Son Liderler</h2>
                    <a href="/admin/crm/leads" class="btn-secondary">Hepsini Gör</a>
                </div>

                <?php
                $recentLeads = \App\Models\CrmLead::query()
                    ->orderBy('created_at', 'DESC')
                    ->limit(5)
                    ->get();
                ?>

                <?php if (empty($recentLeads)): ?>
                    <p class="empty-state">Henüz lider bulunmuyor</p>
                <?php else: ?>
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Ad</th>
                                <th>E-posta</th>
                                <th>Telefon</th>
                                <th>Durum</th>
                                <th>Oluşturulma Tarihi</th>
                                <th>İşlemler</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($recentLeads as $lead):
                                $leadArray = $lead->toArray();
                            ?>
                                <tr>
                                    <td><?php echo e($leadArray['name']); ?></td>
                                    <td><?php echo e($leadArray['email']); ?></td>
                                    <td><?php echo e($leadArray['phone']); ?></td>
                                    <td>
                                        <span class="status-badge status-<?php echo e($leadArray['status']); ?>">
                                            <?php
                                            $statusLabels = [
                                                'new' => 'Yeni',
                                                'contacted' => 'İletişim Kuruldu',
                                                'qualified' => 'Nitelikli',
                                                'proposal' => 'Teklif',
                                                'won' => 'Kazanıldı',
                                                'lost' => 'Kaybedildi',
                                            ];
                                            echo $statusLabels[$leadArray['status']] ?? $leadArray['status'];
                                            ?>
                                        </span>
                                    </td>
                                    <td><?php echo date('d.m.Y H:i', strtotime($leadArray['created_at'])); ?></td>
                                    <td>
                                        <a href="/admin/crm/leads/<?php echo $leadArray['id']; ?>" class="btn-small">Detaylar</a>
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
        :root {
            --color-navy-900: #0b1830;
            --color-navy-800: #0f1f3d;
            --color-blue-500: #2f6fed;
            --color-blue-600: #1f4da8;
            --color-white: #ffffff;
            --color-gray-50: #f9fafb;
            --color-gray-100: #f8fafc;
            --color-gray-200: #e2e8f0;
            --color-gray-500: #64748b;
            --color-gray-700: #334155;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body.admin-body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background: var(--color-gray-50);
            color: var(--color-gray-700);
        }

        .admin-wrapper {
            display: flex;
            min-height: 100vh;
        }

        .admin-sidebar {
            width: 260px;
            background: var(--color-navy-900);
            color: var(--color-white);
            padding: 24px;
            display: flex;
            flex-direction: column;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
        }

        .sidebar-header h2 {
            font-size: 20px;
            margin-bottom: 32px;
        }

        .sidebar-nav {
            flex: 1;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px;
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            border-radius: 6px;
            margin-bottom: 8px;
            transition: all 0.2s;
        }

        .nav-item:hover,
        .nav-item.active {
            background: rgba(47, 111, 237, 0.2);
            color: var(--color-white);
        }

        .nav-icon {
            font-size: 18px;
        }

        .nav-text {
            font-size: 14px;
        }

        .sidebar-footer {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding-top: 16px;
        }

        .user-info {
            margin-bottom: 16px;
        }

        .user-name {
            font-weight: 600;
            font-size: 14px;
            margin-bottom: 4px;
        }

        .user-email {
            font-size: 12px;
            color: rgba(255, 255, 255, 0.6);
        }

        .btn-logout {
            width: 100%;
            padding: 10px;
            background: transparent;
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: var(--color-white);
            border-radius: 6px;
            font-size: 13px;
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn-logout:hover {
            background: rgba(255, 255, 255, 0.1);
            border-color: rgba(255, 255, 255, 0.5);
        }

        .admin-main {
            flex: 1;
            margin-left: 260px;
            padding: 32px;
        }

        .admin-header {
            margin-bottom: 32px;
        }

        .admin-header h1 {
            font-size: 28px;
            margin-bottom: 8px;
            color: var(--color-navy-900);
        }

        .admin-header .subtitle {
            color: var(--color-gray-500);
            font-size: 14px;
        }

        .admin-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 16px;
            margin-bottom: 32px;
        }

        .stat-card {
            background: var(--color-white);
            border-radius: 10px;
            padding: 20px;
            display: flex;
            align-items: center;
            gap: 16px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }

        .stat-icon {
            font-size: 36px;
        }

        .stat-content h3 {
            font-size: 13px;
            color: var(--color-gray-500);
            margin-bottom: 8px;
            font-weight: 500;
        }

        .stat-number {
            font-size: 24px;
            font-weight: 700;
            color: var(--color-navy-900);
        }

        .content-section {
            background: var(--color-white);
            border-radius: 10px;
            padding: 24px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 16px;
            border-bottom: 1px solid var(--color-gray-200);
        }

        .section-header h2 {
            font-size: 18px;
            color: var(--color-navy-900);
        }

        .btn-secondary {
            padding: 8px 16px;
            background: var(--color-gray-100);
            color: var(--color-gray-700);
            border: none;
            border-radius: 6px;
            font-size: 13px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            transition: background 0.2s;
        }

        .btn-secondary:hover {
            background: var(--color-gray-200);
        }

        .admin-table {
            width: 100%;
            border-collapse: collapse;
        }

        .admin-table thead {
            background: var(--color-gray-50);
        }

        .admin-table th {
            padding: 12px;
            text-align: left;
            font-weight: 600;
            font-size: 12px;
            color: var(--color-gray-700);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .admin-table td {
            padding: 12px;
            border-top: 1px solid var(--color-gray-200);
            font-size: 14px;
        }

        .status-badge {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 600;
        }

        .status-new {
            background: #dbeafe;
            color: #1e40af;
        }

        .status-contacted {
            background: #fef3c7;
            color: #92400e;
        }

        .status-qualified {
            background: #d1fae5;
            color: #065f46;
        }

        .status-proposal {
            background: #fce7f3;
            color: #831843;
        }

        .status-won {
            background: #dcfce7;
            color: #166534;
        }

        .status-lost {
            background: #fee2e2;
            color: #991b1b;
        }

        .btn-small {
            padding: 6px 12px;
            background: var(--color-blue-500);
            color: var(--color-white);
            border: none;
            border-radius: 4px;
            font-size: 12px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            transition: background 0.2s;
        }

        .btn-small:hover {
            background: var(--color-blue-600);
        }

        .empty-state {
            text-align: center;
            padding: 32px;
            color: var(--color-gray-500);
        }

        @media (max-width: 768px) {
            .admin-sidebar {
                width: 100%;
                position: relative;
                height: auto;
                margin-bottom: 20px;
            }

            .admin-main {
                margin-left: 0;
                padding: 16px;
            }

            .admin-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
    </style>
</body>
</html>
