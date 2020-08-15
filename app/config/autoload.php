<?php
spl_autoload_register(function ($class) {
    include "../model/" . $class . ".class.php";
});
