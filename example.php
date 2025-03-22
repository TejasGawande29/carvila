<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Addition</title>
    <script>
     
        function addNumbers() {
          
            var num1 = parseFloat(document.getElementById('num1').value);
            var num2 = parseFloat(document.getElementById('num2').value);
          
                var sum = num1 + num2;
                document.getElementById('result').innerText = 'Result: ' + num1 + ' + ' + num2 + ' = ' + sum; 
        }
    </script>
</head>
<body>
    <h1>Simple Addition</h1>
    <form action="index.php" method="get" onsubmit="event.preventDefault(); addNumbers();">
        <input type="text" id="num1" name="num1" placeholder="Enter first number" required>
        <input type="text" id="num2" name="num2" placeholder="Enter second number" required>
        <button type="submit">Add</button>
    </form>

    <p id="result"></p> 

</body>
</html>
