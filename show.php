<?php
require_once('./includes/config.php');
?>

<?php


include('head.php');
$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
//echo $actual_link;
$parts = parse_url($actual_link);
parse_str($parts['query'], $query);


$stmt = $db->prepare('SELECT articleId,articleTitle,articleDate, articleDescrip, articleContent FROM tech_blog WHERE articleId = :articleId');
$stmt->execute([':articleId' => $query['id']]);
$row = $stmt->fetch();

?>
<title><?= $row['articleTitle']; ?> Detials</title>
<?php
include("header.php");
?>

<div class="blog">
    <h1>
        <?= $row['articleTitle']?>
    </h1>
    <br>
    <p><?= $row['articleDate']?></p>
    <br>
    <br>
    <p><?= $row['articleContent']?></p>

</div>


</body>

