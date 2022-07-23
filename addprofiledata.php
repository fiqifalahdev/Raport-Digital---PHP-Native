<?php 
    session_start();
    require "functions.php";
    $takeID = $_SESSION["id"];
    // Panggil database profile
    // cek jika sudah disubmit. lalu masukkan data
        if (isset($_POST["submit"])) { 
            // inisialisasi inputan ke dalam variable 
            $nip = htmlspecialchars($_POST["nip"]);
            $fullname = htmlspecialchars($_POST["fullname"]);
            $date = $_POST["date"];
            $gender = $_POST["gender"];            
            // cek user
            $query = mysqli_query($conn ,"SELECT * FROM guru WHERE iduser = $takeID");
            
            if (mysqli_num_rows($query) > 0) {                
                $added = addData("UPDATE guru SET 
                -- inisialisasi isi field sesuai dengan inputan form
                        nip = '$nip'
                        fullname = '$fullname',
                        date = '$date',
                        gender = '$gender',
                        WHERE iduser = $takeID;
                ");
            }else {
                $added = addData("INSERT INTO `guru` (`iduser`, `nip`, `fullname`, `tanggallahir`, `gender`) VALUES ($takeID,'$nip', '$fullname', '$date', '$gender')");
                $_SESSION["sessionID"] = $nip;
            }

            var_dump(mysqli_errno($conn));
        } 
        else {
            $row = show("SELECT * FROM guru WHERE iduser = $takeID");
            if (!empty($row)) {
                foreach ($row as $item) {
                    $nip = $item["nip"];
                    $fullname = $item["fullname"];
                    $date = $item["tanggallahir"];
                    $gender = $item["gender"];
                }
            }else {
                $nip = "";
                $fullname = "";
                $date = "";
                $gender = "";
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

    <!-- Other Link -->
    <link rel="stylesheet" href="assets/addprofile.css" />
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
                    <h3>Masukkan Data Anda</h3>
                    <a class="btn btn-danger" href="profilpage.php">Kembali</a>
                </div>
                <div class="card-body container-sm">
                    <form action="" method="POST">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <label for="nip" class="form-label">NIP : </label>
                                <input type="text" class="form-control" name="nip" id="nip" required value="<?= $nip; ?>">
                            </li>
                            <li class="list-group-item">
                                <label for="fullname" class="form-label">Nama Lengkap : </label>
                                <input type="text" class="form-control" name="fullname" id="fullname" required value="<?= $fullname;?>">
                            </li>
                            <li class="list-group-item">
                                <label for="date" class="form-label">Tanggal Lahir : </label>
                                <input type="date" class="form-control" name="date" id="date" required value="<?= $date; ?>">
                            </li>
                            <li class="list-group-item">
                                <label for="gender" class="form-label">Gender : <?= $gender; ?></label>
                                <select name="gender" id="gender" class="form-select">
                                    <option value="Choose..." selected>Choose</option>
                                    <option value="L">Pria</option>
                                    <option value="P">Wanita</option>
                                </select>
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