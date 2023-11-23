<?php
global $conn;
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

include_once 'kapcsolodas.php';

if (isset($_POST["submit"])) {
    $id = $_POST["id"];
    $nev = $_POST["nev"];
    $szak = $_POST["szak"];
    $atlag = $_POST["atlag"];

    $sql = "UPDATE hallgatok SET nev=?, szak=?, atlag=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssdi", $nev, $szak, $atlag, $id);
    $stmt->execute();
    header("Location: listazas.php");
} else {
    $sql = "SELECT * FROM hallgatok WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $_GET["id"]);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $conn->close();
}
?>

<form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
    Nev:<input type="Text" name="nev" value="<?php echo $row["nev"]; ?>"><br>
    Szak:<input type="Text" name="szak" value="<?php echo $row["szak"]; ?>"><br>
    Atlag:<input type="Text" name="atlag" value="<?php echo $row["atlag"]; ?>"><br>
    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
    <input type="Submit" name="submit" value="Elkuld">
</form>