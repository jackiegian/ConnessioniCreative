<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

function sanitize_filename($filename) {
    return basename($filename);
}

$file = sanitize_filename($_GET['file']);
$filepath = 'private/DOC/' . $file;

if (file_exists($filepath) && strpos(realpath($filepath), realpath('private/DOC')) === 0) {
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="' . basename($filepath) . '"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($filepath));
    readfile($filepath);
    exit;
} else {
    echo "File non trovato o accesso non autorizzato.";
}
?>

