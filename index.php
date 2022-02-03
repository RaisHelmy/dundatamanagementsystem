<?php session_start(); 
    include "access.php";
    include "header.php";
?>
<img class="ui centered medium image" src="pru14.png">
<?php 
    if(isset($_SESSION['myname'])){
        echo "<div class='ui center aligned raised very padded text container segment'><h2 class='ui header'>"."Selamat datang "."<a class='ui huge green label'>".ucwords($_SESSION['myname'])."</a>"." ke Sistem DATA Daftar Pemilih"."</h2>" ;
    } else {
        echo "<div class='ui center aligned raised very padded text container segment'><h2 class='ui header'>"."Selamat datang ke Sistem Daftar Pemilih, Sila Daftar atau Login."."</h2>" ;
    }
?>
  <p>This system is only for polytical pic data executive that would like to mine data from SPR</p>
  <p>Before using the system, you need to signup first and wait for Admin accept your registration</p>
  <p>You may go for your role section to start</p>
</div>


<script
  src="https://code.jquery.com/jquery-3.1.1.min.js"
  integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
  crossorigin="anonymous"></script>
<script src="semantic/dist/semantic.min.js"></script>
  </body>
</html>
