<?php
namespace Post;

use General\Validation;

class Update extends Validation {
    private $title;
    private $category;
    private $paragraph1;
    private $paragraph2;
    private $paragraph3;
    private $paragraph4;
    private $image;
    private $image2;
 
    public function __construct($title, $category, $paragraph1, $paragraph2, $paragraph3, $paragraph4, $image, $image2) {
        $this->title = $title;
        $this->category = $category;
        $this->paragraph1 = $paragraph1;
        $this->paragraph2 = $paragraph2;
        $this->paragraph3 = $paragraph3;
        $this->paragraph4 = $paragraph4;
        $this->image = $image;
        $this->image2 = $image2;
    }

    public function validate() {
        $this->validate_require_text('title', $this->title);
        $this->validate_require_text('category', $this->category);
        $this->validate_require_text('$paragraph1', $this->paragraph1);
        return $this->errors;
    }

    public function character() {
        $this->validate_character('title', $this->title);
        $this->validate_character('category', $this->category);
        $this->validate_character('paragraph1', $this->paragraph1);
        $this->validate_character('paragraph2', $this->paragraph2);
        $this->validate_character('paragraph3', $this->paragraph3);
        $this->validate_character('paragraph4', $this->paragraph4);
        $this->handle_image('image', $this->image, 'post-image');
        $this->handle_image('image2', $this->image2, 'post-image');
        return $this->validated;
    }
}