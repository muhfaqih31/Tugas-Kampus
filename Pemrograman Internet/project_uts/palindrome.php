<?php
     // inisiasi session
     session_start();

     // Periksa jika user sudah login
     if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
         header("location: login.php");
         exit;
     }


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $kalimat = trim($_POST["kalimat"]);

        $isian_err = $kalimat_balik = $status = "";

        if (empty($kalimat)) {
            $isian_err = "Harap isi form!";
        }


        if (empty($isian_err)) {
            $panjang_kata = strlen($kalimat);

            for ($i = $panjang_kata; $i >= 0; --$i) {

                $kalimat_balik = $kalimat_balik .  $kalimat[$i];
            }

            if ($kalimat === $kalimat_balik) {
                $status = "Kalimat merupakan palindrome!";
            } else {
                $status = "Kalimat bukan merupakan palindrome!";
            }
        }
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

    <!-- Vanila CSS -->
    <link rel="stylesheet" href="styles/style.css">

    <title>Palindrome</title>
</head>

<body>

    <section id="top-bar" class="colored-section">
        <div class="container-fluid">
            <nav class="navbar navbar-expand-lg navbar-dark">

                <a class="navbar-brand" href="#">
                    <?php echo htmlspecialchars($_SESSION['username']); ?></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="read_file.php">File Reader</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="palindrome.php">Palindrome</a>
                        </li>
                        <!--
                        <li class="nav-item">
                        <a class="nav-link" href="#articles">Articles</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="#education">Educations</a>
                        </li> -->
                        <li class="nav-item">
                            <a href="reset-password.php" class="btn btn-warning">Ganti Password</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-danger ml-3" href="logout.php">Logout</a>
                        </li>

                    </ul>

                </div>

            </nav>

            <div class="container">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-lg-12 col-xl-11">
                        <div class="card text-black" style="border-radius: 25px;">
                            <div class="card-body p-md-5">
                                <div class="row justify-content-center">
                                    <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                                        <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Palindrome</p>

                                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="mx-1 mx-md-4">

                                            <div class="d-flex flex-row align-items-center mb-4">
                                                <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                                <div class="form-outline flex-fill mb-0">
                                                    <?php
                                                    if (!empty($isian_err)) {
                                                        echo '<div class="alert alert-danger">' . $isian_err . '</div>';
                                                    }

                                                    ?>
                                                    <label class="form-label" for="form3Example1c">Masukkan teks:</label>
                                                    <input name="kalimat" type="text" id="form3Example1c" class="form-control" value="<?php echo $kalimat; ?>" />
                                                    <p class="mt-4 text-center"><?php echo "$kalimat_balik<br>$status"; ?></p>
                                                    
                                                </div>
                                            </div>


                                            <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                                <input type="submit" class="btn btn-primary btn-lg" value="Cek">
                                            </div>

                                        </form>

                                    </div>
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