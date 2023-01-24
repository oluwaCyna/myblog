<?php

namespace General;

class Validation {
    public $errors = [];
    public $validated = [];

    public function validate_require_text($name, $value) {
        if (empty($value)) {
            $this->errors['required'][$name] = "$name is required!";
        }
    }

    public function validate_require_file($name, $value) {
        if ($value['size'] == 0) {
            $this->errors['required'][$name] = "$name is required!";
        }
    }

    public function handle_image($name, $value, $path) {
        $file_name = basename($value['name']);
        $tmp_name = $value['tmp_name'];
        $new_path = "../../$path/$file_name";
        // $extension = strtolower(pathinfo($new_path, PATHINFO_EXTENSION));

        if (move_uploaded_file($tmp_name, $new_path)) {
        $this->validated[$name] = $file_name;
        } else {
        $this->errors[$name] = "Unable to upload image";
        }
    }

    public function validate_character($name, $value) {
        $this->validated[$name] = htmlspecialchars($value);
    }
}


