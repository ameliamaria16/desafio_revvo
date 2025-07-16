<?php
/**
 * Script para popular o banco com dados iniciais
 */

require_once '../../src/config/conexao.php';
require_once '../../src/models/Curso.php';
require_once '../../src/models/Slideshow.php';

echo "<h2>Populando banco de dados...</h2>";

// Verificar se já existem dados
$cursos = Curso::buscarTodos();
$slides = Slideshow::buscarTodos();

if (empty($cursos)) {
    echo "<p>Inserindo cursos de exemplo...</p>";
    
    // Inserir cursos de exemplo
    $cursosExemplo = [
        [
            'titulo' => 'Introdução ao PHP',
            'descricao' => 'Aprenda os fundamentos da linguagem PHP para desenvolvimento web.',
            'imagem' => '',
            'preco' => 99.90,
            'duracao' => '4h 30min',
            'categoria' => 'Programação'
        ],
        [
            'titulo' => 'CSS Avançado',
            'descricao' => 'Domine CSS Grid, Flexbox e técnicas avançadas de layout.',
            'imagem' => '',
            'preco' => 79.90,
            'duracao' => '3h 15min',
            'categoria' => 'Front-end'
        ]
    ];

    foreach ($cursosExemplo as $curso) {
        if (Curso::criar($curso)) {
            echo "✅ Curso '{$curso['titulo']}' inserido<br>";
        } else {
            echo "❌ Erro ao inserir curso '{$curso['titulo']}'<br>";
        }
    }
} else {
    echo "<p>Já existem " . count($cursos) . " cursos no banco.</p>";
}

if (empty($slides)) {
    echo "<p>Inserindo slides de exemplo...</p>";
    
    // Inserir slides de exemplo
    $slidesExemplo = [
        [
            'titulo' => 'Bem-vindo à Revvo',
            'descricao' => 'A melhor plataforma de cursos online do Brasil.',
            'imagem' => '',
            'link_botao' => '#cursos',
            'texto_botao' => 'VER CURSOS',
            'ordem' => 1
        ]
    ];

    foreach ($slidesExemplo as $slide) {
        if (Slideshow::criar($slide)) {
            echo "✅ Slide '{$slide['titulo']}' inserido<br>";
        } else {
            echo "❌ Erro ao inserir slide '{$slide['titulo']}'<br>";
        }
    }
} else {
    echo "<p>Já existem " . count($slides) . " slides no banco.</p>";
}

echo "<hr>";
echo "<h3>✅ Setup concluído!</h3>";
echo "<p><a href='../index.php'>Ver o site</a> | <a href='index.php'>Painel Admin</a></p>";
?> 