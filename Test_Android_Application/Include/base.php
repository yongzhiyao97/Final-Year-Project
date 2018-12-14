<?php
/* Helper Function */
function GET($key, $value = null) {
    $value = $_GET[$key] ?? $value;
    return trim($value);
}

function POST($key, $value = null) {
    $value = $_POST[$key] ?? $value;
    return trim($value);
}

function IS_GET() {
    return $_SERVER['REQUEST_METHOD'] == 'GET';
}

function IS_POST() {
    return $_SERVER['REQUEST_METHOD'] == 'POST';
}

function REDIRECT($url = null) {
    $url = $url ?? $_SERVER['REQUEST_URI'];
    ob_clean();
    header("Location: $url");
    exit();
}

function LOGIN($user) {
    $_SESSION['_user'] = $user;
    REDIRECT('Index.php');
}

function LOGOUT() {
    unset($_SESSION['$_user']);
    session_destroy();
    REDIRECT('Landing.php');
}

function AUTHENTICATION() {
    global $_user;
    if (!$_user) {
        REDIRECT('Landing.php');
    }
}

/* Base Configuration */
ob_start();
session_start();
date_default_timezone_set('Asia/Kuala_Lumpur');

/* Global Variable */
$_user = $_SESSION['_user'] ?? null;

$now = new DateTime();
$datetime = $now->format('d/m/Y H:i:s');