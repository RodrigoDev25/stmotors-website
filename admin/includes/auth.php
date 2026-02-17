<?php
defined('ADMIN_LOADED') or die(http_response_code(403));

// ============================================================
// CREDENCIAIS — altere apenas aqui
// Para gerar um novo hash: php -r "echo password_hash('sua_senha', PASSWORD_BCRYPT);"
// ============================================================
const ADMIN_USERNAME = 'stmotors';
const ADMIN_PASSWORD_HASH = '$2y$12$/A1nTpBjLx5fKxjWzaT48.XLCLAxMdHvDeZbDvPvJTnyuV2GkC/3e';
// ↑ Substitua pelo hash gerado com sua senha real antes de subir ao servidor

// ============================================================
// CONFIGURAÇÕES DE SESSÃO
// ============================================================
const SESSION_LIFETIME   = 3600;   // 1 hora em segundos
const SESSION_NAME       = 'stm_admin';
const MAX_LOGIN_ATTEMPTS = 5;
const LOCKOUT_TIME       = 900;    // 15 minutos em segundos

function startAdminSession(): void {
    if (session_status() === PHP_SESSION_NONE) {
        session_name(SESSION_NAME);
        session_set_cookie_params([
            'lifetime' => 0,
            'path'     => '/admin/',
            'secure'   => true,
            'httponly' => true,
            'samesite' => 'Strict',
        ]);
        session_start();
    }
}

function isAuthenticated(): bool {
    startAdminSession();

    if (empty($_SESSION['admin_logged_in'])) return false;
    if (empty($_SESSION['admin_last_activity'])) return false;
    if (time() - $_SESSION['admin_last_activity'] > SESSION_LIFETIME) {
        destroySession();
        return false;
    }
    if (empty($_SESSION['admin_ip']) || $_SESSION['admin_ip'] !== $_SERVER['REMOTE_ADDR']) {
        destroySession();
        return false;
    }

    $_SESSION['admin_last_activity'] = time();
    regenerateSessionId();
    return true;
}

function attemptLogin(string $username, string $password): bool {
    startAdminSession();

    if (isLockedOut()) return false;

    $validUser = hash_equals(ADMIN_USERNAME, $username);
    $validPass = password_verify($password, ADMIN_PASSWORD_HASH);

    if ($validUser && $validPass) {
        resetLoginAttempts();
        session_regenerate_id(true);

        $_SESSION['admin_logged_in']     = true;
        $_SESSION['admin_last_activity'] = time();
        $_SESSION['admin_ip']            = $_SERVER['REMOTE_ADDR'];
        $_SESSION['admin_token']         = bin2hex(random_bytes(32));

        return true;
    }

    incrementLoginAttempts();
    return false;
}

function destroySession(): void {
    startAdminSession();
    $_SESSION = [];
    if (ini_get('session.use_cookies')) {
        $p = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $p['path'], $p['domain'], $p['secure'], $p['httponly']
        );
    }
    session_destroy();
}

function isLockedOut(): bool {
    $attempts  = $_SESSION['login_attempts'] ?? 0;
    $lastTime  = $_SESSION['login_last_attempt'] ?? 0;

    if ($attempts >= MAX_LOGIN_ATTEMPTS) {
        if (time() - $lastTime < LOCKOUT_TIME) return true;
        resetLoginAttempts();
    }
    return false;
}

function lockoutRemainingSeconds(): int {
    $lastTime = $_SESSION['login_last_attempt'] ?? 0;
    $remaining = LOCKOUT_TIME - (time() - $lastTime);
    return max(0, (int) $remaining);
}

function incrementLoginAttempts(): void {
    $_SESSION['login_attempts']     = ($_SESSION['login_attempts'] ?? 0) + 1;
    $_SESSION['login_last_attempt'] = time();
}

function resetLoginAttempts(): void {
    unset($_SESSION['login_attempts'], $_SESSION['login_last_attempt']);
}

function regenerateSessionId(): void {
    if (!isset($_SESSION['last_regeneration'])) {
        $_SESSION['last_regeneration'] = time();
        return;
    }
    if (time() - $_SESSION['last_regeneration'] > 300) {
        session_regenerate_id(true);
        $_SESSION['last_regeneration'] = time();
    }
}

function getCsrfToken(): string {
    startAdminSession();
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function validateCsrfToken(string $token): bool {
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}