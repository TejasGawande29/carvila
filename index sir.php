<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        $(document).ready(function() {
            console.log("ready!");

            $.ajax({
                url: "functions.php",
                type: "POST",
                data: {
                    "RESULT_TYPE": "GET_CARS"
                },
                success: function(res) {
                    console.log(res)
                    getCars(res);
                }
            });

        });

        function redirectToCarListing() {

            if (year.value != 0 && make.value != 0 && model != 0 && carStyle.value != 0 && condition.value != 0 && price.value != 0) {
                window.location.href = `carlisting.php?year=${year.value}&make=${make.value}&model=${model.value}&style=${carStyle.value}&condition=${condition.value}&price=${price.value}`
            } else {
                alert("Please select all values");
            }
        }

        function redirectToCarListing2() {
            window.location.href = "carlisting.php?filter=" + this.id
        }
    </script>


</head>

<body>

    <header style="display: none;">
        <nav>
            <div class="menu-container">
                <button class="hamburger" onclick="toggleMenu()">
                    ☰
                </button>
                <ul class="menu">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Services</a></li>
                    <li><a href="#">Featured Cars</a></li>
                    <li><a href="#">New Cars</a></li>
                    <li><a href="#">Brands</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </div>
        </nav>
    </header>

    <div style="background-image: url('images/car.jpg'); height:700px" class="originalMenu">

        <?php
        include_once("layouts/header.php");
        ?>

        <h1 style=" font-size: 40px;text-transform: uppercase;color: white;margin-top: 5%;text-align: center;">
            get your desired car in resonable price
        </h1>


        <p style="color: white;margin: 5%;text-align: center;width: 70%;margin-left: 15%;">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias, fugit dolorem, vitae corporis atque modi perferendis odit, quisquam optio ea quos fugiat beatae quo nesciunt a qui veritatis! Magnam, facere!
        </p>

        <button style=" margin-left: 45%;width: 150px;height: 65px;border-radius: 15px;">
            Contact Us
        </button>
    </div>

    <div style="width: 80%; background-color: rgba(254, 254, 254, 0.846);margin-left: 10%;margin-top: -150px;border-radius: 10px;z-index: 1;box-shadow:10px 10px 30px -8px rgb(0, 0, 0);">

        <div style="display: flex; flex-wrap: wrap;">
            <div class="selectClass">
                <p>Select Year</p>
                <select class="selectChild" name="" id="year">
                    <option value="0">Select Year</option>

                </select>
            </div>
            <div class="selectClass">
                <p>Select Make</p>
                <select class="selectChild" name="" id="make" onchange="makeChange();">
                    <option value="0">Select Make</option>
                </select>
            </div>
            <div class="selectClass">
                <p>Select Model</p>
                <select class="selectChild" name="" id="model">
                    <option value="0">Select Model</option>
                </select>
            </div>
            <div>

            </div>
        </div>

        <div style="display: flex;flex-wrap: wrap;">
            <div class="selectClass">
                <p>Body Style</p>
                <select class="selectChild" name="" id="carStyle">
                    <option value="0">Select Style</option>
                    <option value="sedan">Sedan</option>
                    <option value="van">Van</option>
                    <option value="hatchback">Hatchback</option>
                    <option value="coupe">Coupe</option>
                    <option value="suv">SUV</option>
                    <option value="jeep">Jeep</option>
                    <option value="pickup">PickUp</option>
                </select>
            </div>
            <div class="selectClass">
                <p>Car Condition</p>
                <select class="selectChild" name="" id="condition">
                    <option value="0">Select Condition</option>
                    <option value="new">New</option>
                    <option value="old">Old</option>
                </select>
            </div>
            <div class="selectClass">
                <p>Select Price</p>
                <select class="selectChild" name="" id="price">
                    <option value="0">Select Price</option>
                    <option value="under_1l">Under 1 Lakh</option>
                    <option value="under_3l">Under 3 Lakh</option>
                    <option value="under_5l">Under 5 Lakh</option>
                    <option value="under_7l">Under 7 Lakh</option>
                    <option value="under_10l">Under 10 Lakh</option>
                </select>
            </div>
            <div style="position: absolute; margin-left: 70%;">
                <button class="btnClass" onclick="redirectToCarListing();">Search</button>

            </div>
        </div>
    </div>

    <div style="display: flex; text-align: center;margin-top: 5%;">
        <div class="carbox">
            <img src="images/caricon.png" alt="">
            <h3>Lorem ipsum dolor sit.</h3>
            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Impedit suscipit doloremque nostrum nulla est mollitia inventore nisi. Provident, iste? Blanditiis.</p>
            <p class="pClass lranimation"></p>
        </div>
        <div class="carbox">
            <img src="images/cargarriage.png" alt="">
            <h3>Lorem ipsum dolor sit.</h3>
            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Impedit suscipit doloremque nostrum nulla est mollitia inventore nisi. Provident, iste? Blanditiis.</p>
            <p class="pClass lranimation"></p>
        </div>

        <div class="carbox">
            <img src="images/car-insurance.png" alt="">
            <h3>Lorem ipsum dolor sit.</h3>
            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Impedit suscipit doloremque nostrum nulla est mollitia inventore nisi. Provident, iste? Blanditiis.</p>
            <p class="pClass lranimation"></p>
        </div>
    </div>

    <div style="background-color: rgba(241, 241, 241, 0.918); text-align: center;padding: 20px;">
        <p>checkout the latest cars</p>
        <h2>Newest Cars</h2>
        <p class="pClass lranimation"></p>
    </div>

    <!-- Slider
    <div style="display: flex; padding: 10px;margin: 20px;">
        <div>
            <img src="images/yellowcar.png" alt="" style="width:550px; height: 300px; padding: 25px;">
        </div>

        <div style="padding: 15px;">
            <h2>Lorem ipsum dolor sit.</h2>
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Cupiditate, consectetur corrupti? Vero eius eum tenetur, voluptatem veniam officiis, aliquid dolor pariatur vel temporibus quasi debitis.</p>
            <button class="btnClass" onclick="redirectToCarInfo()" id="1">View Details</button>
        </div>

    </div>
    -->

    <!--Slider -->
  
    <div class="slider-container">
        <div class="slides">
            <!-- Slide 1 -->
            <div class="slide">
                <img src="images/c1.png" alt="Luxury Vehicle">
                <div class="content">
                    <h2 class="title">Premium Comfort</h2>
                    <p class="text">Experience unparalleled luxury and advanced technology in our flagship model.</p>
                    <button class="cta-button">Explore Features</button>
                </div>
            </div>

            <!-- Slide 2 -->
            <div class="slide">
                <img src="images/c2.png" alt="Sports Car">
                <div class="content">
                    <h2 class="title">Adrenaline Boost</h2>
                    <p class="text">Discover raw power and precision engineering in our performance series.</p>
                    <button class="cta-button">View Specs</button>
                </div>
            </div>

            <!-- Slide 3 -->
            <div class="slide">
                <img src="images/c3.png" alt="Family SUV">
                <div class="content">
                    <h2 class="title">Family Adventure</h2>
                    <p class="text">Spacious comfort meets rugged capability for your next journey.</p>
                    <button class="cta-button">See Options</button>
                </div>
            </div>

            <!-- Slide 4 -->
            <div class="slide">
                <img src="images/c4.png" alt="Electric Vehicle">
                <div class="content">
                    <h2 class="title">Eco Future</h2>
                    <p class="text">Sustainable innovation with zero-compromise performance.</p>
                    <button class="cta-button">Learn More</button>
                </div>
            </div>
        </div>

        <!-- Controls -->
        <button class="arrow prev" aria-label="Previous slide">❮</button>
        <button class="arrow next" aria-label="Next slide">❯</button>
        <div class="dots"></div>
    </div>
        
        <!-- Slider  -->



        <div style="background-color: rgba(241, 241, 241, 0.918); text-align: center;padding: 20px;">
            <p>checkout the featured cars</p>
            <h2>featured cars</h2>
            <p class="pClass lranimation"></p>
        </div>

        <div style="display: flex; flex-wrap: wrap; text-align: center;" id="b1">


        </div>

        <div class="container-fluid m-4">
            <div class="row">
                <div class="col">
                    <h2>Cars By Category</h2>
                </div>
            </div>
            <div class="row">
                <div class="col mt-4">
                    <button class="btn btn-outline-info m-4" id="bodyType" style=" border-radius: 100px;width: 20%; " onclick="changeCategory(this)">Body Type</button>
                    <button class="btn btn-outline-info m-4" id="budget" style=" border-radius: 100px;width: 20%; " onclick="changeCategory(this);">Car Budget</button>
                    <button class="btn btn-outline-info m-4" id="fuelType" style=" border-radius: 100px;width: 20%; " onclick="changeCategory(this);">Fuel Type</button>
                    <button class="btn btn-outline-info m-4" id="years" style=" border-radius: 100px;width: 20%; " onclick="changeCategory(this);">Year</button>
                </div>
            </div>
            <div class="row p-4" style="background-color: rgba(195, 195, 195, 0.611);" id="carCategory">

            </div>
        </div>




        <div style="background-color: rgba(241, 241, 241, 0.918); text-align: center;padding: 20px;">
            <h3>What Our Clients Say</h3>
            <p class="pClass lranimation" style="text-align: center;">
            </p>
        </div>

        <div style="display: flex; text-align: center;margin-top: 5%;">
            <div class="carbox">
                <img src="images/i1.png" alt="" style="margin: 25px;">
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Impedit suscipit doloremque nostrum nulla est mollitia inventore nisi. Provident, iste? Blanditiis.</p>
                <h3>Lorem ipsum dolor sit.</h3>

                <p class="pClass lranimation"></p>
            </div>
            <div class="carbox">
                <img src="images/i2.png" alt="" style="margin: 25px;">
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Impedit suscipit doloremque nostrum nulla est mollitia inventore nisi. Provident, iste? Blanditiis.</p>
                <h3>Lorem ipsum dolor sit.</h3>

                <p class="pClass lranimation"></p>
            </div>

            <div class="carbox">
                <img src="images/i3.png" alt="" style="margin: 25px;">
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Impedit suscipit doloremque nostrum nulla est mollitia inventore nisi. Provident, iste? Blanditiis.</p>
                <h3>Lorem ipsum dolor sit.</h3>
                <p class="pClass lranimation"></p>
            </div>
        </div>

        <div style="display: flex; text-align: center; justify-content: center;" class="mt-2 mb-2">
            <img src="images/ic1.png" alt="" class="iconClass">
            <img src="images/ic2.png" alt="" class="iconClass">
            <img src="images/ic3.png" alt="" class="iconClass">
            <img src="images/ic4.png" alt="" class="iconClass">
            <img src="images/ic5.png" alt="" class="iconClass">
            <img src="images/ic6.png" alt="" class="iconClass">
        </div>


        <?php
        include_once("layouts/footer.php");
        ?>

</body>


<script>
    var btype = ""
    var budget = ""
    var fuelType = ""
    var years = ""
    $.ajax({
        url: "functions.php",
        type: "POST",
        data: {
            "RESULT_TYPE": "GET_CATEGORIES"
        },
        success: function(res) {
            console.log(res)
            var jobj = JSON.parse(res)
            btype = jobj.bodyType
            budget = jobj.budget
            fuelType = jobj.fuelType
            years = jobj.years
            bodyType.click();
        }
    });

    //changeCategory()


    function cbody() {
        alert(this.id)
    }


    function changeCategory(element) {
        console.log(element.id)
        carCategory.innerHTML = ""
        var jobj;
        var category;

        switch (element.id) {

            case "bodyType":
                jobj = btype
                break;

            case "budget":
                jobj = budget
                break;

            case "fuelType":
                jobj = fuelType
                break;

            case "years":
                jobj = years
                break;
        }
        category = jobj.category

        for (var i = 0; i < category.length; i++) {
            d1 = document.createElement("div");
            d1.id = element.id + "-" + category[i].fname
            d1.addEventListener("click", redirectToCarListing2)

            if (element.id == "bodyType") {
                i1 = document.createElement("img")
                i1.src = "images/" + category[i].image;
                d1.appendChild(i1)
                d1.classList.add("col-3", "p-3", "m-4", "rounded", "bg-white", "text-center")
            }

            d1.classList.add("col-2", "p-3", "m-4", "rounded", "bg-white", "text-center")
            h_4 = document.createElement("h4")
            h_4.innerHTML = category[i].name
            h_4.classList.add("text-center", "m-3")
            d1.appendChild(h_4)
            carCategory.appendChild(d1)
        }

    }

    function getCars(cars) {
        var jobj = JSON.parse(cars)
        var carrsarr = jobj.cars
        createCars(carrsarr);
    }

    createSelectBoxes();

    var MAKEMODEL = ""

    function makeChange() {
        model.innerHTML = ""
        var makeArr = MAKEMODEL[make.value]
        for (var i = 0; i < makeArr.length; i++) {
            var opt = document.createElement("option");
            opt.innerHTML = makeArr[i]
            opt.value = makeArr[i]
            model.appendChild(opt)
        }
        console.log(make.value)
    }

    function createSelectBoxes() {

        $.ajax({
            url: "functions.php",
            type: "POST",
            data: {
                "RESULT_TYPE": "GET_YEAR_MAKE_MODEL"
            },
            success: function(res) {
                console.log(res)
                var jobj = JSON.parse(res)

                MAKEMODEL = jobj.model
                yearsArr = jobj.years

                for (var i = 0; i < yearsArr.length; i++) {
                    var opt = document.createElement("option");
                    opt.innerHTML = yearsArr[i]
                    opt.value = yearsArr[i]
                    year.appendChild(opt)
                }

                makeArr = jobj.make
                for (var i = 0; i < makeArr.length; i++) {
                    var opt = document.createElement("option");
                    opt.innerHTML = makeArr[i]
                    opt.value = makeArr[i]
                    make.appendChild(opt)
                }



            }
        });
    }

    function redirectToCarInfo() {
        window.location.href = "carinfo.php?carid=" + this.id
    }

    function createCars(carrsarr) {
        console.log(carrsarr)
        for (var i = 0; i < carrsarr.length; i++) {
            var car = carrsarr[i];
            var d1 = document.createElement("div")
            d1.id = car.id
            d1.addEventListener("click", redirectToCarInfo)

            var i1 = document.createElement("img")
            i1.src = "images/" + car.image;
            d1.appendChild(i1)

            var hr1 = document.createElement("hr")
            d1.appendChild(hr1)

            var p1 = document.createElement("p")
            p1.innerHTML = "model: 2017 3100 mi 240HPautomatic"
            d1.appendChild(p1)

            var hr2 = document.createElement("hr")
            d1.appendChild(hr2)

            var h_2 = document.createElement("h2")
            h_2.innerHTML = car.make
            d1.appendChild(h_2)


            var h_4 = document.createElement("h4")
            h_4.innerHTML = "$89,395"
            d1.appendChild(h_4)


            var p2 = document.createElement("p")
            p2.innerHTML = "Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non"
            d1.appendChild(p2)

            d1.classList.add("carBorder")
            b1.appendChild(d1)
            console.log(d1)
        }
    }


    function toggleMenu() {
        const menu = document.querySelector('.menu');
        const button = document.querySelector('.hamburger');

        menu.classList.toggle('show');
        button.classList.toggle('active');
    }
</script>



<link href="css/slider.css" rel="stylesheet">
<script src="js/slider.js"> </script>


</html>