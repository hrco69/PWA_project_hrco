<?php 

  require_once "./phpfunkcije/db_funkcije.php"; 

  if(isset($_GET["logout"])){
    session_start(); 
    session_destroy();
    header("Location: login.php"); 
    exit(); 
  }

  if(isset($_POST["login"])){
    $errMessg = "Username or password is incorrect"; 
    $error = false; 
    $account = returnAccountFromDatabase(null, $_POST["username"]); 
    if($account != null and password_verify($_POST["password"], $account["password"])){
      session_start(); 
      $_SESSION["isAdmin"] = $account["rank"] == 1;
      $_SESSION["username"] = $account["username"]; 
      header("Location:  http://localhost/PWA_project_hrco/index.php");
      exit();    
    }else $error = true; 
  }

?>

<!DOCTYPE html>
<html lang="hr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="css/login.css">
</head>
<body>
<?php include './subtabs/navigacija.php'; ?>

  <div class="login-container">
    <div class="login-box">
      <h1>Login</h1>
      <form action="" method="POST">
        <div class="input-group">
          <label for="username">Username</label>
          <input type="text" id="username" name="username" required>
        </div>
        <div class="input-group">
          <label for="password">Password</label>
          <input type="password" id="password" name="password" required>
        </div>
        <button class="login" name="login" type="submit">Login</button>
      </form>
      <form action="singup.php" method="post">
        <button class="signup" type="submit">Signup</button>
      </form>
    </div>

  </div>
</body>
</html>
