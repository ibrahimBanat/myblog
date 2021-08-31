


<?php
//connection File
include('includes/config.php'); ?>

<?php
//include head file for language preference
include("head.php");  ?>
<title>Techno Smarter Blog</title>

<?php
//header content //navbar
include("header.php");  ?>

<body class="">
    <div class="content w-full">

<?php
try {
    //selecting data by id
    $stmt = $db->query('SELECT articleId, articleTitle,articleDescrip, articleDate FROM tech_blog ORDER BY articleId DESC');
?>
<div class="container ">
    <?php  while($row = $stmt->fetchObject()){ ?>
        <div class="max-w-4xl px-10 my-4 py-6 bg-white rounded-lg shadow-md">
            <div class="flex justify-between items-center">
                <span class="font-light text-gray-600"><?= $row->articleDate ?></span>
                <a class="px-2 py-1 bg-green-200 text-green-600  font-bold rounded-lg hover:bg-green-300" href="#">Category</a>
            </div>
            <div class="mt-2">
                <a class="text-2xl text-gray-700 font-bold hover:text-gray-600" href="#"><?= !empty($row->articleTitle) ? $row->articleTitle : '' ?></a>
                <p class="mt-2 text-gray-600"><?= $row->articleDescrip ?></p>
            </div>
            <div class="flex justify-between items-center mt-4">
                <a class="text-green-600 hover:underline" href="show.php?id=<?= $row->articleId ?>">Read more</a>
                <div>
                    <a class="flex items-center" href="#">
                        <img class="mx-4 w-10 h-10 object-cover rounded-full hidden sm:block" src="https://images.unsplash.com/photo-1502980426475-b83966705988?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=373&q=80" alt="avatar">
                        <h1 class="text-gray-700 font-bold">Ibrahim Banat</h1>
                    </a>
                </div>
            </div>
        </div>

        <!--echo '<div>';
        echo '<h1><a href="show.php?id='.$row['articleId'].'">'.$row['articleTitle'].'</a></h1>';
        echo '<hr>';
        //Display the date
        echo '<p>Posted on '.date('jS M Y', strtotime($row['articleDate'])).'</p>';


        echo '<p>'.$row['articleDesc'].'</p>';
        echo '<p><button class="readbtn"><a href="show.php?id='.$row['articleId'].'">Read More</a></button></p>';
        echo '</div>';-->

    <?php }

    } catch(PDOException $e) {
        echo $e->getMessage();
    }
    ?>
</div>
    </div>
</body>