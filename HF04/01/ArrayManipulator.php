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

    public function __unset(string $name): void
    {
        // TODO: Implement __unset() method.
    }

    public function __toString(): string
    {
        /*
        $str = "";
        array_walk($this->data, function($element) use ($str) {
            $str .= $element;
        });
        return $str;
        */
        return $this;
    }

    public function __clone(): void
    {
        // TODO: Implement __clone() method.
    }

}