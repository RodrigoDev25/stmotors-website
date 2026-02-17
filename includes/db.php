<?php
// ============================================================
// CONFIGURAÇÕES DO BANCO — altere antes de subir ao servidor
// Encontre esses dados em: hPanel → Bancos de Dados → MySQL
// ============================================================
define('DB_HOST', 'localhost');
define('DB_NAME', 'u583423626_st_bd');      // ← nome do banco criado na Hostinger
define('DB_USER', 'u583423626_st_user');    // ← usuário do banco
define('DB_PASS', 'sT@996128768');   // ← senha do banco
define('DB_CHARSET', 'utf8mb4');

function getDB(): PDO {
    static $pdo = null;

    if ($pdo !== null) return $pdo;

    $dsn = sprintf(
        'mysql:host=%s;dbname=%s;charset=%s',
        DB_HOST, DB_NAME, DB_CHARSET
    );

    $pdo = new PDO($dsn, DB_USER, DB_PASS, [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ]);

    return $pdo;
}