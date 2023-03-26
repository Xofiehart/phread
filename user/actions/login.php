 <?php
    require "../../db.php";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // collect value of input field
        session_start();
        $email = $_POST['email'];

        $pass = $_POST['password'];

        if (empty($email) || empty($pass)) {
            echo "Fields most not be empty";
        } else {
            // create a SQL query as a string
            if (mysqli_connect_errno()) {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
            }
            // echo ($fname . " " . $lname . " " . $pass . " " . $role);
            $query = "select id,email,password,fullname,role from user where email='" . $email . "';";
            $result = $conn->query($query);
            // // iterate over $result object one $row at a time // use fetch_array() to return an associative array while($row = $result->fetch_array()){
            $row = $result->fetch_all();

            if ($row[0][2] === md5($pass)) {
                $response = json_encode(array("message" => "successfully logged in", "status" => 200, "data" => array("fullname" => $row[0][3], "role" => $row[0][4], "id" => $row[0][0])));
                $_SESSION['fullname'] = $row[0][3];
                $_SESSION['id'] = $row[0][0];
                $_SESSION['role'] = $row[0][4];
                echo ($response);
            } else {
                $response = json_encode(array("message" =>  "failed to login", "status" => 404));
                echo ("failed to login: Invalid username or password");
            }
        }
    }
    ?>