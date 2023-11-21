<!DOCTYPE html>
<html lang="en">

  <?php 
    session_start();
    include("connectdb.php");
    ?>

  <head>
    <meta charset="UTF-8" />
    <title>Your Profile</title>
  </head>
  <body>
    <header id="main-header">
     <nav>
       <!-- navigation bar -->
     </nav>
    </header>
    <main>
      <?php
        if(isset($_SESSION['username'])){
          echo "<h3>Welcome, " . $_SESSION['username'] . "!</h3>";
        } else {
          echo "<h3>You aren't logged in.</h3>";
        }
      ?>
    </main>
  </body>
</html>
