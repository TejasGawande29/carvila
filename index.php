<div>
    <?php
    include_once("Layouts/header.php")
    ?>
</div>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="CSS/bootstrap.min.css">
    <link rel="stylesheet" href="CSS/carvas.css">   

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        $(document).ready(function() {
            console.log("ready!");

            $.ajax({
                url: "functions.php",
                type: "POST",
                data: {
                    "userid": "admin",
                    "pass1": "admin",
                    "RESULT_TYPE": "GET_CARS"
                },
                success: function(res) {
                    var jobj = JSON.parse(res);
                    // console.log(jobj.cars);
                    // console.log("Tejas");
                    modelc(jobj.cars);

                }
            });

        });

        function redirectToCarlisting2() {
            window.location.href = "carlisting.php?filter=" + this.id;

        }

        function redirectToCarlisting(ele) {
            if (year.value != 0 && make.value != 0 && model.value != 0 && carstyle.value != 0 && condition.value != 0 && price.value != 0) {

                window.location.href = `carlisting.php?carid=${ele.id}`;
            } else {
                alert("Please Select all values!")
            }
        }

        function yearsChange() {
            $.ajax({
                url: "functions.php",
                type: "POST",
                data: {
                    "RESULT_TYPE": "SELECT_YEARS_CHANGE",
                    "YEAR": year.value
                },
                success: function(res) {
                    console.log(res);
                    var jobj = JSON.parse(res);
                    make.innerHTML = "";

                    var defaultOption = document.createElement("option");
                    defaultOption.innerHTML = "Select Make";
                    defaultOption.value = "0";
                    make.appendChild(defaultOption);

                    for (var i = 0; i < jobj.length; i++) {
                        var opt = document.createElement("option");
                        opt.innerHTML = jobj[i];
                        opt.value = jobj[i];
                        make.appendChild(opt);
                    }

                }
            });
        }
    </script>
    
</head>

<body  id="b1">
    <?php
    include_once("Layouts/header.php")
    ?>
    <div id="parent" style="background-image:url(img/carr.jpg); width: 100%; height: 192%;">

        <div id="heading">
            <h1 style="margin-top: 19%;">get your desired car in resonable price</h1>
        </div>

        <div id="contain">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dicta minus, officiis obcaecati et adipisci amet
            alias laudantium quas sit autem libero tenetur voluptates impedit, minima dolores odit asperiores ipsam
            sunt.
        </div>
        <div id="button">
            <button class="" id="contactus">Contact Us</button>
        </div>

    </div>
    <div class="containerForm">
        <table>
            <tr>
                <td>
                    <div class="formElementName">Select Year</div>
                    <Select class="select" id="year" onchange="yearsChange();">
                        <option value="0">Select Year</option>
                    </Select>
                </td>
                <td>
                    <div class="formElementName">Select Make</div>
                    <select name="" class="select" id="make" onchange="makeChange();">
                        <option value="0">Select Make</option>
                    </select>
                </td>
                <td>
                    <div class="formElementName">Select Model</div>
                    <select name="" class="select" id="model" onchange="modelchange();">
                        <option value="0">Select Model</option>
                    </select>
                </td>
                <td>
                    <Button id="search" class="Search" onclick="redirectToCarlisting(this)">Search</Button>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="formElementName">Body Style</div>
                    <select name="" class="select" id="carstyle" onchange="carstyleChange();">
                        <option value="0">Select Style</option>
                    </select>
                </td>
                <td>
                    <div class="formElementName">Car Condition</div>
                    <select name="" class="select" id="condition" onchange="conditionChange();">
                        <option value="0">Select Condition</option>
                    </select>
                </td>
                <td>
                    <div class="formElementName">Select Price</div>
                    <select name="" class="select" id="price">
                        <option value="0">Select Price</option>
                    </select>
                </td>
            </tr>
        </table>
    </div>
    <div class="informationcontainer">
        <div class="product" id="product1">
            <img src="img/screenshotlogo.png" alt="car" class="productimage">
            <h3 class="productheading">largest Dealership of Cars</h3>
            <p class="productpara">Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis quo beatae
                reprehenderit, animi
                consequuntur saepe?</p>
        </div>
        <div class="product" id="product2">
            <img src="img/screenshotrepair.png" alt="repair" class="productimage">
            <h3 class="productheading">Unlimited Reapair Warranty</h3>
            <p class="productpara">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis consectetur pariatur
                quisquam eligendi
                iusto ducimus!</p>
        </div>
        <div class="product" id="product3">
            <img src="img/screenshotinsurance.png" alt="insurance" class="productimage">
            <h3 class="productheading">Insurance Support</h3>
            <p class="productpara">Lorem ipsum dolor sit amet consectetur adipisicing elit. Explicabo fugiat debitis
                saepe alias?
                Voluptatibus, quas!</p>
        </div>
    </div>
    <div class="containernewest">
        <div id="chekout">Checkout the latest Cars</div>
        <div id="newestcars">Newest CARS</div>
    </div>
    <div class="slider-container">
        <div class="slides">
            <!-- Slide 1 -->
            <div class="slide">
                <img src="img/black.jpg" alt="Luxury Vehicle" width="300px" height="300px">
                <div class="content">
                    <h2 class="title">Premium Comfort</h2>
                    <p class="text">Experience unparalleled luxury and advanced technology in our flagship model.</p>
                    <button class="cta-button">Explore Features</button>
                </div>
            </div>

            <!-- Slide 2 -->
            <div class="slide">
                <img src="img/car3.WEBP" alt="Sports Car">
                <div class="content">
                    <h2 class="title">Adrenaline Boost</h2>
                    <p class="text">Discover raw power and precision engineering in our performance series.</p>
                    <button class="cta-button">View Specs</button>
                </div>
            </div>

            <!-- Slide 3 -->
            <div class="slide">
                <img src="img/car1.WEBP" alt="Family SUV">
                <div class="content">
                    <h2 class="title">Family Adventure</h2>
                    <p class="text">Spacious comfort meets rugged capability for your next journey.</p>
                    <button class="cta-button">See Options</button>
                </div>
            </div>

            <!-- Slide 4 -->
            <div class="slide">
                <img src="img/fc2.png" alt="Electric Vehicle">
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

    <div class="containernewest">
        <div id="chekout">Checkout the latest Featured Cars</div>
        <div id="newestcars">FEATURED CARS</div>
    </div>

    <div id="modelcontainer">

    </div>
    </div>
    <div class="carlist">

    </div>
    <div class="container-fluid" id="cin">
        <div class="row" id="row1">
            <div class="col-2">
                <h3>Cars by category</h3>
            </div>
            <div class="col-10">
                <hr>
            </div>
        </div>
        <div class="row" id="row2">
            <div class="col-2">
                <button id="bodyType" onclick="changeCategory(this)">Body Type</button>
            </div>
            <div class="col-2">
                <button id="carBudget" onclick="changeCategory(this)">Car budget</button>
            </div>
            <div class="col-2">
                <button id="fuelType" onclick="changeCategory(this)">Fuel type</button>
            </div>
            <div class="col-2">
                <button id="years" onclick="changeCategory(this)">Years</button>
            </div>
            <div class="col-4">

            </div>
        </div>


        <div class="row" id="row3">

        </div>
    </div>
    <div class="containernewest">
        <div id="chekout">Checkout the Featured Cars</div>
        <div id="newestcars">what our clients say</div>
        <hr style="width: 108px; border: 2px solid blue; margin-left: 703px;">
    </div>
    <div class="person">
        <div class="personal">
            <img src="img/p1.png" alt="">
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Omnis saepe laborum placeat impedit minima quos
                reiciendis doloribus, tempora earum quisquam, optio officia est vel distinctio.</p>
            <h4>Romain Lain</h4>
            <h5>London</h5>
        </div>
        <div class="personal">
            <img src="img/p2.png" alt="">
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Omnis saepe laborum placeat impedit minima quos
                reiciendis doloribus, tempora earum quisquam, optio officia est vel distinctio.</p>
            <h4>Amit</h4>
            <h5>UAE</h5>
        </div>
        <div class="personal">
            <img src="img/p3.png" alt="">
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Omnis saepe laborum placeat impedit minima quos
                reiciendis doloribus, tempora earum quisquam, optio officia est vel distinctio.</p>
            <h4>Shahrukh</h4>
            <h5>America</h5>
        </div>
    </div>
    <div class="brand">
        <div class="brandlogo logos"><img src="img/br1.png" alt=""></div>
        <div class="brandlogo"><img src="img/br2.png" alt=""></div>
        <div class="brandlogo"><img src="img/br3.png" alt=""></div>
        <div class="brandlogo"><img src="img/br2 (1).png" alt=""></div>
        <div class="brandlogo"><img src="img/br5.png" alt=""></div>
        <div class="brandlogo logoss"><img src="img/br6.png" alt=""></div>
    </div>
    <?php
    include_once("Layouts/footer.php")
    ?>
    <script>
        var btype = "";
        var carBudget = "";
        var fuelType = "";
        var years = "";


        $.ajax({
            url: "functions.php",
            type: "POST",
            data: {
                "userid": "admin",
                "pass1": "admin",
                "RESULT_TYPE": "GET_CATEGORIY"
            },
            success: function(res) {

                console.log(res);
                var jobj = JSON.parse(res);
                btype = jobj.bodyType;
                carBudget = jobj.budget;
                fuelType = jobj.fuelType;
                years = jobj.years;

                console.log(years);
                console.log("resforyears");

                bodyType.click();

            }
        });
        creteSelectBoxesOption();

        function changeCategory(element, id) {
            row3.innerHTML = "";
            console.log(element.id+"hkj");


            var jobj;
            var category;
            switch (element.id) {

                case "bodyType":
                    jobj = btype;
                    break;

                case "carBudget":
                    jobj = carBudget;
                    break;

                case "fuelType":
                    jobj = fuelType;
                    break;
                case "years":
                    jobj = years;
                    break;

            }

            category = jobj.category;
            console.log(category);
            console.log("category years");

            for (i = 0; i < category.length; i++) {

                var d1 = document.createElement("div");
                d1.classList.add("col-2");
                d1.id = element.id + "-" + category[i].fname;
                d1.addEventListener("click", redirectToCarlisting2)
                if (element.id == "bodyType") {
                    d1.id = element.id + "-" + category[i].fname + "-" + category[i].id;
                    var img1 = document.createElement("img");
                    img1.src = "img/" + category[i].image;
                    d1.appendChild(img1);
                }else{
                    
                }
                var h_5 = document.createElement("h5");
                h_5.innerHTML = category[i].name;
                d1.appendChild(h_5);

                row3.appendChild(d1);
            }

        }
        var MAKEMODEL = "";

        function makeChange($make, $year) {
            $.ajax({
                url: "functions.php",
                type: "POST",
                data: {
                    "RESULT_TYPE": "SELECT_MAKE_CHANGE",
                    "YEAR": year.value,
                    "MAKE": make.value
                },
                success: function(res) {
                    console.log(res);
                    var jobj = JSON.parse(res);

                    var model = document.getElementById("model");
                    model.innerHTML = "";

                    var defaultOption = document.createElement("option");
                    defaultOption.innerHTML = "Select Model";
                    defaultOption.value = "0";
                    model.appendChild(defaultOption);
                    //model option
                    for (var i = 0; i < jobj.length; i++) {
                        var opt = document.createElement("option");
                        opt.innerHTML = jobj[i];
                        opt.value = jobj[i];
                        model.appendChild(opt);
                    }
                }
            });


        }

        function modelchange() {
            $.ajax({
                url: "functions.php",
                type: "POST",
                data: {
                    "RESULT_TYPE": "SELECT_MODEL_CHANGE",
                    "YEAR": year.value,
                    "MAKE": make.value,
                    "MODEL": model.value
                },
                success: function(res) {
                    var jobj = JSON.parse(res);
                    console.log(jobj);
                    carstyle.innerHTML = "";
                    search

                    //CarStyle
                    var opt = document.createElement("option");
                    opt.innerHTML = jobj[0].bodyname;
                    opt.value = jobj[0].bodyType;
                    carstyle.appendChild(opt);
                    carstyle.disabled = true;
                    //Car condition
                    condition.innerHTML = "";
                    var opt = document.createElement("option");
                    opt.innerHTML = jobj[0].carcondition;
                    opt.value = jobj[0].carid;
                    condition.appendChild(opt);
                    condition.disabled = true;

                    //Price
                    price.innerHTML = "";
                    var opt = document.createElement("option");
                    opt.innerHTML = jobj[0].discountedPrice;;
                    opt.value = jobj[0].discountedPrice;
                    price.appendChild(opt);
                    price.disabled = true;
                    var getbtn = document.querySelector(".Search");
                    getbtn.id = jobj[0].carid;


                }
            });

        }
      

        function creteSelectBoxesOption() {

            $.ajax({
                url: "functions.php",
                type: "POST",
                data: {
                    "userid": "admin",
                    "pass1": "admin",
                    "RESULT_TYPE": "GET_YEAR_MAKE_MODEL"
                },
                success: function(res) {
                    console.log(res);
                    var jobj = JSON.parse(res);
                    MAKEMODEL = jobj.model
                    years = jobj.year;
                    //year option
                    for (var i = 0; i < years.length; i++) {
                        var opt = document.createElement("option");
                        opt.innerHTML = years[i];
                        opt.value = years[i];
                        year.appendChild(opt);
                    }
                }
            });

        }




        function redirectToCarInfo() {
            window.location.href = "info.php?carid=" + this.id
        }

        function modelc(carrsarr) {
            // console.log(carrsarr);
            // console.log("carrsarr");
            for (var i = 0; i < carrsarr.length; i++) {

                var item = document.createElement("div");
                var carimg = document.createElement("img");
                carimg.src = "img/" + carrsarr[i].image;
                item.appendChild(carimg);
                item.id = carrsarr[i].id;
                item.addEventListener("click", redirectToCarInfo)

                var carhr = document.createElement("hr");
                item.appendChild(carhr);

                var carspan1 = document.createElement("span");
                carspan1.innerHTML = carrsarr[i].name;
                item.appendChild(carspan1);

                var carspan2 = document.createElement("span");
                carspan2.innerHTML = carrsarr[i].fuelType;
                item.appendChild(carspan2);

                var carspan3 = document.createElement("span");
                carspan3.innerHTML = carrsarr[i].owner;
                item.appendChild(carspan3);

                var carhr2 = document.createElement("hr");
                item.appendChild(carhr2);

                var carh3 = document.createElement("h3");
                carh3.innerHTML = carrsarr[i].make;
                item.appendChild(carh3);

                var carh4 = document.createElement("h4");
                carh4.innerHTML = "₹" + carrsarr[i].discountedPrice;
                item.appendChild(carh4);

                var carp = document.createElement("p");
                carp.innerHTML = carrsarr[i].cardesc;
                item.appendChild(carp);

                item.classList.add("item");
                modelcontainer.appendChild(item);
            }
        }
    </script>
    <link href="CSS/slider.css" rel="stylesheet">
    <script src="js/slider.js"> </script>
</body>

</html>