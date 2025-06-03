<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/2.3.0/js/dataTables.js"></script>
    <link rel="stylesheet" href="../CSS/bootstrap.min.css"></link>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.0/css/dataTables.dataTables.css">
</head>

<body>
    <div style="display: flex; ">
        <div style="width: 20%;">
            <?php include_once('layouts/sidebar.php'); ?>
        </div>
        <div style="width: 80%;">
            <table id="example" class="display" width="100%"></table>
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
                    console.log(res)
                    var jobj = JSON.parse(res);
                    new DataTable('#example', {
                        columns: [
                            {title: 'ID'},
                            {title: 'USERNAME'},
                            {title: 'MOBILE'},
                            { title: 'AGE'},
                            {title: 'CITY.'},
                            {title: 'REGDATE'},
                            {title: ''},
                            {title: ''}
                        ],
                        data: jobj
                    });

                }
            });

        });
    </script>
</body>

</html>