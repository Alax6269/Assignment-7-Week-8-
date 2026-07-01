<?php

require "db.php"; /*Uses db.php code from here*/

if ($_SERVER["REQUEST_METHOD"] === "POST"){ /*If any of the request is using POST format then this loop triggers*/
/*Extract the latest data from the DB for all the rows*/
     $id = (int)($_POST["movie_id"]?? 0);
     $title = trim($_POST["movie_title"] ?? "");
     $year  = (int)($_POST["movie_watch_year"] ?? 0);
     $score = (int)($_POST["movie_score"] ?? 0);


if ($id > 0 && $title !== "" && $year >0 && $score >0){/*This statement only runs if all 4 table value of a row is not empty*/
  $statement_1 = $conn->prepare("UPDATE movies SET title=?, year=?, score=? WHERE id=?");/*Prepare to swap/edit the data of an table*/

  $statement_1->bind_param("siii", $title, $year, $score, $id);/*binds the data of all 4 variable in here with $statement_1*/
  $statement_1->execute();/*Execute this statement*/
}

header("Location: index.php");/*Redirects the user to the main page at index.php*/ 
    exit; /*Stops the code*/
}


$id =(int)($_GET["id"]?? 0);/*?? is to act as a backup in case value is null while 0 is the backup replacemnet number*/
if ($id <=0){ /*runs this line if id = 0*/
   header("Location:index.php");/*Brings the user back to main page at index.php*/
   exit; /*Stops the code*/
}

$statement_1 = $conn->prepare("SELECT * FROM movies WHERE id =?");/*to get movie id from the table*/
$statement_1->bind_param("i", $id);
$statement_1->execute();
$result = $statement_1->get_result();/*Gets the dta from $statement_1 and stores it inside $result*/
$movie = $result->fetch_assoc(); /*Only gets the id of movie and assign $movie with it*/

if(!$movie){/*If the row movie isnt in the database or cant be found then triggrs this staement*/
 header("Location: index.php");/*Brings user to the main page at index.php*/
 exit; /*Stops the code*/
}

?> <!--PHP ends here-->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Movie</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Edit Movie Details</h2>
    <!--This Form Submits to itself my the POST method-->
    <form action="edit.php" method="POST">
        <!--the movie is assigned here as an input but it is hidden from user-->
        <input type="hidden" name="movie_id" value="<?php echo htmlspecialchars($movie['id']); ?>">
        
        <p>
            <label>Title:</label><br>
            <!--Input field for Movie Name-->
            <input type="text" name="movie_title" value="<?php echo htmlspecialchars($movie['title']); ?>" required>
        </p>
        <p>
            <label>Year:</label><br>
            <!--Input field for Movie Watch Year-->
            <input type="number" name="movie_watch_year" value="<?php echo htmlspecialchars($movie['year']); ?>" required>
        </p>
        <p>
            <label>Your Score (1-10):</label><br>
            <!--Input field for Movie Score-->
            <input type="number" name="movie_score" min="1" max="10" value="<?php echo htmlspecialchars($movie['score']); ?>" required>
        </p>
        
        <button type="submit" class="Save_Btn">Save Changes</button>
        <a href="index.php" style="margin-left: 10px; color: #555; text-decoration: none;">Cancel</a>
    </form>

</body>
</html>
