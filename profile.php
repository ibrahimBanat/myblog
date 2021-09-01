<?php
require_once('./includes/config.php');

include('header.php');
if(!($user->is_logged_in())) {
    header('Location: login.php');
}
$username = $_SESSION['username'];
$stmt = $db->prepare('SELECT * FROM tech_blog_users WHERE username= :username');
$stmt->execute([':username' => $username]);

$row = $stmt->fetchObject();
?>
<div>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>


            <div class="flex-1 flex flex-col overflow-hidden">
                <header class="flex justify-between items-center p-6">
                    <div class="flex items-center space-x-4 lg:space-x-0 gap-20">


                        <div>
                            <h1 class="text-2xl font-medium text-gray-800 dark:text-white">Overview</h1>
                        </div>
                        <div class="text-sm font-medium text-gray-800 dark:text-white">
                            <button class="bg-yellow-200 px-2 py-1 rounded-lg text-yellow-500 hover:bg-yellow-300"><a class="" href="add-blog-article.php">Add Article <span class=" ml-2 text-xl">+</span></a></button>
                        </div>
                    </div>

                    <div class="flex items-center space-x-4">





                        <div x-data="{ dropdownOpen: false }" class="relative">
                            <button @click="dropdownOpen = ! dropdownOpen"
                                    class="flex items-center space-x-2 relative focus:outline-none">
                                <h2 class="text-gray-700 dark:text-gray-300 text-sm hidden sm:block"><?= $row->name?></h2>
                                <img class="h-9 w-9 rounded-full border-2 border-yellow-300 object-cover"
                                     src="<?php
                                     $stmt = $db->prepare('SELECT img_path FROM images WHERE img_id = :img_id');
                                     $stmt->execute([':img_id' => $row->img_id]);
                                     $img_row = $stmt->fetchObject();
                                     if($img_row->img_path !== null) {
                                         echo $img_row->img_path;
                                     }else {
                                         echo './uploads/default.jpg';
                                     }
                                     ?>"
                                     alt="Your avatar">
                            </button>



                        </div>
                    </div>
                </header>

                <main class="flex-1 overflow-x-hidden overflow-y-auto">
                    <div class="container mx-auto px-6 py-8">
                        <div
                            class="grid place-items-center h-96 text-gray-500 dark:text-gray-300 text-xl border-4 border-gray-300 border-dashed">
                            Content
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>
</div>

