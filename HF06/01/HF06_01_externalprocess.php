<?php
$firstNameErr = $lastNameErr = $emailErr = $attendErr = $tshirtErr = $fileErr = $termsErr = "";
$firstName = $lastName = $email = $attend = $tshirt = $file = "";
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
<form method="post" action="process.php" enctype="multipart/form-data">
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

</body>
</html>
