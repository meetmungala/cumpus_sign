<?php
require_once __DIR__ . '/../config/auth.php';
logout();
redirect_to('login.php');