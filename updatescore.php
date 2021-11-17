

<?php
session_start();
include_once('Model/dbConnection.php');
include_once 'vendor/autoload.php';
$loader = new \Twig\Loader\FilesystemLoader('views/');
$twig = new \Twig\Environment($loader);
echo $twig->render('navbar.html.twig');
include_once('Model/dbConnection.php');
$db = new dbConnection;
$db->__constract('localhost','root','','graderecord');
$db->connectToDb();
$id;

if(isset($_GET['updateid'])){
   
    $_SESSION['id'] = $_GET['updateid'];
    if(isset($_SESSION['user']))
        {
            echo $twig->render("updatescore.html.twig");
        }else {
            header("location:index.php?access=denied");
        }
}
