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
    $id = $_GET['id'];
    // echo ($id);
    $query = "select id,title,content,category,fullname from posts where writerid='$id' ;";
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
if ($_SERVER["REQUEST_METHOD"] == "DELETE") {
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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Set image placement folder
    $title = $_POST['title'];
    $category = $_POST['category'];
    $content = $_POST['content'];
    $postid = $_POST['postid'];
    $name = $_SESSION['fullname'];
    $id = $_SESSION['id'];

    $sql_query = "update posts set title = '$title', content = '$content' category = '$category' where id= '$postid'; ";
    // execute the SQL query
    $result = $conn->query($sql_query);

    $conn->commit();
    if ($result) {
        $resMessage = array(
            "status" => "alert-success",
            "message" => "Image uploaded successfully."
        );
    }
} else {
    $resMessage = array(
        "status" => "alert-danger",
        "message" => "Image coudn't be uploaded."
    );
}
