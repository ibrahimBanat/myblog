<?php

require_once('../includes/config.php');


//check whether if the user logged in or not

if(!$user->is_logged_in()){header('Location: login.php');};

if(isset($__GET['delpost'])){
    $stmt = $db->prepare('DELETE FROM tech_blog WHERE articleId = :articleId');
    $stmt->execute(array('articleId' => $__GET['delpost']));
    header('Location: index.php?action=deleted');
    exit;
}

?>

<?php

include('head.php');
?>
<title>Admin Page</title>
<script language="JavaScript" type="text/javascript">
    function delpost (id, title) {
        if (confirm("Are you want to delete '" + title + "'")){
            window.location.href = 'index.php?delpost=' + id;
        }

    }
</script>

<?php
include("header.php");
?>

<div class="content">
    <?php
    //showing message from add /edit page
    if(isset($__GET['action'])) {
        echo '<h3>Post '.$__GET['action'].'.</h3>';
    }
    ?>
    <table>
        <tr>
            <th>Article Title</th>
            <th>Posted Date</th>
            <th>Update</th>
            <th>Delete</th>
        </tr>
        <?php
        try {
            $stmt = $db->query('SELECT articleId, articleTitle, articleDate FROM tech_blog ORDERBY articleId DESC');
            while ($row = $stmt->fetch()) { ?>
                <tr>
                    <td><?=$row['articleId'];?></td>
                    <td><?= date('jS M Y', strtotime($row['articleDate']));?></td>
                    <td><button class="editbtn"><a href="edit-blog-article.php?id=<?= $row['articleId'];?>">Edit</a></button></td>
                    <td><button class="delbtn"><a href="javascript:delpost('<?= $row['articleId'];?>')">Delete</a></button></td>
                </tr>
           <?php }
        } catch(PDOException $e) {
            echo $e->getMessage();
        }

        ?>
    </table>
    <p ><button class="editbtn"><a href="add-blog-article.php">Add Article</a></button></p>
</div>

<?php
include('footer.php')
?>