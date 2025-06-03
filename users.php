<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="../js/jquery-3.7.1.min.js"></script>
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
        <div class="container">

            <div class="row">
                <div class="col">
                    <input type="text" placeholder="Username">
                </div>

                <div class="col">
                    <input type="number" placeholder="Mobile">
                </div>
            </div>
 
            <div class="row">
                <div class="col">
                    <input type="number" placeholder="Age">
                </div>

                <div class="col">
                    <input type="text" placeholder="City">
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <button class="btn btn-outline-danger"> Confirm</button>
                </div>
            </div>



        </div>
      </div>
    </div>
  </div>



    <script>
        $(document).ready(function() {

            $.ajax({
                url: "functions.php",
                type: "POST",
                data: {
                    "RESULT_TYPE": "GET_USERS_DETAILS"
                },
                success: function(res) {
                    
                    var jobj = JSON.parse(res)

                    new DataTable('#example', {
                        columns: [{
                                title: 'ID'
                            },
                            {
                                title: 'USERNAME'
                            },
                            {
                                title: 'MOBILE'
                            },
                            {
                                title: 'AGE.'
                            },
                            {
                                title: 'CITY'
                            },
                            {
                                title: 'REGDATE'
                            },
                            {
                                title: ''
                            },
                            {
                                title: ''
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
 $('#editModal').modal('show');
}


    </script>

</body>

</html>