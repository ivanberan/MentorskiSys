<?php
print_r($_POST);
session_start();
require 'model/db.php';
if (isset($_SESSION['login'])) {
    if ($_SESSION['login'] == true) {
        header('Location: index.php');
    }
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (getStudentByEmail($_POST['email'])) { //ne zelimo da ga ima u bazi
        $_SESSION['message'] = "Taj email vec postoji!";
    } else {
        $cryptpass = password_hash($_POST['password'], PASSWORD_DEFAULT); //nikad se ne ocekuje da se dobije originalni podatak- analogija sa kvadriranjem(matematicka funkcija koja je jednosmjerna, nema inverza)
        if ($_POST['role'] == "mentor") {
            $status = "none";
            echo"mentor";
            create_user($_POST['email'], $cryptpass, $_POST['role'],$status);
        } else {
            echo"student";
            create_user($_POST['email'], $cryptpass, $_POST['role'], $_POST['status']);
        }

        header("Location:login.php");
        
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>REGISTER</title>
    </head>
    <script type="text/javascript">
        function provjera2() {
            document.getElementById("2").disabled = false;
            document.getElementById("3").disabled = false;
        }
    </script>   
    <body>
        <form method="post">
            Email:<input type="email" name="email" required="required"><br>
            Lozinka:<input type="password" name="password" required="required"><br>
            Uloga:Mentor<input type="radio" id="role1" name="role" value="mentor" required="required" > Student<input type="radio" id="role2" name="role" value="student"required="required" onchange="provjera2()">
            <br>
            Status:Student redovni<input type="radio" id="2" name="status" disabled="disabled" value="redovni" required="required">Student izvanredni<input type="radio" id="3" name="status" disabled="disabled"value="izvanredni" required="required">
            <input type="submit" name="register" value="Registiraj se">
        </form>
        <a href='login.php'>Login</a><br>
        <?php
        if (isset($_SESSION['message'])) {
            echo $_SESSION['message'];
            unset($_SESSION['message']); //inace bi se zapamtio pri sljedecem refreshu
        }
        ?>
    </body>
</html>