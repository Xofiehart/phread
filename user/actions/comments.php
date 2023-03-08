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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Set image placement folder
    $target_dir = "img_dir/";
    // Get file path
    $target_file = $target_dir . basename($_FILES["fileUpload"]["name"]);
    // Get file extension
    $imageExt = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    // Allowed file types
    $allowd_file_ext = array("jpg", "jpeg", "png", "mp4");


    if (!file_exists($_FILES["fileUpload"]["tmp_name"])) {
        $resMessage = array(
            "status" => "alert-danger",
            "message" => "Select image to upload."
        );
    } else if (!in_array($imageExt, $allowd_file_ext)) {
        $resMessage = array(
            "status" => "alert-danger",
            "message" => "Allowed file formats .jpg, .jpeg, .mp4 and .png."
        );
    } else if ($_FILES["fileUpload"]["size"] > 2097152) {
        $resMessage = array(
            "status" => "alert-danger",
            "message" => "File is too large. File size should be less than 2 megabytes."
        );
    } else if (file_exists($target_file)) {
        $resMessage = array(
            "status" => "alert-danger",
            "message" => "File already exists."
        );
    } else {
        if (move_uploaded_file($_FILES["fileUpload"]["tmp_name"], $target_file)) {
            $sql_query = "INSERT INTO comments (`title`,`content`,`tag`,`category`) VALUES ($title,$content,$tag,$category)";
            // execute the SQL query
            $result = $conn->query($sql_query);
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
    }
}
