<?php

if ($_SESSION['user_type'] != 1) {
    header('location: home.php');
    exit();
}
