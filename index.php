<?php
include_once 'vendor/autoload.php';
$loader = new \Twig\Loader\FilesystemLoader('views/');
$twig = new \Twig\Environment($loader);
echo $twig->render('navbar.html.twig');
echo $twig->render('teacherlogin.html.twig');


