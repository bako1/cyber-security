<?php

include_once 'vendor/autoload.php';
$loader = new \Twig\Loader\FilesystemLoader('views/');
$twig = new \Twig\Environment($loader);
echo $twig->render('navbar.html.twig');
include_once('Model/dbConnection.php');
$db = new dbConnection;
$db->__constract('localhost','root','','graderecord');
$db->connectToDb();

echo $twig->render("signup.html");
if(isset($_POST['signup'])){ //checks whether all fields are filled or not
    if(empty($_POST['fullname'] &&
     $_POST['email'] && 
     $_POST['password1'] &&
     $_POST['password2']))
     
     {
        //Not all filled are filled? redirect to sign up page
         header("location:signup.php?=empty");
         echo 'All fields are required!';
     }else
         { 
            $name =  $_POST['fullname'];
            $email = $_POST['email'];
            $pass1 = $_POST['password1'];
            $pass2 = $_POST['password2'];
            $minPassLength = 8;
            //checks wether repeated password is the same and length is >8
                if($pass1 === $pass2 &&
                 strlen($pass2)>=$minPassLength)
                 {
                    //checks for the combination of letters and numbers
                    if(preg_match("#[0-9]+#", $pass2) && 
                    preg_match("#[a-zA-Z]+#",$pass2))
                    {
                        //insert into data base
                        $db->insertRecords($name,$email,$pass2);
                    }else{
                        echo 'password must include both letters and number';
                    }
                }  
                else{ echo '<password is too short or password do not mutch>';}
               
            }
     }
    

