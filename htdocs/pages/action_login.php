<?php
    # session_start() is to get the session navigation working through all the sections of the document. 
    session_start();
    include_once('../functions/functions.php');
    $dbConnect = dbLink();
    if($dbConnect){
        echo '<!-- Connection Established -->';
    }

    showMem();
    
    # Esto es la POST MEMORY que viene del form en el file addpowers_section.php
    # Esto esta diciendo que las variables de nuestra funcion son iguales a la informacion que nos viene del form
    $uname = $_POST['name'];
    $pwd = $_POST['pwd'];
    validateUser($dbConnect,$uname, $pwd);
    

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body onload="bounce()">   
    <script>
        function bounce(){
            window.location.href="data.php";
        }
    </script>
</body>
</html>