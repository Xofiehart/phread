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
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">PHRead</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarScroll">
                <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
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
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="#">Community</a></li>
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="#!">Top Stories</a></li>

                </ul>
                <form action="posts.php" method="POST" class="d-flex" role="search">
                    <input class="form-control me-2" type="search" name="text" placeholder="Search" aria-label="Search">
                    <ul id="loggedin" class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll">

                    </ul>

                </form>
            </div>
        </div>
    </nav>

    <!-- Header-->
    <header class="bg-about-image py-5">
        <div class="container px-5">
            <div class="row gx-5 justify-content-center">
                <div class="col-lg-6">
                    <div class="text-center my-5">
                        <h1 class="display-5 fw-bolder text-white mb-2">Sights and Scenes from Port Harcourt</h1>
                        <p class="lead text-white-50 mb-4">Creating a new perspective for Port Harcourt</p>
                        <!-- <div class="d-grid gap-3 d-sm-flex justify-content-sm-center">
                                <a class="btn btn-primary btn-lg px-4 me-sm-3" href="#features">Get Started</a>
                                <a class="btn btn-outline-light btn-lg px-4" href="#!">Learn More</a>
                            </div> -->
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Features section-->
    <section class="py-5 border-bottom" id="features">
        <div class="container d-flex justify-content-around align-items-center px-5 my-5">
            <div class="row gx-5">
                <?php
                include 'db.php';
                if (mysqli_connect_errno()) {
                    echo "Failed to connect to MySQL: " . mysqli_connect_error();
                }
                // echo ($fname . " " . $lname . " " . $pass . " " . $role);
                $query = "select * from posts ;";
                $result = $conn->query($query);

                // // iterate over $result object one $row at a time // use fetch_array() to return an associative array while($row = $result->fetch_array()){
                $data = $result->fetch_all();


                if ($data) {
                    $response = json_encode(array("message" => "successfully logged in", "status" => 200, "data" => $data));

                    // print_r($data[0]);
                } else {
                    $response = json_encode(array("message" =>  "failed to login", "status" => 404, "data" => []));
                    echo ($response);
                }
                foreach ($data as $key) {
                ?>
                    <div class="col-lg-4 mb-5 mb-lg-0">
                        <div class="bg-gradient text-white rounded-3 mb-3"><img src="./user/media/<?= $key[6] ?>" width="100" height="100"></div>
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


    <!-- Testimonials section-->
    <!-- <section class="py-5 border-bottom">
        <div class="container px-5 my-5 px-5">
            <div class="text-center mb-5">
                <h2 class="fw-bolder">Customer testimonials</h2>
                <p class="lead mb-0">Our customers love working with us</p>
            </div>
            <div class="row gx-5 justify-content-center">
                <div class="col-lg-6">
                     Testimonial 1
                    <div class="card mb-4">
                        <div class="card-body p-4">
                            <div class="d-flex">
                                <div class="flex-shrink-0"><i class="bi bi-chat-right-quote-fill text-primary fs-1"></i></div>
                                <div class="ms-4">
                                    <p class="mb-1">Thank you for putting together such a great product. We loved working with you and the whole team, and we will be recommending you to others!</p>
                                    <div class="small text-muted">- Client Name, Location</div>
                                </div>
                            </div>
                        </div>
                    </div>
                   Testimonial 2
                   <div class="card">
                        <div class="card-body p-4">
                            <div class="d-flex">
                                <div class="flex-shrink-0"><i class="bi bi-chat-right-quote-fill text-primary fs-1"></i></div>
                                <div class="ms-4">
                                    <p class="mb-1">The whole team was a huge help with putting things together for our company and brand. We will be hiring them again in the near future for additional work!</p>
                                    <div class="small text-muted">- Client Name, Location</div>
                                </div>
                            </div>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
    </section> -->
    <!-- Contact section-->
    <section class="bg-light py-5" id="contact">
        <div class="container px-5 my-5 px-5">
            <div class="text-center mb-5">
                <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-envelope"></i></div>
                <h2 class="fw-bolder">Get in touch</h2>
                <p class="lead mb-0">We'd love to hear from you</p>
            </div>
            <div class="row gx-5 justify-content-center">
                <div class="col-lg-6">
                    <form id="contactForm" data-sb-form-api-token="API_TOKEN">

                        <div class="form-floating mb-3">
                            <input class="form-control" id="name" type="text" placeholder="Enter your name..." data-sb-validations="required" />
                            <label for="name">Full name</label>
                            <div class="invalid-feedback" data-sb-feedback="name:required">A name is required.</div>
                        </div>

                        <div class="form-floating mb-3">
                            <input class="form-control" id="email" type="email" placeholder="name@example.com" data-sb-validations="required,email" />
                            <label for="email">Email address</label>
                            <div class="invalid-feedback" data-sb-feedback="email:required">An email is required.</div>
                            <div class="invalid-feedback" data-sb-feedback="email:email">Email is not valid.</div>
                        </div>

                        <div class="form-floating mb-3">
                            <input class="form-control" id="phone" type="tel" placeholder="(123) 456-7890" data-sb-validations="required" />
                            <label for="phone">Phone number</label>
                            <div class="invalid-feedback" data-sb-feedback="phone:required">A phone number is required.</div>
                        </div>

                        <div class="form-floating mb-3">
                            <textarea class="form-control" id="message" type="text" placeholder="Enter your message here..." style="height: 10rem" data-sb-validations="required"></textarea>
                            <label for="message">Message</label>
                            <div class="invalid-feedback" data-sb-feedback="message:required">A message is required.</div>
                        </div>

                        <div class="d-none" id="submitSuccessMessage">
                            <div class="text-center mb-3">
                                <div class="fw-bolder">Form submission successful!</div>
                                To activate this form, sign up at
                                <br />
                                <a href="https://startbootstrap.com/solution/contact-forms">https://startbootstrap.com/solution/contact-forms</a>
                            </div>
                        </div>

                        <div class="d-none" id="submitErrorMessage">
                            <div class="text-center text-danger mb-3">Error sending message!</div>
                        </div>

                        <div class="d-grid"><button class="btn btn-primary btn-lg disabled" id="submitButton" type="submit">Submit</button></div>
                    </form>
                </div>
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
                                <li><a class="dropdown-item" href="#">Night Life</a></li>
                                <li><a class="dropdown-item" href="#">Food & Events</a></li>
                                <li><a class="dropdown-item" href="#">Arts & Culture</a></li>
                                <li><a class="dropdown-item" href="#">Adventure</a></li>
                            </ul>
                        </li>



                    </ul>



                </div>
                <div class="d-flex flex-row">
                    <div class="navbar-nav p-0" style="margin-top: -2%;">


                        <ul class=" d-flex flex-row" id="loggedin">
                            <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>

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
        // $("document").ready(() => {
        //     $.get("./user/actions/post.php", function(data, status) {
        //         // 
        //         // console.log('data', data)
        //         var jdata = JSON.parse(data)
        //         console.log('data', jdata)
        //         if (jdata['status'] == 200) {
        //             // $(".alert").html(jdata['message'])
        //             var str = []
        //             for (let index = 0; index < jdata['data'].length; index++) {
        //                 str += " <tr> <td>" + jdata['data'][index][1] + "</td> <td>" +
        //                     jdata['data'][index][5] + " </td> <td> " + jdata['data'][index][7] + "</td><td> <button id=" + jdata['data'][index][0] + " class='btn btn-danger'>Delete</button> </td></tr> "

        //             }
        //             // console.log('str', str)
        //             $("tbody").html(str)




        //         } else {
        //             // $(".alert").html(jdata['message'])
        //         }

        //     });
        // })
    </script>
    <script>
        var user = JSON.parse(localStorage.getItem('user'))
        console.log('user', user)
        if (!user['id']) {
            var loggedin = document.getElementById('loggedin').innerHTML = '<li class="nav-item"><a class="nav-link" href="user/login.php">Login</a></li><li class="nav-item"><a class="nav-link" href="user/register.php">Register</a></li>'
        } else {
            var loggedin = document.getElementById('loggedin').innerHTML = '<li class="nav-item"><a class="nav-link" href="user/logout.php"> Logout</a></li><li class="nav-item"><a class="nav-link" href="user/dashboard.php"> Dashboard</a></li>'
        }
    </script>
</body>

</html>