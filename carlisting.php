<?php
include_once("Layouts/header.php");
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
            margin-bottom: 16.68%;

        }

        .filter {
            border: 2px solid black;
            border-radius: 25px;
            width: 25vw;
            height: 135vh;
            padding: 15px;
            margin-right: 5px;
        }

        .result {
            border: 2px solid black;
            border-radius: 25px;
            width: 100vw;
            height: 135vh;
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
            margin-top: 12px;
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
            margin-left: 19px;
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

            var qs = window.location.search; //         it will give from ?year=2021 to 1_Lack
            var params = new URLSearchParams(qs); //         This converts the query string into an object so you can easily get values like: it will give from year=2021 to 1_Lack
            var fdata = {};
            console.log(params.get("carid"));


            if (!params.has("filter")) {

                fdata = {

                    "RESULT_TYPE": "GET_CARS_FROM_CARID",
                    "CARID": params.get("carid")
                }
            } else {
                fdata = {
                    "RESULT_TYPE": "GET_CARS_FROM_FILTER",
                    "FILTER": params.get("filter")
                }
            }

            $.ajax({
                url: "functions.php",
                type: "POST",
                data: fdata,
                /*{
                                               "RESULT_TYPE": "GET_CARS_FROM_CARID",
                                               "CARID": params.get("carid")
                                               },*/
                success: function(res) {
                    console.log("filter res");
                    var jobj = JSON.parse(res);
                    console.log(jobj);
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
                <input type="range" id="priceRange" min="100000" max="10000000" onchange="applyFilter(this);">
            </div>
            <div> <br><span style="color: #7e8594;;">Suggestion</span><br>
                <button  id="0-3" class="btn btn-outline-secondary" type="button" onclick="applyFilter(this)" id>Under 3 lack</button>
                <button id="3-5"  class="btn btn-outline-secondary" type="button" onclick="applyFilter(this)">From 3 lack to 5 lack</button>
                <button id="5-10"   class="btn btn-outline-secondary" type="button" onclick="applyFilter(this)">from 5 lack to 10 lack</button>
                <button id="10-100"  class="btn btn-outline-secondary" type="button" onclick="applyFilter(this)">Above 10 lack</button>
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
        var makes =[""];
        var maxprice=10000000;
        var pricerange="0-0";
        function applyFilter(ele) {
            console.log(ele.value);
            
            switch(ele.type){
                case "click":
                    
                    if(makes.includes(this.id)){
                        const index = makes.indexOf(this.id);
                        makes.splice(index,1);
                    }else{
                        makes.push(this.id)
                        
                    }
                break;  

                case "range":
                    maxprice=ele.value;
                    pricerange="0-0";
                break;  
                case "button":
                     pricerange=ele.id;
                     maxprice=0;
                break;  
                
            }
          
            $.ajax({
                url: "functions.php",
                type: "POST",
                data: {
                    "RESULT_TYPE": "APPLY_FILTER",
                    "MAXPRICE": maxprice,
                    "MAKES":makes,
                    "PRICERANGE":pricerange
                },
                success: function(res) {

                    var jobj = JSON.parse(res);
                    console.log(jobj);
                    console.log("applyfilter");
                    resultjs.innerHTML = "";

                    resutlcar(jobj);

                }
            });
        }

        priceRange.addEventListener("input", function() {
            maxPrice.innerHTML = "₹" + priceRange.value;

        });
       

        createModelFilter();

        function createModelFilter() {

            $.ajax({
                url: "functions.php",
                type: "POST",
                data: {
                    "RESULT_TYPE": "GET_MODEL_FILTER"
                },
                success: function(res) {

                    var jobj = JSON.parse(res);


                    var modelsarr = jobj;
                    console.log(modelsarr);
                    console.log("modelsarr");
                    for (i = 0; i < modelsarr.length; i++) {

                        var inp = document.createElement("input");
                        inp.type = "checkbox";
                        inp.id = `${modelsarr[i].make}`;
                        inp.addEventListener("click",applyFilter)
                        jsch.appendChild(inp);

                        var sp = document.createElement("span");
                        sp.innerHTML = `${modelsarr[i].make} (${modelsarr[i].makecount})`
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

            for (let i = 0; i < varrsarr.length; i++) {
                var carfromobj = varrsarr[i];
                // console.log(carfromobj);


                var cari = document.createElement("div");
                cari.classList.add("car");
                cari.addEventListener("click", redirectToCarInfo);
                cari.id = carfromobj.id

                var img1 = document.createElement("img");
                img1.src = "img/" + carfromobj.image;
                cari.appendChild(img1);

                var infodiv = document.createElement("div");
                infodiv.classList.add("info");
                cari.appendChild(infodiv);
                var h5infodiv = document.createElement("h5");
                h5infodiv.innerHTML = carfromobj.name+"-"+carfromobj.makeYear;
                infodiv.appendChild(h5infodiv);

                var ulinfodiv = document.createElement("ul");
                infodiv.appendChild(ulinfodiv);
                var li1ulinfodiv = document.createElement("li");
                li1ulinfodiv.innerHTML = carfromobj.fuelType;
                ulinfodiv.appendChild(li1ulinfodiv);
                var li2ulinfodiv = document.createElement("li");
                li2ulinfodiv.innerHTML = carfromobj.owner;
                ulinfodiv.appendChild(li2ulinfodiv);
                var li3ulinfodiv = document.createElement("li");
                li3ulinfodiv.innerHTML = carfromobj.kms + "KMS";
                ulinfodiv.appendChild(li3ulinfodiv);
                var ainfodiv = document.createElement("a");
                ainfodiv.innerHTML = `EMI ₹${carfromobj.emi} /Month`;
                ainfodiv.href = "#";
                infodiv.appendChild(ainfodiv);
                var br1infodiv = document.createElement("br");
                infodiv.appendChild(br1infodiv);
                var stronginfodiv = document.createElement("strong");
                stronginfodiv.innerHTML = `₹${carfromobj.discountedPrice}`;
                infodiv.appendChild(stronginfodiv);
                var strikeinfodiv = document.createElement("strike");
                strikeinfodiv.innerHTML = `₹${carfromobj.price}`;
                infodiv.appendChild(strikeinfodiv);
                var br2infodiv = document.createElement("br");
                infodiv.appendChild(br2infodiv);
                var br3infodiv = document.createElement("br");
                infodiv.appendChild(br3infodiv);
                var buttoninfodiv = document.createElement("button");
                buttoninfodiv.innerHTML = "Book Your Free Test Drive!";
                infodiv.appendChild(buttoninfodiv);

                resultjs.appendChild(cari);
                // console.log(cari);
            }
        }
    </script>
    <?php
    include_once("Layouts/footer.php")
    ?>
</body>

</html>