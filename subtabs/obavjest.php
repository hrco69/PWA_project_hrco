

<?php 
  require_once "./phpfunkcije/db_funkcije.php";
  require_once "./phpfunkcije/generiraj_artikal.php"; 
  $articles = getArticlesFromDatabase(null, 1); 

?>

<!DOCTYPE html>
<html lang="hr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Obavijesti</title>
  <link rel="stylesheet" href="css/obavjest">
  <style>
  </style>
</head>
<body>
  <div class="news-container">
    <?php 
        foreach($articles as $article){
          returnArticle($article); 
        }
    ?>
  </div>
</body>
</html>
