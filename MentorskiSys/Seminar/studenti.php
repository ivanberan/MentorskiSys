<?php
require 'model/db.php';
session_start();
if(isset($_SESSION['student'])){
    unset($_SESSION['student']);
}
if($_SESSION['role']!='mentor'){
    $_SESSION['login']=false;
    header("Location: login.php");
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   
    
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
        <table border="1">
            <tr>
                <td><a href='logout.php'><button>Logout</button></a><br></td>
                <td><a href='predmeti.php'><button>Predmeti</button></a></td>
                <td><a href='studenti.php'><button>Studenti</button></a></td>
            </tr>
            <tr><td><a href='mentor_index.php'><button>Nazad</button></a></td></tr>
            
       
        
           
            <?php
            $all_students = getAllStudents();
            for ($i = 0; $i < count($all_students); $i++) {
                echo '<tr>
                                    <td >' . $all_students[$i]['email'] . '</td>
                                    <td >' . $all_students[$i]['role'] . '</td>
                                    <td >' . $all_students[$i]['status'] . '</td>
                                    <td>
                                    
                                    <form method="post" action="edit_student.php">
                                        <button type="submit" name="edit" value="'.$all_students[$i]['email'].'"/>Uredi</button>
                                    </form>   
                                    </td>
                                    </tr>'
                ;
            }
            ?></table>


    </body>
</html>

