<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['User_email'])) {
    header("Location: login.php");
    exit();
}

$user_email = $_SESSION['User_email'];

// Connect to the database
$host = "localhost";
$username = "root";
$password = "";
$dbname = "gachpala";
$con = new mysqli($host, $username, $password, $dbname);
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}


$stmt = $con->prepare("SELECT trees.Tree_name, trees.Tree_price, cart.Quantity FROM cart JOIN trees ON cart.Tree_key = trees.Tree_key WHERE cart.User_email = ?");
$stmt->bind_param("s", $user_email);
$stmt->execute();
$result = $stmt->get_result();


$stmt->close();
$con->close();
?>

<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>

    <!-- 
        tailwind and daisyUI link
     -->
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.7.2/dist/full.min.css" rel="stylesheet" type="text/css" />
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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap"
        rel="stylesheet">

    <!-- 
        css connection
     -->
    <link rel="stylesheet" href="styles/landing-page.css" />

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

    <!-- Cart items -->
    <h2 class="text-3xl py-10 font-medium text-center .playfare-font">Your Cart</h2>
    <?php if ($result->num_rows > 0) { ?>



<div class="max-w-7xl mx-auto">
            <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 ">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Product name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Price
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Quantity
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()) { ?>
                        <tr class="bg-white border-b">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                <?php echo $row['Tree_name']; ?>
                            </th>
                            <td class="px-6 py-4">
                                <?php echo $row['Tree_price']; ?>
                            </td>
                            <td class="px-6 py-4">
                                <?php echo $row['Quantity']; ?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

</div>

    <?php } else { ?>
        <p>Your cart is empty.</p>
    <?php } ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>

</html>