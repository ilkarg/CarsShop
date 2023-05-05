<?php

class Order extends Model {
	public string $name;
    public string $email;
    public string $phone;
    public string $model;
    public string $price;

    public function __construct(string $name, string $email, string $phone, string $model, string $price) {
        $this->name = $name;
        $this->email = $email;
        $this->phone = $phone;
        $this->model = $model;
        $this->price = $price;
    }

    public function getName() : string {
        return $this->name;
    }

    public function getEmail() : string {
        return $this->email;
    }

    public function getPhone() : string {
        return $this->phone;
    }

    public function getModel() : string {
        return $this->model;
    }

    public function getPrice() : string {
        return $this->price;
    }
}