<?php
if (!defined('APP_LOADED')) {
    http_response_code(403);
    exit;
}

header('Content-Type: text/html; charset=UTF-8');
header_remove('X-Powered-By');

header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: DENY');
header('Referrer-Policy: strict-origin-when-cross-origin');
header('Permissions-Policy: geolocation=(), microphone=(), camera=(), payment=()');

// Ativar após confirmar HTTPS estável por 24h no ar
// header('Strict-Transport-Security: max-age=31536000');

header("Content-Security-Policy: " . implode('; ', [
    "default-src 'self'",
    "script-src 'self' https://cdnjs.cloudflare.com",
    "style-src 'self' https://fonts.googleapis.com",
    "font-src 'self' https://fonts.gstatic.com",
    "img-src 'self' https: data:",
    "connect-src 'self'",
    "frame-src https://www.google.com",
    "frame-ancestors 'none'",
    "base-uri 'self'",
    "form-action 'self'",
]));
