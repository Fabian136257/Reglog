<?php session_start();
require "connect.php";
session_unset();
session_destroy();

if(isset($_POST['register'])) {

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmpassword = $_POST['confirmpassword'];

    $query = "SELECT * FROM users WHERE email = :email OR username = :username";
    $query_run = $db_conn->prepare($query);
    $query_run->execute(['email' => $email, 'username' => $username]);
    $exi_user = $query_run->fetch();

    if ($exi_user) {
      $_SESSION['message'] = "Account with this username or email is already taken";
  } else {
      if (!empty($password) && !empty($confirmpassword)) {
        if ($password == $confirmpassword) {
          $query = "INSERT INTO users (username, email, password) VALUES (:username, :email, :password)";
          $query_run = $db_conn->prepare($query);

          $data = [
              'username' => $username,
              'email' => $email,
              'password' => $password,
          ];
          $query_execute = $query_run->execute($data);

          if ($query_execute) {
              $_SESSION['message'] = "Regisstaration successful";
          } else {
              $_SESSION['message'] = "Registaration failed";
          }
      } else {
          $_SESSION['message'] = "Passwords do not match";
      } 
    }
  }
}


?>
<!DOCTYPE html>
<html>
<head>


</head>
<body>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Register</title>
  </head>
  <body>

<?php 
  if(isset($_SESSION['message'])) {
    echo $_SESSION['message'];
    unset($_SESSION['message']);
  }
?>

    <h2>Registeration</h2>
    <form method="post">
      <label for="username">Username : </label>
      <input type="text" name="username" id = "username"> <br>
      <label for="email">Email : </label>
      <input type="email" name="email" id = "email" required value=""> <br>
      <label for="password">Password : </label>
      <input type="password" name="password" id = "password"> <br>
      <label for="confirmpassword">Confirm Password : </label>
      <input type="password" name="confirmpassword" id = "confirmpassword"> <br>
      <button type="submit" name="register">Register</button><br><br>
      <a href="login.php">Login</a>
    </form>
    <br>

  </body>
</html>

</body>
</html>
