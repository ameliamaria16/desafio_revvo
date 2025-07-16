<?php
require_once __DIR__ . '/../models/Slideshow.php';

class SlideshowController {
    public static function criar() {
        $mensagem = '';
        if ($_POST) {
            $titulo = $_POST['titulo'] ?? '';
            $descricao = $_POST['descricao'] ?? '';
            $link_botao = $_POST['link_botao'] ?? '';
            $texto_botao = $_POST['texto_botao'] ?? 'Saiba Mais';
            $ordem = $_POST['ordem'] ?? 0;
            $status = $_POST['status'] ?? 'ativo';

            $imagem = self::processarUpload();

            if ($imagem === false) {
                $mensagem = 'Erro ao enviar imagem';
            } else {
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
                    header('Location: slideshow.php?msg=sucesso');
                    exit;
                } else {
                    $mensagem = 'Erro ao salvar slide';
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
            $link_botao = $_POST['link_botao'] ?? '';
            $texto_botao = $_POST['texto_botao'] ?? 'Saiba Mais';
            $ordem = $_POST['ordem'] ?? 0;
            $status = $_POST['status'] ?? 'ativo';

            $imagem = self::processarUpload();
            if ($imagem === '') {
                $slideAtual = self::buscarPorId($id);
                $imagem = $slideAtual['imagem'];
            }

            if ($imagem === false) {
                $mensagem = 'Erro ao enviar imagem';
            } else {
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
                    header('Location: slideshow.php?msg=atualizado');
                    exit;
                } else {
                    $mensagem = 'Erro ao atualizar slide';
                }
            }
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
        $extensao = pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION);
        $imagem = 'slide_' . time() . '.' . $extensao;
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
        return Slideshow::deletar($id);
    }
} 