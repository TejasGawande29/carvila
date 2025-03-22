<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>id</title>
    <style>
        #pb{
            background-color: red   ;

        }
        #pb li{
            color: aquamarine;
            border: 4px solid green;
        }
        #pb > ul > li > div{
            border: 4px solid blue;
            background-color: aquamarine;
        }
        #pb + p{                /* Adjcent sibbling selector.
            */
            background-color: aqua;
        }
        #pb ~ p{                /* General sibling selector. It only target adjucent sibbling.*/
            background-color: rgb(210, 112, 255);
        }
    </style>
</head>
<body>

    <!-- Selectors
     1) id selector
     2) class selector
     3) tag selector
     4) Descendend selector
     5) Child Selector    ***Combinators
    6) Adjucent selector.-->
    <div id="pb">
        <ul>
            <li>first <div>Lorem ipsum dolor sit amet consectetur adipisicing elit. Recusandae eveniet unde ut?</div></li>
            <li>second</li>
            <li>3</li>
            <li>4</li>
        </ul>
    </div>
    <p>Lorem ipsum dolor sit amet.</p>
    <p>Lorem ipsum dolor sit amet.</p>
</body>
</html>