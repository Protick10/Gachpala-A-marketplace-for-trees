<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>GachPala</title>

    <link rel="shortcut icon" href="images/Logo.svg" type="image/x-icon">

    <!-- 
        tailwind and daisyUI link
     -->
    <link
      href="https://cdn.jsdelivr.net/npm/daisyui@4.7.2/dist/full.min.css"
      rel="stylesheet"
      type="text/css"
    />
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
       <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">

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
      .playfare-font{
        font-family: "Playfair Display", serif;
      }
    </style>
</head>
<body>
<nav class="inter-font text-base font-semibold">
        <div
          class="flex items-center justify-between max-w-[1280px] px-8 mx-auto"
        >
          <ul class="flex space-x-8">
            <li><a href="">Home</a></li>
            <li><a href="shop.php">Shop</a></li>
            <li><a href="">About Us</a></li>
            <li><a href="">Contact Us</a></li>
          </ul>

          <div class="my-3">
            <img src="images/Logo.svg" alt="" />
          </div>

          <div class="flex space-x-3 items-center ml-12">
            <a href="">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                width="24"
                height="24"
                viewBox="0 0 24 24"
                fill="none"
              >
                <path
                  d="M21 21L16.65 16.65M19 11C19 15.4183 15.4183 19 11 19C6.58172 19 3 15.4183 3 11C3 6.58172 6.58172 3 11 3C15.4183 3 19 6.58172 19 11Z"
                  stroke="#121212"
                  stroke-width="2"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                />
              </svg>
            </a>
            <a href="cart.php" class="ml-1">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                width="24"
                height="24"
                viewBox="0 0 24 24"
                fill="none"
              >
                <path
                  d="M1 1H5L7.68 14.39C7.77144 14.8504 8.02191 15.264 8.38755 15.5583C8.75318 15.8526 9.2107 16.009 9.68 16H19.4C19.8693 16.009 20.3268 15.8526 20.6925 15.5583C21.0581 15.264 21.3086 14.8504 21.4 14.39L23 6H6M10 21C10 21.5523 9.55228 22 9 22C8.44772 22 8 21.5523 8 21C8 20.4477 8.44772 20 9 20C9.55228 20 10 20.4477 10 21ZM21 21C21 21.5523 20.5523 22 20 22C19.4477 22 19 21.5523 19 21C19 20.4477 19.4477 20 20 20C20.5523 20 21 20.4477 21 21Z"
                  stroke="#121212"
                  stroke-width="2"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                />
              </svg>
            </a>
            <?php if (isset($_SESSION['username'])): ?>
              <div class="flex items-center space-x-2">
                <img src="<?php echo $_SESSION['userpic']; ?>" alt="User Picture" class="w-10 h-10 rounded-full">
                <span><?php echo htmlspecialchars($_SESSION['username']); ?></span>
              </div>
              <a href="logout.php" class="py-3 px-5">Log Out</a>
            <?php else: ?>
              <!-- <button class="py-3 px-5">Log In</button>
              <button class="bg-Primary text-white py-3 px-5 rounded-lg">
                Sign Up
              </button> -->

              <a href="login.php" class="py-3 px-5">Log In</a>
              <a href="user_signup.html" class="bg-Primary text-white py-3 px-5 rounded-lg">
                Sign Up
              </a>
            <?php endif; ?>
          </div>
        </div>
      </nav>



      <hr class="border-gray-100">

        
      <?php
$host = "localhost";
$username = "root";
$password = "";
$dbname = "gachpala";

$con = new mysqli($host, $username, $password, $dbname);

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Fetch all featured trees
$sql = "SELECT * FROM trees WHERE Tree_section = 'Feature'";
$result = mysqli_query($con, $sql);

if ($result->num_rows > 0) {
    echo '<section class="featured">';
    echo '<h2 class="playfare-font">All Featured Plants</h2>';
    echo '<div class="featurecard">';
    while ($row = mysqli_fetch_assoc($result)) {
        $name = $row['Tree_name'];
        $pic = $row['Tree_pic'];

        // Display each tree dynamically
        echo '<div class="card">';
        echo '<img src="' . htmlspecialchars($pic) . '" alt="' . htmlspecialchars($name) . '"/>'; 
        echo '<div class="np">';
        echo '<h3 class="inter-font">' . $name . '</h3>';
        echo '<p>&#2547; 250</p>'; // Assuming price is fixed for featured trees
        echo '</div>';
        echo '<div class="atc">';
        echo '<button><img src="images/shopping-cart.svg" alt=""> Add to Cart</button>';
        echo '<div class="atcimg">';
        echo '<img src="images/heart.svg" alt="">';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
    echo '</div>';
    echo '</section>';
} else {
    echo "No Featured Trees Found.";
}

$con->close();
?>


    <!-- 
        footer section
     -->
     <footer>
      <div class="social">
        <img src="images/youtube.svg" alt="">
        <img src="images/facebook.svg" alt="">
        <img src="images/insta.svg" alt="">
        <img src="images/linkedin.svg" alt="">
        <img src="images/tiktok.svg" alt="">
      </div>

      <img src="images/logo2.svg" alt="">

      <div class="txtfoot">
        <p>© 2024 GachPala. All rights reserved</p>
      </div>
    </footer>
  </body>
</html>

      
</body>
</html>


