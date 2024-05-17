<?php
session_start();
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

        .playfare-font {
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
                    <h2 class=".playfare-font opacity-70">Welcome, <?php echo htmlspecialchars($admin_email); ?></h2>
                    <a href="admin_logout.php"><button
                        class="px-6 py-2 rounded-lg cursor-pointer font-bold bg-Primary_Light text-white hover:bg-Primary">Logout</button></a>
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