# Bornova Su Kaçak Tespiti

Kurumsal tanıtım sitesi + yönetim paneli projesi. Bu depo aşamalı olarak geliştirilmektedir.

## Mevcut Durum: Faz 2 — Veritabanı & Yönlendirme Altyapısı

**Faz 1** (Anasayfa Ön Yüzü) tamamlandı ve push edildi.

**Faz 2** ek sayfalar ve veritabanı entegrasyonu sunmaktadır:
- MySQL 8 schema (~35 tablo) ile PDO bağlantısı
- Router sınıfı ve routes/web.php yönlendirmesi
- Model sınıfları (HeroSlider, Service, Review, Video, Post, Faq, Region, Page, SiteConfig vb.)
- Modeller `toArray()` metodu üzerinden Faz 1 veri dizileriyle aynı şekle dönüştürür, bu nedenle görünümler değiştirilmez
- Hala Faz 1 `app/Data/*.php` dizilerine sahiptir, bunlar veritabanı bağlantısı başarısız olursa fallback olarak kullanılır

Henüz **yapılmayanlar** (sıradaki fazlar): Yönetim paneli ve kimlik doğrulama, CRM lead pipeline,
Google araçları/Ads entegrasyonu, SEO otomasyonu (sitemap/robots/schema), form gönderimi ve e-posta bildirimleri,
güvenlik sertleştirmesi (CSRF, rate limiting vb.).

## Çalıştırma

### Kurulum (Faz 2)

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
   
### Fallback Modu (Veritabanı Yok)

Veritabanı bağlantısı başarısız olursa, sistem otomatik olarak `app/Data/*.php` dizileri kullanır.
Bu, Faz 1 ön yüzünü herhangi bir veritabanı olmadan çalıştırmanızı sağlar.

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
