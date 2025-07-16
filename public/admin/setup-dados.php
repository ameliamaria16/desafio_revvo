<?php
/**
 * Script para inserir dados de exemplo
 * Execute uma vez para popular o banco
 */

require_once '../../src/config/conexao.php';
require_once '../../src/models/Curso.php';
require_once '../../src/models/Slideshow.php';

// Verificar se já existem dados
$cursos = Curso::buscarTodos();
$slides = Slideshow::buscarTodos();

if (empty($cursos)) {
    // Inserir cursos de exemplo
    $cursosExemplo = [
        [
            'titulo' => 'Introdução ao PHP',
            'descricao' => 'Aprenda os fundamentos da linguagem PHP para desenvolvimento web.',
            'imagem' => 'curso_php.jpg',
            'preco' => 99.90,
            'duracao' => '4h 30min',
            'categoria' => 'Programação'
        ],
        [
            'titulo' => 'CSS Avançado',
            'descricao' => 'Domine CSS Grid, Flexbox e técnicas avançadas de layout.',
            'imagem' => 'curso_css.jpg',
            'preco' => 79.90,
            'duracao' => '3h 15min',
            'categoria' => 'Front-end'
        ],
        [
            'titulo' => 'JavaScript Moderno',
            'descricao' => 'ES6+, Promises, Async/Await e padrões modernos de JavaScript.',
            'imagem' => 'curso_js.jpg',
            'preco' => 129.90,
            'duracao' => '6h 45min',
            'categoria' => 'Programação'
        ]
    ];

    foreach ($cursosExemplo as $curso) {
        Curso::criar($curso);
    }
    
    echo "✅ Cursos de exemplo inseridos!<br>";
}

if (empty($slides)) {
    // Inserir slides de exemplo
    $slidesExemplo = [
        [
            'titulo' => 'Bem-vindo à Revvo',
            'descricao' => 'A melhor plataforma de cursos online do Brasil.',
            'imagem' => 'slide1.jpg',
            'link_botao' => '#cursos',
            'texto_botao' => 'VER CURSOS',
            'ordem' => 1
        ],
        [
            'titulo' => 'Aprenda Programação',
            'descricao' => 'Cursos completos de PHP, JavaScript, CSS e muito mais.',
            'imagem' => 'slide2.jpg',
            'link_botao' => '#cursos',
            'texto_botao' => 'COMEÇAR AGORA',
            'ordem' => 2
        ]
    ];

    foreach ($slidesExemplo as $slide) {
        Slideshow::criar($slide);
    }
    
    echo "✅ Slides de exemplo inseridos!<br>";
}

echo "�� Setup concluído! <a href='../index.php'>Ver o site</a>";
?> 