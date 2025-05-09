<?php
// utils/Flash.php
if (session_status() === PHP_SESSION_NONE) session_start();

class Flash
{
    public static function set($status, $message)
    {
        $_SESSION['flash'] = [
            'status' => $status,
            'message' => $message
        ];
    }

    public static function get()
    {
        if (isset($_SESSION['flash'])) {
            $flash = $_SESSION['flash'];
            unset($_SESSION['flash']);
            return $flash;
        }
        return null;
    }
}
