<?php
require_once('../includes/config.php');
?>
<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <title>Add BLog</title>

    <link rel="stylesheet" href="./asssets/style.css">
</head>
<body>






<div class="edit-blog-post">
    <?php
    try {
        if(isset($_POST['submit'])) {

            $title = $_POST['title'];
            $date = $_POST['date'];
            $desc = $_POST['desc'];
            $content = $_POST['content'];
            $stmt = $db->prepare('INSERT INTO tech_blog (articleTitle,articleDate, articleDescrip, articleContent) VALUES (:title, :date , :desc, :content)') ;
            $result = $stmt->execute(array(
                ':title' => $title,
                ':date' => $date,
                ':desc' => $desc,
                ':content' => $content
            ));
            header('Location: add-blog-article.php?action=added');
            exit;




        }
    } catch(PDOException $e) {

        echo $e->getMessage();
    }



    ?>
    <form action="" method="POST" class="form">
        <p>Add blog post</p>
        <input type="text" placeholder="Title" name="title"/>
        <input placeholder="date" type="date" name="date">
        <input type="text" placeholder="description" name="desc"/>
        <input  type="text" placeholder="content" name="content"/>
        <input type="submit" name="submit" value="Create"/>
    </form>
</div>
<?php
include ('footer.php')

?>