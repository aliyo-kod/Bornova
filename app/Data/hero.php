<?php
/**
 * Phase 1 stand-in for the `sliders` table. Returning an array of slides
 * (even with one item now) means the future hero-slider JS/markup doesn't
 * need to change shape when Phase 2 adds more slides from the admin.
 */
return [
    [
        'eyebrow'     => 'PROFESYONEL',
        'title_line1' => 'SU KAÇAĞI TESPİTİNDE',
        'title_accent'=> '%100 KESİN ÇÖZÜM!',
        'description' => 'Son teknoloji cihazlarımızla kırmadan, dökmeden su kaçaklarınızı tespit ediyor, kalıcı çözümler sunuyoruz.',
        'badges' => [
            ['icon' => 'icon-target', 'label' => '%100 Kesin Tespit'],
            ['icon' => 'icon-drop-off', 'label' => 'Kırmadan Dökmeden'],
            ['icon' => 'icon-shield', 'label' => 'Garantili Hizmet'],
            ['icon' => 'icon-clock', 'label' => '7/24 Hizmet'],
        ],
        'stat_card' => [
            ['icon' => 'icon-calendar', 'label' => 'Aynı Gün Randevu'],
            ['icon' => 'icon-tag', 'label' => 'Uygun Fiyat'],
            ['icon' => 'icon-users', 'label' => 'Deneyimli Ekip'],
            ['icon' => 'icon-shield', 'label' => 'Garantili Hizmet'],
        ],
    ],
];
