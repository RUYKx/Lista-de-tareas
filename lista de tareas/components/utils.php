<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Funcion que redirecciona a una URL especificada
function redirect($url)
{
    header("Location: " . $url);
    exit();
}

// Funcion que guarda un mensaje y titulo de error y redirige a una URL especificada 
function redirectModal($id, $title, $message, $buttonText, $url)
{
    session_start();
    $_SESSION['modal_id'] = $id;
    $_SESSION['modal_title'] = $title;
    $_SESSION['modal_message'] = $message;
    $_SESSION['modal_button_text'] = $buttonText;

    redirect($url);

    return true;
}

// Funcion que elimina una variable de sesion si existe
function unsetSessions(array $sessions)
{
    foreach($sessions as $session)
    {
        if(isset($_SESSION[$session]))
        {
            unset($_SESSION[$session]);
        }
    }
}

// Funcion que si se cumple la condicion ejecuta el callback que es una funcion anonima mayormente
function executeIf($condition, $callback)
{
    if($condition == true)
    {
        $res = $callback();
        return $res;
    }
    else
    {
        return false;
    }
}

?>