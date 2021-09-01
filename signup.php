
<?php
require_once('./includes/config.php');
include('head.php');
include("header.php");
?>
<script type="text/javascript">
    $('#closeModal').on('click', function() {
        $('#messagec').html('');
    })
</script>

<div class="container mx-auto mt-10 relative">
    <div class="flex justify-center px-6 my-12">
        <!-- Row -->
        <div class="w-full xl:w-3/4 lg:w-11/12 flex">
            <!-- Col -->
            <div
                    class="w-full h-auto bg-gray-400 hidden lg:block lg:w-5/12 bg-cover rounded-l-lg"
                    style="background-image: url('https://source.unsplash.com/Mv9hjnEUHR4/600x800')"
            ></div>
            <!-- Col -->
            <div class="w-full lg:w-7/12 bg-white p-5 rounded-lg lg:rounded-l-none shadow-lg ">
                <h3 class="pt-4 text-2xl text-center">Create an Account!</h3>
                <?php
                //handle signup
                if(isset($_POST['submit'])) {
                    $firstname = $_POST['firstname'];
                    $username = $_POST['username'];
                    $lastname = $_POST['lastname'];
                    $email = $_POST['email'];
                    $user= new User($db);
                    
                    $password = $user->create_hash(strval($_POST['password']));
                     
                    $confirm_password = $user->create_hash(strval($_POST['confirmPassword']));
                    if($password !== $confirm_password) {
                        echo '<div id="messagec" class="absolute top-0 left-16 bg-red-100 border border-red-300 w-96 text-red-700 flex items-center justify-between py-2 px-4 hover:bg-red-200 rounded-lg">
                        
                        <div class="">Password are not match</div>
                        <button id="closeModal" class="">&times;</button>
    </div>';
                        exit;
                        }
                    if($_FILES['fileToUpload']) {
                        $target_dir = "uploads/";
                    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
                    basename($_FILES["fileToUpload"]["name"]);
                    $uploadOk = 1;
                    $imageFileType = strtolower((pathinfo($target_file, PATHINFO_EXTENSION)));
                    $check = getimagesize($_FILES['fileToUpload']["tmp_name"]);
                    
                        if($check !== false) {
                            echo "File is an image - " . $check["mime"] . ".";
                            $uploadOk = 1;

                        } else {

                        }
                        // Allow certain file formats
                        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                            && $imageFileType != "gif" ) {
                            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                            $uploadOk = 0;
                        }
                        if ($uploadOk == 0) {
                            echo "Sorry, your file was not uploaded.";
                            exit;
                          // if everything is ok, try to upload file
                          } else {
                            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                              echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
                            } else {
                              echo "Sorry, there was an error uploading your file.";
                              exit;
                            }
                          }
                    }

                    
                          $sttm = $db->prepare('INSERT INTO images(img_path) VALUES (:imgPath)');
                          $sttm->execute(array(':imgPath' =>  $_FILES["fileToUpload"]["tmp_name"]? 'uploads/' . basename( $_FILES["fileToUpload"]["name"] ) : null));

                          $stmt2 = $db->prepare('INSERT INTO tech_blog_users (username, name, email, password , img_id) VALUES (:username, :name, :email, :password , :image_id)');
                          $stmt2->execute([':username' => $username, ':password'=> $password , ':name' => $firstname . $lastname, 'email'=> $email , 'image_id' => $db->lastInsertId()]);
                          header('Location: login.php');


                     

                }
                ?>
                <form class="form px-8 pt-6 pb-8 mb-4 bg-white rounded" method="POST" action="" enctype="multipart/form-data">
                    <div class="mb-4 md:flex md:justify-between">
                        <div class="mb-4 md:mr-2 md:mb-0">
                            <label class="block mb-2 text-sm font-bold text-gray-700" for="firstName">
                                First Name
                            </label>
                            <input
                                    class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                    id="firstName"
                                    type="text"
                                    name="firstname"
                                    placeholder="First Name"
                            />
                        </div>
                        <div class="md:ml-2">
                            <label class="block mb-2 text-sm font-bold text-gray-700" for="lastName">
                                Last Name
                            </label>
                            <input
                                    class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                    id="lastName"
                                    type="text"
                                    name="lastname"
                                    placeholder="Last Name"
                            />
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="username">
                            username
                        </label>
                        <input
                                class="w-full px-3 py-2 mb-3 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                id="username"
                                type="username"
                                name="username"
                                placeholder="Username"
                        />
                    </div>
                    <div class="mb-4">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="email">
                            Email
                        </label>
                        <input
                                class="w-full px-3 py-2 mb-3 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                id="email"
                                type="email"
                                name="email"
                                placeholder="Email"
                        />
                    </div>
                    <div class="mb-4 md:flex md:justify-between">
                        <div class="mb-4 md:mr-2 md:mb-0">
                            <label class="block mb-2 text-sm font-bold text-gray-700" for="password">
                                Password
                            </label>
                            <input
                                    class="w-full px-3 py-2 mb-3 text-sm leading-tight text-gray-700 border border-gray-200 rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                    id="password1"
                                    type="password"
                                    name="password"
                                    placeholder="Password"
                            />

                        </div>
                        <div class="md:ml-2">
                            <label class="block mb-2 text-sm font-bold text-gray-700" for="c_password">
                                Confirm Password
                            </label>
                            <input
                                    class="w-full px-3 py-2 mb-3 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                    id="password2"
                                    type="password"
                                    name="confirmPassword"
                                    placeholder="Password"

                            />
                            <p id="message"></p>
                        </div>

                    </div>
                    <div class="w-full">
                        <label class="w-full leading-tight text-gray-600 border rounded shadow  focus:outline-none focus:shadow-outline flex items-center px-4 py-6 bg-white text-blue rounded-lg shadow-sm tracking-wide uppercase border border-gray-200 cursor-pointer hover:text-gray-800 mb-6">
                            <svg class="w-8 h-8" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M16.88 9.1A4 4 0 0 1 16 17H5a5 5 0 0 1-1-9.9V7a3 3 0 0 1 4.52-2.59A4.98 4.98 0 0 1 17 8c0 .38-.04.74-.12 1.1zM11 11h3l-4-4-4 4h3v3h2v-3z" />
                            </svg>
                            <span class="mt-2 text-base leading-normal ml-6">Select Image</span>
                            <input type="file" id="img" name="fileToUpload" accept="image/*" class="hidden"/>
                        </label>

                    </div>
                    <div class="mb-6 text-center w-full flex justify-end">
                        <input
                                class="px-4 py-2 text-black bg-yellow-300 rounded-lg hover:bg-yellow-400 focus:outline-none focus:shadow-outline cursor-pointer"
                                type="submit"
                                name="submit"
                                value="Register"
                        />
                    </div>
                    <hr class="mb-6 border-t" />

                    <div class="text-center">
                        <a
                                class="inline-block text-sm text-yellow-500 align-baseline hover:text-yellow-600"
                                href="http://localhost/blogpost/login.php"
                        >
                            Already have an account? Login!
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>

</html>