<!DOCTYPE html>
<body>
<?php
require_once('./includes/config.php');

include("header.php");
?>

<div class="container mx-auto mt-20">

    <div class="flex justify-center px-6 my-12">
        <!-- row -->
        <div class="w-full flex xl:w-3/4 lg:w-11/12 shadow-lg rounded-lg " style="min-height: 350px">
            <!-- col -->
            <div class="w-full h-auto bg-gray-400 hidden lg:block lg:w-5/12 bg-cover rounded-l-lg" style="background-image: url('./assets/images/loginhero.jpg')"></div>
            <!-- col -->
            <div class="w-full lg:w-7/12 bg-white p-5 rounded-lg lg:rounded-l-none">
                <h3 class="pt-4 text-2xl text-center">Login to your account!</h3>
                <?php
                //Login form for submit
                if(isset($_POST['submit'])){

                    $username = trim($_POST['username']);
                    $password = trim($_POST['password']);

                    if($user->login($username,$password)){

                        //If looged in , the redirects to index page
                        $_SESSION['username'] = $username;

                        $stmt = $db->prepare('SELECT * FROM tech_blog_users WHERE username = :username');
                        $stmt->execute([':username' => $username]);
                        $row = $stmt->fetchObject();

                        if($row->role == 'admin') {
                            header('Location: admin.php');

                        }else {
                            header('Location: profile.php');

                        }

                        exit;


                    } else {
                        $message = '<p class="invalid">Invalid username or Password</p>';
                    }

                }

                if(isset($message)){ echo $message; }
                ?>
                <form class="form login-form px-8 pt-6 pb-8 mb-4 bg-white rounded" action="" method="POST">
                    <div class="mb-4 md:flex md:justify-between">
                        <div class="mb-4 md:mr-2 md:mb-0">
                            <label class="block mb-2 text-sm font-bold text-gray-700" for="firstName">
                                Username
                            </label>
                            <input
                                    class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                    id="firstName"
                                    type="text"
                                    name="username"
                                    placeholder="Username"
                                    required
                            />
                        </div>
                        <div class="md:ml-2">
                            <label class="block mb-2 text-sm font-bold text-gray-700" for="lastName">
                                Password
                            </label>
                            <input
                                    class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                    id="lastName"
                                    name="password"
                                    type="password"
                                    placeholder="Password"
                                    required
                            />
                        </div>
                    </div>
                    <div class="flex w-full justify-end">
                        <input
                                class=" px-4 py-2 font-bold text-white bg-green-500 rounded-lg cursor-pointer hover:bg-green-600 focus:outline-none focus:shadow-outline self-end"
                                type="submit"
                                value="Login"
                                name="submit"
                        />


                    </div>

                </form>
            </div>

        </div>

    </div>

</div>
</body>

</html>