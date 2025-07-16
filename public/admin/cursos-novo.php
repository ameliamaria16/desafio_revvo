<?php
require_once '../../src/controllers/CursoController.php';
$mensagem = CursoController::criar();
// Buscar categorias para o select
require_once '../../src/models/Categoria.php';
$categorias = Categoria::buscarTodas();
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
                        <label for="descricao">Descrição *</label>
                        <textarea id="descricao" name="descricao" rows="4" required></textarea>
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
                            <label for="categoria">Categoria *</label>
                            <div style="display: flex; gap: 8px; align-items: center;">
                                <select id="categoria" name="categoria" required>
                                    <option value="">Selecione</option>
                                    <?php foreach ($categorias as $cat): ?>
                                        <option value="<?php echo $cat['id']; ?>"><?php echo htmlspecialchars($cat['nome']); ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <button type="button" id="btnNovaCategoria" class="btn btn-secondary" style="padding: 4px 10px;">Nova</button>
                                <button type="button" id="btnEditarCategoria" class="btn btn-secondary" style="padding: 4px 10px;">Editar</button>
                            </div>
                            <div id="novaCategoriaContainer" style="display:none; margin-top:8px;">
                                <input type="text" id="novaCategoriaInput" placeholder="Nome da nova categoria">
                                <button type="button" id="salvarNovaCategoria" class="btn btn-primary" style="padding: 4px 10px;">Salvar</button>
                            </div>
                            <div id="editarCategoriaContainer" style="display:none; margin-top:8px;">
                                <input type="text" id="editarCategoriaInput" placeholder="Novo nome da categoria">
                                <button type="button" id="salvarEditarCategoria" class="btn btn-primary" style="padding: 4px 10px;">Salvar</button>
                            </div>
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
                        <label for="imagem">Imagem *</label>
                        <input type="file" id="imagem" name="imagem" accept="image/*" required>
                        <div class="image-preview-container">
                            <img id="preview" class="image-preview" style="display: none;">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="link">Link do Curso *</label>
                        <input type="text" id="link" name="link" placeholder="https://..." required>
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
    <script>
document.getElementById('btnNovaCategoria').onclick = function() {
    document.getElementById('novaCategoriaContainer').style.display = 'block';
    document.getElementById('novaCategoriaInput').focus();
};
document.getElementById('salvarNovaCategoria').onclick = function() {
    var nome = document.getElementById('novaCategoriaInput').value.trim();
    if (!nome) { alert('Digite o nome da categoria!'); return; }
    var btn = this;
    btn.disabled = true;
    fetch('salvar-categoria.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: 'nome=' + encodeURIComponent(nome)
    })
    .then(resp => resp.json())
    .then(data => {
        if (data.sucesso) {
            var select = document.getElementById('categoria');
            var opt = document.createElement('option');
            opt.value = data.id;
            opt.textContent = nome;
            opt.selected = true;
            select.appendChild(opt);
            document.getElementById('novaCategoriaContainer').style.display = 'none';
            document.getElementById('novaCategoriaInput').value = '';
        } else {
            alert(data.mensagem || 'Erro ao salvar categoria');
        }
    })
    .catch(() => alert('Erro ao salvar categoria'))
    .finally(() => { btn.disabled = false; });
};
document.getElementById('btnEditarCategoria').onclick = function() {
    var select = document.getElementById('categoria');
    var selected = select.options[select.selectedIndex];
    if (!select.value) {
        alert('Selecione uma categoria para editar!');
        return;
    }
    document.getElementById('editarCategoriaInput').value = selected.textContent;
    document.getElementById('editarCategoriaContainer').style.display = 'block';
    document.getElementById('editarCategoriaInput').focus();
};
document.getElementById('salvarEditarCategoria').onclick = function() {
    var select = document.getElementById('categoria');
    var id = select.value;
    var novoNome = document.getElementById('editarCategoriaInput').value.trim();
    if (!id || !novoNome) {
        alert('Selecione uma categoria e digite o novo nome!');
        return;
    }
    var btn = this;
    btn.disabled = true;
    fetch('editar-categoria.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: 'id=' + encodeURIComponent(id) + '&nome=' + encodeURIComponent(novoNome)
    })
    .then(resp => resp.json())
    .then(data => {
        if (data.sucesso) {
            select.options[select.selectedIndex].textContent = novoNome;
            document.getElementById('editarCategoriaContainer').style.display = 'none';
        } else {
            alert(data.mensagem || 'Erro ao editar categoria');
        }
    })
    .catch(() => alert('Erro ao editar categoria'))
    .finally(() => { btn.disabled = false; });
};
</script>
</body>
</html> 