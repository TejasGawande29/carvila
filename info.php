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

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <style>
        .container {

            display: grid;
            grid-template-columns: 60%;
            grid-template-rows: 80% 10%;
        }

        .smi {
            margin-left: 13px;
        }

        .image img {
            position: relative;
            top: 58px;
            left: 17px;
            border-radius: 15%;
            border: 3px solid grey;
            width: 80%;
            box-shadow: -5px 5px 41px 13px #9f9f9f;
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
            margin-top: 12px;

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

            var qs = window.location.search;
            var params = new URLSearchParams(qs);
            //For Car Discription
            $.ajax({
                url: "functions.php",
                type: "POST",
                data: {
                    "RESULT_TYPE": "GET_CAR_INFO",
                    "CARID": params.get("carid")
                },
                success: function(res) {

                    var jobj = JSON.parse(res);
                    console.log(jobj);
                    console.log("for car description");
                    carIntrod(jobj);
                }
            });
            //For Image Gallery
            $.ajax({
                url: "functions.php",
                type: "POST",
                data: {
                    "RESULT_TYPE": "GET_CARIMAGE_GALLERY",
                    "CARID": params.get("carid")
                },
                success: function(res) {

                    var jobj = JSON.parse(res);
                    console.log(jobj);
                    console.log("imageGallery")


                    // Image Gallery
                    var d1 = document.getElementById('jsimage');
                    var mainImage = document.getElementById('mainImage');
                    mainImage.src = "img/" + jobj[0];

                    // Create image thumbnails
                    createThumbnail(jobj[0]);
                    createThumbnail(jobj[1]);
                    createThumbnail(jobj[2]);
                    createThumbnail(jobj[3]);
                }

            });
        });

        function carIntrod(cobj) {
            console.log(cobj.location);
            console.log("Tejas");



            carName.innerHTML = `${cobj.name} ${cobj.model}`;
            kmDriven.innerHTML = `${cobj.kms} KM`;
            owner.innerHTML = `${cobj.owner}`;
            fuelT.innerHTML = `${cobj.fuelType}`;
            gear.innerHTML = `${cobj.transmission}`;
            lct.innerHTML = `${cobj.location}`;
            emi.innerHTML = `₹${cobj.emi}/month`;
            discount.innerHTML = `44%`;
            originalPrice.innerHTML = `₹${cobj.price}`;
            discountedPrice.innerHTML = `₹${cobj.discountedPrice}`;
            otherCharges.innerHTML = `₹${cobj.otherCharges}`;
            speacialfeatures.innerHTML = `${cobj.ssf}`
            regYear.innerHTML = `${cobj.regYear}`;
            makeYear.innerHTML = `${cobj.makeYear}`;
            regNumber.innerHTML = `${cobj.regNo}`;
            transmission.innerHTML = `${cobj.transmission}`;
            engineCapacity.innerHTML = `${cobj.engine} CC`;
            insurance.innerHTML = `${cobj.insurance} Rs/Month`;
            spkey.innerHTML = `${cobj.spareKey}`;
            kms.innerHTML = `${cobj.kms} KMS`;
            ownership.innerHTML = `${cobj.owner}`;
            fuelType.innerHTML = `${cobj.fuelType}`;
        }

        // Function to create image thumbnails
        function createThumbnail(src) {
            var sp = document.createElement("span");
            var img = document.createElement("img");
            img.src = "img/" + src;
            img.style.width = "142px"
            img.style.height = "140px"
            img.style.borderRadius = "18%"
            img.style.marginTop = "40px"
            img.style.border = "2px solid grey"
            sp.style.marginLeft = "13px"
            img.addEventListener("click", function() {
                mainImage.src = "img/" + src;
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
            <div class="d"><i class="fa-solid fa-location-dot"><span id="lct">-</span></i> </div>
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

    <h2 style="margin-top: 113px; margin-left: 337px; margin-bottom: 33px;">Known Your Car</h2>
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
                <p class="para" id="speacialfeatures">Top variant that is equipped with all features of the model</p>
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
                <p class="para"><strong id="spkey">-</strong></p>
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
                            <button style="border-radius: 10px; color:white; background-color: orange; width: 300px; height:40px ;" onclick="showOtpBox();" id="btnOtp"><b>GET OTP</b></button><br>

                            <div class="d-none mb-4" style="height:40px;" id="otpBox">
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

    <!-- success Modal -->
    <div
        class="modal fade"
        id="successModal"
        tabindex="-1"
        role="dialog"
        aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="width: 800px; margin-left: -100px">
                <div class="container" style= "height:55vh; justify-content:center; align-items: center;">

                    <div class="row">
                        <div class="col">
                            <img src="img/success.gif" alt="" width="300vh" height="200vh" style="margin-top: 20px; margin-left: 20px;border-radius: 20px;">
                        </div>
                    </div>
                    <div class="row" style="margin-top: -81px;">
                        <div class="col" style="margin:0px 0px; padding:0px 0px;">
                            <h4 style="color:green; margin:0px 0px">Test Drive Booking Successfull..</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col" style="margin:0px 0px; padding:0px 0px;">
                            <button class="btn btn-outline-success">Proceed to Schedule An Appointment.</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</body>
<script>
    var otp = "";
    var timer = 60;

    function verifyOtp() {
        var qs = window.location.search;
        var params = new URLSearchParams(qs)
        var carid = params.get("carid")


        $.ajax({
            url: "functions.php",
            type: "POST",
            data: {
                "RESULT_TYPE": "VERIFY_OTP",
                "MOBILENO": mobileno.value,
                "OTP": userotp.value,
                "CARID": carid
            },
            success: function(res) {
                console.log(res);
                var jobj = JSON.parse(res)

                if (jobj.status == 1) {
                    // 
                    exampleModal.style.display = "none";
                    successModal.style.display = "block";
                    successModal.classList.add("show");
                    successModal.setAttribute("aria-hidden", "false");
                    successModal.setAttribute("aria-modal", "true");
                    // successModal.classList.add("modal-backdrop", "fade", "show");
                    document.body.classList.add("modal-open");
                    document.body.style.overflow = "hidden";
                    document.body.appendChild(successModal);
                    // successModal.classList.add("show")


                } else {
                    toastr.error(jobj.message);

                }

            }
        });

    }



    function showOtpBox() {

        console.log(mobileno.value);

        var regex = /^(?:(?:\+|0{0,2})91(\s*[\-]\s*)?|[0]?)?[789]\d{9}$/
        var validMobile = regex.test(mobileno.value)
        if (!validMobile) {
            toastr.error("Invalid Mobile Number")
            return;
        }

        $.ajax({
            url: "functions.php",
            type: "POST",
            data: {
                "RESULT_TYPE": "GET_OTP",
                "MOBILENO": mobileno.value
            },
            success: function(res) {
                btnOtp.style.backgroundColor = "grey";
                btnOtp.disabled = true
                console.log(res)

                var jobj = JSON.parse(res)
                if (jobj.status == 1) {
                    otp = jobj.otp
                    otpBox.classList.remove("d-none")
                    toastr.success("OTP Send success")

                    btnOtp.disabled = true
                    otpTimer = setInterval(() => {
                        if (timer == 0) {
                            btnOtp.disabled = false
                            btnOtp.style.backgroundColor = "orange";
                            timer = 60;
                            clearInterval(otpTimer)
                            btnOtp.innerHTML = "Resend OTP"
                        } else {

                            btnOtp.innerHTML = "Resend in " + timer + " sec"
                            timer--;
                        }
                    }, 1000);

                } else {
                    toastr.error(jobj.error)
                }

            }
        });

    }
</script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</html>