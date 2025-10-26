<?php
if (isset($_GET['file'])) {
    // Sanitize the file name to prevent directory traversal
    $file = basename($_GET['file']);

    // Define the path to the file
    $filepath = __DIR__ . '/assets/pdf/' . $file;

    // Check if the file exists
    if (file_exists($filepath)) {
        // Set headers to force download
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($filepath) . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filepath));
        flush(); // Flush system output buffer
        readfile($filepath);
        exit;
    } else {
        // File not found
        echo "File not found: " . htmlspecialchars($filepath);
    }
} else {
    // No file specified
    echo "No file specified.";
}
?>