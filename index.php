<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous" />
    <link rel="stylesheet" href="assets/index.css">
    <!-- Other Link -->
    <link href="fontawesome-free-5.15.4-web/css/all.css" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;500;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <title>SISTEM INFORMASI RAPORT SISWA</title>
  </head>
  <body>
    <!-- Awal Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light sticky-top">
      <div class="container-sm">
        <a class="navbar-brand" href="#">
          <i class="fas fa-graduation-cap" style="color: white"></i>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav link d-flex justify-content-center text-center text-decoration-none ms-auto">
            <a class="nav-link mx-lg-4" aria-current="page" href="#">Beranda</a>
            <a class="nav-link mx-lg-4" href="#">Data Guru</a>
            <a class="nav-link mx-lg-4" href="#">Kurikulum</a>
            <a class="nav-link mx-lg-4" href="#">Absensi</a>
            <form action="login.php" method="get">
              <button type="submit" class="btn btn-light px-5 buttonLogin container-fluid" name="submit">Log In</button>
            </form>
          </div>
        </div>
      </div>
    </nav>
    <!-- Akhir Navbar -->
    
    <!-- Main Content -->
      <div class="container-fluid main">
        <div class="row p-5 m-auto" data-aos="fade-up" data-aos-duration="1500">
          <div class="col-lg-6 col-12 container-lg d-flex justify-content-center align-items-center flex-column desc mt-3 py-md-4">
            <div class="judul mt-md-5">
              <h1 class="fw-bold">Raport Digital Pendidikan</h1>
            </div>
            <div class="penjelasan">
              <p class="penj p-md-4 p-1 d-none d-md-block">
                Web Raport digital yang memberikan layanan bagi para Guru dan peserta didik agar mendapat Informasi Nilai Raport. Lorem ipsum dolor sit amet consectetur adipisicing elit. Vel quia autem dicta in fugiat soluta officia
                delectus voluptates, ipsum deserunt ut dolore, veniam nesciunt sed mollitia quasi expedita eaque ad non? Commodi est magnam similique ut quas ipsa, assumenda omnis doloribus earum sequi molestias temporibus reiciendis
                recusandae nesciunt impedit ad?
              </p>
            </div>
          </div>
          <div class="col-md-6 col-12 px-md-4 d-md-none d-lg-inline">
            <img class="img-fluid" src="assets/img/Taking notes-amico.png" alt="GambarRaport" />
          </div>
        </div>
      </div>
    <!-- Akhir Main content -->
    <!-- Awal Profile -->
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
      <path
        fill="#9DE9F4"
        fill-opacity="1"
        d="M0,160L60,165.3C120,171,240,181,360,208C480,235,600,277,720,261.3C840,245,960,171,1080,144C1200,117,1320,139,1380,149.3L1440,160L1440,0L1380,0C1320,0,1200,0,1080,0C960,0,840,0,720,0C600,0,480,0,360,0C240,0,120,0,60,0L0,0Z"
      ></path>
    </svg>
    <section id="About">
      <div class="row bungkus d-flex justify-content-center d-flex align-items-center container-sm m-auto" data-aos="fade-up" data-aos="fade-up" data-aos-duration="1500">
          <div class="profile text-center"><h1>Profil Sekolah</h1></div>
          <div class="row card1">
            <div class="col-md-4 mb-4">
              <div class="card tanda prestasi1">
                <img src="assets/img/Winners-amico.png" class="card-img-top" alt="..." />
                <div class="card-body">
                  <p class="card-text h5 text-center">Prestasi</p>
                </div>
              </div>
            </div>
            <div class="col-md-4 mb-4">
              <div class="card tanda akre">
                <img src="assets/img/Graduation-amico.png" class="card-img-top" alt="..." />
                <div class="card-body">
                  <p class="card-text h5 text-center">Akreditasi</p>
                </div>
              </div>
            </div>
            <div class="col-md-4 mb-4">
              <div class="card tanda eskul">
                <img src="assets/img/Healthy habit-amico.png" class="card-img-top" alt="..." />
                <div class="card-body">
                  <p class="card-text h5 text-center">Ekstrakurikuler</p>
                </div>
              </div>
            </div>
          </div>
            <div class="row card2 justify-content-center container-sm">
              <div class="card bg-primary text-white overlay-img">
                <img src="assets/img/Marketing-amico.png" class="card-img img-fluid d-none d-sm-inline" alt="..." />
                <div class="card-img-overlay">
                  <h5 class="card-title h2 text-end">Berita Sekolah</h5>
                  <div style="width: 20rem" class="headline-berita ms-auto">
                    <p class="card-text h4 text-end">Siswa kelas 12 mipa 4 menang lomba Basket</p>
                    <a href="#"><p class="card-text text-end text-decoration-none" style="color: #fff">klik untuk info selengkapnya...</p></a>
                    <p class="card-text text-end">Last updated 3 mins ago</p>
                  </div>
                </div>
              </div>
          </div>
        </div>
      </div>
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#9DE9F4" fill-opacity="1" d="M0,96L48,106.7C96,117,192,139,288,128C384,117,480,75,576,90.7C672,107,768,181,864,192C960,203,1056,149,1152,138.7C1248,128,1344,160,1392,176L1440,192L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>
    </section>
    <!-- Akhir Profile -->
    <!-- Awal Calendar -->
    <section id="Tanggal">
          <div class="row konten d-flex justify-content-center align-items-center container-fluid m-auto" data-aos="fade-up" data-aos-duration="1500">
            <div class="col-md-6  p-sm-4">
              <h1 class="fw-bold">Catat Tanggal Ambil Raport Kalian!</h1>
              <h3>Tetap Semangat belajar dan selalu perhatikan absensi!</h3>
            </div>
            <div class="col-md-6 kalender p-sm-4">
              <img src="assets/img/Notebook@3x.png" alt="" class="img-fluid float-end"/>
            </div>
        </div>
    </section>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
      <path
        fill="#9DE9F4"
        fill-opacity="1"
        d="M0,160L60,165.3C120,171,240,181,360,208C480,235,600,277,720,261.3C840,245,960,171,1080,144C1200,117,1320,139,1380,149.3L1440,160L1440,0L1380,0C1320,0,1200,0,1080,0C960,0,840,0,720,0C600,0,480,0,360,0C240,0,120,0,60,0L0,0Z"
      ></path>
    </svg>
    <footer> 
      <div class="container-fluid">
          <div class="row footer-start d-flex justify-content-center" data-aos="fade-up" data-aos-duration="1500">
            <div class="col-sm-4 col-12 us mt-3">
              <div class="about-us">
                <h4>Tentang Kami</h4>
              </div>
              <div style="width: 20rem;" class="team">
                <p>Tim Teknis Startup yang terdiri dari beberapa orang dengan keterampilan khusus yang sudah memiliki sertifikasi yang sudah berstandar nasional</p>
              </div>
            </div>
            <div class="col-sm-4 col-12 contact mt-3">
              <h4>Info Kontak</h4>
              <div class="icon-ig">
                <i class="fab fa-instagram"> <a style="color: black;" class="text-decoration-none" href="https://instagram.com/fiqifalah">@fiqifalah</a></i>
              </div>
              <div class="icon-wa">
                <i class="fab fa-whatsapp"> 08815018220 </i>
              </div>
              <div class="icon-email">
                <i class="far fa-envelope"> <a style="color: black;" target="blank" class="text-decoration-none" href="https://mail.google.com/mail/u/0/#inbox?compose=CllgCJvrcdpdlhLCRFfBKrwNzVpBnsbTWSNLLVjMWQrkqrgvLxrGskntHHfTCCmxgfGbSvHnZFL">fiqifalah17@gmail.com</a></i>
              </div>
              <div class="icon-loc">
                <i class="bi bi-geo-alt">Alamat : Dsn. Urang Agung Sumberejo Wonoayu RT 12/ RW 03</i>
              </div>
            </div>
            <div class="col-sm-4 col-12 stat mt-3">
              <h4>Statistik</h4>
              <p>Hari ini : 15529</p>
              <p>Bulan ini : 164267</p>
              <p>Tahun ini : 1319566</p>
            </div>
          </div>
        <div class="row footer-end">
          <div class="col-lg-12 col-md-8">
            Copyright ©2021 All rights reserved | Tim Teknis Startup dengan <i style="color: red;" class="fas fa-heart"></i>
          </div>
        </div>
      </div>
    </footer>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <!-- Other Script -->
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
      AOS.init();
    </script>

  </body>
</html>
