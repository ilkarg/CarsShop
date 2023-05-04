<?php

class Post extends Model {
	public string $title;
    public string $body;
    public $image;

    public function __construct(string $title, string $body, string $image) {
        $this->title = $title;
        $this->body = $body;
        $this->image = $image;
    }

    public function getTitle() : string {
        return $this->title;
    }

    public function getBody() : string {
        return $this->body;
    }

    public function getImage() : string {
        return $this->image;
    }
}