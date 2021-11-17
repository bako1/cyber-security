
<?php
include_once('Model/dbConnection.php');
include_once 'vendor/autoload.php';
$loader = new \Twig\Loader\FilesystemLoader('views/');
$twig = new \Twig\Environment($loader);
$db = new dbConnection;
$db->__constract('localhost','root','','graderecord');
$db->connectToDb();
class editscore{
    function edit(){
        if(isset($_GET['update'])){
            echo $_GET['newscore'];
        }
    }
}