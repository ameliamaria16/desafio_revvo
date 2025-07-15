<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Desafio Revvo</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <header class="topo">
        <div class="logo">
            <img src="https://res.cloudinary.com/dd1vq4hwj/image/upload/v1752577119/logo-leo_kd4e6d.png" alt="Logo LEO" class="logo-img">
        </div>
        <div class="header-right">
            <form class="busca">
                <input type="text" placeholder="Pesquisar cursos...">
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
        <section id="slideshow" aria-label="Destaques">
            <div class="carousel">
                <button class="carousel-arrow left" aria-label="Anterior">&#10094;</button>

                <div class="carousel-slide active">
                    <img src="https://res.cloudinary.com/dd1vq4hwj/image/upload/v1752618609/inep_jwkerm.jpg" alt="Primeira imagem do carrossel">
                    <div class="carousel-caption">
                        <h2>LOREM IPSUM</h2>
                        <p>Primeiro slide do carrossel. Texto de exemplo para descrever o curso ou destaque.</p>
                        <a href="#" class="carousel-btn">VER CURSO</a>
                    </div>
                </div>

                <div class="carousel-slide">
                    <img src="https://res.cloudinary.com/dd1vq4hwj/image/upload/v1752618609/tecnicas-de-estudo-1536x512_iuqyqd.jpg" alt="Segunda imagem do carrossel">
                    <div class="carousel-caption">
                        <h2>SEGUNDO SLIDE</h2>
                        <p>Segundo slide do carrossel. Outro texto de exemplo para destacar um curso.</p>
                        <a href="#" class="carousel-btn">VER CURSO</a>
                    </div>
                </div>

                <div class="carousel-slide">
                    <img src="https://res.cloudinary.com/dd1vq4hwj/image/upload/v1752618663/images_f7pdra.jpg" alt="Terceira imagem do carrossel">
                    <div class="carousel-caption">
                        <h2>TERCEIRO SLIDE</h2>
                        <p>Terceiro slide do carrossel. Mais um texto de exemplo para o destaque.</p>
                        <a href="#" class="carousel-btn">VER CURSO</a>
                    </div>
                </div>

                <button class="carousel-arrow right" aria-label="Próximo">&#10095;</button>
                <div class="carousel-dots">
                    <button class="dot active" aria-label="Slide 1"></button>
                    <button class="dot" aria-label="Slide 2"></button>
                    <button class="dot" aria-label="Slide 3"></button>
                </div>
            </div>
        </section>
        <section id="cursos">
            <h2>Meus Cursos</h2>
            <div class="cursos-grid" id="cursosGrid">
        
                <div class="curso-card add-card">
                    <div class="add-curso-content">
                        <img src="assets/images/add-icon.png" alt="Adicionar curso" class="add-icon">
                        <span>Adicionar<br>Curso</span>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <div id="modal-primeiro-acesso" class="modal" style="display:none;">

        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Bem-vindo!</h2>
            <p>Este é o modal de primeiro acesso.</p>
        </div>
    </div>

    <footer class="footer">
        <div class="footer-content">
            <div class="footer-col footer-logo">
                <img src="https://res.cloudinary.com/dd1vq4hwj/image/upload/v1752577119/logo-leo_kd4e6d.png" alt="Logo LEO" class="footer-logo-img">
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
                    <a href="#" aria-label="Twitter"><img src="https://cdn.jsdelivr.net/gh/simple-icons/simple-icons/icons/twitter.svg" alt="Twitter"></a>
                    <a href="#" aria-label="YouTube"><img src="https://cdn.jsdelivr.net/gh/simple-icons/simple-icons/icons/youtube.svg" alt="YouTube"></a>
                    <a href="#" aria-label="Pinterest"><img src="https://cdn.jsdelivr.net/gh/simple-icons/simple-icons/icons/pinterest.svg" alt="Pinterest"></a>
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