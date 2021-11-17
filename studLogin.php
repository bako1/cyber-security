<?php
include_once 'vendor/autoload.php';
include_once 'Model/loginverifier.php';
$loader = new \Twig\Loader\FilesystemLoader('views/');
$twig = new \Twig\Environment($loader);
echo $twig->render('navbar.html.twig');
echo $twig->render('studlogin.html.twig');


/*
include_once('dbConnection.php');
class studinfo{
    private $db;
    private $result;

function __constract(){
    $this->db = new dbConnection;
    $this->db->__constract('localhost','root','','graderecord');
    $this->db->connectToDb();
}

function stLoginPressed(){
if(isset($_POST['stLogin']))

{ //checks whether all fields are filled or not
if(empty($_POST['stEmail'] && 
 $_POST['stpassword']))
 
    {
    //Not all filled are filled? redirect to sign up page
     header("location:studLogin.php?=empty");
     echo 'All fields are required!';
    }else
     { 
     
        $stEmail =  $_POST['stEmail'];
        $pass = $_POST['stpassword'];
        $db = new dbConnection;
        $db->__constract('localhost','root','','graderecord');
        $db->connectToDb();
      

        $this->result = $db->retrieveStud($stEmail);
        if(!empty($resul)){
            $success = false;
            foreach($resul as $r)
             $success = password_verify($pass,$r['password']);
            if($success){
           
            echo $this->twig->render('studentinfo.html.twig',array(
                "studentinfo" =>  $db->retrieveStud($stEmail)
            ));
            $_SESSION['user'] = $stEmail;
            header("location:process.php");}
        } else{
           // header("location:studLogin.php?Invalid=user not found");
        }
        

         }
 }
 return $this->result;

}   
}

//echo $twig->render('studentinfo.html.twig');//,array(
    //    "studentinfo" =>  $resul
    //));

*/