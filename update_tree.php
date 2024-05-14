<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Tree Details</title>
</head>
<body>
    <h2>Update Tree Details</h2>
    <form id="updateForm" action="update_tree_process.php" method="POST">
        <!-- Hidden input field to store the tree ID -->
        <input type="hidden" id="treeId" name="tree_id" value="">
        <label for="name">Tree Name:</label>
        <input type="text" id="name" name="name"><br><br>
        <label for="category">Tree Category:</label>
        <input type="text" id="category" name="category"><br><br>
        <label for="price">Tree Price:</label>
        <input type="text" id="price" name="price"><br><br>
        <label for="section">Tree Section:</label>
        <input type="text" id="section" name="section"><br><br>
        <button type="button" onclick="updateTreeDetails()">Update Details</button> <!-- Call the function on button click -->
    </form>

    <script>
        // Function to handle click event on "Update Details" button
        function updateTreeDetails() {
            var treeId = document.getElementById('treeId').value;
            var name = document.getElementById('name').value;
            var category = document.getElementById('category').value;
            var price = document.getElementById('price').value;
            var section = document.getElementById('section').value;

            // Set the tree details in the form fields
            document.getElementById('treeId').value = treeId;
            document.getElementById('name').value = name;
            document.getElementById('category').value = category;
            document.getElementById('price').value = price;
            document.getElementById('section').value = section;
        }
    </script>
</body>
</html>
