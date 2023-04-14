<?php
session_start();

@$address = $_POST["address"];
@$name = $_POST["name"];
@$login = $_POST["login"];
@$pass = $_POST["pass"];
@$repass = $_POST["repass"];
@$validate = $_POST["validate"];
$erreur = "";

if (isset($validate)) {
   if (empty($address)) $erreur = "Address left blank!";
   elseif (empty($name)) $erreur = "Name left blank!";
   elseif (empty($login)) $erreur = "Login left blank!";
   elseif (empty($pass)) $erreur = "Password left blank!";
   elseif ($pass != $repass) $erreur = "Passwords do not match!";
   else {
      include("php/config.php");
      $sel = $pdo->prepare("SELECT id FROM users WHERE login=? LIMIT 1");
      $sel->execute([$login]);
      $tab = $sel->fetchAll();
      if (count($tab) > 0) {
         $erreur = "Login already exists!";
      } else {
         $hashed_password = password_hash($pass, PASSWORD_DEFAULT);
         $ins = $pdo->prepare("INSERT INTO users(address, name, login, pass) VALUES (?, ?, ?, ?)");
         if ($ins->execute([$address, $name, $login, $hashed_password])) {
            header("location:index.php");
         }
      }
   }
}

?>
<!DOCTYPE html>
<html>

<head>
   <meta charset="utf-8" />
</head>

<body>
   <h1>Inscription</h1>
   <div class="erreur"><?php echo $erreur ?></div>
   <form name="fo" method="post" action="">
      <input type="text" name="address" placeholder="Address" value="<?php echo $address ?>" /><br />
      <input type="text" name="name" placeholder="Name" value="<?php echo $name ?>" /><br />
      <input type="text" name="login" placeholder="Login" value="<?php echo $login ?>" /><br />
      <input type="password" name="pass" placeholder="Password" /><br />
      <input type="password" name="repass" placeholder="Confirm password" /><br />
      <input type="submit" name="validate" value="S'authentifier" />
   </form>
</body>

</html>



<?php
session_start();
$login = $_POST["login"] ?? null;
$password = $_POST["pass"] ?? null;
$valide = $_POST["valide"] ?? null;
$erreur = "";

if (isset($valide)) {
   include("php/config.php");
   $sel = $pdo->prepare("SELECT * FROM users WHERE login = ? LIMIT 1");
   $sel->execute([$login]);
   $user = $sel->fetch(PDO::FETCH_ASSOC);

   if ($user) {
      $stored_hashed_password = $user['pass'];
      $is_password_valid = password_verify($password, $stored_hashed_password);

      if ($is_password_valid) {
         $_SESSION["user_id"] = $user["id"];
         $_SESSION["addressName"] = ucfirst(strtolower($user["name"])) . " " . strtoupper($user["name"]);
         $_SESSION["autorise"] = "yes";
         header("location:index.php");
      } else {
         $erreur = "Wrong login or password!";
      }
   } else {
      $erreur = "Wrong login or password!";
   }
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

<?php
session_start();
$login = $_POST["login"] ?? null;
$password = $_POST["pass"] ?? null;
$valide = $_POST["valide"] ?? null;
$erreur = "";

if (isset($valide)) {
   include("php/config.php");
   $sel = $pdo->prepare("SELECT * FROM users WHERE login = ? LIMIT 1");
   $sel->execute([$login]);
   $user = $sel->fetch(PDO::FETCH_ASSOC);

   if ($user) {
      $stored_hashed_password = $user['pass'];
      $is_password_valid = password_verify($password, $stored_hashed_password);

      if ($is_password_valid) {
         $_SESSION["user_id"] = $user["id"];
         $_SESSION["addressName"] = ucfirst(strtolower($user["name"])) . " " . strtoupper($user["name"]);
         $_SESSION["autorise"] = "yes";
         header("location:index.php");
      } else {
         $erreur = "Wrong login or password!";
      }
   } else {
      $erreur = "Wrong login or password!";
   }
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



//////////////////////


<?php
require 'php/config.php';

$projectId = $_GET['id'] ?? null;
if (!isset($projectId)) {
    header("Location: index.php");
}

$stmt = $pdo->prepare("DELETE FROM projects WHERE id = :id");
$stmt->bindValue(':id', $projectId, PDO::PARAM_INT);

try {
    $stmt->execute();
    header("Location: index.php?successDelete=true");
} catch (Exception $e) {
    header("Location: index.php?successDelete=false");
}
