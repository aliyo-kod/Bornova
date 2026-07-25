<?php
/**
 * Phase 1 stand-in for the `reviews` table (manual-entry shape).
 * The section-level "Google doğrulanmış" badge is controlled separately by
 * site.php's google_reviews_verified flag, which Phase 2+ must only set true
 * once a real Google Business Profile / Places API connection exists.
 */
return [
    [
        'name'    => 'Mehmet A.',
        'time_ago'=> '2 hafta önce',
        'rating'  => 5,
        'text'    => 'Evimdeki su kaçağını kırmadan tespit ettiler. Çok profesyonel ve ilgili bir ekip. Kesinlikle tavsiye ederim.',
    ],
    [
        'name'    => 'Seda Y.',
        'time_ago'=> '3 hafta önce',
        'rating'  => 5,
        'text'    => 'Tıkanan lavabo için geldiler, kısa sürede sorunu çözdüler. Fiyatları uygun, hizmetleri harika.',
    ],
    [
        'name'    => 'Hasan D.',
        'time_ago'=> '1 ay önce',
        'rating'  => 5,
        'text'    => 'Kombi bakım ve petek temizliği yaptırdım. Hem hızlı hem de titiz bir çalışma oldu. Teşekkürler.',
    ],
    [
        'name'    => 'Ayşe K.',
        'time_ago'=> '1 ay önce',
        'rating'  => 5,
        'text'    => 'Su kaçağını noktasal tespit ettiler, hiç kırmadan işlem yaptılar. Gerçekten işinin ehli bir ekip.',
    ],
];
