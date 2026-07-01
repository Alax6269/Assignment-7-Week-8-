<?php 
require "db.php"; /*Uses db.php file codes in here*/
?>

<!DOCTYPE html>
<html lang="en"> <!--English-->
<head>
    <meta charset="UTF-8">
    <title>My Movie Logs</title> <!--Tab Name-->
    <link rel="stylesheet" href="style.css"> <!--To use external file to style the Web Page-->
</head>
<body>
    <h2>Add New Movie Here</h2>
    <form action="create.php" method="POST"> <!--Sends data from form into the create.php file by using POST method to keep data invisible to users-->
        <p>  <!--Paragraph 1 start-->
              <label>Movie Title:</label><br> <!--Label is to put a text on top of input while br is to break line-->
              <input type="text" name="movie_title" required>  <!--User need to fill up the form to send-->
        </p> <!--Paragraph 1 end-->  
        <p>  <!--Paragraph 2 start-->
            <label>Watch Year:</label><br>
            <input type="number" name="movie_watch_year" required>
        </p> <!--Paragraph 2 end-->
        <p>
              <label>Movie Score:</label><br>
              <input type="number" name="movie_score" min="1" max="10" required>
        </p>
        <button type="submit" class="Save_Btn">Save Rating</button> <!--Button to send all 3 datas entered to create.php-->
    </form>

    <hr> <!--Just adds section break on page and adds a line that can be styled later in css-->

    <h2>Rated Movies</h2>
    <?php
    $result = $conn->query("SELECT * FROM movies ORDER BY id DESC"); /*$result creates a variable named result to hold the movie data in descending order*/
    
    while ($row = $result->fetch_assoc()) { /*Fetch the movie data of each row and makes a loop out of it*/
        echo "<div class='movie-item' style='margin-bottom: 20px; padding: 10px; border: 1px solid #eee;'>"; /*echo is for outputting data onto the screen*/
        
        /*All database value printed out is wrapped in htmlspecialchars() for security*/
        echo "<h3>" . htmlspecialchars($row["title"]) . "</h3>";
        echo "<p>Year: " . htmlspecialchars($row["year"]) . " | Score: " . htmlspecialchars($row["score"]) . "/10</p>";

       
        echo "  <div class='movie-actions' style='margin-top: 10px;'>";
        echo '    <a href="edit.php?id=' . htmlspecialchars($row["id"]) . '" class="Edit_Btn">Edit</a>'; /*The Edit button function*/

        echo "    <form action='delete.php' method='POST' onsubmit='return confirm(\"Confirm To Delete The Movie?\");' style='display: inline-block; margin: 0;'>"; /*Deletion confirmation popup and triggers delete function*/
        echo "      <input type='hidden' name='movie_id' value='" . htmlspecialchars($row["id"]) . "'>"; /*This input space is hidden from user view but it selects the Movie by its id*/
        echo "      <button type='submit' class='Delete_Btn'>Delete</button>"; /*Submit the delete command*/
        echo "    </form>"; /*end of delete form*/
        echo "  </div>"; /*end of button zone*/
        
        echo "</div>"; /*end of movie-item container box*/
    }
    ?>
</body>
</html>