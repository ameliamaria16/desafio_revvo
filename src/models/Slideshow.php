<?php
/**
 * Modelo para gerenciar slideshow
 */

require_once __DIR__ . '/../config/conexao.php';

class Slideshow {
    
    // Buscar todos os slides ativos
    public static function buscarTodos() {
        $sql = "SELECT * FROM slideshow WHERE status = 'ativo' ORDER BY ordem, id";
        return buscarTodos($sql);
    }
    
    // Buscar slide por ID
    public static function buscarPorId($id) {
        $sql = "SELECT * FROM slideshow WHERE id = ? AND status = 'ativo'";
        return buscarUm($sql, [$id]);
    }
    
    // Criar novo slide
    public static function criar($dados) {
        $sql = "INSERT INTO slideshow (titulo, descricao, imagem, link_botao, texto_botao, ordem) 
                VALUES (?, ?, ?, ?, ?, ?)";
        return inserir($sql, [
            $dados['titulo'],
            $dados['descricao'],
            $dados['imagem'],
            $dados['link_botao'],
            $dados['texto_botao'],
            $dados['ordem']
        ]);
    }
    
    // Atualizar slide
    public static function atualizar($id, $dados) {
        $sql = "UPDATE slideshow SET 
                titulo = ?, descricao = ?, imagem = ?, 
                link_botao = ?, texto_botao = ?, ordem = ? 
                WHERE id = ?";
        return atualizar($sql, [
            $dados['titulo'],
            $dados['descricao'],
            $dados['imagem'],
            $dados['link_botao'],
            $dados['texto_botao'],
            $dados['ordem'],
            $id
        ]);
    }
    
    // Deletar slide (soft delete)
    public static function deletar($id) {
        $sql = "UPDATE slideshow SET status = 'inativo' WHERE id = ?";
        return atualizar($sql, [$id]);
    }
}
?> 