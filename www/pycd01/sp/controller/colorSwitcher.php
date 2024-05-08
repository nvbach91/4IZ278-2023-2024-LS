<?php
session_start();

if (isset($_SESSION['theme']) && $_SESSION['theme'] === 'dark') {
    echo '<script>document.documentElement.setAttribute("data-theme", "dark");</script>';
} else {
    echo '<script>document.documentElement.setAttribute("data-theme", "light");</script>';
}