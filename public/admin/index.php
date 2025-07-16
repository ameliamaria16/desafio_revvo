<?php
/**
 * Dashboard Administrativo - Desafio Revvo
 */

require_once '../../src/config/conexao.php';
require_once '../../src/models/Curso.php';
require_once '../../src/models/Slideshow.php';

// Buscar estatísticas
$totalCursos = count(Curso::buscarTodos());
$totalSlides = count(Slideshow::buscarTodos());
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Admin Revvo</title>
    <link rel="stylesheet" href="assets/css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="admin-container">
        <!-- Header -->
        <header class="admin-header">
            <h1><i class="fas fa-tachometer-alt"></i> Dashboard Administrativo</h1>
            <nav class="admin-nav">
                <a href="index.php" class="active"><i class="fas fa-home"></i> Dashboard</a>
                <a href="cursos.php"><i class="fas fa-graduation-cap"></i> Cursos</a>
                <a href="slideshow.php"><i class="fas fa-images"></i> Slideshow</a>
                <a href="../index.php"><i class="fas fa-external-link-alt"></i> Ver Site</a>
            </nav>
        </header>

        <!-- Main Content -->
        <main class="admin-main">
            <div class="content-header">
                <h2>Visão Geral do Sistema</h2>
                <div class="header-actions">
                    <a href="cursos-novo.php" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Novo Curso
                    </a>
                </div>
            </div>

            <!-- Bloco institucional sobre cursos -->
            <div class="info-curso-admin" style="background: #f4f8fb; border-radius: 8px; padding: 1.5rem; margin-bottom: 2rem; box-shadow: 0 2px 8px #0001; text-align: center;">
                <h2 style="margin-bottom: 0.5rem; color: #2c3e50; font-size: 1.5rem;">GERENCIE SEUS CURSOS COM FACILIDADE</h2>
                <p style="color: #555; font-size: 1.1rem; max-width: 600px; margin: 0 auto;">
                    Aqui você pode cadastrar, editar e acompanhar todos os cursos disponíveis na plataforma. Mantenha o catálogo sempre atualizado e ofereça a melhor experiência para seus alunos. Utilize as ações rápidas para agilizar o gerenciamento e garantir que seus cursos estejam sempre em destaque!
                </p>
            </div>

            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-graduation-cap fa-3x" style="color: #3498db;"></i>
                    </div>
                    <h3>Total de Cursos</h3>
                    <p class="stat-number"><?php echo $totalCursos; ?></p>
                    <a href="cursos.php" class="stat-link">
                        <i class="fas fa-cog"></i> Gerenciar Cursos
                    </a>
                </div>
                
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-images fa-3x" style="color: #e74c3c;"></i>
                    </div>
                    <h3>Slides do Carrossel</h3>
                    <p class="stat-number"><?php echo $totalSlides; ?></p>
                    <a href="slideshow.php" class="stat-link">
                        <i class="fas fa-cog"></i> Gerenciar Slideshow
                    </a>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="quick-actions">
                <h3>Ações Rápidas</h3>
                <div class="actions-grid">
                    <a href="cursos-novo.php" class="action-card">
                        <i class="fas fa-plus-circle"></i>
                        <span>Adicionar Curso</span>
                    </a>
                    <a href="slideshow.php" class="action-card">
                        <i class="fas fa-image"></i>
                        <span>Gerenciar Slideshow</span>
                    </a>
                    <a href="../index.php" class="action-card">
                        <i class="fas fa-eye"></i>
                        <span>Visualizar Site</span>
                    </a>
                </div>
            </div>
        </main>
    </div>

    <script src="assets/js/admin.js"></script>
</body>
</html> 