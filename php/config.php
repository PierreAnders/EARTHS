<?php
$servername = "localhost";
$username = "pierre";
$password = "National2015!";
$dbname = "earthwise";

   try{
      $pdo=new PDO("mysql:host=$servername;dbname=$dbname",$username ,$password);
   }
   catch(PDOException $e){
      echo $e->getMessage();
   }
?>