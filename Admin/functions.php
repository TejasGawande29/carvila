<?php
include_once('../dbconn.php');
$RESULT_TYPE = $_POST["RESULT_TYPE"];
switch ($RESULT_TYPE) {
    case "LOGIN":
        $result = login($_POST["USERID"], $_POST["PASS1"]);
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
    case "GET_USERS_DETAILS":
        $result = getUsersDetails();
        echo $result;
        break;
}
function getUsersDetails(){
    $result = getUsers();
    $finalArray = array();
    while($row = $result->fetch_assoc()){
        $editbtn="<button class='btn btn-outline-primary'>Edit</button>";
        $deletebtn="<button class='btn btn-outline-danger'>Delete</button>";
        $temp = array(
            $row["id"],
            $row["username"],
            $row["mobile"],
            $row["age"],
            $row["city"],
            $row["regdate"],
            $editbtn,
            $deletebtn
        );
        array_push($finalArray,$temp);

    }
    return json_encode($finalArray);
}
function getCarInventory()
{
    global $conn;
    $stmt = $conn->prepare("SELECT cars.name,cars.image,carinfo.regYear,cars.kms,cars.fuelType,carinfo.transmission FROM `cars` INNER JOIN carinfo ON cars.id=carinfo.carid");
    if ($stmt) {
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $carinventory = array();
            while ($row = $result->fetch_assoc()) {
                array_push($carinventory, $row);
            }
            return json_encode($carinventory);
        } else {
            echo "Execute Error";
        }
    } else {
        echo "Prepare Error";
    }
}



function getMonthlyBookings()
{
    global $conn;
    $month = array();
    $bookings = array();
    $stmt = $conn->prepare("SELECT MONTHNAME(bookdate) AS month, COUNT(id) AS bookings FROM `testdrives` GROUP BY MONTH(bookdate)");
    if ($stmt) {
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            while ($row = $result->fetch_assoc()) {
                array_push($month, $row["month"]);
                array_push($bookings, $row["bookings"]);
            }
            return json_encode(array("month" => $month, "bookings" => $bookings));
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
function getBookings()
{
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM `testdrives`");
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
function getRevenue()
{
    global $conn;
    $stmt = $conn->prepare("SELECT SUM(cars.discountedPrice) AS revenue FROM `testdrives` INNER JOIN `cars` ON testdrives.carid=cars.id");
    if ($stmt) {
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            return $row["revenue"];
        } else {
            echo "Execute Error";
        }
    } else {
        echo "Prepare Error";
    }
}
function getDashboard()
{
    $result = array(
        "carcount" => mysqli_num_rows(getCars()),
        "usercount" => mysqli_num_rows(getUsers()),
        "bookings" => mysqli_num_rows(getBookings()),
        "revenue" => getRevenue()
    );
    return json_encode($result);
}

//Login function
function login($username, $password)
{
    $password = md5($password);
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM `admins` WHERE username=? AND password=?");

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
}
