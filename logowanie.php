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
    login <input type="text" name='login'>
    haslo <input type="password" name='haslo'>
    <a href="rejestracja.php">Nie masz konta</a><br>
    <button type="submit">Zaloguj</button>
</form>
<?php
$polaczenie=mysqli_connect('localhost','zset_uplewka','Plewka_123','zset_uplewka');
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $login = mysqli_real_escape_string($polaczenie, $_POST["login"]);
    $haslo = mysqli_real_escape_string($polaczenie, $_POST["haslo"]);
    $sql = "SELECT * FROM uzytkownicy WHERE nazwa='$login'";
    $result=mysqli_query($polaczenie,$sql);
    $row = mysqli_fetch_assoc($result);
    $hasloB=$row['haslo'];

    if (password_verify($haslo, $hasloB)){
        session_start();
        $_SESSION['login']= $row['nazwa'];
        $_SESSION['ID'] = $row['ID'];
        $_SESSION['admin']=$row['admin'];
        $_SESSION['lekarz']=$row['lekarz'];
        header("Location: main.php");
    }else{
        echo "Podane przez ciebie dane nie są prawdziwe. Spróbuj ponownie.";
    }
}
?>
</body>
</html>