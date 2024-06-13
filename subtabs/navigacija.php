<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>navigacija</title>
  <link rel="stylesheet" href="css/navstyle.css">
  <style>
    
  </style>
</head>
<body>
  <div class="banner">
    <h1>Newsweek</h1>
    <div class="current-date">
      <?php
      include './phpfunkcije/funkcije.php';
      echo getCurrentDate();
      ?>
    </div>
    <div class="username">
      <?php
        if(isset($_SESSION["isAdmin"]) and $_SESSION["isAdmin"]){
          echo "Welcome, " . $_SESSION["username"];
        }
        else{
          echo "Welcome, Guest";
        }
      ?>
    </div>

  </div>
  <div class="navigation">
    <ul>
      <li><a href="index.php">Home</a></li>
      <li><a href="us.php">US</a></li>
      <li><a href="world.php">World</a></li>
      <?php if(!isset($_SESSION["username"])):  ?>
        <li class="adminlogin"><a href="login.php">Login</a></li>
      <?php else: ?>
      <li class="logout"><a href="login.php?logout=true">logout</a></li>
      <?php endif; ?>
    </ul>
  </div>
</body>
</html>