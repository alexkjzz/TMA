<?php

$uploadDir = 'uploads/';
$allowedTypes = ['image/jpeg', 'image/png', 'application/pdf'];
$maxSize = 2 * 1024 * 1024;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_FILES['fichier'])) {
        echo "<script>alert('❌ Aucun fichier reçu.'); window.history.back();</script>";
        exit();
    }

    $file = $_FILES['fichier'];

    if ($file['error'] !== UPLOAD_ERR_OK) {
        echo "<script>alert('❌ Erreur lors de l\\'upload.'); window.history.back();</script>";
        exit();
    }

    if (!in_array($file['type'], $allowedTypes)) {
        echo "<script>alert('❌ Format de fichier non autorisé.'); window.history.back();</script>";
        exit();
    }

    if ($file['size'] > $maxSize) {
        echo "<script>alert('❌ Fichier trop volumineux (max 2 Mo).'); window.history.back();</script>";
        exit();
    }

    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $destination = $uploadDir . basename($file['name']);

    if (move_uploaded_file($file['tmp_name'], $destination)) {
        echo "<script>alert('✅ Fichier uploadé avec succès.'); window.history.back();</script>";
    } else {
        echo "<script>alert('❌ Échec de l\\'upload.'); window.history.back();</script>";
    }
}
?>
