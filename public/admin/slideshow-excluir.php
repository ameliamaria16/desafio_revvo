<?php
require_once '../../src/controllers/SlideshowController.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    header('Location: slideshow.php?msg=erro');
    exit;
}

if (SlideshowController::excluir($id)) {
    header('Location: slideshow.php?msg=excluido');
} else {
    header('Location: slideshow.php?msg=erro');
}
exit; 