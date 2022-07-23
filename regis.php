<?php 
    session_start();
    include "functions.php";

    if (isset($_SESSION["username"])) {
        header("Location: login.php");
    }

    if (isset($_POST["register"])) {
        $username = strtolower(stripslashes($_POST["username"]));
        $fname = strtolower(stripslashes($_POST["fname"]));
        $lname = strtolower(stripslashes($_POST["lname"]));
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $cpassword = mysqli_real_escape_string($conn, $_POST['cpassword']);
        $email = htmlspecialchars($_POST["email"]);

        // cek username sudah ada atau belum
        $cekname = "SELECT username FROM user WHERE username = '$username'";
        $result = mysqli_query($conn, $cekname);
        $row = mysqli_fetch_assoc($result);

        // jika tidak muncul username nya
        if (!$row) {
            // maka cek apakah password sama dengan confirm password
            if ($cpassword != $password) {
                $errmsg = "<p style='color:red; font-style:italic;'>Password Salah!</p>";
            }
            // Enkripsi password
            $password = password_hash($password, PASSWORD_DEFAULT);
            // Masukkan data
            $added = addData("INSERT INTO user VALUES ('', '$username', '$password', '$fname', '$lname', '$email')");
        }else  {
            echo "
                <script>
                    alert('Whoopss Username sudah ada!');
                </script>
            ";
        }
        mysqli_error($conn);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/regis.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous" />
    <link rel="stylesheet" href="assets/index.css">
    <!-- Other Link -->
    <link href="fontawesome-free-5.15.4-web/css/all.css" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;500;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <title>Sign Up!</title>
</head>
<body>
    <div class="container-fluid">
        <div class="form-input-regis mx-auto p-4" data-aos="fade-up" data-aos-duration="1500">
            <?php if (isset($added)) : ?>
                <p class="alert alert-success">Data Telah Ditambahkan</p>
            <?php endif; ?>
            <div class="modal-header d-flex justify-content-between">
                <a href="index.php">
                    <i class="fas fa-graduation-cap h4" style="color: #000000;"></i>
                </a>
                <p class="h4">Register Now</p>
            </div>
            <div class="modal-body">
                <?php if(isset($added)) : ?>
                    <p class="alert alert-succcess">Data Telah Ditambahkan</p>
                <?php endif; ?>
                <form action="" method="post">
                    <label for="username">Username *</label>
                    <input type="text" name="username" id="username" class="form-control" required>
            
                    <label for="fname">First Name *</label>
                    <input type="text" name="fname" id="fname" class="form-control" required>
                    
                    <label for="lname">Last Name *</label>
                    <input type="text" name="lname" id="lname" class="form-control" required>
                    
                    <label for="password">Password *</label>
                    <input type="password" name="password" id="password" class="form-control" required>
                    <?php if(isset($errmsg)){
                        echo $errmsg;
                    }?>
                    <label for="cpassword">Confirm Password *</label>
                    <input type="password" name="cpassword" id="cpassword" class="form-control" required>
                        
                    <label for="email">Email *</label>
                    <input type="email" name="email" id="email" class="form-control" required>

                    <div class="button-link d-flex justify-content-between">
                        <a href="index.php" class="text-decoration-none m-2">Sudah ada akun?</a>
                        <button type="submit" name="register" class="btn btn-outline-dark">Register Now</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
      AOS.init();
    </script>
</body>
</html>