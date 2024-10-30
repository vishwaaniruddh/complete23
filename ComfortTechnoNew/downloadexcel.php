<?php
$folderPath = 'excelfiles/'; // Replace with the actual path to your Excel files folder

if (isset($_GET['file'])) {
    $fileName = $_GET['file'];
    $filePath = $folderPath . '/' . $fileName;

    if (file_exists($filePath)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filePath));
        readfile($filePath);
        exit;
    } else {
        echo 'File not found.';
    }
}