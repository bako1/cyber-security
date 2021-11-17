<?php
session_start();
include_once('Model/loginverifier.php');
include_once 'vendor/autoload.php';
include_once('Model/dbConnection.php');
$loader = new \Twig\Loader\FilesystemLoader('views/');
$twig = new \Twig\Environment($loader);
echo $twig->render('navbar.html.twig');
$lVerifier = new Loginverifier;
$lVerifier->__constract();
$teacherTable = 'teacher';
$scoreTable = 'score';
$db = new dbConnection;
$db->__constract('localhost','root','','graderecord');
$db->connectToDb();
//extra check to make sure that session is not been modified
if(isset($_SESSION['user']) && 
!empty(($db->retrieveStud($_SESSION['user'],'teacher')))){
    
        
     
     echo $twig->render('scale.twig');
   
        if(isset($_POST['submit'])){
            if(empty($_POST['minA']) || empty($_POST['maxA'])  ||
                empty($_POST['minB']) ||empty($_POST['maxB']) ||
                empty($_POST['minC']) ||empty($_POST['maxC']) ||
                empty($_POST['minD']) ||empty($_POST['maxD']) ||
                empty($_POST['minE']) ||empty($_POST['maxE']))
                {
                   
                 
                }else{
                    $minA = $_POST['minA'];
                    $minB = $_POST['minB'];
                    $minC = $_POST['minC'];
                    $minD = $_POST['minD'];
                    $minE = $_POST['minE'];

                    $maxA = $_POST['maxA'];
                    $maxB = $_POST['maxB'];
                    $maxC = $_POST['maxC'];
                    $maxD = $_POST['maxD'];
                    $maxE = $_POST['maxE'];
                    
                    $db->connectToDb();
                    $db->updateScale($minA,$maxA,$minB,$maxB,
                                        $minC,$maxC,$minD,$maxD,
                                        $minE,$maxE,$_SESSION['user']);


                    
         }
            
            }
    }else{
        header("location:index.php?access=denied");
    }

