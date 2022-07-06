<?php 
    // inisiasi session
    session_start();

    // Periksa jika user sudah login
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
        header("location: login.php");
        exit;
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project UTS</title>
     <!-- bootstrap -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Vanila CSS -->
    <link rel="stylesheet" href="styles/style.css">

    <script src="scripts/waktu.js"></script>
    
</head>
<body onload="init()">
  <section id="top-bar" class="colored-section">
    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg navbar-dark">

            <a class="navbar-brand" href="#">
            <?php echo htmlspecialchars($_SESSION['username']);?></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">

              <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="read_file.php">File Reader</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="palindrome.php">Palindrome</a>
                </li>
                <!--
                <li class="nav-item">
                  <a class="nav-link" href="#articles">Articles</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#education">Educations</a>
                </li> -->
                <li class="nav-item">
                  <a href="reset-password.php" class="mb-2 btn btn-warning">Ganti Password</a>
                </li>
                <li class="nav-item">
                  <a class="btn btn-danger ml-3" href="logout.php">Logout</a>
                </li>

              </ul>

            </div>
        </nav>

        <div class="jam text-center" id="waktu">00:00:00</div>
        <div id="jenis_waktu" class="text-center"></div>
    </div>

  </section>
</body>
</html>