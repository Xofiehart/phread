 <?php
    require "../../db.php";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // collect value of input field

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
            $query = "select email,password from user where email='" . $email . "';";
            $result = $conn->query($query);
            // // iterate over $result object one $row at a time // use fetch_array() to return an associative array while($row = $result->fetch_array()){
            while ($row = $result->fetch_array()) {

                if ($row['password'] === md5($pass)) {
                    return true;
                }
            }
        }
    }
    ?>