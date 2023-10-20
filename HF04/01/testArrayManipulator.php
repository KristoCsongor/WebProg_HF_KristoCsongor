<?php
include "ArrayManipulator.php";
include "NonExistentField.php";
try {

    $testArray = new ArrayManipulator();
    $testArray->data = ["one" => 1, "two" => 2, "three" => 3, "four" => 4]; // __set
    // $testArray->dat = array(1, 2, 3, 4, 5); // __set -> error

    echo isset($testArray) . "<br>";
    $cloneArray = clone $testArray;
    echo $testArray . "<br>"; // __toString
    echo $cloneArray . "<br>";

    unset($testArray);
    // echo $testArray . "<br>"; // -> error
    echo $cloneArray . "<br>";

} catch (NonExistentField $e) {
    echo $e->myErrorMessage();
}
