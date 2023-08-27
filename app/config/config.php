<?php
if ($_SERVER['HTTP_HOST'] === 'localhost') {
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