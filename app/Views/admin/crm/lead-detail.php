<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lider Detayları | Bornova Su Kaçak Tespiti</title>
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
            </nav>
            <div class="sidebar-footer">
                <form method="POST" action="/admin/logout"><button type="submit" class="btn-logout">Çıkış</button></form>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="admin-main">
            <div class="admin-header">
                <h1><?php echo e($lead['name']); ?></h1>
                <p class="subtitle">Lider Detayları</p>
            </div>

            <div class="lead-grid">
                <!-- Lead Info -->
                <div class="lead-section">
                    <h2>İletişim Bilgileri</h2>
                    <div class="info-item">
                        <label>Ad / Şirket</label>
                        <p><?php echo e($lead['name']); ?></p>
                    </div>
                    <div class="info-item">
                        <label>E-posta</label>
                        <p><?php echo e($lead['email']); ?></p>
                    </div>
                    <div class="info-item">
                        <label>Telefon</label>
                        <p><?php echo e($lead['phone']); ?></p>
                    </div>
                    <div class="info-item">
                        <label>Hizmet</label>
                        <p><?php echo $lead['service_id'] ? 'Hizmet #' . $lead['service_id'] : 'Belirtilmemiş'; ?></p>
                    </div>
                    <div class="info-item">
                        <label>Bölge</label>
                        <p><?php echo $lead['region_id'] ? 'Bölge #' . $lead['region_id'] : 'Belirtilmemiş'; ?></p>
                    </div>

                    <h2>Durum Yönetimi</h2>
                    <form method="POST" action="/admin/crm/leads/<?php echo $lead['id']; ?>/status">
                        <div class="form-group">
                            <label>Durum</label>
                            <select name="status" class="form-control">
                                <option value="new" <?php echo $lead['status'] === 'new' ? 'selected' : ''; ?>>Yeni</option>
                                <option value="contacted" <?php echo $lead['status'] === 'contacted' ? 'selected' : ''; ?>>İletişim Kuruldu</option>
                                <option value="qualified" <?php echo $lead['status'] === 'qualified' ? 'selected' : ''; ?>>Nitelikli</option>
                                <option value="proposal" <?php echo $lead['status'] === 'proposal' ? 'selected' : ''; ?>>Teklif Gönderildi</option>
                                <option value="won" <?php echo $lead['status'] === 'won' ? 'selected' : ''; ?>>Kazanıldı</option>
                                <option value="lost" <?php echo $lead['status'] === 'lost' ? 'selected' : ''; ?>>Kaybedildi</option>
                            </select>
                        </div>
                        <button type="submit" class="btn-primary">Durumu Güncelle</button>
                    </form>

                    <h2>Notlar</h2>
                    <div class="notes-list">
                        <?php foreach ($notes as $note): ?>
                            <div class="note-item">
                                <p><?php echo e($note['content']); ?></p>
                                <small><?php echo date('d.m.Y H:i', strtotime($note['created_at'])); ?></small>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <form method="POST" action="/admin/crm/leads/<?php echo $lead['id']; ?>/note" class="add-note-form">
                        <div class="form-group">
                            <label>Not Ekle</label>
                            <textarea name="content" class="form-control" placeholder="Not yazın..." rows="3"></textarea>
                        </div>
                        <label class="checkbox">
                            <input type="checkbox" name="is_internal" value="1" checked>
                            Sadece takım görsün
                        </label>
                        <button type="submit" class="btn-primary">Not Ekle</button>
                    </form>
                </div>

                <!-- Tasks -->
                <div class="lead-section">
                    <h2>Görevler</h2>
                    <div class="tasks-list">
                        <?php if (empty($tasks)): ?>
                            <p class="empty-state">Henüz görev bulunmuyor.</p>
                        <?php else: ?>
                            <?php foreach ($tasks as $task): ?>
                                <div class="task-item priority-<?php echo e($task['priority']); ?> status-<?php echo e($task['status']); ?>">
                                    <h4><?php echo e($task['title']); ?></h4>
                                    <p><?php echo e($task['description']); ?></p>
                                    <small>
                                        Durum: <?php echo e($task['status']); ?> |
                                        Öncelik: <?php echo e($task['priority']); ?>
                                    </small>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <style>
                .lead-grid {
                    display: grid;
                    grid-template-columns: 1fr 1fr;
                    gap: 24px;
                }

                .lead-section {
                    background: white;
                    border-radius: 10px;
                    padding: 24px;
                    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
                }

                .lead-section h2 {
                    font-size: 16px;
                    margin-bottom: 16px;
                    color: var(--color-navy-900);
                    border-bottom: 1px solid var(--color-gray-200);
                    padding-bottom: 12px;
                }

                .info-item {
                    margin-bottom: 16px;
                }

                .info-item label {
                    display: block;
                    font-size: 12px;
                    color: var(--color-gray-500);
                    text-transform: uppercase;
                    letter-spacing: 0.5px;
                    margin-bottom: 4px;
                    font-weight: 600;
                }

                .info-item p {
                    font-size: 14px;
                    color: var(--color-navy-900);
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

                .notes-list {
                    margin-bottom: 20px;
                    max-height: 300px;
                    overflow-y: auto;
                }

                .note-item {
                    background: var(--color-gray-50);
                    padding: 12px;
                    border-radius: 6px;
                    margin-bottom: 8px;
                    border-left: 3px solid var(--color-blue-500);
                }

                .note-item p {
                    font-size: 14px;
                    margin-bottom: 4px;
                }

                .note-item small {
                    color: var(--color-gray-500);
                    font-size: 12px;
                }

                .add-note-form {
                    margin-top: 20px;
                    padding-top: 20px;
                    border-top: 1px solid var(--color-gray-200);
                }

                .checkbox {
                    display: flex;
                    align-items: center;
                    margin-bottom: 12px;
                    font-size: 14px;
                    cursor: pointer;
                }

                .checkbox input {
                    margin-right: 8px;
                }

                .tasks-list {
                    max-height: 500px;
                    overflow-y: auto;
                }

                .task-item {
                    background: var(--color-gray-50);
                    padding: 12px;
                    border-radius: 6px;
                    margin-bottom: 8px;
                    border-left: 4px solid var(--color-blue-500);
                }

                .task-item h4 {
                    margin: 0 0 4px 0;
                    font-size: 14px;
                    color: var(--color-navy-900);
                }

                .task-item p {
                    font-size: 13px;
                    color: var(--color-gray-500);
                    margin: 0 0 8px 0;
                }

                .task-item small {
                    font-size: 12px;
                    color: var(--color-gray-500);
                }

                .priority-high {
                    border-left-color: #ef4444;
                }

                .priority-medium {
                    border-left-color: #f59e0b;
                }

                .priority-low {
                    border-left-color: #10b981;
                }

                @media (max-width: 768px) {
                    .lead-grid {
                        grid-template-columns: 1fr;
                    }
                }
            </style>
        </main>
    </div>
</body>
</html>
