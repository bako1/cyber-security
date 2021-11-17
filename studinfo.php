<?php
session_start();
include('Model/loginverifier.php');
include_once 'vendor/autoload.php';
$loader = new \Twig\Loader\FilesystemLoader('views/');
$twig = new \Twig\Environment($loader);
echo $twig->render('navbar.html.twig');


$lVerifier = new Loginverifier;
$lVerifier->__constract();
$table = 'records';
if(isset($_POST['stLogin'])){
if($lVerifier->verifyUser($_POST['stEmail'],$_POST['stpassword'],$table)){
    $stEmail = $_POST['stEmail'];
    $results=$lVerifier->getUser($stEmail,$table);
    
    $_SESSION['stuser'] = $stEmail;
    echo $twig->render('studentinfo.html.twig', array('studinfo'=>$results));
}
}