<?php
// Handle API requests
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['api'])) {
    // Handle API logic
    echo json_encode(['message' => 'This is an API response']);
    exit;
}

// Serve static assets
$path = $_SERVER['REQUEST_URI'];
$filePath = __DIR__ . '/public' . $path;

// Check if the requested path is a directory
if (is_dir($filePath)) {
    // Display directory contents
    $files = scandir($filePath);
    foreach ($files as $file) {
        if ($file !== '.' && $file !== '..') {
            echo "<img src=\"$path/$file\" alt=\"$file\" />\n";
        }
    }
    exit;
}

// Check if the file exists and is readable
if (file_exists($filePath) && is_readable($filePath)) {
    $extension = pathinfo($path, PATHINFO_EXTENSION);
    $mime_type = mime_content_type($filePath);
    header("Content-Type: $mime_type");
    readfile($filePath);
    exit;
} else {
    // Handle non-existent or unreadable files
    http_response_code(404);
    echo json_encode(['error' => 'File not found']);
    exit;
}
?>

