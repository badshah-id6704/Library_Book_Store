<?php
$conn = new mysqli(
  "sql207.infinityfree.com",       // Hostname
  "if0_39390173",                  // Username
  "0zD6vTysiJZeyC",                // Password
  "if0_39390173_if0_39390173_library"  // DB Name
);

if ($conn->connect_error) {
  die("❌ Connection failed: " . $conn->connect_error);
}
?>