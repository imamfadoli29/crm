<?php 

require_once '../library/Access.php';

$akses = new Access;

switch(isset($_GET['action']) ? $_GET['action'] : NULL ){

    case 'login';
    $akses->login($_POST['username'], $_POST['password']);
    break;
    
    case 'logout';
    $akses->logout();
    break;

    case 'register';
    $akses->register();
    break;
}