<?php 
    // inisiasi session
    session_start();

    // periksa jika sudah login, jika ya redirect ke page utama
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
        header("location: index.php");
        exit;
    }

    // include config file
    require_once "config.php";

    // definisikan variabel dan isi dengan variabel kosong
    $username = $password = "";
    $username_err = $password_err = $login_err = "";

    // proses data login
    if($_SERVER["REQUEST_METHOD"] == "POST") {

        //validasi username
        if(empty(trim($_POST["username"]))) {
            $username_err = "Mohon masukkan username.";
        } 

        else {
            $username = trim($_POST["username"]);
        }

        // validasi password
        if(empty(trim($_POST["password"]))) {
            $password_err = "Mohon masukkan password.";
        }

        else {
            $password = trim($_POST["password"]);
        }

        // validasi credential
        if(empty($username_err) && empty($password_err)) {
            $sql = "SELECT id, username, password FROM users WHERE username = ?";


            if($stmt = mysqli_prepare($link, $sql)) {

                // bind statement 
                mysqli_stmt_bind_param($stmt, "s", $param_username);

                // set param_usename
                $param_username = $username;

                // eksekusi statement
                if(mysqli_stmt_execute($stmt)) {
                    // Simpan hasil
                    mysqli_stmt_store_result($stmt);

                    // periksa jika usenama sudah ada
                    // jika sudah ada, periksa password
                    if(mysqli_stmt_num_rows($stmt) == 1) {
                        // bind hasil variabel
                        mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);

                        if(mysqli_stmt_fetch($stmt)) {
                            if(password_verify($password, $hashed_password)) {
                                // Password bener start session
                                session_start();

                                // simpan data di variabel session
                                $_SESSION["loggedin"] = true;
                                $_SESSION["id"] = $id;
                                $_SESSION["username"] = $username;

                                // arahkan user ke index.php
                                header("location: index.php");
                            }

                            else {
                                $login_err ="Username atau password salah.";
                            }
                        }
                    }

                    else {
                        $login_err ="Username atau password salah.";
                    }
                }

                else {
                    echo "Oops! terjadi kesalahan. Mohon coba lagi nanti.";
                }

                mysqli_stmt_close($stmt);
                
            }
        }

        mysqli_close($link);
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 360px; padding: 20px; }
    </style>
</head>
<body>
<section class="vh-100" style="background-color: #eee;">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-lg-12 col-xl-11">
                    <div class="card text-black" style="border-radius: 25px;">
                        <div class="card-body p-md-5">
                            <div class="row justify-content-center">
                                <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                                    <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Login</p>
                                    <?php 
                                        if(!empty($login_err)){
                                            echo '<div class="alert alert-danger">' . $login_err. '</div>';
                                        }
                                    
                                    ?>
                                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" class="mx-1 mx-md-4">

                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <label class="form-label" for="form3Example1c">Username</label>
                                                <input name="username" type="text" id="form3Example1c" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>"  value="<?php echo $username;?>"/>
                                                <span class="invalid-feedback"><?php echo "$username_err"?></span>
                                            </div>
                                        </div>

                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <label class="form-label" for="form3Example4c">Password</label>
                                                <input name="password" type="password" id="form3Example4c" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>"/>
                                                <span class="invalid-feedback"><?php echo "$password_err"?></span>
                                                <p class="mt-2">Don't have an account? <a href="register.php">Sign up now</a>.</p>
                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                            <input type="submit" class="btn btn-primary btn-lg" value="Login">
                                        </div>

                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>    
</body>
</html>