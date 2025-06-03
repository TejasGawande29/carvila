<?php
error_log(print_r($_POST, true));
error_log(print_r($_FILES, true));
header('Content-Type: application/json');

// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "carvila";

// Handle file upload
$uploadDir = '../img/';
$imagePath = '';
$allowedTypes = ['image/jpeg', 'image/png', 'image/webp'];

if(isset($_FILES['image'])) {
    $file = $_FILES['image'];
    
    if($file['error'] === UPLOAD_ERR_OK) {
        $fileType = mime_content_type($file['tmp_name']);
        
        if(in_array($fileType, $allowedTypes)) {
            $fileName = uniqid() . '_' . basename($file['name']);
            $targetPath = $uploadDir . $fileName;
            
            if(move_uploaded_file($file['tmp_name'], $targetPath)) {
                $imagePath = $fileName;
            }
        }
    }
}

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->beginTransaction();

    // Insert into cars table
    $stmtCars = $conn->prepare("INSERT INTO cars (
        name, make, model, kms, fuelType, owner, emi, discountedPrice, 
        price, otherCharges, cardesc, image
    ) VALUES (
        :name, :make, :model, :kms, :fuelType, :owner, :emi, :discountedPrice, 
        :price, :otherCharges, :cardesc, :image
    )");

    // Bind parameters for cars table
    $stmtCars->bindParam(':name', $_POST['name']);
    $stmtCars->bindParam(':make', $_POST['make']);
    $stmtCars->bindParam(':model', $_POST['model']);
    $stmtCars->bindParam(':kms', $_POST['kms']);
    $stmtCars->bindParam(':fuelType', $_POST['fuelType']);
    $stmtCars->bindParam(':owner', $_POST['owner']);
    $stmtCars->bindParam(':emi', $_POST['emi']);
    $stmtCars->bindParam(':discountedPrice', $_POST['discountedPrice']);
    $stmtCars->bindParam(':price', $_POST['price']);
    $stmtCars->bindParam(':otherCharges', $_POST['otherCharges']);
    $stmtCars->bindParam(':cardesc', $_POST['cardesc']);
    $stmtCars->bindParam(':image', $imagePath);
    
    $stmtCars->execute();
    $carId = $conn->lastInsertId();

    // Insert into carinfo table
    $stmtCarInfo = $conn->prepare("INSERT INTO carinfo (
        carid, regYear, makeYear, regNo, transmission, engine, insurance,
        spareKey, location, ssf, alloyWheels, cityDriven, bodyType, carcondition
    ) VALUES (
        :carid, :regYear, :makeYear, :regNo, :transmission, :engine, :insurance,
        :spareKey, :location, :ssf, :alloyWheels, :cityDriven, :bodyType, :carcondition
    )");

    // Bind parameters for carinfo table
    $stmtCarInfo->bindParam(':carid', $carId);
    $stmtCarInfo->bindParam(':regYear', $_POST['regYear']);
    $stmtCarInfo->bindParam(':makeYear', $_POST['makeYear']);
    $stmtCarInfo->bindParam(':regNo', $_POST['regNo']);
    $stmtCarInfo->bindParam(':transmission', $_POST['transmission']);
    $stmtCarInfo->bindParam(':engine', $_POST['engine']);
    $stmtCarInfo->bindParam(':insurance', $_POST['insurance']);
    $stmtCarInfo->bindParam(':spareKey', $_POST['sparekey']);
    $stmtCarInfo->bindParam(':location', $_POST['location']);
    $stmtCarInfo->bindParam(':ssf', $_POST['ssf']);
    $stmtCarInfo->bindParam(':alloyWheels', $_POST['alloywheels']);
    $stmtCarInfo->bindParam(':cityDriven', $_POST['citydriven']);
    $stmtCarInfo->bindParam(':bodyType', $_POST['bodytype']);
    $stmtCarInfo->bindParam(':carcondition', $_POST['carcondition']);
    
    $stmtCarInfo->execute();

    $conn->commit();

    echo json_encode([
        'success' => true,
        'message' => 'Car added successfully',
        'imagePath' => $imagePath,
        'carId' => $carId
    ]);

} catch(PDOException $e) {
    $conn->rollBack();
    echo json_encode([
        'success' => false,
        'message' => 'Database error: ' . $e->getMessage()
    ]);
}