<?php
$firstNameErr = $lastNameErr = $emailErr = $attendErr = $tshirtErr = $fileErr = $termsErr = "";
$firstName = $lastName = $email = $attend = $tshirt = $file = "";

function test_input($data): string
{
    // Lab6 - Fel7
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function output_attend($array, $str): void
{
    foreach ($array as $item) {
        if ($item === $str) {
            echo "checked";
        }
    }

}

//if (isset($_POST["submit"]))
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["firstName"])) {
        $firstNameErr = "First name is required!";
    } else {
        $firstName = test_input($_POST["firstName"]);
    }

    if (empty($_POST["lastName"])) {
        $lastNameErr = "Last name is required!";
    } else {
        $lastName = test_input($_POST["lastName"]);
    }

    if (empty($_POST["email"])) {
        $emailErr = "Email is required!";
    } else {
        $email = test_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
        }
    }

    $attend = $_POST["attend"] ?? [];
    if (empty($attend)) {
        $attendErr = "Select at least 1 event!";
    }

    $tshirt = test_input($_POST["tshirt"]);


    if (isset($_FILES["abstract"]) && $_FILES["abstract"]["error"] === 0) {
        $file = $_FILES["abstract"];
        $fileName = $file["name"];
        $fileType = $file["type"];
        $fileSize = $file["size"];

        // Check if it's a PDF file
        if ($fileType !== "application/pdf") {
            $fileErr = "File type is not PDF.";
        } elseif ($fileSize > 3 * 1024 * 1024) {
            $fileErr = "File size is over 3MB.";
        } else {
            // Move and save the file
            $uploadDirectory = "uploads/";
            $uploadPath = $uploadDirectory . $file["name"];

            if (!move_uploaded_file($file["tmp_name"], $uploadPath)) {
                $fileErr = "Failed to save the file.";
            }
        }
    } else {
        $fileErr = "File upload failed.";
    }

    if (!isset($_POST["terms"])) {
        $termsErr = "You need to agree to terms & conditions";
    }
}
?>

<?php
$condition = (
    $firstNameErr == "" && $lastNameErr == "" &&
    $emailErr == "" && $attendErr == "" &&
    $tshirtErr == "" && $fileErr == "" && $termsErr == ""
);
if (isset($_POST["submit"]) && $condition) {
    echo "<br><br>Registration data:";

    $attendString = "";

    for ($i = 0; $i < count($attend) - 1; $i++) {
        $attendString .= $attend[$i] . ", ";
    }
    $attendString .= $attend[count($attend) - 1];

    $headingArray = ["First name", "Last name", "Email", "Events", "T-shirt", "File"];
    $valueArray = [$firstName, $lastName, $email, $attendString, $tshirt, $file["name"]];


    echo "<table>";
    for ($i = 0; $i < count($valueArray); $i++) {
        if (isset($valueArray[$i]) == !empty($valueArray[$i])) {
            echo "<tr>";
            echo "<td>$headingArray[$i]</td>";
            echo "<td>$valueArray[$i]</td>";
            echo "</tr>";
        }
    }
    echo "</table>";
}
include "HF06_01_externalprocess.php";
?>
