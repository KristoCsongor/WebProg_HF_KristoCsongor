<?php
    $output = "";
    for($i=0; $i<3; $i++) {
        $output .= "<tr>";
        for($j=0; $j<3; $j++) {
            if(($i + $j) % 2 === 1) {
                $output .=  "<td style='background-color: black; padding: 50px; border: 1px solid black'></td>";
            } else {
                $output .=  "<td style='padding: 50px; border: 1px solid black'></td>";
            }
        }
        $output .=  "</tr>";
    }
echo <<<END
        <table style="border: 1px solid black">
            $output  
        </table>
    END;
