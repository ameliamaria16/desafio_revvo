<?php
require_once '../../src/controllers/CursoController.php';

$mensagem = CursoController::criar();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Novo Curso - Admin Revvo</title>
    <link rel="stylesheet" href="assets/css/admin.css">
    <link rel="stylesheet" href="assets/css/forms.css">
</head>
<body>
    <div class="admin-container">
        <!-- Header -->
        <header class="admin-header">
            <h1>Novo Curso</h1>
            <nav class="admin-nav">
                <a href="index.php">Dashboard</a>
                <a href="cursos.php">Cursos</a>
                <a href="slideshow.php">Slideshow</a>
                <a href="../index.php">Ver Site</a>
            </nav>
        </header>

        <!-- Main Content -->
        <main class="admin-main">
            <div class="content-header">
                <h2>Criar Novo Curso</h2>
                <a href="cursos.php" class="btn btn-secondary">Voltar</a>
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
                        <textarea id="descricao" name="descricao" rows="4"></textarea>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="preco">Preço</label>
                            <input type="number" id="preco" name="preco" step="0.01" min="0">
                        </div>

                        <div class="form-group">
                            <label for="duracao">Duração</label>
                            <input type="text" id="duracao" name="duracao" placeholder="ex: 2h 30min">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="categoria">Categoria</label>
                            <input type="text" id="categoria" name="categoria">
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
                        <input type="file" id="imagem" name="imagem" accept="image/*">
                        <div class="image-preview-container">
                            <img id="preview" class="image-preview" style="display: none;">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="link">Link do Curso</label>
                        <input type="text" id="link" name="link" placeholder="https://...">
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">Salvar Curso</button>
                        <a href="cursos.php" class="btn btn-secondary">Cancelar</a>
                    </div>
                </form>
            </div>
        </main>
    </div>

    <script src="assets/js/admin.js"></script>
    <script src="assets/js/forms.js"></script>
</body>
</html> 