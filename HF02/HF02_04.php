<?php
$szinek = array('A' => 'Kek', 'B' => 'Zold', 'c' => 'Piros');
$kis = "kisbetus";
$nagy = "nagybetus";
function atalakit(array $tomb, string $tipus): void {
    foreach ($tomb as $kulcs => $ertek) {
        if(trim(strtolower($tipus)) === "kisbetus") {
            $tomb[$kulcs] = strtolower($ertek);
        } else {
            $tomb[$kulcs] = strtoupper($ertek);
        }
    }
    print_r($tomb);
}

atalakit($szinek, $nagy);