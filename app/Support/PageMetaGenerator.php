<?php

namespace App\Support;

/**
 * Page Meta Generator
 * Expert-level title, description, and keyword generation
 * Optimized for CTR and keyword relevance
 */
class PageMetaGenerator
{
    public static function homepage(): array
    {
        return [
            'title' => 'Su Kaçağı Tespiti & Tesisat Ustası | Bornova İzmir',
            'description' => 'Profesyonel su kaçağı tespiti, tesisat kurulumu ve onarım hizmetleri. Bornova, İzmir\'de 20+ yıl deneyim. Hızlı yanıt, garantili çözüm. ✓ 24/7 Acil hizmet',
            'keywords' => 'su kaçağı tespiti, su kaçak bulma, tesisat kurulumu, Bornova, İzmir',
            'og_title' => 'Bornova Su Kaçak Tespiti - Profesyonel Su Tesisatçı',
            'og_description' => 'Su kaçağı tespiti ve onarım hizmetleri. Cihazlı tespiti ile gizli kaçakları buluyoruz.',
        ];
    }

    public static function service($service): array
    {
        $title = $service['name'] ?? 'Hizmet';
        $slug = $service['slug'] ?? 'hizmet';

        return [
            'title' => $title . ' Hizmeti | Uzman Teknisyenler | Bornova',
            'description' => 'Profesyonel ' . strtolower($title) . ' hizmetleri. Kaliteli iş, uygun fiyat. Bornova, İzmir\'de güvenilir hizmet. Ücretsiz danışmanlık alın.',
            'keywords' => strtolower($title) . ', ' . strtolower($title) . ' bornova, ' . strtolower($title) . ' izmir, tesisat',
            'canonical' => env('APP_URL', 'http://localhost:8000') . '/hizmet/' . $slug,
            'og_title' => $title . ' - Bornova Su Kaçak Tespiti',
            'og_description' => $service['short_description'] ?? 'Profesyonel ' . strtolower($title) . ' hizmetleri',
        ];
    }

    public static function region($region): array
    {
        $name = $region['name'] ?? 'Bölge';

        return [
            'title' => $name . ' Su Kaçağı Tespiti | Bornova Tesisat Ustası',
            'description' => $name . ' bölgesinde su kaçağı tespiti ve tesisat hizmetleri. Hızlı çözüm, profesyonel teknisyenler. Bilgi ve teklif için bizi arayın.',
            'keywords' => $name . ' su kaçağı, ' . $name . ' tesistat, ' . $name . ' su kaçak tespiti, bornova tesisat',
            'canonical' => env('APP_URL', 'http://localhost:8000') . '/bolge/' . ($region['slug'] ?? ''),
            'og_title' => $name . ' Su Kaçak Tespiti Hizmetleri',
            'og_description' => 'Profesyonel su kaçağı tespiti ve tesistat hizmetleri',
        ];
    }

    public static function blog($post): array
    {
        $slug = $post['slug'] ?? 'blog';

        return [
            'title' => $post['title'] . ' | Su Tesisatı Rehberi | Bornova',
            'description' => substr($post['excerpt'] ?? $post['content'] ?? '', 0, 155) . '...',
            'keywords' => 'su kaçağı, tesisat, ' . strtolower($post['category'] ?? 'blog') . ', rehber',
            'canonical' => env('APP_URL', 'http://localhost:8000') . '/blog/' . $slug,
            'og_title' => $post['title'] . ' - Bornova Su Kaçak Tespiti Blog',
            'og_description' => $post['excerpt'] ?? 'Okuyun ve öğrenin',
            'og_type' => 'article',
        ];
    }

    public static function faq(): array
    {
        return [
            'title' => 'Sıkça Sorulan Sorular | Su Kaçağı Tespiti | Bornova',
            'description' => 'Su kaçağı, tesisat ve bakım hakkında sık sorulan sorular ve cevapları. Uzmanlarımızdan bilgi alın.',
            'keywords' => 'su kaçağı soruları, tesisat soruları, sss, faq, bornova',
            'og_title' => 'Sıkça Sorulan Sorular - Bornova Su Kaçak Tespiti',
            'og_description' => 'Tüm sorularınızın cevaplarını bulun',
        ];
    }

    public static function blog_list(): array
    {
        return [
            'title' => 'Su Tesisatı Rehberi & İpuçları | Blog | Bornova',
            'description' => 'Su kaçağı tespiti, tesisat onarım ve bakım hakkında faydalı makaleler, ipuçları ve rehberler. Uzmanlar tarafından yazılmış.',
            'keywords' => 'su tesisatı blog, su kaçağı rehberi, tesisat ipuçları, bakım, onarım',
            'og_title' => 'Blog - Bornova Su Kaçak Tespiti',
            'og_description' => 'Faydalı makaleler ve rehberler',
        ];
    }

    public static function contact(): array
    {
        return [
            'title' => 'İletişim | Bornova Su Kaçak Tespiti | Acil Hizmet',
            'description' => 'Bornova Su Kaçak Tespiti ile iletişime geçin. Acil hizmetler için hemen çağırın. Ücretsiz danışmanlık ve teklif. Tel: +90 555 123 4567',
            'keywords' => 'iletişim, bornova su kaçağı, tesisat ustası, acil hizmet, telefon',
            'og_title' => 'Bornova Su Kaçak Tespiti - İletişim & Bilgi',
            'og_description' => 'Hızlı yanıt ve profesyonel hizmet için biz arayın',
        ];
    }

    public static function about(): array
    {
        return [
            'title' => 'Hakkımızda | Bornova Su Kaçak Tespiti | Deneyim & Kalite',
            'description' => '20+ yıl deneyim ile profesyonel su kaçağı tespiti hizmetleri. Güvenilir, hızlı ve garantili çözümler. Bornova, İzmir\'de en güvenilir tesisat ustası.',
            'keywords' => 'hakkımızda, bornova tesisat, deneyim, uzman teknisyen, kalite',
            'og_title' => 'Bornova Su Kaçak Tespiti - Hakkımızda',
            'og_description' => 'Profesyonel su tesisatçı, deneyim ve güvenilirlik',
        ];
    }

    public static function reviews(): array
    {
        return [
            'title' => 'Müşteri Yorumları | Bornova Su Kaçak Tespiti | Referanslar',
            'description' => 'Bornova Su Kaçak Tespiti\'nin müşterilerinin gerçek yorumları. Kalitesi ve hizmet mükemmelliği için 4.8/5 yıldız.',
            'keywords' => 'müşteri yorumları, referanslar, değerlendirmeler, bornova tesisat',
            'og_title' => 'Müşteri Yorumları - Bornova Su Kaçak Tespiti',
            'og_description' => 'Müşterilerimiz ne düşünüyor?',
        ];
    }

    public static function privacy(): array
    {
        return [
            'title' => 'Gizlilik Politikası | Bornova Su Kaçak Tespiti',
            'description' => 'Bornova Su Kaçak Tespiti gizlilik politikası. Kişisel verileriniz nasıl korunur?',
            'keywords' => 'gizlilik, politika, kişisel veriler',
            'og_title' => 'Gizlilik Politikası',
            'og_description' => 'Verileriniz güvenle korunur',
        ];
    }

    public static function kvkk(): array
    {
        return [
            'title' => 'KVKK & Veri Koruma | Bornova Su Kaçak Tespiti',
            'description' => 'KVKK kapsamında kişisel verileriniz nasıl işlendiğini öğrenin.',
            'keywords' => 'kvkk, veri koruma, kişisel veriler',
            'og_title' => 'Kişisel Veri Koruma',
            'og_description' => 'Verileriniz KVKK ile korunur',
        ];
    }

    public static function terms(): array
    {
        return [
            'title' => 'Kullanıcı Sözleşmesi | Bornova Su Kaçak Tespiti',
            'description' => 'Bornova Su Kaçak Tespiti kullanıcı sözleşmesi ve hizmet şartları.',
            'keywords' => 'sözleşme, şartlar, koşullar',
            'og_title' => 'Kullanıcı Sözleşmesi',
            'og_description' => 'Hizmet şartlarını öğrenin',
        ];
    }
}
