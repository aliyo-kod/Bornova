<?php
/**
 * Legal Pages (Privacy, KVKK, Terms)
 * Generic legal page template
 */
$pageTitle = 'Gizlilik Politikası';
$pageDescription = 'Kişisel verilerinizin nasıl kullanıldığı hakkında bilgi';

if (isset($_GET['page'])) {
    if ($_GET['page'] === 'kvkk') {
        $pageTitle = 'KVKK - Kişisel Verilerin Korunması Aydınlatması';
        $pageDescription = 'Kişisel verileriniz hakkında yasal aydınlatma metni';
    } elseif ($_GET['page'] === 'terms') {
        $pageTitle = 'Kullanıcı Sözleşmesi';
        $pageDescription = 'Site kullanım şartları ve kuralları';
    }
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($pageTitle) ?> - <?= e($site['name']) ?></title>
    <meta name="description" content="<?= e($pageDescription) ?>">
    <meta name="robots" content="noindex, follow">

    <link rel="stylesheet" href="/assets/vendor/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/main.css">
    <style>
        .breadcrumb-section { background: var(--color-gray-50); padding: 20px 0; margin-top: calc(var(--topbar-height) + var(--header-height)); }
        .breadcrumb { display: flex; gap: 8px; align-items: center; font-size: 0.95rem; flex-wrap: wrap; }
        .breadcrumb a { color: var(--color-blue-600); text-decoration: none; }
        .breadcrumb a:hover { text-decoration: underline; }
        .breadcrumb__sep { color: var(--color-gray-400); }
        .page-header { background: linear-gradient(135deg, var(--color-navy-900) 0%, #1a3a5c 100%); color: var(--color-white); padding: 60px 0; text-align: center; }
        .page-header__title { font-size: 2.5rem; font-weight: 800; line-height: 1.2; margin-bottom: 16px; }
        .legal-section { padding: 60px 0; }
        .legal-content { max-width: 800px; margin: 0 auto; font-size: 1rem; line-height: 1.8; color: var(--color-text-body); }
        .legal-content h1 { font-size: 2rem; margin-bottom: 24px; color: var(--color-navy-900); margin-top: 40px; }
        .legal-content h2 { font-size: 1.5rem; margin-bottom: 16px; color: var(--color-navy-900); margin-top: 32px; }
        .legal-content h3 { font-size: 1.2rem; margin-bottom: 12px; color: var(--color-navy-900); margin-top: 24px; }
        .legal-content p { margin-bottom: 16px; }
        .legal-content ul, .legal-content ol { margin-bottom: 16px; padding-left: 24px; }
        .legal-content li { margin-bottom: 8px; }
        .last-updated { font-size: 0.9rem; color: var(--color-gray-600); font-style: italic; margin-bottom: 32px; }
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
                <span><?= e($pageTitle) ?></span>
            </nav>
        </div>
    </section>

    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <h1 class="page-header__title"><?= e($pageTitle) ?></h1>
        </div>
    </section>

    <!-- Content -->
    <section class="legal-section container">
        <div class="legal-content">
            <p class="last-updated">Son güncelleme: 2024</p>

            <h2>Gizlilik Politikası ve KVKK Aydınlatması</h2>

            <p>Bornova Su Kaçak Tespiti ("Biz"), kişisel verilerinizin gizliliğine ve güvenliğine önem vermektedir. Bu belge, web sitesi ziyaretçileri ve müşterilerimizin kişisel verilerinin nasıl toplandığını, kullanıldığını, korunduğunu ve paylaşıldığını açıklamaktadır.</p>

            <h3>1. Toplanan Kişisel Veriler</h3>
            <p>İletişim formu üzerinden aşağıdaki bilgiler toplanmaktadır:</p>
            <ul>
                <li>Ad ve soyad</li>
                <li>Telefon numarası</li>
                <li>E-mail adresi (isteğe bağlı)</li>
                <li>Hizmet türü</li>
                <li>İstek ve mesajlar</li>
            </ul>

            <h3>2. Verilerin Kullanım Amacı</h3>
            <p>Toplanan kişisel veriler aşağıdaki amaçlarla kullanılmaktadır:</p>
            <ul>
                <li>Hizmet talebine yanıt vermek</li>
                <li>Randevu oluşturmak ve yönetmek</li>
                <li>İletişim kurmak</li>
                <li>Hizmet kalitesini iyileştirmek</li>
                <li>Yasal yükümlülükleri yerine getirmek</li>
            </ul>

            <h3>3. Verilerin Saklanması ve Güvenliği</h3>
            <p>Kişisel veriler, KVKK (Kişisel Verilerin Korunması Kanunu) hükümlerine uygun şekilde saklanmaktadır. Verilerinizi korumak için uygun teknik ve idari tedbirler alınmıştır.</p>

            <h3>4. Verilerin Paylaşılması</h3>
            <p>Kişisel verileriniz, yasal zorunluluk olmadığı sürece üçüncü kişilerle paylaşılmamaktadır.</p>

            <h3>5. Veri Sahibinin Hakları</h3>
            <p>KVKK'nın 11. maddesi uyarınca kişisel veri sahibi aşağıdaki haklara sahiptir:</p>
            <ul>
                <li>Verilerinin işlenip işlenmediğini öğrenmek</li>
                <li>Verileri hakkında bilgi talep etmek</li>
                <li>Verilerin düzeltilmesini isteyebilmek</li>
                <li>Verilerin silinmesini isteyebilmek</li>
                <li>Verilerin aktarılmasını isteyebilmek</li>
            </ul>

            <p>Bu haklara yönelik taleplerde bulunmak için <a href="/iletisim">iletişim sayfamız</a> üzerinden bize ulaşabilirsiniz.</p>

            <h3>6. Çerez (Cookie) Kullanımı</h3>
            <p>Web sitesi, kullanıcı deneyimini iyileştirmek amacıyla çerezler kullanmaktadır. Bu çerezleri tarayıcı ayarlarından kapatabilirsiniz.</p>

            <h3>7. Üçüncü Taraf Hizmetleri</h3>
            <p>Web sitesi, Google Analytics gibi analitik hizmetleri kullanmaktadır. Bu hizmetlerin gizlilik politikaları ve kendi kuralları vardır.</p>

            <h3>8. Politika Değişiklikleri</h3>
            <p>Bu gizlilik politikası zaman zaman güncellenebilir. Değişiklikleri web sitede yayınlanacak olan güncel versiyon üzerinde görebilirsiniz.</p>

            <h3>9. İletişim</h3>
            <p>Bu gizlilik politikası hakkında sorularınız varsa, lütfen <strong><?= e($site['phone']) ?></strong> numaraya veya <strong>info@bornovasukacagitespiti.com</strong> adresine iletişim kurunuz.</p>

            <hr style="margin: 40px 0; border: none; border-top: 1px solid var(--color-gray-200);">

            <h2>Kullanıcı Sözleşmesi</h2>

            <p>Web sitesini ziyaret ederek aşağıdaki şartları kabul etmiş sayılırsınız.</p>

            <h3>1. Hizmetin Kullanımı</h3>
            <p>Bu web site, Bornova Su Kaçak Tespiti tarafından sağlanan bilgileri ve hizmetleri içerir. Hizmetlerin "olduğu gibi" sunulmaktadır.</p>

            <h3>2. Sorumluluk Sınırı</h3>
            <p>Web sitesinde sunulan bilgiler bilgilendirme amaçlıdır. Yanlış, eksik veya geç bilgiler nedeniyle oluşan zararlardan sorumlu tutulamayız.</p>

            <h3>3. Fikri Mülkiyet Hakları</h3>
            <p>Web sitesindeki tüm içerik, tasarım ve logolar Bornova Su Kaçak Tespiti'nin fikri mülkiyet hakları altındadır.</p>

            <h3>4. Bağlantılar</h3>
            <p>Web sitesi dış bağlantılar içerebilir. Bu bağlantılar üçüncü taraf web sitelerine yönlendirir ve biz bu sitelerin içeriğinden sorumlu değiliz.</p>

            <p style="text-align: center; margin-top: 60px; padding-top: 32px; border-top: 2px solid var(--color-gray-200);">
                <strong><?= e($site['name']) ?></strong><br>
                Tel: <?= e($site['phone']) ?><br>
                Email: info@bornovasukacagitespiti.com
            </p>
        </div>
    </section>

    <?php require __DIR__ . '/../layouts/footer.php'; ?>

    <script src="/assets/vendor/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="/assets/js/modules/nav.js"></script>
</body>
</html>
