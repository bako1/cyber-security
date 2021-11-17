
<?php
session_start();
include('Model/loginverifier.php');
include_once 'vendor/autoload.php';
include_once 'Model/dbConnection.php';
include_once 'Model/calculategrade.php';
$loader = new \Twig\Loader\FilesystemLoader('views/');
$twig = new \Twig\Environment($loader);
$db = new dbConnection;
$calculategrade = new calculateGrade;


$db->__constract('localhost','root','','graderecord');
$db->connectToDb();
echo $twig->render('navbar.html.twig');

$lVerifier = new Loginverifier;
$lVerifier->__constract();
$table = 'teacher';
$studentTable = 'records';
if(isset($_POST['tLogin'])){
if($lVerifier->verifyUser($_POST['tEmail'],$_POST['tpassword'],$table)){
 
    $_SESSION['user'] = $_POST['tEmail'];
    $_SESSION['password'] = $_POST['tpassword'];
    echo $twig->render('student.html.twig', array('student_list'=>$lVerifier->allrecords($studentTable)));
    
}

}


if(isset($_POST['update']))
{
  if(isset($_SESSION['user'])){
     if( $_POST['newscore'])
      { $score = $_POST['newscore'];
         $id = $_SESSION['id'];
         $result = $db->retrieveAll('scale');
     
         if(!empty($result)){
            $grade = $calculategrade->calculate($result,$score);
         $db->update($id,$score,$grade);
         echo $twig->render('student.html.twig', array('student_list'=>$lVerifier->allrecords($studentTable)));

      }
      }else{
         header("location:updatescore.php?value=empty");
      }
  }
   else{
       header("location:index.php?access=denied please try later");
  }

}
if(isset($_GET['deleteid'])){
if(isset($_SESSION['user'])){
   $id = $_GET['deleteid'];
   $db->deleteRecord($id);
   echo $twig->render('student.html.twig', array('student_list'=>$lVerifier->allrecords($studentTable)));
}else{
   header("location:index.php?access=denied");
}
}
?>