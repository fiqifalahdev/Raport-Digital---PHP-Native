<?php 
  session_start();
  require "functions.php";
  $takeID = $_SESSION["id"];
  if (!isset($_SESSION["sessionID"])) {
    header("Location: profilpage.php");
  }else {
    $sessID = $_SESSION["sessionID"];
  }

  // tampilkan query untuk table status kelas
  $result = show("SELECT R.*, DK.namakelas FROM raport as R, daftarkelas as DK WHERE DK.idkelas = R.idkelas AND R.idguru = $sessID");

  if (empty($result)) {
    $added = addData("INSERT INTO raport (`idguru`, `idMapel`, `idKelas`) SELECT idguru, idmapel, idkelas FROM kelas WHERE idguru = $sessID");
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />

    <!-- Other Link -->
    <link rel="stylesheet" href="assets/styleDashboard.css" />
    <link href="fontawesome-free-5.15.4-web/css/all.css" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;700&display=swap" rel="stylesheet" />

    <title>Dashboard</title>
  </head>
  <body>
    <?php 
      include "sidebar.php";
    ?>
    <!-- Start of content -->
    <div class="container-fluid startingContent d-flex align-items-center">
      <div class="container card table-responsive forTable d-flex justify-content-center d-flex align-items-center flex-wrap">
        <div class="card-body tableWrap">
          <div class="header d-flex justify-content-between">
            <p class="h3"><i class="fas fa-chalkboard-teacher"></i> Status Kelas Anda</p>
          </div>
          <hr />
          <?php if (isset($added)) : ?>
            <p class="alert alert-success">Data Telah Ditambahkan</p>
          <?php endif; ?>
          <?php if (isset($fulled)) : ?>
            <p class='alert alert-warning'>Anda Hanya mengajar 2 Kelas<p>
          <?php endif; ?>
          <div class="tbl">
            <table class="table table-bordered table-striped table-hover" style="text-align: center">
              <thead>
                <tr>
                  <th rowspan="2" scope="col">Kelas</th>
                  <th colspan="3" scope="col">
                    Status nilai
                    <tr>
                      <th scope="col">Pengetahuan</th>
                      <th scope="col">Keterampilan</th>
                    </tr>
                  </th>
                </tr>
              </thead>
              <tbody class="table-light">
                <?php foreach($result as $list => $value) : ?>
                  <tr>
                    <td>
                      <a href="kelas.php?kelas=<?= $value["namakelas"]; ?>|<?= $value["idKelas"]; ?>"><?= $value["namakelas"]; ?></a>
                    </td>
                    <td><?php
                    if ($value["status_pengetahuan"] == 0) {
                      echo $not = "Belum Terkirim";
                    }else {
                      echo $send =  "Terkirim";
                    }
                    ?></td>
                    <td><?php
                    if ($value["status_keterampilan"] == 0) {
                      echo $not = "Belum Terkirim";
                    }else {
                      echo $send =  "Terkirim";
                    }
                    ?></td>
                  </tr>
                <?php endforeach;?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <!-- end of content -->
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <!-- Other Javascript -->
    <!-- script link kelas -->
    <script>
      let tbl = document.querySelector("table");
      let a = tbl.getElementsByTagName("a");

      for (let i = 0; i < a.length; i++) {
        a[i].style.textDecoration = "none";
        a[i].style.color = "black";
      }

      // AJAX SCRIPT
      // let table = document.querySelector(".tbl");
      // let value = document.querySelector(".input-group .form-select");
      // var xmlHttp = new XMLHttpRequest();
      // xmlHttp.onreadystatechange = function() {
      //   if (this.readyState == 4 && this.status == 200) {
      //     table.innerHTML = this.responseText;
      //   }
      // };
      // xmlHttp.open("GET","ajax/getclass.php?value=" + value.value,true);
      // xmlHttp.send();

    </script>
  </body>
</html>
