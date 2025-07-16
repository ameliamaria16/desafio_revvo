<?php
require_once '../../src/controllers/SlideshowController.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    header('Location: slideshow.php');
    exit;
}

$slide = SlideshowController::buscarPorId($id);
if (!$slide) {
    header('Location: slideshow.php');
    exit;
}

$mensagem = SlideshowController::atualizar($id);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Slide - Admin Revvo</title>
    <link rel="stylesheet" href="assets/css/admin.css">
    <link rel="stylesheet" href="assets/css/forms.css">
</head>
<body>
    <div class="admin-container">
        <header class="admin-header">
            <h1>Editar Slide</h1>
            <nav class="admin-nav">
                <a href="index.php">Dashboard</a>
                <a href="cursos.php">Cursos</a>
                <a href="slideshow.php" class="active">Slideshow</a>
                <a href="../index.php">Ver Site</a>
            </nav>
        </header>
        <main class="admin-main">
            <div class="content-header">
                <h2>Editar Slide: <?php echo htmlspecialchars($slide['titulo']); ?></h2>
                <a href="slideshow.php" class="btn btn-secondary">Voltar</a>
            </div>
            <?php if ($mensagem): ?>
                <div class="message message-error"><?php echo $mensagem; ?></div>
            <?php endif; ?>
            <div class="form-container">
                <form method="POST" enctype="multipart/form-data" class="admin-form">
                    <div class="form-group">
                        <label for="titulo">Título *</label>
                        <input type="text" id="titulo" name="titulo" value="<?php echo htmlspecialchars($slide['titulo']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="descricao">Descrição</label>
                        <textarea id="descricao" name="descricao" rows="3"><?php echo htmlspecialchars($slide['descricao']); ?></textarea>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="link_botao">Link do Botão</label>
                            <input type="text" id="link_botao" name="link_botao" value="<?php echo htmlspecialchars($slide['link_botao']); ?>">
                        </div>
                        <div class="form-group">
                            <label for="texto_botao">Texto do Botão</label>
                            <input type="text" id="texto_botao" name="texto_botao" value="<?php echo htmlspecialchars($slide['texto_botao']); ?>">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="ordem">Ordem</label>
                            <input type="number" id="ordem" name="ordem" value="<?php echo $slide['ordem']; ?>" min="0">
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select id="status" name="status">
                                <option value="ativo" <?php echo $slide['status'] == 'ativo' ? 'selected' : ''; ?>>Ativo</option>
                                <option value="inativo" <?php echo $slide['status'] == 'inativo' ? 'selected' : ''; ?>>Inativo</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="imagem">Imagem</label>
                        <?php if ($slide['imagem']): ?>
                            <div class="current-image">
                                <img src="../assets/images/<?php echo $slide['imagem']; ?>" alt="Imagem atual" style="max-width: 200px; margin-bottom: 1rem;">
                                <p>Imagem atual: <?php echo $slide['imagem']; ?></p>
                            </div>
                        <?php endif; ?>
                        <input type="file" id="imagem" name="imagem" accept="image/*">
                        <small>Deixe em branco para manter a imagem atual</small>
                        <div class="image-preview-container">
                            <img id="preview" class="image-preview" style="display: none;">
                        </div>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">Atualizar Slide</button>
                        <a href="slideshow.php" class="btn btn-secondary">Cancelar</a>
                    </div>
                </form>
            </div>
        </main>
    </div>
    <script src="assets/js/forms.js"></script>
</body>
</html> 