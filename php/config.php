<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "earthwise";

   try{
      $pdo=new PDO("mysql:host=$servername;dbname=$dbname",$username ,$password);
   }
   catch(PDOException $e){
      echo $e->getMessage();
   }
?>