
<?php
/**
 */

$servername = "localhost";
$dbname = 'hartapp';
$username = "root";
$password = "@Edmund123";
// Create connection
// echo ("hello");
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
//     //echo "success";
// } else {
// create a SQL query as a string
// $sql_query = "SELECT * FROM  payment";
// // execute the SQL query
// $result = $conn->query($sql_query);
// // iterate over $result object one $row at a time // use fetch_array() to return an associative array while($row = $result->fetch_array()){
// while ($row = $result->fetch_array()) {
//     echo ("<br> N" . $row['Amount'] . "<br>");
// }
// };
// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
//     //echo "success";
// } else {
// create a SQL query as a string
// $sql_query = "INSERT INTO user (`email`,`phone`,`fullname`,`role`,`password`) VALUES ('e@e.com','09018237465','ed ig','writer',1);
// ";
// execute the SQL query
// $result = $conn->query($sql_query);
// iterate over $result object one $row at a time // use fetch_array() to return an associative array while($row = $result->fetch_array()){
// while ($row = $result->fetch_array()) {
//     echo ("<br> N" . $row['Amount'] . "<br>");
// }
// };

?>