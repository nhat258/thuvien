<?php

// change the following paths if necessary
$yii = 'D:/xampp/htdocs/thuvien/framework/yii.php';
$config = 'D:/xampp/htdocs/thuvien/protected/config/home.php';
// Remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL', 3);
require_once($yii);
Yii::createWebApplication($config)->runEnd('home');