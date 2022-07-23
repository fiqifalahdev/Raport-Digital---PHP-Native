<?php 
    session_start();
    require "functions.php";
    $takeID = $_SESSION["id"];

        // cek jika sudah disubmit. lalu masukkan data
        if (isset($_POST["submit"])) { 
            $rows = show("SELECT nip, fullname FROM guru WHERE iduser = $takeID");
            foreach ($rows as $row) {
                $idguru = $row["nip"];
                $namaguru = $row["fullname"];
            }
            // inisialisasi inputan ke dalam variable 
            $mapel = $_POST["mapel"];
            $mapel = explode(",", $mapel);
            $idmapel = current($mapel);
            $namamapel = end($mapel);

            $class = $_POST["kelas"];
            $class = explode(",", $class);
            $classID = current($class);
            $className = end($class);


            $semester = $_POST["semester"];
            $year = htmlspecialchars($_POST["year"]);

            $added = addData("INSERT INTO `kelas` (`idguru`, `idkelas`, `idmapel`,`namakelas`, `namaguru`,`namamapel`, `semester`, `tahunpelajaran`) VALUES ('$idguru', '$classID', '$idmapel', '$className','$namaguru', '$namamapel', '$semester', '$year')");

            var_dump(mysqli_errno($conn));
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
    <link rel="stylesheet" href="assets/addClass.css" />
    <link href="fontawesome-free-5.15.4-web/css/all.css" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;700&display=swap" rel="stylesheet" />
    <title>Tambah Data</title>
</head>
<body>
    <?php require "sidebar.php"?>

    <div class="container-fluid startingContent p-3">
        <div class="container-fluid p-3">
            <?php if (isset($added)) : ?>
                <div class="add alert alert-success">
                    <p>Data Telah Ditambahkan!</p>
                </div>
            <?php endif;?>
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h3>Masukkan Data Kelas</h3>
                    <a class="btn btn-danger" href="profilpage.php">Kembali</a>
                </div>
                <div class="card-body container-sm">
                    <form action="" method="POST">
                        <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                                <?php 
                                    $list = show("SELECT * FROM mapel");
                                ?>
                                <label for="mapel" class="form-label">Mata Pelajaran : </label>
                                <select class="form-select" id="mapel" name="mapel">
                                    <option selected>Choose...</option>
                                    <?php foreach ($list as $newList) : ?>
                                      <option value="<?=$newList["idmapel"]?>,<?= $newList["namamapel"];?>"><?= $newList["namamapel"];?></option>
                                    <?php endforeach; ?>
                                </select>
                            </li>
                            <li class="list-group-item">
                                <?php 
                                    $classes = show("SELECT * FROM daftarkelas");
                                ?>
                                <label for="kelas" class="form-label">Kelas : </label>
                                <select class="form-select" id="kelas" name="kelas">
                                    <option selected>Choose...</option>
                                    <?php foreach ($classes as $list) : ?>
                                      <option value="<?=$list["idkelas"]?>,<?= $list["namakelas"];?>"><?= $list["namakelas"];?></option>
                                    <?php endforeach; ?>
                                </select>
                            </li>
                            <li class="list-group-item">
                                <label for="semester" class="form-label">Semester : </label>
                                <select name="semester" id="semester" class="form-select">
                                    <option selected>Choose...</option>
                                    <option value="Ganjil">Ganjil</option>
                                    <option value="Genap">Genap</option>
                                </select>
                            </li>
                            <li class="list-group-item">
                                <label for="year" class="form-label">Tahun Pelajaran : </label>
                                <input class="form-control" type="year" name="year" id="year" required>
                            </li>
                        </ul>
                        <br>
                        <button type="submit" name="submit" class="btn btn-outline-info">Tambah Data</button>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>