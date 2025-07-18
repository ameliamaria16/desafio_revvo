<?php
require_once __DIR__ . '/../models/Slideshow.php';
require_once __DIR__ . '/../models/Log.php';

class SlideshowController {
    public static function criar() {
        $mensagem = '';
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
             
                $titulo = htmlspecialchars(trim($_POST['titulo'] ?? ''));
                $descricao = htmlspecialchars(trim($_POST['descricao'] ?? ''));
                $link_botao = htmlspecialchars(trim($_POST['link_botao'] ?? ''));
                $texto_botao = htmlspecialchars(trim($_POST['texto_botao'] ?? 'Saiba Mais'));
                $ordem = filter_var($_POST['ordem'] ?? '', FILTER_VALIDATE_INT);
                $status = ($_POST['status'] ?? 'ativo') === 'inativo' ? 'inativo' : 'ativo';
                // Validações de campos obrigatórios
                if (empty($titulo) || empty($descricao) || $ordem === false) {
                    throw new Exception('Preencha todos os campos obrigatórios!');
                }
                if (mb_strlen($titulo) < 3 || mb_strlen($titulo) > 100) {
                    throw new Exception('O título deve ter entre 3 e 100 caracteres.');
                }
                if (mb_strlen($descricao) < 5) {
                    throw new Exception('A descrição deve ter pelo menos 5 caracteres.');
                }
                if (!empty($link_botao) && !filter_var($link_botao, FILTER_VALIDATE_URL)) {
                    throw new Exception('Informe um link válido para o botão!');
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
                    'link_botao' => $link_botao,
                    'texto_botao' => $texto_botao,
                    'ordem' => $ordem,
                    'status' => $status
                ];
                if (Slideshow::criar($dados)) {
                    Log::registrar('criou slide', json_encode($dados), 'admin');
                 
                    header('Location: slideshow.php?msg=sucesso');
                    exit;
                } else {
                    Log::registrar('erro ao salvar slide', json_encode($dados), 'admin');
                    throw new Exception('Erro ao salvar slide.');
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
               
                $titulo = htmlspecialchars(trim($_POST['titulo'] ?? ''));
                $descricao = htmlspecialchars(trim($_POST['descricao'] ?? ''));
                $link_botao = htmlspecialchars(trim($_POST['link_botao'] ?? ''));
                $texto_botao = htmlspecialchars(trim($_POST['texto_botao'] ?? 'Saiba Mais'));
                $ordem = filter_var($_POST['ordem'] ?? '', FILTER_VALIDATE_INT);
                $status = ($_POST['status'] ?? 'ativo') === 'inativo' ? 'inativo' : 'ativo';
                if (empty($titulo) || empty($descricao) || $ordem === false) {
                    throw new Exception('Preencha todos os campos obrigatórios!');
                }
                if (mb_strlen($titulo) < 3 || mb_strlen($titulo) > 100) {
                    throw new Exception('O título deve ter entre 3 e 100 caracteres.');
                }
                if (mb_strlen($descricao) < 5) {
                    throw new Exception('A descrição deve ter pelo menos 5 caracteres.');
                }
                if (!empty($link_botao) && !filter_var($link_botao, FILTER_VALIDATE_URL)) {
                    throw new Exception('Informe um link válido para o botão!');
                }
                $imagem = self::processarUpload();
                if ($imagem === '') {
                    $slideAtual = self::buscarPorId($id);
                    $imagem = $slideAtual['imagem'];
                }
                if ($imagem === false) {
                    throw new Exception('Erro ao enviar imagem. Verifique o formato e o tamanho (máx. 2MB).');
                }
                $dados = [
                    'titulo' => $titulo,
                    'descricao' => $descricao,
                    'imagem' => $imagem,
                    'link_botao' => $link_botao,
                    'texto_botao' => $texto_botao,
                    'ordem' => $ordem,
                    'status' => $status
                ];
                if (Slideshow::atualizar($id, $dados)) {
                    Log::registrar('atualizou slide', json_encode(['id'=>$id,'dados'=>$dados]), 'admin');
           
                    header('Location: slideshow.php?msg=atualizado');
                    exit;
                } else {
                    Log::registrar('erro ao atualizar slide', json_encode(['id'=>$id,'dados'=>$dados]), 'admin');
                    throw new Exception('Erro ao atualizar slide.');
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
        $imagem = 'slide_' . $hash . '.' . $extensao;
        $caminhoCompleto = $uploadDir . $imagem;
        if (move_uploaded_file($_FILES['imagem']['tmp_name'], $caminhoCompleto)) {
            return $imagem;
        }
        return false;
    }

    public static function buscarTodos() {
        return Slideshow::buscarTodos();
    }

    public static function buscarPorId($id) {
        return Slideshow::buscarPorId($id);
    }

    public static function excluir($id) {
        $slide = Slideshow::buscarPorId($id);
        if ($slide && $slide['imagem']) {
            $caminhoImagem = __DIR__ . '/../../public/assets/images/' . $slide['imagem'];
            if (file_exists($caminhoImagem)) {
                unlink($caminhoImagem);
            }
        }
        $res = Slideshow::deletar($id);
        if ($res) {
            Log::registrar('excluiu slide', json_encode(['id'=>$id]), 'admin');
        } else {
            Log::registrar('erro ao excluir slide', json_encode(['id'=>$id]), 'admin');
        }
        return $res;
    }
} 