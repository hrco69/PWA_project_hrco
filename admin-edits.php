<?php 
  require_once "./phpfunkcije/db_funkcije.php"; 

  $connection = openConnection(); 

  if(isset($_POST["addBtn"])){
    writeArticleToDatabase($connection); 
  }

?>

<!DOCTYPE html>
<html lang="hr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Page</title>
  <link rel="stylesheet" href="css/admin-edits.css">
</head>
<body>
  <?php require_once './subtabs/navigacija.php'; ?>

  <div class="admin-container">
    <h1 class="admin-title">Manage News Article</h1>
    <form action="#" method="POST" enctype="multipart/form-data">
      <div class="input-group">
        <label for="title">Title</label>
        <input type="text" id="title" name="title" required>
      </div>
      <div class="input-group">
        <label for="date">Date</label>
        <input type="date" id="date" name="date" required>
      </div>
      <div class="input-group">
        <label for="image">Image</label>
        <input type="file" id="image" name="image" accept="image/*" required>
      </div>
      <div class="input-group">
        <label for="category">Category</label>
        <select id="category" name="category" required>
          <?php 
            $categories = getCategories($connection);
            foreach($categories as $category){
              echo "<option value=\"$category[id]\">$category[name]</option>";
            }  
          ?>
        </select>
                        
      </div>
      <div class="input-group">
        <label for="content">Content</label>
        <textarea id="content" name="content" rows="10" required></textarea>
      </div>
      <div class="button-group">
        <button type="submit" class="add-button" name="addBtn">Add</button>
      </div>
    </form>
  </div>
</body>
</html>
<?php
  mysqli_close($connection); 
?>