<?php
include("Database.php");

$message = ""; // Initialize the message variable

if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $entry = $_POST['entry'];

    // Image handling
    if ($_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $image_name = $_FILES['image']['name'];

        // Define the path where the image will be saved on the server
        $upload_dir = "uploads/";
        $image_path = $upload_dir . $image_name;

        // Move the uploaded image to the specified directory
        move_uploaded_file($_FILES['image']['tmp_name'], $image_path);

        // Check if the 'entries' table has a 'VARCHAR' column for 'imagePath'
        $sql = "INSERT INTO entries (Title, entries, imageName, imagePath) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            die("Error in statement preparation: " . $conn->error);
        }

        // Bind parameters by reference
        $stmt->bind_param("ssss", $title, $entry, $image_name, $image_path);

        if ($stmt->execute()) {
            $message = "Entry successfully added!";
        } else {
            $message = "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        $message = "Error uploading image: " . $_FILES['image']['error'];
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="index.css">
  <script src="https://kit.fontawesome.com/c08e2b6902.js" crossorigin="anonymous"></script>
  <title>Write Entry</title>
</head>
<body>
  <div class="sidebar">
    <header>Menu</header>
      <ul>
        <li><a href="index.php"><i class="fas fa-home"></i>Home</a></li>
        <li><a href="entry.php"><i class="fas fa-edit"></i>Write Entry</a></li>
        <li><a href="entries.php"><i class="fas fa-archive"></i>Entries</a></li>
        <li><a href="Calendar.php"><i class="fas fa-calendar-week">Calendar</i></a></li>  
      </ul>
  </div>

  <div class="container">
    <form action="entry.php" method="post" enctype="multipart/form-data">
      <div class="title">
        <textarea name="title" id="title" cols="30" rows="10" placeholder="Your title"></textarea>
      </div>
      <div class="entry">
        <textarea name="entry" id="entry" cols="30" rows="10" placeholder="What's on your mind?"></textarea>
      </div>
      <div class="submit">
        <input type="submit" name="submit" id="submit">
      </div>
      <div class="image">
        <div class="imageContainer" id="imageContainer"></div>
        <label for="image">Image</label>
        <input type="file" name="image" id="image" accept="image/*" onchange="previewImage()">
      </div>
    </form>
  </div>

  <script>
        function previewImage() {
            var input = document.getElementById('image');
            var container = document.getElementById('imageContainer');

            // Check if a file is selected
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    // Set the source of the image to the uploaded file
                    container.innerHTML = '<img src="' + e.target.result + '" alt="Uploaded Image">';
                };

                // Read the selected file as a data URL
                reader.readAsDataURL(input.files[0]);
            } else {
                container.innerHTML = ''; // Clear the container if no file is selected
            }
        }
    </script>
</body>
</html>