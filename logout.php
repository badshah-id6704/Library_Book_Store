<?php
session_start();
session_destroy();
echo "<div style='padding:40px;text-align:center;color:#333;background:#eee;border-radius:12px;max-width:400px;margin:30px auto;'>
      <h3>🚪 You’ve been logged out.</h3>
      <a href='index.html'>🔙 Return to Home</a>
      </div>";
?>