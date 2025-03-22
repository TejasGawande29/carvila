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
            /*  $.ajax({
                  url: "test.html",
                  cache: false,
                  success: function(html) {
                      $("#results").append(html);
                  }
              });*/

            $.ajax({
                url: "functions.php",
                type: "POST",
                data: {
                    "userid": "admin",
                    "pass1": "admin",
                    "RESULT_TYPE": "GET_CARS"
                },
                success: function(res) {
                    getCars(res);

                }
            });

        });

        function redirectToCarlisting2() {
            window.location.href = "carlisting.php?filter=" + this.id
        }

        function redirectToCarlisting() {
            if (year.value != 0 && make.value != 0 && model.value != 0 && carstyle.value != 0 && condition.value != 0 && price.value != 0) {

                window.location.href = `carlisting.php?year=${year.value}&make=${make.value}&model=${model.value}&carstyle=${carstyle.value}&condition=${condition.value}&price=${price.value}`
            } else {
                alert("Please Select all values!")
            }
        }
    </script>
</head>

<body id="b1">
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
            <button id="contactus">Contact Us</button>
        </div>

    </div>
    <div class="containerForm">
        <table>
            <tr>
                <td>
                    <div class="formElementName">Select Year</div>
                    <Select class="select" id="year">
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
                    <select name="" class="select" id="model">
                        <option value="0">Select Model</option>
                    </select>
                </td>
                <td>
                    <Button id="search" onclick="redirectToCarlisting();">Search</Button>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="formElementName">Body Style</div>
                    <select name="" class="select" id="carstyle">
                        <option value="0">Select Style</option>
                    </select>
                </td>
                <td>
                    <div class="formElementName">Car Condition</div>
                    <select name="" class="select" id="condition">
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
    <!-- <div class="containercardescription">
        <span id="yellowcar"><img src="img/yellowcar.png" alt="" id="image"></span>
        <span class="yellowcardescription">
            <h3 id="chevroletcarheading">Chevrolet Camaro ZA100</h3>
            <p id="chevroeltcardescription">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Quam voluptate asperiores eos cum. Rerum sunt
                tenetur repellendus id quaerat repudiandae repellat laudantium est. Dolor fuga earum, possimus fugiat
                rerum explicabo ad illo saepe distinctio vitae doloribus voluptas soluta praesentium sequi impedit
                commodi
            </p>
            <p style="margin-top: -17px;">Lorem ipsum dolor sit amet consectetur adipisicing elit. Odio similique
                cupiditate quibusdam n</p>
            <button id="chevroletcarbutton">View Deatails</button>
        </span>
    </div> -->

    <!--Slider -->
  
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
                <button id="years" onclick="changeCategory(this)">Year</button>
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
    <!-- <class="container-fluid">
        <div class="row">
            <div class="col">
                <h3>CARVILLA</h3>
                <P>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Rem, ipsam. Lorem ipsum dolor sit amet
                    consectetur, adipisicing elit. Numquam, ut?</P>
                <p>name@domain.com <br>+1(222)1234567890</p>
            </div>
            <div class="col">
                <h3 style="font-size: 17px;">ABOUT DEVLOON</h3>
                <ul><br><br>
                    <li>About us</li>
                    <li>Career</li>
                    <li>Terms of Service</li>
                    <li>Privacy Policy</li>
                </ul>
            </div>
            <div class="col">
                <h3 style="font-size: 17px;">TOP BRANDS</h3>
                <ul><br><br>
                    <li>BMW</li>
                    <li>Lamborghini</li>
                    <li>Camarao</li>
                    <li>Audi</li>
                    <li>Infiniti</li>
                    <li>Nissan</li>
                </ul>
            </div>
            <div class="col">
                <ul><br><br><br><br><br>
                    <li>Ferrari</li>
                    <li>Porsche</li>
                    <li>Land Rover</li>
                    <li>Astan Martin</li>
                    <li>Mersedes</li>
                    <li>Opei</li>
                </ul>
            </div>
            <div class="col">
                <h3 style="font-size: 17px;">NEWS LETTER</h3>
                <p>Subscribe to get latest news update <br>and information</p>
                <input type="email" placeholder="Add Email">
            </div>
        </div>
        <div class="row">
            <hr>
            <div class="col-9">
                <p>© copyright. designed and developed by themesine.</p>
            </div>
            <div class="col-3">
                <img src="img/fblogo.png" alt="fb" style="    margin-left: 158px;">
                <img src="img/instalogo.png" alt="inst">
                <img src="img/twtlogo.png" alt="linkden">
                <img src="img/ytlogo.webp" alt="p">

                
            </div>
        </div> -->
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
                var jobj = JSON.parse(res);
                btype = jobj.bodyType;
                carBudget = jobj.budget;
                fuelType = jobj.fuelType;
                years = jobj.years;
                bodyType.click();

            }
        });


        creteSelectBoxesOption();



        /*   function filterYear(){
               row3.innerHTML = "";
               var filterYear = `{
                             "filteryear":[
                             {"year":"2024"},{"year":"2023"},{"year":"2022"},{"year":"2021"},
                             {
                             "year":"2020"
                             },{"year":"2019"},{"year":"2018"},{"year":"2017"},{"year":"2016"},{"year":"2015"}
                             ]
                             }`
               var eobj = JSON.parse(filterYear);
               var eobjarr = eobj.filteryear;
   
   
   
               for (i = 0; i < eobjarr.length; i++) {
                   var c1 = document.createElement("div");
                   c1.classList.add("col-2")
                   row3.appendChild(c1);
   
                   var h_5 = document.createElement("h5");
                   h_5.classList.add("jsh_5")
                   h_5.innerHTML = eobjarr[i].year;
                   c1.appendChild(h_5);
                   console.log(eobjarr[i].year);
               }
           }
           function filterFuelType() {
               row3.innerHTML = "";
               var filterfueltype = `{
                             "filterfueltype":[
                             {
                             "fuel":"Petrol"
                             },
                             {
                             "fuel":"Diesel"
                             },
                             {
                             "fuel":"Electric"
                             }
                             ]
                             }`
               var dobj = JSON.parse(filterfueltype);
               var dobjarr = dobj.filterfueltype;
   
   
   
               for (i = 0; i < dobjarr.length; i++) {
                   var c1 = document.createElement("div");
                   c1.classList.add("col-2")
                   row3.appendChild(c1);
   
                   var h_5 = document.createElement("h5");
                   h_5.classList.add("jsh_5")
                   h_5.innerHTML = dobjarr[i].fuel;
                   c1.appendChild(h_5);
                   console.log(dobjarr[i].fuel);
               }
           }
           function filterCarBudget() {
               row3.innerHTML = "";
   
               var filtercarbudget = `{
                             "filterCarBudget":[
                             {
                             "range":"Below 1 Lack"
                             },
                             {
                             "range":"Between 1-3 Lack"
                             },
                             {
                             "range":"Between 3-7 Lack"
                             },{"range":"Between 7-12 Lack"},{"range":"Between 12-20 Lack"},
                             {"range":"Above 20 Lack"},{"range":"Above 20 Lack"},{"range":"Above 20 Lack"},{"range":"Above 20 Lack"}
                             ]
                             }`
               var cobj = JSON.parse(filtercarbudget);
               var cobjarr = cobj.filterCarBudget;
   
   
   
               for (i = 0; i < cobjarr.length; i++) {
                   var b1 = document.createElement("div");
                   b1.classList.add("col-2")
                   row3.appendChild(b1);
   
                   var h_5 = document.createElement("h5");
                   h_5.classList.add("jsh_5")
                   h_5.innerHTML = cobjarr[i].range;
                   b1.appendChild(h_5);
                   console.log(cobjarr[i].range);
               }
           }*/

        function changeCategory(element, id) {
            row3.innerHTML = "";
            console.log(element.id);

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

            category = jobj.category
            //  console.log(category);

            for (i = 0; i < category.length; i++) {

                var d1 = document.createElement("div");
                d1.classList.add("col-2");
                d1.id = element.id + "-" + category[i].fname;
                d1.addEventListener("click", redirectToCarlisting2)
                if (element.id == "bodyType") {
                    var img1 = document.createElement("img");
                    img1.src = category[i].image;
                    d1.appendChild(img1);
                }
                var h_5 = document.createElement("h5");
                h_5.innerHTML = category[i].name;
                d1.appendChild(h_5);

                row3.appendChild(d1);


            }

        }

        var MAKEMODEL = "";

        function makeChange() {
            console.log(make);
            var modelc = MAKEMODEL[make.value];


            var model = document.getElementById("model");
            model.innerHTML = "";

            var defaultOption = document.createElement("option");
            defaultOption.innerHTML = "Select";
            defaultOption.value = "Select";
            model.appendChild(defaultOption);

            console.log(modelc.length);

            for (var i = 0; i < modelc.length; i++) {
                var opt = document.createElement("option");
                opt.innerHTML = modelc[i];
                opt.value = modelc[i];
                model.appendChild(opt);
            }

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
                    //year option
                    for (var i = 2020; i < 2025; i++) {
                        var opt = document.createElement("option");
                        opt.innerHTML = i;
                        opt.value = i;
                        year.appendChild(opt);
                    }

                    //Make option
                    var makeArr = jobj.make;
                    for (var i = 0; i < makeArr.length; i++) {
                        var opt = document.createElement("option");
                        opt.innerHTML = makeArr[i];
                        opt.value = makeArr[i];
                        make.appendChild(opt);
                    }
                }
            });



            //Style
            var styleArr = ["Sudan", "SUV", "Hatch-Back"];
            for (var i = 0; i < styleArr.length; i++) {
                var opt = document.createElement("option");
                opt.innerHTML = styleArr[i];
                opt.value = styleArr[i];
                carstyle.appendChild(opt);
            }

            //Car condition
            var conditionArr = ["Good", "Better", "Best", "Average"];
            for (var i = 0; i < conditionArr.length; i++) {
                var opt = document.createElement("option");
                opt.innerHTML = conditionArr[i];
                opt.value = conditionArr[i];
                condition.appendChild(opt);
            }

            //Price
            var priceArr = ["Below_1_lack", "Between_1_3_lack", "Between_3_7_lack", "Between_7_12_lack", "Between_12_20_lack", "Above_20_lack", ];
            for (var i = 0; i < priceArr.length; i++) {
                var opt = document.createElement("option");
                opt.innerHTML = priceArr[i];
                opt.value = priceArr[i];
                price.appendChild(opt);
            }
        }


        function getCars(cars) {


            var jobj = JSON.parse(cars);
            var carrsarr = jobj.cars;
            modelc(carrsarr);
        }

        function modelc(carsArray) {

            carsArray.forEach(car => {
                console.log("Make: " + car.make);
                console.log("Model: " + car.model);
                console.log("Price: " + car.price);

            });
        }

        function redirectToCarInfo() {
            window.location.href = "info.php?carid=" + this.id
        }

        function modelc(carrsarr) {

            for (var i = 0; i < carrsarr.length; i++) {

                var item = document.createElement("div");
                var carimg = document.createElement("img");
                carimg.src = carrsarr[i].image;
                item.appendChild(carimg);
                item.id = carrsarr[i].id;
                item.addEventListener("click", redirectToCarInfo)

                var carhr = document.createElement("hr");
                item.appendChild(carhr);

                var carspan1 = document.createElement("span");
                carspan1.innerHTML = "model: 2017";
                item.appendChild(carspan1);

                var carspan2 = document.createElement("span");
                carspan2.innerHTML = "3100 mi";
                item.appendChild(carspan2);

                var carspan3 = document.createElement("span");
                carspan3.innerHTML = "240HP";
                item.appendChild(carspan3);

                var carhr2 = document.createElement("hr");
                item.appendChild(carhr2);

                var carh3 = document.createElement("h3");
                carh3.innerHTML = "infiniti z5 ";
                item.appendChild(carh3);

                var carh4 = document.createElement("h4");
                carh4.innerHTML = "$36,850";
                item.appendChild(carh4);

                var carp = document.createElement("p");
                carp.innerHTML = "lorem epsum dskha asdjhowehjk a";
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