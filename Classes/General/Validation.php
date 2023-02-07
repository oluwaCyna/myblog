<?php

namespace General;

class Validation {
    protected $emailCheck = "/[a-z0-9!#$%&'*+\/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+\/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+(?:[A-Z]{2}|com|co|org|net|gov|mil|biz|info|mobi|name|aero|jobs|museum)\b/";
    protected $userCheck = '/^[a-z][a-z]+\d*$|^[a-z]\d\d+$/i';
    protected $passwordCheck = '/^[A-Za-z]\w{6,14}$/';
    public $errors = [];
    public $validated = [];

    public function validate_require_text($name, $value) {
        if (empty($value)) {
            $this->errors['required'][$name] = "$name is required...";
        }
    }

    public function validate_require_file($name, $value) {
        if ($value['size'] == 0) {
            $this->errors['required'][$name] = "$name is required!";
        }
    }

    public function validate_email($value) {
        if (!preg_match($this->emailCheck, $value)) {
            $this->errors['email'] = "Invalid email address!";;
            }
    }
    
    public function validate_username($value) {
        if (!preg_match($this->userCheck, $value)) {
            $this->errors['username'] = "Username can only be alphanumeric characters, Atleast 2 letters, and doesn't start with number.";;
            }
    }

    public function validate_password($value) {
        if (!preg_match($this->passwordCheck, $value)) {
            $this->errors['password'] = "Password must be 7-16 alphanumeric characters, underscore and first character must be a letter.";;
            }
    }

    public function handle_image($name, $value, $path) {
        $file_name = time().basename($value['name']);
        $tmp_name = $value['tmp_name'];
        $new_path = "../../$path/$file_name";

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


