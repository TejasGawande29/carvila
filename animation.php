<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transition</title>
    <style>
        .ball{
            width: 200px;
            height: 200px;
            background-color: red;
            border-radius: 50%;
            animation: bounce 2s both infinite;
            transition: all 2s ease 0s;
        }
        @keyframes bounce{
            25%{
                transform: translateY(100px);
                background-color: aqua;
            }
            50%{
                transform: translateY(150px);
                background-color: rgb(48, 217, 118);
            }
            75%{
                transform: translateY(200px);
                background-color: rgb(168, 90, 193);
            }
            100%{
                transform: translateY(250px);
                background-color: rgb(212, 67, 154);
            }
        }
    </style>
</head>
<body>
    <div class="ball">

    </div>
</body>
</html>