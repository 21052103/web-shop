<?php

session_start();
Define('DB_HOST','localhost');
Define('DB_USER','root');
Define('DB_PASS','');
Define('DB_NAME','shop_db');
Define('PER_PAGE',3);
Define('BASE_PATH',$_SERVER['DOCUMENT_ROOT'] .'/webshop_be1/');

spl_autoload_register(function ($className){
    require_once BASE_PATH . "App/models/$className.php";
});


?>