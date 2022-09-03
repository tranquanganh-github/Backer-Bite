<?php session_start(); ?>
<?php include 'config/connect.php'; 
    if(isset($_SESSION['user_login'])){
        echo '<script type="text/javascript">alert(" You already login ")</script>';
        header('Location: index.php?f=main&file=main');
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="images/icons/favicon.ico" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="./vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="./Admin/css/main.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="./Admin/css/util.css"> 
    <!--===============================================================================================-->
</head>

<body>
    <?php
    if (isset($_POST['login'])) {
        $username = htmlspecialchars($_POST['username']);
        $password = htmlspecialchars($_POST['password']);
        
        if (!empty($username) and !empty($password)) {
            $sql = "SELECT * FROM users WHERE username = :username AND password = :password AND role = 0";
            $statement = $conn->prepare($sql);
            $statement->bindParam(':username', $username);
            $statement->bindParam(':password', $password);
            $statement->execute();
            $user = $statement->fetch(PDO::FETCH_ASSOC);
            if (!empty($user)) {
                $user_login = [
                    'id' => $user['id'],
                    'username' => $user['username'],
                    'password' => $user['password'],
                    'phoneNumber' => $user['phoneNumber'],
                    'address' => $user['address']
                ];
                $_SESSION['user_login'] = $user_login;
                header('Location: index.php?f=main&file=main');
            } else {
                echo '<script type="text/javascript">alert(" Wrong Username or Password ")</script>';
            }
        }
    }
    ?>
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100 p-l-85 p-r-85 p-t-55 p-b-55">
                <form class="login100-form validate-form flex-sb flex-w" method="POST" role="form">
                    <span class="login100-form-title p-b-32">
                        Account Login
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
                    <div class="wrap-input100 validate-input m-b-12" data-validate="Password is required">
                        <span class="btn-show-pass">
                            <i class="fa fa-eye"></i>
                        </span>
                        <input id="password" name="password"  type="password" class="input100 form-control" >
                        <span class="focus-input100"></span>
                    </div>
                    <div class="flex-sb-m w-full p-b-48">
                        <div>
                            <a href="changePassword.php" class="txt3">
                                Forgot Password?
                            </a>
                        </div>
                        <div>
                            <p class="txt3">
                                Don't have an account?
                                <a href="register.php" class="txt3">
                                    Sign up
                                </a>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center container-login100-form-btn">
                        <button class="login100-form-btn" type="submit" name="login" onclick="lsRememberMe()">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div id="dropDownSelect1"></div>

    <!--===============================================================================================-->
    <script src="./vendor/jquery/jquery-3.2.1.min.js"></script>
    <!--===============================================================================================-->
    <script src="./vendor/animsition/js/animsition.min.js"></script>
    <!--===============================================================================================-->
    <script src="./vendor/bootstrap/js/popper.js"></script>
    <script src="./vendor/bootstrap/js/bootstrap.min.js"></script>
    <!--===============================================================================================-->
    <script src="./vendor/select2/select2.min.js"></script>
    <!--===============================================================================================-->
    <script src="./vendor/daterangepicker/moment.min.js"></script>
    <script src="./vendor/daterangepicker/daterangepicker.js"></script>
    <!--===============================================================================================-->
    <script src="./vendor/countdowntime/countdowntime.js"></script>
    <!--===============================================================================================-->
    <script src="./js/main.js"></script>

</body>

</html>