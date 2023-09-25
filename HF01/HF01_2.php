<?php
    $second = 3600 * 12;
    $hour = $second / (3600);
    /*echo gettype($second);
    echo "<br>";
    echo gettype($hour);*/
    if (is_int($hour)) {
        echo "The given hour is: <b>$hour</b>";
    } else {
        echo "The hour variable isn't an integer!";
    }
