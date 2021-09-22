<?php

require __DIR__ . '/../vendor/autoload.php';

$dotenv = new Symfony\Component\Dotenv\Dotenv();
$dotenv->load(__DIR__ . '/../.env');
if (file_exists(__DIR__.'/../.env.local')) {
    $dotenv->overload(__DIR__.'/../.env.local');
}
defined('YII_DEBUG') or define('YII_DEBUG', $_ENV['MODE'] === 'dev');
defined('YII_ENV') or define('YII_ENV', $_ENV['MODE']);

require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';

$config = require __DIR__ . '/../config/web.php';

function debug($arr, $die = true){
    echo "<pre>";
    print_r($arr);
    echo "</pre>";
    if ($die) {
        die();
    }
}

function parseJson($json, $default_value = []){
    if (isJson($json)) {
        $arr = json_decode($json, 1);
        if (!is_array($arr) && isJson($arr)) {
            $arr = json_decode($arr, 1);
        }
        return !empty($arr) ? $arr : $default_value;
    } else {
        return $default_value;
    }
}

function isJson($string): bool {
    json_decode($string);
    return (json_last_error() === JSON_ERROR_NONE);
}

(new yii\web\Application($config))->run();
