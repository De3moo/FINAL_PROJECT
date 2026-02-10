<?php
include("Database.php");

$entryText = '';
$titleText = '';
$imagePath = ''; // Variable to store the image path
$date ='';

if (isset($_POST['title'])) {
    $selectedTitle = $_POST['title'];
    $sql = "SELECT Time, Title, entries, imageName, imagePath FROM entries WHERE Title = '$selectedTitle'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Retrieve the image path
            $imagePath = $row["imagePath"];
            $entryText = $row["entries"];
            $titleText = $row["Title"];
            $date = $row["Time"];
        }
    }
}

if (isset($_POST['save'])) {
  $title = $_POST['newTitle'];
  $entry = $_POST['newEntry'];
  $dateRef = $_POST['time'];
  $edit = "UPDATE entries SET Title = '$title', entries = '$entry' WHERE Time = '$dateRef'";
  $conn->query($edit);
  header("Location: entries.php");
    exit;
}
if (isset($_POST['delete'])) {
    $title = $_POST['newTitle'];
    $entry = $_POST['newEntry'];
    $dateRef = $_POST['time'];
    $edit = "DELETE FROM entries WHERE Time = '$dateRef'";
    $conn->query($edit);
    echo"<script>alert('You sure you want to Delete?')</script>";
    header("Location: entries.php");
      exit;
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="fullEntry.css">
    <script src="https://kit.fontawesome.com/c08e2b6902.js" crossorigin="anonymous"></script>
    <title>Document</title>
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
      <form action="" method="post">
      <button name="save" id="save"><i class="fa-regular fa-floppy-disk"></i><h3>Save</h3></button>
      <button name="delete" id="delete"><i class="fa-solid fa-trash"></i><h3>Delete</h3></button>
        <div class="imageContainer">
            <?php
            // Display the image if available
            if (!empty($imagePath)) {
                echo '<img src="' . $imagePath . '" alt="Image associated with the title">';
            } else {
                echo '<p>No image available for this title.</p>';
            }
            ?>
        </div>
        <textarea name="newTitle" id="newTitle" cols="30" rows="10"><?php echo $titleText ?></textarea>
        <textarea name="time" id="time" cols="30" rows="10"><?php echo $date ?></textarea>
         <textarea name="newEntry" id="newEntry" cols="30" rows="10"><?php echo $entryText ?></textarea>
    </div>
    </form>
    
</body>
</html>
