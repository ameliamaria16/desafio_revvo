<?php
require_once '../../src/controllers/SlideshowController.php';
$mensagem = SlideshowController::criar();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Novo Slide - Admin Revvo</title>
    <link rel="stylesheet" href="assets/css/admin.css">
    <link rel="stylesheet" href="assets/css/forms.css">
</head>
<body>
    <div class="admin-container">
        <header class="admin-header">
            <h1>Novo Slide</h1>
            <nav class="admin-nav">
                <a href="index.php">Dashboard</a>
                <a href="cursos.php">Cursos</a>
                <a href="slideshow.php" class="active">Slideshow</a>
                <a href="../index.php">Ver Site</a>
            </nav>
        </header>
        <main class="admin-main">
            <div class="content-header">
                <h2>Criar Novo Slide</h2>
                <a href="slideshow.php" class="btn btn-secondary">Voltar</a>
            </div>
            <?php if ($mensagem): ?>
                <div class="message message-error"><?php echo $mensagem; ?></div>
            <?php endif; ?>
            <div class="form-container">
                <form method="POST" enctype="multipart/form-data" class="admin-form">
                    <div class="form-group">
                        <label for="titulo">Título *</label>
                        <input type="text" id="titulo" name="titulo" required>
                    </div>
                    <div class="form-group">
                        <label for="descricao">Descrição</label>
                        <textarea id="descricao" name="descricao" rows="3"></textarea>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="link_botao">Link do Botão</label>
                            <input type="text" id="link_botao" name="link_botao">
                        </div>
                        <div class="form-group">
                            <label for="texto_botao">Texto do Botão</label>
                            <input type="text" id="texto_botao" name="texto_botao" value="Saiba Mais">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="ordem">Ordem</label>
                            <input type="number" id="ordem" name="ordem" value="0" min="0">
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select id="status" name="status">
                                <option value="ativo">Ativo</option>
                                <option value="inativo">Inativo</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="imagem">Imagem</label>
                        <input type="file" id="imagem" name="imagem" accept="image/*" required>
                        <div class="image-preview-container">
                            <img id="preview" class="image-preview" style="display: none;">
                        </div>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">Salvar Slide</button>
                        <a href="slideshow.php" class="btn btn-secondary">Cancelar</a>
                    </div>
                </form>
            </div>
        </main>
    </div>
    <script src="assets/js/forms.js"></script>
</body>
</html> 