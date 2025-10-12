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

/* Style the header */
header {
  background-image: url('bg.jpg');
  background-repeat: no-repeat;
  background-position: center;
  padding: 10px;
  text-align: center;
  font-size: 35px;
  color: white;
}

/* Create two columns/boxes that floats next to each other */
nav {
  float: left;
  width: 15%;
  height: 300px; /* only for demonstration, should be removed */
  background: #edeecdff;
  padding: 20px;
  line-height: 30px;
}

/* Style the list inside the menu */
nav ul {
  list-style-type: none;
  padding: 3;
  
}

article.profil {
  float: left;
  padding: 20px;
  width: 85%;
  background-color: #d3e0ecff;
  height: 300px; /* only for demonstration, should be removed */
}

article.skill {
  float: left;
  padding: 20px;
  width: 85%;
  background-color: #d3e0ecff;
  height: 300px; /* only for demonstration, should be removed */
}

/* Clear floats after the columns */
section::after {
  content: "";
  display: table;
  clear: both;
}

/* Style the footer */
footer {
  background-color: #777;
  padding: 10px;
  text-align: center;
  color: white;
}

/* Responsive layout - makes the two columns/boxes stack on top of each other instead of next to each other, on small screens */
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
                <p><strong>Halo!</strong> Saya Kalvin Wibowo, seorang mahasiswa Amikom Yogyakarta yang sedang menempuh jenjang S1 Sistem Informasi</p>
            </div>

            <!-- <article class = "skill">
            <h2>Skills</h2>
            <table class="skills">
                <thead>
                    <tr>
                        <th>Skill</th>
                        <th>Level</th>
                    </tr>
                </thead>
                <tbody>
                    <tr><td>HTML5 & CSS3</td><td>Intermidiate</td></tr>
                    <tr><td>C++</td><td>Intermediate</td></tr>
                    <tr><td>Kotlin</td><td>Beginner</td></tr>
                </tbody>
            </table>
            </article> -->
  </article>

  

</section>

<footer>
  &copy;2025 Personal Portofolio
</footer>

</body>
</html>