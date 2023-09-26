<?php
$napok = array(
    "HU" => array("H", "K", "Sze", "Cs", "P", "Szo", "V"),
    "EN" => array("M", "Tu", "W", "Th", "F", "Sa", "Su"),
    "DE" => array("Mo", "Di", "Mi", "Do", "F", "Sa", "So"),
);

foreach ($napok as $nyelv => $napTomb) {
    echo "$nyelv: ";
    for($i=0; $i<count($napTomb) - 1; $i++) {
        if($i % 2 !== 0) {
            echo "<span style='font-weight: bold'>$napTomb[$i]</span>, ";
        } else {
            echo "$napTomb[$i], ";
        }
    }
    echo $napTomb[count($napTomb)-1];
    echo "<br>";
}