<?php

class ArrayManipulator
{
    private array $data;

    public function __get(string $property)
    {
        if (property_exists($this, $property)) {
            return $this->$property;
        } else {
            throw new NonExistentField();
        }
    }

    public function __set(string $property, $value): void
    {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        } else {
            throw new NonExistentField();
        }
    }

    public function __isset(string $property): bool
    {
        if (property_exists($this, $property)) {
            return isset($this->$property);
        } else {
            throw new NonExistentField();
        }
    }

    public function __unset(string $property): void
    {
        if (property_exists($this, $property)) {
            unset($this->$property);
        } else {
            throw new NonExistentField();
        }
    }

    public function __toString(): string
    {
        return json_encode($this->data);
    }

    public function __clone(): void
    {
        $this->data = array("cloneOne" => 1, "cloneTwo" => 2);
    }

}