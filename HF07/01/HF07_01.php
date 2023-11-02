<?php
$randomszam = rand(1, 10);
if (!isset($_COOKIE['randomszam'])) {
    setcookie('randomszam', $randomszam, time() + 3600 * 24 * 365);
}


if (isset($_POST['elkuldott'])) {

    if ($_POST['talalgatas'] > $_COOKIE['randomszam']) {
        echo "<h3>A szám kisebb!</h3>";
    } else if ($_POST['talalgatas'] < $_COOKIE['randomszam']) {
        echo "<h3>A szám nagyobb!</h3>";
    } else {
        echo "<br>A szám, amire gondoltam:" . $_COOKIE["randomszam"] . ", Ön nyert! Játsszon újra!<hr>";
        $ujszam = rand(1, 10);
        while ($ujszam === $randomszam) {
            $newNumber = rand(1, 10);
        }
        setcookie('randomszam', $ujszam, time() + 3600 * 24 * 365);
    }
}
?>
<form method="POST" action="">
    <input type="hidden" name="elkuldott" value="">
    Melyik számra gondoltam 1 és 10 között?
    <input name="talalgatas" type="text">
    <br>
    <br>
    <input type="submit" value="Elküld">
</form>

