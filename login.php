<?php
   session_start();
   $login=$_POST["login"] ?? null;
   $pass=md5($_POST["pass"] ?? null);
   $valide=$_POST["valide"] ?? null;
   $erreur="";
   if(isset($valide)){
      include("php/config.php");
      $sel=$pdo->prepare("select * from users where login=? and pass=? limit 1");
      $sel->execute(array($login,$pass));
      $tab=$sel->fetchAll();
      if(count($tab)>0){
         $_SESSION["user_id"] = $tab[0]["id"];
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