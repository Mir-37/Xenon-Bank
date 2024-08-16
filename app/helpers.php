<?php

function getAvatarUrl($name)
{
    $url = 'https://ui-avatars.com/api/?name=' . urlencode($name) . '&background=random&size=100&length=2&rounded=true';
    return $url;
}

function sanitize($data)
{
    $data = trim($data);
    $data = htmlspecialchars($data);
    $data = stripslashes($data);
    return $data;
}
function redirect($page)
{
    $home_url = BASE_URL;
    header('location: ' . $home_url . '/' . $page);
}

function setFlash($name, $message)
{
    if (!empty($_SESSION[$name])) {
        unset($_SESSION[$name]);
    }
    $_SESSION[$name] = $message;
}

function displayFlash($name, $type)
{
    if (isset($_SESSION[$name])) {
        echo '<div class="alert alert-' . $type . '">' . $_SESSION[$name] . '</div>';
        unset($_SESSION[$name]);
    }
}

function isLoggedIn()
{
    if (isset($_SESSION['user'])) {
        return true;
    } else {
        return false;
    }
}
