<?php
require_once '../../src/controllers/SlideshowController.php';

$slides = SlideshowController::buscarTodos();

// Mensagens de feedback
$mensagem = '';
$tipoMensagem = '';
if (isset($_GET['msg'])) {
    switch ($_GET['msg']) {
        case 'sucesso':
            $mensagem = 'Slide criado com sucesso!';
            $tipoMensagem = 'success';
            break;
        case 'atualizado':
            $mensagem = 'Slide atualizado com sucesso!';
            $tipoMensagem = 'success';
            break;
        case 'excluido':
            $mensagem = 'Slide excluído com sucesso!';
            $tipoMensagem = 'success';
            break;
        case 'erro':
            $mensagem = 'Erro ao processar a operação!';
            $tipoMensagem = 'error';
            break;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Slideshow - Admin Revvo</title>
    <link rel="stylesheet" href="assets/css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="admin-container">
        <header class="admin-header">
            <h1><i class="fas fa-images"></i> Gerenciar Slideshow</h1>
            <nav class="admin-nav">
                <a href="index.php"><i class="fas fa-home"></i> Dashboard</a>
                <a href="cursos.php"><i class="fas fa-graduation-cap"></i> Cursos</a>
                <a href="slideshow.php" class="active"><i class="fas fa-images"></i> Slideshow</a>
                <a href="../index.php"><i class="fas fa-external-link-alt"></i> Ver Site</a>
            </nav>
        </header>
        <main class="admin-main">
            <div class="content-header">
                <h2>Slides do Carrossel</h2>
                <a href="slideshow-novo.php" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Novo Slide
                </a>
            </div>
            <?php if ($mensagem): ?>
                <div class="message message-<?php echo $tipoMensagem; ?>">
                    <i class="fas fa-<?php echo $tipoMensagem == 'success' ? 'check-circle' : 'exclamation-triangle'; ?>"></i>
                    <?php echo $mensagem; ?>
                </div>
            <?php endif; ?>
            <div class="table-container">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Imagem</th>
                            <th>Título</th>
                            <th>Ordem</th>
                            <th>Status</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($slides)): ?>
                            <?php foreach ($slides as $slide): ?>
                            <tr>
                                <td><?php echo $slide['id']; ?></td>
                                <td>
                                    <?php if ($slide['imagem']): ?>
                                        <img src="../assets/images/<?php echo $slide['imagem']; ?>" alt="<?php echo $slide['titulo']; ?>" class="table-image">
                                    <?php else: ?>
                                        <div style="width: 80px; height: 60px; background: #f0f0f0; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: #999;">
                                            <i class="fas fa-image"></i>
                                        </div>
                                    <?php endif; ?>
                                </td>
                                <td><?php echo htmlspecialchars($slide['titulo']); ?></td>
                                <td><?php echo $slide['ordem']; ?></td>
                                <td>
                                    <span class="status-badge <?php echo $slide['status']; ?>">
                                        <?php echo ucfirst($slide['status']); ?>
                                    </span>
                                </td>
                                <td>
                                    <a href="slideshow-editar.php?id=<?php echo $slide['id']; ?>" class="btn btn-small btn-edit" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="slideshow-excluir.php?id=<?php echo $slide['id']; ?>" class="btn btn-small btn-delete" onclick="return confirm('Tem certeza que deseja excluir este slide?')" title="Excluir">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" style="text-align: center; padding: 3rem; color: #666;">
                                    <i class="fas fa-inbox" style="font-size: 3rem; margin-bottom: 1rem; display: block; opacity: 0.5;"></i>
                                    <p>Nenhum slide cadastrado</p>
                                    <a href="slideshow-novo.php" class="btn btn-primary" style="margin-top: 1rem;">
                                        <i class="fas fa-plus"></i> Adicionar Slide
                                    </a>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
    <script src="assets/js/admin.js"></script>
</body>
</html> 