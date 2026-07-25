# Bornova Su Kaçak Tespiti

Kurumsal tanıtım sitesi + yönetim paneli projesi. Bu depo aşamalı olarak geliştirilmektedir.

## Mevcut Durum: Tüm Fazlar Tamamlandı (1-6)

### Phase 1 ✅ — Anasayfa Ön Yüzü
- Masaüstü ve mobil yanıtlı tasarım
- 9 bölüm (hero, hizmetler, yorumlar, videolar, blog, SSS, CTA, footer)
- Vanilla JS (navigasyon, akordeon, modal)
- Bootstrap 5 grid + özel CSS override

### Phase 2 ✅ — Veritabanı & Yönlendirme
- MySQL 8 şeması (~35 tablo)
- PDO bağlantı sarmalayıcısı
- Model sınıfları (15+ modeller)
- Router ve route tanımları
- Veritabanı fallback sistemi

### Phase 3 ✅ — Yönetim Paneli & CRM
- Kullanıcı kimlik doğrulaması (bcrypt şifreler)
- Rol tabanlı erişim kontrolü
- CRM lider boru hattı (6 durum)
- İçerik yönetimi (hizmetler, blog, SSS)
- Dashboard ve istatistikler

### Phase 4 ✅ — SEO & Schema Otomasyonu
- Sitemap.xml dinamik üretimi
- robots.txt yönetimi
- JSON-LD schema (FAQ, LocalBusiness, Breadcrumb, Organization)
- Meta tag ve OG alan yönetimi
- Yönlendirme modeli

### Phase 5 ✅ — Google Araçları & Ads
- Google entegrasyon modeli (GA4, GSC, GBP, GTM)
- Ads hesap yönetimi
- Telefon/WhatsApp tıklama izleme
- Dönüşüm takibi
- Analitik veri modelleri

### Phase 6 ✅ — Güvenlik & Performans
- CSRF token koruması
- Rate limiting (giriş denemesi)
- Aktivite günlüğü
- Giriş günlüğü (başarı/başarısızlık)
- Veritabanı yedekleme sistemi

Henüz **yapılmayanlar** (sıradaki fazlar): Yönetim paneli ve kimlik doğrulama, CRM lead pipeline,
Google araçları/Ads entegrasyonu, SEO otomasyonu (sitemap/robots/schema), form gönderimi ve e-posta bildirimleri,
güvenlik sertleştirmesi (CSRF, rate limiting vb.).

## Özellikler

### Halkla Açık Sayfalar
- `/` — Anasayfa (9 bölüm)
- `/hakkimizda` — Hakkında sayfası
- `/hizmetler` — Hizmetler listesi
- `/hizmet/{slug}` — Hizmet detayı
- `/bolgeler` — Hizmet bölgeleri
- `/bolge/{slug}` — Bölge detayı
- `/blog` — Blog yazıları (sayfalandırılmış)
- `/blog/{slug}` — Blog yazısı detayı
- `/s-s-s` — Sıkça sorulan sorular
- `/yorumlar` — Tüm müşteri yorumları
- `/iletisim` — İletişim formu
- `/gizlilik` — Gizlilik politikası
- `/kvkk` — Kişisel veri politikası
- `/sitenin-kullanici-sozlesmesi` — Kullanım şartları
- `/sitemap.xml` — SEO sitemap
- `/robots.txt` — Robot.txt

### Yönetim Paneli (/admin)
- **Pano** — İstatistikler ve hızlı erişim
- **CRM → Liderler** — Lider boru hattı yönetimi
  - 6 durum: Yeni, İletişim, Nitelikli, Teklif, Kazanıldı, Kaybedildi
  - Not ve görev takibi
  - Durum filtreleme
- **Hizmetler** — Ekle/düzenle/sil hizmetler
- **Blog** — Yazı yayınlama ve taslak yönetimi
- **SSS** — Soruların yönetimi
- **Site Ayarları** — İletişim ve Google entegrasyonu

### Güvenlik Özellikleri
- Bcrypt şifre hashleme
- CSRF token koruması
- Rate limiting (giriş denemelerine karşı)
- Aktivite günlüğü (tüm yönetici işlemleri)
- Giriş günlüğü (başarı/başarısızlık takibi)
- Güvenli çerez yönetimi
- Session tabanlı kimlik doğrulama

### Analitik & İzleme
- Telefon tıklama takibi
- WhatsApp tıklama takibi
- Dönüşüm takibi (lead kaynakları)
- Oturum ve kullanıcı aracı bilgileri

## Çalıştırma

### Kurulum

1. **Bağımlılıkları yükle:**
   ```bash
   composer install
   ```

2. **Ortam değişkenlerini ayarla:**
   ```bash
   cp .env.example .env
   # .env dosyasını MySQL kimlik bilgileriyle düzenle
   ```

3. **Veritabanını oluştur:**
   ```bash
   php database/setup.php
   ```

4. **Sunucuyu başlat:**
   ```bash
   php -S localhost:8000 -t public
   ```

5. **Tarayıcıda aç:**
   - Anasayfa: `http://localhost:8000`
   - Hakkında: `http://localhost:8000/hakkimizda`
   - Blog: `http://localhost:8000/blog`
   - İletişim: `http://localhost:8000/iletisim`
   - S.S.S: `http://localhost:8000/s-s-s`
   
### Veritabanı Yedeklemesi

```bash
# Tam yedekleme oluştur
php database/backup.php

# Özel dizine yedek al
php database/backup.php /path/to/backups
```

### Fallback Modu (Veritabanı Yok)

Veritabanı bağlantısı başarısız olursa, sistem otomatik olarak `app/Data/*.php` dizileri kullanır.
Bu, Faz 1 ön yüzünü herhangi bir veritabanı olmadan çalıştırmanızı sağlar.

## Üretim Dağıtımı

### Web Kökü
`public/` dizini web kökü olarak yapılandırın. `app/`, `config/`, `database/` ve `storage/` 
dizinleri web'den erişilemez kalır (bir katman yukarıda).

### Ortam Değişkenleri
```bash
APP_ENV=production
APP_DEBUG=false
DB_HOST=your.database.host
DB_DATABASE=production_db
DB_USERNAME=db_user
DB_PASSWORD=secure_password
```

### Güvenlik Önerileri
1. **HTTPS zorunlu yapın** — tüm çerezler Secure flag ile
2. **Veritabanını düzenli yedekleyin** — `php database/backup.php` günlük çalıştırın
3. **Giriş günlüklerini izleyin** — şüpheli faaliyetler için
4. **Rate limiting tunelanması** — yüksek trafikte limitler ayarlayın
5. **Google araçlarını bağlayın** — Phase 5'de yapılandırılan krediler

### Performans
- Veri tabanı sorguları PDO prepare statement kullanarak SQL injection'dan korunur
- Router önbelleğe almayı desteklemek için genişletebilir
- Bootstrap CSS local sunulur (CDN gecikmesi yok)
- SVG ikonlar inline (HTTP istekleri azaltılır)

## Geliştirme İçin Notlar

### Folder Yapısı
```
public/              — Web kökü (index.php, assets)
app/
  Views/             — PHP şablonları (layouts, pages, partials)
  Data/              — Phase 1 veri dizileri (fallback)
  Models/            — Veritabanı modelleri (15+ sınıf)
  Services/          — İş mantığı (AuthService vb.)
  Support/           — Yardımcı fonksiyonlar (helpers, SEO, CSRF, RateLimiter)
  Router/            — Routing sınıfı
  Database/          — PDO sarmalayıcısı ve QueryBuilder
config/              — Uygulama yapılandırması
database/
  migrations/        — SQL şema ve kurulum
  setup.php          — Veritabanı başlatma
  backup.php         — Yedekleme aracı
routes/
  web.php            — Halkla açık rotalar
  admin.php          — Yönetim paneli rotaları
storage/             — Loglar ve yedekler
```

### Yönetim Paneli Giriş (Varsayılan)
- **E-posta:** admin@bornova.com
- **Şifre:** password
- ⚠️ Üretimde değiştirin!

## Lisans
Proprietary — Bornova Su Kaçak Tespiti için özel yazılım

## Klasör Yapısı

```
public/            Web kök dizini (index.php, css/js/img/font varlıkları)
app/Views/         Sayfa/şablon/bileşen görünümleri (PHP include tabanlı)
app/Data/          Faz 1 için düz veri dizileri (Faz 2'de veritabanı modelleriyle değişecek)
app/Support/       Ortak yardımcı fonksiyonlar (e(), asset(), icon() vb.)
config/            Uygulama ayarları
routes/            Rota tanımları (Faz 2'de doldurulacak)
database/          Migration/şema dosyaları (Faz 2'de doldurulacak)
storage/           Log/önbellek dizinleri
```

## Notlar

- Görsel yerine, marka renklerine uygun gradyan + SVG ikon kullanılmıştır
  (`data-placeholder="true"` ile işaretlidir). Gerçek fotoğraflar Faz 3'teki
  medya yöneticisinden yüklenecektir.
- "Google'dan Doğrulanmış" rozeti yalnızca `app/Data/site.php` içindeki
  `google_reviews_verified` gerçek bir Google API/GBP bağlantısıyla `true`
  olduğunda gösterilir; sahte doğrulama rozeti asla gösterilmez.
- Fontlar (Inter, Manrope) ve Bootstrap 5 grid/utilities CSS'i üçüncü taraf
  CDN'e bağımlı kalmamak için `public/assets/` altında yerel olarak sunulur.
