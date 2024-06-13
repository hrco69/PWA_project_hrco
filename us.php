<?php 
      require_once "./phpfunkcije/db_funkcije.php";
      require_once "./phpfunkcije/generiraj_artikal.php"; 
      $articlesUS = getArticlesFromDatabase(null, "us", null, false);
      session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Us news</title>
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/obavjest.css">

</head>
<body>
  <?php include './subtabs/navigacija.php'; ?>
  <div class="top-bar">
  <div class="red-text">U.S.</div>
  <a href="admin-edits.php" class="green-button">Add News</a>
  </div>
  <hr class="dotted-line">
  <div class="news-container">
        <?php 
            foreach($articlesUS as $article){
                echo returnArticle($article); 
            }
        ?>
  </div>

  <!-- potrebno dodati da se vijesti automatski prosiriju prema dole i ucitavaju kad se skrola  -->

</body>
</html>