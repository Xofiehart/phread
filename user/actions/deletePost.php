<?php

// Database connection
require "../../db.php";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // collect value of input field


    // create a SQL query as a string
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    // echo ($fname . " " . $lname . " " . $pass . " " . $role);
    $id = $_GET['id'];
    // echo ($id);
    $query = "delete from posts where id='$id' ;";
    $result = $conn->query($query);
    $conn->commit();
    // echo $query;
    // // iterate over $result object one $row at a time // use fetch_array() to return an associative array while($row = $result->fetch_array()){
    // $row = $result->fetch_all();


    if ($result) {
        $response = json_encode(array("message" => "successful", "status" => 200));

        echo ($response);
    } else {
        $response = json_encode(array("message" =>  "failed to pull data", "status" => 404));
        echo ($response);
    }
}
