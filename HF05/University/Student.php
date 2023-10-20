<?php
/**
 * User: TheCodeholic
 * Date: 4/8/2020
 * Time: 10:40 PM
 */

/**
 * Class Student
 */
class Student
{
    private string $name;
    private string $studentNumber;
    private array $grades = [];

    /**
     * @param string $name
     * @param string $studentNumber
     */
    public function __construct(string $name, string $studentNumber)
    {
        $this->name = $name;
        $this->studentNumber = $studentNumber;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getStudentNumber(): string
    {
        return $this->studentNumber;
    }

    public function setStudentNumber(string $studentNumber): void
    {
        $this->studentNumber = $studentNumber;
    }

    public function getGrades(): array
    {
        return $this->grades;
    }

    public function setGrades(array $grades): void
    {
        $this->grades = $grades;
    }

    public function setGrade(Subject $subject, float $grade): void
    {
        $this->grades[$subject->getCode()] = $grade;
    }

    public function getAvgGrade(): float|int
    {
        $sum = 0;
        foreach ($this->getGrades() as $grade) {
            $sum += $grade;
        }
        return $sum / count($this->getGrades());
    }

    public function printGrades(): void
    {
        foreach ($this->getGrades() as $subjectCode => $grade) {
            echo $subjectCode . " - " . $grade . "<br>";
        }
    }
}
