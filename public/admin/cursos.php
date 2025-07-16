<?php
/**
 * Gerenciamento de Cursos - Desafio Revvo
 */

require_once '../../src/config/conexao.php';
require_once '../../src/models/Curso.php';
require_once '../../src/controllers/CursoController.php';

$cursos = CursoController::buscarTodos();

// Mensagens de feedback
$mensagem = '';
$tipoMensagem = '';

if (isset($_GET['msg'])) {
    switch ($_GET['msg']) {
        case 'sucesso':
            $mensagem = 'Curso criado com sucesso!';
            $tipoMensagem = 'success';
            break;
        case 'atualizado':
            $mensagem = 'Curso atualizado com sucesso!';
            $tipoMensagem = 'success';
            break;
        case 'excluido':
            $mensagem = 'Curso excluído com sucesso!';
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cursos - Admin Revvo</title>
    <link rel="stylesheet" href="assets/css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="admin-container">
        <!-- Header -->
        <header class="admin-header">
            <h1><i class="fas fa-graduation-cap"></i> Gerenciar Cursos</h1>
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
                <h2>Lista de Cursos</h2>
                <a href="cursos-novo.php" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Novo Curso
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
                            <th>Preço</th>
                            <th>Status</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($cursos)): ?>
                            <?php foreach ($cursos as $curso): ?>
                            <tr>
                                <td><?php echo $curso['id']; ?></td>
                                <td>
                                    <?php if ($curso['imagem']): ?>
                                        <img src="../assets/images/<?php echo $curso['imagem']; ?>" 
                                             alt="<?php echo $curso['titulo']; ?>" 
                                             class="table-image">
                                    <?php else: ?>
                                        <div style="width: 80px; height: 60px; background: #f0f0f0; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: #999;">
                                            <i class="fas fa-image"></i>
                                        </div>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <strong><?php echo htmlspecialchars($curso['titulo']); ?></strong>
                                    <?php if ($curso['categoria']): ?>
                                        <br><small style="color: #666;"><?php echo htmlspecialchars($curso['categoria']); ?></small>
                                    <?php endif; ?>
                                </td>
                                <td>R$ <?php echo number_format($curso['preco'], 2, ',', '.'); ?></td>
                                <td>
                                    <span class="status-badge <?php echo $curso['status']; ?>">
                                        <?php echo ucfirst($curso['status']); ?>
                                    </span>
                                </td>
                                <td>
                                    <a href="cursos-editar.php?id=<?php echo $curso['id']; ?>" 
                                       class="btn btn-small btn-edit" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="cursos-excluir.php?id=<?php echo $curso['id']; ?>" 
                                       class="btn btn-small btn-delete" 
                                       onclick="return confirm('Tem certeza que deseja excluir este curso?')"
                                       title="Excluir">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" style="text-align: center; padding: 3rem; color: #666;">
                                    <i class="fas fa-inbox" style="font-size: 3rem; margin-bottom: 1rem; display: block; opacity: 0.5;"></i>
                                    <p>Nenhum curso cadastrado</p>
                                    <a href="cursos-novo.php" class="btn btn-primary" style="margin-top: 1rem;">
                                        <i class="fas fa-plus"></i> Adicionar Primeiro Curso
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