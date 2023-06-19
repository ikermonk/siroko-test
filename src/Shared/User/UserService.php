<?php
namespace Siroko\Shared\User;

use Ramsey\Uuid\Uuid;

class UserService {
    public function get_user_session(): string {
        session_start();
        if (!isset($_SESSION) || !isset($_SESSION["user_id"]) || $_SESSION["user_id"] === "") {
            $uuid = Uuid::uuid4();
            $user_id = $uuid->toString();
            $_SESSION["user_id"] = $user_id;
        }
        return $_SESSION["user_id"];
    }
}
?>