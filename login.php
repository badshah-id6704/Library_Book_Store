<?php
session_start();
include 'config.php';

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

if (!$username || !$password) {
  die("❌ Please enter both username and password.");
}

// Get user from database
$stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows === 1) {
  $stmt->bind_result($hashedPassword);
  $stmt->fetch();

  if (password_verify($password, $hashedPassword)) {
    $_SESSION['username'] = $username;
    header("Location: dashboard.php");
    exit();
  } else {
    echo "❌ Incorrect password. <a href='login.html'>Try again</a>";
  }
} else {
  echo "❌ Username not found. <a href='login.html'>Try again</a>";
}
$stmt->close();
?>