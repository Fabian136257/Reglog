<?php session_start();
require "connect.php";



if(isset($_POST["login"])) {
  if(empty($_POST["username_email"])  or empty($_POST["password"])) {
    echo "<center>Empty spaces need to be filed!</center>";
  } else {
    $password=strip_tags(trim($_POST["password"]));
    $username_email=trim($_POST["username_email"]);

    if(filter_var($username_email, FILTER_VALIDATE_EMAIL)){
      $query=$db_conn->prepare("SELECT * FROM users WHERE email=? AND password=? ");
    } else {
      $query = $db_conn->prepare("SELECT * FROM users WHERE username=? AND password=?");
    }

    $query->execute(array($username_email,$password));
    $control=$query->fetch(PDO::FETCH_OBJ);

    if($control) {
      $_SESSION["user_id"]=$control->id;
      $_SESSION["username"]=$control->username;
      header("location: index.php");
    } else{
      $_SESSION['message']= "<center>Incorrect Password or Username/Email!</center>";
      header("Location: login.php");
      exit();
    }
    }
  }



?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Login</title>
  </head>
  <body>
  <?php if(isset($_SESSION['message'])) : ?>
        <h5><?= $_SESSION['message']; ?> </h5>
      <?php endif; ?>
    <h2>Login</h2>
    <form method="post">
      <label for="username">Username or Email : </label>
      <input type="text" name="username_email" id="username_email"> <br>
      <label for="password">Password : </label>
      <input type="password" name="password" id="password"> <br>
      <button type="submit" name="login">Login</button>
    </form>
    <br>
<a>Dont have an account?</a><br>
<a href="register.php">Register</a>
  </body>
</html>

</body>
</html>
