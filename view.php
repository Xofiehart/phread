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
    <section class="py-5 border-bottom" id="features" style="height: 100vh;">
        <div class="container px-5 my-5">
            <div class="row gx-5">
                <?php
                include 'db.php';
                if (mysqli_connect_errno()) {
                    echo "Failed to connect to MySQL: " . mysqli_connect_error();
                }
                $cat = $_GET['category'];
                // echo ($fname . " " . $lname . " " . $pass . " " . $role);
                $query = "select * from posts where category='$cat';";
                $result = $conn->query($query);

                // // iterate over $result object one $row at a time // use fetch_array() to return an associative array while($row = $result->fetch_array()){
                $data = $result->fetch_all();


                if ($data) {
                    $response = json_encode(array("message" => "successfully logged in", "status" => 200, "data" => $data));

                    // print_r($data[0]);
                } else {
                    $response = json_encode(array("message" =>  "failed to find stories", "status" => 404, "data" => []));
                    echo ("No stories available for category");
                }
                foreach ($data as $key) {
                ?>
                    <div class="col-lg-4 mb-5 mb-lg-0">
                        <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><img src="./user/media/<?= $key[6] ?>" width="100" height="100"></div>
                        <h2 class="h4 fw-bolder"><?= $key[1] ?></h2>
                        <p><?= $key[2] ?></p>
                        <a class="text-decoration-none" href="story.php?id=<?= $key[0] ?>">
                            View
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                <?php
                }
                ?>


            </div>
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