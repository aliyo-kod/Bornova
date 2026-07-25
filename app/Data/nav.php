<?php
/**
 * Phase 1 stand-in for the future `menus`/`menu_items` tables.
 */
return [
    [
        'label' => 'Anasayfa',
        'url'   => '/',
    ],
    [
        'label' => 'Su Kaçağı Tespiti',
        'url'   => '/hizmet/su-kacagi-tespiti',
        'children' => [
            ['label' => 'Kırmadan Su Kaçağı Tespiti', 'url' => '/hizmet/su-kacagi-tespiti/kirmadan-tespit'],
            ['label' => 'Termal Kamera ile Tespit', 'url' => '/hizmet/su-kacagi-tespiti/termal-kamera-ile-tespit'],
            ['label' => 'Akustik Dinleme ile Tespit', 'url' => '/hizmet/su-kacagi-tespiti/akustik-dinleme-ile-tespit'],
            ['label' => 'Su Basınç Testi', 'url' => '/hizmet/su-kacagi-tespiti/su-basinc-testi'],
            ['label' => 'Nem Ölçümü', 'url' => '/hizmet/su-kacagi-tespiti/nem-olcumu'],
            ['label' => 'Kamera ile Boru Görüntüleme', 'url' => '/hizmet/su-kacagi-tespiti/kamera-ile-boru-goruntuleme'],
            ['label' => 'Kaçak Tespit Raporu', 'url' => '/hizmet/su-kacagi-tespiti/kacak-tespit-raporu'],
        ],
    ],
    [
        'label' => 'Tıkanıklık Açma',
        'url'   => '/hizmet/tikaniklik-acma',
        'children' => [
            ['label' => 'Lavabo Tıkanıklığı Açma', 'url' => '/hizmet/tikaniklik-acma/lavabo-tikanikligi-acma'],
            ['label' => 'Tuvalet Tıkanıklığı Açma', 'url' => '/hizmet/tikaniklik-acma/tuvalet-tikanikligi-acma'],
            ['label' => 'Gider Tıkanıklığı Açma', 'url' => '/hizmet/tikaniklik-acma/gider-tikanikligi-acma'],
            ['label' => 'Rögar Tıkanıklığı Açma', 'url' => '/hizmet/tikaniklik-acma/rogar-tikanikligi-acma'],
            ['label' => 'Kanal Tıkanıklığı Açma', 'url' => '/hizmet/tikaniklik-acma/kanal-tikanikligi-acma'],
            ['label' => 'Kameralı Tıkanıklık Tespiti', 'url' => '/hizmet/tikaniklik-acma/kameeali-tikaniklik-tespiti'],
        ],
    ],
    [
        'label' => 'Tesisat Kurulumu',
        'url'   => '/hizmet/tesisat-kurulumu',
        'children' => [
            ['label' => 'Temiz Su Tesisatı', 'url' => '/hizmet/tesisat-kurulumu/temiz-su-tesisati'],
            ['label' => 'Pis Su Tesisatı', 'url' => '/hizmet/tesisat-kurulumu/pis-su-tesisati'],
            ['label' => 'Doğalgaz Tesisatı', 'url' => '/hizmet/tesisat-kurulumu/dogalgaz-tesisati'],
            ['label' => 'Kalorifer Tesisatı', 'url' => '/hizmet/tesisat-kurulumu/kalorifer-tesisati'],
            ['label' => 'Bahçe Sulama Tesisatı', 'url' => '/hizmet/tesisat-kurulumu/bahce-sulama-tesisati'],
            ['label' => 'Tadilat Tesisat İşleri', 'url' => '/hizmet/tesisat-kurulumu/tadilat-tesisat-isleri'],
        ],
    ],
    [
        'label' => 'Petek/Kombi',
        'url'   => '/hizmet/petek-kombi',
        'children' => [
            ['label' => 'Kombi Bakım ve Onarım', 'url' => '/hizmet/petek-kombi/kombi-bakim-ve-onarim'],
            ['label' => 'Petek Temizleme', 'url' => '/hizmet/petek-kombi/petek-temizleme'],
            ['label' => 'Petek Montajı', 'url' => '/hizmet/petek-kombi/petek-montaji'],
            ['label' => 'Kombi Montajı', 'url' => '/hizmet/petek-kombi/kombi-montaji'],
            ['label' => 'Kombi Arıza Tespiti', 'url' => '/hizmet/petek-kombi/kombi-ariza-tespiti'],
            ['label' => 'Petek Vanası Değişimi', 'url' => '/hizmet/petek-kombi/petek-vanasi-degisimi'],
        ],
    ],
    [
        'label' => 'Bölgeler',
        'url'   => '/bolgeler',
        'children' => [
            ['label' => 'Bornova', 'url' => '/bolge/bornova'],
            ['label' => 'Kazımdirik', 'url' => '/bolge/kazimdirik'],
            ['label' => 'Evka 3', 'url' => '/bolge/evka-3'],
            ['label' => 'Mevlana', 'url' => '/bolge/mevlana'],
            ['label' => 'Pınarbaşı', 'url' => '/bolge/pinarbasi'],
            ['label' => 'Erzene', 'url' => '/bolge/erzene'],
            ['label' => 'Çamdibi', 'url' => '/bolge/camdibi'],
            ['label' => 'Altındağ', 'url' => '/bolge/altindag'],
            ['label' => 'Işıkkent', 'url' => '/bolge/isikkent'],
            ['label' => 'Naldöken', 'url' => '/bolge/naldoken'],
            ['label' => 'Yeşilova', 'url' => '/bolge/yesilova'],
            ['label' => 'Doğanlar', 'url' => '/bolge/doganlar'],
        ],
    ],
    [
        'label' => 'Blog',
        'url'   => '/blog',
    ],
    [
        'label' => 'İletişim',
        'url'   => '/iletisim',
    ],
];
