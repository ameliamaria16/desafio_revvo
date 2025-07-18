<?php
/**
 * Controller para Cursos - Desafio Revvo
 */

// Usar caminho absoluto para evitar problemas de caminho relativo
$rootPath = $_SERVER['DOCUMENT_ROOT'] . '/desafio_revvo/';
require_once $rootPath . 'src/config/conexao.php';
require_once $rootPath . 'src/models/Curso.php';
require_once $rootPath . 'src/models/Log.php';

class CursoController {
    
    public static function criar() {
        $mensagem = '';
        try {
            if ($_POST) {
               
                $titulo = htmlspecialchars(trim($_POST['titulo'] ?? ''));
                $descricao = htmlspecialchars(trim($_POST['descricao'] ?? ''));
                $preco = filter_var($_POST['preco'] ?? '', FILTER_VALIDATE_FLOAT);
                $duracao = htmlspecialchars(trim($_POST['duracao'] ?? ''));
                $categoria = filter_var($_POST['categoria'] ?? '', FILTER_VALIDATE_INT);
                $status = ($_POST['status'] ?? 'ativo') === 'inativo' ? 'inativo' : 'ativo';
                // Validações de campos obrigatórios
                if (empty($titulo) || empty($descricao) || empty($categoria)) {
                    throw new Exception('Preencha todos os campos obrigatórios!');
                }
                if (mb_strlen($titulo) < 3 || mb_strlen($titulo) > 100) {
                    throw new Exception('O título deve ter entre 3 e 100 caracteres.');
                }
                if (mb_strlen($descricao) < 5) {
                    throw new Exception('A descrição deve ter pelo menos 10 caracteres.');
                }
                if ($preco === false || $preco < 0) {
                    throw new Exception('Preço inválido.');
                }
                if (mb_strlen($duracao) < 1 || mb_strlen($duracao) > 50) {
                    throw new Exception('Duração inválida.');
                }
                $imagem = self::processarUpload();
                if ($imagem === false) {
                    throw new Exception('Erro ao enviar imagem. Verifique o formato e o tamanho (máx. 2MB).');
                }
                if (empty($imagem)) {
                    throw new Exception('Imagem obrigatória.');
                }
                $dados = [
                    'titulo' => $titulo,
                    'descricao' => $descricao,
                    'imagem' => $imagem,
                    'preco' => $preco,
                    'duracao' => $duracao,
                    'categoria' => $categoria,
                    'status' => $status
                ];
                if (Curso::criar($dados)) {
                    Log::registrar('criou curso (admin)', json_encode($dados), 'admin');
                    header('Location: cursos.php?msg=sucesso');
                    exit;
                } else {
                    Log::registrar('erro ao salvar curso (admin)', json_encode($dados), 'admin');
                    throw new Exception('Erro ao salvar curso.');
                }
            }
        } catch (Exception $e) {
            $mensagem = $e->getMessage();
        }
        return $mensagem;
    }
    
    private static function processarUpload() {
        if (!isset($_FILES['imagem']) || $_FILES['imagem']['error'] !== 0) {
            return '';
        }
        $uploadDir = '../assets/images/';
        $extensao = strtolower(pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION));
        $extensoesPermitidas = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        if (!in_array($extensao, $extensoesPermitidas)) {
            return false;
        }
        if ($_FILES['imagem']['size'] > 2 * 1024 * 1024) {
            return false;
        }
        // Nome único com hash
        $hash = md5_file($_FILES['imagem']['tmp_name']) . '_' . time();
        $imagem = 'curso_' . $hash . '.' . $extensao;
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