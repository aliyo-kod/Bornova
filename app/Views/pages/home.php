<?php
/**
 * Homepage view. All data arrives via variables set by public/index.php
 * (Phase 1: from app/Data/*.php; Phase 2: from DB-backed models with the
 * same shapes, so this file will not need to change).
 */
include __DIR__ . '/../layouts/header.php';
include __DIR__ . '/../partials/home/hero.php';
include __DIR__ . '/../partials/home/services.php';
include __DIR__ . '/../partials/home/reviews.php';
include __DIR__ . '/../partials/home/videos.php';
include __DIR__ . '/../partials/home/blog-faq.php';
include __DIR__ . '/../layouts/footer.php';
