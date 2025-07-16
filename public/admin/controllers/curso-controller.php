<?php
/**
 * Controller para Cursos - Desafio Revvo
 */

// Usar caminho absoluto para evitar problemas de caminho relativo
$rootPath = $_SERVER['DOCUMENT_ROOT'] . '/desafio_revvo/';
require_once $rootPath . 'src/config/conexao.php';
require_once $rootPath . 'src/models/Curso.php';

class CursoController {
    
    public static function criar() {
        $mensagem = '';
        
        if ($_POST) {
            $titulo = $_POST['titulo'] ?? '';
            $descricao = $_POST['descricao'] ?? '';
            $preco = $_POST['preco'] ?? 0;
            $duracao = $_POST['duracao'] ?? '';
            $categoria = $_POST['categoria'] ?? '';
            $status = $_POST['status'] ?? 'ativo';
            
            // Upload da imagem
            $imagem = self::processarUpload();
            
            if ($imagem === false) {
                $mensagem = 'Erro ao enviar imagem';
            } else {
                $dados = [
                    'titulo' => $titulo,
                    'descricao' => $descricao,
                    'imagem' => $imagem,
                    'preco' => $preco,
                    'duracao' => $duracao,
                    'categoria' => $categoria
                ];
                
                if (Curso::criar($dados)) {
                    header('Location: cursos.php?msg=sucesso');
                    exit;
                } else {
                    $mensagem = 'Erro ao salvar curso';
                }
            }
        }
        
        return $mensagem;
    }
    
    private static function processarUpload() {
        if (!isset($_FILES['imagem']) || $_FILES['imagem']['error'] !== 0) {
            return '';
        }
        
        $uploadDir = '../assets/images/';
        $extensao = pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION);
        $imagem = 'curso_' . time() . '.' . $extensao;
        
        if (move_uploaded_file($_FILES['imagem']['tmp_name'], $uploadDir . $imagem)) {
            return $imagem;
        }
        
        return false;
    }
    
    public static function buscarTodos() {
        return Curso::buscarTodos();
    }
    
    public static function buscarPorId($id) {
        return Curso::buscarPorId($id);
    }
    
    public static function excluir($id) {
        $curso = Curso::buscarPorId($id);
        if ($curso && $curso['imagem']) {
            $caminhoImagem = '../assets/images/' . $curso['imagem'];
            if (file_exists($caminhoImagem)) {
                unlink($caminhoImagem);
            }
        }
        
        return Curso::deletar($id);
    }
} 