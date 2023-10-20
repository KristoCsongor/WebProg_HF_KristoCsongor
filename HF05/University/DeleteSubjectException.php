<?php

class DeleteSubjectException extends Exception
{
    public function showMessage(): string
    {
        return "Can't delete subject!<br>";
    }
}