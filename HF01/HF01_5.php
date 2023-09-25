<?php
    $a = 5;
    $b = 0;
    $sign = "a";

    switch ($sign) {
        case "+":
            $c = $a + $b;
            echo "$a + $b = $c";
            break;
        case "-":
            $c = $a - $b;
            echo "$a - $b = $c";
            break;
        case "*":
            $c = $a * $b;
            echo "$a * $b = $c";
            break;
        case "/":
            if ($b == 0) {
                echo "Division Error (/0)!";
                break;
            }
            $c = $a / $b;
            echo "$a / $b = $c";
            break;
        default:
            echo "Incorrect operator sign!";
    }