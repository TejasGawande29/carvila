<?php
    $text=$_GET["text"];
    $clr=$_GET["color"];
    $bgcolor=$_GET["bg"];
    echo "<h1  style='color:$clr; background-color:$bgcolor'>$text</h1>";
?>