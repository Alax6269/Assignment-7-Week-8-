<?php
require "db.php";/*Uses the db.php file codes in here*/
$title = trim($_POST["movie_title"]??""); /*trim removes any spacing on fronth and the back of the string while ?? "" act as a back up in case the value is null, 
$_POST is a globalVariable created automatically by PHP and can be used by any file or folders in this program*/
$year = (int)($_POST["movie_watch_year"]??0);
$score = (int)($_POST["movie_score"]??0);

/*This section is to check if the value of any row is empty or invalid*/
if ($title === ""|| $year <=0 || $score <=0){
      header ("Location: index.php"); /*Redirects to the main page located at index.php*/
      exit; /*Stops the code */
}

/*This is the query template with all 3 values as placeholders in it*/
$statement_1 = $conn->prepare("INSERT INTO movies (title, year, score) VALUES (?,?,?)");
/*s= string, i= integer*/
$statement_1->bind_param("sii",$title, $year, $score);
$statement_1->execute(); /*Executes this statement*/

header("Location: index.php"); /*Redirects to the main page at index.php*/
exit; /*Stops the code*/