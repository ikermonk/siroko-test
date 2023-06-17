<?php
namespace Siroko\Shared\User;

class UserService {
    public function get_user_session(): string {
        session_start();
        if (!isset($_SESSION) || !isset($_SESSION["user_id"]) || $_SESSION["user_id"] === "") {
            $user_id = uniqid();
            $_SESSION["user_id"] = $user_id;
        }
        return $_SESSION["user_id"];
    }
}
?>