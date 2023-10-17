<?php

class NonExistentField extends Exception
{
    public function myErrorMessage(): string
    {
        return "Non existent field!";
    }
}