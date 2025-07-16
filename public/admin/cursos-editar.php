<?php
require_once '../../src/controllers/CursoController.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    header('Location: cursos.php');
    exit;
}

$curso = CursoController::buscarPorId($id);
if (!$curso) {
    header('Location: cursos.php');
    exit;
}

$mensagem = CursoController::atualizar($id);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Curso - Admin Revvo</title>
    <link rel="stylesheet" href="assets/css/admin.css">
    <link rel="stylesheet" href="assets/css/forms.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="admin-container">
        <!-- Header -->
        <header class="admin-header">
            <h1><i class="fas fa-edit"></i> Editar Curso</h1>
            <nav class="admin-nav">
                <a href="index.php"><i class="fas fa-home"></i> Dashboard</a>
                <a href="cursos.php" class="active"><i class="fas fa-graduation-cap"></i> Cursos</a>
                <a href="slideshow.php"><i class="fas fa-images"></i> Slideshow</a>
                <a href="../index.php"><i class="fas fa-external-link-alt"></i> Ver Site</a>
            </nav>
        </header>

        <!-- Main Content -->
        <main class="admin-main">
            <div class="content-header">
                <h2>Editar Curso: <?php echo $curso['titulo']; ?></h2>
                <a href="cursos.php" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Voltar
                </a>
            </div>

            <?php if ($mensagem): ?>
                <div class="message message-error">
                    <i class="fas fa-exclamation-triangle"></i>
                    <?php echo $mensagem; ?>
                </div>
            <?php endif; ?>

            <div class="form-container">
                <form method="POST" enctype="multipart/form-data" class="admin-form">
                    <div class="form-group">
                        <label for="titulo">Título *</label>
                        <input type="text" id="titulo" name="titulo" value="<?php echo htmlspecialchars($curso['titulo']); ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="descricao">Descrição</label>
                        <textarea id="descricao" name="descricao" rows="4"><?php echo htmlspecialchars($curso['descricao']); ?></textarea>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="preco">Preço</label>
                            <input type="number" id="preco" name="preco" step="0.01" min="0" value="<?php echo $curso['preco']; ?>">
                        </div>

                        <div class="form-group">
                            <label for="duracao">Duração</label>
                            <input type="text" id="duracao" name="duracao" value="<?php echo htmlspecialchars($curso['duracao']); ?>" placeholder="ex: 2h 30min">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="categoria">Categoria</label>
                            <input type="text" id="categoria" name="categoria" value="<?php echo htmlspecialchars($curso['categoria']); ?>">
                        </div>

                        <div class="form-group">
                            <label for="status">Status</label>
                            <select id="status" name="status">
                                <option value="ativo" <?php echo $curso['status'] == 'ativo' ? 'selected' : ''; ?>>Ativo</option>
                                <option value="inativo" <?php echo $curso['status'] == 'inativo' ? 'selected' : ''; ?>>Inativo</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="imagem">Imagem</label>
                        <?php if ($curso['imagem']): ?>
                            <div class="current-image">
                                <img src="../assets/images/<?php echo $curso['imagem']; ?>" alt="Imagem atual" style="max-width: 200px; margin-bottom: 1rem;">
                                <p><i class="fas fa-image"></i> Imagem atual: <?php echo $curso['imagem']; ?></p>
                            </div>
                        <?php endif; ?>
                        <input type="file" id="imagem" name="imagem" accept="image/*">
                        <small><i class="fas fa-info-circle"></i> Deixe em branco para manter a imagem atual</small>
                        <div class="image-preview-container">
                            <img id="preview" class="image-preview" style="display: none;">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="link">Link do Curso</label>
                        <input type="text" id="link" name="link" value="<?php echo htmlspecialchars($curso['link'] ?? ''); ?>" placeholder="https://...">
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Atualizar Curso
                        </button>
                        <a href="cursos.php" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </main>
    </div>

    <script src="assets/js/admin.js"></script>
    <script src="assets/js/forms.js"></script>
</body>
</html> 