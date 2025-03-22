<?php
include_once("Layouts/header.php")
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Info</title>
    <link rel="stylesheet" href="CSS/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <style>
        .container {
            
            display: grid;
            grid-template-columns: 60%;
            grid-template-rows: 80% 10%;
        }

        .image img {
            position: relative;
            top: 12px;
            left: 17px;
            border-radius: 4%;
            width: 93%;
        }

        .dsc {
            border: 4px solid brown;
            background-color: rgb(234, 244, 246);
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            padding: 15px;
            width: 35vw;
            border-radius: 24px;
            position: fixed;
            top: 12px;
            right: 12px;
            margin-top: 8%;
        }

        body {
            height: 200vh;
        }

        .sm span img {
            width: 147px;
            height: 109px;
            border: 4px solid brown;
            border-radius: 12px;
            margin: 8px 4px;
            box-shadow: 7px 18px 53px 8px #edd0d0;
        }

        .dsc h3 {
            font-size: 34px;
        }

        .dsc ul {
            display: flex;
            margin-left: -32px;
        }

        .dsc ul li {
            list-style: none;
            background-color: rgb(233, 233, 233);
            padding: 4px 10px;
            margin: 2px 21px;
            border-radius: 11px;
        }

        .dsc span {
            border-radius: 12px;
            margin-left: 10px;
            font-size: 16px;
        }

        .sd {
            display: grid;
            grid-template-columns: 50% 50%;
        }

        .d {
            margin-top: 20px;
        }

        .top {
            padding-left: 25px;
            background: url('img/');
        }

        .icon {
            padding-left: 25px;
            background: url("https://static.thenounproject.com/png/101791-200.png") no-repeat left;
            background-size: 20px;
        }

        .des {
            display: flex;
        }

        .des div img {
            width: 300px;
            height: 300px;
        }

        .container-fluid {

            border: 2px solid brown;
            width: 52%;
            margin-left: 91px;
            border-radius: 10px;

        }

        .col i {
            position: relative;
        }

        .para {
            text-align: center;
        }

        .col {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 13px 72px;
        }

        .sideImage {
            border: 2px solid red;

        }
    </style>


    <script>
        $(document).ready(function() {
            console.log("ready!");
            $.ajax({
                url: "functions.php",
                type: "POST",
                data: {
                    "userid": "admin",
                    "pass1": "admin",
                    "RESULT_TYPE": "GET_CAR_INFO"
                },
                success: function(res) {
                    var jobj = JSON.parse(res);
                    carIntrod(jobj);
                }
            });
        });


        function carIntrod(cobj) {
            var cobjcigArr = cobj.carIntro;
            console.log("Hiii", cobjcigArr);
            

            // Image Gallery
            var d1 = document.getElementById('jsimage');
            var mainImage = document.getElementById('mainImage');
            mainImage.src = cobjcigArr.mainImage;

            // Create image thumbnails
            createThumbnail(d1, cobjcigArr.i2);
            createThumbnail(d1, cobjcigArr.i3);
            createThumbnail(d1, cobjcigArr.i4);
            createThumbnail(d1, cobjcigArr.i5);
console.log(cobj.car.kmDriven);
            // Insert car description and details dynamically
            document.getElementById('carName').textContent = `${cobj.car.name} ${cobj.car.model}`;
            document.getElementById('kmDriven').textContent = `${cobj.car.kmDriven} KM`;
            document.getElementById('owner').textContent = `${cobj.car.owner}`;
            document.getElementById('fuelT').textContent = `${cobj.car.fuelType}`;
            document.getElementById('gear').textContent = `${cobj.car.gear}`;
            document.getElementById('location').textContent = `${cobj.car.lct}`;
            document.getElementById('emi').textContent = `₹${cobj.car.emi}/month`;
            document.getElementById('discount').textContent = `${cobj.car.discount}%`;
            document.getElementById('originalPrice').textContent = `₹${cobj.car.orgPrice}`;
            document.getElementById('discountedPrice').textContent = `₹${cobj.car.dscPrice}`;
            document.getElementById('otherCharges').textContent = `₹${cobj.car.otrCharges}`;
            document.getElementById('regYear').textContent = `${cobj.car.regYear}`;
            document.getElementById('makeYear').textContent = `${cobj.car.makeyear}`;
            document.getElementById('regNumber').textContent = `${cobj.car.regNumber}`;
            document.getElementById('transmission').textContent = `${cobj.car.transmission}`;
            document.getElementById('engineCapacity').textContent = `${cobj.car.engineCapacity} CC`;
            document.getElementById('insurance').textContent = `${cobj.car.insurance}`;
            document.getElementById('spareKey').textContent = `${cobj.car.spareKey}`;
            kms.innerHTML=`${cobj.car.kmDriven}`;
            ownership.innerHTML=`${cobj.car.owner}`;
            fuelType.innerHTML=`${cobj.car.fuelType}`
        }

        // Function to create image thumbnails
        function createThumbnail(d1, src) {
            var sp = document.createElement("span");

            var img = document.createElement("img");
            img.src = src;
            img.style.width = "150px"
            img.style.height = "150px"
            img.style.borderRadius="9%"
            img.addEventListener("click", function() {
                document.getElementById('mainImage').src = src;
            });
            sp.appendChild(img);
            smallimages.appendChild(sp);
        }
    </script>

</head>

<body>

    <div class="container">
        <!-- *******Image******* -->
        <div class="image" id="jsimage">
            <img id="mainImage" src="" alt="Car Image">
        </div>
        <div id="smallimages" style="display: flex; flex-wrap: wrap;">

        </div>
        <div class="dsc" id="jsdsc">
            <h3 id="carName">
                2018 Maruti Baleno ZETA PETROL 1.2
            </h3>
            <ul>
                <li id="kmDriven">-</li>
                <li id="owner">-</li>
                <li id="fuelT">-</li>
                <li id="gear">-</li>
            </ul>
            <div class="d"><i class="fa-solid fa-location-dot"><span id="location">-</span></i> </div>
            <div class="d"><i class="fa-solid fa-table-list"></i> View Inspection Report</div>
            <div class="d"><i class="fa-solid fa-eye"></i> View Service History Report</div>
            <br>
            <hr>
            <h2 style="display: inline-block;" id="emi">-</h2><span
                style="background-color: green; border-radius: 12px; padding: 4px 10px; margin-left: 68px; color: white;"
                id="discount">-</span><span><strike style="margin-left: 22px;" id="originalPrice">-</strike> <span
                    id="discountedPrice">-</span></span>
            <div class="sd">
                <p style="color: grey;">On Zero Down Paymentk</p>
                <p style="color: grey;">+other charges:<span id="otherCharges">-</span></p>
                <p style="color: blue; font-weight: bold; margin-top: 6px;">CHECK ELIGIBILITY</p>
                <p style="color: blue; font-weight: bold; margin-top: 6px;">CHECK PRICE BREAKUP</p>
            </div><BR></BR>
            <button data-bs-toggle="modal" data-bs-target="#exampleModal"
                style="background-color: green; color: white; font-size: 21px; padding: 8px 49px; margin: 2px 87px; border-radius: 10px;">BOOK
                FREE TEST DRIVE</button>
        </div>
    </div>

    <h2 style="margin-top: 88px; margin-bottom: 48px; margin-left: 102px; margin-right: 12px;">Known Your Car</h2>
    <div class="container-fluid" id="confluid">
        <div class="row">
            <div class="col">
                <img src="img/special_reg_number.webp" alt="" width="70px" height="60px">
                <span><strong>Fancy Registration Number</strong></span>
                <p class="para">Make your car standout with 3000</p>
            </div>
            <div class="col">
                <img src="img/top_model.webp" alt="" width="70px" height="60px">
                <span><strong>Top Model</strong></span>
                <p class="para">Top variant that is equipped with all features of the model</p>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <img src="img/sunroof_car.webp" alt="" width="70px" height="60px">
                <span><strong>Sunroof</strong></span>
                <p>Experience the open skies with an elegantly designed sunroof</p>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <i class="fa-solid fa-calendar fa-fade"></i>
                <span>Reg year</span>
                <p class="para"><strong id="regYear">-</strong></p>
            </div>
            <div class="col">
                <i class="fa-solid fa-building"></i>
                <span>Make year</span>
                <p class="para"><strong id="makeYear">-</strong></p>
            </div>
            <div class="col">
                <i class="fa-solid fa-road"></i>
                <span>Reg Number</span>
                <p class="para"><strong id="regNumber">-</strong></p>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <i class="fa-solid fa-gears"></i>
                <span>Transmission</span>
                <p class="para"><strong id="transmission">-</strong></p>
            </div>
            <div class="col">
                <i class="fa-solid fa-bolt"></i>
                <span>Engine capacity</span>
                <p class="para"><strong id="engineCapacity">-</strong></p>
            </div>
            <div class="col">
                <i class="fa-solid fa-shield-halved"></i>
                <span>Insurance</span>
                <p class="para"><strong id="insurance">Plans starting from ₹2,474/year</strong></p>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <i class="fa-solid fa-key"></i>
                <span>Spare key</span>
                <p class="para"><strong id="spareKey">-</strong></p>
            </div>
            <div class="col">
                <i class="fa-solid fa-gauge"></i>
                <span id="">KM Driven</span>
                <p class="para"><strong id="kms">-</strong></p>
            </div>
            <div class="col">
                <i class="fa-solid fa-user-secret"></i>
                <span>Ownership</span>
                <p class="para"><strong id="ownership">-</strong></p>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <i class="fa-solid fa-gas-pump"></i>
                <span>Fuel type</span>
                <p class="para"><strong id="fuelType">-</strong></p>
            </div>
        </div>
    </div>

    <div
        class="modal fade"
        id="exampleModal"
        tabindex="-1"
        role="dialog"
        aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="width: 800px; margin-left: -100px">
                <div class="container">
                    <div class="row">
                        <div
                            class="col-6"
                            style="background-image: url('img/bgl.webp')"></div>
                        <div class="col-6 p-4">
                            <p>
                                <b> Log in</b> to <br />
                                conveniently book a test drive
                            </p>
                            <p>Mobile number</p>
                            <input
                                type="text"
                                class="form-control w-75"
                                placeholder="999 999 9999"
                                value=""
                                id="mobileno" />
                            <p class="mt-4">
                                <i class="fa-brands fa-whatsapp"></i>
                                <b>Get instant updates</b> from CARS24 on your
                                <b>WhatsApp</b>

                            </p>
                            <button style="border-radius: 10px; color:white; background-color: orange; width: 300px; height:40px ;" onclick="showOtpBox();" id="otpbtn"><b>GET OTP</b></button><br>

                            <div class=" mb-4" style="height:40px; display: none;" id="otpBox">
                                <span style="font-size: 15px;">Generate new otp After:</span>
                                <span id="time" style="font-size: 17px; ">60</span>
                                <input type="number" class="from-control w-50" style="border-radius: 5px;" id="userotp" value="">
                                <button style=" background-color:green; border-radius: 10px; margin-left:62px" onclick="verifyOtp();" id="verifyOtpbtn">Verify OTP</button>
                            </div>
                            <div class="text-black-50 mt-4" style="font-size: small">
                                <p style="margin-top: 52px; margin-bottom: 2px; ">By logging in, you agree to CARS24's</p>
                                <ul>
                                    <li>
                                        CARS24’s Privacy Privacy Policy and Terms & Conditions
                                    </li>
                                    <li>
                                        CARS24 NBFC’s Terms of Use and TU CIBIL Terms of Use
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    var backendotp="";
    let timer;
    let timeLeft = 60;


        
    function showOtpBox() {
        $.ajax({
                url: "functions.php",
                type: "POST",
                data: {
                    "RESULT_TYPE": "GET_OTP",
                },
                success: function(res) {
                    var jobj = JSON.parse(res);
                    backendotp=jobj.otp;
                    console.log(jobj.otp);
                    
                }
            });

        otpBox.style.display = "block";
        changeGetOtpbtn();

        function changeGetOtpbtn() {
            otpbtn.disabled = true;
            otpbtn.style.backgroundColor = "grey";

            timer = setInterval(function() {
                timeLeft--;
                time.innerHTML = timeLeft;

                if (timeLeft <= 0) {
                    clearInterval(timer);
                    otpbtn.disabled = false;
                    otpbtn.innerHTML = "Resend OTP";
                    otpbtn.style.backgroundColor = "orange";
                    time.innerHTML = "60";
                    timeLeft = 60;
                    timer;
                }
            }, 1000);
            
        }
    }
    function verifyOtp(){
            if(userotp.value==backendotp){
                // verifyOtpbtn.innerHTML="Verified....!";
                // verifyOtpbtn.style.backgroundColor="greenYellow";
                toastr.success("Valid OTP!")
                otpBox.style.display="none";
                otpbtn.innerHTML="Verification successful...!";
                otpbtn.style.backgroundColor="green";
                
            }else{
                // verifyOtpbtn.innerHTML="Invalid OTP...!";
                // verifyOtpbtn.style.backgroundColor="red";
                toastr.error("Invalid OTP!")
            }
        }

</script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>


</html>