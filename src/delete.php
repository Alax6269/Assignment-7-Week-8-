<?php

require "db.php"; 
$id = (int)($_POST["movie_id"] ?? 0);

if ($id > 0) {
    $statement = $conn->prepare("DELETE FROM movies WHERE id = ?");
    
    $statement->bind_param("i", $id);
    
    $statement->execute();
}
header("Location: index.php");
exit; /* Stops the code*/