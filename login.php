<?php 
  session_start();
  include "config.php";

  if (isset($_COOKIE["keyname"]) && isset($_COOKIE["id"])) {
    $keyname = $_COOKIE["keyname"];
    $id = $_COOKIE["id"];

    $result = mysqli_query($conn, "SELECT username FROM user WHERE id = $id");
    $row = mysqli_fetch_assoc($result);

    if ($keyname === hash("ripemd160", $row["username"])) {
      $_SESSION["username"] = true;
    }
  }
  
  if (isset($_SESSION["username"])) {
    header("Location: dashboard.php");
    exit;
  }

  // login
  if (isset($_POST["login"])) {
    // ambil inputan
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);
    
    // panggil row dimana username sama dengan inputan username dari table
    $query = "SELECT * FROM user WHERE username = '$username'";
    $result = mysqli_query($conn, $query);

    // cek row yang muncul jika satu maka fetch menjadi array associative
    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        $verify = password_verify($password, $row["password"]);
        
        $_SESSION["username"] = $row["username"];
        $_SESSION["id"] = $row["id"];

        if (isset($_POST["checkbox"])) {
          setcookie("id", $row["id"], time() + 86400);
          setcookie("keyname", hash("ripemd160", $row["username"]), time() + 120);
        }

        // cek password menggunakan password verify kemudian redirect
        if($verify){
          header("Location: dashboard.php");
        }
    }else{
      $wrongpw = true;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/login.css">
    <!-- Other Link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous" />
    <link href="fontawesome-free-5.15.4-web/css/all.css" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;500;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <title>Login Page</title>
</head>
<body>
    <!-- Awal Pop Up login -->
    <div class="container-fluid popupWrapper" id="popupWrapper">
      <div class="modalContent p-4" data-aos="fade-up" data-aos-duration="1500">
        <div class="modalHead">
          <div class="title d-flex justify-content-between p-3">
            <a href="index.php">
              <i class="fas fa-graduation-cap h4" style="color: #000000;"></i>
            </a>
          </div>
        </div>
        <div class="modalBody mt-1">
          <p class="h4">Masuk</p>
          <?php if(isset($wrongpw)): ?>
            <p style="color: red; font-style:italic;" class="alert alert-danger">Username / Password salah</p>
          <?php endif;?>
          <form action="" method="post">
            <label for="username">Username</label>
            <input type="text" class="form-control" name="username" id="username" required>
            <label for="password">Password</label>
            <input type="password" class="form-control" name="password" id="password" required>

            <div class="regisLink my-3 d-flex justify-content-between">
              <div class="checkbox-wrap">
                <input type="checkbox" name="checkbox" id="checkbox">
                <label for="checkbox">Remember Me</label>
              </div>
              <a href="regis.php">Belum ada akun?</a>
            </div>
            <div class="row px-5">
              <button type="submit" class="btn btn-primary buttonLogin" name="login">Log In</button>
            </div>
            <div class="or row my-3 text-center">
              <div class="col-md-3">
                <span><hr></span>
              </div>
              <div class="col-md-6">
                <p>atau masuk dengan</p>
              </div>
              <div class="col-md-3">
                <span><hr></span>
              </div>
            </div>
            <div class="row mb-2 px-5 sosmedbtn">
              <button type="button" class="btn btn-dark googleButton d-flex justify-content-center">
                <img src="assets/img/icons8-google.svg" alt="icon-ggl">
                <p class="text-center">Google</p>
              </button>
            </div>
          </form>
        </div>
      </div>
      </div>
    <!-- akhir popup Login -->
    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
      AOS.init();
    </script>
</body>
</html>