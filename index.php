<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Malicious Link and Email Detector</title>
    <link rel="stylesheet" href="./index.css"> <!-- Assuming you have an external CSS file -->
</head>
<body align="center">
    <h1>Malicious Link and Email Detector</h1>
    
    <form id="detectorForm" method="POST" action="index.php"> <!-- Keep the action pointing to index.php -->
        <label for="link">Enter a link:</label>
        <input type="text" name="link" id="link" required><br><br>
        
        <label for="email">Enter an email:</label>
        <input type="text" name="email" id="email" required><br><br>

        <input type="submit" value="Detect">
    </form>

    <?php
function isMaliciousLink($text) {
    $maliciousDomains = array("malicious.com", "evil.org", "example.com");
    foreach ($maliciousDomains as $domain) {
        if (strpos($text, $domain) !== false) {
            return true;
        }
    }
    return false;
}

function isMaliciousEmail($email) {
    $maliciousPatterns = array("/\bmalicious.com\b/i", "/\bhacker\b/i");
    foreach ($maliciousPatterns as $pattern) {
        if (preg_match($pattern, $email)) {
            return true;
        }
    }
    return false;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $link = $_POST["link"];
    $email = $_POST["email"];

    $isMaliciousLink = isMaliciousLink($link);
    $isMaliciousEmail = isMaliciousEmail($email);

    // Create response array
    $response = array(
        "isMaliciousLink" => $isMaliciousLink,
        "isMaliciousEmail" => $isMaliciousEmail
    );

    // Return JSON response
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}
?>


    <script src="./index.js"></script> <!-- Corrected the script tag -->
</body>
</html>
