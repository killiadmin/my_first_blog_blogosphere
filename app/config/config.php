<?php
if ($_SERVER['HTTP_HOST'] === '127.0.0.1') {
    session_set_cookie_params([
        'httponly' => true,
        'secure' => false,
    ]);
} else {
    session_set_cookie_params([
        'httponly' => true,
        'secure' => true,
    ]);
}