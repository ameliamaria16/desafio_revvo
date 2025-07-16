<?php
/**
 * Modelo para gerenciar cursos
 */

require_once __DIR__ . '/../config/conexao.php';

class Curso {
    
    // Buscar todos os cursos
    public static function buscarTodos() {
        $sql = "SELECT * FROM cursos WHERE status = 'ativo' ORDER BY id";
        return buscarTodos($sql);
    }
    
    // Buscar curso por ID
    public static function buscarPorId($id) {
        $sql = "SELECT * FROM cursos WHERE id = ? AND status = 'ativo'";
        return buscarUm($sql, [$id]);
    }
    
    // Buscar cursos por categoria
    public static function buscarPorCategoria($categoria) {
        $sql = "SELECT * FROM cursos WHERE categoria = ? AND status = 'ativo' ORDER BY titulo";
        return buscarTodos($sql, [$categoria]);
    }
    
    // Criar novo curso
    public static function criar($dados) {
        $sql = "INSERT INTO cursos (titulo, descricao, imagem, preco, duracao, categoria) 
                VALUES (?, ?, ?, ?, ?, ?)";
        return inserir($sql, [
            $dados['titulo'],
            $dados['descricao'],
            $dados['imagem'],
            $dados['preco'],
            $dados['duracao'],
            $dados['categoria']
        ]);
    }
    
    // Atualizar curso
    public static function atualizar($id, $dados) {
        $sql = "UPDATE cursos SET 
                titulo = ?, descricao = ?, imagem = ?, 
                preco = ?, duracao = ?, categoria = ? 
                WHERE id = ?";
        return atualizar($sql, [
            $dados['titulo'],
            $dados['descricao'],
            $dados['imagem'],
            $dados['preco'],
            $dados['duracao'],
            $dados['categoria'],
            $id
        ]);
    }
    
    // Deletar curso (soft delete)
    public static function deletar($id) {
        $sql = "UPDATE cursos SET status = 'inativo' WHERE id = ?";
        return atualizar($sql, [$id]);
    }
    
    // Buscar categorias disponíveis
    public static function buscarCategorias() {
        $sql = "SELECT DISTINCT categoria FROM cursos WHERE status = 'ativo' ORDER BY categoria";
        return buscarTodos($sql);
    }
}
?> 