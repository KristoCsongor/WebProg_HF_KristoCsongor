<?php
$name = $email = $password = $confirmPassword = $date = $interestField = $gender = $country = "";
$nameErr = $emailErr = $passwordErr = $confirmPasswordErr = $dateErr = "";

function test_input($data): string
{
// Lab6 - Fel7
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function output_interest_field($array, $str): void
{
    foreach ($array as $item) {
        if ($item === $str) {
            echo "checked";
        }
    }

}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["name"])) {
        $nameErr = "A név mező nem lehet üres!";
    } else {
        $name = test_input($_POST["name"]);
    }

    if (empty($_POST["email"])) {
        $emailErr = "Adjon meg egy email címet";
    } else {
        $email = test_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Nem helyes email cím formátum!";
        }
    }

    if (empty($_POST["password"])) {
        $passwordErr = "Adjon meg egy jelszót!";
    } else {
        $password = test_input($_POST["password"]);

        // Check if the password has at least 8 characters
        if (strlen($password) < 8) {
            $passwordErr = "A jelszónak legalább 8 karakter hosszúnak kell lennie";
        } else {
            // Check for at least one uppercase letter
            if (!preg_match('/[A-Z]/', $password)) {
                $passwordErr = "A jeleszóban legyalább 1 nagybetú kell legyen.";
            } else {
                // Check for at least one special character (e.g., !@#$%^&*)
                if (!preg_match('/[!@#$%^&*]/', $password)) {
                    $passwordErr = "A jelszóban legalább egy speciális karakter kell legyen";
                }
            }
        }
    }

    if (empty($_POST["confirmPassword"])) {
        $confirmPasswordErr = "Adja meg a megerősítő jelszót!";
    } else {
        if ($password !== test_input($_POST["confirmPassword"])) {
            $confirmPasswordErr = "A két jelszó nem egyezik.";
        } else {
            $confirmPassword = test_input($_POST["confirmPassword"]);
        }
    }

    if (!empty($_POST["date"])) {
        $date = $_POST["date"];
        list($year, $month, $day) = explode("-", $date);
        $year = (int)$year;
        $month = (int)$month;
        $day = (int)$day;
        if (!checkdate($month, $day, $year)) {
            $dateErr = "Nem érvényes dátum!";
        }
    } else {
        $dateErr = "Adj meg egy dátumot!";
    }


    if (!empty($_POST["gender"])) {
        $gender = $_POST["gender"];
    }

    $interestField = $_POST["interestField"] ?? [];
    $country = $_POST["country"] ?? [];
}
?>


<html lang="hu">
<head>
    <title></title>
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
</head>

<body>
<h3>Regisztrációs űrlap</h3>
<form method="POST" action="<?php echo $_SERVER["PHP_SELF"] ?>">

    <label>
        Név:
        <input type="text" name="name" value="<?php echo $name; ?>">
        <?php echo "<span>* $nameErr</span>" ?>
    </label>
    <br><br>

    <label>
        Email:
        <input type="text" name="email" value="<?php echo $email; ?>">
        <?php echo "<span>* $emailErr</span>" ?>
    </label>
    <br><br>

    <label>
        Jelszó:
        <input type="password" name="password" value="<?php echo $password; ?>">
        <?php echo "<span>* $passwordErr</span>" ?>
    </label>
    <br><br>

    <label>
        Jelszó megerősítése:
        <input type="password" name="confirmPassword" value="<?php echo $confirmPassword; ?>">
        <?php echo "<span>* $confirmPasswordErr</span>" ?>
    </label>
    <br><br>

    <label>
        Születési dátum:
        <input type="date" name="date" value="<?php echo $date; ?>">
        <?php echo "<span>* $dateErr</span>" ?>
    </label>
    <br><br>

    <label>
        Nem:
        <br>
        <input type="radio" name="gender" value="Férfi" <?php if ($gender === "Férfi") echo "checked"; ?>>Férfi<br>
        <input type="radio" name="gender" value="Nő" <?php if ($gender === "Nő") echo "checked"; ?>>Nő<br>
        <input type="radio" name="gender" value="Egyéb" <?php if ($gender === "Egyéb") echo "checked"; ?>>Egyéb<br>
    </label>
    <br><br>

    <label>
        Érdeklődési területek:
        <br>
        <input type="checkbox" name="interestField[]"
               value="Sport" <?php if (!empty($interestField)) output_interest_field($interestField, "Sport"); ?>>Sport<br>
        <input type="checkbox" name="interestField[]"
               value="Művészet" <?php if (!empty($interestField)) output_interest_field($interestField, "Művészet"); ?>>Művészet<br>
        <input type="checkbox" name="interestField[]"
               value="Tudomány" <?php if (!empty($interestField)) output_interest_field($interestField, "Tudomány"); ?>>Tudomány<br>
    </label>
    <br><br>

    <label>
        Ország:
        <select name="country">
            <option value="">Válasszon országot</option>
            <option value="Magyarország" <?php if ($country === "Magyarország") echo "selected"; ?>>Magyarország
            </option>
            <option value="Románia" <?php if ($country === "Románia") echo "selected"; ?>>Románia</option>
            <option value="USA" <?php if ($country === "USA") echo "selected"; ?>>USA</option>
            <option value="Kanada" <?php if ($country === "Kanada") echo "selected"; ?>>Kanada</option>
        </select>
    </label>
    <br><br>
    <label>
        <input type="submit" name="submit" value="Regisztráció">
    </label>
</form>
<?php
$condition = $nameErr == "" && $emailErr == "" && $passwordErr == "" && $confirmPasswordErr == "" && $dateErr == "";
if (isset($_POST["submit"]) && $condition) {
    echo "<br><br>Regisztrálás (elfogadott) adatai:";


    if (empty($interestField)) {
        $headingArray = ["Név", "Email", "Jelszó", "Születési dátum", "Nem", "Ország"];
        $valueArray = [$name, $email, $password, $date, $gender, $country];
    } else {
        $interestFieldString = "";

        for ($i = 0; $i < count($interestField) - 1; $i++) {
            $interestFieldString .= $interestField[$i] . ", ";
        }
        $interestFieldString .= $interestField[count($interestField) - 1];

        $headingArray = ["Név", "Email", "Jelszó", "Születési dátum", "Nem", "Érdeklődési területek", "Ország"];
        $valueArray = [$name, $email, $password, $date, $gender, $interestFieldString, $country];
    }

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

