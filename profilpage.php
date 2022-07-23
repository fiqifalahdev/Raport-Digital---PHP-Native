<?php
  session_start();
  require "functions.php";
  
  $takeID = $_SESSION["id"];
  if($takeID == null) {
    header("Location: index.php");
  }

  
  $row = show("SELECT * FROM guru WHERE iduser = $takeID");
  if (empty($row)) {
    $error = "<p class='alert alert-danger' role='alert'>Masukkan Data terlebih dahulu</p>";
  }else { 
      foreach ($row as $newRow) {
        $nip = $newRow["nip"];
        $fullname = $newRow["fullname"];
        $date = $newRow["tanggallahir"];
        $gender = $newRow["gender"];
        $_SESSION['sessionID'] = $newRow["nip"];
      }
    }
    mysqli_error($conn);
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />

    <!-- CSS Link -->
    <link rel="stylesheet" href="assets/styleProfile.css" />
    <!-- Font Link -->
    <link href="fontawesome-free-5.15.4-web/css/all.css" rel="stylesheet" />
    <!-- Google Link -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;700&display=swap" rel="stylesheet" />

    <title>Profile Page</title>
  </head>
  <body>
    <?php
      require "sidebar.php";
    ?>
    <!-- Start of content -->
    <div class="container-fluid startingContent d-flex justify-content-center align-items-center flex-column">
      <div class="wrapProfile p-3">
        <div class="userImage my-lg-4 d-flex justify-content-center">
          <img src="assets/img/PP.jpg" alt="userImage" class="img-fluid border rounded-circle border-1 border-dark" />
        </div>
        <div class="userData">
          <div class="list-group list-group-flush">
            <div class="list-group-item d-flex justify-content-between">
              <p>NIP</p>
              <p>
              <?php
                if(empty($nip)){
                  echo $error;
                }else{
                  echo $nip;
                };
              ?>
              </p>
            </div>
            <div class="list-group-item d-flex justify-content-between">
              <p>Nama</p>
              <p>
              <?php
                if(empty($fullname)){
                  echo $error;
                }else{
                  echo $fullname;
                };
              ?>
              </p>
            </div>
            <div class="list-group-item d-flex justify-content-between">
              <p>Tanggal Lahir</p>
              <p>
              <?php
                if(empty($date)){
                  echo $error;
                }else{
                  echo $date;
                };
              ?>
              </p>
            </div>
            <div class="list-group-item d-flex justify-content-between">
              <p>Jenis Kelamin</p>
              <p>
              <?php
                if(empty($gender)){
                  echo $error;
                }else{
                  echo $gender;
                };
              ?></p>
            </div>
          </div>
        </div>
        <a href="addprofiledata.php" class="btn btn-outline-info ms-3">Edit Data Anda</a>
        <a href="addclass.php" class="btn btn-outline-success ms-3">Edit Data Kelas</a>
      </div>
    </div>
    <!-- End of content -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <!-- Other Javascript -->
  </body>
</html>