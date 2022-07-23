<link rel="stylesheet" href="assets/sidebar.css">
  <!-- Collapsable Sidebar  -->
      <!-- nanti dijadikan PHP sendiri -->
      <nav>
        <div class="button">
          <a class="navbar-brand" href="index.php"><i class="fas fa-graduation-cap" style="color: white"></i></a>
          <button type="button" id="btn" class="btn button1">
            <i class="fas fa-bars" style="color: rgb(255, 255, 255)"></i>
          </button>
        </div>
        <div id="wrapAll">
          <div class="dashboardText my-1">
            <a href="dashboard.php"><i class="fas fa-tachometer-alt"></i> Status Kelas</a>
          </div>
          <a href="profilpage.php" style="text-decoration: none">
            <div class="profile">
              <div class="image_profile my-lg-3">
                <img src="assets/img/PP.jpg" alt="" />
                <div class="data">
                  <?php 
                    // panggil table profile 
                    if (isset($_SESSION["sessionID"])) {
                      $sessID = $_SESSION["sessionID"];
                      $rows = show("SELECT * FROM kelas WHERE idguru = $sessID");
                      if (empty($rows)) {
                        $error = "<p class='alert alert-danger'>Masukkan Data</p>";
                      }else{
                        foreach ($rows as $row) {
                          $idguru = $row["idguru"];
                          $namaguru = $row["namaguru"];
                          $namamapel = $row["namamapel"];
                        }
                      }
                    }

                  ?>
                  <!-- masukkan data profile pada profile card -->
                  <p class="h4 fw-bold text-center"><?php if (isset($error)) {
                    echo $error;
                  } else {
                    echo $namaguru;
                  }?></p>
                  <p class="h6 text-center"><?php if (isset($error)) {
                    echo $error;
                  } else {
                    echo $idguru;
                  }?></p>
                </div>
                <div class="edit text-center">
                  <button type="button" class="btn btn-outline-info">Edit Profile</button>
                </div>
              </div>
            </div>
          </a>
          <div class="accordion accordion-flush" id="accordionFlushExample">
            <div class="accordion-item mb-3">
              <h2 class="accordion-header" id="flush-headingOne">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne"><?php if (isset($error)) {
                  echo $error;
                } else {
                  echo $namamapel;
                }?></button>
              </h2>
              <!-- Masukkan data kelas pada accordion -->
              <?php if (isset($rows)) : ?>
                <?php foreach ($rows as $classes) : ?>
                  <div id="flush-collapseOne" class="accordion-collapse collapse text-center" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                    <a href="kelas.php?kelas=<?= $classes["namakelas"];?>|<?=$classes["idkelas"];?>">
                      <div class="accordion-body btn Kelas"><?=  $classes["namakelas"]; ?></div>
                    </a>
                  </div>
                <?php endforeach;?>
              <?php endif;?>
            </div>
          </div>
        </div>
        <div id="icon">
          <div class="iconProfile">
            <a href="profilpage.php">
              <button class="btn button1">
                <i class="far fa-user-circle" style="color: white"></i>
              </button>
            </a>
          </div>
          <!-- nanti dibuat logout.php -->
          <div class="iconLogOut">
            <a href="logout.php" style="text-decoration: none">
              <button class="btn button1">
                <i class="fas fa-sign-out-alt" style="color: white"></i>
              </button>
            </a>
          </div>
        </div>
      </nav>
      <script>
      // function untuk sidebar
      let btn = document.querySelector("#btn");
      let nav = document.querySelector("nav");
      let wrap = document.querySelector("#wrapAll");
      let icon = document.getElementById("icon");
      nav.removeChild(wrap);

      btn.addEventListener("click", function () {
        if (nav.classList.toggle("active")) {
          nav.appendChild(wrap);
          nav.removeChild(icon);
        } else {
          nav.removeChild(wrap);
          nav.appendChild(icon);
        }
      });
    </script>
      <!-- End Of Sidebar -->
