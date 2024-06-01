<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Our Products</title>
</head>
<body>
    <div class="heading">
        <h1>Our Products</h1>
    </div>
    <div class="container">

    <?php
    // Database credentials
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "fichier";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Query to fetch product data
    $sql = "SELECT nom_produit, prix_vente FROM colis";
    $result = $conn->query($sql);

    // Counter for generating unique IDs
    $counter = 1;

    // Display product data dynamically
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<form class="box" action="upload.php" method="post" enctype="multipart/form-data">';
            echo '<input type="file" name="product_image" accept="image/*" onchange="previewImage(event, ' . $counter . ', this)">';
            echo '<img id="preview-' . $counter . '" src="imgs/default.jpg" alt="Product Image">';
            echo '<h2>' . htmlspecialchars($row["nom_produit"]) . '</h2>';
            echo '<p>Lorem ipsum, dolor amet consect etur adipisicing sit elit.</p>';
            echo '<span>' . htmlspecialchars($row["prix_vente"]) . ' DA</span>';
            echo '<div class="rate">';
            echo '</div>';
            echo '<div class="options">';
            echo '</div>';
            echo '</form>';
            $counter++;
        }
    } else {
        echo '<p>No products found</p>';
    }

    // Close connection
    $conn->close();
    ?>

    </div>

    <script>
        function previewImage(event, id, input) {
            var reader = new FileReader();
            reader.onload = function(){
                var previewId = 'preview-' + id;
                var output = document.getElementById(previewId);
                output.src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
</body>
</html>
