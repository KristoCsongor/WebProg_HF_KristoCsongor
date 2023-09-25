<?php
    $selectedMonth = "may";
    $editedMonth = strtolower(trim($selectedMonth));

    if ($editedMonth === "january" || $editedMonth === "february" || $editedMonth === "december") {
        echo "$selectedMonth -> winter";
    } else if ($editedMonth === "march" || $editedMonth === "april" || $editedMonth === "may") {
        echo "$selectedMonth -> spring";
    } else if ($editedMonth === "june" || $editedMonth === "july" || $editedMonth === "august") {
        echo "$selectedMonth -> summer";
    } else if ($editedMonth === "september" || $editedMonth === "october" || $editedMonth === "november") {
        echo "$selectedMonth -> autumn";
    } else {
        echo "Incorrect month!";
    }