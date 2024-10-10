<?php

require '../config/database.php';
session_destroy();
header('location: ../Login/login.php');
