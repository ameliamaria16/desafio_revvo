<?php
/**
 * Controller para Cursos - Desafio Revvo
 */

require_once __DIR__ . '/../config/conexao.php';
require_once __DIR__ . '/../models/Curso.php';

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
                    'categoria' => $categoria,
                    'link' => $_POST['link'] ?? ''
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
    
    public static function atualizar($id) {
        $mensagem = '';
        
        if ($_POST) {
            $titulo = $_POST['titulo'] ?? '';
            $descricao = $_POST['descricao'] ?? '';
            $preco = $_POST['preco'] ?? 0;
            $duracao = $_POST['duracao'] ?? '';
            $categoria = $_POST['categoria'] ?? '';
            $status = $_POST['status'] ?? 'ativo';
            
            // Upload da nova imagem (se houver)
            $imagem = self::processarUpload();
            
            // Se não há nova imagem, manter a atual
            if ($imagem === '') {
                $cursoAtual = self::buscarPorId($id);
                $imagem = $cursoAtual['imagem'];
            }
            
            if ($imagem === false) {
                $mensagem = 'Erro ao enviar imagem';
            } else {
                $dados = [
                    'titulo' => $titulo,
                    'descricao' => $descricao,
                    'imagem' => $imagem,
                    'preco' => $preco,
                    'duracao' => $duracao,
                    'categoria' => $categoria,
                    'status' => $status,
                    'link' => $_POST['link'] ?? ''
                ];
                
                if (Curso::atualizar($id, $dados)) {
                    header('Location: cursos.php?msg=atualizado');
                    exit;
                } else {
                    $mensagem = 'Erro ao atualizar curso';
                }
            }
        }
        
        return $mensagem;
    }
    
    private static function processarUpload() {
        if (!isset($_FILES['imagem']) || $_FILES['imagem']['error'] !== 0) {
            return '';
        }
        
        // Criar pasta se não existir
        $uploadDir = __DIR__ . '/../../public/assets/images/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }
        
        $extensao = pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION);
        $imagem = 'curso_' . time() . '.' . $extensao;
        $caminhoCompleto = $uploadDir . $imagem;
        
        if (move_uploaded_file($_FILES['imagem']['tmp_name'], $caminhoCompleto)) {
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
            $caminhoImagem = __DIR__ . '/../../public/assets/images/' . $curso['imagem'];
            if (file_exists($caminhoImagem)) {
                unlink($caminhoImagem);
            }
        }
        
        return Curso::deletar($id);
    }
}
?> 