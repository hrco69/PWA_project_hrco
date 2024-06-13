<?php 
      require_once "./phpfunkcije/db_funkcije.php";
      require_once "./phpfunkcije/generiraj_artikal.php"; 
      session_start();
      $articlesUS = getArticlesFromDatabase(null, "US", null, true);
      $articleWorld = getArticlesFromDatabase(null, "world", null, true); 

?>

<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Newsweek</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/obavjest.css">

</head>
<body>

    <div>
        <?php include './subtabs/navigacija.php'; ?>
    </div>
    <div class="red-text">U.S.</div>


            
        <div class="news-container">
            <?php 
                foreach($articlesUS as $article){
                    echo returnArticle($article); 
                }
            ?>
        </div>
        
        <hr class="dotted-line">
        <div class="red-text">World</div>

        <div class="news-container">
                <?php 
                    foreach($articleWorld as $article){
                        echo returnArticle($article); 
                    }
                ?>
        </div>

  

</body>
</html>
