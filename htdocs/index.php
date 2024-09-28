<?php
    session_start();
    include_once('functions/functions.php');
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
    <title>John Wick</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
      @font-face {
        font-family: jwick;
        src: url(fonts/09208_CompactaBT.ttf);
      }
    </style>
</head>
<body style="background-color: black;">
            <!--Nav-Bar-->
            <header>
          <!--logo-->
          <a href="#" class="logo">john wick</a>
          <!--nav-list-->
          <nav>
            <ul>  
              <li><a href="#" style="padding-top: .65vh;">Home</a></li>
              <?php
               # This is for showing the logout button instead of login on the nav bar once we enter the correct username and password.
               if($validate){
                echo '<li><a href="pages/data.php" style="padding-top: .65vh;">Data</a></li>
                <a href="../pages/login.php?logout=logout" class="login-button">Logout</a>
                '; 
              } else {
                echo '<a href="../pages/login.php" class="login-button">Login</a>';
              }
              ?>
              <li><a href="#pointerToMovies"><div class="jw1nav"></div></a></li>
              <li><a href="../index.php#pointerToMovies"><div class="jw2nav"></div></a></li>
              <li><a href="../index.php#pointerToMovies"><div class="jw3nav"></div></a></li>
              <li><a href="../index.php#pointerToMovies"><div class="jw4nav"></div></a></li>
            </ul>
          </nav>
        </header>
        <?php
        // showMem();
        ?>
        <!-- cta -->
        <div class="cta">
          <h1>walk a mile to avoid a fight but when one starts, don't back down an inch.</h1>
        </div>
          <div class="wrapper">
            <br>
            <br id="pointerToMovies">
            <br>
            <div class="moviesMainContainer">
              <div class="jw1Conteiner">
                <div class="jw1Image"></div>
                <h3>John Wick</h3>
                <br>
                <p class="posterP">2014</p>
                <br>
               <div class="moreInfoButton">More Info</div>
              </div>
              <div class="jw2Conteiner">
                <div class="jw2Image"></div>
                <h3>JOHN WICK CHAPTER 2</h3>
                <br>
                <p class="posterP">2017</p>
                <br>
                <div class="moreInfoButton">More Info</div>
              </div>
              <div class="jw2Conteiner">
                <div class="jw3Image"></div>
                <h3>JOHN WICK CHAPTER 3</h3>
                <br>
                <p class="posterP">2019</p>
                <br>
                <div class="moreInfoButton">More Info</div>
              </div>
              <div class="jw2Conteiner">
                <div class="jw4Image"></div>
                <h3>JOHN WICK CHAPTER 4</h3>
                <br>
                <p class="posterP">2023</p>
                <br>
                <div class="moreInfoButton">More Info</div>
              </div>
            </div>
            <br>
            <br>
            <br>
          </div>
        <footer>
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