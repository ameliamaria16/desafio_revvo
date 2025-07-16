<?php
require_once '../../src/controllers/CursoController.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    header('Location: cursos.php?msg=erro');
    exit;
}

if (CursoController::excluir($id)) {
    header('Location: cursos.php?msg=excluido');
} else {
    header('Location: cursos.php?msg=erro');
}
exit;
?> 