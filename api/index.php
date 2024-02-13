<!DOCTYPE html>
<html lang="en">
<head>
<?php
// Function to check if the requested URI is for a CSS file
function isCssRequest($uri) {
    // Check if the URI ends with ".css"
    return pathinfo($uri, PATHINFO_EXTENSION) === 'css';
}

// Function to construct the file path for CSS files
function getCssFilePath($uri) {
    // Construct the file path for CSS files
    return __DIR__ . '/public' . $uri;
}

// Handle API requests
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['api'])) {
    // Handle API logic
    echo json_encode(['message' => 'This is an API response']);
    exit;
}

// Serve static assets
$path = $_SERVER['REQUEST_URI'];
echo "Requested URI: $path\n"; // Debugging output

// Check if the request is for the root URI
if ($path === '/') {
    // Redirect to index.html or handle accordingly
    // For example:
    // header("Location: /index.html");
    // exit;
    // Or serve a default HTML content
    // echo "Welcome to the website!";
    // exit;
}

// Check if the request is for a CSS file
if (isCssRequest($path)) {
    // Set the appropriate Content-Type header for CSS
    header("Content-Type: text/css");
    // Get the file path for CSS files
    $filePath = getCssFilePath($path);
    echo "File Path: $filePath\n"; // Debugging output
} else {
    // Construct the file path for other static assets
    $filePath = __DIR__ . '/public' . $path;
    echo "File Path: $filePath\n"; // Debugging output
}

// Check if the file exists and is readable
if (file_exists($filePath) && is_file($filePath) && is_readable($filePath)) {
    // Output the file contents
    readfile($filePath);
    exit;
} else {
    // Handle non-existent or unreadable files
    http_response_code(404);
    echo json_encode(['error' => 'File not found']);
    exit;
}
?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/public/styles.css">
    <title>Will You Be My Valentine?</title>
</head>
<body>
    <?php include 'header.php'; ?>
    <main class="main">
        <h1>Will You Be My Valentine?</h1>
        <img src="/public/images/gamew.JPG" alt="gameW" />
        <img src="/public/images/couple.JPG" alt="Couple" />
        <img src="/public/images/hot.webp" alt="Hot" />
        <img src="/public/images/liv2.JPG" alt="l2" />
        <img src="/public/images/wine.JPG" alt="Wine" />
        <img src="/public/images/hot2.webp" alt="Hot2" />
        <div class="content">
            <h3>Roses are red, violets are blue, brown sugar and banana bread is the sweetest, and so are you!</h3>
            <button class="valentine-button">Yes, I will be your Valentine!!!!! ❤️❤️</button>
            <button class="valentine-button"> I won't be your Valentine.. >:_) </button>
        </div>
    </main>
    <?php include 'footer.php'; ?>
</body>
</html>

