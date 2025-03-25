<?php
  $servername = "localhost";
  $database = "guessai";
  $conn = mysqli_connect($servername, "root", "", $database);

  if (!$conn) die("Connection failed: " . mysqli_connect_error());
?>
