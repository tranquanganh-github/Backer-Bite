<?php include 'config/connect.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="images/icons/favicon.ico" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="./Admin/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="./Admin/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="./Admin/css/util.css"> 
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="./Admin/css/main.css">
</head>

<body>
    <?php
    if (isset($_POST['register'])) {
        $username = htmlspecialchars($_POST['username']);
        $password = htmlspecialchars($_POST['password']);
        $phonenumber = intval(htmlspecialchars($_POST['phonenumber'])) ?? 0;
        $address = htmlspecialchars($_POST['address']);
        $role = 0;
        if (!empty($username) and !empty($password)) {
            if(strlen($phonenumber) < 12){
                $sql = "INSERT INTO users(username,password,role,phonenumber,address) VALUES (:username,:password,:role,:phonenumber,:address)";
                $statement = $conn->prepare($sql);
                $statement->bindParam(':username', $username);
                $statement->bindParam(':password', $password);
                $statement->bindParam(':role', $role);
                $statement->bindParam(':phonenumber', $phonenumber);
                $statement->bindParam(':address', $address);
                if ($statement->execute()) {
                    header('Location: login.php');
                } else {
                    echo '<script type="text/javascript">alert(" Try again ! ")</script>';
                }
            }
        }else{
            echo '<script type="text/javascript">alert(" Please fill in username and password ! ")</script>';
        }
    }
    ?>
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100 p-l-85 p-r-85 p-t-55 p-b-55">
                <form class="login100-form validate-form flex-sb flex-w" method="POST" role="form">
                    <span class="login100-form-title p-b-32">
                        Account Register
                    </span>
                    <span class=" txt1 p-b-11">
                        Username
                    </span>
                    <div class="wrap-input100 validate-input m-b-36" data-validate="Username is required">
                        <input id="username" name="username" type="text" class="input100 form-control" >
                        <span class="focus-input100"></span>
                    </div>
                    <span class=" txt1 p-b-11">
                        Password
                    </span>
                    <div class="wrap-input100 validate-input m-b-36" data-validate="Password is required">
                        <span class="btn-show-pass">
                            <i class="fa fa-eye"></i>
                        </span>
                        <input id="password" name="password"  type="password" class="input100 form-control" >
                        <span class="focus-input100"></span>
                    </div>
                    <span class=" txt1 p-b-11">
                        Phone Number
                    </span>
                    <div class="wrap-input100 validate-input m-b-36" >
                        <input id="phonenumber" name="phonenumber" type="text" class="input100 form-control" >
                        <span class="focus-input100"></span>
                    </div>
                    <span class=" txt1 p-b-11">
                        Address
                    </span>
                    <div class="wrap-input100 validate-input m-b-36" >
                        <input id="address" name="address" type="text" class="input100 form-control" >
                        <span class="focus-input100"></span>
                    </div>
                    <div class="flex-sb-m w-full p-b-48">
                        <div>
                            <p class="txt3">
                                Already have an account?
                                <a href="login.php" class="txt3">
                                    Sign in 
                                </a>
                                here
                        </div>
                    </div>
                    <div class="d-flex justify-content-center container-login100-form-btn">
                        <button class="login100-form-btn" type="submit" name="register">Register</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div id="dropDownSelect1"></div>

    <!--===============================================================================================-->
    <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/animsition/js/animsition.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/bootstrap/js/popper.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/select2/select2.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/daterangepicker/moment.min.js"></script>
    <script src="vendor/daterangepicker/daterangepicker.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/countdowntime/countdowntime.js"></script>
    <!--===============================================================================================-->
    <script src="js/main.js"></script>

</body>

</html>