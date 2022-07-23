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
header("Content-Disposition:attachment;filename=Nilai-Keterampilan-" . $classname . ".xls");

$output = '';

if (isset($_POST["download"])) {
    $query = show("SELECT praktik.idsiswa, siswa.*, praktik.praktikum FROM siswa, praktik WHERE siswa.idkelas = $classID AND siswa.idsiswa = praktik.idsiswa AND praktik.idMapel = $mapelID");

    if (empty($query)) {
        $query = show("SELECT idsiswa, namasiswa, gender FROM siswa WHERE idkelas = $classID");
        $output .= '<h1 style="font-weight: bold;">Nilai Keterampilan</h1>';
        $output .= '
        <table class="table" border="1">
            <thead>
                <tr>        
                    <th>NRP</th>        
                    <th>Nama</th>        
                    <th>Gender</th>        
                    <th>Praktikum</th>      
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
                </tr>
            </tbody>
        ';
        }

        echo $output;
        $output .= '</table>';
    } else {

        $output .= '<h1 style="font-weight: bold;">Nilai Keterampilan</h1>';
        $output .= '
            <table class="table" border="1">
                <thead>
                    <tr>        
                        <th>NRP</th>        
                        <th>Nama</th>        
                        <th>Gender</th>        
                        <th>Praktikum</th>      
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
                        <td>' . $row["praktikum"] . '</td>
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
