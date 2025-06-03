<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/2.3.0/js/dataTables.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.0/css/dataTables.dataTables.css">

    <link rel="stylesheet" href="../css/bootstrap.min.css"></link>
    
     <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>


      <!--Toastr-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>


</head>

<body>
    <div style="display: flex;">
        <div style="width: 20%; ">
            <?php
            include_once("layouts/sidebar.php");
            ?>
        </div>
        <div style="width: 80%;">
            <table id="example" class="display" width="100%"></table>

        </div>

    </div>


  <!-- Success Modal-->
  <div
    class="modal fade"
    id="editModal"
    tabindex="-1"
    role="dialog"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content" style="width: 800px; margin-left: -100px">
        <div class="container p-4">
            <div class="row m-4">
                <div class="col">
                    <h3>Edit User</h3>
                </div>
            </div>

            <div class="row m-4">
                <div class="col">
                    <input id="username"  class="form-control" type="text" placeholder="Username">
                </div>

                <div class="col">
                    <input id="mobile" class="form-control" type="number" placeholder="Mobile">
                </div>
            </div>
 
            <div class="row m-4">
                <div class="col">
                    <input id="age" class="form-control" type="number" placeholder="Age">
                </div>

                <div class="col">
                    <input id="city" class="form-control" type="text" placeholder="City">
                </div>
            </div>

            <div class="row m-4">
                <div class="col-4"></div>
                <div class="col-4">
                    <button id="confirmBtn" class="btn btn-outline-danger w-100" onclick="confirmUser(this);"> Confirm</button>
                </div>
                <div class="col-4"></div>
            </div>



        </div>
      </div>
    </div>
  </div>



    <script>

        function confirmUser(ele)
        {
                
            $.ajax({
            url: "functions.php",
            type: "POST",
            data: {
                "RESULT_TYPE": "CONFIRM_EDIT",
                "USERID":ele.name,
                "USERNAME":username.value,
                "AGE":age.value,
                "MOBILE":mobile.value,
                "CITY":city.value
            },
            success: function(res) {
                console.log(res)
                var jobj = JSON.parse(res)
                if(jobj.result==1)
                 {
                    toastr.success(jobj.message);
                    setTimeout(() => {
                        window.location.reload();
                    }, 1000);
                 }else{
                    toastr.error("User Edit Failed");
                 }
            }
            });


        }


        $(document).ready(function() {

            $.ajax({
                url: "functions.php",
                type: "POST",
                data: {
                    "RESULT_TYPE": "GET_TESTDRIVE_DETAILS"
                },
                success: function(res) {
                    console.log(res)
                    
                    var jobj = JSON.parse(res)

                    new DataTable('#example', {
                        columns: [{
                                title: 'IMAGE'
                            },
                            {
                                title: 'CAR'
                            },
                            {
                                title: 'NAME'
                            },
                            {
                                title: 'MOBILE'
                            },
                            {
                                title: 'CITY'
                            },
                            {
                                title: 'BOOKDATE'
                            } 
                        ],
                        data: jobj
                    });


                }
            });
        });

        function deleteUser(ele)
        {
                
            $.ajax({
            url: "functions.php",
            type: "POST",
            data: {
                "RESULT_TYPE": "DELETE_USER","USERID":ele.id
            },
            success: function(res) {
                console.log(res)
                var jobj = JSON.parse(res)
                if(jobj.result==1)
                 {
                    toastr.success(jobj.message);
                    setTimeout(() => {
                        window.location.reload();
                    }, 1000);
                 }else{
                    toastr.error("User Delete Failed");
                 }

            
            }
            });

        }

function editUser(ele)
{
            $.ajax({
            url: "functions.php",
            type: "POST",
            data: {
                "RESULT_TYPE": "EDIT_USER","USERID":ele.id
            },
            success: function(res) {
                console.log(res)
                var jobj = JSON.parse(res)
                username.value=jobj.username
                age.value=jobj.age
                mobile.value=jobj.mobile
                city.value=jobj.city
                confirmBtn.name=jobj.id
                $('#editModal').modal('show');
            }
            });


}


    </script>

</body>

</html>