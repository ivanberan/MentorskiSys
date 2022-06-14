<?php
require 'model/db.php';
session_start();
if($_SESSION['role']!='mentor'){
    $_SESSION['login']=false;
    header("Location: login.php");
}
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true)
{
	header('Location: login.php');
}

/*if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (($_SESSION['role']='mentor')) {
        $img = getImage($_GET['imageID']);
        $content = 'templates/mentor.php';
    } elseif (($_SESSION['role']='student')) {
        $img = getImage($_GET['imageID']);
        $content = 'templates/studnet.php';
    }
}*/

   
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <table border='1'>
            <tr>
                <td><a href='logout.php'><button>Logout</button></a><br></td>
                <td><a href='predmeti.php'><button>Predmeti</button></a></td>
                <td><a href='studenti.php'><button>Studenti</button></a></td>
            </tr>
            
        </table>
        
    </body>
</html>