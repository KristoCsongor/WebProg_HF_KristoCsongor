<?php
    $selectedMonth = "december";
    $editedMonth = strtolower(trim($selectedMonth));

    switch ($editedMonth) {
        case "january":
        case "february":
        case "december":
            echo "$editedMonth -> winter";
            break;
        case "march":
        case "april":
        case "may":
            echo "$editedMonth -> spring";
            break;
        case "june":
        case "july":
        case "august":
            echo "$editedMonth -> summer";
            break;
        case "september":
        case "october":
        case "november":
            echo "$editedMonth -> autumn";
            break;
        default:
            echo "Incorrect month!";
    }