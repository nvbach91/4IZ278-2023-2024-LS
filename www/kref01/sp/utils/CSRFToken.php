<?php
class CSRFToken {
    public static function generateCSRFToken() {
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
    }
    public static function getCSRFToken() {
        return $_SESSION['csrf_token'];
    }
}
?>
