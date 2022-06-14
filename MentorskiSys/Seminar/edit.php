<?php
session_start();
require 'model/db.php';
if($_SESSION['role']!='mentor'){
    $_SESSION['login']=false;
    header("Location: login.php");
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST["update"])) {
        update_course($_POST['courseCode'], $_POST['courseProgram'], $_POST['coursePoints'], $_POST['sem_regular'], $_POST['sem_irregular'], $_POST['elective']);
        $_POST = array();
        header('Location: predmeti.php');
    }
}
$onecourse = get_course($_POST["edit"]);
echo '<b>' . $onecourse['0']['courseName'] . '</    b><table border="1" >
    <tr>
        <td>
        <table border="2">
        <tr ><td>' . "Sifra predmeta:" . '</td></tr>
            <tr ><td>' . "Program:" . '</td></tr>
                <tr ><td>' . "Bodovi:" . '</td></tr>
                    <tr ><td>' . "Redovni semestar:" . '</td></tr>
                        <tr ><td>' . "Izvanredni semestar:" . '</td></tr>
                            <tr ><td>' . "Izborni:" . '</td></tr>
                                </table>
                                </td>
<td><table border="2">
<tr ><td>' . $onecourse['0']['courseCode'] . '</td></tr>
    <tr ><td>' . $onecourse['0']['courseProgram'] . '</td></tr>
        <tr ><td>' . $onecourse['0']['coursePoints'] . '</td></tr>
            <tr ><td>' . $onecourse['0']['sem_regular'] . '</td></tr>
                <tr ><td>' . $onecourse['0']['sem_irregular'] . '</td></tr>
                    <tr ><td>' . $onecourse['0']['elective'] . '</td></tr>
                        </table>
                        </td>
                        <td>
                        <table border=2><form method="post">
                        <tr ><td> <input type="text" name="courseCode"  required="required"value="' . $onecourse['0']['courseCode'] . '" > 
                            </td></tr>
                            <tr ><td> <input type="textarea" name="courseProgram"  required="required"> </td></tr>
                            <tr ><td><input type="text" name="coursePoints" required="required"></td></tr>
                            <tr ><td><input type="text" name="sem_regular" required="required"></td></tr>
                            <tr ><td><input type="text" name="sem_irregular" required="required"></td></tr>
                            <tr ><td>"Da"<input type="radio" name="elective" value="da">
                            "Ne"<input type="radio" name="elective" value="ne"></td></tr>
                            </table>
                            </td>
                            </tr></table><input type="submit" name="update" value="Update"></br>                                        
                            </form>'
?>
<html>

    <head>
        <title>Page Title</title>
    </head>
    <body>
        <a href="predmeti.php"><button>Nazad</button></a>
    </body>

</html>


