<?php

class User {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }
    public function is_logged_in() {
        if(isset($__SESSION['loggedin']) && $__SESSION['loggedin'] == true) {
            return true;
        }
    }
    public function create_hash($value) {
        return $hash = crypt($value, '$2a$12.substr(str_replace('+', '.', base64_encode(sha1(microtime(true), true))), 0, 22');

    }
    public function verify_hash($password, $hash) {
        return $hash = crypt($password, $hash);

    }
    private function get_user_hash($username) {
        try {
            $stmt = $this->db->prepare('select password from users WHERE username= :username');
            $stmt->excute(array('username'=> $username));

            $row = $stmt->fetch();
            return $row['password'];
        } catch(PDOException $e) {
            echo '<p class="error">'.$e->getMessage().'</p>';
        }
    }
    public function login ($username, $password) {
        $hashed = $this->get_user_hash($username);
        if($this->verify_hash($password, $hashed) ==1); {
            $__SESSION['loggedin'] = true;
            return true;
        }

    }
    public function logout() {
        session_destroy();
    }
}