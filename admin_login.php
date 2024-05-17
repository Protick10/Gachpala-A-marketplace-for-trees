<?php
session_start();
$host = "localhost";
$username = "root";
$password = "";
$dbname = "gachpala";

$con = new mysqli($host, $username, $password, $dbname);
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $admin_email = $_POST['admin_email'];
    $admin_password = $_POST['admin_password'];

    $stmt = $con->prepare("SELECT admin_password FROM admin WHERE admin_email = ?");
    $stmt->bind_param("s", $admin_email);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($hashed_password);
        $stmt->fetch();
        if (password_verify($admin_password, $hashed_password)) {
            $_SESSION['admin_email'] = $admin_email;
            header("Location: admin_dashboard.php");
            exit();
        } else {
            $error = "Invalid password.";
        }
    } else {
        $error = "No admin found with that email.";
    }
    $stmt->close();
}
$con->close();
?>

<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <!-- 
        css connection
     -->
    <link rel="stylesheet" href="styles/landing-page.css" />

    <!-- 
tailwind and daisyUI link
-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- 
tailwind colors
-->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        Primary: "#006838",
                        Primary_Light: "#62A73B",
                        Primary_BG: "#E6F5DD",
                        Black: "#121212",
                    },
                },
            },
        };
    </script>

    <!-- 
  google font
 -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap"
        rel="stylesheet" />

    <!-- 
inner styles
-->
    <style>
        .inter-font {
            font-family: "Inter", sans-serif;
        }

        .playfare-font {
            font-family: "Playfair Display", serif;
        }
    </style>
</head>

<body>





    <!-- 
            navbar
        -->
    <nav class="inter-font text-base font-semibold shadow-sm">
        <div class="flex items-center justify-between max-w-[1280px] px-8 mx-auto">
            <ul class="flex space-x-8">
                <li><a href="index.php">Home</a></li>
                <li><a href="shop.php">Shop</a></li>
                <li><a href="">About Us</a></li>
                <li><a href="">Contact Us</a></li>
            </ul>

            <div class="my-3 mr-44">
                <img src="images/Logo.svg" alt="" />
            </div>

            <div class="flex space-x-3 items-center ml-12">
                <a href="">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path
                            d="M21 21L16.65 16.65M19 11C19 15.4183 15.4183 19 11 19C6.58172 19 3 15.4183 3 11C3 6.58172 6.58172 3 11 3C15.4183 3 19 6.58172 19 11Z"
                            stroke="#121212" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </a>
                <a href="" class="ml-1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path
                            d="M1 1H5L7.68 14.39C7.77144 14.8504 8.02191 15.264 8.38755 15.5583C8.75318 15.8526 9.2107 16.009 9.68 16H19.4C19.8693 16.009 20.3268 15.8526 20.6925 15.5583C21.0581 15.264 21.3086 14.8504 21.4 14.39L23 6H6M10 21C10 21.5523 9.55228 22 9 22C8.44772 22 8 21.5523 8 21C8 20.4477 8.44772 20 9 20C9.55228 20 10 20.4477 10 21ZM21 21C21 21.5523 20.5523 22 20 22C19.4477 22 19 21.5523 19 21C19 20.4477 19.4477 20 20 20C20.5523 20 21 20.4477 21 21Z"
                            stroke="#121212" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </a>
            </div>
        </div>
    </nav>



    <hr class="border-gray-300">








    <!-- form  -->
    <div class="py-28 pb-60 bg-gray-100">
        <div class="max-w-7xl mx-auto">
            <h2 class="text-center text-Primary pb-7 inter-font text-3xl font-bold">
                Admin Login
            </h2>
            <?php if (isset($error)) {
        echo "<p style='color:red;'>$error</p>";
    } ?>
            <form method="post" action="admin_login.php"
                class="max-w-96 space-y-6 mx-auto bg-gray-100 flex flex-col  p-5 rounded-xl shadow-2xl">


                <div>
                    <label for="admin_email" class="block mb-1 text-sm font-medium text-gray-900">Email</label>
                    <input type="email" id="admin_email" name="admin_email"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        placeholder="Email" required />
                </div>
                <div>
                    <label for="admin_password" class="block mb-1 text-sm font-medium text-gray-900">Password</label>
                    <input type="password" id="admin_password" name="admin_password"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        placeholder="password" required />
                </div>

                <button type="submit"
                    class="text-white bg-Primary_Light hover:bg-Primary focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-cente r">
                    Login
                </button>
                <div class="text-center">
                    <label>
                        Dont have an account?
                        <a href="/Gachpala-A-marketplace-for-trees/user_signup.html"
                            class="text-blue-600 hover:text-blue-800 hover:font-medium">Register</a>
                    </label>


                </div>
                <label class="text-center">
                    Are you just a user?
                    <a href="/Gachpala-A-marketplace-for-trees/login.php"
                        class="text-blue-600 hover:text-blue-800 hover:font-medium">Log In</a>
                </label>
            </form>
        </div>

    </div>
    <!-- 
        footer section
     -->
    <footer>
        <div class="social">
            <img src="images/youtube.svg" alt="" />
            <img src="images/facebook.svg" alt="" />
            <img src="images/insta.svg" alt="" />
            <img src="images/linkedin.svg" alt="" />
            <img src="images/tiktok.svg" alt="" />
        </div>

        <img src="images/logo2.svg" alt="" />

        <div class="txtfoot">
            <p>© 2024 GachPala. All rights reserved</p>
        </div>
    </footer>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>








    <!-- <h2>Admin Login</h2>
    <?php if (isset($error)) {
        echo "<p style='color:red;'>$error</p>";
    } ?>
    <form method="post" action="admin_login.php">
        <label for="admin_email">Email:</label>
        <input type="email" id="admin_email" name="admin_email" required>
        <br>
        <label for="admin_password">Password:</label>
        <input type="password" id="admin_password" name="admin_password" required>
        <br>
        <button type="submit">Login</button>
    </form> -->
</body>

</html>