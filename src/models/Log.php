<?php
require_once __DIR__ . '/../config/conexao.php';

class Log {
    public static function registrar($acao, $detalhes = '', $usuario = null) {
        $ip = $_SERVER['REMOTE_ADDR'] ?? null;
        $sql = "INSERT INTO logs (usuario, acao, detalhes, ip) VALUES (?, ?, ?, ?)";
        return inserir($sql, [$usuario, $acao, $detalhes, $ip]);
    }
} 