<?php
require_once '../../src/models/Categoria.php';
header('Content-Type: application/json');
$id = intval($_POST['id'] ?? 0);
$nome = trim($_POST['nome'] ?? '');
if (!$id || !$nome) {
    echo json_encode(['sucesso' => false, 'mensagem' => 'ID e nome obrigatórios']);
    exit;
}
// Verifica se já existe categoria com esse nome (case insensitive)
$categoriaExistente = Categoria::buscarPorNome($nome);
if ($categoriaExistente && $categoriaExistente['id'] != $id) {
    echo json_encode(['sucesso' => false, 'mensagem' => 'Já existe uma categoria com esse nome']);
    exit;
}
// Atualiza
require_once '../../src/config/conexao.php';
$pdo = conectar();
$sql = "UPDATE categorias SET nome = ? WHERE id = ?";
$stmt = $pdo->prepare($sql);
if ($stmt->execute([$nome, $id])) {
    echo json_encode(['sucesso' => true]);
} else {
    echo json_encode(['sucesso' => false, 'mensagem' => 'Erro ao atualizar categoria']);
} 