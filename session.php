<?php
session_start();
if ($_SESSION["autorise"] != "yes") {
   header("location:login.php");
   exit();
}

$welcome = "Hello";
?>
<!DOCTYPE html>
<html>

<head>
   <meta charset="utf-8" />

</head>

<body onLoad="document.fo.login.focus()">
   <h2><?php echo $welcome ?></h2>
   [ <a href="deconnexion.php">Sign out</a> ]
</body>

</html>