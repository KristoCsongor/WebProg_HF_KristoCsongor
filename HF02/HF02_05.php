<?php
declare(strict_types=1);
// a)
$lista = array(
    array("nev" => "kenyer", "mennyiseg" => 2, "egysegar" => 8.5),
    array("nev" => "viz", "mennyiseg" => 1, "egysegar" => 2.5)
);

// b)
$termekBetesz = function (string $nev, int $mennyiseg, float $egysegar) use (&$lista): void {
    $letezik = false;
    foreach ($lista as $kulcs => &$termek) {
        if ($termek["nev"] === trim(strtolower($nev))) {
            $letezik = true;
            $termek["mennyiseg"] += $mennyiseg;
        }
    }
    if (!$letezik) {
        $ujElem = array("nev" => $nev, "mennyiseg" => $mennyiseg, "egysegar" => $egysegar);
        $lista[] = $ujElem;
    }
};

// c)
$termekKivesz = function (string $nev) use (&$lista): void {
    $ujLista = array_filter($lista, function ($termek) use ($nev) {
        return $termek["nev"] !== trim(strtolower($nev));
    });
    $lista = $ujLista;
};

// d)
$termekListaz = function () use (&$lista): void {
    echo <<<VEGE
    <table style="border: 1px solid black">
        <tr>
            <th style="padding: 5px">Név</th>
            <th style="padding: 5px">Mennyiség</th>
            <th style="padding: 5px">Egységár</th>
VEGE;
    foreach ($lista as $kulcs => $ertek) {
        echo "<tr>";

        echo "<td style='padding: 5px; text-align: center'>" . $ertek["nev"] . "</td>";
        echo "<td style='padding: 5px; text-align: center'>" . $ertek["mennyiseg"] . "</td>";
        echo "<td style='padding: 5px; text-align: center'>" . $ertek["egysegar"] . "</td>";

        echo "</tr>";

    }
    echo "</table>";
};

// e)
$kiirOsszKoltseg = function () use (&$lista): void {
    $osszeg = 0;
    foreach ($lista as $kulcs => $elem) {
        $osszeg += $elem["mennyiseg"] * $elem["egysegar"];
    }
    echo $osszeg . " RON";
};

$termekBetesz("kenyer", 4, 8.5);
$termekBetesz("kenyer", 4, 12);

$termekKivesz("viz");
//$termekKivesz("kenyer");

$termekBetesz("alma", 2, 5);
$termekBetesz("alma", 3, 5);

$termekListaz();
echo "<br>";
$kiirOsszKoltseg();