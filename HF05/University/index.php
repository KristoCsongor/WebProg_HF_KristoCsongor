<?php

declare(strict_types=1);
include "Loader.php";

$univ = new University();

$webProg = null;
$database = null;

try {
    $webProg = $univ->addSubject('101', 'Web programming');
    $database = $univ->addSubject('102', 'Database');
    //$database2 = $univ->addSubject('101', 'Database');

    $webProg->addStudent('Kiss Lajos', '520');
    $webProg->addStudent('Nagy Peter', '521');
    $database->addStudent('Egy Elek', '522');
    $database->addStudent('Ket Ella', '523');

    $univ->addSubject('103', 'Java programming');
} catch (Exception $e) {
    echo $e->getMessage();
}
$univ->addStudentOnSubject('103', new Student("524", "Harom Ella"));

// 1) Subject: deleteStudent
$testStudent1 = new Student("test", "5");
$webProg->addStudent($testStudent1->getName(), $testStudent1->getStudentNumber());
foreach ($webProg->getStudents() as $student) {
    echo $student->getName() . "<br>";
}
$webProg->deleteStudent($testStudent1);
foreach ($webProg->getStudents() as $student) {
    echo $student->getName() . "<br>";
}

// 2) University: deleteSubject
$testSubject = $univ->addSubject('401', 'Test Subject');
try {
    $univ->deleteSubject($testSubject);
    $univ->deleteSubject($webProg);
} catch(DeleteSubjectException $e) {
    echo $e->showMessage();
}

// 3) b)
$testStudent2 = new Student("testStudent", "599");
$testStudent2->setGrade($webProg, 8);
$testStudent2->setGrade($database, 7);
// 3) d)

$univ->print();
echo "<br>";
$testStudent2->printGrades();
// 3) c)
echo $testStudent2->getAvgGrade() . "<br>";
echo "Total number of students: " . $univ->getNumberOfStudents();
