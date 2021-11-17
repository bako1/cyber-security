<?php

include('loginverifier.php');
include_once 'vendor/autoload.php';
$loader = new \Twig\Loader\FilesystemLoader('views/');
$twig = new \Twig\Environment($loader);
echo $twig->render('navbar.html.twig');
$loginverifier = new Loginverifier;
$loginverifier->__constract();
$loginverifier->stLoginPressed();
$results = $loginverifier->getResults();
//echo $twig->render('studentinfo.html.twig', array('studinfo'=>$results));
if(!empty($results)){
    header("location:studLogin.php?Invalid=user not found");
}else{
    header("location:studinfo.php");
}