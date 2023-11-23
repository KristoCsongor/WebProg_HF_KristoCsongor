<form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="POST">
    <label>
        Username:
        <input type="text" name="username" value="">
    </label>
    <br>
    <label>
        Password:
        <input type="text" name="password" value="">
    </label>
    <br>
    <input type="submit" name="submit">
</form>

<?php
global $conn;
session_start();
if (isset($_SESSION["username"])) {
    header("Location: listazas.php");
    exit();
}
if (isset($_POST["submit"])) {
    $username = $_POST["username"];
    $psw = $_POST["password"];
    include_once 'kapcsolodas.php';

    $sql = "SELECT username, password FROM users";
    $stmt = $conn->prepare($sql);
    // $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        if ($row["username"] == $username && $row["password"] == $psw) {
            $_SESSION["username"] = $username;
            header("Location: listazas.php");
            exit();
        }
    }
    echo "Invalid username or password";
    $conn->close();

}
?>