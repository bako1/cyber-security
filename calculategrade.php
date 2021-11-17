<?php
class calculateGrade{
private $grade;
function calculate($dbresult,$score){
    $this->grade='A';
/*foreach($dbresult as $scale){
 if($score>=$score['minA'] && $score<=$scale['maxA']){
     $this->grade = 'A';
 }elseif($score>=$score['minB'] && $score<=$scale['maxB']){
    $this->grade = 'B';
}elseif($score>=$score['minC'] && $score<=$scale['maxC']){
    $this->grade = 'C';
}elseif($score>=$score['minD'] && $score<=$scale['maxD']){
    $this->grade = 'D';
}elseif($score>=$score['minE'] && $score<=$scale['maxE']){
    $this->grade = 'E';
}else{
    $this->grade = 'F';
}
}*/
return $this->grade;
}
}