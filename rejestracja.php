<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Page Title</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='style-login.css'>
    <script src='main.js'></script>
</head>
<body>

<form method="POST">
    imie <input type="text" name='imie'>
    nazwisko <input type="text" name='nazwisko'>
    login <input type="text" name='login'>
    haslo <input type="password" name='haslo'>
    pow haslo <input type="password" name='phaslo'>
    <a href="logowanie.php">Masz konto</a><br>
    <button type="submit">rejestracja</button>
</form>
<?php
$polaczenie=mysqli_connect('localhost','zset_uplewka','Plewka_123','zset_uplewka');
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $login=mysqli_real_escape_string($polaczenie,$_POST["login"]);
    $haslo=mysqli_real_escape_string($polaczenie,$_POST["haslo"]);
    $phaslo=mysqli_real_escape_string($polaczenie,$_POST["phaslo"]);
    $imie=mysqli_real_escape_string($polaczenie,$_POST["imie"]);
    $nazwisko=mysqli_real_escape_string($polaczenie,$_POST["nazwisko"]);
    
    
    $sprawdzenie="SELECT * FROM uzytkownicy WHERE nazwa='$login'";
    $result=mysqli_query($polaczenie,$sprawdzenie);
    $row=mysqli_fetch_assoc($result);
    if($haslo!==$phaslo){
         echo "Hasła są różne";
    }else{
        if($row["login"]=="$login"){
            echo "Login jest już zajęty. Proszę podać inny.";
        }else{
            $hash=password_hash($haslo, PASSWORD_DEFAULT);
            $dodaj="INSERT INTO uzytkownicy (nazwa,haslo,imie,nazwisko) values ('$login','$hash','$imie','$nazwisko')";
            if(mysqli_query($polaczenie,$dodaj)){
                header("Location: logowanie.php");
            }else{
                echo "Błąd przy dodawania danych. Spróbuj ponownie później.";
            }
        }
    }
}
?>
</body>
</html>