<?php


$host = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "gachpala"; 


$con = new mysqli($host, $username, $password, $dbname);

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}


$sql = "SELECT * FROM trees"; 

// $name = "SELECT Tree_name FROM trees WHERE id = 001";

// echo '<p>' .$name .'</p>';

$result = mysqli_query($con, $sql);

if ($result->num_rows > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        // $tem = $row;
        // $json = json_encode($tem);

        $name = $row['Tree_name'];
        $id = $row['Tree_id'];
        $pic = $row['Tree_pic'];
    }
} else {
    echo "No Results Found.";
}

// $pic = imagescale($pic, 100, 100);
// echo '<p>' .$name .'</p>';
// echo '<p>' .$id .'</p>';
// echo '<img src="data:image/jpeg;base64,'.base64_encode($pic).'"/>';
// echo $json;

// $source = imagecreatefromstring($pic);

// // Get the original dimensions of the image
// $sourceWidth = imagesx($source);
// $sourceHeight = imagesy($source);

// // Define the desired width and height for the resized image
// $targetWidth = 279; // Desired width
// $targetHeight = 360; // Desired height

// // Create a blank target image with the desired dimensions
// $target = imagecreatetruecolor($targetWidth, $targetHeight);

// // Resize the source image to fit the target dimensions
// imagecopyresampled($target, $source, 0, 0, 0, 0, $targetWidth, $targetHeight, $sourceWidth, $sourceHeight);

// // Output the resized image directly (assuming JPEG format)
// header('Content-Type: image/jpeg');
// imagejpeg($target);

// // Clean up memory
// imagedestroy($source);
// imagedestroy($target);







// $host = "localhost";
// $username = "root";
// $password = "";
// $dbname = "gachpala";

// $con = new mysqli($host, $username, $password, $dbname);

// if ($con->connect_error) {
//     die("Connection failed: " . $con->connect_error);
// }

// $sql = "SELECT Tree_name, Tree_id, Tree_pic FROM trees";
// $result = mysqli_query($con, $sql);

// if ($result->num_rows > 0) {
//     while ($row = mysqli_fetch_assoc($result)) {
//         $name = $row['Tree_name'];
//         $id = $row['Tree_id'];
//         $pic = $row['Tree_pic'];

//         // Ensure output buffering is disabled before headers
//         ob_end_clean();

//         // Set image content type header (replace with actual MIME type if known)
//         header("Content-Type: image/jpeg");

//         // Resize image (optional)
//         $source = imagecreatefromstring($pic);
//         if ($source) {
//             $targetWidth = 279; // Desired width
//             $targetHeight = 360; // Desired height

//             $target = imagecreatetruecolor($targetWidth, $targetHeight);
//             imagecopyresampled($target, $source, 0, 0, 0, 0, $targetWidth, $targetHeight, imagesx($source), imagesy($source));
//             imagedestroy($source);

//             // Encode and display resized image
//             echo 'data:image/jpeg;base64,' . base64_encode(imagejpeg($target, null, 100)); // Adjust quality (0-100)

//             imagedestroy($target);
//         } else {
//             echo "Image not found or invalid.";
//         }
//     }
// } else {
//     echo "No Results Found.";
// }

$con->close();

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<section class="featured">
              <h2 class="playfare-font">Featured</h2>
              <div class="featurecard">
                <div class="card">
                    <?php echo '<img class="featured-image" src="data:image/png;base64,'.base64_encode($pic).'"/>'; 
                    
                    ?>
                  <!-- <img src="images/image 8.png" alt=""> -->
                  <div class="np">
                    <h3 class="inter-font">Peperomia Ginny</h3>
                    <p>&#2547; 250</p>
                  </div>
                  <div class="atc">
                    <button><img src="images/shopping-cart.svg" alt=""> Add to Cart</button>
                    <div class="atcimg">
                      <img src="images/heart.svg" alt="">
                    </div>
      
                  </div>
                </div>
      
                <div class="card">
                  <img src="images/image 8.png" alt="">
                  <div class="np">
                    <h3>Peperomia Ginny</h3>
                    <p>&#2547; 250</p>
                  </div>
                  <div class="atc">
                    <button><img src="images/shopping-cart.svg" alt=""> Add to Cart</button>
                    <div class="atcimg">
                      <img src="images/heart.svg" alt="">
                    </div>
      
                  </div>
                </div>
      
                <div class="card">
                  <img src="images/image 8.png" alt="">
                  <div class="np">
                    <h3>Peperomia Ginny</h3>
                    <p>&#2547; 250</p>
                  </div>
                  <div class="atc">
                    <button><img src="images/shopping-cart.svg" alt=""> Add to Cart</button>
                    <div class="atcimg">
                      <img src="images/heart.svg" alt="">
                    </div>
                    
      
                  </div>
                </div>
      
                <div class="vap">
                  <p>VIEW ALL PLANTS</p>
                  <img src="images/arrow-right-circle.png" alt="">
                </div>
      
      
              </div>
      
            </section>
</body>
</html>

