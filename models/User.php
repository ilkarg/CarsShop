<?php

class User extends Model {
    public string $name;
    public $age;

    public function __construct(string $name, $age) {
        $this->name = $name;
        $this->age = $age;
    }

    public function getName() : string {
        return $this->name;
    }

    public function getAge(){
        return $this->age;
    }
}
