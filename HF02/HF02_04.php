<?php
declare(strict_types=1);
$szinek = array('A' => 'Kek', 'B' => 'Zold', 'c' => 'Piros');
$kis = "kisbetus";
$nagy = "nagybetus";
function atalakitClassic(array $tomb, string $tipus): void
{
    foreach ($tomb as $kulcs => $ertek) {
        if (trim(strtolower($tipus)) === "kisbetus") {
            $tomb[$kulcs] = strtolower($ertek);
        } else if (trim(strtolower($tipus)) === "nagybetus") {
            $tomb[$kulcs] = strtoupper($ertek);
        } else {
            echo "Helytelen bemenet (tipus)!";
        }
    }
    print_r($tomb);
    echo "<br>";
}

function atalakitArrayMap(array $tomb, string $tipus): void
{
    if (trim(strtolower($tipus)) === "kisbetus") {
        $ujTomb = array_map("strtolower", $tomb);
        print_r($ujTomb);
    } else if (trim(strtolower($tipus)) === "nagybetus") {
        $ujTomb = array_map("strtoupper", $tomb);
        print_r($ujTomb);
    } else {
        echo "Helytelen bemenet (tipus)!";
    }
    echo "<br>";
}

atalakitClassic($szinek, $nagy);
atalakitClassic($szinek, $kis);
echo "<br>";
atalakitArrayMap($szinek, $nagy);
atalakitArrayMap($szinek, $kis);