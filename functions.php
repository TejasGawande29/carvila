<?php
include_once('dbconn.php'); //require_once is another , it will not run next code if fille have any problem in it. otherwise include_once runs next code if fails to load file.
/*getDbCars();
function getDbCars()
{
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM cars");
    if ($stmt) {
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            while($row = $result->fetch_assoc()){
                print_r($row);
                echo "<br>";
                echo "<br>";
            }
            // return $row;
        } else {
            echo "Execute Error";
        }
    } else {
        echo "Prepare Error";
    }
}
*/
$RESULT_TYPE = $_POST["RESULT_TYPE"];
switch ($RESULT_TYPE) {
    case "LOGIN":
        $result = login($_POST["USERID"], $_POST["PASS1"]);
        echo $result;
        break;

    case "REGISTRATION":
        $result = registration($_POST["USERNAME"], $_POST["PASSWORD"], $_POST["MOBILE"], $_POST["AGE"], $_POST["DOB"], $_POST["CITY"], $_POST["GENDER"], $_POST["HOBBIES"]);
        echo $result;
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
        $result = getCarById($_POST["CARID"]);
        echo $result;
        break;
    case "GET_CAR_INFO":
        $result = getCarInfo($_POST["CARID"]);
        echo $result;
        break;

    case "GET_OTP":
        $result = getOtp($_POST["MOBILENO"]);
        echo $result;
        break;

    case "GET_MODEL_FILTER":
        $result = getModelFilter();
        echo $result;
        break;

    case "APPLY_FILTER":
        $result = applyFilter($_POST["MAXPRICE"], $_POST["MAKES"], $_POST["PRICERANGE"]);
        echo $result;
        break;
    case "SELECT_YEARS_CHANGE":
        $result = getMakeOnYear($_POST["YEAR"]);
        echo ($result);
        break;
    case "SELECT_MAKE_CHANGE":
        $result = getModelOnMake($_POST["YEAR"], $_POST["MAKE"]);
        echo ($result);
        break;
    case "SELECT_MODEL_CHANGE":
        $result = getBodyStyleOnModel($_POST["YEAR"], $_POST["MAKE"], $_POST["MODEL"]);
        echo ($result);
        break;
    case "SELECT_CARSTYLE_CHANGE":
        $result = getCarConditionOnCarstyle($_POST["YEAR"], $_POST["MAKE"], $_POST["MODEL"], $_POST["CARSTYLE"]);
        echo ($result);
        break;
    case "SELECT_CONDITION_CHANGE":
        $result = getPriceOnCondition($_POST["YEAR"], $_POST["MAKE"], $_POST["MODEL"], $_POST["CARSTYLE"], $_POST["CONDITION"]);
        echo ($result);
        break;
    case "GET_CARS_FROM_CARID":
        $result = getCarsFromCarid($_POST["CARID"]);
        echo ($result);
        break;
    case "GET_CARIMAGE_GALLERY":
        $result = getCarimageGalleryFromCarid($_POST["CARID"]);
        echo ($result);
        break;
    case "GET_CARS_FROM_FILTER":
        $result = getCarsFromFilter($_POST["FILTER"]);
        echo ($result);
        break;
    case "VERIFY_OTP":
        $result = verifyOtp($_POST["MOBILENO"], $_POST["OTP"], $_POST["CARID"]);
        echo $result;
        break;
}
function verifyOtp($mobileno, $otp, $carid)
{
    $result = array();
    session_start();
    if ($_SESSION["MOBILE"] == $mobileno && $_SESSION["OTP"] == $otp) {
        global $conn;
        $stmt = $conn->prepare("INSERT INTO `testdrives`( `uid`, `carid`) VALUES (?,?)");
        if ($stmt) {
            $stmt->bind_param("ii", $_SESSION["UID"], $carid);
            if ($stmt->execute()) {
                $result["status"] = 1;
                $result["message"] = "OTP validated successfully";
                return json_encode($result);
            } else {
                echo "Execute Error";
            }
        } else {
            echo "Prepare Error";
        }
    } else {
        $result["status"] = 0;
        $result["message"] = "mobileno or OTP does not match";
        return json_encode($result);
    }
}
function getCarsFromFilter($filter)
{

    $filter = explode("-", $filter);
    $query = "";

    switch ($filter[0]) {
        case "bodyType":
            $bodyType = $filter[1];
            $id = $filter[2];
            $query = "SELECT cars.*, carinfo.makeYear FROM `cars` INNER JOIN carinfo ON cars.id=carinfo.carid WHERE carinfo.bodyType=$id";
            break;
        case "carBudget":
            $fromto = $filter[1];
            $fromto = explode("_", $fromto);
            $from = ($fromto[0] * 100000);
            $to = ($fromto[1] * 100000) + 1;
            $query = "SELECT cars.*, carinfo.makeYear FROM `cars` INNER JOIN carinfo ON cars.id=carinfo.carid WHERE cars.discountedPrice BETWEEN $from AND $to ORDER BY cars.discountedPrice ASC;";
            break;
        case "fuelType":
            $fuelType = $filter[1];
            $query = "SELECT cars.*, carinfo.makeYear FROM `cars` INNER JOIN carinfo ON cars.id=carinfo.carid WHERE cars.fuelType='$fuelType' ORDER BY cars.discountedPrice ASC;";
            break;
        case "years":
            $years = $filter[0];
            $id = $filter[1];
            $query = "SELECT cars.*,carinfo.*,carinfo.makeYear FROM `cars` INNER JOIN carinfo ON cars.id=carinfo.carid WHERE carinfo.makeYear=$id";
            break;
    }

    global $conn;
    $stmt = $conn->prepare($query);
    $cars = array();
    if ($stmt) {
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $car = $result->fetch_assoc();
            while ($row = $result->fetch_assoc()) {
                array_push($cars, $row);
            }
            return json_encode($cars);
        } else {
            echo "Execute Error";
        }
    } else {
        echo "Prepare Error";
    }
}

function getCarimageGalleryFromCarid($caridforIMG)
{
    $images = array();
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM `smallimages` WHERE carid=?");

    if ($stmt) {
        $stmt->bind_param("i", $caridforIMG);
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            while ($row = $result->fetch_assoc()) {
                array_push($images, $row["image"]);
            }
            return json_encode($images);
        } else {
            echo "Execute Error";
        }
    } else {
        echo "Prepare Error";
    }
}

function getCarsFromCarid($carid)
{

    global $conn;
    $stmt = $conn->prepare("SELECT cars.*, carinfo.makeYear FROM `carinfo` INNER JOIN cars ON cars.id=carinfo.carid WHERE cars.id=?");

    if ($stmt) {
        $stmt->bind_param("i", $carid);
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $car = $result->fetch_assoc();
            $cars = array($car);
            return json_encode($cars);
        } else {
            echo "Execute Error";
        }
    } else {
        echo "Prepare Error";
    }
}

function getPriceOnCondition($year, $make, $model, $carstyle, $condition)
{

    $price = array();
    global $conn;
    $stmt = $conn->prepare("SELECT DISTINCT cars.discountedPrice,cars.id FROM `cars` INNER JOIN carinfo ON carinfo.carid=cars.id WHERE carinfo.makeyear=? AND cars.make=? AND cars.model=? AND carinfo.bodyType=? AND carinfo.carcondition=?");

    if ($stmt) {
        $stmt->bind_param("isssi", $year, $make, $model, $carstyle, $condition);
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            return json_encode($row);
        } else {
            echo "Execute Error";
        }
    } else {
        echo "Prepare Error";
    }
}

function getCarConditionOnCarstyle($year, $make, $model, $carstyle)
{
    $carcondtion = array();
    global $conn;
    $stmt = $conn->prepare("SELECT DISTINCT carinfo.carcondition FROM `carinfo` INNER JOIN cars ON carinfo.carid=cars.id WHERE carinfo.makeyear=? AND cars.make=? AND cars.model=? AND carinfo.bodyType=?");

    if ($stmt) {
        $stmt->bind_param("isss", $year, $make, $model, $carstyle);
        if ($stmt->execute()) {
            $result = $stmt->get_result();

            while ($row = $result->fetch_assoc()) {
                array_push($carcondtion, $row["carcondition"]);
            }
            return json_encode($carcondtion);
        } else {
            echo "Execute Error";
        }
    } else {
        echo "Prepare Error";
    }
}

function getBodyStyleOnModel($year, $make, $model)
{
    $bodyType = array();
    global $conn;
    $stmt = $conn->prepare("SELECT bodytypes.name as bodyname, bodytypes.id as bodyType, cars.discountedPrice, carinfo.carcondition , carinfo.carid FROM `carinfo` INNER JOIN cars ON carinfo.carid=cars.id INNER JOIN bodytypes on carinfo.bodyType=bodytypes.id WHERE carinfo.makeyear=? AND cars.make=? AND cars.model=?");

    if ($stmt) {
        $stmt->bind_param("iss", $year, $make, $model);
        if ($stmt->execute()) {
            $result = $stmt->get_result();

            while ($row = $result->fetch_assoc()) {
                array_push($bodyType, $row);
            }
            return json_encode($bodyType);
        } else {
            echo "Execute Error";
        }
    } else {
        echo "Prepare Error";
    }
}

function getModelOnMake($year, $make)
{

    $model = array();
    global $conn;
    $stmt = $conn->prepare("SELECT DISTINCT cars.model FROM `cars` INNER JOIN carinfo ON carinfo.carid=cars.id WHERE carinfo.makeyear=? AND cars.make=?");

    if ($stmt) {
        $stmt->bind_param("is", $year, $make);
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            while ($row = $result->fetch_assoc()) {

                array_push($model, $row["model"]);
            }
            return json_encode($model);
        } else {
            echo "Execute Error";
        }
    } else {
        echo "Prepare Error";
    }
}

function getMakeOnYear($year)
{

    $makes = array();
    global $conn;
    $stmt = $conn->prepare("SELECT DISTINCT cars.make FROM `carinfo` INNER JOIN cars ON carinfo.carid=cars.id WHERE carinfo.makeyear=?");

    if ($stmt) {
        $stmt->bind_param("i", $year);
        if ($stmt->execute()) {
            $result = $stmt->get_result();

            while ($row = $result->fetch_assoc()) {
                array_push($makes, $row["make"]);
            }
            return json_encode($makes);
        } else {
            echo "Execute Error";
        }
    } else {
        echo "Prepare Error";
    }
}

function applyFilter($maxprice, $makes, $pricerange)
{
    //    
    $frompricerange = explode("-", $pricerange)[0] * 100000;
    $topricerange = explode("-", $pricerange)[1] * 100000;
    $querry = "";

    if (count($makes) == 1) { //Array is empty.
        $querry = "SELECT * FROM cars where discountedprice BETWEEN $frompricerange AND $topricerange OR discountedPrice <=$maxprice";
        // return $querry;
    } else {
        $text = "";
        for ($i = 1; $i < count($makes); $i++) {
            $text = $text . "make=" . "'" . $makes[$i] . "'" . " OR ";
        }
        $text = substr($text, 0, -4);
        $querry = "SELECT * FROM cars where $text AND (discountedPrice BETWEEN $frompricerange AND $topricerange OR discountedPrice <=$maxprice)";
        // return $querry;
    }


    $cars = array();
    global $conn;
    $stmt = $conn->prepare($querry);

    if ($stmt) {

        if ($stmt->execute()) {
            $result = $stmt->get_result();

            while ($row = $result->fetch_assoc()) {
                array_push($cars, $row);
            }
            return json_encode($cars);
        } else {
            echo "Execute Error";
        }
    } else {
        echo "Prepare Error";
    }
}

function getModelFilter()
{
    $makearr = array();
    global $conn;
    $stmt = $conn->prepare("SELECT make, COUNT(id) AS makecount FROM cars GROUP BY make;");
    if ($stmt) {
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            while ($row = $result->fetch_assoc()) {

                array_push($makearr, $row);
            }
             return json_encode($makearr);
        } else {
            echo "Execute Error";
        }
    } else {
        echo "Prepare Error";
    }
    return json_encode($makearr);
}

function getOtp($mobileno)
{
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM `users` WHERE mobile=? ");
    if ($stmt) {
        $stmt->bind_param("s",$mobileno);
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $usercount=mysqli_num_rows($result);
            if($usercount==0)
            {
                return json_encode(array( "status"=>0, "error" => "user Does not Exist,Risister Now"));
            }else{
                $row=$result->fetch_assoc();
                $randomNo = rand(1000,9999);
                session_start();
                $_SESSION["OTP"]=$randomNo;
                $_SESSION["MOBILE"]=$mobileno;
                $_SESSION["UID"]=$row["id"];
                return json_encode(array( "status"=>1,"otp" => $randomNo));

            }

           
        } else {
            echo "Execute Error";
        }
    } else {
        echo "Prepare Error";
    }

    $randomNo = rand(1000, 9999);
    return json_encode(array("otp" => $randomNo));
}

function getCarInfo($caridfrominfourl)
{

    global $conn;
    $stmt = $conn->prepare("SELECT * FROM `carinfo` INNER JOIN `cars` ON carinfo.carid=cars.id WHERE carinfo.carid=?");

    if ($stmt) {
        $stmt->bind_param("i", $caridfrominfourl);
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            return json_encode($row);
        } else {
            echo "Execute Error";
        }
    } else {
        echo "Prepare Error";
    }

    /*$car = array(
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
        "id" => 1,
        "name" => "Maruti",
        "makeyear" => 2018,
        "model" => "Baleno ZETA",
        "engineCapacity" => 1197,
        "kmDriven" => 47788,
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

    );
    $description = array(
        "mainImage" => "img/whcar.webp",
        "i1" => "img/ext.webp",
        "i2" => "img/int.webp",
        "i3" => "img/imp.webp",
        "i4" => "img/fea.webp",
        "i5" => "img/whcar.webp"
    );
    $carInfo = array(
        "car" => $car,
        "carIntro" => $description
    );
    return json_encode(array($carInfo));*/
}

function getCarById($carid)
{
    global $conn;

    $makeYears = array();
    $stmt = $conn->prepare("SELECT DISTINCT makeYear FROM carinfo ORDER BY makeYear ASC;");
    if ($stmt) {
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            while ($row = $result->fetch_assoc()) {
                array_push($makeYears, $row["makeYear"]);
            }

            return $makeYears;
        } else {
            echo "Execute Error";
        }
    } else {
        echo "Prepare Error";
    }
}

function yearMakeModel()
{
    $year = getMakeYears();

    $yearMakeModel = array("year" => $year);
    return json_encode($yearMakeModel);
}

function getMakeYears()
{

    global $conn;

    $makeYears = array();
    $stmt = $conn->prepare("SELECT DISTINCT makeYear FROM carinfo ORDER BY makeYear ASC;");
    if ($stmt) {
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            while ($row = $result->fetch_assoc()) {
                array_push($makeYears, $row["makeYear"]);
            }

            return $makeYears;
        } else {
            echo "Execute Error";
        }
    } else {
        echo "Prepare Error";
    }
}

function getBodyTypes()
{
    global $conn;

    $bodytpes = array();
    $stmt = $conn->prepare("SELECT * FROM `bodytypes`");
    if ($stmt) {
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            while ($row = $result->fetch_assoc()) {
                array_push($bodytpes, $row);
            }

            return $bodytpes;
        } else {
            echo "Execute Error";
        }
    } else {
        echo "Prepare Error";
    }
}

function getFuelTypes()
{
    global $conn;

    $fuelTypes = array();
    $stmt = $conn->prepare("SELECT DISTINCT upper(fuelType) AS name , fuelType AS fname FROM `cars`");
    if ($stmt) {
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            while ($row = $result->fetch_assoc()) {
                array_push($fuelTypes, $row);
            }
            return $fuelTypes;
        } else {
            echo "Execute Error";
        }
    } else {
        echo "Prepare Error";
    }
}

function getRegYear()
{
    global $conn;

    $regyear = array();
    $stmt = $conn->prepare("SELECT DISTINCT makeYear AS name , makeYear AS fname FROM carinfo ORDER BY name ASC");
    if ($stmt) {
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            while ($row = $result->fetch_assoc()) {
                array_push($regyear, $row);
            }

            return $regyear;
        } else {
            echo "Execute Error";
        }
    } else {
        echo "Prepare Error";
    }
}

function getCategories()
{

    $bodyType = array("category" => getBodyTypes());
    $years = array("category" => getRegYear());
    $fuelType = array("category" => getFuelTypes());


    //Budget
    $bd1 = array(

        "name" => "Below - 5 Lack",
        "id" => 1,
        "fname" => "0_5"
    );
    $bd2 = array(

        "name" => "Between 6-10 Lack",
        "id" => 2,
        "fname" => "6_10"
    );
    $bd3 = array(

        "name" => "Between 11-20 Lack",
        "id" => 3,
        "fname" => "11_20"
    );
    $bd4 = array(

        "name" => "Between 21-100 Lack",
        "id" => 3,
        "fname" => "21_100"
    );
    $budget = array("category" => array($bd1, $bd2, $bd3, $bd4));


    $categories = array("bodyType" => $bodyType, "budget" => $budget, "fuelType" => $fuelType, "years" => $years);
    return json_encode($categories);
}

//Login function
function login($username, $password)
{
    $password = md5($password);
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM `users` WHERE username=? AND password=?");

    if ($stmt) {
        $stmt->bind_param("ss", $username, $password);
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $rowcount = mysqli_num_rows($result);
            $finalresult = "";
            if ($rowcount == 1) {
                $row = $result->fetch_assoc();
                session_start();
                $_SESSION["LOGIN"] = true;
                $_SESSION["USERID"] = $row["id"];
                $_SESSION["USERNAME"] = $row["username"];
                $finalresult = array(
                    "result" => 1,
                    "message" => "Login Successful"
                );
                $finalresult = json_encode($finalresult);
            } else {
                $finalresult = array(
                    "result" => 0,
                    "message" => "Login Unsuccessful"
                );
                $finalresult = json_encode($finalresult);
            }
            return $finalresult;
            //  print_r($result);    /*If we give Index array to json_encode then it will give array. Else if we give Associative Array to jsonn_encode then it will give Json_string.*/
        } else {
            echo "Execute Error";
        }
    } else {
        echo "Prepare Error";
    }

    //    $result = "";
    //     if ($id == "admin" && $passwrd == "admin") {
    //         session_start();
    //         $_SESSION["USERNAME"] = $id;
    //         $_SESSION["LOGIN"] = true;
    //         $result = array(
    //             "result" => 1,
    //             "message" => "Login Successful"
    //         );
    //         $result = json_encode($result);
    //         // print_r($result);
    //     } else {
    //         $result = array(
    //             "result" => 0,
    //             "message" => "Login Unsuccessful"
    //         );
    //         $result = json_encode($result);
    //         

    //     }
    //     return $result;
}
//Registration
function registration($uname, $password, $mobile, $age, $dob, $city, $gender, $hobbies)
{
    $encpass = md5($password);
    global $conn;
    $stmt = $conn->prepare("INSERT INTO `users` (`username`, `password`, `mobile`, `age`, `dob`, `city`,`gender`,`hobbies`) VALUES (?,?,?,?,?,?,?,?);");
    if ($stmt) {
        $stmt->bind_param("sssissss", $uname, $encpass, $mobile, $age, $dob, $city, $gender, $hobbies);
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $result = array("result" => 1, "message" => "Registration Success");
            $result = json_encode($result);
            return $result;
        } else {
            echo "Execute Error";
        }
    } else {
        echo "Prepare Error";
    }
}
//GetCars
function getCars()
{
    global $conn;
    $limit = rand(3, 10);
    $cars = array();

    $stmt = $conn->prepare("SELECT * FROM `cars` LIMIT ?");
    if ($stmt) {
        $stmt->bind_param("i", $limit);
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            while ($car = $result->fetch_assoc()) {
                array_push($cars, $car);
            }
            $cars = array("cars" => $cars);
            return json_encode($cars);
        } else {
            echo "Execute Error";
        }
    } else {
        echo "Prepare Error";
    }
    // $cars = array($car1, $car2, $car3, $car4, $car5);
    // $cars = array("cars" => $cars);
    // return json_encode($cars);
}
