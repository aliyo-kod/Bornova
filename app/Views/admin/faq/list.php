<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SSS Yönetimi | Bornova Su Kaçak Tespiti</title>
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
                <a href="/admin/sss" class="nav-item active">❓ SSS</a>
                <a href="/admin/ayarlar" class="nav-item">⚙️ Ayarlar</a>
            </nav>
            <div class="sidebar-footer">
                <form method="POST" action="/admin/logout"><button type="submit" class="btn-logout">Çıkış</button></form>
            </div>
        </aside>

        <main class="admin-main">
            <div class="admin-header">
                <h1>Sıkça Sorulan Sorular Yönetimi</h1>
            </div>

            <div class="content-section">
                <div class="section-header">
                    <h2>Tüm Sorular</h2>
                    <button class="btn-primary" onclick="document.getElementById('addFaqForm').scrollIntoView(); document.getElementById('question').focus()">+ Yeni Soru</button>
                </div>

                <?php if (isset($_GET['success'])): ?>
                    <div class="alert alert-success">Soru başarıyla kaydedildi.</div>
                <?php endif; ?>

                <?php if (empty($faqs)): ?>
                    <p class="empty-state">Henüz soru bulunmuyor.</p>
                <?php else: ?>
                    <div class="faq-list">
                        <?php foreach ($faqs as $faq): ?>
                            <div class="faq-item">
                                <div class="faq-header">
                                    <h3><?php echo e($faq['question']); ?></h3>
                                    <span class="status-badge"><?php echo $faq['is_active'] ? '✓' : '○'; ?></span>
                                </div>
                                <p class="faq-answer"><?php echo substr(e($faq['answer']), 0, 150); ?>...</p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <div id="addFaqForm" style="margin-top: 40px; padding-top: 40px; border-top: 1px solid var(--color-gray-200);">
                    <h2>Yeni Soru Ekle</h2>
                    <form method="POST" style="max-width: 600px;">
                        <div class="form-group">
                            <label for="question">Soru</label>
                            <input type="text" id="question" name="question" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="answer">Cevap</label>
                            <textarea id="answer" name="answer" class="form-control" rows="4" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="category">Kategori</label>
                            <input type="text" id="category" name="category" class="form-control" placeholder="örn: Teknik, Fatura">
                        </div>
                        <div class="form-group">
                            <label>
                                <input type="checkbox" name="is_active" value="1" checked>
                                Etkin
                            </label>
                        </div>
                        <button type="submit" class="btn-primary">Ekle</button>
                    </form>
                </div>
            </div>
        </main>
    </div>

    <style>
        .faq-list {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .faq-item {
            background: var(--color-gray-50);
            padding: 16px;
            border-radius: 8px;
            border-left: 4px solid var(--color-blue-500);
        }

        .faq-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 8px;
        }

        .faq-header h3 {
            font-size: 14px;
            margin: 0;
            flex: 1;
        }

        .faq-answer {
            font-size: 13px;
            color: var(--color-gray-500);
            margin: 0;
            line-height: 1.5;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid var(--color-gray-200);
            border-radius: 6px;
            font-family: inherit;
            font-size: 14px;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--color-blue-500);
        }

        .form-group {
            margin-bottom: 16px;
        }

        .form-group label {
            display: block;
            font-weight: 600;
            margin-bottom: 6px;
            font-size: 14px;
        }
    </style>
</body>
</html>
