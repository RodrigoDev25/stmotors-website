<?php
defined('ADMIN_LOADED') or die(http_response_code(403));

require_once __DIR__ . '/auth.php';

if (!isAuthenticated()) {
    header('Location: /admin/login.php');
    exit;
}