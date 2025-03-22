<?php 
// $num1=30;
// $num2=50;
// $add=$num1+$num2;
// $str1="Hi my name is Tejas";

// echo "Addition of $num1 and $num2 is $add";

/*$marks=100;
if($marks>0 && $marks<35){
    echo "<h2 style='color:red'>You are Fail!</h2>";
}
elseif($marks>=35 && $marks<=65){
    echo "<h2 style='color:green'>You are pass!</h2>";
}
elseif($marks>65 && $marks<=100){
    echo "<h2 style='color:blue'>You are pass with Destinction!</h2>";
}
elseif($marks<=0 || $marks>100){
    echo "<h2 style='color:red'>Invalid Input!</h2>";
}


$i=0;
$colors=["red","blue","green","yellow","violet","pink","red","blue","green","grey"];
while($i<=9){
    $color=$colors[$i];
    echo "<h3 style='color:$color'> $i </h3>";
    $i++;
}*/


/*
$cities=array("Amravati","Akola","Delhi","Mumbai","Patna","Jalna");
$student=array("name"=>"Raj",
                "age"=>25,
                "marks"=>98);

foreach($student as $value){
    echo "$value";
    echo "<br>";
}
*/

/*foreach($cities as $city){
    print_r($city);
    echo "<br>";
}*/



/* print_r($cities);

 for($i=0; $i<count($cities); $i++){
    print_r($cities[$i]);
   echo "<br>";
 }*/

/*

}*/


/*
$name=array("name1"=>"Tejas",
            "name2"=>"Yash",
            "name3"=>"Rajudon");

print_r($name["name1"]["name2"]);*/
/*-
  $student1=array("name"=>"Tejas","age"=>30,"marks"=>52);
  $student2=array("name"=>"Krishna","age"=>20,"marks"=>98);
  $student3=array("name"=>"Yash","age"=>10,"marks"=>100);
  $students=array($student1,$student2,$student3);
  $school=array("students"=>$students);

  print_r($students[0]["name"]);
*/


//Super Global Variable..
//$_GET will get value from client and stored in Associative Array.
 /*$num1=$_GET["num1"];
$num2=$_GET["num2"];
$add=$num1+$num2;
print_r("Addition of $num1 and $num2 is $add");
echo "<br>";
substraction($num1,$num2);
function substraction($N1,$N2){
        $sub=$N1-$N2;
        echo "Substraction is $sub";}

       *Respone client side request page vr ks show krach**/
      /*
      $id=$_GET["userid"];
      $passwrd=$_GET["pass1"];
     
      
*/
      //Registration page.
$username=$_GET["username"];
$password=$_GET["password"];
$age=$_GET["age"];
$gender=$_GET["gender"];
$dob=$_GET["dateofbirth"];
$time=$_GET["time"];
$city=$_GET["city"];
$hobbies=$_GET["hobbies"];
// print_r($hobbies);

print_r(json_encode($_GET));
print_r("<h1 style='color:green;'>Registration Successful!...</h1>");
print_r("<br>");
Print_r("Your Username is : <span style='font-weight:bolder;'>$username</span> <br> Password is : <span style='font-weight:bolder;'>$password</span>");
print_r("<h2>You Entered Following Information!</h2>");
// print_r("<br>");
print_r("Age : $age <br> Gender: $gender <br> DOB : $dob <br> Time : $time <br> City: $city <br> Hobbies : $hobbies[0], $hobbies[1], $hobbies[2]");
?>


