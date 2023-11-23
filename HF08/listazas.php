<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}
?>
<html>
<head>
    <style>
        table {
            border: 1px solid black;
        }

        td {
            padding: 10px;
            border: 1px solid black;
        }
    </style>
</head>

<body>
<p>Üdv, <?php echo $_SESSION["username"] ?></p>
<a href="bevitel.php">Új hallgató beszúrása</a>
<form action="logout.php" method="POST">
    <label>
        Kilépés:
        <input type="submit" name="kilepes" value="Kilépés">
    </label>
</form>
<br>
<?php
global $conn;

include_once 'kapcsolodas.php';

//$sql = "INSERT INTO hallgatok (nev, szak, atlag) VALUES ('testNev', 'testGI', 9.6)";
//$conn->query($sql);

$sql = "SELECT * FROM hallgatok";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    echo "<table>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["nev"] . "</td>";
        echo "<td>" . $row["szak"] . "</td>";
        echo "<td>" . $row["atlag"] . "</td>";
        echo "<td><a href=szerkeszt.php?id=" . $row["id"] . ">Update</a></td>";
        echo "<td><a href=torol.php?id=" . $row["id"] . ">Delete</a></td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

$conn->close();
?>

</body>
</html>