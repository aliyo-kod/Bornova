# Bornova Su Kaçak Tespiti

Kurumsal tanıtım sitesi + yönetim paneli projesi. Bu depo aşamalı olarak geliştirilmektedir.

## Mevcut Durum: Faz 1 — Anasayfa Ön Yüzü

Şu anda yalnızca **anasayfanın masaüstü ve mobil ön yüzü** tamamlanmıştır. İçerikler
`app/Data/*.php` altında düz PHP dizileri olarak tutulmaktadır; bu diziler Faz 2'de
veritabanından gelecek verilerle aynı şekle sahiptir, böylece görünüm dosyaları
yeniden yazılmadan veri kaynağı değiştirilebilecektir.

Henüz **yapılmayanlar** (sıradaki fazlar): MySQL veritabanı ve PDO bağlantısı, iç
sayfalar/route yönlendirme, yönetim paneli, CRM, Google araçları/Ads entegrasyonu,
SEO otomasyonu (sitemap/robots/schema), form gönderimi ve e-posta bildirimleri,
güvenlik sertleştirmesi (CSRF, rate limiting vb.).

## Çalıştırma (Faz 1)

```bash
php -S localhost:8000 -t public
```

Tarayıcıda `http://localhost:8000` adresini açın.

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
