<?php
require 'model/db.php';
session_start();
if ($_SESSION['role'] != 'mentor') {
    echo "greska";
    $_SESSION['login'] = false;
    header("Location: login.php");
}
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    header('Location: login.php');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST["delete"])) {

        delete_course($_POST["delete"]);
    } else if (isset($_POST["edit"])) {
        
    }
}
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <table  border="1">
            <tr>
                <td><a href='logout.php'><button>Logout</button></a><br></td>
                <td><a href='predmeti.php'><button>Predmeti</button></a></td>
                <td><a href='studenti.php'><button>Studenti</button></a></td>
            </tr>
            <tr>
                <td><a href='newcourse.php'><button>Novi predmet</button></a></td>
                <td><a href="mentor_index.php"><button>Nazad</button></a></td>
            </tr>
            <tr>
                <td>Šifra predmeta</td>
                <td>Ime Predmeta</td>
                <td>Program</td>
                <td>Bodovi</td>
                <td>Izborni</td>
            </tr>
            <?php
            $all_courses = getAllCourses();
            for ($i = 0; $i < count($all_courses); $i++) {
                echo '<tr>
        <td >' . $all_courses[$i]['courseCode'] . '</td>
            <td >' . $all_courses[$i]['courseName'] . '</td>
                <td >' . $all_courses[$i]['courseProgram'] . '</td>
                    <td >' . $all_courses[$i]['coursePoints'] . '</td>
                        <td >' . $all_courses[$i]['elective'] . '</td>
                            <td>                                 
<form method="post" action="edit.php">
<button type="submit" name="edit" value="' . $all_courses[$i]['courseCode'] . '"/>' . "Uredi" . '</button></form>
    </form>
    <form method="post">
                                        
<button type="submit" name="delete" value="' . $all_courses[$i]['courseCode'] . '"/>' . "Izbrisi" . '</button></form> 
    </form>
    </td>
    </tr>'
                ;
            }
            ?></table>


    </body>
</html>

