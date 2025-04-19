<?php
require_once __DIR__ . '/../conex.php';
require_once __DIR__ . '/utils.php';
require_once __DIR__ . '/db_queries.php';

// Inicia la sesion
session_start();

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
    if(isset($_SESSION['LoggedIn']))
    {
        return true;
    }
    else
    {
        return false;
    }
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
                $_SESSION['LoggedIn'] = true;
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