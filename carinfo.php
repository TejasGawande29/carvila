<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>
  <link rel="stylesheet" href="css/bootstrap.min.css" />
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
    integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
    crossorigin="anonymous"
    referrerpolicy="no-referrer" />
  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>

  <script src="js/jquery-3.7.1.min.js"></script>
  <script>
    $(document).ready(function() {
      console.log("ready!");

      $.ajax({
        url: "functions.php",
        type: "POST",
        data: {
          "RESULT_TYPE": "GET_CAR_INFO"
        },
        success: function(res) {
          console.log(res)
          var jobj = JSON.parse(res)
          showCarInfo(jobj);
        }
      });

    });
  </script>


  <style>
    .smallCar {
      width: 175px;
      height: 100px;
      margin: 10px;
    }

    .mainCar {
      width: 50%;
      height: 25%;
      margin: 10px;
    }

    .spanclass {
      font-size: medium;
      padding: 8px;
      margin: 5px;
      border: 1px solid grey;
      border-radius: 10px;
      font-weight: bold;
      background-color: rgb(245, 245, 245);
      text-transform: uppercase;
    }

    .offclass {
      padding: 6px;
      margin: 5px;
      color: green;
      border-radius: 5px;
      background-color: rgb(186, 246, 186);
      font-weight: bold;
    }

    .bg-round {
      background-color: rgb(243, 243, 243);
    }
  </style>
</head>

<body>
  <?php
  include_once("layouts/header.php");
  ?>


  <div class="d-flex">
    <div style="width: 60%; text-align: center;">
      <img src="" alt="Car Main Image" class="rounded m-2 mainCar" id="mainImage" />
      <div class="d-flex mb-4" id="smallImages" style="flex-wrap: wrap;">
      </div>

      <h3 class="m-4">Know your car</h3>
      <div class="rounded-4 p-2 m-4 border">
        <div class="d-flex">
          <div class="text-center">
            <div class="d-inline-block rounded bg-round m-2 p-3">
              <i class="fa-solid fa-bowling-ball"></i>
            </div>
            <div class="d-inline-block m-2 p-2">
              <h6>Alloy wheels</h6>
              <p class="text-black-50 text-sm-center" id="alloyWheels">-</p>
            </div>
          </div>

          <div class="text-center">
            <div class="d-inline-block rounded bg-round m-2 p-3">
              <i class="fa-solid fa-wheelchair"></i>
            </div>
            <div class="d-inline-block m-2 p-2">
              <h6>Standard safety features</h6>
              <p class="text-black-50 text-sm-center" id="ssf">-</p>
            </div>
          </div>

          <div class="text-center">
            <div class="d-inline-block rounded bg-round m-2 p-3">
              <i class="fa-solid fa-city"></i>
            </div>
            <div class="d-inline-block m-2 p-2">
              <h6>City Driven</h6>
              <p class="text-black-50 text-sm-center" id="cityDriven">-</p>
            </div>
          </div>
        </div>

        <div class="d-flex">
          <div class="text-center m-4">
            <div class="d-inline-block rounded bg-round m-2 p-3">
              <i class="fa-solid fa-calendar"></i>
            </div>
            <div class="d-inline-block m-2 p-2">
              <p class="text-black-50 text-sm-center">Reg Year</p>
              <h6 id="regYear">-</h6>
            </div>
          </div>

          <div class="text-center m-4">
            <div class="d-inline-block rounded bg-round m-2 p-3">
              <i class="fa-solid fa-city"></i>
            </div>
            <div class="d-inline-block m-2 p-2">
              <p class="text-black-50 text-sm-center">Make Year</p>
              <h6 id="makeYear">-</h6>
            </div>
          </div>

          <div class="text-center m-4">
            <div class="d-inline-block rounded bg-round m-2 p-3">
              <i class="fa-solid fa-address-card"></i>
            </div>
            <div class="d-inline-block m-2 p-2">
              <p class="text-black-50 text-sm-center">Reg number</p>
              <h6 id="regNo">-</h6>
            </div>
          </div>
        </div>

        <div class="d-flex">
          <div class="text-center m-4">
            <div class="d-inline-block rounded bg-round m-2 p-3">
              <i class="fa-solid fa-gear"></i>
            </div>
            <div class="d-inline-block m-2 p-2">
              <p class="text-black-50 text-sm-center">Transmission</p>
              <h6 id="transmission">-</h6>
            </div>
          </div>

          <div class="text-center m-4">
            <div class="d-inline-block rounded bg-round m-2 p-3">
              <i class="fa-solid fa-closed-captioning"></i>
            </div>
            <div class="d-inline-block m-2 p-2">
              <p class="text-black-50 text-sm-center">Engine</p>
              <h6 id="engine">-</h6>
            </div>
          </div>

          <div class="text-center m-4">
            <div class="d-inline-block rounded bg-round m-2 p-3">
              <i class="fa-solid fa-shield"></i>
            </div>
            <div class="d-inline-block m-2 p-2">
              <p class="text-black-50 text-sm-center">Insurance</p>
              <h6>₹<span id="insurance"> - </span>/year</h6>
            </div>
          </div>
        </div>

        <div class="d-flex">
          <div class="text-center m-4">
            <div class="d-inline-block rounded bg-round m-2 p-3">
              <i class="fa-solid fa-key"></i>
            </div>
            <div class="d-inline-block m-2 p-2">
              <p class="text-black-50 text-sm-center">Spare key</p>
              <h6 id="spareKey">-</h6>
            </div>
          </div>

          <div class="text-center m-4">
            <div class="d-inline-block rounded bg-round m-2 p-3">
              <i class="fa-solid fa-car-side"></i>
            </div>
            <div class="d-inline-block m-2 p-2">
              <p class="text-black-50 text-sm-center">KM driven</p>
              <h6 id="kms" class="kms">-</h6>
            </div>
          </div>

          <div class="text-center m-4">
            <div class="d-inline-block rounded bg-round m-2 p-3">
              <i class="fa-solid fa-user-tie"></i>
            </div>
            <div class="d-inline-block m-2 p-2">
              <p class="text-black-50 text-sm-center">Ownership</p>
              <h6 id="ownership">-</h6>
            </div>
          </div>

          <div class="text-center m-4">
            <div class="d-inline-block rounded bg-round m-2 p-3">
              <i class="fa-solid fa-gas-pump"></i>
            </div>
            <div class="d-inline-block m-2 p-2">
              <p class="text-black-50 text-sm-center">Fuel type</p>
              <h6 id="fuelType">-</h6>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div style="width: 40%">
      <div class="p-4 m-2 rounded-4 border">
        <h4 class="mb-3" id="carName"> </h4>
        <span class="spanclass kms" id="tkms">-</span>
        <span class="spanclass" id="townership">-</span>
        <span class="spanclass" id="tfuelType">-</span>
        <span class="spanclass" id="ttransmission">-</span>

        <br />
        <br />

        <p class="m-2">
          <i class="fa-solid fa-location-dot"></i>
          <span id="location">
            Parked at: Metro Walk, Rohini, New Delhi
          </span>
        </p>
        <p class="m-2">
          <i class="fa-solid fa-file"></i> View Inspection Report
        </p>
        <p class="m-2">
          <i class="fa-solid fa-clock-rotate-left"></i> View Service History
          Report
        </p>

        <hr />

        <div class="row">
          <div class="col-5">
            <h5 class="text-success">₹<span id="emi"> 9286</span> /month</h5>
            <p class="text-black-50">On Zero down payment</p>
            <p class="text-primary">CHECK ELIGIBILITY →</p>
          </div>
          <div class="col-7">
            <p>
              <span class="offclass">₹54k off</span>
              <span>
                <strike class="text-black-50" id="price">₹5.29 Lakh</strike></span>
              <span id="discountedPrice">₹4.75 Lakh</span>
            </p>
            <p class="text-black-50">
              + other charges: <span id="otherCharges"> </span>
            </p>
            <p class="text-primary">CHECK PRICE BREAKUP →</p>
          </div>
        </div>
        <button
          class="btn btn-success w-100"
          data-bs-toggle="modal"
          data-bs-target="#exampleModal">
          BOOK FREE TEST DRIVE
        </button>
      </div>
    </div>
  </div>

  <!-- Modal -->
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
              style="background-image: url('images/login-back.png')"></div>
            <div class="col-6 p-4">
              <p>
                <b> Log in</b> to <br />
                conveniently book a test drive
              </p>
              <p>Mobile number</p>
              <input
                type="text"
                class="form-control w-75"
                placeholder="999 999 9999" id="mobileno" />
              <p class="mt-4">
                <i class="fa-brands fa-whatsapp"></i>
                <b>Get instant updates</b> from CARS24 on your
                <b>WhatsApp</b>
                <input
                  type="checkbox"
                  class="form-check-input ms-3"
                  checked />
              </p>
              <button class="btn btn-success w-75" onclick="showOtpBox();">Get OTP</button>

              <div class="d-flex mt-4 d-none" style="height:40px;" id="otpBox">
                <input type="number" class="form-control w-50" id="userotp">
                <button class="btn btn-danger" style="margin-left:25px" onclick="verifyOtp();"> Verify OTP</button>
              </div>

              <div class="text-black-50 mt-4" style="font-size: small">
                <p>By logging in, you agree to CARS24's</p>
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


  <?php
  include_once("layouts/footer.php");
  ?>

</body>

<script>
  var otp = ""

  function verifyOtp() {
    if (otp == userotp.value) {
      alert("Valid OTP");
    } else {
      alert("Invalid OTP");
    }
  }

  function showOtpBox() {

    $.ajax({
      url: "functions.php",
      type: "POST",
      data: {
        "RESULT_TYPE": "GET_OTP",
        "MOBILENO": mobileno.value
      },
      success: function(res) {
        console.log(res)
        var jobj = JSON.parse(res)
        otp = jobj.otp

        otpBox.classList.remove("d-none")

      }
    });




  }

  function showCarInfo(jobj) {
    var car = jobj.car
    carName.innerHTML = `${car.makeYear} ${car.make} ${car.model} ${car.fuelType} `

    var jkeys = Object.keys(jobj.car);
    for (var i = 0; i < jkeys.length; i++) {
      var ele = document.getElementById(jkeys[i]);
      if (ele != null) {
        ele.innerHTML = jobj.car[jkeys[i]];
        switch (jkeys[i]) {
          case "price":
            ele.innerHTML = formatToLakh(jobj.car[jkeys[i]]);
            break;
          case "discountedPrice":
            ele.innerHTML = formatToLakh(jobj.car[jkeys[i]]);
            break;
          case "mainImage":
            mainImage.src = "images/" + jobj.car[jkeys[i]];
            break;
          case "kms":
            tkms.innerHTML = jobj.car[jkeys[i]] + "Kms"
            break;
          case "ownership":
            townership.innerHTML = jobj.car[jkeys[i]]
            break;
          case "fuelType":
            tfuelType.innerHTML = jobj.car[jkeys[i]]
            break;
          case "transmission":
            ttransmission.innerHTML = jobj.car[jkeys[i]]
            break;
          case "smallImages":
            ele.innerHTML = "";
            smimages = jobj.car[jkeys[i]];
            for (var j = 0; j < smimages.length; j++) {
              sm = document.createElement("img");
              sm.src = "images/" + smimages[j];
              sm.classList.add("smallCar", "rounded", "m-1")
              smallImages.appendChild(sm)
              sm.addEventListener("click", changeMainImage)
              console.log(smimages[j])
            }


        }
      }
    }

    var kkeys = Object.keys(jobj.kyc);
    for (var i = 0; i < kkeys.length; i++) {
      var ele = document.getElementById(kkeys[i]);
      if (ele != null) {
        ele.innerHTML = jobj.kyc[kkeys[i]];
        switch (kkeys[i]) {
          case "kms":
            console.log("In kms")
            tkms.innerHTML = jobj.kyc[kkeys[i]]
            break;

        }
      }
    }


  }

  //console.log(Object.keys(jobj.car))


  function formatToLakh(number) {
    if (number >= 100000) {
      return "₹ " + (number / 100000).toFixed(1) + " lakh";
    }
    return number.toString();
  }

  function changeMainImage() {
    console.log(this)
    mainImage.src = this.src
  }
</script>

</html>