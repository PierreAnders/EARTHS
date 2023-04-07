<?php
   session_start();
   @$address=$_POST["address"];
   @$name=$_POST["name"];
   @$login=$_POST["login"];
   @$pass=$_POST["pass"];
   @$repass=$_POST["repass"];
   @$validate=$_POST["validate"];
   $erreur="";
   if(isset($validate)){
      if(empty($address)) $erreur="Nom laissé vide!";
      elseif(empty($name)) $erreur="Prénom laissé vide!";
      elseif(empty($login)) $erreur="Login laissé vide!";
      elseif(empty($pass)) $erreur="Mot de passe laissé vide!";
      elseif($pass!=$repass) $erreur="Mots de passe non identiques!";
      else{
         include("php/config.php");
         $sel=$pdo->prepare("select id from users where login=? limit 1");
         $sel->execute(array($login));
         $tab=$sel->fetchAll();
         if(count($tab)>0)
            $erreur="Login existe déjà!";
         else{
            $ins=$pdo->prepare("insert into users(address,name,login,pass) values(?,?,?,?)");
            if($ins->execute(array($address,$name,$login,md5($pass))))
               header("location:index.php");
         }   
      }
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
      </style>
   </head>
   <body>
      <h1>Inscription</h1>
      <div class="erreur"><?php echo $erreur ?></div>
      <form name="fo" method="post" action="">
          <input type="text" name="address" placeholder="Address" value="<?php echo $address?>" /><br />
         <input type="text" name="name" placeholder="Name" value="<?php echo $name?>" /><br />
         <input type="text" name="login" placeholder="Login" value="<?php echo $login?>" /><br />
         <input type="password" name="pass" placeholder="Password" /><br />
         <input type="password" name="repass" placeholder="Confirm password" /><br />
         <input type="submit" name="validate" value="S'authentifier" />
      </form>
   </body>
</html>