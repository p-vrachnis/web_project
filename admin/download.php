<?php
session_start();
$filename = $_SESSION["filename"];
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="'.basename($filename).'"');
readfile($filename);
unset($_SESSION["filename"]);
?>
