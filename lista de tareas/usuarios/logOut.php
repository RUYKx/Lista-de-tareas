<?php
require_once "../components/users.php";
require_once "../components/utils.php";

executeIf(!isLoggedIn(), function() {
    redirect('../index.php');
});

logOut();

?>