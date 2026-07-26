<?php
/**
 * Phase 1 stand-in for the future `settings` table.
 * Shape mirrors what Phase 2 will load from the database, so views never change.
 */
return [
    'site_name'        => 'Bornova Su Kaçak Tespiti',
    // Aliases used by service/blog/legal page templates (same values as above).
    'name'             => 'Bornova Su Kaçak Tespiti',
    'tagline'          => 'Bornova ve çevresinde kırmadan, dökmeden su kaçağı tespiti ve tesisat hizmeti sunuyoruz.',
    'url'              => 'https://bornovakacaksutespiti.com',
    'phone'            => '0232 123 45 67',
    'phone_display'    => '0232 123 45 67',
    'phone_tel'        => '+902321234567',
    'phone_secondary'  => '0532 123 45 67',
    'whatsapp_number'  => '905321234567',
    'email'            => 'info@bornovasukacagitespiti.com',
    'address'          => 'Bornova / İzmir',
    'working_hours'    => 'Bornova ve Çevresine 7/24 Hizmet',
    'facebook_url'     => 'https://facebook.com/bornovasukacaktespiti',
    'instagram_url'    => 'https://instagram.com/bornovasukacaktespiti',
    'whatsapp_url'     => 'https://wa.me/905321234567',

    // Phase 2+: must only ever be true when a real Google Business Profile /
    // Places API connection is configured in the admin panel. Manual reviews
    // entered without that connection must never be labeled "doğrulanmış".
    'google_reviews_verified' => false,
];
