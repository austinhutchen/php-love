<?php
// Handle API requests
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['api'])) {
    // Handle API logic
    echo json_encode(['message' => 'This is an API response']);
    exit;
}

// Serve static assets
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Check if the request is for favicon.ico
if ($path === '/favicon.ico') {
    // Set the appropriate Content-Type header for favicon
    header("Content-Type: image/x-icon");
    // Serve a default favicon file
    readfile(__DIR__ . '/public/favicon.ico');
    exit;
}

// Define the base directory for static assets
$baseDir = __DIR__ . '/public';

// Check if the requested file exists in the public directory
$filePath = $baseDir . $path;

// Check if the file exists and is readable
if ($path === '/') {
    $filePath = __DIR__ . '/index.php';
}

if (file_exists($filePath) && is_readable($filePath)) {
    // Get the MIME type of the file
    $mime_type = mime_content_type($filePath);
    // Set the appropriate Content-Type header
    header("Content-Type: $mime_type");
    // Output the file contents
    readfile($filePath);
    exit;
}

// Handle non-existent or unreadable files
http_response_code(404);
echo json_encode(['error' => 'File not found']);
exit;
?>

