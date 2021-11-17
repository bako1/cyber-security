<?php
include_once('dbConnection.php');

class Loginverifier{
    private $db;
    private $result;
    private $email;
    private $verified;

function __constract(){
    $this->db = new dbConnection;
    $this->db->__constract('localhost','root','','graderecord');
    $this->db->connectToDb();
    $this->verified = false;

}

/*function stLoginPressed(){
if(isset($_POST['stLogin']))

{ //checks whether all fields are filled or not
if(empty($_POST['stEmail']) || empty($_POST['stpassword']))
 
    {
    //Not all filled are filled? redirect to sign up page
     header("location:studLogin.php?=empty");
     echo 'All fields are required!';
    }
    else
     { 
     
        $stEmail =  $_POST['stEmail'];
        $pass = $_POST['stpassword'];
        $db = new dbConnection;
        $db->__constract('localhost','root','','graderecord');
        $db->connectToDb();
      

        
        if(!empty($this->result)){
            $success = false;
            foreach($this->result as $r)
             $success = password_verify($pass,$r['password']);
                if($success)
                { //if user is verified
                $this->result = $db->retrieveStud($stEmail);
                $_SESSION['user'] = $stEmail;
                header("location:studinfo.php");
                }
                     else{ //if no user with the provided e-mail and password is found
                    header("location:studLogin.php?Invalid=user not found");
                }
        } 
        

         }
 }
 return $this->result;

}  */ 
function nodataProvided($email,$password){
if(empty($email)||(empty($password)))
//Not all filled are filled? redirect studlogin page

{

    header("location:studLogin.php?=empty");
    echo 'All fields are required!';
}
}
function wrongdataProvided(){

  //if no user with the provided e-mail and password is found
  header("location:studLogin.php?Invalid=user not found");

}
//echo $twig->render('studentinfo.html.twig');//,array(
    //    "studentinfo" =>  $resul
    //));

function stLoginPressed(){
    if(isset($_POST['stLogin'])){
        $this->nodataProvided($_POST['stEmail'],$_POST['stpassword']);
    }
    else{
        $stEmail =  $_POST['stEmail'];
        $pass = $_POST['stpassword'];
         $this->result = $this->db->retrieveStud($stEmail);
         //if the user exists
         if(!empty($this->result)){
                foreach($this->result as $r)
                {   //check if password also maches
                    if(password_verify($this->hashSaltPass($pass),$r['password'])){
                        $_SESSION['user'] = $stEmail;
                       // header("location:studinfo.php");
                    }
                    else{
                        //if user is not verified 
                    // $this->result = header("location:studLogin.php?Invalid=user not found");
                    }
                }
         }
       
      }
      
}

function getResults(){
    return $this->result;
}
function hashSaltPass($password){
    return password_hash($password,PASSWORD_DEFAULT);
}
function getUser($email,$table){
    if($this->db->countrows($table)>=1)
        return $this->db->retrieveStud($email,$table);
    
}
function noUserFound($email,$table){
    if(empty($this->getUser($email,$table))){
        header("location:index.php?userdata=notfound");
    }
}
function verifyUser($email,$password,$table){
    if(!empty($email) && (!empty($password))){
        $this->noUserFound($email,$table);
        $this->result = $this->getUser($email,$table);
        foreach($this->result as $r){
            if(password_verify($password,$r['password'])){
                $this->verified = true;
              //  $_SESSION['user'] = $_POST['stEmail'];
            }else{
                
                header("location:index.php?userdata=notfound");
            }
        }
    }else{
        header("location:index.php?userdata=empty");
    }
    return $this->verified;}
    

function allrecords($table){
 return $this->db->retrieveAll($table);
}
function dbinstance(){
    return $this->db;
}
}