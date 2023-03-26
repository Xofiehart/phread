<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>PHRead - Register</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                                <p class="alert">

                                </p>
                            </div>

                            <form class="user" method="post" action="./register.php">
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" name="fname" class="fname form-control form-control-user" id="exampleFirstName" placeholder="First Name">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" name="lname" class="lname form-control form-control-user" id="exampleLastName" placeholder="Last Name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="email" name="email" class="email form-control form-control-user" id="exampleInputEmail" placeholder="Email Address">
                                </div>
                                <div class="form-group">
                                    <input type="mobile" name="mobile" class="mobile form-control form-control-user" id="exampleInputmobile" placeholder="mobile">
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" name="password" class="password form-control form-control-user" id="exampleInputPassword" placeholder="Password">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" name="repassword" class="repassword form-control form-control-user" id="exampleRepeatPassword" placeholder="Repeat Password">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <select name="role" class="role form-select form-control " aria-label="Default select example">
                                            <option>select role</option>
                                            <option value="writer">Writer</option>

                                        </select>

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input class="form-control  btn btn-primary" type="submit" name="Register" value="Register" />
                                    </div>
                                </div>

                            </form>
                            <hr>
                            <div class="text-center">
                                <a href="../index.php">Go Home</a>
                            </div>
                            <div class="text-center">

                                <a class="small" href="login.php">Already have an account? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
    <script>
        $(".btn").click(function(e) {
            e.preventDefault()
            var fname = $(".fname").val()
            var lname = $(".lname").val()
            var email = $(".email").val()
            var mobile = $(".mobile").val()
            var password = $(".password").val()
            var repassword = $(".repassword").val()
            var role = $(".role").val()
            var data = {
                fname,
                lname,
                email,
                repassword,
                password,
                mobile,
                role
            }
            $.post("./actions/register.php", data, function(data, status) {
                console.log('data', data)
                var jdata = JSON.parse(data)
                if (jdata['status'] == 200) {
                    $(".alert").html(jdata['message'])
                    setTimeout(() => {
                        window.location.replace("./login.php");
                    }, 2000);


                } else {
                    $(".alert").html(jdata['message'])
                }
            });
        });
    </script>
</body>

</html>