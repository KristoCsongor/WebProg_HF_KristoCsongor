<?php
    $szin = "aqua";
    $szorzotabla = function(int $n) use($szin) {
        echo "<table style='border: 1px solid black'>";
        for($i=1; $i<=$n; $i++) {
            echo "<tr>";
            for($j=1; $j<=$n; $j++) {
                $c = $i * $j;
                if($i === $j) {
                    echo "<td style='padding: 10px; border: 1px solid black; background-color: $szin'>$c</td>";
                } else {
                    echo "<td style='padding: 10px; border: 1px solid black'>$c</td>";
                }
            }
            echo "</tr>";
        }
        echo "</table>";
    };

    $szorzotabla(15);