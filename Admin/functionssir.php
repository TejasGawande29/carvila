<?php
require_once('../dbconn.php');

$RESULT_TYPE = $_POST["RESULT_TYPE"];
switch ($RESULT_TYPE) {
    case "LOGIN":
        $result = login($_POST["USERNAME"], $_POST["PASSWORD"]);
        echo $result;
        break;
    case "DASHBOARD":
        $result = getDashboard();
        echo $result;
            break;
    case "MONTHLY_BOOKINGS":
        $result = getMonthlyBookings();
        echo $result;
        break;

    case "GET_CAR_INVENTORY":
        $result = getCarInventory();
        echo $result;
        break;
}

function getCarInventory()
{
    global $conn; 
    $stmt = $conn->prepare("SELECT cars.name,cars.image,carinfo.regYear,cars.kms,cars.fuelType,carinfo.transmission FROM `cars` INNER JOIN carinfo ON cars.id=carinfo.carid");
    if ($stmt) {
        if ($stmt->execute()) {
            $result = $stmt->get_result();       
            $carinventory=array();
            while($row = $result->fetch_assoc())
            {
                array_push($carinventory,$row);
            }
            return json_encode($carinventory);
        } else {
            echo "Execute Error";
        }
    } else {
        echo "Prepare Error";
    }

}


function getMonthlyBookings(){
    global $conn;
    $month=array();
    $bookings=array();

    $stmt = $conn->prepare("SELECT MONTHNAME(bookdate) as month ,COUNT(id) as bookings FROM `testdrives` GROUP BY MONTH(bookdate)");
    if ($stmt) {
        if ($stmt->execute()) {
            $result = $stmt->get_result();       
            while($row = $result->fetch_assoc())
            {
                array_push($month,$row["month"]);
                array_push($bookings,$row["bookings"]);
            }
            return json_encode(array("months"=>$month,"bookings"=>$bookings));
        } else {
            echo "Execute Error";
        }
    } else {
        echo "Prepare Error";
    }
}

function getDashboard()
{
    $result=array("carcount"=>mysqli_num_rows(getCars()),"usercount"=>mysqli_num_rows(getUsers()),"bookings"=>mysqli_num_rows(getBookings()),"revenue"=>getRevenue());
    return json_encode($result);
}

function getRevenue()
{
    global $conn;
    $stmt = $conn->prepare("SELECT SUM(cars.discountedPrice) as revenue FROM `testdrives` INNER JOIN cars ON testdrives.carid=cars.id;");
    if ($stmt) {
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();

            return $row['revenue'];
        } else {
            echo "Execute Error";
        }
    } else {
        echo "Prepare Error";
    }
}



function getBookings()
{
    global $conn;
    $stmt = $conn->prepare("SELECT *  FROM `testdrives`");
    if ($stmt) {
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            return $result;
        } else {
            echo "Execute Error";
        }
    } else {
        echo "Prepare Error";
    }
}

function getUsers()
{
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM `users`");
    if ($stmt) {
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            return $result;
        } else {
            echo "Execute Error";
        }
    } else {
        echo "Prepare Error";
    }
}


function getCars()
{
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM `cars`");
    if ($stmt) {
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            return $result;
        } else {
            echo "Execute Error";
        }
    } else {
        echo "Prepare Error";
    }
}


function login($username, $password)
{
    $password = md5($password);

    global $conn;
    $stmt = $conn->prepare("SELECT * FROM admins WHERE username=? AND password=?");
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
                $_SESSION["ROLE"] = $row["role"];

                $finalresult = array("result" => 1, "message" => "Login Success");
                $finalresult = json_encode($finalresult);
            } else {
                $finalresult = array("result" => 0, "message" => "Login Failed");
                $finalresult = json_encode($finalresult);
            }
            return $finalresult;
        } else {
            echo "Execute Error";
        }
    } else {
        echo "Prepare Error";
    }
}





?>