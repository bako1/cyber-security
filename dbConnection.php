<?php
class  dbConnection{
 private $host; 
 private $user;
 private $password;
  private  $dbname; 
  private $charset;
 private $pdo;
 function __constract($host,$user,$password,$dbname){
  $this->host = $host;
  $this->user = $user;
  $this->password = $password;
  $this->dbname = $dbname;
  $this->charset = "utf8mb4";
  
 
 }

 function connectToDb(){
   try{
  $dsn = "mysql:host=".$this->host .";dbname=" .$this->dbname;
  $this->pdo = new PDO($dsn,$this->user, $this->password );
   }catch(PDOException $e){
    echo 'Connection failed: ' . $e->getMessage();
   }

 }

 function retrieveAll($table){
   
   //Defoult if you need not to provide argument for fetch()
  $this->pdo ->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);
  $result =  $this->pdo->query("SELECT * FROM $table");
  return $result;
 }
 function update($id, $score,$grade){
   try{
  
  $sql = 'UPDATE records SET score = :score, grade = :grade WHERE id = :id';
  $stmt = $this->pdo->prepare($sql);
  $stmt->execute(['score' =>$score, 'grade'=>$grade,'id' => $id]);
    //header("location:process.php");
   }catch(PDOException $e){
    echo 'Update failed: ' . $e->getMessage();
    header("location:process.php?=updatefailed");
   }
 }
 function deleteRecord($id){
   try{
    $sql = 'DELETE FROM records WHERE id = :id';
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute(['id' =>$id]);
  
   }
     catch(PDOException $e){
       echo $e->getMessage();

     }
   }
  function insertRecords($name,$email,$password){
    $hashed_pass=password_hash($password,PASSWORD_DEFAULT);
    try{
      $sql = 'INSERT INTO records(name, email, password, grade, score) VALUES(:name, :email, :password, NULL, NULL)';
      $stmt = $this->pdo->prepare($sql);
      $stmt->execute(['name'=>$name, 'email' =>$email, 'password' => $hashed_pass]);
      header("location:studLogin.php");
    }catch(PDOException $e){
      echo $e->getMessage();
    }
 }
 function retrieveStud($email,$table){
   
  //Defoult if you need not to provide argument for fetch()
  $sql = "SELECT * FROM $table  WHERE email = :email";
  $stmt = $this->pdo->prepare($sql);
  $stmt->execute(['email' =>$email]);
  $result = $stmt -> fetchAll();
  
  return $result;

}
 function countrows($table)
{
  return $this->pdo->query("select count(*) from $table")->fetchColumn(); 
}
function updateScale($minA,$maxA,$minB,$maxB,
$minC,$maxC,$minD,$maxD,$minE,$maxE,$email){

try{
  $sql = 'UPDATE scale SET minA = :minA, maxA = :maxA, minB =:minB, maxB=:maxB,
  minC =:minC, maxC=:maxC, minD =:minD,maxD =:maxD,minE=:minE,maxE=:maxE WHERE email = :email';
  $stmt = $this->pdo->prepare($sql);
  $stmt->execute(['minA' =>$minA, 'maxA'=>$maxA,'minB'=>$minB, 'maxB'=>$maxB, 'minC'=>$minC,'maxC'=>$maxC,
  'minD'=>$minD,'maxD'=>$maxD,'minE'=>$minE,'maxE'=>$maxE,
  'email' => $email]);

}catch(PDOException $e){
  echo 'Update failed: ' . $e->getMessage();
  header("location:process.php?=updatefailed");
 }

/*
try{
{$sql = 'INSERT INTO scale(minA, maxA, minB,maxB,minC,maxC,minD,maxD,minE,maxE,email) 
VALUES(:minA, :maxA, :minB, :maxB,:minC,:maxC,:minD,:maxD,:minE,:maxE,:email)';
$stmt = $this->pdo->prepare($sql);
$stmt->execute(['minA'=>$minA, 'maxA'=>$maxA, 'minB'=>$minB,'maxB'=>$maxB,'minC'=>$minC, 'maxC'=>$maxC,'minD'=>$minD,'maxD'=>$maxD,
'minE'=>$minE, 'maxE'=>$maxE,"email"=>$email]);
echo '<br>POST ADDED';}
}
catch(PDOException $e){
  echo $e->getMessage();

}*/
}



/*
//set Data source name

//create a PDO instance


#PDO QUERY
//$stmt = $pdo->query('SELECT * FROM post');
//while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
  //  echo $row['title'].'<br>';
//}
//while($row = $stmt->fetch(PDO::FETCH_OBJ)){
  //  echo $row->title.'<br>';}
 
 // while($row = $stmt->fetch()){

   //   echo $row->title.'<br>';}

   //*****PREPARED STSTEMMENT (PREPARE, EXECUTE))

// fETCH MULTIPLE POSTS


// Positional param
$author = 'Abdi';
$is_published = true;
$sql = 'SELECT * FROM post WHERE author = ?';
$stmt = $pdo->prepare($sql);
$stmt->execute([$author]);
$post = $stmt->fetchAll();
foreach($post as $p){
//echo $p->title . '<br>';
}

// named param
$sql = 'SELECT * FROM post  WHERE author = :author &&
is_published = :is_published';

$stmt = $pdo->prepare($sql);
$stmt->execute(['author' =>$author, 'is_published' =>$is_published]);
$post = $stmt -> fetchAll();
foreach($post as $p){
    echo $p ->title . '<br>';
}
$limit = 14;
$author = 'Maria';
$stmt = $pdo->prepare('SELECT * FROM post WHERE author  = ? && is_published = ? LIMIT ?');
$stmt->execute([$author,$is_published,$limit]);
$postCount = $stmt->rowCount();

foreach($post as $p){
  echo $p ->title . '<br>';
}
echo $postCount;
// INSERT DATA https://www.youtube.com/watch?v=kEW6f7Pilc4
/*
$title = 'post eight';
$body = 'this is post eight';
$author = 'Maria';

$sql = 'INSERT INTO post(title, body, author) VALUES(:title, :body, :author)';
$stmt = $pdo->prepare($sql);
$stmt->execute(['title'=>$title, 'body' =>$body, 'author' => $author]);
echo '<br>POST ADDED';*/
//update data
/*
$id = 1;
$body = 'This is an updated post for post one';
$sql = 'UPDATE post SET body = :body WHERE id = :id';
$stmt = $pdo->prepare($sql);
$stmt->execute(['body' =>$body, 'id' => $id]);
echo '<br> Post updated';
//Delete data
$id = 13;
$sql = 'DELETE FROM post WHERE id = :id';
$stmt = $pdo->prepare($sql);
$stmt->execute(['id' =>$id]);
echo '<br>post deleted';

//SEARCH DATA
$search = "%post%";
$search = "%2%";
$sql = 'SELECT * FROM post WHERE id LIKE ?';
$stmnt = $pdo->prepare($sql);
$stmnt->execute([$search]);
$post = $stmnt->fetchAll();
foreach($post as $p)
 { 
   echo '<br>'. $p->id;
 }
 */
}