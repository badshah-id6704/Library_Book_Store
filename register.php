<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['username'] ?? '';
    $passwordRaw = $_POST['password'] ?? '';

    if (!$username || !$passwordRaw) {
        exit("❌ Missing username or password.");
    }

    $password = password_hash($passwordRaw, PASSWORD_DEFAULT);

    // Check if username already exists
    $check = $conn->prepare("SELECT id FROM users WHERE username = ?");
    $check->bind_param("s", $username);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        echo "❌ Username already exists. <a href='index.html'>Try again</a>";
        exit;
    }

    // Proceed with insert
    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    if (!$stmt) {
        die("❌ Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("ss", $username, $password);

    if ($stmt->execute()) {
        echo "✅ Registered successfully. <a href='index.html'>Login</a>";
    } else {
        echo "❌ Registration failed: " . $stmt->error;
    }

    $stmt->close();
    $check->close();
    $conn->close();
} else {
    echo "Invalid request.";
}
?>