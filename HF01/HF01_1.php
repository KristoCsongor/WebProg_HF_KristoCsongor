<?php
    $initialArray = [5, '5', '05', 12.3, '16.7', 'five', 'true', 0xDECAFBAD, '10e200'];
    for($i=0; $i<count($initialArray); $i++) {
        echo gettype($initialArray[$i]) . ", ";
        if (is_numeric($initialArray[$i])) {
            echo " Igen<br>";
        } else {
            echo " Nem <br>";
        }
    }
