<?php

class Feedback extends Model {
	public string $fio;
    public string $email;
    public string $message;

    public function __construct(string $fio, string $email, string $message) {
        $this->fio = $fio;
        $this->email = $email;
        $this->message = $message;
    }

    public function getFio() : string {
        return $this->fio;
    }

    public function getEmail() : string {
        return $this->email;
    }

    public function getMessage() : string {
        return $this->message;
    }
}