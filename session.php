<?php
   session_start();
   if($_SESSION["autorise"]!="yes"){
      header("location:login.php");
      exit();
   }
   if(date("H")<18)
      $welcome="Hi, welcome, have a nice day! ".
      $_SESSION["addressName"].
      " in your personal space";
   else
      $welcome="Hi, welcome, have a nice evening! ".
      $_SESSION["prenomNom"].
      " in your personal space";
?>
<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8" />
      <style>
         *{
            font-family:arial;
         }
         body{
            margin:20px;
         }
         a{
            color:#EE6600;
            text-decoration:none;
         }
         a:hover{
            text-decoration:underline;
         }
      </style>
   </head>
   <body onLoad="document.fo.login.focus()">
      <h2><?php echo $welcome?></h2>
      [ <a href="deconnexion.php">Sign out</a> ]
   </body>
</html>