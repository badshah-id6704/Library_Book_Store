<?php
session_start();
if (!isset($_SESSION['username'])) {
  header("Location: login.html");
  exit();
}
include 'config.php';
$countResult = $conn->query("SELECT COUNT(*) AS total FROM books");
$count = $countResult ? $countResult->fetch_assoc()['total'] : 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>📊 Dashboard</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Segoe UI', sans-serif;
    }

    body {
      min-height: 100vh;
      background: url('https://images.unsplash.com/photo-1507842217343-583bb7270b66') no-repeat center center fixed;
      background-size: cover;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 30px;
      animation: fadeIn 1s ease;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: scale(0.95); }
      to { opacity: 1; transform: scale(1); }
    }

    .container {
      background: rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(14px);
      border-radius: 16px;
      padding: 40px;
      max-width: 600px;
      width: 90%;
      box-shadow: 0 0 25px rgba(255,255,255,0.25);
      color: #fff;
      text-align: center;
    }

    h2 {
      margin-bottom: 10px;
      font-size: 2rem;
    }

    h3 {
      margin-bottom: 30px;
      color: #ffe169;
    }

    .card-actions {
      display: flex;
      flex-direction: column;
      gap: 15px;
      align-items: center;
    }

    .card-actions a {
      width: 100%;
      max-width: 300px;
      text-decoration: none;
    }

    .card-actions button {
      width: 100%;
      padding: 14px;
      font-size: 1rem;
      font-weight: bold;
      color: #fff;
      background-color: #2196f3;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      transition: background 0.3s ease, transform 0.2s ease;
    }

    .card-actions button:hover {
      background-color: #1976d2;
      transform: translateY(-2px);
      box-shadow: 0 0 10px rgba(0, 183, 255, 0.3);
    }

    @media (max-width: 600px) {
      .container {
        padding: 30px 20px;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>📊 Dashboard</h2>
    <p>Hello, <strong><?= htmlspecialchars($_SESSION['username']) ?></strong>!</p>
    <h3>Total Books: <?= $count ?></h3>

    <div class="card-actions">
      <a href="books.php"><button>📖 Browse Books</button></a>
      <a href="addbook.php"><button>➕ Add Book</button></a>
      <a href="logout.php"><button>🚪 Logout</button></a>
    </div>
  </div>
</body>
</html>