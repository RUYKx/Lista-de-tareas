<?php
// Funcion que redirecciona a una URL especificada
function redirect($url)
{
    header("Location: " . $url);
    exit();
}

// Funcion que guarda un mensaje y titulo de error y redirige a una URL especificada 
function redirectIfError($url, $title, $message, $isOk)
{
    if(!$isOk)
    {
        session_start();
        $_SESSION['error_title'] = $title;
        $_SESSION['error_message'] = $message;

        redirect($url);
    }
}

function executeIf($condition, $callback)
{
    if($condition)
    {
        $callback();
    }
}