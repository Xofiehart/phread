 <?php
    include 'db.php';
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // collect value of input field

        $name = $_POST['name'];
        $content = $_POST['comment'];
        $postid = $_POST['postid'];
        if (empty($name) || empty($content)) {
            echo "Fields most not be empty";
            return false;
        } else {
            // create a SQL query as a string
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
                //echo "success";
            } else {
                // echo ($fname . " " . $lname . " " . $hash . " " . $role);


                $query = "select * from posts where id='$id';";
                $result = $conn->query($query);

                // // iterate over $result object one $row at a time // use fetch_array() to return an associative array while($row = $result->fetch_array()){
                $data = $result->fetch_all();


                $viewed = intval($data[0][9]) + 1;
                $query2 = "update posts set `likes`=$viewed where id =$id";
                $result2 = $conn->query($query2);
                $conn->commit();
                if ($row = $result) {

                    $response = json_encode(array("message" => "successfully saved", "status" => 200));
                    // echo ($response);
                } else {
                    $response = json_encode(array("message" =>  "failed to save", "status" => 404));
                    // echo ($response);
                }
            }
        }
    }
