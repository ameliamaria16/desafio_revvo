<?php
/**
 * Controller para Cursos - Desafio Revvo
 */

require_once __DIR__ . '/../config/conexao.php';
require_once __DIR__ . '/../models/Curso.php';
require_once __DIR__ . '/../models/Categoria.php';
require_once __DIR__ . '/../models/Log.php';

class CursoController {
    
    public static function criar() {
        $mensagem = '';
        $categorias = Categoria::buscarTodas();
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // CSRF (exemplo, depende de implementação no front)
                // if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
                //     throw new Exception('Requisição inválida.');
                // }

                $titulo = htmlspecialchars(trim($_POST['titulo'] ?? ''));
                $descricao = htmlspecialchars(trim($_POST['descricao'] ?? ''));
                $preco = filter_var($_POST['preco'] ?? '', FILTER_VALIDATE_FLOAT);
                $duracao = htmlspecialchars(trim($_POST['duracao'] ?? ''));
                $id_categoria = filter_var($_POST['categoria'] ?? '', FILTER_VALIDATE_INT);
                $status = ($_POST['status'] ?? 'ativo') === 'inativo' ? 'inativo' : 'ativo';
                $link = htmlspecialchars(trim($_POST['link'] ?? ''));

                // Validações de campos obrigatórios
                if (empty($titulo) || empty($descricao) || empty($link) || empty($id_categoria)) {
                    throw new Exception('Preencha todos os campos obrigatórios!');
                }
                // Validação de tamanho
                if (mb_strlen($titulo) < 3 || mb_strlen($titulo) > 100) {
                    throw new Exception('O título deve ter entre 3 e 100 caracteres.');
                }
                if (mb_strlen($descricao) < 10) {
                    throw new Exception('A descrição deve ter pelo menos 10 caracteres.');
                }
                // Validação de preço
                if ($preco === false || $preco < 0) {
                    throw new Exception('Preço inválido.');
                }
                // Validação de duração
                if (mb_strlen($duracao) < 1 || mb_strlen($duracao) > 50) {
                    throw new Exception('Duração inválida.');
                }
                // Validação de URL
                if (!filter_var($link, FILTER_VALIDATE_URL)) {
                    throw new Exception('Informe um link válido para o curso!');
                }
                // Validação de categoria existente
                if (!Categoria::buscarPorId($id_categoria)) {
                    throw new Exception('Categoria não encontrada.');
                }
                // Validação de duplicidade
                if (Curso::buscarPorNome($titulo)) {
                    throw new Exception('Já existe um curso com esse nome!');
                }
                // Upload da imagem
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
                    'id_categoria' => $id_categoria,
                    'status' => $status,
                    'link' => $link
                ];
                if (Curso::criar($dados)) {
                    Log::registrar('criou curso', json_encode($dados), 'admin');
                    header('Location: cursos.php?msg=sucesso');
                    exit;
                } else {
                    Log::registrar('erro ao salvar curso', json_encode($dados), 'admin');
                    throw new Exception('Erro ao salvar curso.');
                }
            }
        } catch (Exception $e) {
            $mensagem = $e->getMessage();
        }
        return $mensagem;
    }
    
    public static function atualizar($id) {
        $mensagem = '';
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // CSRF (exemplo, depende de implementação no front)
                // if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
                //     throw new Exception('Requisição inválida.');
                // }
                $titulo = htmlspecialchars(trim($_POST['titulo'] ?? ''));
                $descricao = htmlspecialchars(trim($_POST['descricao'] ?? ''));
                $preco = filter_var($_POST['preco'] ?? '', FILTER_VALIDATE_FLOAT);
                $duracao = htmlspecialchars(trim($_POST['duracao'] ?? ''));
                $id_categoria = filter_var($_POST['categoria'] ?? '', FILTER_VALIDATE_INT);
                $status = ($_POST['status'] ?? 'inativo') === 'ativo' ? 'ativo' : 'inativo';
                $link = htmlspecialchars(trim($_POST['link'] ?? ''));
                // Validações de campos obrigatórios
                if (empty($titulo) || empty($descricao) || empty($link) || empty($id_categoria)) {
                    throw new Exception('Preencha todos os campos obrigatórios!');
                }
                if (mb_strlen($titulo) < 3 || mb_strlen($titulo) > 100) {
                    throw new Exception('O título deve ter entre 3 e 100 caracteres.');
                }
                if (mb_strlen($descricao) < 10) {
                    throw new Exception('A descrição deve ter pelo menos 10 caracteres.');
                }
                if ($preco === false || $preco < 0) {
                    throw new Exception('Preço inválido.');
                }
                if (mb_strlen($duracao) < 1 || mb_strlen($duracao) > 50) {
                    throw new Exception('Duração inválida.');
                }
                if (!filter_var($link, FILTER_VALIDATE_URL)) {
                    throw new Exception('Informe um link válido para o curso!');
                }
                if (!Categoria::buscarPorId($id_categoria)) {
                    throw new Exception('Categoria não encontrada.');
                }
                // Upload da nova imagem (se houver)
                $imagem = self::processarUpload();
                if ($imagem === '') {
                    $cursoAtual = self::buscarPorId($id);
                    $imagem = $cursoAtual['imagem'];
                }
                if ($imagem === false) {
                    throw new Exception('Erro ao enviar imagem. Verifique o formato e o tamanho (máx. 2MB).');
                }
                $dados = [
                    'titulo' => $titulo,
                    'descricao' => $descricao,
                    'imagem' => $imagem,
                    'preco' => $preco,
                    'duracao' => $duracao,
                    'id_categoria' => $id_categoria,
                    'status' => $status,
                    'link' => $link
                ];
                if (Curso::atualizar($id, $dados)) {
                    Log::registrar('atualizou curso', json_encode(['id'=>$id,'dados'=>$dados]), 'admin');
                    header('Location: cursos.php?msg=atualizado');
                    exit;
                } else {
                    Log::registrar('erro ao atualizar curso', json_encode(['id'=>$id,'dados'=>$dados]), 'admin');
                    throw new Exception('Erro ao atualizar curso.');
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
        $uploadDir = __DIR__ . '/../../public/assets/images/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }
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
        $res = Curso::deletar($id);
        if ($res) {
            Log::registrar('excluiu curso', json_encode(['id'=>$id]), 'admin');
        } else {
            Log::registrar('erro ao excluir curso', json_encode(['id'=>$id]), 'admin');
        }
        return $res;
    }
}
?> 