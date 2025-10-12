<!DOCTYPE html>
<html lang="en">
<head>
<title>About Kalvin</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel = "stylesheet" href = "aboutme.css"/>
<style>
* {
  box-sizing: border-box;
}

body {
  font-family: aptos, Helvetica, sans-serif;
}

header {
  background-image: url('bg.jpg');
  background-repeat: no-repeat;
  background-position: center;
  padding: 10px;
  text-align: center;
  font-size: 35px;
  color: white;
}

nav {
  float: left;
  width: 15%;
  height: 240px; 
  background: #edeecdff;
  padding: 20px;
  line-height: 30px;
}

nav ul {
  list-style-type: none;
  padding: 3;
  
}

article.profil {
  float: left;
  padding: 20px;
  width: 85%;
  background-color: #d3e0ecff;
  height: 240px; 
}

section::after {
  content: "";
  display: table;
  clear: both;
}

.profile-photo {
    width: 150px;
    height: 150px;
    border-radius: 50%;
    object-fit:cover;
    object-position: top;
    border: 4px solid #4073d9;
    margin-bottom: 20px;
}

.profile-text p {
    font-size: 1.1rem;
    line-height: 1.6;
}

ul.link {
    list-style-type: disc;
    font-size: 1rem;
    color: #333;
}

h2 {
    color: #4073d9;
    margin-top: 40px;
    margin-bottom: 15px;
    border-bottom: 2px solid #000000;
    padding-bottom: 5px;
}

footer {
  background-color: #777;
  padding: 10px;
  text-align: center;
  color: white;
}

@media (max-width: 600px) {
  nav, article {
    width: 100%;
    height: auto;
  }
}
</style>
</head>
<body>
<header>
  <h1>Personal Bio</h1>
</header>

<section>
  <nav>
    <ul class="link">
      <li><a href="https://www.instagram.com/kal.vin_4?igsh=bnF1NnoweTN6c3px">Instagram</a></li>
      <li><a href="https://github.com/1-kain">GitHub</a></li>
      <li><a href="https://wa.me/081318038727">Whatsapp</a></li>
      <li><a href="https://youtube.com/@kalvin6282?si=ztbny_riMh1DCQZc">Youtube</a></li>
    </ul>
  </nav>
  
  <article class = "profil">
    <img src="2Kalvin.jpg" alt="Foto Profil" class="profile-photo" />
            <div class="profile-text">
                <!-- <p><strong>Halo!</strong> Saya Kalvin Wibowo, seorang mahasiswa Amikom Yogyakarta yang sedang menempuh jenjang S1 Sistem Informasi</p> -->
                <?php
                echo "Saya Kalvin Wibowo, seorang mahasiswa Amikom Yogyakarta yang sedang menempuh jenjang S1 Sistem Informasi.";
                ?>
              </div>
  </article>
</section>

<footer>
  &copy;2025 Personal Portofolio
</footer>

</body>
</html>