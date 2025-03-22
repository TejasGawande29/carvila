<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transition</title>
    <style>
        
        .car1{
            width: 230px;
            height: 200px;
            transition: all 4s ease 0s;
        }
        .car2{
            width: 230px;
            height: 200px;
            transition: all 4s linear 0s;
        }  
        .car3{
            width: 230px;
            height: 200px;
            transition: all 4s ease-in-out 0s;
        }  
        .container:hover .car1{
            transform: translatex(1200px);
        }
        .container:hover .car2{
            transform: translatex(1200px);
        }
        .container:hover .car3{
            transform: translatex(1200px);
        }
    </style>
</head>
<body>
    <div class="container">
        <img class="car1" src="img/car-icon-in-flat-style-simple-traffic-icon-free-vector.jpg" alt="">

        <br>

        <img class="car2" src="img/car-icon-red-Graphics-8433168-1.jpg" alt="">

        <br>
        <img class="car3" src="img/images (1).jpg" alt="">
    </div>
</body>
</html>