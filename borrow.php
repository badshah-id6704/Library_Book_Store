<?php
include 'config.php';
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

$user_id = $_SESSION['user'] ?? null;
$book_id = $_POST['book_id'] ?? null;

$message = "";
$statusClass = "";

// Validate input
if (!$user_id || !$book_id) {
  $message = "❌ Missing user session or book ID.";
  $statusClass = "error";
} else {
  $stmt = $conn->prepare("INSERT INTO borrow_requests (user_id, book_id, status) VALUES (?, ?, 'Pending')");
  $stmt->bind_param("ii", $user_id, $book_id);

  if ($stmt->execute()) {
    $conn->query("UPDATE books SET available = FALSE WHERE id = $book_id");
    $message = "✅ Book requested successfully!";
    $statusClass = "success";
  } else {
    $message = "❌ Request failed: " . htmlspecialchars($stmt->error);
    $statusClass = "error";
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Borrow Book</title>
  <style>
    body {
      background: url('https://images.unsplash.com/photo-1553729459-efe14ef6055d') no-repeat center center fixed;
      background-size: cover;
      min-height: 100vh;
      margin: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      font-family: 'Segoe UI', sans-serif;
    }

    .card {
      background: rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(14px);
      border-radius: 16px;
      padding: 40px;
      text-align: center;
      max-width: 500px;
      width: 90%;
      color: #fff;
      box-shadow: 0 0 30px rgba(255, 255, 255, 0.2);
    }

    .success {
      background-color: rgba(0, 200, 83, 0.2);
      color: #b9f6ca;
    }

    .error {
      background-color: rgba(255, 82, 82, 0.2);
      color: #ffcdd2;
    }

    a {
      display: inline-block;
      margin-top: 20px;
      padding: 12px 20px;
      background-color: #00bcd4;
      color: #fff;
      text-decoration: none;
      border-radius: 8px;
      font-weight: bold;
      transition: background 0.3s ease;
    }

    a:hover {
      background-color: #008ba3;
    }
  </style>
</head>
<body>
  <div class="card <?= $statusClass ?>">
    <h2><?= $message ?></h2>
    <a href="/books.php">📚 Back to Books</a>
  </div>
</body>
</html>