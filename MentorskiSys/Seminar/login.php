<?php
session_start();
require 'model/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    $user = get_user_by_email($_POST['email']); //zelimo da ga ima u bazi
    if ($user) {
        if (password_verify($_POST['password'], $user["0"]["password"])) {
            $_SESSION['login'] = true;
            $_SESSION['email'] = $_POST['email'];
            $_SESSION['role'] = $user["0"]["role"];
            $_SESSION['status'] = $user["0"]["status"];
            if ($_SESSION['role'] == 'student') {
                header('Location:student_index.php');
            }
            if ($_SESSION['role'] == 'mentor') {
                header('Location:mentor_index.php');
            }
        } else {
            $_SESSION['message'] = "Netočni sifra!"; //netocan password
        }
    } else {
        $_SESSION['message'] = "Netočni username!"; //ne postoji taj username
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>LOGIN</title>
    </head>
    <body>
        <form method="POST">
            Username: <input type="text" name="email"><br>
            Password: <input type="password" name="password"><br>
            <input type="submit" name="login" value="Login"><br>
        </form>
        <a href='register.php'>Register</a>

        <?php
        if (isset($_SESSION['message'])) {
            echo $_SESSION['message'];
            unset($_SESSION['message']);
        }
        ?>

        <?php ?>
    </body>
</html>