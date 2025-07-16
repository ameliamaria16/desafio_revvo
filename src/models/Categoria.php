<?php
require_once __DIR__ . '/../config/conexao.php';

class Categoria {
    public static function buscarTodas() {
        $sql = "SELECT * FROM categorias ORDER BY nome";
        return buscarTodos($sql);
    }

    public static function criar($nome) {
        $sql = "INSERT INTO categorias (nome) VALUES (?)";
        return inserir($sql, [$nome]);
    }

    public static function buscarPorNome($nome) {
        $sql = "SELECT * FROM categorias WHERE nome = ?";
        return buscarUm($sql, [$nome]);
    }

    public static function buscarPorId($id) {
        $sql = "SELECT * FROM categorias WHERE id = ?";
        return buscarUm($sql, [$id]);
    }
}
?> 