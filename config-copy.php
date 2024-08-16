<?php

ini_set(
    'session.use_only_cookies',
    true
);
ini_set(
    'session.use_strict_mode',
    true
);

session_start();
define('BASE_URL', isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http" . "://" . $_SERVER['HTTP_HOST']);
