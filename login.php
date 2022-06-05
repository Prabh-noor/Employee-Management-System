<?php
require_once('database.php');
$database= new Database();
if(isset($_POST['login'])){
    if(!empty($_POST['email'] && $_POST['password'])){
        $email= $_POST['email'];
        $password= $_POST['password'];
        $database->loginUser($email, $password);
    }
    else if(empty($_POST['email'])){
        $error= "Username is required!";
    }
    else if(empty ($_POST['password'])){
        $error= "Password is required!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="assets/bootstrap-5.2.0/css/bootstrap.css">
    <script src="assets/jquery/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <?php if (isset($_GET['error'])) { ?>
        <div id="flash-msg" class="alert alert-warning alert-dismissible d-flex fade show" role="alert">
                <?php echo $_GET['error']; ?>
            <button type="button" class="close btn btn-outline-dark btn-sm" onclick="closeMsg()" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php }else if(isset($error)){ ?>
        <div id="flash-msg" class="alert alert-warning alert-dismissible d-flex fade show" role="alert">
                <?php echo $error; ?>
            <button type="button" class="close btn btn-outline-dark btn-sm" onclick="closeMsg()" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php } ?>

    <div class="container">
        <div class="left">
            <div class="login-header">
                <h2 class="animation a1">Welcome Back</h2>
                <h4 class="animation a2">Log in to your account using email and password</h4>
            </div>
            <div class="form">
                <form action="login.php" method="post" id="login">
                    <input type="email" name="email" class="form-field animation a3" placeholder="Email Address">
                    <input type="password" name="password" class="form-field animation a4" placeholder="Password">
                    <button class="animation a5" type="submit" name="login" value="login">LOGIN</button>
                </form>
            </div>
        </div>
        <div class="right"></div>
    </div>
    <!-- Bootstrap Popper -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
    <!-- Custom js -->
    <script src="assets/js/app.js"></script>
</body>
</html>