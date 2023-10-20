<?php
require_once "AbstractUniversity.php";
require_once "Subject.php";

class University extends AbstractUniversity
{
    private function isSubjectExists(string $code, string $name): bool
    {
        if (count($this->subjects) == 0) return false;
        foreach ($this->subjects as $subject) {
            if ($subject->getCode() == $code && $subject->getName() == $name) {
                return true;
            }
        }
        return false;
    }

    /**
     * @throws Exception
     */
    public function addSubject(string $code, string $name): Subject
    {
        if (!$this->isSubjectExists($code, $name)) {
            $subject = new Subject($code, $name);
            $this->subjects[] = $subject;
            return $subject;
        } else {
            throw new Exception("Subject exists!<br>");
        }
    }

    /**
     * @throws Exception
     */
    public function addStudentOnSubject(string $subjectCode, Student $student): void
    {
        foreach ($this->subjects as $subject) {
            if ($subject->getCode() == $subjectCode) {
                $subject->addStudent($student->getName(), $student->getStudentNumber());
                break;
            }
        }
    }

    public function getStudentsForSubject(string $subjectCode)
    {
        foreach ($this->subjects as $subject) {
            if ($subject->getCode() == $subjectCode) {
                return $subject->getStudents();
            }
        }
        return [];
    }

    public function getNumberOfStudents(): int
    {
        $total = 0;
        foreach ($this->subjects as $subject) {
            foreach ($subject->getStudents() as $st) {
                $total++;
            }
        }
        //echo '---------------------------------' . "\n";
        //return "The student total: " . $total . "\n";
        //echo '---------------------------------' . "\n";
        return $total;
    }

    public function print(): void
    {
        foreach ($this->subjects as $subject) {
            echo '---------------------------------' . "<br>";
            echo $subject . "<br>";
            echo '---------------------------------' . "<br>";

            foreach ($subject->getStudents() as $student) {
                echo $student->getName() . " - " . $student->getStudentNumber();
                echo "<br>";
            }
        }
    }

    /**
     * @throws DeleteSubjectException
     */
    public function deleteSubject(Subject $subject): void
    {
        if (!$this->isSubjectExists($subject->getCode(), $subject->getName()) || count($subject->getStudents()) !== 0) {
            throw new DeleteSubjectException();
        } else {
            $this->setSubjects(
                array_filter($this->getSubjects(), function ($sub) use ($subject) {
                    return $sub->getCode() !== $subject->getCode();
                })
            );
        }
    }
}
