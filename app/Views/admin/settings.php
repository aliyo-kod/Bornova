<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site Ayarları | Bornova Su Kaçak Tespiti</title>
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
                <a href="/admin/blog" class="nav-item">📝 Blog</a>
                <a href="/admin/sss" class="nav-item">❓ SSS</a>
                <a href="/admin/ayarlar" class="nav-item active">⚙️ Ayarlar</a>
            </nav>
            <div class="sidebar-footer">
                <form method="POST" action="/admin/logout"><button type="submit" class="btn-logout">Çıkış</button></form>
            </div>
        </aside>

        <main class="admin-main">
            <div class="admin-header">
                <h1>Site Ayarları</h1>
            </div>

            <div class="content-section" style="max-width: 600px;">
                <?php if (isset($_GET['success'])): ?>
                    <div class="alert alert-success">Ayarlar başarıyla kaydedildi.</div>
                <?php endif; ?>

                <form method="POST" class="settings-form">
                    <div class="form-group">
                        <label for="site_name">Site Adı</label>
                        <input
                            type="text"
                            id="site_name"
                            name="site_name"
                            class="form-control"
                            value="<?php echo e($config['site_name'] ?? 'Bornova Su Kaçak Tespiti'); ?>"
                        >
                    </div>

                    <div class="form-group">
                        <label for="site_description">Site Açıklaması</label>
                        <textarea
                            id="site_description"
                            name="site_description"
                            class="form-control"
                            rows="3"
                        ><?php echo e($config['site_description'] ?? ''); ?></textarea>
                    </div>

                    <h2>İletişim Bilgileri</h2>

                    <div class="form-group">
                        <label for="phone">Telefon Numarası</label>
                        <input
                            type="tel"
                            id="phone"
                            name="phone"
                            class="form-control"
                            value="<?php echo e($config['phone'] ?? ''); ?>"
                        >
                    </div>

                    <div class="form-group">
                        <label for="whatsapp">WhatsApp Numarası</label>
                        <input
                            type="tel"
                            id="whatsapp"
                            name="whatsapp"
                            class="form-control"
                            value="<?php echo e($config['whatsapp'] ?? ''); ?>"
                        >
                    </div>

                    <div class="form-group">
                        <label for="email">E-posta Adresi</label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            class="form-control"
                            value="<?php echo e($config['email'] ?? ''); ?>"
                        >
                    </div>

                    <div class="form-group">
                        <label for="location">Konum / Adres</label>
                        <input
                            type="text"
                            id="location"
                            name="location"
                            class="form-control"
                            value="<?php echo e($config['location'] ?? ''); ?>"
                        >
                    </div>

                    <h2>Google Entegrasyonu</h2>

                    <div class="form-group">
                        <label>
                            <input
                                type="checkbox"
                                name="google_reviews_verified"
                                value="1"
                                <?php echo ($config['google_reviews_verified'] ?? false) ? 'checked' : ''; ?>
                            >
                            Google Yorumları Doğrulandı
                        </label>
                        <small style="display: block; margin-top: 8px; color: var(--color-gray-500);">
                            ⚠️ Bu seçeneği yalnızca Google My Business bağlantısı yapılmışsa etkinleştirin.
                        </small>
                    </div>

                    <button type="submit" class="btn-primary">Ayarları Kaydet</button>
                </form>
            </div>
        </main>
    </div>

    <style>
        .settings-form {
            background: white;
            border-radius: 8px;
            padding: 24px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-weight: 600;
            margin-bottom: 8px;
            font-size: 14px;
            color: var(--color-navy-900);
        }

        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid var(--color-gray-200);
            border-radius: 6px;
            font-family: inherit;
            font-size: 14px;
            color: var(--color-navy-900);
        }

        .form-control:focus {
            outline: none;
            border-color: var(--color-blue-500);
            box-shadow: 0 0 0 3px rgba(47, 111, 237, 0.1);
        }

        .form-group input[type="checkbox"] {
            margin-right: 8px;
            width: 16px;
            height: 16px;
            cursor: pointer;
        }

        h2 {
            font-size: 16px;
            margin: 24px 0 16px 0;
            color: var(--color-navy-900);
            border-bottom: 1px solid var(--color-gray-200);
            padding-bottom: 12px;
        }

        h2:first-child {
            margin-top: 0;
        }

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
            padding: 12px 24px;
            background: var(--color-blue-500);
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
        }

        .btn-primary:hover {
            background: var(--color-blue-600);
        }
    </style>
</body>
</html>
