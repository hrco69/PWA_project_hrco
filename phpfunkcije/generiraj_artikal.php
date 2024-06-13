<?php 

  if(isset($_POST["deleteBtn"])){
    deleteArticleFromDatabase($_POST["deleteBtn"]); 
    header("Location:  http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"); 
    exit(); 
  }

  function returnArticle($articlePart){
    ob_start(); 
  ?>
    <div class="news">
      <div class="image-container">
        <a href="ReadMore.php?id=<?= $articlePart["id"] ?>">
          <img src="<?= $articlePart["image-link"] ?>" alt="News Image">
        </a>
      </div>
      <h2><?= $articlePart["title"] ?></h2>
      <?php if(isset($_SESSION["isAdmin"]) and $_SESSION["isAdmin"]): ?>
        <form action="#" method="POST">
                <button class="deletebtn" name="deleteBtn" value="<?= $articlePart["id"] ?>">Delete</button>
        </form>
      <?php endif; ?>
    </div>
  <?php
    $returnDiv = ob_get_clean(); 
    return $returnDiv; 
  }
?>

