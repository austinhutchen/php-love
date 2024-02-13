<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

    // Check if the request is for the root URI
if ($path === '/') {
    // Serve the index.php file
    $filePath = __DIR__ . '/index.php';

    // Check if the file exists and is readable
    if (file_exists($filePath) && is_readable($filePath)) {
        // Output the file contents
        require_once($filePath);
        exit;
    } else {
        // Handle non-existent or unreadable files
        http_response_code(404);
        echo json_encode(['error' => 'File not found']);
        exit;
    }
}

    // Define the base directory for static assets
    $baseDir = __DIR__ . '/public';

    // Check if the requested file exists in the public directory
    $filePath = $baseDir . $path;

    // Check if the file exists and is readable
    if (file_exists($filePath) && is_file($filePath) && is_readable($filePath)) {
        // Get the MIME type of the file
        $mime_type = mime_content_type($filePath);
        // Set the appropriate Content-Type header
        header("Content-Type: $mime_type");
        // Output the file contents
        readfile($filePath);
        exit;
    } else {
        // Check if the requested file exists in any subdirectory of public
        $directories = glob($baseDir . '/*', GLOB_ONLYDIR);
        foreach ($directories as $directory) {
            $filePath = $directory . $path;
            if (file_exists($filePath) && is_file($filePath) && is_readable($filePath)) {
                // Get the MIME type of the file
                $mime_type = mime_content_type($filePath);
                // Set the appropriate Content-Type header
                header("Content-Type: $mime_type");
                // Output the file contents
                readfile($filePath);
                exit;
            }
        }
    }

    // Handle non-existent or unreadable files
    http_response_code(404);
    echo json_encode(['error' => 'File not found']);
    exit;
    ?>
    <title>Will You Be My Valentine?</title>
    <link rel="stylesheet" href="/public/styles.css">
</head>
<body>
    <?php include 'header.php'; ?>
    <main class="main">
        <h1>Will You Be My Valentine?</h1>
        <img src="/public/images/gamew.JPG" alt="gameW" />
        <img src="/public/images/couple.JPG" alt="Couple" />
        <img src="/public/images/hot.webp" alt="Hot" />
        <img src="/public/images/liv2.JPG" alt="l2" />
       ⬤
