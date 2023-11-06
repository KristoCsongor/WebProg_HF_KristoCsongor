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
} catch (DeleteSubjectException $e) {
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

$testStudent3 = new Student("testname3", "3");
$testStudent3->setGrades(array(7, 8, 9));
$testStudent4 = new Student("testname4", "4");
$testStudent4->setGrades(array(7, 8, 10));
$testStudent5 = new Student("testname5", "5");
$testStudent5->setGrades(array(7, 8, 8));
$testStudent6 = new Student("testname6", "6");
$testStudent6->setGrades(array(7, 8, 7));

$studentList = array($testStudent3, $testStudent4, $testStudent5, $testStudent6);
echo "<br><br>Students before sorting<br>";


foreach ($studentList as $student) {
    echo $student . "<br>";
}


usort($studentList, function ($student1, $student2) {
    return $student1->getAvgGrade() < $student2->getAvgGrade();
});

echo "<br>Students after sorting<br>";
foreach ($studentList as $student) {
    echo $student . "<br>";
}