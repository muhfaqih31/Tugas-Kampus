<?php 
    // inisiasi sessions
    session_start();

    // cek jika sudah login
    if(!isset($_SESSION["username"]) || $_SESSION["loggedin"] !== true) {
        header("location: login.php");
        exit;
    }

    // masukkan config file 
    require_once 'config.php';

    // buat variabel kosong
    $password = $konfirmasi_password = "";
    $password_err = $konfirmasi_password_err = "";

    // proses ketika submit 
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        // validasi password baru
        if(empty(trim($_POST["password"]))) {
            $password_err = "Mohon masukkan password baru.";
        }

        elseif(strlen(trim($_POST["password"])) < 8) {
            $password_err = "Password harus lebih dari 8 karakter.";
        }

        else {
            $password = trim($_POST["password"]);
        }

        // validasi konfirmasi password baru
        if(empty(trim($_POST["konfirmasi_password"]))) {
            $konfirmasi_password_err = "Mohon konfirmasi password baru.";
        }

        else {
            $konfirmasi_password = trim($_POST["konfirmasi_password"]);
            if (empty($password_err) && ($password != $konfirmasi_password)) {
                $konfirmasi_password_err = "Password tidak sama.";
            }
        }

        // periksa error sebelum dimasukkan database
        if(empty($password_err) && empty($konfirmasi_password_err)) {
            // menyiapkan statement update
            $sql = "UPDATE users SET password = ? WHERE id = ?";

            if($stmt = mysqli_prepare($link, $sql)) {
                $param_password = password_hash($password, PASSWORD_DEFAULT);
                $param_id = $_SESSION["id"];

                // bind password
                mysqli_stmt_bind_param($stmt, "si", $param_password, $param_id);

                // eksekusi statement yang sudah disiapkan
                if(mysqli_stmt_execute($stmt)) {
                    header("location: login.php");
                    session_destroy();
                    exit();
                }

                else {
                    echo "Oops! Terjadi kesalahan. Mohon coba lagi nanti.";
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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ganti password</title>

    <!-- bootstrap -->
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</head>
<body>
<div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-lg-12 col-xl-11">
                    <div class="card text-black" style="border-radius: 25px;">
                        <div class="card-body p-md-5">
                            <div class="row justify-content-center">
                                <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                                    <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Ganti Password</p>
                                    <?php 
                                        if(!empty($login_err)){
                                            echo '<div class="alert alert-danger">' . $login_err. '</div>';
                                        }
                                    
                                    ?>
                                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" class="mx-1 mx-md-4">
                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <label class="form-label" for="form3Example4c">Password</label>
                                                <input name="password" type="password" id="form3Example4c" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : '';?>" value="<?php echo $password;?>"/>
                                                <span class="invalid-feedback"><?php echo "$password_err";?></span>
                                            </div>
                                        </div>

                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <label class="form-label" for="form3Example1c">Konfirmasi Password</label>
                                                <input name="konfirmasi_password" type="password" id="form3Example1c" class="form-control <?php echo (!empty($konfirmasi_password_err)) ? 'is-invalid' : ''; ?>" />
                                                <span class="invalid-feedback"><?php echo "$konfirmasi_password_err";?></span>
                                            </div>
                                        </div>


                                        <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                            <input type="submit" class="btn btn-primary btn-lg" value="Ganti">
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