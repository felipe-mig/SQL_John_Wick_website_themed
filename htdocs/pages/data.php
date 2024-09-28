<?php
    session_start();
    include_once('../functions/functions.php');
    $dbConnect = dbLink();
    if($dbConnect){
        echo '<!-- Connection Established -->';
    }

            //Validation 
            $uname = $_POST['name'];
            $pwd = $_POST ['pwd'];
        
            # This is the POST MEMORY, in other words, the info that we are sending from our form in login.php
            # We have <input name="name"> 
            
            if ($_POST['name'] != NULL) {
                $validateUsername = true;
            } else {
                $validateUsername = false;
            }
            
            # This is the POST MEMORY, in other words, the info that we are sending from our form in login.php
            # We have <input name="pwd"> 
            if ($_POST['pwd'] != NULL) {
                $validatePassword = true;
            } else {
                $validatePassword = false;
            }
        
            # Esto autentifica la sesion 
            # This is the SESSION MEMORY, in other words, the info that we have in all our navigation time through the website
            if($_SESSION['authenticate'] == 'yes'){
                $validate = true;
               } else if ($validateUsername && $validatePassword) {
                $validate = validateUser($dbConnect,$uname, $pwd);
               }
             
            # Esta es la SESSION MEMORY, es decir, la info que tenemos en nuestra database, mas concretamente en nuestra tabla 'users' en las columna 'id'
            # Esto esta verificando que la info que metimos en <input name="name"> y <input name="pwd"> que enviamos en el archivo login.php , coincide exactamente con la que tenemos en nuestra database, mas concretamente esta diciendo que si nuestra columna 'id' es NULL no valide. else valida como true
            if($_SESSION['id']==NULL){
            $uname = $_POST['name'];
            $pwd = $_POST['pwd'];
            $validate = validateUser($dbConnect,$uname, $pwd);
            }else{
            $validate=true;
            }


          // Logout
          # Este 'logout' viene de '<li><a href="../pages/login.php?logout=logout">Log out</a></li>'; que tenemos en el file dashboard.php y en las demas secciones.
          if($_GET['logout'] == 'logout'){
            # Session_unset() tells the browser to remove the current session id.
            session_unset();
            # session_destroy() clears the session cache.
            session_destroy();
            # session_regenerate_id() creates a new session id for the next person logging in.
            session_regenerate_id();
  }
            
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>John Wick Data</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
      @font-face {
        font-family: jwick;
        src: url(../fonts/09208_CompactaBT.ttf);
      }
    </style>
</head>
<body id=bodyloginSection>
            <!--Nav-Bar-->
            <header>
          <!--logo-->
          <a href="../index.php" class="logo">john wick</a>
          <!--nav-list-->
          <nav>
            <ul>  
              <li><a href="../index.php" style="padding-top: .65vh;">Home</a></li>
              <?php
               # This is for showing the logout button instead of login on the nav bar once we enter the correct username and password.
              if($validate){
                echo '<li><a href="#" style="padding-top: .65vh;">Data</a></li>
                <a href="../pages/login.php?logout=logout" class="login-button">Logout</a>
                '; 
              }
              ?>
              <li><a href="../index.php#pointerToMovies"><div class="jw1nav"></div></a></li>
              <li><a href="../index.php#pointerToMovies"><div class="jw2nav"></div></a></li>
              <li><a href="../index.php#pointerToMovies"><div class="jw3nav"></div></a></li>
              <li><a href="../index.php#pointerToMovies"><div class="jw4nav"></div></a></li>
            </ul>
          </nav>
        </header>
        <?php
            // showMem();
        ?>
            <br>
            <br>
            <br>
            <?php
            if($validate){
              echo '<table>
              <tr>
                <th>Movies</th>
              </tr>';
                viewListMovies($dbConnect);
              echo '</table>';
              echo '<br><br><br><br>';
              echo '<h2>cast</h2>';
              echo '<table>
              ';
                viewListCast($dbConnect);
              echo '</table>';
              
            } else {
              echo '
              <form class="errorForm" action="login.php">
                <br>
                <br>
                <h3 id="errorMessage">Your username or password are incorrect. Please double-check them</h3>
                <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
                <input id="inputErrorMessage" type="submit" value="Try again" id="login-submit-button">
              </form>  
              ';
            }

            ?>
        <footer style="margin-top: 60vh;">
            <!--social media-->
        <div class="copy-and-terms-container">
          <div class="social-media-container">
              <a href="https://github.com/felipe-mig" target="_blank"><i class="bi bi-github" id="giticon"></i></a>
              <a href="https://www.linkedin.com/in/felipeiglesiasgarcia/" target="_blank"><i class="bi bi-linkedin" id="linkedinicon"></i></a>
          </div>
          <p id="copyright">&copy; 2024 Felipe Iglesias Garcia</p>
        </div>
        <!-- <br> -->
    </footer>
</body>
</html>