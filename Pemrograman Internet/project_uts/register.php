<?php
// memasukkan file config.php
require_once "config.php";

// definisikan variabel dan isi dengan variabel kosong
$username = $password = $konfirmasi_password = "";
$username_err = $password_err = $konfirmasi_password_err = "";

// Proses data ketika submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // validasi username
    if (empty(trim($_POST["username"]))) {
        $username_err = "Mohon masukkan username.";
    } elseif (!preg_match(
        '/^[a-zA-Z0-9_]+$/',
        trim($_POST["username"])
    )) {
        $username_err = "Username hanya bisa terdiri dari huruf, angka, dan garis bawah.";
    } else {
        // menyiapkan select statement
        $sql = "SELECT id FROM users WHERE username = ?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Hubungkan variabel ke statement yang sudah disiapkan sebagai parameter
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // set parameter
            $param_username = trim($_POST["username"]);

            // coba eksekusi statement
            if (mysqli_stmt_execute($stmt)) {
                // simpan hasil
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $username_err = "Username sudah dipakai.";
                } 
                
                else {
                    $username = trim($_POST["username"]);
                }
            } 
            
            else {
                echo "Oops! Terjadi kesalahan. Mohon coba lagi nanti.";
            }
            mysqli_stmt_close($stmt);
        }
    }

    // Validasi password
    if (empty($_POST["password"])) {
        $password_err = "Mohon masukkan password.";
    } 
    
    elseif (strlen(trim($_POST["password"])) < 8) {
        $password_err = "Password harus paling sedikit 8 karakter.";
    } 
    
    else {
        $password = trim($_POST["password"]);
    }

    // Validasi konfirmasi password
    if (empty($_POST["konfirmasi_password"])) {
        $konfirmasi_password_err = "Mohon konfirmasi password.";
    } 
    
    else {
        $konfirmasi_password = trim($_POST["konfirmasi_password"]);
        if (empty($password_err) && ($password != $konfirmasi_password)) {
            $konfirmasi_password_err = "Password tidak sama.";
        }
    }

    // periksa error sebelum dimasukkan ke database
    if (empty($username_err) && empty($password_err) && empty($konfirmasi_password_err)) {

        // Siapin statement insert SQL
        $sql = "INSERT INTO users (username,password) VALUE (?, ?)";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Hubungkan variabel ke statement yang sudah disiapkan sebagai parameter
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);

            // set parameter 
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // CREATES PASSWORD HASH

            // Coba eksekusi statement yang sudah disiapkan
            if (mysqli_stmt_execute($stmt)) {
                // Redirect to login page
                header("location: login.php");
            } 
            
            else {
                echo "Oops! Terjadi kesalahan. Mohon coba lagi nanti.";
            }
            
            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Close connection 
    mysqli_close($link);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <title>Daftar</title>
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

                                    <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Daftar</p>
                                    <p class="text-center mb-5 mx-1 mx-md-4 mt-4">Mohon isi form untuk mendaftar.</p>
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
                                                <input name="password" type="password" id="form3Example4c" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password;?>"/>
                                                <span class="invalid-feedback"><?php echo "$password_err"?></span>
                                            </div>
                                        </div>

                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <label class="form-label" for="form3Example4cd">Ulangi password</label>
                                                <input name="konfirmasi_password" type="password" id="form3Example4cd" class="form-control <?php echo (!empty($konfirmasi_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $konfirmasi_password;?>" />
                                                <span class="invalid-feedback"><?php echo "$konfirmasi_password_err"?></span>
                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                            <input type="submit" class="btn btn-primary btn-lg" value="Register">
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