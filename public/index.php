<?php
/**
 * Página Principal - Desafio Revvo
 * DADOS 100% DINÂMICOS DO BANCO
 */

require_once '../src/config/conexao.php';
require_once '../src/models/Curso.php';
require_once '../src/models/Slideshow.php';

// Buscar dados do banco
$cursos = Curso::buscarTodos();
$slides = Slideshow::buscarTodos();
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Revvo - Plataforma de Cursos</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <meta name="description" content="Plataforma de cursos online da Revvo">
</head>

<body>
    <!-- HEADER FIXO -->
    <header class="topo">
        <div class="logo">
            <img src="https://res.cloudinary.com/dd1vq4hwj/image/upload/v1752577119/logo-leo_kd4e6d.png" alt="Logo Revvo" class="logo-img">
        </div>
        <div class="header-right">
            <form class="busca" role="search">
                <input type="text" placeholder="Pesquisar cursos..." aria-label="Pesquisar cursos">
                <button type="submit" class="btn-busca" aria-label="Buscar">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="9" cy="9" r="7" stroke="#bbb" stroke-width="2" />
                        <line x1="14.4142" y1="14" x2="18" y2="17.5858" stroke="#bbb" stroke-width="2" stroke-linecap="round" />
                    </svg>
                </button>
            </form>
            <div class="perfil-box">
                <div class="perfil">
                    <img src="assets/images/user.jpg" alt="Avatar do usuário" class="avatar">
                    <div class="perfil-info">
                        <span class="bem-vindo">Seja bem-vindo</span>
                        <span class="nome">John Doe</span>
                    </div>
                    <span class="seta-baixo">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M4 6L8 10L12 6" stroke="#888" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </span>
                </div>
            </div>
        </div>
    </header>

    <main>
        <!-- CARROSSEL DINÂMICO -->
        <section id="slideshow" aria-label="Destaques">
            <div class="carousel">
                <button class="carousel-arrow left" aria-label="Anterior">&#10094;</button>

                <?php if (!empty($slides)): ?>
                    <?php foreach ($slides as $index => $slide): ?>
                        <div class="carousel-slide <?php echo $index === 0 ? 'active' : ''; ?>">
                            <img src="assets/images/<?php echo $slide['imagem']; ?>" alt="<?php echo $slide['titulo']; ?>">
                            <div class="carousel-caption">
                                <h2><?php echo $slide['titulo']; ?></h2>
                                <p><?php echo $slide['descricao']; ?></p>
                                <a href="<?php echo $slide['link_botao']; ?>" class="carousel-btn"><?php echo $slide['texto_botao']; ?></a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <!-- Slide padrão se não houver dados -->
                    <div class="carousel-slide active">
                        <img src="https://res.cloudinary.com/dd1vq4hwj/image/upload/v1752618609/inep_jwkerm.jpg" alt="Slide padrão">
                        <div class="carousel-caption">
                            <h2>BEM-VINDO À REVVO</h2>
                            <p>Adicione slides no painel administrativo para personalizar o carrossel.</p>
                            <a href="admin/" class="carousel-btn">ADMINISTRAR</a>
                        </div>
                    </div>
                <?php endif; ?>

                <button class="carousel-arrow right" aria-label="Próximo">&#10095;</button>
                
                <div class="carousel-dots">
                    <?php if (!empty($slides)): ?>
                        <?php foreach ($slides as $index => $slide): ?>
                            <button class="dot <?php echo $index === 0 ? 'active' : ''; ?>" aria-label="Slide <?php echo $index + 1; ?>"></button>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <button class="dot active" aria-label="Slide 1"></button>
                    <?php endif; ?>
                </div>
            </div>
        </section>

        <!-- SEÇÃO DE CURSOS 100% DINÂMICA -->
        <section id="cursos">
            <h2>MEUS CURSOS</h2>
            <div class="cursos-grid" id="cursosGrid">
                <?php if (!empty($cursos)): ?>
                    <!-- EXIBIR CURSOS DO BANCO -->
                    <?php foreach ($cursos as $curso): ?>
                        <div class="curso-card">
                            <?php if (!empty($curso['imagem'])): ?>
                                <img src="assets/images/<?php echo $curso['imagem']; ?>" alt="<?php echo $curso['titulo']; ?>">
                            <?php else: ?>
                                <img src="https://res.cloudinary.com/dd1vq4hwj/image/upload/v1752618663/images_f7pdra.jpg" alt="Imagem padrão">
                            <?php endif; ?>
                            <div class="curso-info">
                                <h3><?php echo $curso['titulo']; ?></h3>
                                <p><?php echo $curso['descricao']; ?></p>
                                <a href="<?php echo !empty($curso['link']) ? $curso['link'] : '#'; ?>" class="curso-btn" target="_blank">VER CURSO</a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>

                <!-- CARD ADICIONAR CURSO - SEMPRE VISÍVEL -->
                <div class="curso-card add-card" onclick="window.location.href='admin/cursos-novo.php'">
                    <div class="add-curso-content">
                        <img src="assets/images/add-icon.png" alt="Adicionar curso" class="add-icon">
                        <span>ADICIONAR<br>CURSO</span>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- MODAL DE PRIMEIRO ACESSO -->
    <div id="modal-primeiro-acesso" class="modal" style="display:none;">
        <div class="modal-content custom-modal">
            <span class="close">&times;</span>
            <img src="https://res.cloudinary.com/dd1vq4hwj/image/upload/v1752620721/Captura_de_tela_2025-07-15_200517_nkisd1.png" 
                 alt="Ilustração" class="modal-ilustracao">
            <h2 class="modal-titulo">EGESTAS TORTOR VULPUTATE</h2>
            <p class="modal-desc">
                Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum.<br>
                Donec ullamcorper nulla non metus auctor fringilla. Donec sed odio dui. Cras
            </p>
            <button class="modal-btn">INSCREVA-SE</button>
        </div>
    </div>

    <!-- FOOTER - LARGURA TOTAL -->
    <footer class="footer">
        <div class="footer-content">
            <div class="footer-col footer-logo">
                <img src="https://res.cloudinary.com/dd1vq4hwj/image/upload/v1752577119/logo-leo_kd4e6d.png" 
                     alt="Logo Revvo" class="footer-logo-img">
                <p class="footer-desc">
                    Maecenas faucibus mollis interdum. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.
                </p>
            </div>
            <div class="footer-col footer-contact">
                <h4>// CONTATO</h4>
                <p>(21) 98765-3434<br>
                    contato@leolearning.com</p>
            </div>
            <div class="footer-col footer-social">
                <h4>// REDES SOCIAIS</h4>
                <div class="footer-social-icons">
                    <a href="#" aria-label="Twitter">
                        <img src="https://cdn.jsdelivr.net/gh/simple-icons/simple-icons/icons/twitter.svg" alt="Twitter">
                    </a>
                    <a href="#" aria-label="YouTube">
                        <img src="https://cdn.jsdelivr.net/gh/simple-icons/simple-icons/icons/youtube.svg" alt="YouTube">
                    </a>
                    <a href="#" aria-label="Pinterest">
                        <img src="https://cdn.jsdelivr.net/gh/simple-icons/simple-icons/icons/pinterest.svg" alt="Pinterest">
                    </a>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            Copyright 2017 - All right reserved.
        </div>
    </footer>

    <script src="assets/js/main.js"></script>
</body>
</html>