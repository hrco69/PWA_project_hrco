<?php 
   require_once "./phpfunkcije/db_funkcije.php";
   session_start();
  
  $articleArr = getArticlesFromDatabase(null, null, $_GET["id"], false); 

  if(count($articleArr) < 1)
    die("Your article could not be reached!"); 

  $article = $articleArr[0]; 


  $date = strtotime($article["date"]); 

  $transformedDate = date("d.m.Y"); 
?> 

<!DOCTYPE html>
<html lang="hr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Read More / <?= $article["title"] ?></title>
  <link rel="stylesheet" href="css/readmore.css">
  <link rel="stylesheet" href="css/obavjest.css">
</head>
<body>

  <?php include './subtabs/navigacija.php'; ?>

  <div class="article-container">
    <h1 class="title"> <?= $article["title"] ?></h1>
    <div class="date"><?= $transformedDate ?></div>
    <div></div>
    <div class="image-container">
      <a href="javascript:history.back()">
        <img src="<?= $article["image-link"] ?>" alt="Article Image">
      </a>
    </div>
    <a href="./<?= strtolower($article["name"]) ?>.php" class="tag"><?= $article["name"] ?></a>
    <div class="content">
      <?= $article["content"]; ?>
    </div>
  </div>

  
       
  

</body>
</html>
