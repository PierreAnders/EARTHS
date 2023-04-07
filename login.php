<?php
   session_start();
   @$login=$_POST["login"];
   @$pass=md5($_POST["pass"]);
   @$valide=$_POST["valide"];
   $erreur="";
   if(isset($valide)){
      include("php/config.php");
      $sel=$pdo->prepare("select * from users where login=? and pass=? limit 1");
      $sel->execute(array($login,$pass));
      $tab=$sel->fetchAll();
      if(count($tab)>0){
         $_SESSION["addressName"]=ucfirst(strtolower($tab[0]["name"])).
         " ".strtoupper($tab[0]["name"]);
         $_SESSION["autorise"]="yes";
         header("location:session.php");
      }
      else
         $erreur="Wrong login or password!";
   }
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
         input{
            border:solid 1px #2222AA;
            margin-bottom:10px;
            padding:16px;
            outline:none;
            border-radius:6px;
         }
         .erreur{
            color:#CC0000;
            margin-bottom:10px;
         }
         a{
            font-size:12pt;
            color:#EE6600;
            text-decoration:none;
            font-weight:normal;
         }
         a:hover{
            text-decoration:underline;
         }
      </style>
   </head>
   <body onLoad="document.fo.login.focus()">
      <h1>Authentification [ <a href="inscription.php">Create an account</a> ]</h1>
      <div class="erreur"><?php echo $erreur ?></div>
      <form name="fo" method="post" action="">
         <input type="text" name="login" placeholder="Login" /><br />
         <input type="password" name="pass" placeholder="Password" /><br />
         <input type="submit" name="valide" value="Authenticate" />
      </form>
   </body>
</html>