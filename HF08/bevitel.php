<form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="POST">
    <label>
        Név:
        <input type="text" name="nev" value="">
    </label>
    <br>
    <label>
        Szak:
        <input type="text" name="szak" value="">
    </label>
    <br>
    <label>
        Atlag:
        <input type="text" name="atlag" value="">
    </label>
    <br>
    <label>
        Küldés
        <input type="submit" name="submit">
    </label>
</form>

<?php
global $conn;
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}
$nev = $szak = $atlag = "";
if (isset($_POST["submit"])) {
    $nev = $_POST["nev"];
    $szak = $_POST["szak"];
    $atlag = $_POST["atlag"];

    include_once 'kapcsolodas.php';


    $sql = "INSERT INTO hallgatok (nev, szak, atlag) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssd", $nev, $szak, $atlag);
    //    $result = $conn->query($sql);
    $result = $stmt->execute();
    if ($result === TRUE) {
        $conn->close();
        header("Location: listazas.php");
    } else {
        echo "hiba tortent";
    }
}

?>