<?php
require 'model/db.php';
session_start();
if ($_SESSION['role'] != 'mentor') {
    echo "greska";
    $_SESSION['login'] = false;
    header("Location: login.php");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST["dodaj"])) {
        new_course($_POST['courseName'], $_POST['courseCode'], $_POST['courseProgram'], $_POST['coursePoints'], $_POST['sem_regular'], $_POST['sem_irregular'], $_POST['elective']);
        $_POST = array();
        header('Location: predmeti.php');
    }
}
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <form method="post">
            Ime predmeta:<input type="text" name="courseName" required="required"><br>
            Sifra predmeta:<input type="text" name="courseCode" required="required"><br>
            Program:<input type="textarea" name="courseProgram"><br>
            Bodovi:<input type="text" name="coursePoints" required="required"><br>
            Redovni semestar:<input type="text" name="sem_regular" required="required"><br>
            Izvanredni semestar:<input type="text" name="sem_irregular" required="required"><br>
            Izborni:Da<input type="radio" name="elective" value="0">
            Ne<input type="radio" name="elective" value="1">
            </br>
            <input type="submit" name="dodaj" value="Dodaj">
        </form>
        </br>
        <a href='predmeti.php'><button>Nazad</button></a>
    </body>
</html>
