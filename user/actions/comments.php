<?php

// Database connection
require "../../db.php";
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // collect value of input field


    // create a SQL query as a string
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    // echo ($fname . " " . $lname . " " . $pass . " " . $role);
    $query = "select * from comments ;";
    $result = $conn->query($query);

    // // iterate over $result object one $row at a time // use fetch_array() to return an associative array while($row = $result->fetch_array()){
    $row = $result->fetch_all();


    if ($row) {
        $response = json_encode(array("message" => "successfully logged in", "status" => 200, "data" => $row));

        echo ($response);
    } else {
        $response = json_encode(array("message" =>  "failed to login", "status" => 404, "data" => []));
        echo ($response);
    }
}

if ($_SERVER["REQUEST_METHOD"] == "DELETE") {
    // collect value of input field


    // create a SQL query as a string
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    // echo ($fname . " " . $lname . " " . $pass . " " . $role);
    $id = $_GET['id'];
    // echo ($id);
    $query = "delete from comments where id='$id' ;";
    $result = $conn->query($query);
    // echo $query;
    // // iterate over $result object one $row at a time // use fetch_array() to return an associative array while($row = $result->fetch_array()){
    $row = $result->fetch_all();


    if ($row) {
        $response = json_encode(array("message" => "successful", "status" => 200, "data" => $row));

        echo ($response);
    } else {
        $response = json_encode(array("message" =>  "failed to pull data", "status" => 404, "data" => []));
        echo ($response);
    }
}
