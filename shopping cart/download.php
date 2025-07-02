<?php
session_start();

if (isset($_SESSION['qrcode_path']) && file_exists($_SESSION['qrcode_path'])) {
    $file = $_SESSION['qrcode_path'];
    $creationTime = $_SESSION['qrcode_time'] ?? 0;
     
    
    // Force download
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="' . basename($file) . '"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file));
    readfile($file); 

    // Optionally, clear the QR code file after download to avoid accumulation
    unlink($file);

    // Clear session QR code path
    unset($_SESSION['qrcode_path']);
    
    exit;
} else {
    //echo "QR code file not found!";
}
?>
<?php
@include 'products.php';

?>




