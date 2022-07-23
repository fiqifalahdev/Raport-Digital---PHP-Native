<?php
session_start();
require "functions.php";
$sessID = $_SESSION["sessionID"];
$class = $_GET["kelas"];
$class = explode("|", $class);
$classname = current($class);
$classID = end($class);

$mapelID = show("SELECT idmapel FROM kelas WHERE idguru = $sessID AND idkelas = $classID");
$mapelID = current($mapelID);
$mapelID = $mapelID["idmapel"];


// cek apakah tombol submit sudah dipencet atau belum
if (isset($_POST["submitNilai"])) {
  // inisialisasi variable
  $filename = $_FILES["nilaiPraktik"]["name"];
  $fileExtension = explode(".", $filename);
  $fileExtension = strtolower(end($fileExtension));
  $fileData = $_FILES["nilaiPraktik"]["tmp_name"];

  $targetDirectory = "uploads/" . $filename;
  move_uploaded_file($fileData, $targetDirectory);

  error_reporting(0);
  ini_set('display_errors', 0);

  // panggil excelreader
  require "excelReader/SpreadsheetReader.php";

  $reader = new SpreadsheetReader($targetDirectory);
  $result = mysqli_query($conn, "SELECT * FROM praktik WHERE idkelas = '$classID'");

  foreach ($reader as $item => $value) {
    $nrp = $value[0];
    $praktikum = $value[3];

    $added = mysqli_query($conn, "INSERT INTO `praktik` (`idmapel`, `idkelas`, `idsiswa`, `praktikum`) VALUES ('$mapelID', '$classID', '$nrp', '$praktikum')");
  }
  $update = addData("UPDATE raport SET status_keterampilan = 1 WHERE idKelas = $classID");
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
  <link rel="stylesheet" href="assets/nilaiKeterampilan.css" />
  <!-- Font Link -->
  <link href="fontawesome-free-5.15.4-web/css/all.css" rel="stylesheet" />
  <!-- Google Link -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;700&display=swap" rel="stylesheet" />

  <title>Nilai Keterampilan</title>
</head>

<body>
  <!-- Collapsable Sidebar -->
  <?php require "sidebar.php"; ?>
  <!-- End Of Sidebar -->
  <?php
  // berapa data yang ingin ditampilkan pada table
  $showedPage = 10;
  // berapa data yang ada di dalam 1 kelas
  $dataAmount = count(show("SELECT * FROM siswa WHERE idkelas = $classID")); // index ke 29
  // hitung berapa page jika yang ditampilkan hanya 10
  $pageAmount = ceil($dataAmount / $showedPage); // 3
  // buat active page jika sudah diset maka page = page itu sendiri, jika belum maka activepage = 1 
  // nanti akan ditaruh pada pagination nya
  $activePage = (isset($_GET["page"])) ? $_GET["page"] : 1;
  // buat variable untuk menampung data akan ditampilkan pada index ke berapa dulu
  // misal : 
  //activepage -> 1 * 10 - 10 = 1 -> startdata = 1
  //activepage -> 2 * 10 - 10 = 10 -> startdata = 10
  //activepage -> 3 * 10 - 10 = 10 -> startdata = 20
  $startData = ($activePage * $showedPage) - $showedPage;
  # ambil data pada database dengan batasan LIMIT dari start data hingga data yang ingin ditampilkan ada berapa.
  // $rows = show("SELECT * FROM `siswa` WHERE idkelas = $classID LIMIT $startData, $showedPage");
  ?>
  <div class="container-fluid kelasContent">
    <div class="row">
      <div class="col-md-12 mb-3">
        <div class="kelasDetails p-3 my-lg-4">
          <div class="card">
            <div class="card-header d-flex justify-content-between flex-row">

              <div class="report-name">
                <p class="h4">Nilai Keterampilan</p>
                <p class="h6"><?= $classname; ?></p>
              </div>
              <div class="navigation d-flex justify-content-evenly">
                <form action="getKeterampilan.php?kelas=<?= $classname; ?>|<?= $classID; ?>" method="post" class="card-nav ms-3">
                  <button type="submit" class="btn btn-secondary" id="download" name="download">Download Excel</button>
                </form>
                <div class="card-nav ms-3">
                  <button type="button" class="btn btn-primary" id="upload" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Upload</button>
                </div>
                <div class="card-nav ms-3">
                  <a href="kelas.php?kelas=<?= $classname; ?>|<?= $classID; ?>" type="button" class="btn btn-danger">Kembali</a>
                </div>
              </div>

            </div>
            <div class="card-body table-responsive-sm">
              <div aria-label="pagination-navigation">
                <ul class="pagination d-flex justify-content-end">
                  <li class="page-item">
                    <!-- cek jika active page lebih dari satu maka tampilkan panah jika tidak maka hilangkan panah -->
                    <?php if ($activePage > 1) : ?>
                      <a class="page-link" href="?kelas=<?= $classname ?>|<?= $classID ?>&page=<?= $activePage - 1; ?>" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                      </a>
                    <?php else : ?>
                      <a class="page-link d-none" href="?kelas=<?= $classname ?>|<?= $classID ?>&page=<?= $activePage - 1; ?>" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                      </a>
                    <?php endif; ?>
                  </li>
                  <!-- looping untuk pagination agar muncul berapa page yang dibuat. -->
                  <?php for ($i = 1; $i <= $pageAmount; $i++) : ?>
                    <!-- untuk page nya sendiri diambil dengan method GET -->
                    <li class="page-item"><a class="page-link" href="?kelas=<?= $classname ?>|<?= $classID ?>&page=<?= $i ?>"><?= $i; ?></a></li>
                  <?php endfor; ?>
                  <!-- cek jika active page kurang dari jumlah page maka tampilkan panah, jika tidak maka hilangkan -->
                  <li class="page-item">
                    <?php if ($activePage < $pageAmount) : ?>
                      <a class="page-link" href="?kelas=<?= $classname ?>|<?= $classID ?>&page=<?= $activePage + 1; ?>" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                      </a>
                    <?php else : ?>
                      <a class="page-link d-none" href="?kelas=<?= $classname ?>|<?= $classID ?>&page=<?= $activePage + 1; ?>" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                      </a>
                    <?php endif; ?>
                  </li>
                </ul>
              </div>
              <!-- tampilkan table siswa -->
              <?php
              $rows = show("SELECT praktik.idsiswa, siswa.*, praktik.praktikum FROM siswa, praktik WHERE siswa.idkelas = $classID AND siswa.idsiswa = praktik.idsiswa AND praktik.idMapel = $mapelID LIMIT $startData, $showedPage");

              $i = $startData + 1;
              ?>
              <?php if (isset($added)) : ?>
                <p class="alert alert-success">Data Telah Ditambahkan</p>
              <?php endif; ?>
              <table class="table table-bordered table-striped table-hover" style="text-align: center;">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>NIP</th>
                    <th>Nama</th>
                    <th>Gender</th>
                    <th>Praktikum</th>
                    <th>Grade</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($rows as $row) : ?>
                    <?php
                    $avg = $row["praktikum"];
                    if ($avg > 85) {
                      $grade = 'A';
                    } elseif ($avg > 75) {
                      $grade = 'B';
                    } else {
                      $grade = 'C';
                    }
                    ?>
                    <tr>
                      <td><?= $i; ?></td>
                      <td><?= $row["idsiswa"]; ?></td>
                      <td><?= $row["namasiswa"]; ?></td>
                      <td><?= $row["gender"]; ?></td>
                      <td><?= $row["praktikum"]; ?></td>
                      <td><?= $grade ?></td>
                    </tr>
                    <?php $i++; ?>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- end of content -->
  <!-- popup upload -->
  <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Upload File Excel</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="" method="post" class="form-input" enctype="multipart/form-data">
          <div class="modal-body">
            <!-- inpput nilai -->
            <input type="file" name="nilaiPraktik" id="nilaiPraktik" class="form-control">
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary" name="submitNilai">Kirim</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- akhir popup download -->
  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <!-- Other Javascript -->
  <script>
    // function untuk sidebar
    let btn = document.querySelector("#btn");
    let nav = document.querySelector("nav");
    let wrap = document.querySelector("#wrapAll");
    let icon = document.getElementById("icon");
    nav.removeChild(wrap);

    btn.addEventListener("click", function() {
      if (nav.classList.toggle("active")) {
        nav.appendChild(wrap);
        nav.removeChild(icon);
      } else {
        nav.removeChild(wrap);
        nav.appendChild(icon);
      }
    });
  </script>
  <script>
    const wrapper = document.querySelector(".uploadWrapper");
    const upload = document.querySelector(".nilaiKeterampilan #upload");
    const closeBtn = document.querySelector(".uploadWrapper #closeBtn");

    upload.addEventListener("click", function() {
      wrapper.classList.add("active");
    });
    closeBtn.addEventListener("click", function() {
      wrapper.classList.remove("active");
    });
  </script>
</body>

</html>