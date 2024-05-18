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

// Handle order placement
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['place_order'])) {
    $total_price = $_POST['total_price'];
    
    // Start a transaction
    $con->begin_transaction();

    try {
        // Insert into orders table
        $stmt = $con->prepare("INSERT INTO orders (User_email, Total_price) VALUES (?, ?)");
        $stmt->bind_param("sd", $user_email, $total_price);
        $stmt->execute();
        $order_id = $stmt->insert_id;
        $stmt->close();

        // Insert each cart item into order_items table
        $stmt = $con->prepare("INSERT INTO order_items (Order_id, Tree_key, Quantity, Price) VALUES (?, ?, ?, ?)");
        $update_quantity_stmt = $con->prepare("UPDATE trees SET Tree_quantity = Tree_quantity - 1 WHERE Tree_key = ?");

        foreach ($_POST['cart_items'] as $item) {
            $stmt->bind_param("isid", $order_id, $item['Tree_key'], $item['Quantity'], $item['Price']);
            $stmt->execute();

            // Update tree quantity in the trees table
            $update_quantity_stmt->bind_param("s", $item['Tree_key']);
            $update_quantity_stmt->execute();
        }
        $stmt->close();
        $update_quantity_stmt->close();

        // Clear the cart
        $stmt = $con->prepare("DELETE FROM cart WHERE User_email = ?");
        $stmt->bind_param("s", $user_email);
        $stmt->execute();
        $stmt->close();

        // Commit transaction
        $con->commit();
        echo "<script>alert('Order placed successfully!'); window.location.href='cart.php';</script>";
    } catch (Exception $e) {
        // Rollback transaction on error
        $con->rollback();
        echo "<script>alert('Failed to place order. Please try again.');</script>";
    }
}

// Fetch cart items
$stmt = $con->prepare("SELECT trees.Tree_key, trees.Tree_name, trees.Tree_price, cart.Quantity FROM cart JOIN trees ON cart.Tree_key = trees.Tree_key WHERE cart.User_email = ?");
$stmt->bind_param("s", $user_email);
$stmt->execute();
$result = $stmt->get_result();

$total_price = 0;
$total_trees = 0;
$cart_items = [];

while ($row = $result->fetch_assoc()) {
    $total_price += $row['Tree_price'] * $row['Quantity'];
    $total_trees += $row['Quantity'];
    $cart_items[] = $row;
}

$stmt->close();
$con->close();
?>

<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.7.2/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles/landing-page.css" />
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
                        <path d="M21 21L16.65 16.65M19 11C19 15.4183 15.4183 19 11 19C6.58172 19 3 15.4183 3 11C3 6.58172 6.58172 3 11 3C15.4183 3 19 6.58172 19 11Z" stroke="#121212" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </a>
                <a href="" class="ml-1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M1 1H5L7.68 14.39C7.77144 14.8504 8.02191 15.264 8.38755 15.5583C8.75318 15.8526 9.2107 16.009 9.68 16H19.4C19.8693 16.009 20.3268 15.8526 20.6925 15.5583C21.0581 15.264 21.3086 14.8504 21.4 14.39L23 6H6M10 21C10 21.5523 9.55228 22 9 22C8.44772 22 8 21.5523 8 21C8 20.4477 8.44772 20 9 20C9.55228 20 10 20.4477 10 21ZM21 21C21 21.5523 20.5523 22 20 22C19.44772 22 19 21.5523 19 21C19 20.4477 19.4477 20 20 20C20.5523 20 21 20.4477 21 21Z" stroke="#121212" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </a>
            </div>
        </div>
    </nav>

    <hr class="border-gray-300">

    <h2 class="text-3xl py-10 font-medium text-center playfare-font">Your Cart</h2>

    <?php if (!empty($cart_items)) { ?>
        <form method="POST" action="cart.php">
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
                            <?php foreach ($cart_items as $item) { ?>
                                <tr class="bg-white border-b">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                        <?php echo htmlspecialchars($item['Tree_name']); ?>
                                        <input type="hidden" name="cart_items[][Tree_key]" value="<?php echo htmlspecialchars($item['Tree_key']); ?>">
                                        <input type="hidden" name="cart_items[][Quantity]" value="<?php echo htmlspecialchars($item['Quantity']); ?>">
                                        <input type="hidden" name="cart_items[][Price]" value="<?php echo htmlspecialchars($item['Tree_price']); ?>">
                                    </th>
                                    <td class="px-6 py-4">
                                        <?php echo number_format($item['Tree_price'], 2); ?>
                                    </td>
                                    <td class="px-6 py-4">
                                        <?php echo htmlspecialchars($item['Quantity']); ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div class="flex justify-between mt-4">
                    <div class="text-xl">
                        Total Price: <?php echo number_format($total_price, 2); ?>
                        <input type="hidden" name="total_price" value="<?php echo htmlspecialchars($total_price); ?>">
                    </div>
                    <button type="submit" name="place_order" class="px-4 py-2 bg-green-500 text-white rounded">Place Order</button>
                </div>
            </div>
        </form>
    <?php } else { ?>
        <p class="text-center">Your cart is empty.</p>
    <?php } ?>
</body>
</html>
