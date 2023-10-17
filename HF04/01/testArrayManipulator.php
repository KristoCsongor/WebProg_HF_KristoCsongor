<?php
include "ArrayManipulator.php";
include "NonExistentField.php";

$testArray = new ArrayManipulator();
$testArray->data = array(1, 2, 3, 4, 5); // __set
// $testArray->dat = array(1, 2, 3, 4, 5); // __set

for($i=0; $i<count($testArray->data); $i++) { // __get
    echo $testArray->data[$i] . "<br>";
}

echo $testArray;