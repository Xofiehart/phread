<?php
session_start()
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>phRead</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
</head>

<body>
    <!-- Responsive navbar-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container px-5">
            <a class="navbar-brand" href="#!">PHRead</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class=" d-flex navbar-nav ms-auto px-9 mb-lg-0 justify-content-start">
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="index.php">Home</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            About
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Privacy</a></li>
                            <li><a class="dropdown-item" href="#">Terms & Conditions</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Categories
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="view.php?category=night">Night Life</a></li>
                            <li><a class=" dropdown-item" href="view.php?category=food">Food & Events</a></li>
                            <li><a class=" dropdown-item" href="view.php?category=arts">Arts & Culture</a></li>
                            <li><a class=" dropdown-item" href="view.php?category=adventure">Adventure</a></li>
                        </ul>
                    </li>



                </ul>

                <div class="d-flex navbar-nav justify-content-end">
                    <form class="d-flex" role="search">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>

                    <ul class="d-flex flex-row">
                        <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                        <?php
                        if ($_SESSION['id']) {
                            echo '<li class="nav-item"><a class="nav-link" href="user/login.php">
                                Login
                            </a></li>
                        <li class="nav-item"><a class="nav-link" href="user/register.php">
                                Register
                            </a></li>';
                        } else {
                            echo '<li class="nav-item"><a class="nav-link" href="user/logout.php">
                                Logout
                            </a></li>';
                            echo '<li class="nav-item"><a class="nav-link" href="user/dashboard.php">
                                Dashboard
                            </a></li>';
                        }

                        ?>
                    </ul>
                </div>

            </div>
        </div>
    </nav>

    <!-- Features section-->
    <section class="py-5 border-bottom" id="features" style="min-height: 100vh;width:100vw">
        <div class="container  d-flex justify-content-around align-items-center px-5 my-5">
            <div class="col-md-12 d-flex justify-content-around align-items-center  gx-5">
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


                            $sql_query = "INSERT INTO comments (`comment`,`postid`,`comment_by`) VALUES ('$content',$postid,'$name')";
                            // execute the SQL query
                            $result = $conn->query($sql_query);
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
                $id = $_GET['id'];
                // echo ($fname . " " . $lname . " " . $pass . " " . $role);
                $query = "select * from posts where id='$id';";
                $result = $conn->query($query);

                // // iterate over $result object one $row at a time // use fetch_array() to return an associative array while($row = $result->fetch_array()){
                $data = $result->fetch_all();
                $query2 = "select * from comments where postid='$id';";
                $result2 = $conn->query($query2);
                $data2 = $result2->fetch_all();

                $viewed = intval($data[0][10]) + 1;
                $query2 = "update posts set `views`=$viewed where id =$id";
                $result2 = $conn->query($query2);
                $conn->commit();


                if ($data) {
                    $response = json_encode(array("message" => "successfully logged in", "status" => 200, "data" => $data));

                    // print_r($data[0]);
                } else {
                    $response = json_encode(array("message" =>  "failed to find stories", "status" => 404, "data" => []));
                    echo ("failed to find stories");
                }
                foreach ($data as $key) {
                ?>
                    <div class="col-lg-9 justify-content-around align-items-center  mb-5 mb-lg-0">
                        <div class="justify-content-around align-items-center  bg-gradient text-white rounded-3 mb-3"><img src="./user/media/<?= $key[6] ?>" width="800" height="500"></div>
                        <h2 class="h4 justify-content-around align-items-center  fw-bolder"><?= $key[1] ?></h2>
                        <p><?= $key[2] ?></p>

                    </div>
                <?php
                }
                ?>


            </div>

        </div>
        <div class="col-md-8 p-5">
            <?php
            foreach ($data2 as $row2) {
            ?>
                <div class='col-md-4 mb-5'>
                    <div class='card h-100'>
                        <div class='card-body'>
                            <h2 class='card-title'><?= $row2[4] ?></h2>
                            <p class='card-text'><?= $row2[1] ?></p>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <form class="user" action="" method="POST">
                <div class="form-group">
                    <input type="text" class="email form-control form-control-user" name="name" id="name" aria-describedby="emailHelp" placeholder="Enter Username">
                </div>
                <div class="form-group">
                    <textarea type="text" class="password form-control form-control-user" name="comment" id="exampleInputPassword" placeholder="Comment">
                    </textarea>
                </div>

                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <input class="form-control  btn btn-primary" type="submit" name="Submit" value="Submit" />
                        <input hidden class="form-control  btn btn-primary" type="text" name="postid" value="<?= $_GET['id'] ?>" />
                    </div>
                </div>

            </form>
        </div>

    </section>



    <!-- Footer-->
    <footer class="py-5 bg-dark">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container px-5">

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="" id="navbarSupportedContent">
                    <ul class=" d-flex navbar-nav ms-auto px-9 mb-lg-0 justify-content-start">
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="#!">Home</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                About
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Privacy</a></li>
                                <li><a class="dropdown-item" href="#">Terms & Conditions</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Categories
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="view.php?category=night">Night Life</a></li>
                                <li><a class=" dropdown-item" href="view.php?category=food">Food & Events</a></li>
                                <li><a class=" dropdown-item" href="view.php?category=arts">Arts & Culture</a></li>
                                <li><a class=" dropdown-item" href="view.php?category=adventure">Adventure</a></li>
                            </ul>
                        </li>



                    </ul>



                </div>
                <div class="d-flex flex-row">
                    <div class="navbar-nav p-0" style="margin-top: -2%;">


                        <ul class=" d-flex flex-row">
                            <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                            <?php
                            if ($_SESSION['id']) {
                                echo '<li class="nav-item"><a class="nav-link" href="user/login.php">
                                Login
                            </a></li>
                        <li class="nav-item"><a class="nav-link" href="user/register.php">
                                Register
                            </a></li>';
                            } else {
                                echo '<li class="nav-item"><a class="nav-link" href="user/logout.php">
                                Logout
                            </a></li>';
                            }

                            ?>
                        </ul>
                    </div>
                    <p class="m-0 text-center text-white">Copyright &copy; Your Website 2022</p>
                </div>
            </div>
        </nav>

    </footer>
    <script src="/user/vendor/jquery/jquery.min.js"></script>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
    <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
    <script>
        $("document").ready(() => {
            $.get("./user/actions/post.php", function(data, status) {
                // 
                // console.log('data', data)
                var jdata = JSON.parse(data)
                console.log('data', jdata)
                if (jdata['status'] == 200) {
                    // $(".alert").html(jdata['message'])
                    var str = []
                    for (let index = 0; index < jdata['data'].length; index++) {
                        str += " <tr> <td>" + jdata['data'][index][1] + "</td> <td>" +
                            jdata['data'][index][5] + " </td> <td> " + jdata['data'][index][7] + "</td><td> <button id=" + jdata['data'][index][0] + " class='btn btn-danger'>Delete</button> </td></tr> "

                    }
                    // console.log('str', str)
                    $("tbody").html(str)




                } else {
                    // $(".alert").html(jdata['message'])
                }

            });
        })
    </script>
</body>

</html>