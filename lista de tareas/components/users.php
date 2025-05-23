<?php
require_once __DIR__ . '/../conex.php';
require_once __DIR__ . '/utils.php';
require_once __DIR__ . '/db_queries.php';

// Verifica si la sesion ya ha sido iniciada, si no, la inicia
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


// Obtiene el usuario con el nombre de usuario especificado
function getUsuario($usuario)
{
    $query = "SELECT * FROM `usuarios` WHERE `Usuario` = '" . $usuario . "';";
    $res = mysqli_query($GLOBALS['connection'], $query);
    
    if(!isQueryEmpty($res))
    {
        return mysqli_fetch_assoc($res);
    }
    else
    {
        return false;
    }

}

// Verifica si el nombre de usuario ya existe en la base de datos
function isUsernameAvailable($usuario)
{
    $query = "SELECT * FROM `usuarios` WHERE `Usuario` = '" . $usuario . "';";
    $res = mysqli_query($GLOBALS['connection'], $query);
    
    if(!isQueryEmpty($res))
    {
        return false;
    }
    else
    {
        return true;
    }
}

// Funcion que registra un usuario en la base de datos
function insertUsuario($usuario, $password, $email)
{
    $query = "INSERT INTO `usuarios` (`Usuario`, `Password`, `Email`) VALUES ('" . $usuario . "', '" . $password . "', '" . $email . "');";
    
    $res = mysqli_query($GLOBALS['connection'], $query);

    return isQuerySuccessful($res);
}

// Funcion que verifica si el usuario esta logueado
function isLoggedIn()
{
    return isset($_SESSION['logged_in']) ? true : false;
}

// Funcion que loguea un usuario en la pagina web
function logIn($usuario, $password)
{
    if(!isLoggedIn())
    {
        if(isset($usuario, $password)){
            $query = "SELECT * FROM `usuarios` WHERE `Usuario` = '" . $usuario . "' AND `Password` = '" . $password . "'";
            $res = mysqli_query($GLOBALS['connection'], $query);
            if(!isQueryEmpty($res))
            {
                $_SESSION['logged_in'] = true;
                $_SESSION['Usuario'] = $usuario; 
                return true;
            }
            else
            {
                return false;
            }
        }
        else
        {
            return false;
        }
    }
    else
    {
        redirect("../index.php");
        return true;
    }
    
}

// Funcion que cierra la sesion del usuario
function logOut()
{
    if(isLoggedIn())
    {
        session_destroy();
        redirect("../index.php");
    }
    else
    {
        redirect(__DIR__);
    }
}

?>