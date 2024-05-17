<?php

// Check if the user is logged in
session_start();

// Redirect to admin login page if not logged in
if (!isset($_SESSION['admin_email'])) {
    header("Location: admin_login.php");
    exit();
}

?>


<?php

// Redirect to admin login page if not logged in
if (!isset($_SESSION['admin_email'])) {
    header("Location: admin_login.php");
    exit();
}


$host = "localhost";
$username = "root";
$password = "";
$dbname = "gachpala";

$conn = mysqli_connect($host, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


?>


<?php
if (!isset($_SESSION['admin_email'])) {
    header("Location: admin_login.php");
    exit();
}

$admin_email = $_SESSION['admin_email'];
?>




<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Tree Details</title>
    <link rel="stylesheet" href="styles/admin_update.css">
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

        #playfare {
            font-family: "Playfair Display", serif;
        }
    </style>
</head>

<body>
    <?php
    // Connect to the database
    $host = "localhost";
    $username = "root";
    $password = "";
    $dbname = "gachpala";
    $con = new mysqli($host, $username, $password, $dbname);
    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }

    // Get the tree_key from the query parameter
    $treekey = $_GET['key'];

    // Fetch tree details from the database
    $sql = "SELECT * FROM trees WHERE Tree_key='$treekey'";
    $result = mysqli_query($con, $sql);

    if ($result->num_rows > 0) {
        $row = mysqli_fetch_assoc($result);
        $name = $row['Tree_name'];
        $price = $row['Tree_price'];
        $section = $row['Tree_section'];
        $category = $row['Tree_catagory'];
    } else {
        echo "No tree found with the specified key.";
        exit;
    }

    // Close the connection
    $con->close();
    ?>





    <main class="max-w-7xl mx-auto">
        <div class="grid grid-cols-12 ">
            <div class="col-span-2 bg-[#FAFAFA] pt-5 min-h-[86svh] p-5">
                <div class="flex flex-col items-center mb-8">
                    <img src="images/logo.svg" alt="">
                </div>

                <ul class="font-bold space-y-2">
                    <a href="admin.php">
                        <li class="px-6 py-2 rounded-lg cursor-pointer hover:text-white hover:bg-Primary">ADD TRESS</li>
                    </a>
                    <a href="/Gachpala-A-marketplace-for-trees/admin_update.php">
                        <li class="px-6 py-2 rounded-lg cursor-pointer hover:text-white hover:bg-Primary">UPDATE</li>
                    </a>

                    <a href="admin_update.php">
                        <li class="px-6 py-2 rounded-lg cursor-pointer hover:text-white hover:bg-Primary">DELETE</li>
                    </a>

                </ul>
            </div>
            <div class="col-span-10 mt-5">
                <div class="flex gap-5 border-b pb-5 justify-end items-center">
                    <h2 id="playfare" class="playfare-font opacity-70">Welcome,
                        <?php echo htmlspecialchars($admin_email); ?>
                    </h2>
                    <a href="admin_logout.php"><button
                            class="px-6 py-2 rounded-lg cursor-pointer font-bold bg-Primary_Light text-white hover:bg-Primary">Logout</button></a>
                </div>
                <div class="bg-gray-100 min-h-[77svh]">

                    <h2 id="playfare" class="text-center py-5 inter-font text-3xl font-semibold">
                        Update Tree Details
                    </h2>
                    <form action="save_tree_details.php" method="post"
                        class="max-w-2xl space-y-2 mx-auto grid grid-cols-2 p-5 rounded-xl  space-x-5 my-auto">


                        <input type="hidden" name="treekey" value="<?php echo htmlspecialchars($treekey); ?>">

                        <div class="ml-5 mt-2">
                            <label for="name" class="block mb-1 text-sm font-medium text-gray-900">Tree name</label>
                            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($treekey); ?>"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                placeholder="Tree name" required />
                        </div>

                        <div>
                            <label for="category" class="block mb-1 text-sm font-medium text-gray-900">category</label>
                            <input type="text" id="category" name="category"
                                value="<?php echo htmlspecialchars($category); ?>"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                placeholder="category" required />
                        </div>

                        <div>
                            <label for="price" class="block mb-1 text-sm font-medium text-gray-900">price</label>
                            <input type="number" id="price" name="price" value="<?php echo htmlspecialchars($price); ?>"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                placeholder="price" required />
                        </div>


                        <div>
                            <label for="section" class="block mb-1 text-sm font-medium text-gray-900">Section</label>
                            <input type="text" id="section" name="section"
                                value="<?php echo htmlspecialchars($section); ?>"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                placeholder="section" required />
                        </div>

                        <button type="submit"
                            class="text-white col-span-2 bg-Primary_Light hover:bg-Primary focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-cente r">
                            Update
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </main>
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
</body>

</html>