<?php
require_once 'users.php';

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

// Funcion que crea un modal de error
function errorModal($title, $message, $id, $redirectUrl)
{ 
    unsetSessions(['error_title', 'error_message']);
    echo '
        <div id="'.$id.'" class="modal">
            <div class="modal-content">
                <span class="close-button" onclick="closeModalById('.$id.')">&times;</span>
                <h2>'.$title.'</h2>
                <p>'.$message.'</p>
                <button onclick="window.location.href=\''.$redirectUrl.'\'">Ok</button>
            </div>
        </div>
    ';
}

// Funcion que si se cumple la condicion ejecuta el callback que es una funcion anonima mayormente
function executeIf($condition, $callback)
{
    if($condition)
    {
        $callback();
    }
}

?>