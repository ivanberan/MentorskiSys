
<?php
session_start();
require 'model/db.php';
if($_SESSION['role']!='student'){
    $_SESSION['login']=false;
    header("Location: login.php");
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST["enroll"])) {
        enrollCourse($_SESSION['student'], $_POST["enroll"]); 
        unset($_POST["enroll"]);
    }
    if (isset($_POST["status"])) {
        updateCourseStatus($_SESSION['student'],$_POST["temp"], $_POST["status"]);
        unset($_POST["status"]);
     
    }
    if (isset($_POST["unenroll"])) {
        unenrollCourse($_SESSION['student'], $_POST["unenroll"]); 
        unset($_POST["unenroll"]);
    }
}
if (isset($_POST["edit"])) {
    $_SESSION['email'] = $_POST["edit"];
}
$student = get_user_by_email($_SESSION['email']);
$_SESSION['student'] = $student["0"]["id"];
$user_courses = getAllCoursesForUser($_SESSION['student']);
$not_enrolled_courses = getAllUnenrolledCourses($_SESSION['student']);

?>
<html>

    <head>
        <title>Page Title</title>
    </head>

    <body>
        <body>
        <table border="1">
            <tr>
                <td><a href='logout.php'><button>Logout</button></a><br></td>
            </tr>
            
            
        
            <tr>
                <td>
                    <?php
                    for ($j = 0; $j < count($not_enrolled_courses); $j++) {
                        echo'<table border="2">
                                    <tr ><td>' . $not_enrolled_courses[$j]['courseCode'] . '</td></tr>
                                    <tr ><td>' . $not_enrolled_courses[$j]['courseName'] . '</td></tr>
                                    <tr><td><form method="post"><button type="submit" name="enroll" value=' . $not_enrolled_courses[$j]['course_id'] . '>' . "Upiši" . '</button></form>
                                       </table>
                                        '

                        ;
                    }
                    ?>
                </td>
                <td>
                    <?php
                    if ($student["0"]["status"] == "redovni") {
                        echo '<b>Redovni</b></br>';
                        echo'Prvi semestar</br>';
                        for ($i = 0; $i < count($user_courses); $i++) {
                            if ($user_courses[$i]['sem_regular'] == "1") {
                                echo '
                            <table border="1" >
                            <b>' . $user_courses[$i]['courseName'] . '</b>
                                <tr>
                                    <td>
                                        <table border="2">
                                    <tr ><td>' . "Sifra predmeta:" . '</td></tr>
                                    <tr ><td>' . "Ime predmeta:" . '</td></tr>
                                    <tr ><td>' . "Program:" . '</td></tr>
                                    <tr ><td>' . "Bodovi:" . '</td></tr>
                                    <tr ><td>' . "Status:" . '</td></tr>
                                    <tr ><td>' . "Semestar:" . '</td></tr>
                                    <tr ><td>' . "Izborni:" . '</td></tr>
                                        </table>
                                    </td>
                                    <td><table border="2">
                                    <tr ><td>' . $user_courses[$i]['courseCode'] . '</td></tr>
                                    <tr ><td>' . $user_courses[$i]['courseName'] . '</td></tr>
                                    <tr ><td>' . $user_courses[$i]['courseProgram'] . '</td></tr>
                                    <tr ><td>' . $user_courses[$i]['coursePoints'] . '</td></tr>
                                    <tr ><td>' . $user_courses[$i]['status'] . '</td></tr>
                                    <tr ><td>' . $user_courses[$i]['sem_regular'] . '</td></tr>
                                    <tr ><td>' . $user_courses[$i]['elective'] . '</td></tr>
                                        </table>
                                        </td>
                                        </tr>
                                       <tr><td><form method="post"><input type="hidden" name="temp" value="'.$user_courses[$i]['course_id'].'">
                                       <button type="submit" name="status" value="passed">' . "Položen" . '</button>
                                           <button type="submit" name="status" value="enrolled">' . "Upisan" . '</button></form></td>
                                               <td><form method="post"><button type="submit" name="unenroll" value="'.$user_courses[$i]['course_id'].'">' . "Ispiši" . '</button></form></td>
                                               </tr>
                         </table>';
                            }
                        }

                        echo'Drugi semestar</br>';
                        for ($i = 0; $i < count($user_courses); $i++) {
                            if ($user_courses[$i]['sem_regular'] == "2") {
                                echo '
                            <table border="1" >
                            <b>' . $user_courses[$i]['courseName'] . '</b>
                                <tr>
                                    <td>
                                        <table border="2">
                                    <tr ><td>' . "Sifra predmeta:" . '</td></tr>
                                    <tr ><td>' . "Ime predmeta:" . '</td></tr>
                                    <tr ><td>' . "Program:" . '</td></tr>
                                    <tr ><td>' . "Bodovi:" . '</td></tr>
                                    <tr ><td>' . "Status:" . '</td></tr>
                                    <tr ><td>' . "Semestar:" . '</td></tr>
                                    <tr ><td>' . "Izborni:" . '</td></tr>
                                        </table>
                                    </td>
                                    <td><table border="2">
                                    <tr ><td>' . $user_courses[$i]['courseCode'] . '</td></tr>
                                    <tr ><td>' . $user_courses[$i]['courseName'] . '</td></tr>
                                    <tr ><td>' . $user_courses[$i]['courseProgram'] . '</td></tr>
                                    <tr ><td>' . $user_courses[$i]['coursePoints'] . '</td></tr>
                                    <tr ><td>' . $user_courses[$i]['status'] . '</td></tr>
                                    <tr ><td>' . $user_courses[$i]['sem_regular'] . '</td></tr>
                                    <tr ><td>' . $user_courses[$i]['elective'] . '</td></tr>
                                        </table>
                                       </td>
                                        </tr>
                                       <tr><td><form method="post"><input type="hidden" name="temp" value="'.$user_courses[$i]['course_id'].'">
                                       <button type="submit" name="status" value="passed">' . "Položen" . '</button>
                                           <button type="submit" name="status" value="enrolled">' . "Upisan" . '</button></form></td>
                                               <td><form method="post"><button type="submit" name="unenroll" value="'.$user_courses[$i]['course_id'].'">' . "Ispiši" . '</button></form></td>
                                               </tr> </table>';
                            }
                        }
                        echo'Treci semestar</br>';
                        for ($i = 0; $i < count($user_courses); $i++) {
                            if ($user_courses[$i]['sem_regular'] == "3") {
                                echo '
                            <table border="1" >
                            <b>' . $user_courses[$i]['courseName'] . '</b>
                                <tr>
                                    <td>
                                        <table border="2">
                                    <tr ><td>' . "Sifra predmeta:" . '</td></tr>
                                    <tr ><td>' . "Ime predmeta:" . '</td></tr>
                                    <tr ><td>' . "Program:" . '</td></tr>
                                    <tr ><td>' . "Bodovi:" . '</td></tr>
                                    <tr ><td>' . "Status:" . '</td></tr>
                                    <tr ><td>' . "Semestar:" . '</td></tr>
                                    <tr ><td>' . "Izborni:" . '</td></tr>
                                        </table>
                                    </td>
                                    <td><table border="2">
                                    <tr ><td>' . $user_courses[$i]['courseCode'] . '</td></tr>
                                    <tr ><td>' . $user_courses[$i]['courseName'] . '</td></tr>
                                    <tr ><td>' . $user_courses[$i]['courseProgram'] . '</td></tr>
                                    <tr ><td>' . $user_courses[$i]['coursePoints'] . '</td></tr>
                                    <tr ><td>' . $user_courses[$i]['status'] . '</td></tr>
                                    <tr ><td>' . $user_courses[$i]['sem_regular'] . '</td></tr>
                                    <tr ><td>' . $user_courses[$i]['elective'] . '</td></tr>
                                        </table>
                                       </td>
                                        </tr>
                                       <tr><td><form method="post"><input type="hidden" name="temp" value="'.$user_courses[$i]['course_id'].'">
                                       <button type="submit" name="status" value="passed">' . "Položen" . '</button>
                                           <button type="submit" name="status" value="enrolled">' . "Upisan" . '</button></form></td>
                                               <td><form method="post"><button type="submit" name="unenroll" value="'.$user_courses[$i]['course_id'].'">' . "Ispiši" . '</button></form></td>
                                               </tr> </table>';
                            }
                        }
                        echo'Četvrti semestar</br>';
                        for ($i = 0; $i < count($user_courses); $i++) {
                            if ($user_courses[$i]['sem_regular'] == "4") {
                                echo '
                            <table border="1" >
                            <b>' . $user_courses[$i]['courseName'] . '</b>
                                <tr>
                                    <td>
                                        <table border="2">
                                    <tr ><td>' . "Sifra predmeta:" . '</td></tr>
                                    <tr ><td>' . "Ime predmeta:" . '</td></tr>
                                    <tr ><td>' . "Program:" . '</td></tr>
                                    <tr ><td>' . "Bodovi:" . '</td></tr>
                                    <tr ><td>' . "Status:" . '</td></tr>
                                    <tr ><td>' . "Semestar:" . '</td></tr>
                                    <tr ><td>' . "Izborni:" . '</td></tr>
                                        </table>
                                    </td>
                                    <td><table border="2">
                                    <tr ><td>' . $user_courses[$i]['courseCode'] . '</td></tr>
                                    <tr ><td>' . $user_courses[$i]['courseName'] . '</td></tr>
                                    <tr ><td>' . $user_courses[$i]['courseProgram'] . '</td></tr>
                                    <tr ><td>' . $user_courses[$i]['coursePoints'] . '</td></tr>
                                    <tr ><td>' . $user_courses[$i]['status'] . '</td></tr>
                                    <tr ><td>' . $user_courses[$i]['sem_regular'] . '</td></tr>
                                    <tr ><td>' . $user_courses[$i]['elective'] . '</td></tr>
                                        </table>
                                        </td>
                                        </tr>
                                       <tr><td><form method="post"><input type="hidden" name="temp" value="'.$user_courses[$i]['course_id'].'">
                                       <button type="submit" name="status" value="passed">' . "Položen" . '</button>
                                           <button type="submit" name="status" value="enrolled">' . "Upisan" . '</button></form></td>
                                               <td><form method="post"><button type="submit" name="unenroll" value="'.$user_courses[$i]['course_id'].'">' . "Ispiši" . '</button></form></td>
                                               </tr></table>';
                            }
                        }
                        echo'Peti semestar</br>';
                        for ($i = 0; $i < count($user_courses); $i++) {
                            if ($user_courses[$i]['sem_regular'] == "5") {
                                echo '
                            <table border="1" >
                            <b>' . $user_courses[$i]['courseName'] . '</b>
                                <tr>
                                    <td>
                                        <table border="2">
                                    <tr ><td>' . "Sifra predmeta:" . '</td></tr>
                                    <tr ><td>' . "Ime predmeta:" . '</td></tr>
                                    <tr ><td>' . "Program:" . '</td></tr>
                                    <tr ><td>' . "Bodovi:" . '</td></tr>
                                    <tr ><td>' . "Status:" . '</td></tr>
                                    <tr ><td>' . "Semestar:" . '</td></tr>
                                    <tr ><td>' . "Izborni:" . '</td></tr>
                                        </table>
                                    </td>
                                    <td><table border="2">
                                    <tr ><td>' . $user_courses[$i]['courseCode'] . '</td></tr>
                                    <tr ><td>' . $user_courses[$i]['courseName'] . '</td></tr>
                                    <tr ><td>' . $user_courses[$i]['courseProgram'] . '</td></tr>
                                    <tr ><td>' . $user_courses[$i]['coursePoints'] . '</td></tr>
                                    <tr ><td>' . $user_courses[$i]['status'] . '</td></tr>
                                    <tr ><td>' . $user_courses[$i]['sem_regular'] . '</td></tr>
                                    <tr ><td>' . $user_courses[$i]['elective'] . '</td></tr>
                                        </table>
                                            </td>
                                        </tr>
                                       <tr><td><form method="post"><input type="hidden" name="temp" value="'.$user_courses[$i]['course_id'].'">
                                       <button type="submit" name="status" value="passed">' . "Položen" . '</button>
                                           <button type="submit" name="status" value="enrolled">' . "Upisan" . '</button></form></td>
                                               <td><form method="post"><button type="submit" name="unenroll" value="'.$user_courses[$i]['course_id'].'">' . "Ispiši" . '</button></form></td>
                                               </tr></table>';
                            }
                        }
                        echo'Šesti semestar</br>';
                        for ($i = 0; $i < count($user_courses); $i++) {
                            if ($user_courses[$i]['sem_regular'] == "6") {
                                echo '
                            <table border="1" >
                            <b>' . $user_courses[$i]['courseName'] . '</b>
                                <tr>
                                    <td>
                                        <table border="2">
                                    <tr ><td>' . "Sifra predmeta:" . '</td></tr>
                                    <tr ><td>' . "Ime predmeta:" . '</td></tr>
                                    <tr ><td>' . "Program:" . '</td></tr>
                                    <tr ><td>' . "Bodovi:" . '</td></tr>
                                    <tr ><td>' . "Status:" . '</td></tr>
                                    <tr ><td>' . "Semestar:" . '</td></tr>
                                    <tr ><td>' . "Izborni:" . '</td></tr>
                                        </table>
                                    </td>
                                    <td><table border="2">
                                    <tr ><td>' . $user_courses[$i]['courseCode'] . '</td></tr>
                                    <tr ><td>' . $user_courses[$i]['courseName'] . '</td></tr>
                                    <tr ><td>' . $user_courses[$i]['courseProgram'] . '</td></tr>
                                    <tr ><td>' . $user_courses[$i]['coursePoints'] . '</td></tr>
                                    <tr ><td>' . $user_courses[$i]['status'] . '</td></tr>
                                    <tr ><td>' . $user_courses[$i]['sem_regular'] . '</td></tr>
                                    <tr ><td>' . $user_courses[$i]['elective'] . '</td></tr>
                                        </table>
                                      </td>
                                        </tr>
                                       <tr><td><form method="post"><input type="hidden" name="temp" value="'.$user_courses[$i]['course_id'].'">
                                       <button type="submit" name="status" value="passed">' . "Položen" . '</button>
                                           <button type="submit" name="status" value="enrolled">' . "Upisan" . '</button></form></td>
                                               <td><form method="post"><button type="submit" name="unenroll" value="'.$user_courses[$i]['course_id'].'">' . "Ispiši" . '</button></form></td>
                                               </tr></table>';
                            }
                        }
                    }
                    if ($student["0"]["status"] == "izvanredni") {
                        echo '<b>Izvanredni</b></br>';
                        echo'Prvi semestar</br>';
                        for ($i = 0; $i < count($user_courses); $i++) {
                            if ($user_courses[$i]['sem_irregular'] == "1") {
                                echo '
                            <table border="1" >
                            <b>' . $user_courses[$i]['courseName'] . '</b>
                                <tr>
                                    <td>
                                        <table border="2">
                                    <tr ><td>' . "Sifra predmeta:" . '</td></tr>
                                    <tr ><td>' . "Ime predmeta:" . '</td></tr>
                                    <tr ><td>' . "Program:" . '</td></tr>
                                    <tr ><td>' . "Bodovi:" . '</td></tr>
                                    <tr ><td>' . "Status:" . '</td></tr>
                                    <tr ><td>' . "Semestar:" . '</td></tr>
                                    <tr ><td>' . "Izborni:" . '</td></tr>
                                        </table>
                                    </td>
                                    <td><table border="2">
                                    <tr ><td>' . $user_courses[$i]['courseCode'] . '</td></tr>
                                    <tr ><td>' . $user_courses[$i]['courseName'] . '</td></tr>
                                    <tr ><td>' . $user_courses[$i]['courseProgram'] . '</td></tr>
                                    <tr ><td>' . $user_courses[$i]['coursePoints'] . '</td></tr>
                                    <tr ><td>' . $user_courses[$i]['status'] . '</td></tr>
                                    <tr ><td>' . $user_courses[$i]['sem_irregular'] . '</td></tr>
                                    <tr ><td>' . $user_courses[$i]['elective'] . '</td></tr>
                                        </table>
                                      </td>
                                        </tr>
                                       <tr><td><form method="post"><input type="hidden" name="temp" value="'.$user_courses[$i]['course_id'].'">
                                       <button type="submit" name="status" value="passed">' . "Položen" . '</button>
                                           <button type="submit" name="status" value="enrolled">' . "Upisan" . '</button></form></td>
                                               <td><form method="post"><button type="submit" name="unenroll" value="'.$user_courses[$i]['course_id'].'">' . "Ispiši" . '</button></form></td>
                                               </tr></table>';
                            }
                        }

                        echo'Drugi semestar</br>';
                        for ($i = 0; $i < count($user_courses); $i++) {
                            if ($user_courses[$i]['sem_irregular'] == "2") {
                                echo '
                            <table border="1" >
                            <b>' . $user_courses[$i]['courseName'] . '</b>
                                <tr>
                                    <td>
                                        <table border="2">
                                    <tr ><td>' . "Sifra predmeta:" . '</td></tr>
                                    <tr ><td>' . "Ime predmeta:" . '</td></tr>
                                    <tr ><td>' . "Program:" . '</td></tr>
                                    <tr ><td>' . "Bodovi:" . '</td></tr>
                                    <tr ><td>' . "Status:" . '</td></tr>
                                    <tr ><td>' . "Semestar:" . '</td></tr>
                                    <tr ><td>' . "Izborni:" . '</td></tr>
                                        </table>
                                    </td>
                                    <td><table border="2">
                                    <tr ><td>' . $user_courses[$i]['courseCode'] . '</td></tr>
                                    <tr ><td>' . $user_courses[$i]['courseName'] . '</td></tr>
                                    <tr ><td>' . $user_courses[$i]['courseProgram'] . '</td></tr>
                                    <tr ><td>' . $user_courses[$i]['coursePoints'] . '</td></tr>
                                    <tr ><td>' . $user_courses[$i]['status'] . '</td></tr>
                                    <tr ><td>' . $user_courses[$i]['sem_irregular'] . '</td></tr>
                                    <tr ><td>' . $user_courses[$i]['elective'] . '</td></tr>
                                        </table>
                                      </td>
                                        </tr>
                                       <tr><td><form method="post"><input type="hidden" name="temp" value="'.$user_courses[$i]['course_id'].'">
                                       <button type="submit" name="status" value="passed">' . "Položen" . '</button>
                                           <button type="submit" name="status" value="enrolled">' . "Upisan" . '</button></form></td>
                                               <td><form method="post"><button type="submit" name="unenroll" value="'.$user_courses[$i]['course_id'].'">' . "Ispiši" . '</button></form></td>
                                               </tr> </table>';
                            }
                        }
                        echo'Treci semestar</br>';
                        for ($i = 0; $i < count($user_courses); $i++) {
                            if ($user_courses[$i]['sem_irregular'] == "3") {
                                echo '
                            <table border="1" >
                            <b>' . $user_courses[$i]['courseName'] . '</b>
                                <tr>
                                    <td>
                                        <table border="2">
                                    <tr ><td>' . "Sifra predmeta:" . '</td></tr>
                                    <tr ><td>' . "Ime predmeta:" . '</td></tr>
                                    <tr ><td>' . "Program:" . '</td></tr>
                                    <tr ><td>' . "Bodovi:" . '</td></tr>
                                    <tr ><td>' . "Status:" . '</td></tr>
                                    <tr ><td>' . "Semestar:" . '</td></tr>
                                    <tr ><td>' . "Izborni:" . '</td></tr>
                                        </table>
                                    </td>
                                    <td><table border="2">
                                    <tr ><td>' . $user_courses[$i]['courseCode'] . '</td></tr>
                                    <tr ><td>' . $user_courses[$i]['courseName'] . '</td></tr>
                                    <tr ><td>' . $user_courses[$i]['courseProgram'] . '</td></tr>
                                    <tr ><td>' . $user_courses[$i]['coursePoints'] . '</td></tr>
                                    <tr ><td>' . $user_courses[$i]['status'] . '</td></tr>
                                    <tr ><td>' . $user_courses[$i]['sem_irregular'] . '</td></tr>
                                    <tr ><td>' . $user_courses[$i]['elective'] . '</td></tr>
                                        </table>
                                       </td>
                                        </tr>
                                       <tr><td><form method="post"><input type="hidden" name="temp" value="'.$user_courses[$i]['course_id'].'">
                                       <button type="submit" name="status" value="passed">' . "Položen" . '</button>
                                           <button type="submit" name="status" value="enrolled">' . "Upisan" . '</button></form></td>
                                               <td><form method="post"><button type="submit" name="unenroll" value="'.$user_courses[$i]['course_id'].'">' . "Ispiši" . '</button></form></td>
                                               </tr></table>';
                            }
                        }
                        echo'Četvrti semestar</br>';
                        for ($i = 0; $i < count($user_courses); $i++) {
                            if ($user_courses[$i]['sem_irregular'] == "4") {
                                echo '
                            <table border="1" >
                            <b>' . $user_courses[$i]['courseName'] . '</b>
                                <tr>
                                    <td>
                                        <table border="2">
                                    <tr ><td>' . "Sifra predmeta:" . '</td></tr>
                                    <tr ><td>' . "Ime predmeta:" . '</td></tr>
                                    <tr ><td>' . "Program:" . '</td></tr>
                                    <tr ><td>' . "Bodovi:" . '</td></tr>
                                    <tr ><td>' . "Status:" . '</td></tr>
                                    <tr ><td>' . "Semestar:" . '</td></tr>
                                    <tr ><td>' . "Izborni:" . '</td></tr>
                                        </table>
                                    </td>
                                    <td><table border="2">
                                    <tr ><td>' . $user_courses[$i]['courseCode'] . '</td></tr>
                                    <tr ><td>' . $user_courses[$i]['courseName'] . '</td></tr>
                                    <tr ><td>' . $user_courses[$i]['courseProgram'] . '</td></tr>
                                    <tr ><td>' . $user_courses[$i]['coursePoints'] . '</td></tr>
                                    <tr ><td>' . $user_courses[$i]['status'] . '</td></tr>
                                    <tr ><td>' . $user_courses[$i]['sem_irregular'] . '</td></tr>
                                    <tr ><td>' . $user_courses[$i]['elective'] . '</td></tr>
                                        </table>
                                      </td>
                                        </tr>
                                       <tr><td><form method="post"><input type="hidden" name="temp" value="'.$user_courses[$i]['course_id'].'">
                                       <button type="submit" name="status" value="passed">' . "Položen" . '</button>
                                           <button type="submit" name="status" value="enrolled">' . "Upisan" . '</button></form></td>
                                               <td><form method="post"><button type="submit" name="unenroll" value="'.$user_courses[$i]['course_id'].'">' . "Ispiši" . '</button></form></td>
                                               </tr></table>';
                            }
                        }
                        echo'Peti semestar</br>';
                        for ($i = 0; $i < count($user_courses); $i++) {
                            if ($user_courses[$i]['sem_irregular'] == "5") {
                                echo '
                            <table border="1" >
                            <b>' . $user_courses[$i]['courseName'] . '</b>
                                <tr>
                                    <td>
                                        <table border="2">
                                    <tr ><td>' . "Sifra predmeta:" . '</td></tr>
                                    <tr ><td>' . "Ime predmeta:" . '</td></tr>
                                    <tr ><td>' . "Program:" . '</td></tr>
                                    <tr ><td>' . "Bodovi:" . '</td></tr>
                                    <tr ><td>' . "Status:" . '</td></tr>
                                    <tr ><td>' . "Semestar:" . '</td></tr>
                                    <tr ><td>' . "Izborni:" . '</td></tr>
                                        </table>
                                    </td>
                                    <td><table border="2">
                                    <tr ><td>' . $user_courses[$i]['courseCode'] . '</td></tr>
                                    <tr ><td>' . $user_courses[$i]['courseName'] . '</td></tr>
                                    <tr ><td>' . $user_courses[$i]['courseProgram'] . '</td></tr>
                                    <tr ><td>' . $user_courses[$i]['coursePoints'] . '</td></tr>
                                    <tr ><td>' . $user_courses[$i]['status'] . '</td></tr>
                                    <tr ><td>' . $user_courses[$i]['sem_irregular'] . '</td></tr>
                                    <tr ><td>' . $user_courses[$i]['elective'] . '</td></tr>
                                        </table>
                                       </td>
                                        </tr>
                                       <tr><td><form method="post"><input type="hidden" name="temp" value="'.$user_courses[$i]['course_id'].'">
                                       <button type="submit" name="status" value="passed">' . "Položen" . '</button>
                                           <button type="submit" name="status" value="enrolled">' . "Upisan" . '</button></form></td>
                                               <td><form method="post"><button type="submit" name="unenroll" value="'.$user_courses[$i]['course_id'].'">' . "Ispiši" . '</button></form></td>
                                               </tr></table>';
                            }
                        }
                        echo'Šesti semestar</br>';
                        for ($i = 0; $i < count($user_courses); $i++) {
                            if ($user_courses[$i]['sem_irregular'] == "6") {
                                echo '
                            <table border="1" >
                            <b>' . $user_courses[$i]['courseName'] . '</b>
                                <tr>
                                    <td>
                                        <table border="2">
                                    <tr ><td>' . "Sifra predmeta:" . '</td></tr>
                                    <tr ><td>' . "Ime predmeta:" . '</td></tr>
                                    <tr ><td>' . "Program:" . '</td></tr>
                                    <tr ><td>' . "Bodovi:" . '</td></tr>
                                    <tr ><td>' . "Status:" . '</td></tr>
                                    <tr ><td>' . "Semestar:" . '</td></tr>
                                    <tr ><td>' . "Izborni:" . '</td></tr>
                                        </table>
                                    </td>
                                    <td><table border="2">
                                    <tr ><td>' . $user_courses[$i]['courseCode'] . '</td></tr>
                                    <tr ><td>' . $user_courses[$i]['courseName'] . '</td></tr>
                                    <tr ><td>' . $user_courses[$i]['courseProgram'] . '</td></tr>
                                    <tr ><td>' . $user_courses[$i]['coursePoints'] . '</td></tr>
                                    <tr ><td>' . $user_courses[$i]['status'] . '</td></tr>
                                    <tr ><td>' . $user_courses[$i]['sem_irregular'] . '</td></tr>
                                    <tr ><td>' . $user_courses[$i]['elective'] . '</td></tr>
                                        </table>
                                     </td>
                                        </tr>
                                       <tr><td><form method="post"><input type="hidden" name="temp" value="'.$user_courses[$i]['course_id'].'">
                                       <button type="submit" name="status" value="passed">' . "Položen" . '</button>
                                           <button type="submit" name="status" value="enrolled">' . "Upisan" . '</button></form></td>
                                               <td><form method="post"><button type="submit" name="unenroll" value="'.$user_courses[$i]['course_id'].'">' . "Ispiši" . '</button></form></td>
                                               </tr></table>';
                            }
                        }
                        echo'Sedmi semestar</br>';
                        for ($i = 0; $i < count($user_courses); $i++) {
                            if ($user_courses[$i]['sem_irregular'] == "7") {
                                echo '
                            <table border="1" >
                            <b>' . $user_courses[$i]['courseName'] . '</b>
                                <tr>
                                    <td>
                                        <table border="2">
                                    <tr ><td>' . "Sifra predmeta:" . '</td></tr>
                                    <tr ><td>' . "Ime predmeta:" . '</td></tr>
                                    <tr ><td>' . "Program:" . '</td></tr>
                                    <tr ><td>' . "Bodovi:" . '</td></tr>
                                    <tr ><td>' . "Status:" . '</td></tr>
                                    <tr ><td>' . "Semestar:" . '</td></tr>
                                    <tr ><td>' . "Izborni:" . '</td></tr>
                                        </table>
                                    </td>
                                    <td><table border="2">
                                    <tr ><td>' . $user_courses[$i]['courseCode'] . '</td></tr>
                                    <tr ><td>' . $user_courses[$i]['courseName'] . '</td></tr>
                                    <tr ><td>' . $user_courses[$i]['courseProgram'] . '</td></tr>
                                    <tr ><td>' . $user_courses[$i]['coursePoints'] . '</td></tr>
                                    <tr ><td>' . $user_courses[$i]['status'] . '</td></tr>
                                    <tr ><td>' . $user_courses[$i]['sem_irregular'] . '</td></tr>
                                    <tr ><td>' . $user_courses[$i]['elective'] . '</td></tr>
                                        </table>
                                     </td>
                                        </tr>
                                       <tr><td><form method="post"><input type="hidden" name="temp" value="'.$user_courses[$i]['course_id'].'">
                                       <button type="submit" name="status" value="passed">' . "Položen" . '</button>
                                           <button type="submit" name="status" value="enrolled">' . "Upisan" . '</button></form></td>
                                               <td><form method="post"><button type="submit" name="unenroll" value="'.$user_courses[$i]['course_id'].'">' . "Ispiši" . '</button></form></td>
                                               </tr></table>';
                            }
                        }
                        echo'Osmi semestar</br>';
                        for ($i = 0; $i < count($user_courses); $i++) {
                            if ($user_courses[$i]['sem_irregular'] == "8") {
                                echo '
                            <table border="1" >
                            <b>' . $user_courses[$i]['courseName'] . '</b>
                                <tr>
                                    <td>
                                        <table border="2">
                                    <tr ><td>' . "Sifra predmeta:" . '</td></tr>
                                    <tr ><td>' . "Ime predmeta:" . '</td></tr>
                                    <tr ><td>' . "Program:" . '</td></tr>
                                    <tr ><td>' . "Bodovi:" . '</td></tr>
                                    <tr ><td>' . "Status:" . '</td></tr>
                                    <tr ><td>' . "Semestar:" . '</td></tr>
                                    <tr ><td>' . "Izborni:" . '</td></tr>
                                        </table>
                                    </td>
                                    <td><table border="2">
                                    <tr ><td>' . $user_courses[$i]['courseCode'] . '</td></tr>
                                    <tr ><td>' . $user_courses[$i]['courseName'] . '</td></tr>
                                    <tr ><td>' . $user_courses[$i]['courseProgram'] . '</td></tr>
                                    <tr ><td>' . $user_courses[$i]['coursePoints'] . '</td></tr>
                                    <tr ><td>' . $user_courses[$i]['status'] . '</td></tr>
                                    <tr ><td>' . $user_courses[$i]['sem_irregular'] . '</td></tr>
                                    <tr ><td>' . $user_courses[$i]['elective'] . '</td></tr>
                                        </table>
                                      </td>
                                        </tr>
                                       <tr><td><form method="post"><input type="hidden" name="temp" value="'.$user_courses[$i]['course_id'].'">
                                       <button type="submit" name="status" value="passed">' . "Položen" . '</button>
                                           <button type="submit" name="status" value="enrolled">' . "Upisan" . '</button></form></td>
                                               <td><form method="post"><button type="submit" name="unenroll" value="'.$user_courses[$i]['course_id'].'">' . "Ispiši" . '</button></form></td>
                                               </tr> </table>';
                            }
                        }
                    }
                    ?>
                </td>
            </tr>     
        </table>

    </body>

</html>