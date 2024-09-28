<?php

// Database connection
function dbLink(){
    $dbHost ="localhost";
    $dbUser = "mri";
    $dbPassword="password";
    $db ="johnwick";

    $mysqli = new mysqli($dbHost,$dbUser,$dbPassword,$db);

    if($mysqli->connect_errno){
        echo 'Failed to connect: '.$mysqli->connect_error;
    }
   error_reporting(0);
    return $mysqli;
}

// shows what's in the memory
function showMem(){
    echo '<div style="background-color: rgba(0, 0, 0, 0.9); box-shadow: inset 0px 0px 20px 1px rgba(254, 10, 2, 0.3), 0px 0px 5px 2.5px rgba(254, 10, 2, 0.3) ; height: auto; width:12.5vw; border: 2.5px solid rgb(254, 10, 2); display: flex; justify-content: center;  margin-left: 10vw; margin-top: 2vh; margin-bottom: 1vh;  color: #FFFFFF; border-radius: 10px; position: fixed;">';
        echo '<pre>';
        echo '<br>';
        echo '<h4 style="color: #74E0A2; font-size: 1.2em; text-shadow:2px -1px 5px rgb(148, 249, 197);;">SHOW MEMORY</h4>';
        echo '<br>';
        echo '<h4 style="color: rgb(254, 10, 2);">Get Memory</h4>';
        print_r($_GET);
        echo '<br>';
        echo '<h4 style="color: rgb(254, 10, 2);">Post Memory</h4>';
        print_r($_POST);
        echo '<br>';
        echo '<h4 style="color: rgb(254, 10, 2);">Session Memory</h4>';
        print_r($_SESSION);
        echo '<br>';
        echo '</pre>';
        echo '<br>';
    echo '</div>';    
}

// LOGIN
// Validate user
function validateUser($dbConnect,$uname, $pwd){
    $sql = "SELECT * FROM users";
    $result = mysqli_query($dbConnect,$sql);
    if(mysqli_num_rows($result)>0){
        while($row = mysqli_fetch_assoc($result)){
            #utiliza dos == porque esta comparando que la columna 'user' sea exactamente igual a la variable $uname. Si son iguales devuleve true.
            if($row['user'] == $uname){
                if($row['password'] == $pwd){
                    # El operador = se usa para asignar un valor a una variable.
                    # Aqui, = se usa para asignar el valor de $row['id'] a $_SESSION['id']. Esto almacena el ID del usuario en la sesion.
                    $_SESSION['id'] = $row['id'];
                    # Esto autentifica la sesion 
                    $_SESSION['authenticate'] = 'yes';
                    return true;
                }
            }
        }
    }
}

// CREATE power
function insertPower($dbConnect,$quirkName,$quirkDesc,$quirkUser){
    $sql="INSERT INTO quirks (id, quirkName, quirkDesc, quirkUser) VALUES(NULL,'$quirkName','$quirkDesc','$quirkUser')";
    if(mysqli_query($dbConnect,$sql)){
        echo 'Power Added';
    }else {
        echo 'Error: '.$dbConnect->error;
    }

}

// READ the Movies
function viewListMovies($dbConnect){
    $sql="SELECT * FROM movies";
    $result = mysqli_query($dbConnect,$sql);
    if(mysqli_num_rows($result)>0){
        while($row = mysqli_fetch_assoc($result)){
            echo '
            <tr>
                <td style="text-transform: uppercase;">
                '.$row['movieName'].'
             </td>
            </tr>'; 
            // echo '
            // <br>
            // <form  class="viewPowersForm">
            //     <br>
            //     <input id="inputPF" value="'.$row['movieName'].'"><br>
            //     <textarea class="textareaPF">'.$row['quirkDesc'].'</textarea><br>
            //     <input id="inputPFUser" value="User"><br>
            //     <textarea class="textareaPF" style="height: 9vh;">'.$row['quirkUser'].'</textarea><br><br>
            // </form>
            // <br>
            // ';
        }
    }
}

// READ the Cast
function viewListCast($dbConnect){
    $sql="SELECT * FROM cast";
    $result = mysqli_query($dbConnect,$sql);
    if(mysqli_num_rows($result)>0){
        while($row = mysqli_fetch_assoc($result)){
            echo '
            <tr style="font-size: 0.7em;">
                <td style="text-align: right; text-transform: capitalize; color: #dcd7d7; ">
                '.$row['actor'].'
             </td>
             <td style="text-transform: uppercase; ">
                '.$row['character'].'
             </td>
             
            </tr>'; 
            // echo '
            // <br>
            // <form  class="viewPowersForm">
            //     <br>
            //     <input id="inputPF" value="'.$row['movieName'].'"><br>
            //     <textarea class="textareaPF">'.$row['quirkDesc'].'</textarea><br>
            //     <input id="inputPFUser" value="User"><br>
            //     <textarea class="textareaPF" style="height: 9vh;">'.$row['quirkUser'].'</textarea><br><br>
            // </form>
            // <br>
            // ';
        }
    }
}



?>