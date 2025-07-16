<?php
/**
 * Modelo para gerenciar slideshow
 */

require_once __DIR__ . '/../config/conexao.php';

class Slideshow {
    public static function buscarTodos() {
        $sql = "SELECT * FROM slideshow ORDER BY ordem ASC, id DESC";
        return buscarTodos($sql);
    }

    public static function buscarPorId($id) {
        $sql = "SELECT * FROM slideshow WHERE id = ?";
        return buscarUm($sql, [$id]);
    }

    public static function criar($dados) {
        $sql = "INSERT INTO slideshow (titulo, descricao, imagem, link_botao, texto_botao, ordem, status)
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        return inserir($sql, [
            $dados['titulo'],
            $dados['descricao'],
            $dados['imagem'],
            $dados['link_botao'],
            $dados['texto_botao'],
            $dados['ordem'],
            $dados['status']
        ]);
    }

    public static function atualizar($id, $dados) {
        $sql = "UPDATE slideshow SET 
                    titulo = ?, descricao = ?, imagem = ?, 
                    link_botao = ?, texto_botao = ?, ordem = ?, status = ?
                WHERE id = ?";
        return atualizar($sql, [
            $dados['titulo'],
            $dados['descricao'],
            $dados['imagem'],
            $dados['link_botao'],
            $dados['texto_botao'],
            $dados['ordem'],
            $dados['status'],
            $id
        ]);
    }

    public static function deletar($id) {
        $sql = "DELETE FROM slideshow WHERE id = ?";
        return deletar($sql, [$id]);
    }
}
?> 