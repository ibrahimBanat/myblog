<?php
require_once('./includes/config.php');
include('header.php')
?>
<!DOCTYPE html>
    <meta charset="utf-8">
    <title>Add BLog</title>

    <link rel="stylesheet" href="admin/asssets/style.css">







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
<input type="file" id="img" name="fileToUpload" accept="image/*" class="hidden"/>

<div class="w-full">
    <div class="flex justify-center px-6 my-12 w-full">
        <!-- Row -->
        <div class="w-full">
            <!-- Col -->

            <!-- Col -->
            <div class="w-full  bg-white p-5 rounded-lg lg:rounded-l-none shadow-lg">
                <h3 class="pt-4 text-2xl text-center">Create Article</h3>
                <form class="px-8 pt-6 pb-8 mb-4 bg-white rounded">
                    <div class="mb-4 md:flex md:justify-between">
                        <div class="mb-4 md:mr-2 md:mb-0">
                            <label class="block mb-2 text-sm font-bold text-gray-700" for="firstName">
                                Article Title
                            </label>
                            <input
                                    class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                    id="firstName"
                                    type="text"
                                    placeholder="First Name"
                            />
                        </div>
                        <div class="md:ml-2">
                            <label class="block mb-2 text-sm font-bold text-gray-700" for="lastName">
                                Article Date
                            </label>
                            <input
                                    class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                    id="lastName"
                                    type="text"
                                    placeholder="Last Name"
                            />
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="email">
                            Email
                        </label>
                        <input
                                class="w-full px-3 py-2 mb-3 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                id="email"
                                type="email"
                                placeholder="Email"
                        />
                    </div>
                    <div class="mb-4 md:flex md:justify-between">
                        <div class="mb-4 md:mr-2 md:mb-0">
                            <label class="block mb-2 text-sm font-bold text-gray-700" for="password">
                                Password
                            </label>
                            <input
                                    class="w-full px-3 py-2 mb-3 text-sm leading-tight text-gray-700 border border-red-500 rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                    id="password"
                                    type="password"
                                    placeholder="******************"
                            />
                            <p class="text-xs italic text-red-500">Please choose a password.</p>
                        </div>
                        <div class="md:ml-2">
                            <label class="block mb-2 text-sm font-bold text-gray-700" for="c_password">
                                Confirm Password
                            </label>
                            <input
                                    class="w-full px-3 py-2 mb-3 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                    id="c_password"
                                    type="password"
                                    placeholder="******************"
                            />
                        </div>
                    </div>
                    <div class="mb-6 text-center">
                        <button
                                class="w-full px-4 py-2 font-bold text-white bg-blue-500 rounded-full hover:bg-blue-700 focus:outline-none focus:shadow-outline"
                                type="button"
                        >
                            Register Account
                        </button>
                    </div>
                    <hr class="mb-6 border-t" />
                    <div class="text-center">
                        <a
                                class="inline-block text-sm text-blue-500 align-baseline hover:text-blue-800"
                                href="#"
                        >
                            Forgot Password?
                        </a>
                    </div>
                    <div class="text-center">
                        <a
                                class="inline-block text-sm text-blue-500 align-baseline hover:text-blue-800"
                                href="./index.html"
                        >
                            Already have an account? Login!
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>