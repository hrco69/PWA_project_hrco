<?php 
    function openConnection(){
      $connection = mysqli_connect("localhost:4306", "root", "", "pwa_hrco"); 
      if($connection == FALSE){
        throw new Exception("Konekcija se nije mogla uspostaviti!");
      }
      return $connection; 
    }

    function openOnNull($connection = null){
        return $connection != null ? $connection : openConnection(); 
    }

    function writeArticleToDatabase($connection = null){
        $innerClose = $connection == null;
        $connection = openOnNull($connection);
        
        $title = $_POST['title'];
        $date = $_POST['date'];
        $image = $_FILES['image']['name'];
        $category = $_POST['category'];
        $content = $_POST['content'];

        $targetDir = "./slike/";
        $targetFile = $targetDir . basename($image);

        $splitName = preg_split("/\.(?!\.)/", basename($image));  
        if(count($splitName) < 2 or !str_contains("jpeg jpg png gif tif webp", $splitName[1])){
            mysqli_close($connection);
            die("You have no rights uploading other than images!"); 
        }

        move_uploaded_file($_FILES['image']['tmp_name'], $targetFile);

        $sqlPrepared = "INSERT INTO news (title, `date`, `image-link`, idcategory, content) VALUES (?, ?, ?, ?, ?)";  
        $query = $connection->prepare($sqlPrepared); 
        $query->bind_param("sssss", $title, $date, $targetFile, $category, $content);
        $result = $query->execute();
        
        if($innerClose){
            mysqli_close($connection);
        }

        return $result; 
    }

    function getCategories($connection = null){
        $innerClose = $connection == null;  
        $connection = openOnNull($connection);

        $query = "SELECT * FROM category";

        $result = mysqli_query($connection, $query); 

        $return_arr = []; 

        while($category = mysqli_fetch_assoc($result)){
            array_push($return_arr, $category);
        }

        mysqli_free_result($result); 

        if($innerClose)
            mysqli_close($connection);

        return $return_arr; 
    }

    function getArticlesFromDatabase($connection = null, $categoryFilter = null, $idArticleFilter = null, $limit = false){
        $innerClose = $connection == null;  
        $connection = openOnNull($connection);

        $sql = "SELECT news.*, category.name FROM news INNER JOIN category ON category.id = news.idcategory";

        if($categoryFilter != null)
            $sql .= " WHERE category.name LIKE '$categoryFilter'";

        if($idArticleFilter != null){
            if($categoryFilter == null)
                $sql .= " WHERE"; 
            else $sql .= " AND"; 

            $sql .= " news.id = $idArticleFilter"; 
        }

        if($limit){
            if($categoryFilter == null && $idArticleFilter == null){
                $sql .= " WHERE"; 
            }
            $sql .= "ORDER BY news.date DESC LIMIT 3"; 
        }

        $result = mysqli_query($connection, $sql);

        $article_arr = []; 

        while($small = mysqli_fetch_assoc($result)){
            array_push($article_arr, $small); 
        }

        mysqli_free_result($result);

        if($innerClose)
            mysqli_close($connection);

        return $article_arr;
    }

    function deleteArticleFromDatabase($id, $connection = null){

        $innerClose = $connection == null;
        $connection = openOnNull($connection);

        $sql = "DELETE FROM news WHERE id = $id";
        $result = mysqli_query($connection, $sql); 
        
        if($innerClose)
            mysqli_close($connection);

        return $result; 
    }

    // password rank username
    function writeAccountToDatabase($connection = null){
        $innerClose = $connection == null;
        $connection = openOnNull($connection);
        $result = null;

        $username = $_POST["username"]; 
        $password = password_hash($_POST["password"], CRYPT_BLOWFISH); 

        $query = $connection->prepare("INSERT INTO users (username, `password`, rank) VALUES (?, ?, 2)"); 

        $query->bind_param("ss", $username, $password);
        $result = $query->execute();

        if($innerClose)
        mysqli_close($connection);

        return $result;
    }

    function returnAccountFromDatabase($connection = null, $username){
        $innerClose = $connection == null;
        $connection = openOnNull($connection);
        $result = null;

        $username = $_POST["username"]; 
        $password = password_hash($_POST["password"], CRYPT_BLOWFISH); 

        $query = $connection->prepare("SELECT * FROM users WHERE username LIKE ?"); 

        $query->bind_param("s", $username);
        $query->execute();
        $resultset = $query->get_result(); 

        $returnUser = $resultset->fetch_assoc(); 
        mysqli_free_result($resultset);

        if($innerClose)
        mysqli_close($connection);

        return $returnUser;
    }

?>