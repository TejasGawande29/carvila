<?php
include_once("Layouts/header.php")
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Listing</title>
    <link rel="stylesheet" href="CSS/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .container {
            /* background-color: ; */
            /* display: grid;
            grid-template-columns: 20% 80%; */
            display: flex;
            height: 100vh;
            width: 100vw;
            margin-left: 64px;
        }

        .filter {
            border: 2px solid black;
            border-radius: 25px;
            width: 25vw;
            height: 97vh;
            padding: 15px;
            margin-right: 5px;
        }

        .result {
            border: 2px solid black;
            border-radius: 25px;
            width: 100vw;
            height: 97vh;
            padding: 5px;
            display: flex;
            flex-wrap: wrap;
            overflow-y: auto;
        }

        .car {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            width: 288px;
            height: 377px;
            border: 2px solid black;
            padding: 5px;
            margin-left: 33px;
            margin-top: 30px;
            border-radius: 2%;
            background: linear-gradient(to bottom, #f0f9ff 0%, #cbebff 47%, #a1dbff 100%);
            box-shadow: 3px 2px 16px 4px #d8c8d1;
        }

        .car img {
            width: 205px;
            height: 174px;
        }

        .info {
            background-color: rgba(214, 233, 249, 0.5);
        }

        .info h5 {
            font-weight: bolder;
            font-size: medium;
            margin-bottom: 6px;
        }

        .info span {
            margin: 8px;
            color: grey;
        }

        .info h4 {
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
            font-size: 20px;
            margin-top: 10px;
            font-style: oblique;
            color: rgb(190, 132, 242);
        }

        .info ul {
            margin-left: -26px;
            margin-top: 10px;
        }

        .info a {
            color: orange;
        }

        .car ul {
            display: flex;
        }

        .info strong {
            font-size: 25px;
        }

        .info strike {
            font-size: 15px;
            color: grey;
        }

        .info button {
            border-radius: 6px;
            margin-left: 40px;
            padding: 4px;
        }

        .car ul li {
            font-size: largepx;
            color: grey;
            list-style: none;
            border: 1px solid grey;
            margin-right: 10px;
            border-radius: 5px;
            background-color: azure;
            padding: 1px;
        }
    </style>
    <script>
        $(document).ready(function() {
           /* http://localhost/carvila/carlisting.php?year=2021&make=Audi&model=A3&carstyle=Sudan&condition=Better&price=Below_1_lack*/
            console.log("ready!");
            var qs = window.location.search; //         it will give from ?year=2021 to 1_Lack
            var params = new URLSearchParams(qs);//         it will give from year=2021 to 1_Lack
            var fdata = {};

            if (!params.has("filter")) {
                
                fdata = {
                    "userid": "admin",
                    "pass1": "admin",
                    "RESULT_TYPE": "GET_CAR_INFO",
                    "YEAR": params.get("year"),
                    "MAKE": params.get("make"),
                    "MODEL": params.get("model"),
                    "STYLE": params.get("carstyle"),
                    "CONDITION": params.get("condition"),
                    "PRICE": params.get("price")
                }
            } else {
                fdata = {
                    "RESULT_TYPE": "GET_CARS_INFO",
                    "CATEGORY": params.get("filter".split("-")[0]),
                    "FILTER": params.get("filter").split("-")[1]

                }
            }

            $.ajax({
                url: "functions.php",
                type: "POST",
                data: fdata,
                success: function(res) {
                    console.log(res);
                    var jobj = JSON.parse(res);
                    resutlcar(jobj);
                    

                }
            });

        });
    </script>
</head>

<body style="background-color:#fcf8f8">


    <div class="container">
        <div class="filter" id="jsfilter">
            <div><br>
                <img src="img/price.png" alt="" width="25px" class="img-thumbnail"><span
                    style="font-size: 20px; font-weight: bold;">Budget</span>
            </div>
            <div><br>
                <span class="btn btn-light" style="margin: 4px;">₹100000</span>
                <span class="btn btn-light" style="margin-left: 44px;" id="maxPrice">₹2000000</span>
                <input type="range" id="priceRange" min="100000" max="2000000"onchange="rangeChange();">
            </div>
            <div> <br><span style="color: #7e8594;;">Suggestion</span><br>
                <button class="btn btn-outline-secondary">Under 3 lack</button><button
                    class="btn btn-outline-secondary">From 3 lack to 5 lack</button><button
                    class="btn btn-outline-secondary">from 5 lack to 10 lack</button><button
                    class="btn btn-outline-secondary">Above 10 lack</button>
            </div><br><br>
            <div>
                <img src="img/brand.png" alt="" width="25px"><span style="font-size: 20px; font-weight: bold;">Make and
                    Model</span><br><br>
                <input type="text" placeholder="Search a Model here"><br><br>
            </div>
            <div id="jsch">

            </div>
        </div>
        <div class="result" id="resultjs">
            




        </div>
    </div>
    <script>

        function applyFilter(maxprice){
            $.ajax({
                url: "functions.php",
                type: "POST",
                data: {
                    "RESULT_TYPE": "APPLY_FILTER",
                    "MAXPRICE":maxprice
                },
                success: function(res) {
                    console.log(res);
                    var jobj=JSON.parse(res);
                    resultjs.innerHTML="";

                    resutlcar(jobj);
                    
                }
            });
        }

        priceRange.addEventListener("input", function() {
            maxPrice.innerHTML = "₹"+priceRange.value;
            
        });
        function rangeChange(){
            console.log(priceRange.value);
            applyFilter(priceRange.value);
        }

        createModelFilter();

        function createModelFilter() {

            $.ajax({
                url: "functions.php",
                type: "POST",
                data: {
                    "RESULT_TYPE": "GET_MODEL_FILTER"
                },
                success: function(res) {
                    console.log(res);
                    var jobj = JSON.parse(res);


                    var modelsarr = jobj;

                    for (i = 0; i < modelsarr.length; i++) {

                        var inp = document.createElement("input");
                        inp.type = "checkbox";
                        jsch.appendChild(inp);

                        var sp = document.createElement("span");
                        sp.innerHTML = `${modelsarr[i]} (${i})`
                        jsch.appendChild(sp);

                        var br1 = document.createElement("br");
                        jsch.appendChild(br1);
                    }
                }
            });
        }

        function redirectToCarInfo() {
            // console.log(this.id); to view id value in console
            window.location.href = "info.php?carid=" + this.id
        }

        function resutlcar(varrsarr) {
             
            console.log(varrsarr.car);
            for (i = 0; i < varrsarr.length; i++) {
                var carfromobj = varrsarr[i];

                var cari = document.createElement("div");
                cari.classList.add("car");
                cari.addEventListener("click", redirectToCarInfo);
                cari.id = carfromobj.id

                var img1 = document.createElement("img");
                img1.src = carfromobj.image;
                cari.appendChild(img1);

                var infodiv = document.createElement("div");
                infodiv.classList.add("info");
                cari.appendChild(infodiv);
                var h5infodiv = document.createElement("h5");
                h5infodiv.innerHTML = carfromobj.make;
                infodiv.appendChild(h5infodiv);

                var ulinfodiv = document.createElement("ul");
                infodiv.appendChild(ulinfodiv);
                var li1ulinfodiv = document.createElement("li");
                li1ulinfodiv.innerHTML = carfromobj.fuleType;
                ulinfodiv.appendChild(li1ulinfodiv);
                var li2ulinfodiv = document.createElement("li");
                li2ulinfodiv.innerHTML = carfromobj.bodyMaterial;
                ulinfodiv.appendChild(li2ulinfodiv);
                var li3ulinfodiv = document.createElement("li");
                li3ulinfodiv.innerHTML = carfromobj.distanceTravled + "KMS";
                ulinfodiv.appendChild(li3ulinfodiv);
                var ainfodiv = document.createElement("a");
                ainfodiv.innerHTML = `EMI ₹${carfromobj.emiPrice} /Month`;
                ainfodiv.href = "#";
                infodiv.appendChild(ainfodiv);
                var br1infodiv = document.createElement("br");
                infodiv.appendChild(br1infodiv);
                var stronginfodiv = document.createElement("strong");
                stronginfodiv.innerHTML = `₹${carfromobj.discountedPrice}`;
                infodiv.appendChild(stronginfodiv);
                var strikeinfodiv = document.createElement("strike");
                strikeinfodiv.innerHTML = `₹${carfromobj.originalPrice}`;
                infodiv.appendChild(strikeinfodiv);
                var br2infodiv = document.createElement("br");
                infodiv.appendChild(br2infodiv);
                var br3infodiv = document.createElement("br");
                infodiv.appendChild(br3infodiv);
                var buttoninfodiv = document.createElement("button");
                buttoninfodiv.innerHTML = carfromobj.btnContaint;
                infodiv.appendChild(buttoninfodiv);

                resultjs.appendChild(cari);
                console.log(cari);
            }
        }
    </script>
    <?php
    include_once("Layouts/footer.php")
    ?>
</body>

</html>