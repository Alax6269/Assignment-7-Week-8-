<?php /*[Database Connection]*/

$host     = "db";        
$username = "appuser";
$password = "apppass";   
$database = "myapp";
/*Host Name, User Name, Password, Database Name*/
$conn = new mysqli($host, $username, $password, $database); /*Connects to the MySql DataBases*/

if ($conn->connect_error) { /*Checks for connection failure*/
 die("Database Connection Failed !!! " . $conn->connect_error); /*If connection failed then stops the code and print error message*/
}
$conn->set_charset("utf8mb4"); /*If no error then the code set the Encoding to UTF-8 for international char*/