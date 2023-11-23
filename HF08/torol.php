<?php
global $conn;
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}
include_once 'kapcsolodas.php';
if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $sql = "DELETE FROM hallgatok WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $result = $stmt->execute();
    if ($result === TRUE) {
        header("Location: listazas.php");
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}