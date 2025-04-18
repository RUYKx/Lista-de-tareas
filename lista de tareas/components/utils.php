<?php
// Funcion que redirecciona a una URL especificada
function redirect($url)
{
    header("Location: " . $url);
    exit();
}
