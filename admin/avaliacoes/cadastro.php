<?php
define('ADMIN_LOADED', true);
require_once __DIR__ . '/../includes/admin-guard.php';
require_once __DIR__ . '/../../includes/db.php';

$erro    = '';
$sucesso = '';
$csrf    = getCsrfToken();

// ============================================================
// UPLOAD CONFIG
// ============================================================
const UPLOAD_DIR = __DIR__ . '/../../assets/images/avaliacoes/';
const UPLOAD_URL_BASE = '/assets/images/avaliacoes/';
const UPLOAD_MAX_MB   = 5;
const UPLOAD_ALLOWED = ['image/jpeg', 'image/png', 'image/webp', 'image/heic', 'image/heif'];

// ============================================================
// AÇÕES POST
// ============================================================
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!validateCsrfToken($_POST['csrf_token'] ?? '')) {
        $erro = 'Requisição inválida.';
    } else {
        $acao = $_POST['acao'] ?? '';

        // --- SALVAR NOVA AVALIAÇÃO ---
        if ($acao === 'salvar') {
            $nome  = trim($_POST['nome'] ?? '');
            $texto = trim($_POST['texto'] ?? '');
            $ordem = (int) ($_POST['ordem'] ?? 0);
            $foto  = null;

            if (empty($nome)) {
                $erro = 'O nome é obrigatório.';
            } elseif (mb_strlen($nome) > 100) {
                $erro = 'Nome muito longo (máximo 100 caracteres).';
            } elseif (empty($texto)) {
                $erro = 'O texto da avaliação é obrigatório.';
            } else {
                // Upload de foto (opcional)
                if (!empty($_FILES['foto']['name'])) {
                    $file     = $_FILES['foto'];
                    $maxBytes = UPLOAD_MAX_MB * 1024 * 1024;

                    if ($file['size'] > $maxBytes) {
                        $erro = 'Foto muito grande. Máximo ' . UPLOAD_MAX_MB . 'MB.';
                    } elseif (!in_array($file['type'], UPLOAD_ALLOWED, true)) {
                        $erro = 'Formato inválido. Use JPG, PNG, Heic, Heif ou WebP.';
                    } else {
                        // Verificar magic bytes (não confiar apenas no MIME do browser)
                        $finfo    = new finfo(FILEINFO_MIME_TYPE);
                        $mimeReal = $finfo->file($file['tmp_name']);

                        if (!in_array($mimeReal, UPLOAD_ALLOWED, true)) {
                            $erro = 'Arquivo inválido.';
                        } else {
                            if (!is_dir(UPLOAD_DIR)) {
                                mkdir(UPLOAD_DIR, 0755, true);
                            }

                            $ext      = pathinfo($file['name'], PATHINFO_EXTENSION);
                            $filename = bin2hex(random_bytes(12)) . '.' . strtolower($ext);
                            $destino  = UPLOAD_DIR . $filename;

                            if (move_uploaded_file($file['tmp_name'], $destino)) {
                                $foto = UPLOAD_URL_BASE . $filename;
                            } else {
                                $erro = 'Erro ao salvar a foto.';
                            }
                        }
                    }
                }

                if (empty($erro)) {
                    try {
                        $db = getDB();
                        $st = $db->prepare(
                            'INSERT INTO avaliacoes (nome, texto, foto, ordem) VALUES (?, ?, ?, ?)'
                        );
                        $st->execute([$nome, $texto, $foto, $ordem]);
                        $sucesso = 'Avaliação cadastrada com sucesso.';
                    } catch (PDOException $e) {
                        $erro = 'Erro ao salvar no banco de dados.';
                    }
                }
            }
        }

        // --- EXCLUIR AVALIAÇÃO ---
        if ($acao === 'excluir') {
            $id = (int) ($_POST['id'] ?? 0);
            if ($id > 0) {
                try {
                    $db = getDB();

                    // Recuperar foto para deletar do disco
                    $st = $db->prepare('SELECT foto FROM avaliacoes WHERE id = ?');
                    $st->execute([$id]);
                    $row = $st->fetch();

                    if ($row && $row['foto']) {
                        $fPath = __DIR__ . '/../../../' . ltrim($row['foto'], '/');
                        if (file_exists($fPath)) unlink($fPath);
                    }

                    $db->prepare('DELETE FROM avaliacoes WHERE id = ?')->execute([$id]);
                    $sucesso = 'Avaliação removida.';
                } catch (PDOException $e) {
                    $erro = 'Erro ao remover avaliação.';
                }
            }
        }

        // --- TOGGLE ATIVO ---
        if ($acao === 'toggle_ativo') {
            $id    = (int) ($_POST['id'] ?? 0);
            $atual = (int) ($_POST['ativo'] ?? 1);
            if ($id > 0) {
                try {
                    $db = getDB();
                    $db->prepare('UPDATE avaliacoes SET ativo = ? WHERE id = ?')
                        ->execute([$atual ? 0 : 1, $id]);
                    $sucesso = 'Status atualizado.';
                } catch (PDOException $e) {
                    $erro = 'Erro ao atualizar status.';
                }
            }
        }
    }
}

// ============================================================
// LISTAR AVALIAÇÕES
// ============================================================
$avaliacoes = [];
try {
    $db = getDB();
    $avaliacoes = $db->query(
        'SELECT * FROM avaliacoes ORDER BY ordem ASC, criado_em DESC'
    )->fetchAll();
} catch (PDOException $e) {
    $erro = 'Erro ao carregar avaliações.';
}

$csrf = getCsrfToken();
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Avaliações — ST Motors Admin</title>
    <meta name="robots" content="noindex, nofollow">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/admin/assets/admin.css">
    <link rel="stylesheet" href="/admin/assets/cadastro.css">
</head>

<body class="dashboard-page">

    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar" aria-label="Menu administrativo">
        <div class="sidebar__logo">
            <img src="/assets/images/logo-header.svg" alt="ST Motors" width="120" height="42">
        </div>
        <nav class="sidebar__nav" aria-label="Navegação do painel">
            <ul class="sidebar__list">
                <li class="sidebar__item">
                    <a href="/admin/dashboard.php" class="sidebar__link">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <rect x="3" y="3" width="7" height="7" />
                            <rect x="14" y="3" width="7" height="7" />
                            <rect x="14" y="14" width="7" height="7" />
                            <rect x="3" y="14" width="7" height="7" />
                        </svg>
                        Dashboard
                    </a>
                </li>
                <li class="sidebar__item">
                    <a href="/admin/motos/cadastro.php" class="sidebar__link">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <circle cx="5" cy="17" r="3" />
                            <circle cx="19" cy="17" r="3" />
                            <path d="M7 17h5l3-5h3" />
                            <path d="M10 12l1.5-3h3" />
                            <path d="M14.5 9h2.5" />
                            <path d="M8 12h4" />
                        </svg>
                        Cadastro de Motos
                    </a>
                </li>
                <li class="sidebar__item">
                    <a href="/admin/avaliacoes/cadastro.php" class="sidebar__link sidebar__link--active">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                        </svg>
                        Avaliações Google
                    </a>
                </li>
            </ul>
        </nav>
        <div class="sidebar__footer">
            <a href="/admin/dashboard.php?logout=1&token=<?= htmlspecialchars($csrf, ENT_QUOTES, 'UTF-8') ?>" class="sidebar__logout" aria-label="Sair do painel">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
                    <polyline points="16 17 21 12 16 7" />
                    <line x1="21" y1="12" x2="9" y2="12" />
                </svg>
                Sair
            </a>
        </div>
    </aside>

    <div class="admin-layout">

        <header class="topbar" role="banner">
            <button class="topbar__toggle" id="sidebar-toggle" aria-label="Abrir menu lateral" aria-expanded="false" aria-controls="sidebar">
                <span></span><span></span><span></span>
            </button>
            <h1 class="topbar__title">Avaliações Google</h1>
        </header>

        <main class="admin-main" id="main-content">
            <div class="admin-content" style="max-width: 800px;">

                <?php if ($sucesso): ?>
                    <div class="alert alert--success" role="alert">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <polyline points="20 6 9 17 4 12" />
                        </svg>
                        <?= htmlspecialchars($sucesso, ENT_QUOTES, 'UTF-8') ?>
                    </div>
                <?php endif; ?>

                <?php if ($erro): ?>
                    <div class="alert alert--error" role="alert">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <circle cx="12" cy="12" r="10" />
                            <line x1="15" y1="9" x2="9" y2="15" />
                            <line x1="9" y1="9" x2="15" y2="15" />
                        </svg>
                        <?= htmlspecialchars($erro, ENT_QUOTES, 'UTF-8') ?>
                    </div>
                <?php endif; ?>

                <!-- Formulário de cadastro -->
                <section class="cadastro-section">
                    <h2 class="dash-section__title">Nova Avaliação</h2>
                    <p class="dash-section__subtitle">Adicione uma avaliação que será exibida na página inicial.</p>

                    <form class="cadastro-form" method="POST" enctype="multipart/form-data" action="" novalidate>
                        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf, ENT_QUOTES, 'UTF-8') ?>">
                        <input type="hidden" name="acao" value="salvar">

                        <div class="form-row">
                            <div class="form-group">
                                <label for="nome" class="form-label">Nome do avaliador <span class="required">*</span></label>
                                <input type="text" id="nome" name="nome" class="form-input" maxlength="100" required placeholder="Ex: João Silva">
                            </div>
                            <div class="form-group">
                                <label for="ordem" class="form-label">Ordem de exibição</label>
                                <input type="number" id="ordem" name="ordem" class="form-input" min="0" value="0" placeholder="0">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="texto" class="form-label">Texto da avaliação <span class="required">*</span></label>
                            <textarea id="texto" name="texto" class="form-input form-textarea" rows="4" maxlength="600" required placeholder="Texto do comentário do cliente..."></textarea>
                            <span class="form-hint">Máximo 600 caracteres.</span>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Foto do avaliador <span class="form-hint">(opcional — JPG, PNG ou WebP, máx. 2MB)</span></label>
                            <div class="upload-area" id="upload-area">
                                <div class="upload-area__preview" id="upload-preview" hidden>
                                    <img id="preview-img" src="" alt="Prévia da foto">
                                    <button type="button" class="upload-area__remove" id="upload-remove" aria-label="Remover foto">✕</button>
                                </div>
                                <div class="upload-area__placeholder" id="upload-placeholder">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                        <rect x="3" y="3" width="18" height="18" rx="2" />
                                        <circle cx="8.5" cy="8.5" r="1.5" />
                                        <polyline points="21 15 16 10 5 21" />
                                    </svg>
                                    <span>Clique ou arraste uma imagem</span>
                                </div>
                                <input type="file" id="foto" name="foto"
                                    accept="image/jpeg,image/png,image/webp,image/heic,image/heif"
                                    class="upload-input">
                            </div>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn btn--primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <line x1="12" y1="5" x2="12" y2="19" />
                                    <line x1="5" y1="12" x2="19" y2="12" />
                                </svg>
                                Adicionar Avaliação
                            </button>
                        </div>
                    </form>
                </section>

                <!-- Lista de avaliações cadastradas -->
                <section class="cadastro-section" style="margin-top: 2rem;">
                    <h2 class="dash-section__title">Avaliações Cadastradas</h2>
                    <p class="dash-section__subtitle"><?= count($avaliacoes) ?> avaliação(ões) no total.</p>

                    <?php if (empty($avaliacoes)): ?>
                        <p class="empty-state">Nenhuma avaliação cadastrada ainda.</p>
                    <?php else: ?>
                        <ul class="avaliacoes-list">
                            <?php foreach ($avaliacoes as $av): ?>
                                <li class="avaliacao-item <?= $av['ativo'] ? '' : 'avaliacao-item--inativo' ?>">

                                    <div class="avaliacao-item__foto">
                                        <?php if ($av['foto']): ?>
                                            <img src="<?= htmlspecialchars($av['foto'], ENT_QUOTES, 'UTF-8') ?>" alt="Foto de <?= htmlspecialchars($av['nome'], ENT_QUOTES, 'UTF-8') ?>" width="48" height="48">
                                        <?php else: ?>
                                            <div class="avaliacao-item__avatar" aria-hidden="true">
                                                <?= mb_strtoupper(mb_substr($av['nome'], 0, 1)) ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>

                                    <div class="avaliacao-item__info">
                                        <strong class="avaliacao-item__nome"><?= htmlspecialchars($av['nome'], ENT_QUOTES, 'UTF-8') ?></strong>
                                        <p class="avaliacao-item__texto"><?= htmlspecialchars(mb_substr($av['texto'], 0, 100), ENT_QUOTES, 'UTF-8') ?><?= mb_strlen($av['texto']) > 100 ? '…' : '' ?></p>
                                        <span class="avaliacao-item__status"><?= $av['ativo'] ? 'Visível' : 'Oculta' ?></span>
                                    </div>

                                    <div class="avaliacao-item__actions">

                                        <!-- Toggle ativo -->
                                        <form method="POST" action="">
                                            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf, ENT_QUOTES, 'UTF-8') ?>">
                                            <input type="hidden" name="acao" value="toggle_ativo">
                                            <input type="hidden" name="id" value="<?= (int) $av['id'] ?>">
                                            <input type="hidden" name="ativo" value="<?= (int) $av['ativo'] ?>">
                                            <button type="submit" class="btn-icon <?= $av['ativo'] ? 'btn-icon--warning' : 'btn-icon--success' ?>" title="<?= $av['ativo'] ? 'Ocultar' : 'Exibir' ?>">
                                                <?php if ($av['ativo']): ?>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                                        <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94" />
                                                        <path d="M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19" />
                                                        <line x1="1" y1="1" x2="23" y2="23" />
                                                    </svg>
                                                <?php else: ?>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                                                        <circle cx="12" cy="12" r="3" />
                                                    </svg>
                                                <?php endif; ?>
                                            </button>
                                        </form>

                                        <!-- Excluir -->
                                        <form method="POST" action="" onsubmit="return confirm('Excluir esta avaliação permanentemente?')">
                                            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf, ENT_QUOTES, 'UTF-8') ?>">
                                            <input type="hidden" name="acao" value="excluir">
                                            <input type="hidden" name="id" value="<?= (int) $av['id'] ?>">
                                            <button type="submit" class="btn-icon btn-icon--danger" title="Excluir">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                                    <polyline points="3 6 5 6 21 6" />
                                                    <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6" />
                                                    <path d="M10 11v6" />
                                                    <path d="M14 11v6" />
                                                    <path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2" />
                                                </svg>
                                            </button>
                                        </form>

                                    </div>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </section>

            </div>
        </main>
    </div>

    <div class="sidebar-overlay" id="sidebar-overlay" aria-hidden="true"></div>

    <script src="/admin/assets/admin.js" defer></script>
    <script src="/admin/assets/cadastro.js" defer></script>
</body>

</html>