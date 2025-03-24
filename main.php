<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Apteka</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="main.css">
  <link rel="icon" type="image/x-icon" href="apteka.png">
</head>
<body>
  <div class="container">
    <!-- Lewy panel menu (20% szeroko[ci) -->
    <nav class="sidebar">
      <ul>
        <li><a href="#">Home</a></li>
        <li><a href="#">Logowanie</a></li>
        <li><a href="#">O nas</a></li>
        <!-- Dodaj kolejne pozycje menu wedBug potrzeb -->
      </ul>
    </nav>
    
    <!-- Prawy blok  gB�wna zawarto[ (80% szeroko[ci) -->
    <div class="main">
      <!-- Blok header z g�rn nawigacj i animowanym tBem -->
      <header class="header">
        <div class="top-nav">
          <a href="#" class="logo">Apteka</a>
          <a href="#" class="menu" id="openMenu">Menu</a>
        </div>
        <div class="header-image"></div>
      </header>
      
      <!-- Blok z przesuwajcymi si kafelkami (slider medykament�w) -->
      <section class="med-slider">
        <div class="carousel">
          <div class="slider-track">
          <?php
          $polaczenie=mysqli_connect('localhost','zset_uplewka','Plewka_123','zset_uplewka');
          $sql = "SELECT * FROM Leki";
          $result = mysqli_query($polaczenie, $sql); 
          while ($row = mysqli_fetch_assoc($result)){
            echo'<div class="slide">'.$row['nazwa'].'</div>';
          }
          ?>  
            <!-- Duplikacja kafelk�w dla pBynnego przesuwania -->
          <?php
          
          while ($row = mysqli_fetch_assoc($result)){
            echo'<div class="slide">'.$row['nazwa'].'</div>';
          }
          ?>
          </div>
        </div>
      </section>
      
      <!-- Dodatkowy content, kt�ry mo|esz rozbudowa -->
      <section class="content">
        <p>Tutaj umie[ dodatkowy content witryny.</p>
      </section>
    </div>
  </div>
  
  <!-- Dialog z dodatkowymi opcjami/menu -->
  <dialog>
    <a href="#">Agency</a>
    <a href="#">Enterprise</a>
    <a href="#">WooCommerce</a>
    <a href="#">Publishers</a>
    <a href="#">Small Business</a>
    <a href="#">Membership Site</a>
  </dialog>
  
  <script src="main.js"></script>
</body>
</html>
