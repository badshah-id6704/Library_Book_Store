<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'config.php';

$success = "";
$error = "";

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $title = $_POST['title'] ?? '';
  $author = $_POST['author'] ?? '';
  $genre = $_POST['genre'] ?? '';
  $year = $_POST['published_year'] ?? null;

  if (!$title || !$author) {
    $error = "❌ Please enter both Title and Author fields.";
  } else {
    $stmt = $conn->prepare("INSERT INTO books (title, author, genre, published_year) VALUES (?, ?, ?, ?)");
    if ($stmt) {
      $stmt->bind_param("sssi", $title, $author, $genre, $year);
      if ($stmt->execute()) {
        $success = "✅ Book <strong>" . htmlspecialchars($title) . "</strong> added successfully!";
      } else {
        $error = "❌ Execute error: " . htmlspecialchars($stmt->error);
      }
      $stmt->close();
    } else {
      $error = "❌ Prepare failed: " . htmlspecialchars($conn->error);
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>➕ Add New Book</title>
  <style>
    * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', sans-serif; }

    body {
      background: url('https://images.unsplash.com/photo-1544717305-2782549b5136') no-repeat center center fixed;
      background-size: cover;
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 20px;
      animation: fadeIn 1s ease;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(10px); }
      to   { opacity: 1; transform: translateY(0); }
    }

    .container {
      background: rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(14px);
      border-radius: 16px;
      padding: 35px;
      max-width: 500px;
      width: 100%;
      box-shadow: 0 0 30px rgba(255,255,255,0.2);
      color: #fff;
      text-align: center;
    }

    h2 { margin-bottom: 20px; }

    label {
      display: block;
      text-align: left;
      margin-top: 12px;
      font-weight: 500;
    }

    input[type="text"],
    input[type="number"] {
      width: 100%;
      padding: 10px;
      border: none;
      border-radius: 8px;
      background: rgba(255, 255, 255, 0.9);
      margin-top: 5px;
      color: #333;
    }

    input[type="submit"] {
      width: 100%;
      padding: 12px;
      margin-top: 25px;
      border: none;
      border-radius: 8px;
      background-color: #00bcd4;
      color: #fff;
      font-weight: bold;
      cursor: pointer;
      transition: background 0.3s ease, transform 0.2s ease;
    }

    input[type="submit"]:hover {
      background-color: #008da4;
      transform: scale(1.03);
    }

    a {
      display: block;
      margin-top: 20px;
      color: #ffe57f;
      text-decoration: none;
    }

    a:hover { color: #fff; }

    .message {
      margin-top: 20px;
      padding: 15px;
      border-radius: 8px;
      font-weight: bold;
    }

    .success { background: #e0f7fa; color: #00695c; }
    .error   { background: #ffcdd2; color: #b71c1c; }
  </style>
</head>
<body>
  <div class="container">
    <h2>➕ Add New Book</h2>

    <?php if ($success): ?>
      <div class="message success"><?= $success ?></div>
    <?php endif; ?>

    <?php if ($error): ?>
      <div class="message error"><?= $error ?></div>
    <?php endif; ?>

    <form method="post">
      <label>Title</label>
      <input type="text" name="title" required>

      <label>Author</label>
      <input type="text" name="author" required>

      <label>Genre</label>
      <input type="text" name="genre">

      <label>Published Year</label>
      <input type="number" name="published_year" min="1000" max="2100">

      <input type="submit" value="Add Book">
    </form>

    <a href="/dashboard.php">🏠 Back to Dashboard</a>
  </div>
</body>
</html>