<?php 
    require '../functions.php';
    $class = $_GET["idkelas"];
    $class = explode("|", $class);
    $classname = current($class);
    $classID = end($class);

    $keyword = $_GET["search"];
    $rows = show("SELECT * FROM siswa WHERE idkelas = $classID AND namasiswa LIKE '%$keyword%' LIMIT 0,10");
?>
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