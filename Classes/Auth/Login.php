<?php
namespace Auth;

use General\Validation;

class Login extends Validation {
    private $email;
    private $password;

    public function __construct($email, $password) {
        $this->email = $email;
        $this->password = $password;
    }

    public function validate_require() {
        $this->validate_require_text('email', $this->email);
        $this->validate_require_text('password', $this->password);
        return $this->errors;
    }

    public function validate_match() {
        $this->validate_email($this->email);
        $this->validate_password($this->password);
        return $this->errors;
    }

    public function character() {
        $this->validate_character('email', $this->email);
        $this->validate_character('password', $this->password);
        return $this->validated;
    }
    
}