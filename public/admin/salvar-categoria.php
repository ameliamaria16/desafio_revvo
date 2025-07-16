<?php
require_once '../../src/models/Categoria.php';
header('Content-Type: application/json');
$nome = trim($_POST['nome'] ?? '');
if (!$nome) {
    echo json_encode(['sucesso' => false, 'mensagem' => 'Nome obrigatório']);
    exit;
}
// Verifica se já existe (case insensitive)
$categoriaExistente = Categoria::buscarPorNome($nome);
if ($categoriaExistente) {
    echo json_encode(['sucesso' => true, 'id' => $categoriaExistente['id'], 'mensagem' => 'Categoria já existe']);
    exit;
}
$id = Categoria::criar($nome);
if ($id) {
    echo json_encode(['sucesso' => true, 'id' => $id]);
} else {
    echo json_encode(['sucesso' => false, 'mensagem' => 'Erro ao salvar categoria']);
} 