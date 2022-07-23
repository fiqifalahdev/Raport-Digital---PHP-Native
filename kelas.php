<?php 
  session_start();
  require 'functions.php';
  $sessID = $_SESSION["sessionID"];
  $class = $_GET["kelas"];
  $class = explode("|", $class);
  $classname = current($class);
  $classID = end($class);  

    // cek apakah tombol submit sudah dipencet atau belum
    if (isset($_POST["submitxls"])) {
      // inisialisasi variable
      $filename = $_FILES["xls"]["name"];
      $fileExtension = explode(".", $filename);
      $fileExtension = strtolower(end($fileExtension));
      $fileData = $_FILES["xls"]["tmp_name"];
  
      $targetDirectory = "uploads/". $filename;
      move_uploaded_file($fileData, $targetDirectory);
  
      error_reporting(0);
      ini_set('display_errors', 0);
      
      // panggil excelreader
      require "excelReader/SpreadsheetReader.php";
  
      $reader = new SpreadsheetReader($targetDirectory);
      foreach ($reader as $item => $value) {
        $nrp = $value[0];
        $name = $value[1];
        $gender = $value[2];
  
       $added = mysqli_query($conn, "INSERT INTO `siswa` (`idsiswa`, `namasiswa`, `gender`, `idkelas`, `namakelas`) VALUES ('$nrp', '$name', '$gender', '$classID', '$classname')");
      }
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

    <!-- CSS Link -->
    <link rel="stylesheet" href="assets/styleKelas.css" />
    <!-- Font Link -->
    <link href="fontawesome-free-5.15.4-web/css/all.css" rel="stylesheet" />
    <!-- Google Link -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;700&display=swap" rel="stylesheet" />

    <title><?= $classname ?></title>
  </head>
  <body>
    <?php require "sidebar.php";?>
    <!-- Start of Content -->
    <div class="container-fluid kelasContent">
      <div class="row">
        <div class="col-md-12 mb-3">
          <div class="kelasDetails p-3 my-lg-4">
            <div class="card">
              <div class="card-header d-flex justify-content-between">
                <div class="rincian">
                  <p class="h4">Rincian Kelas</p>
                  <p class="h6"><?= $classname; ?></p>
                </div>
                <div class="back">
                  <a href="dashboard.php">
                    <button type="button" class="btn btn-danger">Kembali</button>
                </a>
                </div>
              </div>
              <div class="card-body">
                <ul class="list-group list-group-flush">
                  <?php 
                  $query = "SELECT * FROM kelas WHERE idkelas = $classID AND idguru = $sessID";
                  $rows = show($query);
                  ?>
                    <?php foreach($rows as $row) : ?>
                    <li class="list-group-item d-flex justify-content-between d-flex align-items-center flex-wrap">
                      <p class="h6">Wali Kelas</p>
                      <p class="h6 text-info fw-bold"><?= $row["namaguru"];?></p>
                    </li>
                    <li class="list-group-item d-flex justify-content-between d-flex align-items-center flex-wrap">
                      <p class="h6">Mata Pelajaran</p>
                      <p class="h6 text-info fw-bold"><?= $row["namamapel"];?></p>
                    </li>
                    <li class="list-group-item d-flex justify-content-between d-flex align-items-center flex-wrap">
                      <p class="h6">Jumlah Siswa</p>
                      <p class="h6 text-info fw-bold">25</p>
                    </li>
                    <li class="list-group-item d-flex justify-content-between d-flex align-items-center flex-wrap">
                      <p class="h6">Tahun Pelajaran</p>
                      <p class="h6 text-info fw-bold"><?= $row["tahunpelajaran"];?></p>
                    </li>
                    <li class="list-group-item d-flex justify-content-between d-flex align-items-center flex-wrap">
                      <p class="h6">Semester</p>
                      <p class="h6 text-info fw-bold"><?= $row["semester"];?></p>
                    </li>
                    <?php endforeach; ?>
                </ul>
              </div>
            </div>
            <div class="table-navigation row d-flex justify-content-between p-3">
              <div class="col-auto button-wrap">
                <a href="nilaiPengetahuan.php?kelas=<?= $classname?>|<?= $classID; ?>" class="btn btn-secondary">Nilai Pengetahuan</a>
                <a href="nilaiKeterampilan.php?kelas=<?= $classname?>|<?= $classID;?>" class="btn btn-success">Nilai Keterampilan</a>
              </div>
              <div class="col-auto">
                <?php  
                  $rows = mysqli_query($conn, "SELECT idkelas FROM siswa WHERE idkelas = $classID;");                
                  if (mysqli_num_rows($rows) !== 0) {
                    $dnone = "d-none";
                  }
                ?>
                <!-- upload absensi siswa -->
                <form action="" method="post" class="form-input <?= $dnone; ?>" enctype="multipart/form-data">
                  <div class="input-group">
                    <input class="form-control m-auto" type="file" name="xls" id="xls">
                    <button type="submit" name="submitxls" class="btn btn-primary">Submit XLS/XLSX</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="kelasDetails p-3">
        <div class="card">
          <div class="card-header d-flex justify-content-between">
            <h2>Daftar Siswa</h2>
            <div class="student-nav d-flex">

              <?php 
                // berapa data yang ingin ditampilkan pada table
                $showedPage = 10;
                // berapa data yang ada di dalam 1 kelas
                $dataAmount = count(show("SELECT * FROM siswa WHERE idkelas = $classID")); // index ke 29
                // hitung berapa page jika yang ditampilkan hanya 10
                $pageAmount = ceil($dataAmount / $showedPage); // 3
                // buat active page jika sudah diset maka page = page itu sendiri, jika belum maka activepage = 1 
                // nanti akan ditaruh pada pagination nya
                $activePage = ( isset($_GET["page"]) ) ? $_GET["page"] : 1;
                // buat variable untuk menampung data akan ditampilkan pada index ke berapa dulu
                // misal : 
                //activepage -> 1 * 10 - 10 = 1 -> startdata = 1
                //activepage -> 2 * 10 - 10 = 10 -> startdata = 10
                //activepage -> 3 * 10 - 10 = 10 -> startdata = 20
                $startData = ($activePage * $showedPage) - $showedPage;
                # ambil data pada database dengan batasan LIMIT dari start data hingga data yang ingin ditampilkan ada berapa.
                $rows = show("SELECT * FROM `siswa` WHERE idkelas = $classID LIMIT $startData, $showedPage");

              ?>
              <div aria-label="pagination-navigation">
                <ul class="pagination">
                  <li class="page-item">
                    <!-- cek jika active page lebih dari satu maka tampilkan panah jika tidak maka hilangkan panah -->
                    <?php if($activePage > 1) : ?>
                      <a class="page-link" href="?kelas=<?=$classname?>|<?=$classID?>&page=<?= $activePage - 1;?>" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                      </a>
                    <?php else : ?>
                      <a class="page-link d-none" href="?kelas=<?=$classname?>|<?=$classID?>&page=<?= $activePage - 1;?>" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                      </a>
                    <?php endif; ?>
                  </li>
                  <!-- looping untuk pagination agar muncul berapa page yang dibuat. -->
                  <?php for ($i=1; $i <= $pageAmount ; $i++) : ?> 
                    <!-- untuk page nya sendiri diambil dengan method GET -->
                    <li class="page-item"><a class="page-link" href="?kelas=<?=$classname?>|<?=$classID?>&page=<?=$i?>"><?= $i;?></a></li>
                  <?php endfor;?>
                  <!-- cek jika active page kurang dari jumlah page maka tampilkan panah, jika tidak maka hilangkan -->
                  <li class="page-item">
                    <?php if($activePage < $pageAmount) : ?>
                      <a class="page-link" href="?kelas=<?=$classname?>|<?=$classID?>&page=<?= $activePage + 1;?>" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                      </a>
                      <?php else : ?>
                      <a class="page-link d-none" href="?kelas=<?=$classname?>|<?=$classID?>&page=<?= $activePage + 1;?>" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                      </a>
                    <?php endif; ?>
                  </li>
                </ul>
              </div>
              <form action="" method="post" class="form-input ms-3">
                <input type="search" name="search" id="search" class="form-control search" placeholder="Cari Siswa">
              </form>
            </div>
          </div>
          <div class="card-body">
            <?php if (isset($added)) : ?>
              <p class="alert alert-success">Data Telah Ditambahkan!</p>
            <?php endif; ?>
            <div id="container">
              <table class="table table-bordered table-striped table-hover" style="text-align: center">
                <thead>
                  <tr>
                    <th scope="col">NIS</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Gender</th>
                  </tr>
                </thead>
                <tbody class="table-light">
                  <div id="container">
                    <?php
                    foreach ($rows as $row) : ?>
                      <tr>
                        <td><?=$row["idsiswa"];?></td>
                        <td><?=$row["namasiswa"]; ?></td>
                        <td><?=$row["gender"]; ?></td>
                      </tr>
                    <?php endforeach; ?>
                  </div>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <!-- end of content -->
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <!-- Other Javascript -->
    <script>
      // AJAX SCRIPT
      const search = document.querySelector("input.search");
      const table = document.getElementById("container");

      search.addEventListener("keyup", ()=> {
        var xmlHttp = new XMLHttpRequest();
        
        xmlHttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            table.innerHTML = this.responseText;
          }
        };

        xmlHttp.open("GET","ajax/getdata.php?idkelas=<?= $classID;?>&search=" + search.value,true);
        xmlHttp.send();
      });
    </script>
  </body>
</html>
