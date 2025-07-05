<?php
include 'config.php';
$result = $conn->query("SELECT title, author, genre FROM books");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>📖 Browse Books</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Segoe UI', sans-serif;
    }

    body {
      background: url('https://images.unsplash.com/photo-1512820790803-83ca734da794') no-repeat center center fixed;
      background-size: cover;
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 30px;
      animation: fadeIn 1s ease;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(10px); }
      to   { opacity: 1; transform: translateY(0); }
    }

    .container {
      background: rgba(255, 255, 255, 0.08);
      backdrop-filter: blur(14px);
      border-radius: 16px;
      padding: 40px;
      max-width: 600px;
      width: 100%;
      color: #fff;
      box-shadow: 0 0 25px rgba(255,255,255,0.2);
      text-align: center;
    }

    h2 {
      margin-bottom: 20px;
      font-size: 1.8rem;
    }

    ul {
      list-style: none;
      padding: 0;
    }

    li {
      background: rgba(255, 255, 255, 0.12);
      margin-bottom: 15px;
      padding: 15px;
      border-radius: 12px;
      text-align: left;
      font-size: 1rem;
      line-height: 1.4;
      transition: background 0.3s ease, transform 0.2s ease;
    }

    li:hover {
      background: rgba(255, 255, 255, 0.2);
      transform: scale(1.02);
    }

    strong {
      color: #ffecb3;
    }

    a {
      display: inline-block;
      margin-top: 25px;
      padding: 12px 20px;
      background-color: #00bcd4;
      color: #fff;
      text-decoration: none;
      border-radius: 8px;
      font-weight: bold;
      transition: background 0.3s ease, transform 0.2s ease;
    }

    a:hover {
      background-color: #008ba3;
      transform: scale(1.05);
    }

    @media (max-width: 600px) {
      .container {
        padding: 25px;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>📖 Browse Books</h2>
    <ul>
      <?php while ($row = $result->fetch_assoc()): ?>
        <li>
          <strong><?= htmlspecialchars($row['title']) ?></strong><br>
          👤 <?= htmlspecialchars($row['author']) ?><br>
          📚 <?= htmlspecialchars($row['genre']) ?>
        </li>
      <?php endwhile; ?>
    </ul>
    <a href="/dashboard.php">🏠 Back to Dashboard</a>
  </div>
</body>
</html>