<?php
// inisiasi session
session_start();

// Periksa jika user sudah login
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
  header("location: login.php");
  exit;
}

if (isset($_FILES['berkas'])) {
  $file_name = $_FILES['berkas']['name'];
  $file_size = $_FILES['berkas']['size'];
  $file_tmp = $_FILES['berkas']['tmp_name'];
  $file_type = $_FILES['berkas']['type'];
  $file_ext = strtolower(end(explode('.', $_FILES['berkas']['name'])));


  $path = "/opt/lampp/temp/uploaded/$file_name";

  $upload_err = $read_err = "";
  $upload_succ = "";

  $jenis_file = substr($file_type, 0, 4) == "text";

  if ($file_size > 2000000) {
    $upload_err = "File harus 2MB!";
  } elseif ($file_size == 0) {
    $upload_err = "Anda belum memilih file!";
  }


  if (empty($upload_err) && ($jenis_file)) {
    move_uploaded_file($file_tmp, $path);
    $upload_succ = "Sukses!";
  }

  if (!($jenis_file) && !empty($file_type)) {
    $read_err = "File bukan teks!";
  }

  if (substr($file_type, 0, 4) == "text") {

    $myfile = fopen("$path", "r") or die("Unable to open file!");
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Bootstrap CSS only -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <!-- JavaScript Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

  <!-- Vanila CSS -->
  <link rel="stylesheet" href="styles/style.css">

  <title>Read File</title>
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
              <a class="nav-link active" href="read_file.php">File Reader</a>
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
          <div class="col-xl-10">
            <div class="card rounded-3 text-black">
              <div class="row g-0">
                <div class="col-lg-12">
                  <div class="card-body p-md-5 mx-md-4">

                    <div class="text-center">
                      <!-- <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/lotus.webp"
                    style="width: 185px;" alt="logo"> -->
                      <h4 class="mt-1 mb-5 pb-1">Upload File</h4>
                    </div>

                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
                      <p>Mohon upload file anda</p>

                      <div class="form-outline mb-4">
                        <!-- <input type="email" id="form2Example11" class="form-control"
                      placeholder="Phone number or email address" />
                    <label class="form-label" for="form2Example11">Username</label> -->
                        <input type="file" name="berkas" class="<?php echo (!empty($upload_err) || !empty($read_err)) ? 'is-invalid' : ''; ?>" />
                        <span class="invalid-feedback"><?php echo "$upload_err" ?></span>
                        <span class="invalid-feedback"><?php echo "$read_err" ?></span>
                      </div>

                      <!-- <div class="form-outline mb-4">
                    <input type="password" id="form2Example22" class="form-control" />
                    <label class="form-label" for="form2Example22">Password</label>
                  </div> -->

                      <div class="pt-1 mb-5 pb-1">
                        <input type="submit" class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" type="button" value="Upload"></input>
                        <!-- <a class="text-muted" href="#!">Forgot password?</a> -->
                      </div>

                      <!-- <div class="d-flex align-items-center justify-content-center pb-4">
                    <p class="mb-0 me-2">Don't have an account?</p>
                    <button type="button" class="btn btn-outline-danger">Create new</button>
                  </div> -->

                    </form>

                  </div>

                </div>
              </div>
            </div>

            <div class="mt-4 card rounded-3 text-black">
              <div class="row g-0">

                <div class="col-lg-12 d-flex align-items-center gradient-custom-2">
                  <div class="px-3 py-4 p-md-5 mx-md-4">
                    <h4 class="mb-4">Hasil pembacaan teks</h4>
                    <ul>
                      <?php
                      if (empty($upload_err)) {
                        echo "<li>Sent file: " . $_FILES['berkas']['name'];
                        echo "<li>File size: " . $_FILES['berkas']['size'];
                        echo "<li>File type: " . $_FILES['berkas']['type'];
                      }
                      ?>

                    </ul>

                    <p><?php
                        while (!feof($myfile)) {
                          echo fgets($myfile) . "<br>";
                        }
                        fclose($myfile);

                        ?></p>
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