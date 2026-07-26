<?php
/**
 * Contact Page
 * Contact form for customers to submit inquiries
 */
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>İletişim - <?= e($site['name']) ?></title>
    <meta name="description" content="Bornova Su Kaçak Tespiti ile iletişime geçin. Hızlı yanıt garantili.">
    <meta name="keywords" content="iletişim, bize ulaşın, form, telefon, whatsapp">

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
        .contact-section { padding: 60px 0; }
        .contact-wrap { display: grid; grid-template-columns: 1fr 1fr; gap: 60px; align-items: start; }
        .contact-info { }
        .contact-info h2 { font-size: 1.8rem; margin-bottom: 32px; color: var(--color-navy-900); }
        .info-item { margin-bottom: 32px; }
        .info-item__icon { width: 40px; height: 40px; background: var(--color-blue-100); border-radius: 8px; display: flex; align-items: center; justify-content: center; color: var(--color-blue-600); font-size: 1.5rem; margin-bottom: 12px; }
        .info-item__label { font-size: 0.9rem; color: var(--color-gray-600); text-transform: uppercase; font-weight: 600; margin-bottom: 4px; }
        .info-item__value { font-size: 1.15rem; font-weight: 600; color: var(--color-navy-900); }
        .info-item a { color: var(--color-blue-600); text-decoration: none; }
        .info-item a:hover { text-decoration: underline; }
        .hours { background: var(--color-gray-50); border-radius: 12px; padding: 24px; margin-top: 32px; }
        .hours h3 { margin-top: 0; margin-bottom: 16px; color: var(--color-navy-900); }
        .hours p { margin: 8px 0; color: var(--color-text-body); }
        .contact-form h2 { font-size: 1.8rem; margin-bottom: 32px; color: var(--color-navy-900); }
        .form-group { margin-bottom: 24px; }
        .form-group label { display: block; font-weight: 600; color: var(--color-navy-900); margin-bottom: 8px; }
        .form-group input, .form-group textarea, .form-group select { width: 100%; padding: 12px 16px; border: 1px solid var(--color-gray-300); border-radius: 8px; font-size: 1rem; font-family: inherit; transition: border-color 0.2s ease; }
        .form-group input:focus, .form-group textarea:focus, .form-group select:focus { outline: none; border-color: var(--color-blue-600); box-shadow: 0 0 0 3px rgba(47, 111, 237, 0.1); }
        .form-group textarea { min-height: 120px; resize: vertical; }
        .form-group-row { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
        .form-submit { padding: 14px 32px; background: var(--color-blue-600); color: var(--color-white); border: none; border-radius: 8px; font-weight: 700; font-size: 1rem; cursor: pointer; transition: background 0.2s ease; width: 100%; }
        .form-submit:hover { background: var(--color-blue-700); }
        .form-submit:disabled { background: var(--color-gray-400); cursor: not-allowed; }
        .form-message { padding: 16px; border-radius: 8px; margin-bottom: 20px; display: none; }
        .form-message.success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; display: block; }
        .form-message.error { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; display: block; }
        @media (max-width: 1023px) {
            .contact-wrap { grid-template-columns: 1fr; gap: 40px; }
            .page-header__title { font-size: 2rem; }
            .form-group-row { grid-template-columns: 1fr; }
        }
        @media (max-width: 767px) {
            .page-header { padding: 40px 0; }
            .page-header__title { font-size: 1.5rem; }
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
                <span>İletişim</span>
            </nav>
        </div>
    </section>

    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <h1 class="page-header__title">İletişim</h1>
            <p class="page-header__subtitle">Bize ulaşın ve sorularınıza yanıt alın</p>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="contact-section container">
        <div class="contact-wrap">
            <!-- Contact Info -->
            <div class="contact-info">
                <h2>İletişim Bilgileri</h2>

                <div class="info-item">
                    <div class="info-item__icon">📞</div>
                    <div class="info-item__label">Telefon</div>
                    <div class="info-item__value"><a href="tel:<?= e(str_replace(' ', '', $site['phone'])) ?>"><?= e($site['phone']) ?></a></div>
                </div>

                <div class="info-item">
                    <div class="info-item__icon">📧</div>
                    <div class="info-item__label">E-Mail</div>
                    <div class="info-item__value"><a href="mailto:info@bornovasukacagitespiti.com">info@bornovasukacagitespiti.com</a></div>
                </div>

                <div class="info-item">
                    <div class="info-item__icon">💬</div>
                    <div class="info-item__label">WhatsApp</div>
                    <div class="info-item__value"><a href="https://wa.me/<?= e(str_replace([' ', '(', ')', '-', '+'], '', $site['phone'])) ?>" target="_blank">WhatsApp Mesaj Gönder</a></div>
                </div>

                <div class="info-item">
                    <div class="info-item__icon">📍</div>
                    <div class="info-item__label">Hizmet Alanı</div>
                    <div class="info-item__value">Bornova ve Çevresine 24/7 Hizmet</div>
                </div>

                <div class="hours">
                    <h3>Çalışma Saatleri</h3>
                    <p><strong>Pazartesi - Cuma:</strong> 08:00 - 18:00</p>
                    <p><strong>Cumartesi:</strong> 10:00 - 14:00</p>
                    <p><strong>Pazar & Tatil:</strong> Açık (Acil Hizmetler)</p>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="contact-form">
                <h2>Mesaj Gönderin</h2>

                <div id="form-message" class="form-message"></div>

                <form id="contact-form" method="POST">
                    <div class="form-group-row">
                        <div class="form-group">
                            <label for="name">Ad Soyad *</label>
                            <input type="text" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Telefon *</label>
                            <input type="tel" id="phone" name="phone" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email">E-Mail Adresi</label>
                        <input type="email" id="email" name="email">
                    </div>

                    <div class="form-group">
                        <label for="service">Hizmet Türü *</label>
                        <select id="service" name="service" required>
                            <option value="">Seçiniz...</option>
                            <?php foreach ($services as $service): ?>
                            <option value="<?= e($service['slug']) ?>"><?= e($service['name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="message">Mesajınız *</label>
                        <textarea id="message" name="message" required></textarea>
                    </div>

                    <div class="form-group">
                        <label>
                            <input type="checkbox" name="agree_kvkk" value="1" required>
                            <span>Kişisel verilerimin işlenmesine izin veriyorum. (<a href="/kvkk" target="_blank">Aydınlatma Metni</a>)</span>
                        </label>
                    </div>

                    <button type="submit" class="form-submit">Mesajı Gönder</button>
                </form>
            </div>
        </div>
    </section>

    <!-- Schema.org Markup -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "LocalBusiness",
        "name": "<?= e($site['name']) ?>",
        "url": "<?= e($site['url'] ?? 'https://izmirkacaksutespiti.com') ?>/iletisim",
        "telephone": "<?= e($site['phone']) ?>",
        "email": "info@bornovasukacagitespiti.com",
        "address": {
            "@type": "PostalAddress",
            "streetAddress": "Bornova",
            "addressLocality": "Bornova",
            "addressRegion": "İzmir",
            "postalCode": "35000",
            "addressCountry": "TR"
        }
    }
    </script>

    <?php require __DIR__ . '/../layouts/footer.php'; ?>

    <script src="/assets/vendor/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="/assets/js/modules/nav.js"></script>
    <script>
        document.getElementById('contact-form')?.addEventListener('submit', async function(e) {
            e.preventDefault();
            const formData = new FormData(this);

            try {
                const response = await fetch('/iletisim', {
                    method: 'POST',
                    body: formData
                });

                if (response.ok) {
                    const msg = document.getElementById('form-message');
                    msg.className = 'form-message success';
                    msg.textContent = 'Mesajınız başarıyla gönderildi. En kısa sürede size dönüş yapacağız.';
                    this.reset();
                } else {
                    throw new Error('Mesaj gönderilemedi');
                }
            } catch (error) {
                const msg = document.getElementById('form-message');
                msg.className = 'form-message error';
                msg.textContent = 'Bir hata oluştu. Lütfen daha sonra tekrar deneyiniz.';
            }
        });
    </script>
</body>
</html>
