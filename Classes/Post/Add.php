<?php
namespace Post;

use General\Validation;

class Add extends Validation {
    private $title;
    private $category;
    private $body;
    private $image;
 
    public function __construct($title, $category, $body, $image) {
        $this->title = $title;
        $this->category = $category;
        $this->body = $body;
        $this->image = $image;
    }

    public function validate() {
        $this->validate_require_text('title', $this->title);
        $this->validate_require_text('category', $this->category);
        $this->validate_require_text('body', $this->body);
        $this->validate_require_file('image', $this->image);
        return $this->errors;
    }

    public function character() {
        $this->validate_character('title', $this->title);
        $this->validate_character('category', $this->category);
        $this->validate_character('body', $this->body);
        $this->handle_image('image', $this->image, 'post-image');
        return $this->validated;
    }
}