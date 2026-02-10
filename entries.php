
<?php
include("Database.php");

// SQL query to fetch entries along with image data from the "entries" table
$sql = "SELECT Time, Title, entries, imageName, imagePath, Time FROM entries ORDER BY Time DESC LIMIT 5";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output the HTML structure (DOCTYPE, head, body, etc.) once outside the loop
    echo '<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="entries.css">
        <script src="https://kit.fontawesome.com/c08e2b6902.js" crossorigin="anonymous"></script>
        <title>Entries</title>
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

        <!-- Container for journal entries display -->
        <div class="entries">';

    // Use a while loop to iterate through each row and display the entry information
    while($row = $result->fetch_assoc()) {
        $truncatedEntry = substr($row["entries"], 0, 500);
        echo '<div class="entry">
        <form action="fullEntry.php" method="post">
                <button value="'.$row["Title"].'">
                <input type="hidden" name="title" value="'.$row["Title"].'">
                    <textarea readonly name="title" id="title" cols="30" rows="10">' . $row["Title"] . '</textarea>
                    <textarea readonly name="date" id="date" cols="30" rows="10">' . $row["Time"] . '</textarea>
                    <textarea readonly name="entry" id="entry" cols="30" rows="10">' . $truncatedEntry . ' </textarea>

                    ';
                    
    
                    // Display the image if available
                     if (!empty($row["imagePath"])) {
                        echo '<div class="imageDisplay" id="imageDisplay">
                            <img src="' . $row["imagePath"] . '" alt="' . $row["imageName"] . '">
                             </div>
                             ';
                     }
    
        echo '
                </button>
        </form>
        </div>';
    }
    
    // Close the HTML structure
    echo '</div>
    </body>
    </html>';
} else {
    echo "0 results";
}

$conn->close();
?>
