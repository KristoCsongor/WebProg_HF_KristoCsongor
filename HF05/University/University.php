<?php
require_once "AbstractUniversity.php";

class University extends AbstractUniversity
{
    // TODO Implement all the methods declared in parent
    public function addSubject(string $code, string $name): Subject
    {
        // TODO: Implement addSubject() method.
        $subject = new Subject($code, $name);
        $this->subjects[] = $subject;

        return $subject;
    }

    public function addStudentOnSubject(string $subjectCode, Student $student): void
    {
        // TODO: Implement addStudentOnSubject() method.
        foreach ($this->subjects as $subject) {
            if($subject->getCode() == $subjectCode) {
                $subject->addStudent($student->getName(), $student->getStudentNumber());
                break;
            }
        }
    }

    public function getStudentsForSubject(string $subjectCode)
    {
        // TODO: Implement getStudentsForSubject() method.
        $selectedSubject = array();
        foreach ($this->subjects as $subject) {
            if($subject->getCode() === $subjectCode) {
                $selectedSubject = $subject;
            }
        }
        return $selectedSubject->getStudents();
    }

    public function getNumberOfStudents(): int
    {
        // TODO: Implement getNumberOfStudents() method.
    }

    public function print()
    {
        // TODO: Implement print() method.
    }
}
