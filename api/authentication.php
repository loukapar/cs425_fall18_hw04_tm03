<?php
session_start();
if(empty($_SESSION["authenticated"]) || $_SESSION["authenticated"] != 'true') {
    header('Location: 52.26.216.32/cs425_fall18_hw04_tm03/front_end/index.php');
}
?>