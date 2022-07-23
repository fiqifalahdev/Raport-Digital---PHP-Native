<?php
session_start();
require "functions.php";
$takeID = $_SESSION["id"];
$sessID = $_SESSION["sessionID"];
$class = $_GET["kelas"];
$class = explode("|", $class);
$classname = current($class);
$classID = end($class);
$mapelID = show("SELECT idmapel FROM kelas WHERE idguru = $sessID AND idkelas = $classID");
$mapelID = current($mapelID);
$mapelID = $mapelID["idmapel"];

header("Content-Type: application/vnd-ms-excel");
header("Content-Disposition:attachment;filename=Nilai-Pengetahuan-" . $classname . ".xls");

$output = '';

if (isset($_POST["download"])) {
    $query = show("SELECT nilai.idsiswa, siswa.*, nilai.harian, nilai.uas FROM siswa, nilai WHERE siswa.idkelas = $classID AND siswa.idsiswa = nilai.idsiswa AND nilai.idMapel = $mapelID");

    if (empty($query)) {
        $query = show("SELECT idsiswa, namasiswa, gender FROM siswa WHERE idkelas = $classID");
        $output .= '<h1 style="font-weight: bold;">Nilai Pengetahuan</h1>';
        $output .= '
        <table class="table" border="1">
            <thead>
                <tr>        
                    <th>NRP</th>        
                    <th>Nama</th>        
                    <th>Gender</th>        
                    <th>Harian</th>        
                    <th>UAS</th>      
                </tr>
            <thead>  
    ';

        foreach ($query as $row) {
            $output .= '
            <tbody>
                <tr>
                    <td>' . $row["idsiswa"] . '</td>
                    <td>' . $row["namasiswa"] . '</td>
                    <td>' . $row["gender"] . '</td>
                    <td>0</td>
                    <td>0</td>
                </tr>
            </tbody>
        ';
        }

        echo $output;
        $output .= '</table>';
    } else {
        $output .= '<h1 style="font-weight: bold;">Nilai Pengetahuan</h1>';
        $output .= '
            <table class="table" border="1">
                <thead>
                    <tr>        
                        <th>NRP</th>        
                        <th>Nama</th>        
                        <th>Gender</th>        
                        <th>Harian</th>        
                        <th>UAS</th>      
                    </tr>
                <thead>  
        ';

        foreach ($query as $row) {
            $output .= '
                <tbody>
                    <tr>
                        <td>' . $row["idsiswa"] . '</td>
                        <td>' . $row["namasiswa"] . '</td>
                        <td>' . $row["gender"] . '</td>
                        <td>' . $row["harian"] . '</td>
                        <td>' . $row["uas"] . '</td>
                    </tr>
                </tbody>
            ';
        }

        echo $output;
        $output .= '</table>';
    }
} else {
    echo '<script>alert("Data Not Found");</script>';
}
