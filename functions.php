<?php
$RESULT_TYPE = $_POST["RESULT_TYPE"];
switch ($RESULT_TYPE) {
    case "LOGIN":
        $result = login($_POST["USERID"], $_POST["PASS1"]);
        echo $result;
        break;

    case "REGISTRATION":
        $result = registration($_POST["username"], $_POST["password"], $_POST["age"], $_GET["gender"], $_GET["dateofbirth"], $_GET["time"], $_GET["city"], $_GET["hobbies"]);
        echo json_encode($result);
        break;
    case "GET_CARS":
        $result = getCars();
        echo $result;
        break;
    case "GET_CATEGORIY":
        $result = getCategories();
        echo $result;
        break;
    case "GET_YEAR_MAKE_MODEL":
        $result = yearMakeModel();
        echo $result;
        break;
    case "GET_CARS_INFO":
        $result = getCarsInfo($_POST);
        echo $result;
        break;
    case "GET_CAR_INFO":
        $result = getCarInfo();
        echo $result;
        break;

    case "GET_OTP":
        $result = getOtp();
        echo $result;
        break;

    case "GET_MODEL_FILTER":
        $result=getModelFilter();
        echo $result;
        break;

    case "APPLY_FILTER":
        $result=applyFilter($_POST["MAXPRICE"]);
        echo $result;
        break;
}

    function applyFilter($maxprice){
        
        $car1 = array(
            "image" => "img/car1.webp",
            "make" => "Tata 2022",
            "model" => "Nexon",
            "fuleType" => "Petrol",
            "bodyMaterial" => "ALuminium",
            "distanceTravled" => 24151,
            "emiPrice" => 16175,
            "discountedPrice" => 850000,
            "originalPrice" => 1250000,
            "btnContaint" => "Book Your Test Drive!",
            "id"=>1
        );
        $car2 = array(
            "image" => "img/car2.webp",
            "make" => "Mahindra 2024",
            "model" => "Scorpio",
            "fuleType" => "Diesel",
            "bodyMaterial" => "Metal Alloy",
            "distanceTravled" => 54356,
            "emiPrice" => 12881,
            "discountedPrice" => 527000,
            "originalPrice" => 747000,
            "btnContaint" => "Book Your Test Drive!",
            "id"=>2
        );
        $car3 = array(
            "image" => "img/car3.webp",
            "make" => "BMW 2019",
            "model" => "Z4 Roaster",
            "fuleType" => "Ethanol",
            "bodyMaterial" => "Carbon Alloy",
            "distanceTravled" => 105785,
            "emiPrice" => 11762,
            "discountedPrice" => 1547000,
            "originalPrice" => 2295000,
            "otherCharges" => 12500,
            "btnContaint" => "Book Your Test Drive!",
            "id"=>3
        );
        $car4 = array(
            "image" => "img/car4.webp",
            "make" => "BMW 2019",
            "model" => "Z4 Roaster",
            "fuleType" => "Ethanol",
            "bodyMaterial" => "Carbon Alloy",
            "distanceTravled" => 105785,
            "emiPrice" => 11762,
            "discountedPrice" => 1547000,
            "originalPrice" => 2295000,
            "otherCharges" => 12500,
            "btnContaint" => "Book Your Test Drive!",
            "id"=>3
        );
        //For Illustration purpose Only! Whether it is working or not
        if($maxprice>=100000 && $maxprice<500000){
            $cars = array($car1);
        }else if($maxprice>=500000 && $maxprice<1000000){
            $cars = array($car1, $car2);
        }else if($maxprice>=1000000 && $maxprice<1500000){
            $cars = array($car1, $car2,$car3);
        }else if($maxprice>=1500000 && $maxprice<2000000){
            $cars = array($car1, $car2,$car3,$car4);
        }
        return json_encode($cars);
    }

    function getModelFilter(){
        return json_encode(["Honda", "Renault", "Ford", "Tata", "Mahindra", "Audi"]);
    }
    function getOtp(){
       
        $randomNo=rand(1000,9999);
        return json_encode(array("otp"=>$randomNo));
    }



function getCarInfo()
{
    $car = array(
        "name" => "Maruti",
        "makeyear" => 2018,
        "model" => "Baleno ZETA",
        "engineCapacity" => 1197,
        "distanceTravled" => 47788,
        "owner" => "1ST OWNER",
        "fuleType" => "PETROL",
        "gear" => "MANUAL",
        "lct" => "Parked at Metro Walk, Rohini, New Amravati",
        "emi" => 9286,
        "discount" => 44,
        "orgPrice" => 529000,
        "dscPrice" => 475000,
        "otrCharges" => 7763,
        "regYear" => "21 April 2017",
        "regNumber" => "MH27 CC3139",
        "transmission" => "Manaul",
        "insurance" => "Aditya Birla",
        "spareKey" => "Available",
        "bodyMaterial"=> "ALuminium"
    );
    $description = array(
        "mainImage" => "img/whcar.webp",
        "i1" => "img/ext.webp",
        "i2" => "img/int.webp",
        "i3" => "img/imp.webp",
        "i4" => "img/fea.webp",
        "i5" => "img/whcar.webp"
    );
    $carInfo=array(
        "car"=>$car,
        "carIntro"=>$description
    );
    return json_encode($carInfo);
}

function getCarsInfo($FILTER)
{
    $car1 = array(
        "image" => "img/car1.webp",
        "makeyear" => "Tata 2022",
        "model" => "Nexon",
        "fuleType" => "Petrol",
        "bodyMaterial" => "ALuminium",
        "distanceTravled" => 24151,
        "emiPrice" => 16175,
        "discountedPrice" => 850000,
        "originalPrice" => 1250000,
        "btnContaint" => "Book Your Test Drive!",
        "id"=>1
    );
    $car2 = array(
        "image" => "img/car2.webp",
        "make" => "Mahindra 2024",
        "model" => "Scorpio",
        "fuleType" => "Diesel",
        "bodyMaterial" => "Metal Alloy",
        "distanceTravled" => 54356,
        "emiPrice" => 12881,
        "discountedPrice" => 527000,
        "originalPrice" => 747000,
        "btnContaint" => "Book Your Test Drive!",
        "id"=>2
    );
    $car3 = array(
        "image" => "img/car3.webp",
        "make" => "BMW 2019",
        "model" => "Z4 Roaster",
        "fuleType" => "Ethanol",
        "bodyMaterial" => "Carbon Alloy",
        "distanceTravled" => 105785,
        "emiPrice" => 11762,
        "discountedPrice" => 1547000,
        "originalPrice" => 2295000,
        "otherCharges" => 12500,
        "btnContaint" => "Book Your Test Drive!",
        "id"=>3
    );
    //For Illustration purpose Only! Whether it is working or not
    if(isset($FILTER["FILTER"])){
        
        $cars = array($car1, $car2, $car3);
    }else{
        $cars = array($car1, $car2, $car3);
    }
    return json_encode($cars);
}
function yearMakeModel()
{
    $make = array("Tata", "Mahendra", "Audi", "BMW", "Mercedes");
    // $style = array(["Style", "Sudan", "SUV", "Hatch-Back"]);
    // $condition = array(["Condition", "Good", "Better", "Best", "Average"]);
    $year = array(2020, 2021, 2022, 2023, 2024);
    $model = array(
        "Tata" => ["Tiago", "Nexon", "Punch", "Altroz", "Harrier"],
        "Mahendra" => ["Thar", "XUV700", "XUV300", "Bolero", "Scorpio-N", "BE-6"],
        "Audi" => ["A3", "A4", "A5", "Q3", "Q5", "RSQ8"],
        "BMW" => ["1 Series", "Z4 Roadster", "8 Series Gran Coupe", "X1", "X3", "X4", "Z4 Roadster"],
        "Mercedes" => ["GLA", "AMG GLC 43 4MATIC", "AMG GLE 53 4MATIC+", "AMG GLE 63 S 4MATIC+", "A-Class Limousine", "Maybach GLS"]
    );
    $yearMakeModel = array("year" => $year, "make" => $make, "model" => $model);
    return json_encode($yearMakeModel);
}

function getCategories()
{
    //BodyType
    $cat1 = array(
        "image" => "img/Sedan.png",
        "name" => "Sedan",
        "id" => 1,
        "fname"=>"sedan"
    );
    $cat2 = array(
        "image" => "img/suv.png",
        "name" => "SUV",
        "id" => 2,
        "fname"=>"suv"
    );
    $cat3 = array(
        "image" => "img/hatchback.png",
        "name" => "Hatchback",
        "id" => 3,
        "fname"=>"hatchback"
        
    );
    $bodyType = array("category" => array($cat1, $cat2, $cat3));

    //Budget
    $bd1 = array(
       
        "name" => "Below - 5 Lack",
        "id" => 1,
        "fname"=>"0_5"
    );
    $bd2 = array(
      
        "name" => "Between 6-10 Lack",
        "id" => 2,
        "fname"=>"6_10"
    );
    $bd3 = array(
       
        "name" => "Between 11-20 Lack",
        "id" => 3,
        "fname"=>"11_20"
    );
    $bd4 = array(
       
        "name" => "Between 21-100 Lack",
        "id" => 3,
        "fname"=>"21_100"
    );
    $budget = array("category" => array($bd1, $bd2, $bd3,$bd4));

    //FuelType
    $ft1 = array(
        "image" => "img/Sedan.png",
        "name" => "Petrol",
        "id" => 1,
        "fname"=>"petrol"
    );
    $ft2 = array(
        "image" => "img/suv.png",
        "name" => "Diesel",
        "id" => 2,
        "fname"=>"diesel"
    );
    $ft3 = array(
        "image" => "img/hatchback.png",
        "name" => "CNG",
        "id" => 3,
        "fname"=>"cng"
    );
    $ft4 = array(
        "image" => "img/hatchback.png",
        "name" => "Electric",
        "id" => 4,
        "fname"=>"electric"
    );
    $ft5 = array(
        "image" => "img/hatchback.png",
        "name" => "Hybrid",
        "id" => 5,
        "fname"=>"hybrid"
    );
    $fuelType = array("category" => array($ft1, $ft2, $ft3, $ft4, $ft5));

    //Years
    $yr1 = array(
        "image" => "img/Sedan.png",
        "name" => "2020",
        "id" => 1,
        "fname"=>"2020"
    );
    $yr2 = array(
        "image" => "img/suv.png",
        "name" => "2021",
        "id" => 2,
        "fname"=>"2021"
    );
    $yr3 = array(
        "image" => "img/hatchback.png",
        "name" => "2022",
        "id" => 3,
        "fname"=>"2022"
    );
    $yr4 = array(
        "image" => "img/hatchback.png",
        "name" => "2023",
        "id" => 4,
        "fname"=>"2023"
    );
    $years = array("category" => array($yr1, $yr2, $yr3, $yr4));
    $categories = array("bodyType" => $bodyType, "budget" => $budget, "fuelType" => $fuelType, "years" => $years);
    return json_encode($categories);
}

//Login function
function login($id, $passwrd)
{
    $result = "";
    if ($id == "admin" && $passwrd == "admin") {
       session_start();
        $_SESSION["USERNAME"]=$id;
        $_SESSION["LOGIN"]=true;
        $result = array(
            "result" => 1,
            "message" => "Login Successful"
        );
        $result = json_encode($result);
        // print_r($result);
    } else {
        $result = array(
            "result" => 0,
            "message" => "Login Unsuccessful"
        );
        $result = json_encode($result);
        //  print_r($result);    /*If we give Index array to json_encode then it will give array. Else if we give Associative Array to jsonn_encode then it will give Json_string.*/
    }
    return $result;
}
//Registration
function registration($username, $password, $age, $gender, $dob, $time, $city, $hobbies)
{

    $result = array("result" => 1, "message" => "Registration Succcessuful");
    return $result;
}
//GetCars
function getCars()
{
    $car1 = array(
        "image" => "img/car1.webp",
        "make" => "Tata",
        "model" => "2018 Punch Eco sport RXL MT",
        "desc" => "Best Budget and safety Ratings.",
        "price" => 850000,
        "kms" => 40882,
        "fuelType" => "Diesel",
        "owner" => "Second",
        "emi" => 12756,
        "discountedPrice" => 650000,
        "otherCharges" => 551,
        "smallImage" => ["img/ext.webp", "img/int.webp", "img/imp.webp", "img/fea.webp"],
        "id"=>1
    );
    $car2 = array(
        "image" => "img/car2.webp",
        "make" => "Tata",
        "model" => "2018 Punch Eco sport RXL MT",
        "desc" => "Best Budget and safety Ratings.",
        "price" => 850000,
        "kms" => 40882,
        "fuelType" => "Diesel",
        "owner" => "Second",
        "emi" => 12756,
        "discountedPrice" => 650000,
        "otherCharges" => 551,
        "smallImage" => ["img/ext.webp", "img/int.webp", "img/imp.webp", "img/fea.webp"],
        "id"=>2
    );
    $car3 = array(
        "image" => "img/car3.webp",
        "make" => "Tata",
        "model" => "2018 Punch Eco sport RXL MT",
        "desc" => "Best Budget and safety Ratings.",
        "price" => 850000,
        "kms" => 40882,
        "fuelType" => "Diesel",
        "owner" => "Second",
        "emi" => 12756,
        "discountedPrice" => 650000,
        "otherCharges" => 551,
        "smallImage" => ["img/ext.webp", "img/int.webp", "img/imp.webp", "img/fea.webp"],
        "id"=>3
    );
    $car4 = array(
        "image" => "img/car4.webp",
        "make" => "Tata",
        "model" => "2018 Punch Eco sport RXL MT",
        "desc" => "Best Budget and safety Ratings.",
        "price" => 850000,
        "kms" => 40882,
        "fuelType" => "Diesel",
        "owner" => "Second",
        "emi" => 12756,
        "discountedPrice" => 650000,
        "otherCharges" => 551,
        "smallImage" => ["img/ext.webp", "img/int.webp", "img/imp.webp", "img/fea.webp"],
        "id"=>4
    );
    $car5 = array(
        "image" => "img/car5.webp",
        "make" => "Tata",
        "model" => "2018 Punch Eco sport RXL MT",
        "desc" => "Best Budget and safety Ratings.",
        "price" => 850000,
        "kms" => 40882,
        "fuelType" => "Diesel",
        "owner" => "Second",
        "emi" => 12756,
        "discountedPrice" => 650000,
        "otherCharges" => 551,
        "smallImage" => ["img/ext.webp", "img/int.webp", "img/imp.webp", "img/fea.webp"],
        "id"=>5
    );

    $cars = array($car1, $car2, $car3, $car4, $car5);
    $cars = array("cars" => $cars);
    return json_encode($cars);
}
