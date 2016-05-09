<?php
session_start();
if (!isset($_SESSION["USERID"])) {
    header("Location: logout.php");
    exit;
}
?>
<!doctype html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>main page - Welcome CTF 2016: Web 100: Blind SQL Injection</title>
  </head>
  <body>
    <?php
    if ($_SESSION["USERID"] === 'root') {
        echo "Hello root!";
        echo "pleaze access to <i>http://153.126.150.208/welcome-ctf-2016/\${YOUR_PASSWORD}/</i>";
    } else {
        echo ":-)";
    }
    ?>
    <ul>
      <li><a href="index.php">nop</a></li>
      <li><a href="logout.php">logout</a></li>
    </ul>
  </body>
</html>
