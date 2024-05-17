<?php
session_start();

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
    <title>Admin Dashboard</title>

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
                        <?php echo htmlspecialchars($admin_email); ?></h2>
                    <a href="admin_logout.php"><button
                            class="px-6 py-2 rounded-lg cursor-pointer font-bold bg-Primary_Light text-white hover:bg-Primary">Logout</button></a>
                </div>
                <div class="bg-gray-100 min-h-[77svh]">

                    <h2 id="playfare" class="text-center py-5 inter-font text-3xl font-semibold">
                        Add Trees
                    </h2>
                    <form action="admin.php" method="POST" enctype="multipart/form-data"
                        class="max-w-2xl space-y-2 mx-auto grid grid-cols-2 p-5 rounded-xl  space-x-5 my-auto">




                        <div class="ml-5 mt-2">
                            <label for="name" class="block mb-1 text-sm font-medium text-gray-900">Tree name</label>
                            <input type="text" id="name" name="name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                placeholder="Tree name" required />
                        </div>

                        <div>
                            <label for="catagory" class="block mb-1 text-sm font-medium text-gray-900">catagory</label>
                            <input type="text" id="catagory" name="catagory"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                placeholder="Catagory" required />
                        </div>

                        <div>
                            <label for="price" class="block mb-1 text-sm font-medium text-gray-900">price</label>
                            <input type="text" id="price" name="price"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                placeholder="price" required />
                        </div>


                        <div>
                            <label for="section" class="block mb-1 text-sm font-medium text-gray-900">Section</label>
                            <input type="text" id="section" name="section"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                placeholder="section" required />
                        </div>


                        <div>
                            <label for="key" class="block mb-1 text-sm font-medium text-gray-900">Product
                                Id</label>
                            <input type="text" id="key" name="key"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                placeholder="key" required />
                        </div>


                        <div>
                            <label for="quantity" class="block mb-1 text-sm font-medium text-gray-900">Quantity</label>
                            <input type="number" id="quantity" name="quantity"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                placeholder="quantity" required />
                        </div>
                        <div class="col-span-2 pb-2">
                            <label for="image" class="block mb-1 text-sm font-medium text-gray-900">Add Image</label>
                            <input type="file" id="image" name="image" accept="image/*"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full py-2"
                                required />
                        </div>

                        <button type="submit" name="add_tree"
                            class="text-white col-span-2 bg-Primary_Light hover:bg-Primary focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-cente r">
                            Add
                        </button>
                    </form>
                    <div>
                    <?php
                    if (isset($_POST['add_tree'])) {
                        $name = $_POST['name'];
                        $category = $_POST['catagory']; // corrected variable name
                        $price = $_POST['price'];
                        $section = $_POST['section'];
                        $quantity = $_POST['quantity'];
                        $key = $_POST['key'];

                        // Check if file was uploaded without errors
                        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                            // Directory where you want to save the uploaded files
                            $target_dir = "uploads/";
                            // Create the directory if it doesn't exist
                            if (!file_exists($target_dir)) {
                                mkdir($target_dir, 0777, true);
                            }
                            $target_file = $target_dir . basename($_FILES['image']['name']);

                            // Move the uploaded file to the target directory
                            if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
                                // Save the image path in the database
                                $sql = "INSERT INTO trees (Tree_id, Tree_name, Tree_catagory, Tree_price, Tree_section, Tree_pic, Tree_key, Tree_quantity) 
                    VALUES (DEFAULT, '$name', '$category', '$price', '$section', '$target_file', '$key', '$quantity')";

                                if (mysqli_query($conn, $sql)) {
                                    echo "<h1 class='text-3xl text-Primary text-center mt-10'>New record inserted successfully</h1>";
                                } else {
                                    echo "Error: " . mysqli_error($conn);
                                }
                            } else {
                                echo "Error uploading file.";
                            }
                        } else {
                            echo "Error uploading file.";
                        }
                    }
                    mysqli_close($conn);
                    ?>
                </div>
                    <!-- <div class="addtrees">
                        <h3>Add Trees</h3>
                        <form action="admin.php" method="POST" enctype="multipart/form-data">
                            <input type="file" name="image" id="image">
                            <input type="text" name="name" id="name" placeholder="Tree Name">
                            <input type="text" name="catagory" id="catagory" placeholder="Tree catagory">
                            <input type="text" name="price" id="price" placeholder="Price">
                            <input type="text" name="section" id="section" placeholder="Section">
                            <input type="text" name="key" id="key" placeholder="key">

                            <input type="number" name="quantity" id="quantity" placeholder="Quantity">
                            <button type="submit" name="add_tree">Add</button>

                        </form>
                    </div> -->
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