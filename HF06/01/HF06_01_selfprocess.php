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
<html lang="en">
<head>
    <style>
        span {
            color: red;
        }

        table {
            width: 50%;
        }

        td {
            border: 1px solid black;
            padding: 5px;
            width: 50%;
        }
    </style>
    <title></title>
</head>

<body>
<h3> Online conference registration </h3>
<form method="post" action="<?php echo $_SERVER["PHP_SELF"] ?>" enctype="multipart/form-data">
    <label for="fname"> First name:
        <input type="text" name="firstName" value="<?php echo $firstName; ?>">
        <?php echo "<span>* $firstNameErr</span>"; ?>
    </label>
    <br><br>
    <label for="lname"> Last name:
        <input type="text" name="lastName" value="<?php echo $lastName; ?>">
        <?php echo "<span>* $lastNameErr</span>"; ?>
    </label>
    <br><br>
    <label for="email"> E - mail:
        <input type="text" name="email" value="<?php echo $email; ?>">
        <?php echo "<span>* $emailErr</span>"; ?>
    </label>
    <br><br>
    <label for="attend"> I will attend:<br>
        <input type="checkbox" name="attend[]"
               value="Event1" <?php if (!empty($attend)) {
            output_attend($attend, "Event1");
        } ?>> Event1<br>
        <input type="checkbox" name="attend[]"
               value="Event2" <?php if (!empty($attend)) {
            output_attend($attend, "Event2");
        } ?>> Event2<br>
        <input type="checkbox" name="attend[]"
               value="Event3" <?php if (!empty($attend)) {
            output_attend($attend, "Event3");
        } ?>> Event3<br>
        <input type="checkbox" name="attend[]"
               value="Event4" <?php if (!empty($attend)) {
            output_attend($attend, "Event4");
        } ?>> Event4<br>
        <?php echo "<span>$attendErr</span>"; ?>
    </label>
    <br><br>
    <label for="tshirt"> What's your T-Shirt size?<br>
        <select name="tshirt">
            <option value="">Please select</option>
            <option value="S" <?php if ($tshirt === "S") echo "selected" ?>>S</option>
            <option value="M" <?php if ($tshirt === "M") echo "selected" ?>>M</option>
            <option value="L" <?php if ($tshirt === "L") echo "selected" ?>>L</option>
            <option value="XL" <?php if ($tshirt === "XL") echo "selected" ?>>XL</option>
        </select>
    </label>
    <br><br>
    <label for="abstract"> Upload your abstract<br>
        <input type="file" name="abstract" value=<?php if (isset($file["name"])) echo $file["name"]; ?>/>
        <?php echo "<span>$fileErr</span>"; ?>
    </label>
    <br><br>
    <input type="checkbox" name="terms" value="" <?php if (isset($_POST["terms"])) echo "checked"; ?>>I agree
    to terms & conditions.<br>
    <?php echo "<span>$termsErr</span>"; ?>
    <br><br>
    <input type="submit" name="submit" value="Send registration"/>
</form>
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
?>
</body>
</html>
