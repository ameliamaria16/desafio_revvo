<?php
/**
 * Conexão simples com o banco de dados
 * PHP Puro - Sem dependências externas
 */

// Configurações do banco
$host = 'localhost';
$dbname = 'desafio_revvo';
$username = 'root';
$password = '';

// Função para conectar ao banco
function conectar() {
    global $host, $dbname, $username, $password;
    
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $pdo;
    } catch(PDOException $e) {
        die("Erro na conexão: " . $e->getMessage());
    }
}

// Função para executar queries
function executar($sql, $params = []) {
    $pdo = conectar();
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    return $stmt;
}

// Função para buscar um registro
function buscarUm($sql, $params = []) {
    $stmt = executar($sql, $params);
    return $stmt->fetch();
}

// Função para buscar todos os registros
function buscarTodos($sql, $params = []) {
    $stmt = executar($sql, $params);
    return $stmt->fetchAll();
}

// Função para inserir e retornar ID
function inserir($sql, $params = []) {
    $pdo = conectar();
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    return $pdo->lastInsertId();
}

// Função para atualizar
function atualizar($sql, $params = []) {
    $stmt = executar($sql, $params);
    return $stmt->rowCount();
}

// Função para deletar
function deletar($sql, $params = []) {
    $stmt = executar($sql, $params);
    return $stmt->rowCount();
}
?> 