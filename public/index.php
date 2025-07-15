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
        <form class="busca">
            <input type="text" placeholder="Pesquisar cursos...">
            <button type="submit" class="btn-busca" aria-label="Buscar">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="9" cy="9" r="7" stroke="#bbb" stroke-width="2"/>
                    <line x1="14.4142" y1="14" x2="18" y2="17.5858" stroke="#bbb" stroke-width="2" stroke-linecap="round"/>
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
                        <path d="M4 6L8 10L12 6" stroke="#888" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </span>
            </div>
        </div>
    </header>
    <main>
        <section id="slideshow">
            <!-- Slideshow de imagens, título, descrição e botão -->
        </section>
        <section id="cursos">
            <h2>Cursos</h2>
            <!-- Listagem dos cursos (CRUD) -->
        </section>
    </main>
    <div id="modal-primeiro-acesso" class="modal" style="display:none;">
        <!-- Conteúdo do modal baseado em home-modal.jpg -->
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Bem-vindo!</h2>
            <p>Este é o modal de primeiro acesso.</p>
        </div>
    </div>
    <script src="assets/js/main.js"></script>
</body>
</html>
